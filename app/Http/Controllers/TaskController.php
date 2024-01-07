<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TaskModel;
use App\Teacher;

class TaskController extends Controller
{
    public function createTaskForm($lessonId)
    {
        $lesson = Lesson::find($lessonId);
        return view('createTask', ['lesson' => $lesson]);
    }
    public function getTop3Tasks($classId)
    {
        $top3Tasks = TaskModel::where('classId', $classId)->orderBy('deadline', 'desc')
            ->take(3)
            ->get();

        return $top3Tasks;
    }
    public function getAllTasks($classId)
    {
        $Tasks = TaskModel::where('classId', $classId)->orderBy('deadline', 'desc')
            ->get();

        return $Tasks;
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
                
                $currentUser = Auth::user();
                $task = new TaskModel();
                $task->lessonId = $request->lessonId; 
                $task->subjectId = $teacher->SubjectId; 
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
    public function downloadTaskFile(Request $request)
    {
        $task = TaskModel::find($request->taskId);
        $filePath = $task->TaskfilePath;
        
        // Получаем путь к файлу в хранилище
        $file = storage_path('app/' .$filePath);
    
        // Определяем имя для загружаемого файла
        $fileName = basename($file);
    
        // Определяем путь для загрузки в системную папку download
        $destinationPath = 'D:\OSPanel\LaraProj\LaravelProj\storage\app\public\download/' . $fileName;
        copy($file, $destinationPath);
        return redirect()->back();
        // Копируем файл в системную папку download
    }
        // Действие для загрузки решений студентами
    public function uploadSolutionFile(Request $request)
        {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('solution_files', $fileName);
        
                $taskId = $request->taskId;

                $task = new SolutionTaskModel();
                $task->TaskId = $taskId;
                $task->SolutionfilePath = $filePath; 
                $task->StudentId = Auth::user()->UserId; 
                $task->download = true; 
                $task->save();

                return redirect()->back();
            } else {
                return redirect()->back();
            }
        }
        public function downloadSolutionFile(Request $request)
        {
            $userId = $request->userId;
            $lessonId = $request->lessonId;
            $task = TaskModel::->where('lessonId', $lessonId)->first();
            $SolTask = SolutionTaskModel::where('userId', $userId)
                ->where('TaskId', $task->Id)
                ->first();
        
            if ($task) {
                $filePath = $SolTask->SolutionfilePath;
                $file = storage_path('app/' . $filePath);
                $fileName = basename($file);
                $destinationPath = 'D:\OSPanel\LaraProj\LaravelProj\storage\app\public\download/' . $fileName;
                copy($file, $destinationPath);
        
                return redirect()->back();
            } else {
                
            }
        }
    
}
