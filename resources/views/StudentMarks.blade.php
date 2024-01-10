@extends('layout')
@include('header')
@section('main_content')
<h1>Student Marks</h1>
    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marksBySubject as $subject => $marks)
                <tr>
                    <td>{{ $subject }}</td>
                    <td>
                        @foreach($marks as $mark)
                            {{ $mark->MarkNumber }} 
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
