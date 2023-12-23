<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Teacher;

class Subject extends Model
{
   
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];
    public function lessons() {
        return $this->hasMany(Teacher::class, 'SubjectId');
    }
    public function getName()
    {
        return $this->name;
    }
}

