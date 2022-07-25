<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Upload File";
        $no = File::paginate(1);
        //Paginate
        $files = DB::table('files')->whereNull('deleted_at')->latest()->paginate(10);
        
        //Read table files for total
        $total = DB::table('files')->whereNull('deleted_at')->latest()->get();

        //Read for section
        $subsi = DB::table('subsis')->get();

        return view('dashboard.upload',
        ['files' => $files, 'title' => $title,'subsi'=>$subsi,'total'=>$total]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        $noUrut = "";

        $fileExtension = $request->file->getClientOriginalName();
        $type = $request->file->extension();

        $request->file->move(public_path('/file'), $fileExtension);

        //Input file that will inserted
        $input = [
            'file_code' => $request->file_code . date('dmY') . $noUrut,
            'file_name' => $request->file_name,
            'subsi_code' => $request->subsi_code,
            'section' => $request->section,
            'file' => $fileExtension,
            'type' => $type
        ];
        //Check row by date now 
        $status = DB::table('files')->where('created_at', 'like', '%' .  date("Y-m-d") . '%')->count();
        if ($status > 0) {
            //Get value last
            $noUrut = DB::table('files')->orderBy('file_code', 'desc')->where('created_at', 'like', '%' .  date("Y-m-d") . '%')->value('file_code');
            
            //Get last 4 character
            $urutan = substr($noUrut, -4);
            
            //Increment value 
            $noUrut = strval($urutan) + 1;
            $noUrutString = strval($noUrut);

            //Check increment
            if (strlen($noUrutString) == 1) {
                $noUrutBaru = "000" . $noUrutString;
            } elseif (strlen($noUrutString) == 2) {
                $noUrutBaru = "00" . $noUrutString;
            } elseif (strlen($noUrutString) == 3) {
                $noUrutBaru = "0" . $noUrutString;
            } elseif (strlen($noUrutString) == 4) {
                $noUrutBaru = $noUrutString;
            }

            //Modify noUrut to increment variable
            $input['file_code'] = $request->file_code . date('dmY') . $noUrutBaru;
            
            //Insert input data
            File::create($input);

            //For history activity when inserted data
            $activity = "Add Data";
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

            return redirect('/dashboard/upload')->with('success', 'Upload file success');
        } else {

            $noUrut = "0001";
            $input['file_code'] = $request->file_code . date('dmY') . $noUrut;
            File::create($input);

            //For history activity when data is empty
            $activity = "Add Data";
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

            return redirect('/dashboard/upload')->with('success', 'Upload file success');
        }

        return redirect('/dashboard/upload')->with('error', 'Upload file failed');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($file_code)
    {
        $title = "Edit File";
        //Get value from table file by column file_code
        $file = DB::table('files')->where('file_code', $file_code)->get();
        return view('form.upload-edit', ['files' => $file, 'title' => $title]);
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
        $fileExtension = $request->file->getClientOriginalName();
        $type = $request->file->extension();
        $request->file->move(public_path('/file'), $fileExtension);

        //Update data with DB Facade by column file_code
        $status = DB::update(
            'update files set file_name = ? ,subsi_code = ?, file = ?, section = ?, type = ? where file_code = ?',
            [$request->file_name, $request->subsi_code, $fileExtension, $request->section, $type, $request->file_code]
        );

        //Check query updated
        if ($status) {

            //For history activity
            $activity = "Edit Data";
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

            return redirect('/dashboard/upload')->with('success', 'Edit file success');
        } else {
            return redirect('/dashboard/upload')->with('error', 'Edit file failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file, $file_code)
    {
        //Find column file_code to delete
        $file = File::find($file_code);

        //This delete is temporary, permanent delete in TrashController
        $file->delete();

        //Check query deleted
        if ($file) {
            return redirect('/dashboard/upload')->with('success', 'Delete file success');
        } else {
            return redirect('/dashboard/upload')->with('error', 'Delete file failed');
        }
    }

    public function search_file(Request $request)
    {
        $title = "Upload File";
        //Check request from input for search
        if ($request->term) {
            //Get table that searched from request input
            $files = DB::table('files')->where('file_code', 'Like', '%' . $request->term . '%')->whereNull('deleted_at')
                ->orWhere('file_name', 'Like', '%' . $request->term . '%')->whereNull('deleted_at')
                ->orWhere('section', 'Like', '%' . $request->term . '%')->whereNull('deleted_at')
                ->orWhere('created_at', 'Like', '%' . $request->term . '%')->whereNull('deleted_at')
                ->orWhere('type','Like','%' . $request->term . '%')->whereNull('deleted_at')
                ->paginate();
        } else {
            $files = DB::table('files')->whereNull('deleted_at')->latest()->get();
        }
        //Read for section
        $subsi = DB::table('subsis')->get();

        //Read table files for total
        $total = DB::table('files')->whereNull('deleted_at')->latest()->get();

        return view('dashboard.upload', ['files' => $files, 'title' => $title,'subsi'=>$subsi,'total'=>$total]);
    }

    public function seeAll(Request $request)
    {
        $title = "Upload File";
        //Read for section
        $subsi = DB::table('subsis')->get();

        if($request->see_all){
            //Read table files for total
            $files = DB::table('files')->whereNull('deleted_at')->latest()->paginate(200);
        }else{
            //Paginate
            redirect('/dashboard/upload');
        }
        //Read table files for total
        $total = DB::table('files')->whereNull('deleted_at')->latest()->get();

        return view('dashboard.upload', 
        ['files'=>$files,'title' => $title,'subsi'=>$subsi,'total'=>$total]);
    }
}
