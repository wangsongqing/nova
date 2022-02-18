<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $timestamps = false;
    public $table = 'categories';

    use HasFactory;

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }
}
