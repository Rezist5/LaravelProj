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
        <section class="new-task">
           
        <h2>Teacher Lessons</h2>
        <table>
            <thead>
                <tr>
                    <th>Class</th>
                    <th>Lesson Number</th>
                    <th>classroom</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->class->grade }} {{ $lesson->class->ClassName }} </td>
                        <td>{{ $lesson->LessonNumber }}</td>
                        <td>{{ $lesson->classroom }}</td>
                    </tr>
                @endforeach  
            </tbody>
        </table>
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