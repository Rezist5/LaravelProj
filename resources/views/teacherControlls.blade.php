@extends('layout')
@include('header')
@section('main_content')
<h1>Контрольные работы</h1>
    <h2>Фильтры:</h2>
    <p>Предмет: <select id="subjectFilter"></select></p>
    <p>Класс: <select id="classFilter"></select></p>
    <p>Дата: <input type="date" id="dateFilter"></p>
    <table>
        <tr>
            <th>Название работы</th>
            <th>Предмет</th>
            <th>Класс</th>
            <th>Дата проведения</th>
            <th>Учеников назначено</th>
        </tr>
        <!-- Тут будут данные о контрольных работах -->
    </table>
    <button onclick="location.href='#'">Добавить новую контрольную работу</button>
</body>
@endsection