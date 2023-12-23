@extends('layout')

@section('main_content')
<header>
    <h1>Schedule</h1>
    <nav>
        <ul>
            <li><a href="{{ route('schedule', ['date' => /* Дата предыдущей недели */]) }}">Предыдущая неделя</a></li>
            <li><a href="{{ route('schedule', ['date' => /* Дата следующей недели */]) }}">Следующая неделя</a></li>
        </ul>
    </nav>
</header>

<main>
    <section>
    @for($day = 1; $day <= 5; $day++)
        @php
            $lessonsForDay = $lessons->filter(function($lesson) use ($currentDate, $day) {
                return $lesson->LessonDate->format('N') == $day; 
            });
        @endphp

        @if($lessonsForDay->count() > 0)
            <h2>Расписание на {{ $currentDate->addDays($day - 1)->format('l') }}</h2>
            <table>
                <thead>
                    <tr>
                        <th>Номер пары</th>
                        <th>Предмет</th>
                        <th>Учитель</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessonsForDay as $lesson)
                        <tr>
                            <td>{{ $lesson->LessonNumber }}</td>
                            <td>{{ $lesson->teacher->subject->name }}</td>
                            <td>{{ $lesson->teacher->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endfor
    </section>
    <!-- Другие разделы вашей страницы, если они есть -->
</main>
@endsection
