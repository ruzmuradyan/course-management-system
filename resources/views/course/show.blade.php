@extends('Layouts.app')

@section('content')

    <h1>Title: {{$course->title}}</h1>
    <p>Instructor: {{$course->instructor}}</p>
    <p>CourseHead: {{$course->courseHead}}</p>

@endsection
