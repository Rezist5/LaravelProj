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
    
    <h1>Создание контрольной работы</h1>
    <form action="{{route('create.exam')}}" method="POST">
        @csrf
        <label for="subject">Предмет:</label>
        <select id="subject" name="subject">
            <!-- Вставьте опции предметов здесь -->
        </select><br><br>
        
        <label for="class">Класс:</label>
        <select name="selected_class" id="selected_class" required>
            <!-- Populate options based on your class data -->
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->grade }} {{ $class->ClassName }}</option>
            @endforeach
        </select>
        
        <label for="duration">Продолжительность:</label>
        <input type="text" id="duration" name="duration"><br><br>
        
        <label for="startDate">Дата проведения:</label>
        <input type="date" id="startDate" name="startDate"><br><br>
        
        <label for="examFile">Файл контрольной работы:</label>
        <input type="file" id="examFile" name="examFile"><br><br>
        
        <button type="submit">Создать контрольную работу</button>
    </form>
@endsection