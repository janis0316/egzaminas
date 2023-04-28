@extends('layouts.app')

@section('content')
@section('title', 'New place')


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
                    <h2 style="justify-content: center; display: flex">Nauja maitinimo įstaiga</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('places-store')}}" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Maitinimo įstaiga</label>
                            <input type="text" name="place_title" class="form-control" value="{{old('place_title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kodas</label>
                            <input type="text" name="code" class="form-control" value="{{old('code')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresas</label>
                            <input type="text" name="address" class="form-control" value="{{old('address')}}">
                        </div>
                        <div class="mb-3" style="justify-content: center; display: flex">
                            <button type="submit" class="btn btn-outline-warning mt-4">Sukurti</button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
