<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name','username','password','email','is_admin'];

    protected $hidden = ['password'];
    use HasFactory;
}
