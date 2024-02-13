<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $fillable = ['abonent_1', 'abonent_2'];

    public function user1()
    {
        return $this->belongsTo(User::class, 'abonent_1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'abonent_2');
    }
}