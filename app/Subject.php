<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Teacher;

class Subject extends Model
{
   
    protected $table = 'Subject';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
    public function lessons()
    {
        return $this->hasMany(Teacher::class, 'SubjectID');
    }
    public function getName()
    {
        return $this->name;
    }
}

