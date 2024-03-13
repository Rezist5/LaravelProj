@extends('layout')
@include('header')
@section('main_content')
<a href="/teacher-exam" class="block py-2 pr-4 pl-3 text-gray-700 
                border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent 
                lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 
                lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white 
                lg:dark:hover:bg-transparent dark:border-gray-700">Экзамены
</a>
<form action="{{ route('lessons.by.date', ['date' => $selectedDate]) }}" method="GET">
    @csrf
    <input type="date" name="lesson_date" required>
    <button type="submit">Submit</button>
</form>

@if(isset($selectedDate))
<h3>Lessons for {{ $selectedDate }}</h3>
    <table>
        <thead>
            <tr>
                <th>Lesson Number</th>  
                <th>ClassId</th>
                <th>Classroom</th>
                <th>Upload Task</th>
                <th>Download Solution</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->LessonNumber }}</td>
                    <td>{{ $lesson->classId }}</td>
                    <td>{{ $lesson->classroom }}</td>
                    <td>
                        <form action="{{ route('task.upload', ['lessonId' => $lesson->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="taskFile" >
                            <input type="hidden" name="lessonId" value="{{ $lesson->id }}">
                            <input type="hidden" name="classId" value="{{ $lesson->classId }}">
                            <input type="date" name="deadline">
                            <input type="submit" value="Upload Task">
                        </form>
                    </td>
                    <td>
                    <button type="button" data-toggle="modal" data-target="#studentsModal">
                        Проверить
                    </button>
                    <div class="modal fade" id="studentsModal" tabindex="-1" role="dialog" aria-labelledby="studentsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="studentsModalLabel">Список учеников</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Таблица с учениками -->
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Имя ученика</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $students = \App\Student::where('classId', $lesson->classId)->get();
                                            @endphp
                                            @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->name }} {{ $student->Surname }}</td>
                                                <td>
                                                    <form action="{{ route('solution.download', ['StudentId' => $student->id]) }}" method="GET">
                                                        
                                                        <input type="hidden" name="lessonId" value="{{ $lesson->id }}">
                                                        <input type="submit" value="Download Solution">
                                                    </form>
                                                    <form action="{{ route('mark.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="lessonId" value="{{ $lesson->id }}">
                                                        <input type="hidden" name="studentId" value="{{ $student->id }}">
                                                        <input type="number" name="mark" placeholder="Оценка" min="1" max="10">
                                                        <button type="submit">Оценить</button>
                                                    </form>
                                                    @if($errors->any())
                                                        <div style="color: red;">{!! $errors->first('message') !!}</div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>    
                    </td>
                </tr>
            @endforeach


<!-- Модальное окно -->
        
        </tbody>
    </table>
@endif
@endsection