<?php

namespace App;
use App\AdminModel;
use App\TeacherModel;
use App\StudentModel;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    protected $table = 'User'; 

    protected $primaryKey = 'Id';

    protected $fillable = [
        'Id',
        'username',
        'password',
        'UserType',
        'UserId'
    ];

    public $timestamps = false; 

    private function CreateNewUserStudent($name, $password, $usid, $firstname, $surname, $thirdname, $avgmark, $classid, $grade)
    {
        $user = new User();
        $user->username = $name;
        $user->password = bcrypt($password);
        $user->UserType = 'student';    
    
        $data = [   
            'name' => $firstname,
            'Surname' => $surname,
            'Thirdname' => $thirdname,
            'AvgMark' => $avgmark,
            'ClassId' => $classid,
            'Grade' => $grade
        ];
            
            $stud = Student::createStudent($data);
        
        
        $user->UserId = $stud->id;
        $user->save();
    }
    private function CreateNewUserTeacher($name, $password, $usid, $firstname, $surname, $thirdname, $subId)
    {
        $user = new User();
        $user->username = $name;
        $user->password = bcrypt($password);
        $user->UserType = 'teacher';    
    
        $data = [
            'name' => $firstname,
            'Surname' => $surname,
            'Thirdname' => $thirdname,
            'SubjectID' => $subId 
        ];
            
        $newTeacher = Teacher::createTeacher($data);
        
        
        $user->UserId = $newTeacher->id;
        $user->save();
    }
    private function CreateNewUserAdmin($name, $password, $usid, $firstname)
    {
        $user = new User();
        $user->username = $name;
        $user->password = bcrypt($password);
        $user->UserType = 'admin';    
    
        $data = [
            'name' => $firstname,          
        ];
            
        $newTeacher = Admin::createTeacher($data);
        
        
        $user->UserId = $usid;
        $user->save();
    }
        
    private function AllUsers()
    {
        $users = User::all();
        return $users
    }
    private function DeleteUser($userId)
    {
        $user = User::find($userId);
        if ($user->UserType == 'student') {
            Student::deleteStudent($user->UserId);
        }
        else if ($user->UserType == 'teacher') {
            Teacher::deleteTeacher($user->UserId);
        }
        else if ($user->UserType == 'admin') {
            Admin::deleteAdmin($user->UserId);
        }
        $user->delete();
    }
    private function EditUser()
    {
        
    }
   
}