@extends('layout')
@include('header')
@section('main_content')
<h2>Not Verified</h2>
<a href="/teacher-exam" class="block py-2 pr-4 pl-3 text-gray-700 
                border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent 
                lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 
                lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white 
                lg:dark:hover:bg-transparent dark:border-gray-700">Экзамены
</a>
@foreach($tasks as $solTask)
    <div class="task-item">
        <p>{{ $solTask->student->name }} {{ $solTask->student->name }}</p>
        <div class="task-actions">
            <form action="{{ route('solution.download', ['StudentId' => $solTask->student->id]) }}" method="GET">                                       
                <input type="hidden" name="taskId" value="{{ $solTask->task->id }}">
                <input type="submit" value="Download Solution">
            </form>
            <form action="{{ route('mark.store') }}" method="POST">
                @csrf
                <input type="hidden" name="taskId" value="{{ $solTask->task->id }}">
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