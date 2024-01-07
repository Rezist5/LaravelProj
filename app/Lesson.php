<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lesson';
    protected $fillable = [

        'LessonDate',
        'LessonNumber',
        'classId',
        'TeacherId',
        'classroom'
    ];
    public $timestamps = false; 

       public function class()
    {
        return $this->belongsTo(ClassTable::class, 'classId');
    }
    public function task()
    {
        return $this->hasMany(TaskModel::class, 'lessonId');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'TeacherId');
    }
}
