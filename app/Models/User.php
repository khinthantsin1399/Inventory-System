<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
    ];
}
