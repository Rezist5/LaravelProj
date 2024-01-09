<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mark;
use App\TaskModel;
use App\SolutionTaskModel;

class MarkController extends Controller
{
    public function store(Request $request)
    {
        $lessonId = $request->lessonId;
        $studentId = $request->studentId;
        $task = TaskModel::where('LessonID', $lessonId)->first();
        $existingMark = Mark::where('TaskId', $task->Id)
                            ->where('StudentId', $studentId)
                            ->first();
        $SolTask = SolutionTaskModel::where('TaskId', $task->Id);
        if ($existingMark) {
            
            return redirect()->back()->withErrors([
                'message' => 'Оценка за это задание уже была поставлена.',
            ]);
        }
        
        $SolTask->verified = true;
        $SolTask->save();
        $mark = new Mark();
        $mark->MarkNumber = $request->mark;
        $mark->MarkDate = now()->toDateString();
        $mark->TaskId = $task->Id; 
        $mark->StudentId = $studentId;
        $mark->save();

        return redirect()->back()->with('success', 'Оценка успешно добавлена.');
    }

    public function getMarkForSubject(Request $request)
    {
        $lessonId = $request->lessonId;
        $subjectId = $request->subjectId;
        
        $studentId = Auth::user()->UserId;
        $tasks = TaskModel::where('LessonID', $lessonId)
                  ->where('SubjectId', $subject)
                  ->get();

        $taskIds = $tasks->pluck('Id');         
        $Marks = Mark::whereIn('TaskId', $taskIds)
                     ->where('StudentId', $studentId)
                     ->get();
        dd($Marks);
        return redirect()->back()->with('success', 'Оценка успешно добавлена.');
    }
}
