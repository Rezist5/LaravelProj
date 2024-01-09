@section('main_content')
<main>

        <section class="news">
            <!-- Задания для выполнения -->
            <!-- Возможно, список заданий с названием, сроком сдачи, описанием -->
        </section>

        <section class="notVerifiedTasks">
    <h2>Grades</h2>
    @foreach($Tasks as $task)
            <tr>
            <td>{{ $task->student->name }} {{ $task->student->name }}</td>
                <td>
                <form action="{{ route('solution.download', ['StudentId' => $task->student->id]) }}" method="GET">                                       
                    <input type="hidden" name="lessonId" value="{{ $task->task->id }}">
                    <input type="submit" value="Download Solution">
                </form>
                <form action="{{ route('mark.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lessonId" value="{{ $task->task->id }}">
                    <input type="hidden" name="studentId" value="{{ $task->student->id }}">
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