@extends('layouts.app')

@section('content')
    <h1>Courses</h1>
    <table>
        <thead>
        <tr>
            <th>Course Name</th>
            <th>Instructor</th>
            <th>Course Head</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->instructor }}</td>
                <td>{{ $course->courseHead }}</td>
                <td>
                    <a href="{{ route('course.show', $course->id) }}">View</a>
                    <a href="{{ route('course.edit', $course->id) }}">Edit</a>

                    <!-- Delete Form -->
                    <form method="post" action="{{ route('course.destroy', $course->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this course?');">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


