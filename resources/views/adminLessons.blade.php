@extends('layout')
@include('header')
@section('main_content')
<form action="{{ route('lessons.by.date', ['date' => $selectedDate]) }}" method="GET">
    @csrf
    <input type="date" name="lesson_date" required>
    <button type="submit">Submit</button>
</form>
<h1>All Lessons for {{ $selectedDate }}</h1>

@foreach($lessons->groupBy('classId') as $classId => $classLessons)
    @php 
        $class = App\ClassTable::where('Id', $classId)->first(); 
    @endphp
    <h2>Class: {{ $class->ClassName }}</h2> 

    <table border="1">
        <thead>
            <tr>
                <th>Lesson Number</th>
                <th>Teacher</th>
                <th>Classroom</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classLessons as $lesson)
                <tr>
                    <td>{{ $lesson->LessonNumber }}</td>
                    <td>{{ $lesson->teacher->name }}</td>
                    <td>{{ $lesson->classroom }}</td>
                    <td>{{$lesson->teacher->subject->name}}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
@endsection