@extends('layout')
@include('header')
@section('main_content')
    <h1>Classes</h1>
    <table>
        <thead>
            <tr>
                <th>Class</th>
                <th>Grade</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
                <td>$class->ClassName</td>
                <td>$class->grade</td>
            @endforeach
        </tbody>
    </table>
@endsection