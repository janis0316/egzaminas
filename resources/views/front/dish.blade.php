@extends('layouts.front')

@section('content')
@section('title', 'Dish details')

<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-3">
            @include('front.common.cats')
        </div> --}}
        <div class="col-9">
            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-9">
                            <div class="list-table one">
                                <div class="top">
                                    <h3>
                                        {{$dish->title}}
                                    </h3>
                                    {{-- <a href="{{route('show-dish', $dish)}}"> --}}
                                    <div class="smallimg">
                                        @if($dish->photo)
                                        <img src="{{asset($dish->photo)}}">
                                        @else
                                        <img src="{{asset('no-img.png')}}">
                                        @endif
                                    </div>
                                    </a>
                                </div>
                                <div class="bottom" style="padding-left:20px">
                                    <div style="text-align:center">
                                        <h4 class="type" style="font-weight: bold"> {{$dish->dishPlace->title}} </h4>

                                        <div class="size"><b>Aprašymas:</b>
                                        </div>
                                        <div> {{$dish->description}}</div>
                                        {{-- <div class="price"> {{$dish->price}} EUR
                                    </div> --}}
                                </div>
                                <div style="padding-top: 20px; text-align:center">

                                    <form action="{{route('add-to-cart')}}" method="post">
                                        <button type="submit" class="btn btn-outline-primary">Į krepšelį</button>
                                        <input type="number" min="1" name="count" value="1">
                                        <input type="hidden" name="product" value="{{$dish->id}}">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
