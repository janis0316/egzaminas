@extends('layouts.app')

@section('content')
@section('title', 'All places')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session()->has('ok'))
            <div class="alert alert-success" role="alert">{{Session::get('ok')}}</div>
            @endif
            @if (session()->has('bad'))
            <div class="alert alert-danger" role="alert">{{Session::get('bad')}}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h2 style="justify-content: center; display: flex">Maitinimo įstaigos</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($places as $place)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="d-flex">
                                    <h5 class="m-2">{{$place->title}}</h5>
                                    <div class="m-2">{{$place->code}}</div>
                                    <div class="m-2">{{$place->address}}</div>
                                    {{-- <div class="count">[{{$place->placeMenu()->count()}}]
                                </div> --}}
                            </div>
                            <div>
                                {{-- @if(Auth::user()?->role=='admin') --}}
                                <div class="d-flex">
                                    <a href="{{route('places-edit', $place)}}" class="btn btn-outline-success">Redaguoti</a>
                                    <form action="{{route('places-delete', $place)}}" method="post">
                                        <button place="submit" class="btn btn-outline-danger">Ištrinti</button>
                                </div>
                                @csrf
                                @method('delete')
                                </form>
                                {{-- @endif --}}
                            </div>
                </div>
                </li>
                @empty
                <li class="list-group-item">Šalių nėra</li>
                @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
