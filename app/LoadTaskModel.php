<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoadTask extends Model
{
    protected $table = 'LoadTask';
    protected $fillable = [
        'LessonID',
        'SubjectID',
        'StudentID',
        'filePath',
        'TaskfilePath',
        'verified',
        'downloaded',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'TeacherID');
    }
}