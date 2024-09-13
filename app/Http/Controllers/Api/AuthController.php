<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //Register
    public function register(Request $request): JsonResponse
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json(['message' => 'User registered successfully.'], 200);
        } catch(\Exception $e) {
            Log::error('Registration failed',['error'=>$e->getMessage()]);
        return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }
    //User Login
    public function login(Request $request): JsonResponse
    {
        try{
            $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json(['token' => $token, 'token_type' => 'Bearer']);
        } catch(\Exception $e) {
            Log::error('Login failed',['error'=>$e->getMessage()]);
            return response()->json(['message' => 'Login failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try{
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully.'], 200);
        } catch(\Exception $e) {
            Log::error('Logout failed',['error'=>$e->getMessage()]);
            return response()->json(['message' => 'Logout failed', 'error' => $e->getMessage()], 500);
        }
    }

//    public function getCourses(Request $request)
//    {
//        try{
//            $user = Auth::user();
//            $courses = $user->courses;
//
//            Log::info('Fetching user courses', ['user_id' => $user->id, 'course_count' => count($courses)]);
//            return CourseResource::collection($courses);
//        } catch (\Exception $e) {
//            Log::error('Get user courses failed',['error'=>$e->getMessage()]);
//            return response()->json(['message' => 'Get user courses failed', 'error' => $e->getMessage()], 500);
//        }
//    }
}
