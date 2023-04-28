@extends('layouts.app')

@section('content')
@section('title', 'New dish')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            {{-- MESSAGE --}}
            <div class="container">
                <div class="row justify-content-center">
                    @if (session()->has('bad'))
                    <div class="alert alert-danger" role="alert">{{Session::get('bad')}}</div>
                    @endif
                </div>
            </div>


            @error('dish_title')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            @error('description')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror







            <div class="card m-6">
                <div class="card-header">
                    <h2 style="justify-content: center; display: flex">Naujas patiekalas</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('dishes-store')}}" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label class="form-label">Valgiaraštis</label>
                            <select class="form-select" name="menu_id">
                                @foreach($menus as $menu)
                                <option value="{{$menu->id}}">{{$menu->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Patiekalo pavadinimas</label>
                            <input type="text" name="dish_title" class="form-control" value="{{old('dish_title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kaina</label>
                            <input type="text" name="price" class="form-control" value="{{old('price')}}">
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">Nuotrauka</label>
                                <input type="file" class="form-control" name="photo">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Aprašymas</label>
                                <textarea class="form-control" rows="10" name="description">{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="mb-3" style="justify-content: center; display: flex">
                            <button type="submit" class="btn btn-outline-warning mt-4">Pridėti</button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
