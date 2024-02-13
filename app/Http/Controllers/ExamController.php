<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller implements ExamInterface
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
        $SolTasks = SolutionExamModel::whereIn('TaskId', $taskIds)
                            ->where('verified', False)
                            ->take(5)
                            ->get();    
        return $SolTasks;
    }
    public function createExam(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'required',
            'class' => 'required',
            'duration' => 'required',
            'startDate' => 'required',
            'examFile' => 'required|file',
        ]);

        $exam = new ExamModel;
        $exam->subjectId = $request->input('subject');
        $exam->classId = $request->input('class');
        $exam->duration = $request->input('duration');
        $exam->startDate = $request->input('startDate');

        if ($request->hasFile('examFile')) {
            $file = $request->file('examFile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('exam_files', $fileName);
            $exam->ExamfilePath = $filePath;
        }

        $exam->save();

        return redirect('/exams')->with('success', 'Контрольная работа успешно создана!');
    }
    public function getAllUnverifiedTasks()
    {
        $teacher = Teacher::where('Id', Auth::user()->UserId)->first();
        $Tasks = ExamModel::where('subjectId', $teacher->subjectId)->get();
        $taskIds = $Tasks->pluck('Id');
        $SolTasks = SolutionExamModel::whereIn('TaskId', $taskIds)
                            ->where('verified', False)
                            ->get();    
        return $SolTasks;
    }
    public function getAllTasks($classId)
    {
        $Tasks = ExamModel::where('classId', $classId)->orderBy('deadline', 'desc')
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
                $teacher = Teacher::find($currentUser->UserId)->first();
                $file = $request->file('taskFile');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('task_files', $fileName);

                $taskCheck = ExamModel::where('lessonId', $request->lessonId)->first();
                if($taskCheck)
                {
                    $taskCheck->taskFilePath = $filePath;
                    $task->save();
                    return redirect()->back();
                }
                else
                {
                    $task = new ExamModel();
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
                $taskId = $request->taskId;
                $solTaskCheck = SolutionExamModel::where('TaskId', $request->taskId)->where('StudentId', Auth::user()->UserId)->first();
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
               
            } else {
                return redirect()->back();
            }
        }
        public function downloadSolutionFile(Request $request)
        {
            $studId = $request->StudentId;
            $lessonId = $request->lessonId;
            
            $task = ExamModel::where('lessonId', $lessonId)->first();
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
