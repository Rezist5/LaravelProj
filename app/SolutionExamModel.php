<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolutionExamModel extends Model
{
    protected $fillable = [
        'ExamId',
        'StudentId',
        'SolutionFilePath',
        'verified',
        'downloaded'
    ];
    public $timestamps = false; 
    protected $attributes = [
        'verified' => false,
        'downloaded' => false,
    ];
    public function exam()
    {
        return $this->belongsTo(ExamModel::class, 'ExamId', 'Id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentId');
    }
    public function getMark()
    {
        $mark = SolutionExamMark::where('ExamId', $this->ExamId)->where('StudentId', $this->StudentId)->first();
        return $mark;
        
    }
}
