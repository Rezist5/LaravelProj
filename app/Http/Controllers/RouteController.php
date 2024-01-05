<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskContoller;
use App\Http\Controllers\ScheduleController;
use App\Student;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $userType = Auth::user()->UserType;        
        $scheduleController = new ScheduleController();
        $taskController = new TaskContoller();
        $todayLessons = $scheduleController->getLessonsForToday();
        $top3Tasks = $taskController->getTop3Tasks();
        return view('index', ['userType' => $userType, 'lessons' => $todayLessons, 'tasks' => $top3Tasks]);
    }

    public function Lessons()
    { 
        return view('lessons', ['userType' => $userType]);
    }
}
