<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;


class CourseController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        try {
            $courses = Course::all();
            if (empty($courses)) {
                throw new Exception();
            }
            Log::info('Fetching all courses', ['count' => count($courses)]);
            return CourseResource::collection($courses);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve courses', ['message' => $e->getMessage()]);
            //return response()->json(['error' => 'Failed to retrieve courses'], 500);
            throw new Exception('something went wrong');
        }
    }

    public function store(StoreCourseRequest $request): CourseResource|JsonResponse
    {
        try {
            $course = Course::create($request->all());
            Log::info('Course created', ['course_id' => $course->id]);
            return new CourseResource($course);
        } catch (\Exception $e) {
            Log::error('Failed to create course', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create course'], 500);
        }
    }

    public function show(int $id): CourseResource|JsonResponse
    {
        try {
            $course = Course::findOrFail($id);
            Log::info('Fetching course details', ['course_id' => $id]);
            return new CourseResource($course);
        } catch (\Exception $e) {
            Log::error('Failed to show course', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to show course'], 500);
        }

    }

    public function update(StoreCourseRequest $request, $id): CourseResource | JsonResponse
    {
        try {
            $course = Course::findOrFail($id);
            $course->update($request->all());
            Log::info('Course updated', ['course_id' => $course->id]);
            return new CourseResource($course);
        } catch (\Exception $e) {
            Log::error('Failed to update course', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to update course'], 500);
        }

    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Course::findOrFail($id)->delete();
            Log::info('Course deleted', ['course_id' => $id]);
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Failed to delete course', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to delete course'], 500);
        }
    }
}
