@extends('layouts.app')

@section('content')
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
                    <h1>Visi užsakymai</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($orders as $order)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    <h2 style="margin: 5px">#{{$order->id}} | {{$order->user->name}}</h2>


                                    <ul class="list-group">
                                        @foreach($order->dishes->dishes as $dish)
                                        <li class="list-group-item">
                                            {{$dish->title}} | {{$dish->count}} vnt.

                                        </li>
                                        @endforeach
                                    </ul>
                                    <h4 style="margin: 5px">Viso: {{$order->dishes->total}} Eur</h4>
                                </div>
                                <div>
                                    @if($order->status == 0)
                                    <form action="{{route('orders-update', $order)}}" method="post" class="mt-2">
                                        <button type="submit" class="btn btn-outline-success">Patvirtinti</button>
                                        @csrf
                                        @method('put')
                                    </form>
                                    @else
                                    <div style="margin: 5px; color: green">Užsakymas patvirtintas</div>
                                    @endif

                                    <form action="{{route('orders-delete', $order)}}" method="post" class="mt-2">
                                        <button type="submit" class="btn btn-outline-danger">Ištrinti</button>
                                        @csrf
                                        @method('delete')
                                    </form>

                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
