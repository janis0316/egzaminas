<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Place;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('id', 'desc')->get();
        return view('back.menus.index', [
        'menus' => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $places = Place::all()->sortBy('place');
        return view('back.menus.create', [
        'places' => $places
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'menu_title' => 'required',
            ],
            [
                'menu_title.required' => 'Užpildykite pavadinimo laukelį',
            ]
        );

        $menu = new Menu;
        $menu->place_id = $request->place_id;
        $menu->title = $request->menu_title;
        $menu->save();

        return redirect()->route('menus-index')->with('ok', 'Valgiaraštis sukurtas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('back.menus.show', ['menu' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $places = Place::all()->sortBy('title');
        return view('back.menus.edit', [
            'menu' => $menu,
            'places' => $places
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validate = $request->validate(
            [
                'menu_title' => 'required',
            ],
            [
                'menu_title.required' => 'Užpildykite pavadinimo laukelį',
            ]
        );

        $menu->place_id = $request->place_id;
        $menu->title = $request->menu_title;
        $menu->save();

        return redirect()->route('menus-index')->with('ok', 'Valgiaraštis paredaguotas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete(); 
        return redirect()->route('menus-index')->with('ok', 'Valgiaraštis ištrintas');
    }
}
