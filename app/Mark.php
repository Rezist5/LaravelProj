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

    public function task()
    {
        return $this->belongsTo(Task::class, 'TaskId');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentId');
    }
}