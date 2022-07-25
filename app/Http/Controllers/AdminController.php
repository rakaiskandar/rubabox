<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = Admin::paginate(15);
        $title = "Master Data - Admin";
        //Read table admins by descending
        $admin = Admin::get();

        //Read table subsi for level
        $subsi = DB::table('subsis')->get();

        return view('dashboard.admin',['admin'=>$admin,'title'=>$title,'subsi'=>$subsi]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate input request
        $input = $request->validate([
            'username' => 'required|unique:admins',
            'level' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'username.required' => 'Username is required',
            'level.required' => 'Level is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required'
        ]);

        //Hash password to secure password
        $input['password'] = Hash::make($input['password']);

        //Insert input data
        $status = Admin::create($input);

        //Check query inserted
        if($status){

            //For history activity
            $activity = "Add Data";
            $location = "Table Admin";
            if(Auth::guard('admin')->check()){
                History::create([
                    'name' => Auth::guard('admin')->user()->username,
                    'position' => 'Admin',
                    'section' => Auth::guard('admin')->user()->level,
                    'activity' => $activity,
                    'location_activity' => $location
                ]);
            }else{
                return redirect('/error');
            }

            return redirect('/dashboard/admin')->with('success','Create admin success');
        }else{
            return redirect('/dashboard/admin')->with('error','Create admin failed');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $title = "Edit Admin";
        //Get value from table admins by column id
        $admin = DB::table('admins')->where('id',$id)->get();
        return view('form.admin-edit',['admin'=>$admin,'title'=>$title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         //Validate input request
        $input = $request->validate([
            'username' => 'required',
            'level' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Hash password to secure password
        $input['password'] = Hash::make($input['password']);

        //Get column id
        $id = $request->id;

        //Update input data by column id
        $status = Admin::where('id',$id)->update($input);

        //Check query updated
        if($status){
            //For history activity
            $activity = "Edit Data";
            $location = "Table Admin";
            if(Auth::guard('admin')->check()){
                History::create([
                    'name' => Auth::guard('admin')->user()->username,
                    'position' => 'Admin',
                    'section' => Auth::guard('admin')->user()->level,
                    'activity' => $activity,
                    'location_activity' => $location
                ]);
            }else{
                return redirect('/error');
            }
            return redirect('/dashboard/admin')->with('success','Update admin success');
        }else{
            return redirect('/dashboard/admin')->with('error','Update admin failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete data by column id
        $admin = Admin::where('id',$id)->delete();

        //Check query deleted
        if ($admin) {
            //For history activity
            $activity = "Delete Data";
            $location = "Table Admin";
            if(Auth::guard('admin')->check()){
                History::create([
                    'name' => Auth::guard('admin')->user()->username,
                    'position' => 'Admin',
                    'section' => Auth::guard('admin')->user()->level,
                    'activity' => $activity,
                    'location_activity' => $location
                ]);
            }else{
                return redirect('/error');
            }

            return redirect('/dashboard/admin')->with('success','Delete admin success');
        }else{
            return redirect('/dashboard/admin')->with('error','Delete admin failed');
        }
    }
}
