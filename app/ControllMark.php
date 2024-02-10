<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControllMark extends Model
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
