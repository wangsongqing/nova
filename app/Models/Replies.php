<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    use HasFactory;

    public function topics()
    {
        return $this->hasMany(Topics::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
