<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    protected $table = 'ExamMark';
    protected $fillable = [
        'MarkNumber',
        'ExamId',
        'StudentId',
    ];
    public function exam()
    {
        return $this->belongsTo(ExamModel::class, 'ExamId', 'Id');
    }
}
