<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model{
    public function consultation()
    {
        $this->hasMany('App\Consultation');
    }

    public static function findUserByEmailAndPassword($email, $password)
    {
        $user = User::where([
            ['email', '=', $email],
        ])->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return false;
    }
}
