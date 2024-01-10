
<header>
        <h1>School Diary</h1> 
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Выйти из аккаунта</button>
        </form>
        <nav>
            <ul>
                @if($userType == 'admin')
                <li><a href="/">Главная</a></li>
                <li><a href="lessons">Расписание</a></li>
                <li><a href="AdminClasses">Классы</a></li>
                @endif
                @if($userType == 'teacher')
                <li><a href="/">Главная</a></li>
                <li><a href="lessons">Расписание</a></li>
                <li><a href="/TeacherTasks">Задания</a></li>
                @endif
                @if($userType == 'student')
                <li><a href="/">Главная</a></li>
                <li><a href="/StudentMarks">Оценки</a></li>
                <li><a href="lessons">Расписание</a></li>
                <li><a href="/StudentTasks">Задания</a></li>
                
                @endif
            </ul>
        </nav>
    </header>
