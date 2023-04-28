@extends('layouts.app')

@section('content')
@section('title', 'Edit palce')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @error('place_title')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            @error('code')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            @error('address')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror


            <div class="card m-6">
                <div class="card-header">
                    <h2 style="justify-content: center; display: flex">Redaguoti maitinimo įstaigą</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('places-update', $place)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Maitinimo įstaiga</label>
                            <input type="text" name="place_title" class="form-control" value="{{$place->title}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kodas</label>
                            <input type="text" name="code" class="form-control" value="{{$place->code}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">adresas</label>
                            <input type="text" name="address" class="form-control" value="{{$place->address}}">

                        </div>
                        <div class="mb-3" style="justify-content: center; display: flex">
                            <button type="submit" class="btn btn-outline-primary mt-4">Redaguoti</button>
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
