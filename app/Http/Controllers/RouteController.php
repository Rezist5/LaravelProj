<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScheduleController;
use App\Student;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $userType = Auth::user()->UserType;
                
        $scheduleController = new ScheduleController();
        $taskController = new TaskController();
        $todayLessons = $scheduleController->getLessonsForToday();
        $today = now()->toDateString(); 
        if($userType == 'student')
        {
            $stud = Student::where('Id', Auth::user()->UserId)->first();
            $top3Tasks = $taskController->getTop3Tasks($stud->ClassId);
            return view('index', ['today'=> $today ,'userType' => $userType, 'lessons' => $todayLessons, 'tasks' => $top3Tasks ]);
        }
        return view('index', ['today'=> $today ,'userType' => $userType, 'lessons' => $todayLessons]);
    }
    public function StudentTasks()
    {              
        $scheduleController = new ScheduleController();
        $taskController = new TaskController();
        $todayLessons = $scheduleController->getLessonsForToday();
        $today = now()->toDateString(); 
        
        $stud = Student::where('Id', Auth::user()->UserId)->first();
        $Tasks = $taskController->getAllTasks($stud->ClassId);
        return view('StudentTasks', ['today'=> $today ,'tasks' => $Tasks ]);
        
    }
    public function lessons()
    {
        
        $userType = Auth::user()->UserType;        
        $scheduleController = new ScheduleController();
        $taskController = new TaskController();
        $request = new Request(['lesson_date' => now()->toDateString()]);
        return $scheduleController->getLessonsByDate($request);
    }

}
