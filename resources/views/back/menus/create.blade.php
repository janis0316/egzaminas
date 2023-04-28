@extends('layouts.app')

@section('content')
@section('title', 'New menu')


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


            @error('menu_title')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror


            <div class="card m-6">
                <div class="card-header">
                    <h2 style="justify-content: center; display: flex">Naujas valgiaraštis</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('menus-store')}}" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label class="form-label">Valgiaraštis</label>
                            <select class="form-select" name="place_id">
                                @foreach($places as $place)
                                <option value="{{$place->id}}">{{$place->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pavadinimas</label>
                            <input type="text" name="menu_title" class="form-control" value="{{old('menu_title')}}">
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
