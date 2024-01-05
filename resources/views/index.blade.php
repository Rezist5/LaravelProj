@extends('layout')

@section('main_content')
    @if($userType == 'student')
        ALOOOOOOOOOOOOOOOOOOOO
        @include('student')
    @elseif($userType == 'Teacher')
        @include('teacher')
    @elseif($userType == 'Admin')
        @include('admin')
    @endif
@endsection
