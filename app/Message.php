<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    public $timestamps = false;
    protected $fillable = ['chat_id', 'create_time', 'author_id', 'recipient_id', 'message'];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
