@extends('layouts.app')

@section('content')
@section('title', 'Edit menu')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            @error('menu_title')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            {{-- MESSAGE --}}
            <div class="container">
                <div class="row justify-content-center">
                    @if (session()->has('bad'))
                    <div class="alert alert-danger" role="alert">{{Session::get('bad')}}</div>
                    @endif
                </div>
            </div>


            <div class="card m-6">
                <div class="card-header">
                    <h2 style="justify-content: center; display: flex">Valgiaraštis</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('menus-update', $menu)}}" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label class="form-label">Maitinimo įstaiga</label>
                            <select class="form-select" name="place_id">
                                @foreach($places as $place)
                                <option value="{{$place->id}}|{{$place->season_start}}|{{$place->season_end}}|{{$place->title}}" @if($place->id == $menu->place_id) selected @endif>{{$place->title}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Valgiaraščio pavadinimas</label>
                            <input type="text" name="menu_title" class="form-control" value="{{$menu->title}}">
                        </div>

                        <div class="mb-3" style="justify-content: center; display: flex">
                            <button type="submit" class="btn btn-outline-warning mt-4">Išsaugoti</button>

                        </div>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
