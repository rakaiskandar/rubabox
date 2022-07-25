<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Subsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Master Data - Subsi";
        $no = Subsi::paginate(15);

        //Read table subsis
        $subsi = DB::table('subsis')->get();
        return view('dashboard.subsi',['subsi'=>$subsi,'title'=>$title]);
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
            'subsi_code' => 'required|max:20|unique:subsis',
            'section' => 'required',
            'description' => 'required|max:255',
        ], [
            'subsi_code.required' => 'Subsi code is required',
            'section.required' => 'Section is required',
            'description.required' => 'Description is required'
        ]);

        //Insert input data
        $status = Subsi::create($input);
        //Check query inserted
        if($status){
            //For history activity
            $activity = "Add Data";
            $location = "Table Subsi";
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

            return redirect('/dashboard/subsi')->with('success','Create subsi success');
        }else{
            return redirect('/dashboard/subsi')->with('error','Create subsi failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($subsi_code)
    {
        $title = "Edit Subsi";
        //Get value from table subsis by column subsi_code
        $subsi = DB::table('subsis')->where('subsi_code',$subsi_code)->get();;
        return view('form.subsi-edit',['subsi'=>$subsi,'title'=>$title]);
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
            'subsi_code' => 'required|max:20',
            'section' => 'required',
            'description' => 'required|max:255',
        ]);

        //Update inserted data
        $status = DB::update('update subsis set section = ? ,description = ? where subsi_code = ?',[$input['section'],$input['description'],$input['subsi_code']]);
        //Check query updated data
        if ($status){
            //For history activity
            $activity = "Edit Data";
            $location = "Table Subsi";
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

            return redirect('/dashboard/subsi')->with('success','Edit subsi success');
        }else{
            return redirect('/dashboard/subsi')->with('error','Edit subsi failed');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subsi_code)
    {
        //Find column subsi_code to delete
        $subsi = Subsi::find($subsi_code);
        $subsi->delete();

        //Check query deleted
        if ($subsi) {
            //For history activity
            $activity = "Delete Data";
            $location = "Table Subsi";
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

            return redirect('/dashboard/subsi')->with('success','Delete subsi success');
        }else{
            return redirect('/dashboard/subsi')->with('error','Delete subsi failed');
        }
    }
}
