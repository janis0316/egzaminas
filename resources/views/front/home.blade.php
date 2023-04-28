@extends('layouts.front')

@section('content')
@section('title', 'Dishes')

{{-- MESSAGE --}}
<div class="container">
    <div class="row justify-content-center">
        @if (session()->has('ok'))
        <div class="alert alert-success" role="alert">{{Session::get('ok')}}</div>
        @endif
    </div>
</div>

{{-- IESKOTI, RUSIUOTI, PUSLAPIAI --}}
<div class="container">
    <div class="row">
        <div class="col-3">
            {{-- Column --}}
        </div>

        {{-- IESKOTI --}}
        <div class="col-3">
            <form action="{{route('start')}}" method="get">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-8">
                            <div class="mb-3">
                                <label class="form-label">Ieškoti</label>
                                <input type="text" class="form-control" name="s" value="{{$s}}">
                            </div>
                        </div>
                        <div class=" col-4">
                            <div class="head-buttons">
                                <button type="submit" class="btn btn-outline-dark" style="margin-top: 30px">Ieškoti</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- RUSIAVIMAS IR PUSLAPIAI --}}
        <div class="col-6">
            <form action="{{route('start')}}" method="get">
                <div class="container">
                    <div class="row justify-content-end">

                        {{-- RUSIAVIMAS --}}
                        <div class="col-5">
                            <div class="mb-4">
                                <label class="form-label">Rūšiuoti pagal</label>
                                <select class="form-select" name="sort">
                                    <option>Rūšiuoti pagal:</option>
                                    @foreach($sortSelect as $value => $name)
                                    <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- PUSLAPIAI --}}
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">Puslapiuose:</label>
                                <select class="form-select" name="per_page">
                                    @foreach($perPageSelect as $value)
                                    <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- MYGTUKAI --}}
                        <div class="col-4">
                            <div class=" head-buttons">
                                <button type="submit" class="btn btn-outline-dark" style="margin-right: 5px; margin-top: 30px">Rodyti</button>
                                <a href="{{route('start')}}" class="btn btn-outline-dark" style="margin-top: 30px">Atstatyti</a>
                            </div>
                        </div>

            </form>
        </div>
    </div>
</div>
{{--PABAIGA --- IESKOTI, RUSIUOTI, PUSLAPIAI --}}




{{-- KATEGORIJOS --}}
<div class="col-3">
    @include('front.common.categories')
</div>
<div class="col-9">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                @forelse($dishes as $dish)
                <div class="col-6">
                    <div class="dish">
                        <div class="top">

                            {{-- INFO PASPAUDUS ANT NUOTRAUKOS --}}
                            <a href="{{route('show-dish', $dish)}}">
                                <div class="smallimg">
                                    @if($dish->photo)
                                    <img src="{{asset($dish->photo)}}">
                                    @else
                                    <img class="small-img" src="{{asset('empty.jpg')}}" style="width: 100%">
                                    @endif
                                    <div class="bottom-left">
                                        <h3 class="dish-name">
                                            {{$dish->title}}
                                        </h3>
                                        {{-- <div class="type"> {{$dish->menuPlace->title}} --}}
                                    </div>
                                </div>
                                <div class="bottom-right">
                                </div>
                        </div>
                        </a>

                    </div>

                    <div class="container bottom">
                        <div class="row">
                            <div class="col-12">


                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px">
                            <div class="col-3">

                            </div>
                            <div class="col-6 justify-content-center" style="margin: auto">

                            </div>
                            <div class="col-3">
                                <form action="{{route('add-to-cart')}}" method="post" style="text-align: right">
                                    <button type="submit" class="btn btn-secondary">Į krepšelį</button>
                                    <input type="number" min="1" name="count" value="1" style="width:50px; border-radius: 5px; margin-top: 3px">
                                    <input type="hidden" name="product" value="{{$dish->id}}">

                                    @csrf
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            @empty
            <div class="list-group-item">Viešbučių nėra</div>
            @endforelse
        </div>
    </div>
</div>

{{-- PUSLAPIAI APACIOJE --}}
@if($perPageShow != 'all')
<div class="m-2">{{ $dishes->links()}}
</div>
@endif
</div>
</div>
</div>
@endsection
