<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Menu;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::orderBy('id', 'desc')->get();
        return view('back.dishes.index', [
        'dishes' => $dishes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::all()->sortBy('menu');
        return view('back.dishes.create', [
        'menus' => $menus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'dish_title' => 'required',
                'description' => 'required',
            ],
            [
                'dish_title.required' => 'Užpildykite pavadinimo laukelį',
                'description_title.required' => 'Užpildykite aprašymo laukelį',
            ]
        );

        $dish = new Dish;

            if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // $manager = new ImageManager(['driver' => 'GD']);

            $photo->move(public_path().'/dishes', $file);
            $dish->photo = '/dishes/' . $file;

        }

        $dish->menu_id = $request->menu_id;
        $dish->title = $request->dish_title;
        $dish->description = $request->description;
        $dish->save();

        return redirect()->route('dishes-index')->with('ok', 'Patiekalas sukurtas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return view('back.dishes.show', ['dish' => $dish]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        $menus = Menu::all()->sortBy('title');
        return view('back.dishes.edit', [
        'dish' => $dish,
        'menus' => $menus
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        $validate = $request->validate(
            [
                'dish_title' => 'required',
                'description' => 'required',
            ],
            [
                'dish_title.required' => 'Užpildykite pavadinimo laukelį',
                'description_title.required' => 'Užpildykite aprašymo laukelį',
            ]
        );

                 if ($request->delete_photo) {
            $dish->deletePhoto();
            return redirect()->back()->with('ok', 'Nuotrauka ištrinta');
        }

        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            // $manager = new ImageManager(['driver' => 'GD']);
            // $image = $manager->make($photo);
            // $image->resize(400, 300);
            
            if ($dish->photo) {
                $dish->deletePhoto();
            }
            
            $photo->move(public_path().'/dishes', $file);
        
            // $image->save(public_path().'/dishess/'.$file);
            $dish->photo = '/dishes/' . $file;
            
        }

        $dish->menu_id = $request->menu_id;
        $dish->title = $request->dish_title;
        $dish->save();

        return redirect()->route('dishes-index')->with('ok', 'Patiekalas paredaguotas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete(); 
        return redirect()->route('dishes-index')->with('ok', 'Patieklas ištrintas');
    }
}
