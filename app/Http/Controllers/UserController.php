<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Master Data - User";
        $no = User::paginate(15);

        //Read table by descending
        $user = User::latest()->paginate(10);
        
        //Read table users for total 
        $total = User::latest()->get();
        
        //Read table employee for relationship
        $employee = Employee::latest()->get();

        //Read table subsi for level
        $subsi = DB::table('subsis')->get();

        return view('dashboard.user',
        ['user'=>$user,'title'=>$title,'employee'=>$employee,'total'=>$total,'subsi'=>$subsi]);
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
            'nip' => 'required|max:20|unique:users',
            'name' => 'required',
            'username' => 'required',
            'level' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'nip.unique' => 'NIP has registered',
            'name.required' => 'Name is required',
            'username.required' => 'Username is required',
            'level.required' => 'Level is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required'
        ]);

        //Hash password to secure password
        $input['password'] = Hash::make($input['password']);

        //Insert input data
        $status = User::create($input);

        //Check query inserted
        if($status){
            //For history activity
            $activity = "Add Data";
            $location = "Table User";
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

            return redirect('/dashboard/user')->with('success','Create user success');
        }else{
            return redirect('/dashboard/user')->with('error','Create user failed');
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
        $title = "Edit User";
        //Get value from table users by column id
        $user = User::where('id',$id)->get();
        return view('form.user-edit',['user'=>$user,'title'=>$title]);
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'level' => 'required',
            'password' => 'required',
        ]);

        //Hash password to secure password
        $input['password'] = Hash::make($input['password']);
        
        //Get column id
        $id = $request->id;

        //Update data by column id
        $status = User::where('id',$id)->update($input);

        //Check query updated
        if($status){
            //For history activity
            $activity = "Edit Data";
            $location = "Table User";
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

            return redirect('/dashboard/user')->with('success','Update user success');
        }else{
            return redirect('/dashboard/user')->with('error','Update user failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //Get column id
        $id = User::select('id')->get()->toArray();

        //Delete data by column id
        $user = User::where('id',$id)->delete();

        //Check query deleted
        if ($user) {

            //For history activity
            $activity = "Delete Data";
            $location = "Table User";
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

            return redirect('/dashboard/user')->with('success','Data berhasil dihapus');
        }else{
            return redirect('/dashboard/user')->with('error','Data gagal dihapus');
        }
    }

    public function search(Request $request)
    {
        $title = "Master Data - User";
        //Check request from input for search
        if ($request->term) {
            //Get table that searched from request input
            $user = DB::table('users')->where('nip', 'Like', '%' . $request->term . '%')
                ->orWhere('name', 'Like', '%' . $request->term . '%')
                ->orWhere('username', 'Like', '%' . $request->term . '%')
                ->orWhere('level','Like','%' . $request->term . '%')
                ->paginate();
        }
         //Read table user for total
         $total = User::latest()->get();

         //Read for section
         $subsi = DB::table('subsis')->get();

        return view('dashboard.user', ['user' => $user, 'title' => $title,'total'=>$total,'subsi'=>$subsi]);
    }
}
