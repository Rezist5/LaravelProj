@section('main_content')

<main>
<section class="schedule">
        <h2><a href="lessons">Расписание</a></h2>
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
                    <td>{{ $lesson->teacher->name }} {{ $lesson->teacher->Surname }}</td>
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
    <div class="news-slider-container" id="newsSliderContainer">
    <div class="news-slider" id="newsSlider">
        @foreach($newsList as $news)
            <div class="news">
                <h3>{{ $news->title }}</h3>
                <p>{{ $news->description }}</p>
                <p>{{ $news->date }}</p>
                <img class="news-image" src="{{ Storage::url($news->PictureFilePath) }}" alt="{{ $news->title }}">
            </div>
        @endforeach
    </div>
</div>
</section>
<section class="grades">
    <h2><a href="/StudentMarks">Grades</a></h2>
    <div id="carouselGrades" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner grade-container">
        @foreach($marks as $mark)
                <div class="grade-block">
                    @if($mark->MarkNumber > 6)
                        <div class="grade-green">
                            <h3>{{ $mark->task->subjectName() }}</h3>
                            <h4>{{ $mark->MarkNumber }}</h4>
                        </div>
                    @elseif($mark->MarkNumber < 7 && $mark->MarkNumber > 4)
                        <div class="grade-orange">
                            <h3>{{ $mark->task->subject->name }}</h3>
                            <h4>{{ $mark->MarkNumber }}</h4>
                        </div>
                    @else
                        <div class="grade-red">
                            <h3>{{ $mark->task->id }}</h3>
                            <h4>{{ $mark->MarkNumber }}</h4>
                        </div>
                    @endif
                </div>
            
        @endforeach
    </div>
</div>
</section>

    <section class="taskShow">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
  const newsSliderContainer = document.getElementById('newsSliderContainer');
  const newsSlider = document.getElementById('newsSlider');

  let isScrolling = false;

  function scrollNews() {
    if (isScrolling) {
      const firstNews = newsSlider.firstElementChild;
      newsSlider.removeChild(firstNews);
      newsSlider.appendChild(firstNews);
      newsSlider.style.transform = 'translateY(0)';
      isScrolling = false;
    }
  }

  // Добавляем обработчик события при скроллинге
  newsSliderContainer.addEventListener('wheel', function() {
    isScrolling = true;
    scrollNews();
  });

  // Или используйте следующую строку, чтобы прокручивать новости через определенное время
  // setInterval(scrollNews, 3000);
});
</script>
@endsection