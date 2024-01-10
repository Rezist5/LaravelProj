<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $table = 'Mark';
    protected $fillable = [
        'MarkNumber',
        'TaskId',
        'StudentId',
    ];
    public $timestamps = false; 
    public function task()
    {
        return $this->belongsTo(TaskModel::class, 'TaskId', 'Id');
    }
    public function subject()
    {
        return $this->belongsTo(TaskModel::class, 'TaskId')->with('subject');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentId');
    }
}