@extends('layouts.app')

@section('content')
@section('title', 'Menus')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align:center">Valgiaraščiai</h1>
            <div class="container">
                <div class="row justify-content-center">

                    @if (session()->has('ok'))
                    <div class="alert alert-success" role="alert">{{Session::get('ok')}}</div>
                    @endif





                    @forelse($menus as $menu)
                    <div class="col-3" style="padding-bottom: 20px">
                        <div class="back-menus">
                            <div class="card-header">
                                <h2 style="text-align: center">{{$menu->title}}</h2>

                            </div>
                            <div class="card-body">
                                <div class="list-table">
                                    <div class="d-flex">

                                    </div>
                                    <div style="text-align: center">
                                        <div class="m-2">Maitinimo įstaiga: {{$menu->menuPlace->title}}</div>

                                    </div>

                                    <div>
                                        <div style="text-align: center">




                                            @if(Auth::user()?->role == 'admin')
                                            <a href="{{route('menus-edit', $menu)}}" class="btn btn-outline-success">Redaguoti</a>
                                            <form action="{{route('menus-delete', $menu)}}" method="post">
                                                <button menu="submit" class="btn btn-outline-danger" style="margin-top: 5px">Ištrinti</button>
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
