<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamModel extends Model
{
    protected $table = 'ControlTask'; 
    protected $fillable = [
        'subjectId',
        'classId',
        'duration',
        'startDate',
        'ExamfilePath',
        'verified',
        'downloaded'
    ];
    public $timestamps = false; 
    protected $attributes = [
        'verified' => false,
        'downloaded' => false,
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
