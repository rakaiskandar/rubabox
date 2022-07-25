<?php

namespace App\Http\Controllers;

use App\Models\History;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "History";
        $no = History::paginate(15);

        //Read table history by descending
        $history = History::latest()->paginate(20);
        return view('dashboard.history',['title'=>$title,'history'=>$history]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //Delete all row
        History::truncate();

        return redirect('/dashboard/history')->with('success','Delete success!');
    }
}
