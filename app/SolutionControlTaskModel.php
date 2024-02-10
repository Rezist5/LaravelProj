<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolutionControlTaskModel extends Model
{
    protected $fillable = [
        'TaskId',
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
    public function task()
    {
        return $this->belongsTo(ControlTaskModel::class, 'TaskId', 'Id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentId');
    }
    public function getMark()
    {
        $mark = SolutionMark::where('TaskId', $this->TaskId)->where('StudentId', $this->StudentId)->first();
        return $mark;
        
    }
}
