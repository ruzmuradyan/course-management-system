<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function index(){
        $courses = Course::all();
        return view('course.index', compact('courses'));
    }
    public function create(){
        return view('course.create');
        //Routing to page/view which will hold the create form
    }
    public function store(Request $request){
        //This will create the entry for the course
        Course::create($request->all());
        return redirect()->route('course.index');
    }
    public function show($id){
        $course = Course::findOrFail($id);
        return view('course.show', compact('course'));
    }
        //fetching the data from database
    public function edit($id){
        //edit the data
        $course = Course::findOrFail($id);
        return view('course.edit', compact('course'));
    }
    public function update(Request $request, $id){
        //Logic to update the record in the database and do something post that
//        Course::find($id)->update($request->all());
//        return redirect()->route('course.index');
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return redirect()->route('course.index');
    }
    public function destroy($id){
        Course::destroy($id);
        return redirect()->route('course.index');
    }
}

