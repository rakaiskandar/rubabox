<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrashController extends Controller
{
    public function index(){

        $title = "Trash";
        $no = File::paginate(15);
        
        //Read table files that column deleted_at is not empty
        $trash =  DB::table('files')->whereNotNull('deleted_at')->get();
        
        return view('dashboard.trash',['title'=>$title,'trash'=>$trash]);
    }

    public function restore($file_code){
        //Restore data that column deleted_at is not empty
        File::where('file_code',$file_code)->withTrashed()->restore();

        //For history activity
        $activity = "Restore Data";
        $location = "Table Files in Trash";
        if (Auth::guard('admin')->check()) {
            History::create([
                'name' => Auth::guard('admin')->user()->username,
                'position' => "Admin",
                'section' => Auth::guard('admin')->user()->level,
                'activity' => $activity,
                'location_activity' => $location,
            ]);
        } elseif (Auth::guard('user')->check()) {
            History::create([
                'name' => Auth::guard('user')->user()->username,
                'position' => "User",
                'section' => Auth::guard('user')->user()->level,
                'activity' => $activity,
                'location_activity' => $location,
            ]);
        } else {
            return redirect('/error');
        }

        return redirect('/dashboard/upload')->with('success','Restore file success');
    }

    public function forceDelete($file_code){
        //Force delete data that column deleted_at is not empty
        File::where('file_code',$file_code)->withTrashed()->forceDelete();

        //For history activity
        $activity = "Delete Data";
        $location = "Table Files";
        if (Auth::guard('admin')->check()) {
            History::create([
                'name' => Auth::guard('admin')->user()->username,
                'position' => "Admin",
                'section' => Auth::guard('admin')->user()->level,
                'activity' => $activity,
                'location_activity' => $location,
            ]);
        } elseif (Auth::guard('user')->check()) {
            History::create([
                'name' => Auth::guard('user')->user()->username,
                'position' => "User",
                'section' => Auth::guard('user')->user()->level,
                'activity' => $activity,
                'location_activity' => $location,
            ]);
        } else {
            return redirect('/error');
        }

        return redirect('/dashboard/trash')->with('success','Force delete file success');
    }

    public function restoreAll(){
        //Restore all that column deleted_at is not empty
        File::onlyTrashed()->restore();

        //For history activity
        $activity = "Restore Data";
        $location = "Table Files in Trash";
        if (Auth::guard('admin')->check()) {
            History::create([
                'name' => Auth::guard('admin')->user()->username,
                'position' => "Admin",
                'section' => Auth::guard('admin')->user()->level,
                'activity' => $activity,
                'location_activity' => $location,
            ]);
        } elseif (Auth::guard('user')->check()) {
            History::create([
                'name' => Auth::guard('user')->user()->username,
                'position' => "User",
                'section' => Auth::guard('user')->user()->level,
                'activity' => $activity,
                'location_activity' => $location,
            ]);
        } else {
            return redirect('/error');
        }

        return redirect('/dashboard/upload')->with('success','Restore all files success');
    }

    public function forceDeleteAll(){
        //Force delete all that column deleted_at is not empty
        File::onlyTrashed()->forceDelete();

        //For history activity
        $activity = "Delete Data";
        $location = "Table Files";
        if (Auth::guard('admin')->check()) {
            History::create([
                'name' => Auth::guard('admin')->user()->username,
                'position' => "Admin",
                'section' => Auth::guard('admin')->user()->level,
                'activity' => $activity,
                'location_activity' => $location,
            ]);
        } elseif (Auth::guard('user')->check()) {
            History::create([
                'name' => Auth::guard('user')->user()->username,
                'position' => "User",
                'section' => Auth::guard('user')->user()->level,
                'activity' => $activity,
                'location_activity' => $location,
            ]);
        } else {
            return redirect('/error');
        }

        return redirect('/dashboard/upload')->with('success','Force delete all files success');
    }

    public function search_trash(Request $request)
    {
        $title = "Trash";
        //Check request from input for search
        if($request->search_trash){
             //Get table that searched from request input
            $trash = DB::table('files')->where('file_code','Like','%' . $request->search_trash . '%')->whereNotNull('deleted_at')
            ->orWhere('file_name','Like','%' . $request->search_trash . '%')->whereNotNull('deleted_at')
            ->orWhere('section','Like','%' . $request->search_trash . '%')->whereNotNull('deleted_at')
            ->orWhere('created_at','Like','%' . $request->search_trash . '%')->whereNotNull('deleted_at')
            ->orWhere('type','Like','%' . $request->search_trash . '%')->whereNotNull('deleted_at')
            ->paginate();
        }else{
            $trash = DB::table('files')->whereNotNull('deleted_at')->latest()->get();
        }
        return view('dashboard.trash',['trash'=>$trash,'title'=>$title]);
    }
}
