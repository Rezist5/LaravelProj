@extends('layout')
@include('header')
@section('main_content')
<form action="{{ route('lessons.by.date', ['date' => $selectedDate]) }}" method="GET">
    @csrf
    <input type="date" value="{{ $today }}" name="lesson_date" required>
    <button type="submit">Submit</button>
</form>
@if(isset($selectedDate))
<h3>Lessons for {{ $selectedDate }}</h3>
    <table>
        <thead>
            <tr>
                <th>Lesson Number</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Classroom</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->LessonNumber }}</td>
                    <td>{{ $lesson->teacher->subject->name }}</td>
                    <td>{{ $lesson->teacher->name }}</td>
                    <td>{{ $lesson->classroom }}</td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection