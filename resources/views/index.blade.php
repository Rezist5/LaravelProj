@extends('layout')

@section('main_content')
<main>
    <section class="schedule">
    <h2>School Schedule</h2>
    <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Time</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
            <!-- Пустая таблица для заполнения расписания -->
                <tr>
                    <td>Monday</td>
                    <td>08:00 AM</td>
                    <td>Mathematics</td>
                </tr>
                <tr>
                   <td>Tuesday</td>
                    <td>09:30 AM</td>
                    <td>Science</td>
               </tr>
                <!-- Добавьте остальные строки для других дней и уроков -->
            </tbody>
        </table>
    </section>

        <section class="assignments">
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
            <!-- Форма для создания нового задания -->
            <h2>Create New Task</h2>
            <form action="/add_task" method="post">
                <div>
                    <label for="taskName">Task Name:</label>
                    <input type="text" id="taskName" name="taskName" required>
                </div>
                <div>
                    <label for="deadline">Deadline:</label>
                    <input type="date" id="deadline" name="deadline" required>
                </div>
                <div>
                    <textarea id="taskDescription" name="taskDescription" placeholder="Task Description" required></textarea>
                </div>
                <div>
                    <input type="submit" value="Create Task">
                </div>
            </form>
        </section>
    </main>

@endsection

