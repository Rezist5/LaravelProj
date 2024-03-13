@extends('layout')
@include('header')
@section('main_content')
<h1>Контрольные работы</h1>
    <h2>Фильтры:</h2>
    <p>Предмет:
    <select id="subjectFilter">
            <option value="">Выберите предмет</option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>
    </p>
    <p>Класс:
        <select id="classFilter">
            <option value="">Выберите класс</option>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}">{{ $class->grade }}{{ $class->ClassName }}</option>
            @endforeach
        </select>
    </p>
    <p>Дата: <input type="date" id="dateFilter"></p>
    <table id="examTableBody">
        <tr>
            <th>Название работы</th>
            <th>Предмет</th>
            <th>Класс</th>
            <th>Дата проведения</th>
            <th>Учеников назначено</th>
        </tr>
        @foreach($exams as $exam)
        <tr>
            <td>{{$exam->Name}}</td>
            <td>{{ $exam->teacher->subject->name }}</td>
            <td>{{ $exam->class->ClassName }}</td>
            <td>{{$exam->startDate}}</td>
            <td>{{$exam->students->count()}}</td>
        </tr>
        @endforeach
    </table>

<script>
    // Функция для загрузки данных по AJAX и обновления таблицы
    function loadFilteredExams() {
        var subject = document.getElementById('subjectFilter').value;
        var classId = document.getElementById('classFilter').value;
        var date = document.getElementById('dateFilter').value;

        
        axios.get('/load-exams', {
             params: {
                 subject: subject,
                 classId: classId,
                 date: date
             }
         })
         .then(function (response) {
             // Обновить таблицу с новыми данными
             document.getElementById('examTableBody').innerHTML = response.data;
         })
         .catch(function (error) {
             console.error('Ошибка загрузки данных:', error);
         });
    }

    // Обработчики событий изменения значений в полях фильтров
    document.getElementById('subjectFilter').addEventListener('change', loadFilteredExams);
    document.getElementById('classFilter').addEventListener('change', loadFilteredExams);
    document.getElementById('dateFilter').addEventListener('change', loadFilteredExams);

    // При загрузке страницы сразу загрузить данные с текущими значениями фильтров
    loadFilteredExams();
</script>
@endsection