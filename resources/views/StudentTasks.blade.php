@extends('layout')
@include('header')
@section('main_content')
<div>
<h2>Задания</h2>
    @foreach($tasks as $task)
        @if (!$task->verified && strtotime($task->deadline) > strtotime('today'))
            <div style="background-color: blue;">
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->deadline }}</p>
                <form action="{{ route('solution.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <input type="hidden" name="taskId" value="{{ $task->Id }}">
                    <button type="submit">Загрузить решение</button>
                </form>
                <form action="{{ route('task.download') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="taskId" value="{{ $task->Id }}">
                    <button type="submit">Скачать задание</button>
                </form>
            </div>
        @endif
    @endforeach
</div>

<!-- Просроченные задания -->
<div>
    <h2>Просроченные задания</h2>
    @foreach($tasks as $task)
        @if (strtotime($task->deadline) < strtotime('today'))
            <div style="background-color: red;">
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->deadline }}</p>
                <form action="{{ route('solution.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <input type="hidden" name="taskId" value="{{ $task->Id }}">
                    <button type="submit">Загрузить решение</button>
                </form>
                <form action="{{ route('task.download') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="taskId" value="{{ $task->Id }}">
                    <button type="submit">Скачать задание</button>
                </form>
            </div>
        @endif
    @endforeach
</div>

<!-- Подтвержденные задания -->
<div>
<h2>Подтвержденные задания</h2>
    @foreach($tasks as $task)
        @if ($task->verified)
            <div style="background-color: green;">
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->deadline }}</p>
                <form action="{{ route('solution.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <input type="hidden" name="taskId" value="{{ $task->Id }}">
                    <button type="submit">Загрузить решение</button>
                </form>
                <form action="{{ route('task.download') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="taskId" value="{{ $task->Id }}">
                    <button type="submit">Скачать задание</button>
                </form>
            </div>
        @endif
    @endforeach
</div>
@endsection