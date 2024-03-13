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
         @endforeach
        <tr>
    </table>