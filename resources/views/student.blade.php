@section('main_content')

<main>
<section class="schedule">
        <h2>Расписание</h2>
        <table>
            <thead>
                <tr>
                    <th>№</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Classroom</th>

                </tr>
            </thead>
            <tbody>
            @for($i = 1; $i <= 9; $i++)
            @php
                $lesson = $lessons->firstWhere('LessonNumber', $i);
            @endphp
            <tr>
                <td>{{ $i }}</td>
                @if($lesson)
                    <td>{{ $lesson->teacher->subject->name }}</td>
                    <td>{{ $lesson->teacher->name }}</td>
                    <td>{{ $lesson->classroom }}</td>
                @else
                    <td></td>
                    <td></td>
                    <td></td>
                @endif
            </tr>
        @endfor
            </tbody>
        </table>
    </section>

<section class="newShow">
    <h2>News</h2>
    <div class="news-slider">
        @foreach($newsList as $news)
            <div class="news-item">
                <h2>{{ $news->title }}</h2>
                <p>{{ $news->description }}</p>
                <p>{{ $news->date }}</p>
                <img src="storage\app\news_images\1.jpg" alt="{{ $news->Title }}">
            </div>
        @endforeach
    </div>
</section>
<section class="grades">
    <h2>Grades</h2>
    <div id="carouselGrades" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Здесь будут ваши оценки -->
            @foreach($marks as $mark)
            @if($mark->MarkNumber > 6)
                <div class="carousel-item ">
                    <div class="carousel-caption">
                        <div class="grade-block grade-green">
                            <h3>{{$mark->subject->name}}</h3>
                            <h4>{{$mark->MarkNumber}}</h4>
                        </div>
                    </div>
                </div>
            @endif
            @if($mark->MarkNumber < 7 && $mark->MarkNumber > 4)
                <div class="carousel-item">
                    <div class="carousel-caption">
                        <div class="grade-block grade-orange">
                            <h3>{{$mark->subject->name}}</h3>
                            <h4>{{$mark->MarkNumber}}</h4>
                        </div>
                    </div>
                </div>
            @endif
            @if($mark->MarkNumber < 5)
                <div class="carousel-item">
                    <div class="carousel-caption">
                        <div class="grade-block grade-red">
                            <h3>{{$mark->subject->name}}</h3>
                            <h4>{{$mark->MarkNumber}}</h4>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
            
            </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGrades" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselGrades" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

    <section class="taskShow">
    <h1>{{ $userType }}</h1>
    <h2><a href="/StudentTasks">Tasks</a></h2>
    <div>
        @foreach($tasks as $task)
            <div>
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->deadline }}</p>
                <form action="{{ route('solution.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <input type="hidden" name="taskId" value="{{ $task->id }}">
                    <button type="submit">Загрузить решение</button>
                </form>
                <form action="{{ route('task.download') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="taskId" value="{{ $task->id }}">
                    <button type="submit">Скачать задание</button>
                </form>
            </div>
        @endforeach
    </div>
    </section>
</main>
@endsection