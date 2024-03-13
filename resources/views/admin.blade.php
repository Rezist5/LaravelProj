@section('main_content')
<main>
<section class="createLessons">
    <h2>Create Schedule</h2>
    <form action="{{ route('create.lessons') }}" method="POST">
        @csrf
        <label for="lesson_day">Select Day of the Week:</label>
        <select name="lesson_day" id="lesson_day" required>
            <option value="1">Monday</option>
            <option value="2">Tuesday</option>
            <option value="3">Wednesday</option>
            <option value="4">Thursday</option>
            <option value="5">Friday</option>
        </select>

        <label for="lesson_month">Select Month:</label>
        <select name="lesson_month" id="lesson_month" required>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <label for="selected_class">Select Class:</label>
        <select name="selected_class" id="selected_class" required>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->grade }} {{ $class->ClassName }}</option>
            @endforeach
        </select>
        
        <table>
            <thead>
                <tr>
                    <th>Subject</th>                  
                    <th>Teacher</th>
                    <th>Classroom</th>
                </tr>
            </thead>
            <tbody>
            @for($i = 1; $i <= 9; $i++)
                <tr>
                    <td>
                        <select name="subject_name_{{ $i }}"  class= "subject-select"required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }} </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="teacher_name_{{ $i }}"   class="teacher-select" required>
                            @foreach($teachers as $teacher)
                                <option value="{{ $subject->id }}">{{ $subject->name }} </option>
                            @endforeach
                        </select>
                    </td>                   
                    <td>
                        <input type="text" name="classroom_{{ $i }}" >
                        @error("classroom_$i")
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
        
        @if($errors->has('common'))
            <div class="error">
                {{ $errors->first('common') }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</section>
<section class="CreateNews">
<h2>Create New News</h2>
    <form action="{{ route('createNews') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="title">Заголовок:</label>
        <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
        <label for="description">Описание:</label>
        <textarea id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
        <label for="picture">Изображение:</label>
        <input type="file" id="picture" name="picture" accept="image/*" required>
        </div>
        <button type="submit"  class="btn btn-primary">Создать новость</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</section>
<section class="SubjectCreate">
<h2>Create New Subject</h2>
<form method="POST" action="{{ route('subjects.create') }}">
    @csrf
    <label for="name">Название предмета:</label>
    <input type="text" id="name" name="name" >
    <button type="submit" class="btn btn-primary">Создать предмет</button>
</form>
</section>
<section class="ClassCreate">  
<h2>Create New Class</h2>
<form method="POST" action="{{ route('class.create') }}">
    @csrf
    <label for="name">Название класса:</label>
    <input type="text" id="name" name="name" required>
    <label for="name">Класс:</label>
    <input type="number" step="1" min="1" max="12" id="grade" name="grade" required>
    <button type="submit" class="btn btn-primary">Создать класс</button>
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
    <button type="submit" class="btn btn-primary">Craete User</button>
    @error('common-error')
                <span class="error">{{ $message }}</span>
            @enderror
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.subject-select').change(function() {
            var subjectId = $(this).val();
            var selectElement = $(this).closest('tr').find('.teacher-select');
            // Очищаем список учителей
            selectElement.empty();
            // Запрашиваем учителей с помощью AJAX
            $.ajax({
                url: '/get-teachers/' + subjectId, // Путь к маршруту, который вернет учителей для выбранного предмета
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Добавляем опции учителей в список
                    $.each(response.teachers, function(index, teacher) {
                        selectElement.append('<option value="' + teacher.id + '">' + teacher.name + '</option>');
                    });
                }
            });
        });
    });
    function showFields(userType) {
        document.getElementById('adminFields').style.display = userType === 'admin' ? 'block' : 'none';
        document.getElementById('studentFields').style.display = userType === 'student' ? 'block' : 'none';
        document.getElementById('teacherFields').style.display = userType === 'teacher' ? 'block' : 'none';
    }
</script>
</section>
    </main>
@endsection