<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamModel extends Model
{
    protected $table = 'Exam'; 
    protected $fillable = [
        'Name',
        'subjectId',
        'classId',
        'duration',
        'startDate',
        'MaxMarkNumber',
        'ExamfilePath',
        'verified',
        'downloaded'
    ];
    public $timestamps = false; 
    protected $attributes = [
        'verified' => false,
        'downloaded' => false,
    ];
    protected $casts = [
        'startDate' => 'datetime', // Устанавливаем тип данных для startDate как datetime
        'duration' => 'integer', // Устанавливаем тип данных для duration как integer
    ];
    public function mark()
    {
        return $this->hasMany(ExamMark::class, 'ExamId');
    }
    public function subjectName()
    {
        $subject = Subject::find($this->subjectId);
        if ($subject) {
            return $subject->name;
        }

        return 'Unknown Subject';
    }
    public function solution()
    {
        return $this->hasMany(SolutionExamModel::class, 'ExamId');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjectID', 'subjectId');
    }
    public function classTable()
    {
        return $this->belongsTo(ClassTable::class, 'classId');
    }
}
