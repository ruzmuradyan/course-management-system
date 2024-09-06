<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/add', [CourseController::class, 'create'])->name('course.create');
Route::post('/course', [CourseController::class, 'store'])->name('course.store');

Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
Route::put('/course/{course}', [CourseController::class, 'update'])->name('course.update');

Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');
