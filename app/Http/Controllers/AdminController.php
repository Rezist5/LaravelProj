<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson; 
use App\Teacher;
use App\News;
use App\Subject;
use App\ClassTable;
use Illuminate\Validation\Rule;

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
        'lesson_date' => 'required|date',
    ]);

    $lessonDate = $request->input('lesson_date');
    $errors = [
        'common' => [],
    ];

    for ($i = 1; $i <= 9; $i++) {
        $validator = \Validator::make($request->all(), $this->makeValidationRules($i, $request));

        // Проверка наличия преподавателя
        $fullName = $request->input("teacher_name_$i");
        $classFull = $request->input("class_name_$i");

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
        if (!empty($classFull) && strpos($classFull, ' ') !== false) {
            list($classGrade, $className) = explode(' ', $classFull, 2);

            $class = ClassTable::where('grade', $classGrade)
                            ->where('ClassName', $className)
                            ->first();

            if (!$class) {
                $errors['common'][] = "Class not found for row $i";
            }
        } elseif (!empty($classFull)) {
            $errors['common'][] = "Invalid format for class name in row $i";
        }
    }

    if (empty($errors['common'])) {
        for ($i = 1; $i <= 9; $i++) {
            // Проверка наличия преподавателя
            $fullName = $request->input("teacher_name_$i");
            if (!empty($fullName)) {
                $lesson = Lesson::updateOrCreate(
                    [
                        'LessonDate' => $lessonDate,
                        'LessonNumber' => $i,
                    ],
                    [
                        'TeacherId' => $teacher->id,
                        'classId' => $class->id,
                        'classroom' => $request->input("classroom_$i"),
                    ]
                );

                // Создание расписания на 4 недели
                for ($week = 0; $week < 4; $week++) {
                    $lesson->replicate()->update([
                        'LessonDate' => \Carbon\Carbon::parse($lessonDate)->addWeeks($week + 1),
                        'LessonNumber' => $i,
                    ]);
                }
            }
        }

        return redirect()->back();
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