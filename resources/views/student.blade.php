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
        <section class="news">
            <!-- Задания для выполнения -->
            <!-- Возможно, список заданий с названием, сроком сдачи, описанием -->
        </section>

<section class="grades">
    <h2>Grades</h2>
    <div id="carouselGrades" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-caption">
                    <h3>Grade 1</h3>
                    <h2>Math</h2>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-caption">
                    <h3>Grade 2</h3>
                    <h2>Rus Lang</h2>
                </div>
            </div>
            
            <div class="carousel-item">
                <div class="carousel-caption">
                    <h3>Grade 3</h3>
                    <h2>Chemitry</h2>
                </div>
            </div>
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
    <h2>Tasks</h2>
    <div>
        @foreach($tasks as $task)
            <div>
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->description }}</p>
                <form action="{{ route('upload.solution') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <input type="hidden" name="task_id" value="{{ $task->Id }}">
                    <button type="submit">Загрузить решение</button>
                </form>
            </div>
        @endforeach
    </div>
    </section>
</main>
@endsection