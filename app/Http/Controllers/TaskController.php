<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TaskModel;
use App\Teacher;
use App\Lesson;
use App\Student;
use App\SolutionTaskModel;

class TaskController extends Controller implements TaskInterface
{
    public function getTop3Tasks($classId)
    {
        $studId = Auth::user()->UserId;
        $tasksWithoutSolutions = TaskModel::whereDoesntHave('solution', function ($query) use ($studId) {
            $query->where('StudentId', $studId);
        })
        ->limit(3)
        ->get();
        return $tasksWithoutSolutions;
    }
    public function getUnverifiedTasks()
    {
        $teacher = Teacher::where('Id', Auth::user()->UserId)->first();
        $Tasks = TaskModel::where('subjectId', $teacher->subjectId)->get();
        $taskIds = $Tasks->pluck('Id');
        $SolTasks = SolutionTaskModel::whereIn('TaskId', $taskIds)
                            ->where('verified', False)
                            ->take(5)
                            ->get();    
        return $SolTasks;
    }
    public function getAllUnverifiedTasks()
    {
        $teacher = Teacher::where('Id', Auth::user()->UserId)->first();
        $Tasks = TaskModel::where('subjectId', $teacher->subjectId)->get();
        $taskIds = $Tasks->pluck('Id');
        $SolTasks = SolutionTaskModel::whereIn('TaskId', $taskIds)
                            ->where('verified', False)
                            ->get();    
        return $SolTasks;
    }
    public function getAllTasks($classId)
    {
        $Tasks = TaskModel::where('classId', $classId)->orderBy('deadline', 'desc')
            ->get();

        $taskIds = $Tasks->pluck('id');

        $solutions = SolutionTaskModel::whereIn('taskId', $taskIds)->get();

        return $solutions;
    }
    // Действие для загрузки заданий учителями
        public function uploadTaskFile(Request $request)
        {
            if ($request->hasFile('taskFile')) {
                $currentUser = Auth::user();
                $teacher = Teacher::find($currentUser->UserId)->first();
                $file = $request->file('taskFile');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('task_files', $fileName);

                $taskCheck = TaskModel::where('lessonId', $request->lessonId)->first();
                if($taskCheck)
                {
                    $taskCheck->taskFilePath = $filePath;
                    $task->save();
                    return redirect()->back();
                }
                else
                {
                    $task = new TaskModel();
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
    public function downloadTaskFile(Request $request)
    {
        $task = TaskModel::find($request->taskId);
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
        public function downloadSolutionFile(Request $request)
        {
            $studId = $request->StudentId;
            $lessonId = $request->lessonId;
            
            $task = TaskModel::where('lessonId', $lessonId)->first();
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
