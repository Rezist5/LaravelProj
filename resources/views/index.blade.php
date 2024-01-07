@extends('layout')

@section('main_content')
    @if($userType == 'student')
        @include('student')
    @elseif($userType == 'teacher')
        @include('teacher')
    @elseif($userType == 'admin')
        @include('admin')
    @endif
@endsection
