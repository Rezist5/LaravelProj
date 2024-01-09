<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolutionTaskModel extends Model
{
    protected $table = 'SolutionTask'; 
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
        return $this->belongsTo(Task::class, 'TaskId');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentId');
    }
}
