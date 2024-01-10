@section('main_content')
<main>



<section class="notVerifiedTasks">
    <h2>Not Verified</h2>
    @foreach($Tasks as $solTask)
            <tr>
            <td>{{ $solTask->student->name }} {{ $solTask->student->name }}</td>
                <td>
                <form action="{{ route('solution.download', ['StudentId' => $solTask->student->id]) }}" method="GET">                                       
                    <input type="hidden" name="lessonId" value="{{ $solTask->task->LessonID }}">
                    <input type="submit" value="Download Solution">
                </form>
                <form action="{{ route('mark.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lessonId" value="{{ $solTask->task->LessonID }}">
                    <input type="hidden" name="studentId" value="{{ $solTask->StudentId }}">
                    <input type="number" name="mark" placeholder="Оценка" min="1" max="10">
                    <button type="submit">Оценить</button>
                </form>
                @if($errors->any())
                    <div style="color: red;">{!! $errors->first('message') !!}</div>
                @endif
                </td>
            </tr>
        @endforeach
</section>

<section class="newShow">
    <h2>News</h2>
    <div class="news-slider">
        @foreach($newsList as $news)
            <div class="news-item">
                <h2>{{ $news->title }}</h2>
                <p>{{ $news->description }}</p>
                <img src="{{ asset('storage/' . $news->PictureFilePath) }}" alt="{{ $news->title }}">
            </div>
        @endforeach
    </div>
</section>
        <section class="new-task">
           
        <h2>Teacher Lessons</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Lesson Number</th>
                    <th>classroom</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->LessonDate }}</td>
                        <td>{{ $lesson->LessonNumber }}</td>
                        <td>{{ $lesson->classroom }}</td>
                    </tr>
                @endforeach  
            </tbody>
        </table>
        </section>
    </main>
    @endsection