<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTable extends Model
{
    protected $table = 'ClassTable';
    
    protected $fillable = [
        'ClassName',
        'grade'
    ];

    public $timestamps = false;
    public function students()
    {
        return $this->hasMany(Student::class, 'ClassId');
    }

    public function getAllStudents()
    {
        return $this->students()->get();
    }

    public function giveAllStudents()
    {
        $class = ClassTable::find($classId);
        if ($class) {
            $students = $class->getAllStudents();
            return $students;
        }
        return null;
    }

}