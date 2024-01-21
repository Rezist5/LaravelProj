<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScheduleController;
use App\Student;
use App\ClassTable;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $userType = Auth::user()->UserType;
                
        $scheduleController = new ScheduleController();
        $taskController = new TaskController();
        $newsController = new NewsController();
        $todayLessons = $scheduleController->getLessonsForToday();
        $today = now()->toDateString(); 
        $news = $newsController->getNews();
        $markcontroller = new MarkController();
        if($userType == 'student')
        {
            $stud = Student::where('Id', Auth::user()->UserId)->first();
            $marks = $markcontroller->getLastMarks();
            $top3Tasks = $taskController->getTop3Tasks($stud->ClassId);
           
            return view('index', ['today'=> $today ,'userType' => $userType, 'lessons' => $todayLessons, 'tasks' => $top3Tasks, 'marks' => $marks, 'newsList' => $news ]);
        }
        else if($userType == 'teacher')
        {
            $Tasks = $taskController->getUnverifiedTasks();
            return view('index', ['today'=> $today ,'userType' => $userType, 'lessons' => $todayLessons, 'Tasks' => $Tasks, 'newsList' => $news ]);
        }
        return view('index', ['today'=> $today ,'userType' => $userType, 'lessons' => $todayLessons]);
    }
    public function StudentTasks()
    {              
        $scheduleController = new ScheduleController();
        $taskController = new TaskController();
        $todayLessons = $scheduleController->getLessonsForToday();
        $today = now()->toDateString(); 
        $userType = Auth::user()->UserType;
        $stud = Student::where('Id', Auth::user()->UserId)->first();
        $Tasks = $taskController->getAllTasks($stud->ClassId);
        return view('StudentTasks', ['today'=> $today ,'tasks' => $Tasks, 'userType' => $userType]);
        
    }
    public function TeacherTasks()
    {              
        $taskController = new TaskController();
        $userType = Auth::user()->UserType;
        $teach = Teacher::where('Id', Auth::user()->UserId)->first();
        $Tasks = $taskController->getAllUnverifiedTasks();
        return view('TeacherTasks   ', ['tasks' => $Tasks, 'userType' => $userType ]);
        
    }
    public function AdminClasses()
    {          
        $userType = Auth::user()->UserType;    
        $classes = ClassTable::orderby('grade', 'asc')->get();
        return view('AdminClasses   ', ['classes' => $classes, 'userType' => $userType ]);
        
    }
    public function StudentMarks()
    {              
        $userType = Auth::user()->UserType;
        $markcontroller = new MarkController();
        $marksBySubject = $markcontroller->getMarksBySubject();
        return view('StudentMarks', ['marksBySubject' => $marksBySubject, 'userType' => $userType ]);
        
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
