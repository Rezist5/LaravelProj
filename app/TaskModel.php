<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    protected $table = 'Task'; 
    protected $fillable = [
        'lessonId',
        'subjectId',
        'classId',
        'taskFilePath',
        'filePath',
        'verified',
        'downloaded'
    ];

    protected $attributes = [
        'verified' => false,
        'downloaded' => false,
    ];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessonID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjectID');
    }

    public function classTable()
    {
        return $this->belongsTo(ClassTable::class, 'classId');
    }
    
}

