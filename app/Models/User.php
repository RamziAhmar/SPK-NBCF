<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password'
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
