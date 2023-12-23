<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'admin'; // Указываем имя таблицы, если оно отличается от стандартного формата Laravel

    protected $fillable = [
        'username',
        'password',
        'email'
    ];

    public $timestamps = false; // Если у вас нет полей 'created_at' и 'updated_at', установите значение false

    public static function createAdmin($data)
    {
        return self::create($data)->id;
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

}
