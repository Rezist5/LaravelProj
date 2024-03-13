@extends('layout')
@include('header')
@section('main_content')
<div>
<a href="/student-exam" class="block py-2 pr-4 pl-3 text-gray-700 
                border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent 
                lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 
                lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white 
                lg:dark:hover:bg-transparent dark:border-gray-700">Экзамены
</a>
<h2>Фильтры:</h2>
<p>Предмет:
    <select id="subjectFilter">
        <option value="">Выберите предмет</option>
        @foreach ($subjects as $subject)
        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
        @endforeach
    </select>
</p>
<p>Дата: <input type="date" id="dateFilter"></p>
<div id="taskTableBody">
    <div>
    <h2>Задания:</h2>
            @php
                $flag = true;
            @endphp
        @foreach($tasks as $task)
            @if (!$task->downloaded && strtotime($task->deadline) > strtotime('today'))
                <div style="background-color: blue;">
                    <h3>Предмет: {{ $task->TaskTeacher()->subject->name }}</h3>
                    <p>Сдать до: {{ $task->deadline }}</p>
                    <p>Учитель: {{ $task->TaskTeacher()->name }} {{ $task->TaskTeacher()->Surname }}</p>
                    <form action="{{ route('solution.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file">
                        <input type="hidden" name="taskId" value="{{ $task->id }}">
                        <button type="submit">Загрузить решение</button>
                    </form>
                    <form action="{{ route('task.download') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="taskId" value="{{ $task->id }}">
                        <button type="submit">Скачать задание</button>
                    </form>
                </div>
            @php
                $flag = false;
            @endphp
            @endif
        @endforeach
            @if ($flag)
                <p>Нет заданий</p>
            @endif
            @php
                $flag = true;
            @endphp
    </div>

    <!-- Просроченные задания -->
    <div>
        <h2>Просроченные задания:</h2>
        @foreach($tasks as $task)
            @if (!$task->downloaded && strtotime($task->deadline) < strtotime('today'))
                <div style="background-color: red;">
                    <h3>Предмет: {{ $task->TaskTeacher()->subject->name }}</h3>
                    <p>Сдать до: {{ $task->deadline }}</p>
                    <p>Учитель: {{ $task->TaskTeacher()->name }} {{ $task->TaskTeacher()->Surname }}</p>
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
            @php
                $flag = false;
            @endphp
            @endif
        @endforeach
            @if ($flag)
                <p>Нет заданий</p>
            @endif
            @php
                $flag = true;
            @endphp
    </div>

    <!-- Подтвержденные задания -->
    <div>
    <h2>Подтвержденные задания:</h2>
        @foreach($solutions as $task)
        @if ($task->task != null)
            @if ($task->verified)
                <div style="background-color: green;">  
                    
                    <h3>Предмет: {{ $task->task->TaskTeacher()->subject->name }}</h3>
                    <p>Сдать до: {{ $task->task->deadline }}</p>
                    <p>Учитель: {{ $task->task->TaskTeacher()->name }} {{ $task->task->TaskTeacher()->Surname }}</p>
                    <p>Оценка: {{ $task->getMark()->MarkNumber }}</p>
                </div>
            @php
                $flag = false;
            @endphp
            @endif
         @endif
        @endforeach
            @if ($flag)
                <p>Нет заданий</p>
            @endif
            @php
                $flag = true;
            @endphp
    </div>
</div>

<script>
function loadFilteredTasks() {
    var subject = document.getElementById('subjectFilter').value;
    var date = document.getElementById('dateFilter').value;

    axios.get('/load-tasks', {
            params: {
                subject: subject,
                date: date
            }
        })
        .then(function(response) {
            // Обновить таблицу с новыми данными
            document.getElementById('taskTableBody').innerHTML = response.data;
        })
        .catch(function(error) {
            console.error('Ошибка загрузки данных:', error);
        });
}

// Обработчики событий изменения значений в полях фильтров
document.getElementById('subjectFilter').addEventListener('change', loadFilteredTasks);
document.getElementById('dateFilter').addEventListener('change', loadFilteredTasks);

// При загрузке страницы сразу загрузить данные с текущими значениями фильтров
loadFilteredTasks();
</script>
@endsection