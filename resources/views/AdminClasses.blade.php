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
            <tr>
                @foreach($classes as $class)
                    <td>{{$class->ClassName}}</td>
                    <td>{{$class->grade}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
@endsection