<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ControlTaskModel;
use App\SolutionControlTaskModel;

class ControllTaskController extends Controller
{
    public function createControlTaskForm($lessonId)
    {
        $lesson = Lesson::find($lessonId);
        return view('createTask', ['lesson' => $lesson]);
    }
    public function getTop3ControlTasks($classId)
    {
        $studId = Auth::user()->UserId;
        $tasksWithoutSolutions = ControlTaskModel::whereDoesntHave('solution', function ($query) use ($studId) {
            $query->where('StudentId', $studId);
        })
        ->limit(3)
        ->get();
        return $tasksWithoutSolutions;
    }
    public function getUnverifiedControlTasks()
    {
        $teacher = Teacher::where('Id', Auth::user()->UserId)->first();
        $Tasks = ControlTaskModel::where('subjectId', $teacher->subjectId)->get();
        $taskIds = $Tasks->pluck('Id');
        $SolTasks = SolutionTaskModel::whereIn('TaskId', $taskIds)
                            ->where('verified', False)
                            ->take(5)
                            ->get();    
        return $SolTasks;
    }
    public function getAllUnverifiedControlTasks()
    {
        $teacher = Teacher::where('Id', Auth::user()->UserId)->first();
        $Tasks = ControlTaskModel::where('subjectId', $teacher->subjectId)->get();
        $taskIds = $Tasks->pluck('Id');
        $SolTasks = SolutionTaskModel::whereIn('TaskId', $taskIds)
                            ->where('verified', False)
                            ->get();    
        return $SolTasks;
    }
    public function getAllControlTasks($classId)
    {
        $Tasks = ControlTaskModel::where('classId', $classId)->orderBy('deadline', 'desc')
            ->get();

        $taskIds = $Tasks->pluck('id');

        $solutions = SolutionTaskModel::whereIn('taskId', $taskIds)->get();

        return $solutions;
    }
    // Действие для загрузки заданий учителями
        public function uploadControlTaskFile(Request $request)
        {
            if ($request->hasFile('taskFile')) {
                $currentUser = Auth::user();
                $teacher = Teacher::find($currentUser->UserId)->first();
                $file = $request->file('taskFile');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('control_task_files', $fileName);

                $taskCheck = ControlTaskModel::where('lessonId', $request->lessonId)->first();
                if($taskCheck)
                {
                    $taskCheck->taskFilePath = $filePath;
                    $task->save();
                    return redirect()->back();
                }
                else
                {
                    $task = new ControlTaskModel();
                    $task->lessonId = $request->lessonId; 
                    $task->subjectId = $teacher->SubjectID;
                    $task->classId = $request->classId; 
                    $task->taskFilePath = $filePath;
                    $task->deadline = $request->deadline;
                    $task->save();
    
                    return redirect()->back();
                }      
            } 
            else {
                return redirect()->back();
            }
        }
    public function downloadControlTaskFile(Request $request)
    {
        $task = ControlTaskModel::find($request->taskId);
        $filePath = $task->TaskfilePath;
        
        $file = storage_path('app/' .$filePath);
        return response()->download($file);
    }
        // Действие для загрузки решений студентами
    public function uploadControlSolutionFile(Request $request)
        {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('control_solution_files', $fileName);
                $taskId = $request->taskId;
                $solTaskCheck = SolutionTaskModel::where('TaskId', $request->taskId)->where('StudentId', Auth::user()->UserId)->first();
                if($solTaskCheck)
                {
                    $solTaskCheck->SolutionFilePath = $filePath;
                    $solTaskCheck->save();
                    return redirect()->back();
                }
                else
                {
                    

                    $task = new SolutionTaskModel();
                    $task->TaskId = $taskId;
                    $task->SolutionfilePath = $filePath; 
                    $task->StudentId = Auth::user()->UserId; 
                    $task->downloaded = true; 
                    
                    $task->save();
    
                    return redirect()->back();
                }
               
            } else {
                return redirect()->back();
            }
        }
        public function downloadControlSolutionFile(Request $request)
        {
            $studId = $request->StudentId;
            $lessonId = $request->lessonId;
            
            $task = ControlTaskModel::where('lessonId', $lessonId)->first();
            $SolTask = SolutionTaskModel::where('StudentId', $studId)
            ->where('TaskId', $task->id)
            ->first();
                    
            if (!$SolTask) {
                return redirect()->back()->withErrors(['message' => 'Solution file not found.']);
            }
            $filePath = $SolTask->SolutionFilePath;
            $file = storage_path('app/' . $filePath);
        
            if (!file_exists($file)) {
                return redirect()->back()->withErrors(['message' => 'File not found.']);
            }
        
            return response()->download($file);
        }
}
