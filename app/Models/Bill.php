<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bill extends Model
{
    protected $fillable = ['denomination'];

    public function operations():BelongsToMany{
        return $this->belongsToMany(Operation::class);
    }
    use HasFactory;
}
