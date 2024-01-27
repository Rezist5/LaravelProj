<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends User
{
    protected $table = 'admin'; 

    protected $fillable = [
        'username',
        'password',
        'email'
    ];

    public $timestamps = false; 

    public static function createAdmin($data)
{
    return self::create($data);
}

    public static function updateAdmin($adminId, $data)
    {
        $admin = self::find($adminId);
        if ($admin) {
            $admin->fill($data);
            $admin->save();
            return $admin->id;
        }
        return null;
    }

    public static function deleteAdmin($adminId)
    {
        $admin = self::find($adminId);
        if ($admin) {
            $admin->delete();
            return true;
        }
        return false;
    }
}


