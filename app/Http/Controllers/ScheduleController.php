<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lesson;
use App\Student;
use App\Teacher;
use App\Subject;


class ScheduleController extends Controller
{
    
    public function getLessonsByDate(Request $request)
    {
        $currentUser = Auth::user();
        $lessons = null;
        
        if($request)
        {
            $date = $request->input('lesson_date');
            
        }
        else
        {
            $date = now()->toDateString();
        }

            if ($currentUser->UserType === 'student') {
                $student = Student::where('Id', $currentUser->UserId)->first();
                if ($student) {
                    $lessons = Lesson::where('classId', $student->ClassId)
                        ->where('LessonDate', $date)
                        ->orderBy('LessonNumber')  
                        ->get();
                        return view('studentLessons', ['lessons' => $lessons,  'today' => now()->toDateString(),'selectedDate' => $date, 'userType' => $currentUser->UserType]);
                }
            } elseif ($currentUser->UserType === 'teacher') {
                $teacher = Teacher::where('Id', $currentUser->UserId)->first();
                
                if ($teacher) {
                    $lessons = Lesson::where('TeacherId', $currentUser->UserId)
                        ->where('LessonDate', $date)
                        ->orderBy('LessonNumber')
                        ->with('task')
                        ->get();

                    return view('teacherLessons', ['lessons' => $lessons, 'today' => now()->toDateString(), 'selectedDate' => $date, 'userType' => $currentUser->UserType]);
                }
            }
            elseif ($currentUser->UserType === 'admin') {
                $lessons = Lesson::where('LessonDate', $date)
                    ->orderBy('classId')
                    ->orderBy('LessonNumber')
                    ->with('task')
                    ->get();
        
                return view('adminLessons', ['lessons' => $lessons, 'today' => now()->toDateString(), 'selectedDate' => $date, 'userType' => $currentUser->UserType]);
            }     
        return redirect()->back();
    }

    public function getLessonsForToday()
{
    if (Auth::check()) {
        $currentUser = Auth::user();
        if($currentUser->UserType == "student")
        {
            $student = Student::find($currentUser->UserId);
            $classId = $student->ClassId;
            $today = now()->toDateString(); 
            
            $lessons = Lesson::where('classId', $classId)
                ->where('LessonDate', $today)
                ->orderBy('LessonNumber')
                ->get();
    
            return $lessons;
        }
        else if($currentUser->UserType == "teacher")
        {

            $teacher = Teacher::where('Id', $currentUser->UserId)->first();
            $today = now()->toDateString(); 
            
            $lessons = Lesson::where('TeacherId', $currentUser->UserId)
                            ->where('LessonDate', $today)
                            ->orderBy('LessonNumber')
                            ->get();
            return $lessons;
        }
        
    } else {
        return redirect('/login');
    }
}

    
}