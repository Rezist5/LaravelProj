<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lesson;
use App\Subject;
use App\Teacher;

class TaskModel extends Model
{
    protected $table = 'Task'; 
    protected $fillable = [
        'lessonId',
        'subjectId',
        'classId',
        'deadline',
        'TaskfilePath',
        'verified',
        'downloaded'
    ];
    public $timestamps = false; 
    protected $attributes = [
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
    public function TaskTeacher()
    {
        $lesson = Lesson::find($this->lessonId);
        $teacher = Teacher::find($lesson->TeacherId);
        if ($teacher) {
            return $teacher;
        }

        return 'Unknown teacher';
    }
    public function solution()
    {
        return $this->hasMany(SolutionTaskModel::class, 'TaskId');
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessonID');
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

