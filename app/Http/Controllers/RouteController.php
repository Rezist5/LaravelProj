<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $userType = Auth::user()->UserType;
        $scheduleController = new ScheduleController();
        $todayLessons = $scheduleController->getLessonsForToday();

        return view('index', ['userType' => $userType, 'todayLessons' => $todayLessons]);
    }

    public function showLessons()
    {
        // Ваша логика для получения типа пользователя
        $userType = 'Student'; // Предположим, что это значение типа пользователя

        return view('lessons', ['userType' => $userType]);
    }
}
