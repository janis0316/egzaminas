@inject('categories', 'App\Services\CategoriesService')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #6C757D; color: white">

                    <h2 style="text-align: center">Kategorijos</h2>
                </div>
                <div class="card-body">

                    @forelse($categories->get() as $place)

                    <div class="list-table cats">

                        {{-- <a href="{{route('show-cats-dishes', $place)}}"> --}}
                        {{-- <a href='{{route('show-cats-dishes', $place)}}' @if(isset($place->id) && $place->id==$place->placedishes) class="list-group-item active" @else class="list-group-item" @endif>{{$value->name}}</a> --}}
                        <a href="{{route('show-cats-dishes', $place)}}">

                            {{-- <a href="#"> --}}
                            <h3>
                                {{$place->title}}
                                {{-- [{{$place->placeMenu()->count()}}] --}}
                            </h3>
                        </a>
                    </div>
                    <hr>

                    @empty
                    <div class="list-table cats">Nėra šalių</div>

                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
