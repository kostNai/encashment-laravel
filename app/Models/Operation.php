<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Operation extends Model
{
    protected $fillable = ['number','user_id','bill_id'];

    public function user():HasOne{
        return $this->hasOne(User::class);
    }
    public function bills():BelongsToMany{
        return $this->belongsToMany(Bill::class);
    }
    use HasFactory;
}
