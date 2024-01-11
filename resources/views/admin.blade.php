@section('main_content')
<main>
    <section class="createLessons">
    <h2>Create Schebule</h2>
    <form action="{{ route('create.lessons') }}" method="POST">
    @csrf
    <input type="date" name="lesson_date" required>
    <table>
        <thead>
            <tr>
                <th>Teacher ID</th>
                <th>Class ID</th>
                <th>Classroom</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 1; $i <= 9; $i++)
            <tr>
                <td><input type="text" name="teacher_id_{{ $i }}" required></td>
                <td><input type="text" name="class_id_{{ $i }}" required></td>
                <td><input type="text" name="classroom_{{ $i }}" required></td>
            </tr>
            @endfor
        </tbody>
    </table>
    <button type="submit">Создать</button>
</form>
    </section>
<section class="CreateNews">
<h2>Create New News</h2>
    <form action="{{ route('createNews') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Заголовок:</label>
        <input type="text" id="title" name="title" required>
        <label for="description">Описание:</label>
        <textarea id="description" name="description" required></textarea>
        <label for="picture">Изображение:</label>
        <input type="file" id="picture" name="picture" accept="image/*" required>
        <button type="submit">Создать новость</button>
    </form>
</section>
<section class="SubjectCreate">
<h2>Create New Subject</h2>
<form method="POST" action="{{ route('subjects.create') }}">
    @csrf
    <label for="name">Название предмета:</label>
    <input type="text" id="name" name="name">
    <button type="submit">Создать предмет</button>
</form>
</section>
<section class="ClassCreate">
<h2>Create New Class</h2>
<form method="POST" action="{{ route('class.create') }}">
    @csrf
    <label for="name">Название класса:</label>
    <input type="text" id="name" name="name">
    <input type="number" step="1" id="grade" name="grade" >
    <button type="submit">Создать класс</button>
</form>
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
    </main>
@endsection