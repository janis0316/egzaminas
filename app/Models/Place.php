<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    public function placeMenu()
    {
    return $this->hasMany(Menu::class, 'place_id', 'id');
    }
}
