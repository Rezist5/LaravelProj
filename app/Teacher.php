<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subject;

class Teacher extends Model
{
    protected $table = 'teacher'; // Указываем имя таблицы, если оно отличается от стандартного формата Laravel

    protected $fillable = [
        'name',
        'Surname',
        'Thirdname',
        'SubjectID'
    ];

    public $timestamps = false; // Если у вас нет полей 'created_at' и 'updated_at', установите значение false

    public static function createTeacher($data)
    {
        return self::create($data);
    }
    public function lessons() {
        return $this->hasMany(Lesson::class, 'TeacherId');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID', 'id');
    }
    public static function updateTeacher($teacherId, $data)
    {
        $teacher = self::find($teacherId);
        if ($teacher) {
            $teacher->fill($data);
            $teacher->save();
            return $teacher;
        }
        return null;
    }
    public function getStudents()
    {
        $lessons = Lesson::where('TeacherId', $this->id)->get();
        $allStudentsIds = [];
        $fg = false;
        foreach ($lessons as $lesson) {
            $students = Student::where('classId', $lesson->classId)->get();
            foreach ($students as $student) {
                if (!in_array($student->id, $allStudentsIds)) {
                    $allStudentsIds[] = $student->id;
                }
            }
        }
        $uniqueStudents = Student::whereIn('id', $allStudentsIds)->get();
        return $uniqueStudents;
    }

    public static function deleteTeacher($teacherId)
    {
        $teacher = self::find($teacherId);
        if ($teacher) {
            $teacher->delete();
            return true;
        }
        return false;
    }
}
