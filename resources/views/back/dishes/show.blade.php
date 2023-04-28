@extends('layouts.app')

@section('content')
@section('title', 'Show dish')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card m-6">
                <div class="card-header">
                    <h1 style="justify-content: center; display: flex">{{$dish->title}}</h1>

                </div>
                <div class="card-body" style="text-align: center">


                    @if($dish->photo)
                    <div class="col-12">
                        <div class="mb-3 img" style="text-align: center">
                            <img class="fit-img" src="{{asset($dish->photo)}}" style="width:70%">
                        </div>
                    </div>
                    @endif
                    {{-- <h3>Šalis: {{$dish->dishMenu->title}}</h3> --}}



                    <h5>Aprašymas:</h5>
                    <div style="justify-content: center; display: flex">


                        <div style="font-size: 16px; width:70%; text-align:center">{{$dish->description}}
                        </div>
                    </div>

                    {{-- <div class="mb-3" style="justify-content: center; display: flex">
                        <a href="{{route('dishes-pdf', $dish)}}" class="btn btn-outline-primary">Atsisiųsti PDF</a>
                </div> --}}
            </div>
        </div>
    </div>

</div>
</div>

@endsection
