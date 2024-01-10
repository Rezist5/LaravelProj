@extends('layout')
@include('header')
@section('main_content')
<h2>Not Verified</h2>
@foreach($Tasks as $solTask)
    <div class="task-item">
        <p>{{ $solTask->student->name }} {{ $solTask->student->name }}</p>
        <div class="task-actions">
            <form action="{{ route('solution.download', ['StudentId' => $solTask->student->id]) }}" method="GET">                                       
                <input type="hidden" name="lessonId" value="{{ $solTask->task->LessonID }}">
                <input type="submit" value="Download Solution">
            </form>
            <form action="{{ route('mark.store') }}" method="POST">
                @csrf
                <input type="hidden" name="lessonId" value="{{ $solTask->task->LessonID }}">
                <input type="hidden" name="studentId" value="{{ $solTask->StudentId }}">
                <input type="number" name="mark" placeholder="Оценка" min="1" max="10">
                <button type="submit">Оценить</button>
            </form>
        </div>
        @if($errors->any())
            <div class="error-message">{{ $errors->first('message') }}</div>
        @endif
    </div>
@endforeach
@endsection