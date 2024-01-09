<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news'; 
    protected $fillable = [
        'title',
        'description',
        'date',

    ];
    public $timestamps = false;
     
}
