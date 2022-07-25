<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Master Data - Employee";
        $no = Employee::paginate(15);

        //Read table employee by descending
        $employee = Employee::latest()->paginate(10);

        //Read table employee for total
        $total = Employee::latest()->get();

        //Read for section
        $subsi = DB::table('subsis')->get();

        return view('dashboard.employee',
        ['employee' => $employee, 'title' => $title, 'subsi' => $subsi,'total'=>$total]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate input
        $input = $request->validate([
            'nip' => 'required|max:20|unique:employees',
            'subsi_code' => 'required|max:20',
            'name' => 'required|max:255',
            'section' => 'required'
        ], [
            'nip.unique' => 'NIP has registered',
            'subsi_code.required' => 'Subsi code is required',
            'name.required' => 'Name is required',
            'section.required' => 'Section is required'
        ]);

        //Insert input data
        $employee = Employee::create($input);
        if ($employee) {
            //For history activity
            $activity = "Add Data";
            $location = "Table Employee";
            if (Auth::guard('admin')->check()) {
                History::create([
                    'name' => Auth::guard('admin')->user()->username,
                    'position' => "Admin",
                    'section' => Auth::guard('admin')->user()->level,
                    'activity' => $activity,
                    'location_activity' => $location,
                ]);
            } else {
                return redirect('/error');
            }

            return redirect('/dashboard/employee')->with('success', 'Create employee success');
        } else {
            return redirect('/dashboard/employee')->with('error', 'Create employee failed');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nip)
    {
        $title = "Edit Employee";
        $employee = DB::table('employees')->where('nip', $nip)->get();
        return view('form.employee-edit', ['employee' => $employee, 'title' => $title]);
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
        //Validate input data
        $input = $request->validate([
            'subsi_code' => 'required',
            'name' => 'required',
            'section' => 'required',
        ]);

        //Get column nip
        $nip = $request->nip;

        //Update input data by nip
        $status = Employee::where('nip', $nip)->update($input);
        if ($status) {
            //For history activity
            $activity = "Edit Data";
            $location = "Table Employee";
            if (Auth::guard('admin')->check()) {
                History::create([
                    'name' => Auth::guard('admin')->user()->username,
                    'position' => "Admin",
                    'section' => Auth::guard('admin')->user()->level,
                    'activity' => $activity,
                    'location_activity' => $location,
                ]);
            } else {
                return redirect('/error');
            }

            return redirect('/dashboard/employee')->with('success', 'Update employee success');
        } else {
            return redirect('/dashboard/employee')->with('error', 'Update employee failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nip)
    {
        //find column nip
        $employee = Employee::find($nip);
        
        //Delete row by nip
        $employee->delete();
        if ($employee) {
            //For history activity
            $activity = "Delete Data";
            $location = "Table Employee";
            if (Auth::guard('admin')->check()) {
                History::create([
                    'name' => Auth::guard('admin')->user()->username,
                    'position' => "Admin",
                    'section' => Auth::guard('admin')->user()->level,
                    'activity' => $activity,
                    'location_activity' => $location,
                ]);
            } else {
                return redirect('/error');
            }

            return redirect('/dashboard/employee')->with('success', 'Delete employee success');
        } else {
            return redirect('/dashboard/employee')->with('error', 'Delete employee failed');
        }
    }

    public function search(Request $request)
    {
        $title = "Master Data - Employee";
        //Check request from input for search
        if ($request->term) {
            //Get table that searched from request input
            $employee = DB::table('employees')->where('nip', 'Like', '%' . $request->term . '%')
                ->orWhere('name', 'Like', '%' . $request->term . '%')
                ->orWhere('section', 'Like', '%' . $request->term . '%')
                ->paginate();
        }
         //Read table employee for total
         $total = Employee::latest()->get();

         //Read for section
         $subsi = DB::table('subsis')->get();

        return view('dashboard.employee', ['employee' => $employee, 'title' => $title,'total'=>$total,'subsi'=>$subsi]);
    }
}
