@extends('layouts.app')

@section('content')
@section('title', 'Edit dish')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            @error('dish_title')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            @error('description')
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
                    <h2 style="justify-content: center; display: flex">Patiekalas</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('dishes-update', $dish)}}" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label class="form-label">Valgiaraštis</label>
                            <select class="form-select" name="menu_id">
                                @foreach($menus as $menu)
                                <option value="{{$menu->id}}" @if($menu->id == $dish->menu_id) selected @endif>{{$menu->title}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Patiekalo pavadinimas</label>
                            <input type="text" name="dish_title" class="form-control" value="{{$dish->title}}">
                        </div>


                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">Nuotrauka</label>
                                <input type="file" class="form-control" name="photo">
                            </div>

                            @if($dish->photo)
                            <div class="col-12">
                                <div class="mb-3 img">
                                    <img src="{{asset($dish->photo)}}" style="width: 600px">
                                </div>
                            </div>
                            @endif

                        </div>
                        @if($dish->photo)
                        <button type="submit" class="btn btn-outline-warning mt-4" name="delete_photo" value="1">Ištrinti nuotrauką</button>
                        @endif

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Aprašymas</label>
                                <textarea class="form-control" rows="10" name="description" value="{{$dish->description}}"></textarea>

                            </div>
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
