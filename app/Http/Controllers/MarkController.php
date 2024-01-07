<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mark;

class MarkController extends Controller
{
    public function store(Request $request)
    {
        $lessonId = $request->lessonId;
        $studentId = $request->studentId;

        $existingMark = Mark::where('LessonId', $lessonId)
                            ->where('StudentId', $studentId)
                            ->first();

        if ($existingMark) {

            return redirect()->back()->withErrors([
                'message' => 'Оценка за это задание уже была поставлена.',
            ]);
        }
        $task = TaskModel::->where('lessonId', $lessonId)->first();
        $mark = new Mark();
        $mark->MarkNumber = $request->mark;
        $mark->MarkDate = now()->toDateString();
        $mark->TaskId = $task->Id; 
        $mark->StudentId = $studentId;
        $mark->save();

        return redirect()->back()->with('success', 'Оценка успешно добавлена.');
    }
}
