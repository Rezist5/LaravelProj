<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller implements TaskInterface
{

    public function getTop3Tasks($classId)
    {
        $studId = Auth::user()->UserId;
        $tasksWithoutSolutions = ExamModel::whereDoesntHave('solution', function ($query) use ($studId) {
            $query->where('StudentId', $studId);
        })
        ->limit(3)
        ->get();
        return $tasksWithoutSolutions;
    }
    public function getUnverifiedTasks()
    {
        $teacher = Teacher::where('Id', Auth::user()->UserId)->first();
        $Tasks = ExamModel::where('subjectId', $teacher->subjectId)->get();
        $taskIds = $Tasks->pluck('Id');
        $SolTasks = SolutionExamModel::whereIn('ExamId', $taskIds)
                            ->where('verified', False)
                            ->take(5)
                            ->get();    
        return $SolTasks;
    }
    public function getAllUnverifiedTasks()
    {
        $teacher = Teacher::where('Id', Auth::user()->UserId)->first();
        $Tasks = ExamModel::where('subjectId', $teacher->subjectId)->get();
        $taskIds = $Tasks->pluck('Id');
        $SolTasks = SolutionExamModel::whereIn('ExamId', $taskIds)
                            ->where('verified', False)
                            ->get();    
        return $SolTasks;
    }
    public function getAllTasks($classId)
    {
        $Tasks = ExamModel::where('classId', $classId)->orderBy('date', 'desc')
            ->get();

        $taskIds = $Tasks->pluck('id');

        $solutions = SolutionExamModel::whereIn('taskId', $taskIds)->get();

        return $solutions;
    }
    // Действие для загрузки заданий учителями
        public function uploadTaskFile(Request $request)
        {
            if ($request->hasFile('taskFile')) {
                $currentUser = Auth::user();
                $teacher = Teacher::where('Id', $currentUser->UserId)->first();
                $file = $request->file('taskFile');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('task_files', $fileName);

                
                $task = new ExamModel();
                $task->lessonId = $request->lessonId; 
                $task->subjectId = $teacher->SubjectID;
                $task->classId = $request->classId; 
                $task->taskFilePath = $filePath;
                $task->deadline = $request->deadline;
                $task->save();
    
                return redirect()->back();
                    
            } 
            else {
                return redirect()->back();
            }
        }
        public function openTask(Request $request)
        {
            
                $exam = ExamModel::find($request->taskId);
                $exam->opened = true;
                $timer = date('H:i:s', strtotime('+1 hour', strtotime($exam->duration)));
                $exam->save();
                
                return redirect()->back()->with('timer', $timer);
        }
    public function downloadTaskFile(Request $request)
    {
        $task = ExamModel::find($request->taskId);
        $filePath = $task->TaskfilePath;
        
        $file = storage_path('app/' .$filePath);
        return response()->download($file);
    }
        // Действие для загрузки решений студентами
    public function uploadSolutionFile(Request $request)
        {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('solution_files', $fileName);
                $taskId = $request->examId;
                $opened = ExamModel::find($request->examId)->first()->opened;
                if($opened)
                {              
                    $solTaskCheck = SolutionExamModel::where('ExamId', $request->examId)->where('StudentId', Auth::user()->UserId)->first();
                    if($solTaskCheck)
                    {
                        $solTaskCheck->SolutionFilePath = $filePath;
                        $solTaskCheck->save();
                        return redirect()->back();
                    }
                    else
                    {
                        

                        $task = new SolutionExamModel();
                        $task->TaskId = $taskId;
                        $task->SolutionfilePath = $filePath; 
                        $task->StudentId = Auth::user()->UserId; 
                        $task->downloaded = true; 
                        
                        $task->save();
        
                        return redirect()->back();
                    }
                }
                else
                {
                    return redirect()->back()->withErrors(['message' => 'Exam finished already.']);
                }
            } else {
                return redirect()->back();
            }
        }
        public function downloadSolutionFile(Request $request)
        {
            $studId = $request->StudentId;
            $examId = $request->examId;
            
            $task = ExamModel::where('Id', $examId)->first();
            $SolTask = SolutionExamModel::where('StudentId', $studId)
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
