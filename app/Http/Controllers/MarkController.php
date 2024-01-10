<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $existingMark = Mark::where('TaskId', $task->id)
                            ->where('StudentId', $studentId)
                            ->first();
        $SolTask = SolutionTaskModel::where('TaskId', $task->id)
                            ->where('StudentId', $studentId)->first();
        
        $SolTask->verified = 1;

        $SolTask->save();                      
        if ($existingMark) {
            
            return redirect()->back()->withErrors([
                'message' => 'Оценка за это задание уже была поставлена.',
            ]);
        }
        
        $mark = new Mark();
        $mark->MarkNumber = $request->mark;
        $mark->MarkDate = now()->toDateString();
        $mark->TaskId = $task->id; 
        $mark->StudentId = $studentId;
        $mark->save();

        return redirect()->back()->with('success', 'Оценка успешно добавлена.');
    }

    public function getMarksBySubject()
    {
        $studentId = Auth::user()->UserId;

        $tasks = TaskModel::where('verified', TRUE)->get();
        $taskIds = $tasks->pluck('Id');         

        $marksBySubject = [];
        
        foreach ($taskIds as $taskId) {
            $marks = Mark::where('TaskId', $taskId)
                        ->where('StudentId', $studentId)
                        ->with('task.subject')
                        ->get();
            
            foreach ($marks as $mark) {
                $subjectName = $mark->task->subject->name;
                if (!array_key_exists($subjectName, $marksBySubject)) {
                    $marksBySubject[$subjectName] = [];
                }
                $marksBySubject[$subjectName][] = $mark;
            }
        }
        
        return $marksBySubject;
    }
    public function getLastMarks()
    {
        $studentId = Auth::user()->UserId;
        $Marks = Mark::where('StudentId', $studentId)
                        ->orderByDesc('TaskId')
                        ->take(10)
                        ->get();
        return $Marks;
    }
}
