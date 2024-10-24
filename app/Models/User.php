<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $fillable = ['name','username','password','email','is_admin','pharmacy_number'];

    protected $hidden = ['password'];

    public function operations():HasMany{
        return $this->hasMany(Operation::class);
    }
    use HasFactory;
}
