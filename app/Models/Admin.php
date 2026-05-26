<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['login', 'password', 'first_name', 'last_name'];
    protected $hidden = ['password'];
}