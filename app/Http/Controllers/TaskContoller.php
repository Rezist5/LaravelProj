<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskModel;

class TaskContoller extends Controller
{
    // Действие для создания новых заданий преподавателем
    public function createTask(Request $request)
    {
        // Логика создания нового задания
        // Пример:
        $task = new TaskModel();
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        // Другие поля задания...
        $task->save();

        // Редирект или возврат ответа на ваш выбор
    }

    // Действие для загрузки решений студентами
    public function uploadSolution(Request $request)
    {
        // Проверка наличия файла в запросе
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName); // Сохранение файла в папке 'uploads'

            // Логика связи загруженного файла с заданием
            // Например, связать с конкретным заданием, указанным в запросе:
            $task = TaskModel::find($request->task_id);
            $task->file_path = $filePath;
            $task->save();

            // Редирект или возврат ответа на ваш выбор
        }
    }

    // Действие для выгрузки решений на компьютер преподавателем
    public function downloadSolution(Request $request)
    {
        // Логика для выгрузки решений на компьютер
        // Например, если путь к файлу задан в модели
        $task = TaskModel::find($request->task_id);
        $filePath = $task->file_path;

        // Предположим, вы используете Laravel для скачивания файла
        return response()->download(storage_path('app/' . $filePath));
    }
    
}
