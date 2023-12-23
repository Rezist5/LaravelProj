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
    <form action="{{ route('schedule.byDate') }}" method="GET">
        <label for="lessonDate">Выберите дату:</label>
        <input type="date" id="lessonDate" name="lessonDate">

        <button type="submit">Показать уроки</button>
    </form>
    </section>
</main>
@endsection
