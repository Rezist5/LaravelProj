<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson; 
use App\Teacher;
use App\News;
use App\Subject;
use App\ClassTable;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected function makeValidationRules($index, $request)
{
    return [
        "teacher_id_$index" => [
            Rule::exists('teacher', 'id'),
        ],
        "class_id_$index" => [
            Rule::exists('ClassTable', 'id'),
        ],
    ];
}
    
    public function createLessons(Request $request)
    {
        $request->validate([
            'lesson_day' => 'required|integer|between:1,7', // 1-7 represent Monday-Sunday
            'lesson_month' => 'required|integer|between:1,12', // 1-12 represent January-December
        ]);

        $lessonDay = $request->input('lesson_day');
        $lessonMonth = $request->input('lesson_month');
        $selectedClassId = $request->input('selected_class');
        $year = now()->year; // You may need to adjust this based on your requirements

        // Calculate the first occurrence of the selected day in the given month
        $firstDayOfMonth = Carbon::createFromDate($year, $lessonMonth, 1);
        $lessonDate = $firstDayOfMonth->startOfWeek()->addDays($lessonDay - 1);
        $errors = [
            'common' => [],
        ];
        $class = ClassTable::find($selectedClassId);
        while ($lessonDate->month == $lessonMonth)
        {
            for ($i = 1; $i <= 9; $i++)
            {
                    $validator = \Validator::make($request->all(), $this->makeValidationRules($i, $request));

                    // Проверка наличия преподавателя
                    $fullName = $request->input("teacher_name_$i");

                    // Проверка наличия пробела перед использованием explode
                    if (!empty($fullName) && strpos($fullName, ' ') !== false) {
                        list($firstName, $lastName) = explode(' ', $fullName, 2);

                        $teacher = Teacher::where('name', $firstName)
                                        ->where('Surname', $lastName)
                                        ->first();

                        if (!$teacher) {
                            $errors['common'][] = "Teacher not found for row $i";
                        }
                    } elseif (!empty($fullName)) {
                        $errors['common'][] = "Invalid format for teacher name in row $i";
                    }

                    // Проверка наличия пробела перед использованием explode для названия класса
                    if (empty($errors['common'])) {
                        
                            $fullName = $request->input("teacher_name_$i");
                            if (!empty($fullName)) {
                                $existingLesson = Lesson::where('LessonDate', $lessonDate)
                                    ->where('LessonNumber', $i)
                                    ->whereHas('class', function ($query) use ($class) {
                                        $query->where('id', $class->id);
                                    })
                                    ->first();
                                
                                    if ($existingLesson) {
                                        // Обновление существующего урока
                                        $existingLesson->update([
                                            'classroom' => $request->input("classroom_$i"),
                                        ]);
                                    } else {
                                        // Создание нового урока
                                        if (!empty($teacher) && !empty($class)) {
                                            Lesson::create([
                                                'LessonDate' => $lessonDate,
                                                'LessonNumber' => $i,
                                                'TeacherId' => $teacher->id,
                                                'classId' => $class->id,
                                                'classroom' => $request->input("classroom_$i"),
                                            ]);
                                        }
                                    }  
                            }
                        
                    }
                }
                
                $lessonDate->addWeek();

            }
        return redirect()->back()->withErrors($errors)->withInput();
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
        
        $picturePath = $request->file('picture')->store('news_images', 'public');
        
        $news = new News();
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->date = now()->toDateString();
        $news->PictureFilePath = $picturePath;
        $news->save();

        return redirect()->back()->with('success', 'Новость успешно создана');
    }
}