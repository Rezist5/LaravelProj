<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson; 
use App\News;
use App\Subject;
use App\ClassTable;

class AdminController extends Controller
{
    public function createLessons(Request $request)
    {
        $lessonDate = $request->input('lesson_date');

        for ($i = 1; $i <= 9; $i++) {
            $teacherId = $request->input("teacher_id_$i");
            $classId = $request->input("class_id_$i");
            $classroom = $request->input("classroom_$i");

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
    public function createSubjects(Request $request)
    {
        $subject = new Subject();
        $subject->name = $request->input('name'); 
        $subject->save(); 

        return redirect()->back();
    }
    public function createClass(Request $request)
    {
        
        $class = new ClassTable();
        $class->ClassName = $request->input('name');
        $class->grade = $request->input('grade'); 
        $class->save(); 

        return redirect()->back();
    }
    public function createNews(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $picturePath = $request->file('picture')->store('news_images'); 

        $news = new News();
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->date = now()->toDateString();
        $news->PictureFilePath = $picturePath;
        $news->save();

        return redirect()->back()->with('success', 'Новость успешно создана');
    }
}