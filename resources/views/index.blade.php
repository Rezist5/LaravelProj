@extends('layout')

@section('main_content')
    @if($userType === 'Student')
        @include('student')
    @elseif($userType === 'Teacher')
        @include('teacher')
    @elseif($userType === 'Admin')
        @include('admin')
    @endif
@endsection
