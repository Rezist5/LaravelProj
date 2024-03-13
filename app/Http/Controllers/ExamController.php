<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExamModel;
use App\SolutionExamModel;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\Subject;
use App\Teacher;
use App\ClassTable;
use Carbon\Carbon;


class ExamController extends Controller implements TaskInterface
{
    public function loadExams(Request $request)
    {
        try {
            $subject = $request->get('subject');
            $classId = $request->get('classId');
            $date = $request->get('date');

            $exams = ExamModel::query();

            if ($subject) {
                $exams->where('subjectId', $subject);
            }

            if ($classId) {
                $exams->where('classId', $classId);
            }

            if ($date) {
                $exams->whereDate('startDate', $date);
            }

            $filteredExams = $exams->get();

            $subjects = Subject::all();
            $today = now()->toDateString(); 
            $userType = Auth::user()->UserType;
            // Получаем список классов
            $classes = ClassTable::all();
            if(Auth::user()->UserType == 'teacher')
            {
                return view('examTeacherTable', [
                    'exams' => $filteredExams,
                ]);
            }
            else
            {
                return view('examTable', [
                    'exams' => $filteredExams,
    
                ]);
            }
            
        } catch (\Exception $e) {
           echo "Error: " . $e->getMessage();
           return 0;
        }
    }
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
        $teacher = Teacher::where('Id', Auth::user()->UserId)->first();
        $exam = new ExamModel;
        $exam->subjectId = $teacher->subject->id;
        $exam->Name = $request->input('Name');
        $exam->classId = $request->input('class');
        $exam->duration = $request->input('duration');
        $exam->MaxMarkNumber = $request->input('MaxMarkNumber');
        $exam->startDate = $request->input('startDate');
        //dd($request->hasFile('examFile'));
        if ($request->hasFile('examFile')) {
            $file = $request->file('examFile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('exam_files', $fileName);
            $exam->ExamfilePath = $filePath;
        }
        else
        {
            return redirect()->back()->with('error', 'Файл контрольной работы не был загружен.');
        }
        $exam->save();

        return redirect()->back()->with('success', 'Контрольная работа успешно создана!');
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
        $today = Carbon::now()->toDateString();

        $tasks = ExamModel::where('startDate', '<=', $today) // startDate меньше или равен сегодняшней дате
                    ->whereRaw('DATE_ADD(startDate, INTERVAL duration HOUR) >= ?', [$today]) // startDate + duration больше или равно сегодняшней дате
                    ->where('classId', $classId)
                    ->get();

        return $tasks;
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
            $examId = $request->exam;
            
            $exam = ExamModel::where('Id', $examId)->first();
            $SolExam = SolutionExamModel::where('StudentId', $studId)
            ->where('ExamId', $examId)
            ->first();
                    
            if (!$SolTask) {
                return redirect()->back()->withErrors(['message' => 'Solution file not found.']);
            }
            $filePath = $SolExam->SolutionFilePath;
            $file = storage_path('app/' . $filePath);
        
            if (!file_exists($file)) {
                return redirect()->back()->withErrors(['message' => 'File not found.']);
            }
        
            return response()->download($file);
        }
}
