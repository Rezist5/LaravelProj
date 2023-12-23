<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'Student'; // Указываем имя таблицы, если оно отличается от стандартного формата Laravel

    protected $fillable = [
        'name',
        'Surname',
        'Thirdname',
        'AvgMark',
        'ClassId',
        'Grade'
    ];
    public function class()
    {
        return $this->belongsTo(ClassTable::class, 'ClassId');
    }
    public $timestamps = true; // Поле для автоматической метки времени создания и обновления записи
    public static function createNewStudent($data)
    {   
        return self::create($data);
    }
    public static function createStudent($data)
{
    $student = self::create($data);
    return $student->id;
}
    public static function updateStudent($studentId, $data)
    {
        $student = self::find($studentId);
        if ($student) {
           $student->fill($data);
           $student->save();
            return $student;
        }
        return null;
    
    }
    public static function deleteStudent($studentId)
    {
        $student = self::find($studentId);
        if ($student) {
            $student->delete();
         return true;
        }
        return false;
    }
}
