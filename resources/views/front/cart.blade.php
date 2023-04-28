@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            @include('front.common.categories')
        </div>
        <div class="col-9">
            <div class="card-body">
                <div class="card-body">

                    <ul class="list-group">
                        <form action="{{route('update-cart')}}" method="post">
                            @forelse($cartList as $dish)
                            <li class="list-group-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            @if($dish->photo)
                                            <img class="cart-img" style="height: 150px" src="{{asset($dish->photo)}}">
                                            @endif
                                        </div>
                                        <div class="col-2">
                                            <h3>
                                                {{$dish->title}}
                                            </h3>
                                            {{-- <div class="type"> {{$dish->dishPlace->title}}
                                        </div> --}}
                                    </div>
                                    <div class="col-3">
                                    </div>
                                    <div class="col-1">

                                        {{$dish->sum}} Eur
                                    </div>
                                    <div class="col-1">
                                        <input type="number" min="1" name="count[]" value="{{$dish->count}}" style="width: 50px">
                                        <input type="hidden" name="ids[]" value="{{$dish->id}}">



                                    </div>
                                    <div class="col-1">
                                        <button type="submit" name="delete" value="{{$dish->id}}" class="btn btn-outline-danger">Ištrinti</button>
                                    </div>
                                </div>
                </div>
                </li>
                @empty
                <li class="list-group-item">Krepšelis</li>
                @endforelse
                <li class="list-group-item" style="text-align: right">

                    <button type="submit" class="btn btn-outline-dark">Atnaujinti</button>
                </li>

                @csrf
                </form>
                </ul>



                {{-- Make order BUY--}}
                <ul class="list-group" style="text-align: right">
                    <li class="list-group-item">
                        <form action="{{route('make-order')}}" method="post">
                            <button type="submit" class="btn btn-outline-success">Pirkti</button>
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
