<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson; 

class AdminController extends Controller
{
    public function createLessons(Request $request)
    {
        $lessonDate = $request->input('lesson_date');

        // Создаем уроки
        for ($i = 1; $i <= 9; $i++) {
            $teacherId = $request->input("teacher_id_$i");
            $classId = $request->input("class_id_$i");
            $classroom = $request->input("classroom_$i");

            // Создаем новый урок
            $lesson = new Lesson();
            $lesson->LessonDate = $lessonDate; 
            $lesson->LessonNumber = $i; 
            $lesson->TeacherId = $teacherId;
            $lesson->classId = $classId;
            $lesson->classroom = $classroom;
            $lesson->save(); 
        }

        return redirect()->back();
    }
}