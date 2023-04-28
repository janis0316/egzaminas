<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

        const SORT = [
        'asc_title' => 'A-Z',
        'desc_title' => 'Z-A',
    ];

    const PER_PAGE = [
        'all', 8, 16, 32, 46
    ];

    public function deletePhoto()
    {
        $fileName = $this->photo;
        if (file_exists(public_path().$fileName)) {
            unlink(public_path().$fileName);
        }
        $this->photo = null;
        $this->save();
    }

    public $timestamps = false;
        protected $casts = [
        'start' => 'date',
        'end' => 'date',
    ];
}
