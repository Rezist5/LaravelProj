<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    protected $table = 'ControllMarks';
    protected $fillable = [
        'MarkNumber',
        'MaxMarkNumber',
        'TaskId',
        'StudentId',
    ];
    public function task()
    {
        return $this->belongsTo(TaskModel::class, 'TaskId', 'Id');
    }
}
