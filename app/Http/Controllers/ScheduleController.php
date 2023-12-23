<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson; 

class ScheduleController extends Controller
{
    
    public function getClassSchedule($date)
    {
        if (Auth::check()) {
            $currentUser = Auth::user();
            $currentDate = $date;
            $endDate = /* Вычисление конечной даты недели */;

            $lessons = Lesson::where('classId', $currentUser->classId)
                ->whereBetween('LessonDate', [$currentDate, $endDate])
                ->orderBy('LessonDate')
                ->orderBy('LessonNumber')
                ->get();

            return view('schedule', ['lessons' => $lessons, 'currentDate' => $currentDate, 'endDate' => $endDate]);
        } 
        else {
            return redirect('/login');
        }
    }
        
    
}