<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = DB::table('course')->get();
        return view('admin.courses.index', compact('courses'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::table('course')->insert($request->except('_token'));
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
    
    }

    public function edit($id)
    {
        $course = DB::table('course')->find($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        DB::table('course')->where('id', $id)->update($request->except('_token', '_method'));
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy($id)
    {
        DB::table('course')->where('id', $id)->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');
    }
}
