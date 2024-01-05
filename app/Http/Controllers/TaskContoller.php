<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\TaskModel;

class TaskContoller extends Controller
{
    
    public function createTask(Request $request)
    {
        $currentUser = Auth::user();
        $task = new TaskModel();
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->lessonId = $request->input('lessonId'); 
        $task->classId = $request->input('classId'); 
        $task->teacherId = $currentUser->id; 
        $task->save();
    }

    // Действие для загрузки решений студентами
    public function uploadSolution(Request $request)
    {
        // Проверка наличия файла в запросе
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName); 

            // Логика связи загруженного файла с заданием
            // Например, связать с конкретным заданием, указанным в запросе:
            $task = TaskModel::find($request->task_id);
            $task->downloaded = true;
            $task->filePath = $filePath;
            $task->save();

            return redirect()->back();
        }
    }
    public function getTop3Tasks()
    {
        $currentUser = Auth::user();
        $userClassId = $currentUser->classId;
        $top3Tasks = TaskModel::where('classId', $userClassId)
            ->take(3)
            ->get();
        return $top3Tasks;
    }
    // Действие для выгрузки решений на компьютер преподавателем
    public function downloadSolution(Request $request)
    {
        // Логика для скачивания файла
        $task = TaskModel::find($request->task_id);
        $filePath = $task->filePath;

        // Предположим, вы используете Laravel для скачивания файла
        return response()->download(storage_path('app/' . $filePath));
    }
    
}
