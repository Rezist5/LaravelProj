<?php

namespace App\Http\Controllers;

use App\AdminModel;
use App\TeacherModel;
use App\StudentModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Создание нового студента
    public function createNewUserStudent(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->UserType = 'student';

        $data = [
            'name' => $request->input('name'),
            'Surname' => $request->input('surname'),
            'Thirdname' => $request->input('thirdname'),
            'AvgMark' => $request->input('avgmark'),
            'ClassId' => $request->input('classid'),
            'Grade' => $request->input('grade')
        ];

        $stud = Student::createStudent($data);

        $user->UserId = $stud->id;
        $user->save();

       
    }

    // Создание нового учителя
    public function createNewUserTeacher(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->UserType = 'teacher';

        $data = [
            'name' => $request->input('name'),
            'Surname' => $request->input('surname'),
            'Thirdname' => $request->input('thirdname'),
            'SubjectID' => $request->input('subjectid')
        ];

        $newTeacher = Teacher::createTeacher($data);

        $user->UserId = $newTeacher->id;
        $user->save();

    }

    // Создание нового админа
    public function createNewUserAdmin(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->UserType = 'admin';

        $data = [
            'name' => $request->input('name')
        ];

        $newAdmin = Admin::createAdmin($data);

        $user->UserId = $newAdmin->id;
        $user->save();

        
    }

    // Получение всех пользователей
    public function getAllUsers()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    // Удаление пользователя
    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user->UserType == 'student') {
            Student::deleteStudent($user->UserId);
        } elseif ($user->UserType == 'teacher') {
            Teacher::deleteTeacher($user->UserId);
        } elseif ($user->UserType == 'admin') {
            Admin::deleteAdmin($user->UserId);
        }
        $user->delete();

       
    }

    // Редактирование пользователя
    public function editUser(Request $request, $userId)
    {
        // Реализация редактирования пользователя
    }
}
