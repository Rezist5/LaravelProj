<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mark;
use App\TaskModel;
use App\SolutionTaskModel;
use App\Student;
use App\ExamMark;

class MarkController extends Controller
{
    public function store(Request $request)
    {
        $taskId = $request->taskId;
        $studentId = $request->studentId;
        
        $existingMark = Mark::where('TaskId', $taskId)
                            ->where('StudentId', $studentId)
                            ->first();
        $SolTask = SolutionTaskModel::where('TaskId', $taskId)
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
        $mark->TaskId = $taskId; 
        $mark->StudentId = $studentId;
        $mark->save();

        return redirect()->back()->with('success', 'Оценка успешно добавлена.');
    }
    public function ExamStore(Request $request)
    {
        $examId = $request->examId;
        $studentId = $request->studentId;
        $exam = ExamModel::where('Id', $request->examId)->first();
        $existingMark = ExamMark::where('ExamId', $examId)
                            ->where('StudentId', $studentId)
                            ->first();
        if ($existingMark) {
            
            return redirect()->back()->withErrors([
                'message' => 'Оценка за это задание уже была поставлена.',
            ]);
        }
        $SolExam = SolutionExamModel::where('ExamId', $examId)
                            ->where('StudentId', $studentId)->first();
        
        $SolExam->verified = 1;
        $SolExam->save();                      
        $mark = new ExamMark();
        $mark->MarkNumber = $request->mark;
        $mark->MarkDate = now()->toDateString();
        $mark->ExamId = $examId; 
        $mark->StudentId = $studentId;
        $mark->save();

        return redirect()->back()->with('success', 'Оценка успешно добавлена.');
    }
    public function getMarksBySubject()
    {
        $studentId = Auth::user()->UserId;

        $marksBySubject = [];
        
        $marks = Mark::where('StudentId', $studentId)
                        ->with('task.subject')
                        ->get();
        
            foreach ($marks as $mark) {
                $subjectName = $mark->getTask()->subjectName();
                if (!array_key_exists($subjectName, $marksBySubject)) {
                    $marksBySubject[$subjectName] = [];
                }
                $marksBySubject[$subjectName][] = $mark;
            }
            
        
        return $marksBySubject;
    }
    public function getExamMarksBySubject()
    {
        $studentId = Auth::user()->UserId;

        $examMarksBySubject = [];

        $examMarks = ExamMark::where('StudentId', $studentId)
                            ->with('exam.subject')
                            ->get();
        //dd($examMarks);

        foreach ($examMarks as $examMark) {
            $subjectName = $examMark->exam->subjectName();
            if (!array_key_exists($subjectName, $examMarksBySubject)) {
                $examMarksBySubject[$subjectName] = [];
            }
            $examMarksBySubject[$subjectName][] = $examMark;
        }

        return $examMarksBySubject;
    }
    public function getTotalBySubject()
    {
        $studentId = Auth::user()->UserId;

        $totalBySubject = [];

        // Получаем все оценки студента
        $marks = Mark::where('StudentId', $studentId)
                    ->with('task.subject')
                    ->get();

        // Получаем все оценки за экзамены студента
        $examMarks = ExamMark::where('StudentId', $studentId)
                            ->with('exam.subject')
                            ->get();

        // Группируем оценки по предметам
        foreach ($marks as $mark) {
            $subjectName = $mark->getTask()->subjectName();
            if (!array_key_exists($subjectName, $totalBySubject)) {
                $totalBySubject[$subjectName] = [];
            }
            $totalBySubject[$subjectName][] = $mark->MarkNumber;
        }

        // Группируем оценки за экзамены по предметам
        foreach ($examMarks as $examMark) {
            $subjectName = $examMark->exam->subjectName();
            if (!array_key_exists($subjectName, $totalBySubject)) {
                $totalBySubject[$subjectName] = [];
            }
            $totalBySubject[$subjectName][] = $examMark->MarkNumber / $examMark->exam->MaxMarkNumber * 100;
        }

        // Вычисляем общий процент для каждого предмета
        foreach ($totalBySubject as $subject => $marks) {
            $total = array_sum($marks); // Сумма всех оценок
            $maxTotal = count($marks); // Максимальное количество оценок
            $percentage = $total / $maxTotal; // Вычисление среднего процента
            $totalBySubject[$subject] = $percentage;
        }

        return $totalBySubject;
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
