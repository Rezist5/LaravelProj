<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Authenticatable implements AuthenticatableContract, CanResetPasswordContract
{
    protected $table = 'User'; 

    protected $primaryKey = 'Id';

    protected $fillable = [
        'Id',
        'username',
        'password',
        'UserType',
        'UserId'
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }
    public $timestamps = false; 

    
   
}