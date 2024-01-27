<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TaskModel;

class Mark extends Model
{
    protected $table = 'Mark';
    protected $fillable = [
        'MarkNumber',
        'MarkDate',
        'TaskId',
        'StudentId',
    ];
    public $timestamps = false; 
    public function task()
    {
        return $this->belongsTo(TaskModel::class, 'TaskId', 'Id');
    }
    public function getTask()
    {
        $task = TaskModel::find($this->TaskId);
        if ($task) {
            return $task;
        }

        return null;
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentId');
    }
}