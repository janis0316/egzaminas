<?php

namespace App\Http\Controllers;

use App\Models\Front;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\Place;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;


class FrontController extends Controller
{
    public function home (Request $request)
    {
        //be sort search ir per page (su paginate)
        // $dishes = Dish::paginate(9);
        // return view('front.home', [
        //     'dishes' => $dishes
        // ]);


        //su sort search ir per page
       $perPageShow = in_array($request->per_page, Dish::PER_PAGE) ? $request->per_page : '15';

       if (!$request->s) {
            if ($request->place_id && $request->place_id != 'all') {
                $dishes = Dish::where('place_id', $request->place_id);
            }
            else {
                $dishes = Dish::where('id', '>', 0);
            }
            
            $dishes = match($request->sort ?? '') {
                    'asc_title' => $dishes->orderBy('title'),
                    'desc_title' => $dishes->orderBy('title', 'desc'),
                    default => $dishes
            };

            if ($perPageShow == 'all') {
                    $dishes = $dishes->get();
                } 
            else {
                    $dishes = $dishes->paginate($perPageShow)->withQueryString();
            }
        }
        else {
            if ($request->s) {
                $s = explode(' ', $request->s);

                $dishes = Dish::where(function($query) use ($s) {
                    foreach ($s as $keyword) {
                    $query->Where('title', 'like', '%'.$keyword.'%');
                    }
                });

                $dishes = $dishes->paginate($perPageShow)->withQueryString();
                }
            }

            $places = Place::all();

        return view('front.home', [
            'dishes' => $dishes,
            'sortSelect' => Dish::SORT,
            'sortShow' => isset(Dish::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Dish::PER_PAGE,
            'perPageShow' => $perPageShow,
            'places' => $places,
            'placeShow' => $request->place_id ? $request->place_id : '',
            's' => $request->s ?? ''
        ]);

    }

    public function showCatDishes (Request $request, Place $place)
    {
    $perPageShow = in_array($request->per_page, Dish::PER_PAGE) ? $request->per_page : '15';
        $dishes = Dish::where('place_id', $place->id)->paginate(9);

        if ($request->s) {
        $s = explode(' ', $request->s);

        $dishes = Dish::where(function($query) use ($s) {
            foreach ($s as $keyword) {
                $query->Where('title', 'like', '%'.$keyword.'%');
            }
        });
    }
    $places = Place::all();

    return view('front.home', [
        'dishes' => $dishes,
        'sortSelect' => Dish::SORT,
        'sortShow' => isset(Dish::SORT[$request->sort]) ? $request->sort : '',
        'perPageSelect' => Dish::PER_PAGE,
        'perPageShow' => $perPageShow,
        'places' => $places,
        'placeShow' => $request->place_id ? $request->place_id : '',
        's' => $request->s ?? ''
    ]);
}

    public function showDish (Dish $dish)
    {
        return view('front.dish', [
            'dish' => $dish
        ]);
    }

        public function addToCart(Request $request, CartService $cart)
    {
        $id = (int) $request->product;
        $count = (int) $request->count;
        $cart->add($id, $count);
        return redirect()->back();
    }

    public function cart(CartService $cart)
    {
        return view('front.cart', [
            'cartList' => $cart->list
        ]);
    }

    public function updateCart(Request $request, CartService $cart)
    {
       
        if ($request->delete) {
            $cart->delete($request->delete);
        } else {
        $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
        $cart->update($updatedCart);
        }
        return redirect()->back();
    }

    public function makeOrder(CartService $cart)
    {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->order_json = json_encode($cart->order());

        $order->save();

        $cart->empty();

        //alert
        return redirect()->route('start')->with('ok', 'Patiekalai užsakyti');
    }
}
