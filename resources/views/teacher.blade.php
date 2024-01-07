@section('main_content')
<main>

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