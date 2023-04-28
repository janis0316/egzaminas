<?php

namespace App\Services;
use App\Models\Place;

class CategoriesService 
{
    public function test()
    {
        return 'Hello this is Categories Service';
    }

    public function get()
    {
        return Place::all();
    }
}