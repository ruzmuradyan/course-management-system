<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return CourseResource::collection($courses);
    }
//    public function create(){
//        return view('course.create');
//        //Routing to page/view which will hold the create form
//    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'courseHead' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $course = Course::create($request->all());
        return new CourseResource($course);
    }
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return new CourseResource($course);
    }
    //fetching the data from database
//    public function edit($id){
//        //edit the data
//        $course = Course::findOrFail($id);
//        return view('course.edit', compact('course'));
//    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'courseHead' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return new CourseResource($course);
    }
    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return response(null, 204);
    }
}
