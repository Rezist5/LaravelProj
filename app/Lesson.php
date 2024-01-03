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

    public function class()
    {
        return $this->belongsTo(ClassTable::class, 'classId');
    }
    public function getDayOfWeekAttribute()
    {
        $date = Carbon::parse($this->LessonDate);
        return $date->dayOfWeekIso;
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'TeacherId');
    }
}
