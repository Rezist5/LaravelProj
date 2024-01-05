@section('main_content')
<main>

        <section class="news">
            <!-- Задания для выполнения -->
            <!-- Возможно, список заданий с названием, сроком сдачи, описанием -->
        </section>

<section class="UserCreate">
    <h2>Create New User</h2>
<form action="{{ route('create-user') }}" method="POST">
    @csrf
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" >
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" >
    </div>
    <div>
        <label for="userType">User Type:</label>
        <select id="userType" name="userType" onchange="showFields(this.value)">
            <option value="admin">Admin</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
    </div>
    <div id="adminFields" style="display: none;">
        <label for="adminName">Admin Name:</label>
        <input type="text" id="adminName" name="adminName">
    </div>
    <div id="studentFields" style="display: none;">
        <label for="studentName">Student Name:</label>
        <input type="text" id="studentName" name="studentName" >

        <label for="studentSurname">Student Surname:</label>
        <input type="text" id="studentSurname" name="studentSurname" >

        <label for="studentThirdname">Student Third Name:</label>
        <input type="text" id="studentThirdname" name="studentThirdname" >

        <label for="avgMark">Average Mark:</label>
        <input type="number" step="0.01" id="avgMark" name="avgMark" >

        <label for="classId">Class ID:</label>
        <input type="number" id="classId" name="classId" >
    </div>
    <div id="teacherFields" style="display: none;">
        <label for="teacherName">Teacher Name:</label>
        <input type="text" id="teacherName" name="teacherName" >

        <label for="teacherSurname">Teacher Surname:</label>
        <input type="text" id="teacherSurname" name="teacherSurname" >

        <label for="teacherThirdname">Teacher Third Name:</label>
        <input type="text" id="teacherThirdname" name="teacherThirdname" >

        <label for="subjectId">Subject ID:</label>
        <input type="number" id="subjectId" name="subjectId" >
    </div>
    <div>
    <button type="submit">Craete User</button>
    </div>
</form>

<script>
    function showFields(userType) {
        document.getElementById('adminFields').style.display = userType === 'admin' ? 'block' : 'none';
        document.getElementById('studentFields').style.display = userType === 'student' ? 'block' : 'none';
        document.getElementById('teacherFields').style.display = userType === 'teacher' ? 'block' : 'none';
    }
</script>
</section>




        <section class="new-task">
           
            <h1>{{ $userType }}</h1>
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