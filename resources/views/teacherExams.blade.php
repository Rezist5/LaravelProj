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
            <th>Длительность</th>
            <th>Дата проведения</th>
            <th>Решения</th>
        </tr>
        <tr>
        @foreach($exams as $exam)
            <td>{{$exam->Name}}</td>
            <td>{{ $exam->teacher->subject->name }}</td>
            <td>{{$exam->duration}}</td>
            <td>{{$exam->startDate}}</td>
            <td>{{$exam->date}}</td>
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
                                                $students = \App\Student::where('classId', $exam->classId)->get();
                                            @endphp
                                            @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->name }} {{ $student->Surname }}</td>
                                                <td>
                                                    <form action="{{ route('solution.exam.download', ['StudentId' => $student->id]) }}" method="GET">
                                                        
                                                        <input type="hidden" name="examId" value="{{ $exam->id }}">
                                                        <input type="submit" value="Download Solution">
                                                    </form>
                                                    <form action="{{ route('exam.mark.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="examId" value="{{ $exam->id }}">
                                                        <input type="hidden" name="studentId" value="{{ $student->id }}">
                                                        <input type="number" name="mark" placeholder="Оценка" min="1" max="{{ $exam->MaxMarkNumber}}"> / {{ $exam->MaxMarkNumber }}
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
         @endforeach
        <tr>
    </table>
    
    <h1>Создание контрольной работы</h1>
    <form action="{{route('create.exam')}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label for="class">Класс:</label>
        <select name="class" id="class" required>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->grade }} {{ $class->ClassName }}</option>
            @endforeach
        </select>
        <label for="Name">Название:</label>
        <input type="text" id="Name" min="1" max="10" name="Name" required><br><br>

        <label for="duration">Продолжительность (в часах):</label>
        <input type="number" id="duration" min="1" max="10" name="duration" required><br><br>

        <label for="startDate">Дата и время проведения:</label>
        <input type="datetime-local" id="startDate" name="startDate" required><br><br>

        <label for="startDate">Максимальная оценка:</label>
        <input type="number" id="MaxMarkNumber" name="MaxMarkNumber" required><br><br>

        <label for="examFile">Файл контрольной работы:</label>
        <input type="file" id="examFile" name="examFile" required><br><br>
        
        <button type="submit">Создать контрольную работу</button>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
    </form>

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