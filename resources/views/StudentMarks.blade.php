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
                                @if($mark->MarkNumber > 6)
                                    <div class="grade-block-markonly grade-green">
                                        <h4>{{ $mark->MarkNumber }}</h4>
                                    </div>
                                @elseif($mark->MarkNumber < 7 && $mark->MarkNumber > 4)
                                    <div class="grade-block-markonly grade-orange">
                                        <h4>{{ $mark->MarkNumber }}</h4>
                                    </div>
                                @else
                                    <div class="grade-block-markonly grade-red">
                                        <h4>{{ $mark->MarkNumber }}</h4>
                                    </div>
                                @endif
                        
                    @endforeach
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
@endsection
