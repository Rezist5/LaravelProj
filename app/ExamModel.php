<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamModel extends Model
{
    protected $table = 'Exam'; 
    protected $fillable = [
        'date',
        'subjectId',
        'classId',
        'duration',
        'ExamfilePath',
        'opened',
        'verified',
        'downloaded'
    ];
    public $timestamps = false; 
    protected $attributes = [
        'opened' => false,
        'verified' => false,
        'downloaded' => false,
    ];
    public function mark()
    {
        return $this->hasMany(Mark::class, 'TaskId');
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
        return $this->hasMany(SolutionTaskModel::class, 'TaskId');
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
