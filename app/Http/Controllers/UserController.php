<?php

namespace App\Http\Controllers;

use App\AdminModel;
use App\Teacher;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function createUser(Request $request)
    {
    $userType = $request->input('userType');
    switch ($userType) {
        case 'student':
            return $this->createNewUserStudent($request);
            break;
        case 'teacher':
            return $this->createNewUserTeacher($request);
            break;
        case 'admin':
            return $this->createNewUserAdmin($request);
            break;
    }
    }

    public function createNewUserStudent(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->UserType = 'student';

        $data = [
            'name' => $request->input('studentName'),
            'Surname' => $request->input('studentSurname'),
            'Thirdname' => $request->input('studentThirdname'),
            'ClassId' => $request->input('classId'),
        ];

        $stud = Student::createStudent($data);

        $user->UserId = $stud->id;
        $user->save();
        return redirect()->back();
       
    }

    // Создание нового учителя
    public function createNewUserTeacher(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->UserType = 'teacher';

        $data = [
            'name' => $request->input('teacherName'),
            'Surname' => $request->input('teacherSurname'),
            'Thirdname' => $request->input('teacherThirdname'),
            'SubjectID' => $request->input('subjectId')
        ];

        $newTeacher = Teacher::createTeacher($data);

        $user->UserId = $newTeacher->id;
        $user->save();
        return redirect()->back();
    }

    // Создание нового админа
    public function createNewUserAdmin(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->UserType = 'admin';

        $data = [
            'name' => $request->input('adminName')
        ];

        $newAdmin = AdminModel::createAdmin($data);

        $user->UserId = $newAdmin->id;
        $user->save();
        return redirect()->back();
        
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
            TeacherModel::deleteTeacher($user->UserId);
        } elseif ($user->UserType == 'admin') {
            AdminModel::deleteAdmin($user->UserId);
        }
        $user->delete();

       
    }

    // Редактирование пользователя
    public function editUser(Request $request, $userId)
    {
        // Реализация редактирования пользователя
    }
}
