<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function index(){
        $title = "Dashboard";
        $no = File::paginate(15);
        //Read 5 table file by descending 
        $files = DB::table('files')->whereNull('deleted_at')->orderBy('file_code','desc')->limit(5)->get();

        return view('dashboard.home',['title'=>$title,'files'=>$files]);
    }
    
}
