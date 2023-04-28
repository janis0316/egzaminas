<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::all()->sortBy('title');
        return view('back.places.index', [
        'places' => $places
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.places.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'place_title' => 'required',
                'code' => 'required',
                'address' => 'required',
            ],
            [
                'place_title.required' => 'Užpildykite pavadinimo laukelį',
                
                'code.required' => 'Nurodykite maitinimo įstaigos kodą',
                
                'address.required' => 'Nurodykite adresą',
            ]
        );
        $place = new Place;
        $place->title = $request->place_title;
        $place->code = $request->code;
        $place->address = $request->address;
        $place->save();

        return redirect()->route('places-index')->with('ok', 'Maitinimo įstaiga sukurta');
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        return view('back.places.edit',[
        'place' => $place
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $validate = $request->validate(
            [
                'place_title' => 'required',
                'code' => 'required',
                'address' => 'required',
            ],
            [
                'place_title.required' => 'Užpildykite pavadinimo laukelį',
                
                'code.required' => 'Nurodykite maitinimo įstaigos kodą',
                
                'address.required' => 'Nurodykite adresą',
            ]
        );

        $place->title = $request->place_title;
        $place->code = $request->code;
        $place->address = $request->address;
        $place->save();

        return redirect()->route('places-index')->with('ok', 'Maitinimo įstaiga paredaguota');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        if (!$place->placeMenu()->count()) {
            $place->delete();
            return redirect()->route('places-index')->with('ok', 'Maitinimo įstaiga ištrinta');
        }
        return redirect()->back()->with('bad', 'Maitinimo įstaiga negali būti ištrinta');
    }
}
