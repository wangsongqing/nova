<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
