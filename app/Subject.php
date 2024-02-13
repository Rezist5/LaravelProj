<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Teacher;
use App\TaskModel;

class Subject extends Model
{
   
    protected $table = 'Subject';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
    public function teacher()
    {
        return $this->hasMany(Teacher::class, 'SubjectID');
    }
    public function task()
    {
        return $this->hasMany(TaskModel::class, 'subjectId');
    }
    public function getName()
    {
        return $this->name;
    }
}

