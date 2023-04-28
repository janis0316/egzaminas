@extends('layouts.app')

@section('content')
@section('title', 'dishes')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align:center">Patiekalai</h1>
            <div class="container">
                <div class="row justify-content-center">

                    @if (session()->has('ok'))
                    <div class="alert alert-success" role="alert">{{Session::get('ok')}}</div>
                    @endif





                    @forelse($dishes as $dish)
                    <div class="col-3" style="padding-bottom: 20px">
                        <div class="back-dishes">
                            <div class="card-header">
                                <h2 style="text-align: center">{{$dish->title}}</h2>

                            </div>
                            <div class="card-body">
                                <div class="list-table">
                                    <div class="d-flex">
                                        @if($dish->photo)
                                        <img class="small-img" src="{{asset($dish->photo)}}" style="width: 100%">
                                        @else
                                        <img class="small-img" src="{{asset('empty.jpg')}}" style="width: 100%">
                                        @endif
                                    </div>
                                    <div style="text-align: center">



                                    </div>
                                    <div style="text-align: center">
                                        <br>
                                    </div>

                                    <div>
                                        <div style="text-align: center">

                                            <a href="{{route('dishes-show', $dish)}}" class="btn btn-outline-success">Detaliau</a>



                                            @if(Auth::user()?->role == 'admin')
                                            <a href="{{route('dishes-edit', $dish)}}" class="btn btn-outline-success">Redaguoti</a>
                                            <form action="{{route('dishes-delete', $dish)}}" method="post">
                                                <button dish="submit" class="btn btn-outline-danger" style="margin-top: 5px">Ištrinti</button>
                                                @csrf
                                                @method('delete')
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    @empty
                    <li class="list-group-item">Viešbučių nėra</li>
                    @endforelse


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
