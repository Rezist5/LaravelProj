<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScheduleController;
use App\Student;
use App\Teacher;
use App\ClassTable;
use App\Subject;
use Illuminate\Http\Request;
use App\SolutionTaskModel;

class RouteController extends Controller
{
    public function index()
    {
        $userType = Auth::user()->UserType;
        //dd("1");
        $scheduleController = new ScheduleController();
        $taskController = new TaskController();
        $newsController = new NewsController();
        $todayLessons = $scheduleController->getLessonsForToday();
        $today = now()->toDateString(); 
        
        $news = $newsController->getNews();
        $markcontroller = new MarkController();
        if($userType == 'student')
        {
            $stud = Student::find(Auth::user()->UserId);
            $marks = $markcontroller->getLastMarks();
            $top3Tasks = $taskController->getTop3Tasks($stud->ClassId);
           
            return view('index', ['today'=> $today ,'userType' => $userType, 'lessons' => $todayLessons, 'tasks' => $top3Tasks, 'marks' => $marks, 'newsList' => $news ]);
        }
        else if($userType == 'teacher')
        {
            $Tasks = $taskController->getUnverifiedTasks();
            return view('index', ['today'=> $today ,'userType' => $userType, 'lessons' => $todayLessons, 'Tasks' => $Tasks, 'newsList' => $news ]);
        }
        else if($userType == 'admin')
        {
            $subjects = Subject::all();
            $teachers = Teacher::all();
            $classes = ClassTable::all();
            return view('index', ['subjects' => $subjects , 'teachers' => $teachers,'classes' => $classes,'today'=> $today ,'userType' => $userType, 'lessons' => $todayLessons]);
        }
    }
    public function StudentTasks()
    {              
        $taskController = new TaskController();
        $today = now()->toDateString(); 
        $userType = Auth::user()->UserType;
        $stud = Student::find(Auth::user()->UserId);
        $Tasks = $taskController->getAllTasks($stud->ClassId);
        $subjects = Subject::all();
        $solTasks = SolutionTaskModel::where('StudentId', $stud->id)->get();
        //dd($Tasks);
        return view('StudentTasks', ['solutions' => $solTasks, 'subjects' => $subjects ,'today'=> $today ,'tasks' => $Tasks, 'userType' => $userType]);
        
    }
    public function TeacherTasks()
    {              
        $taskController = new TaskController();
        $userType = Auth::user()->UserType;
        $teach = Teacher::find(Auth::user()->UserId)->first();
        $Tasks = $taskController->getAllUnverifiedTasks();
        return view('TeacherTasks   ', ['tasks' => $Tasks, 'userType' => $userType ]);
        
    }
    public function TeacherExams()
    {              
        $examController = new ExamController();
        $userType = Auth::user()->UserType;
        $teach = Teacher::find(Auth::user()->UserId)->first();
        $Exams = $examController->getAllUnverifiedTasks();
        $classes = ClassTable::all();
        // Получаем список предметов
        $subjects = Subject::all();
        
        return view('teacherExams', ['exams' => $Exams, 'subjects' => $subjects, 'classes' => $classes ,'userType' => $userType ]);
        
    } 
    public function StudentExams()
    {              
        $examController = new ExamController();
        $today = now()->toDateString(); 
        $userType = Auth::user()->UserType;
        $stud = Student::find(Auth::user()->UserId);
        
        $Tasks = $examController->getAllTasks($stud->ClassId);
        // Получаем список предметов
        $subjects = Subject::all();
        
        // Получаем список классов
        $classes = ClassTable::all();
        
        return view('studentExams', [
            'today' => $today,
            'exams' => $Tasks,
            'userType' => $userType,
            'subjects' => $subjects,
            'classes' => $classes
        ]);
        
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
        $examMarksBySubject = $markcontroller->getExamMarksBySubject();
        $totalBySubject = $markcontroller->getTotalBySubject();
        
        return view('StudentMarks', [
            'marksBySubject' => $marksBySubject, 
            'totalBySubject' => $totalBySubject,
            'examMarksBySubject' => $examMarksBySubject, 
            'userType' => $userType 
        ]);
        
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
