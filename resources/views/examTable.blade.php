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