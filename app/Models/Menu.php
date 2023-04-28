<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function menuPlace()
    {
    return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}
