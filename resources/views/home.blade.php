@extends('recicler.main')
@section('title', 'Home')
@section('content')
    <h2>Home</h2>
    <ul>
        <li><a href="/add-product">agregar producto</a></li>
    </ul>
    <div class="my-list">

        @foreach($products as $key => $prod)
            @if($prod)
                <div class="product{{$prod->status}}" id="{{$prod->numProduct}}">
                    <h5>
                        {{$prod->title}}
                    </h5>
                    <div class="row">
                        <div class="s6 col">
                            <img src="{{$prod->thumbnail}}"/>
                        </div>
                        <div class="s6 col">
                            <h5>Bs {{$prod->price}}</h5>
                            <ul>
                                @foreach($prod->references as $aKy => $ref)
                                    <li title="{{$ref->title}}">
                                        Bs {{$ref->price}} 
                                        @if(isset($ref->price2))
                                            <b class="new-price" id="{{$ref->id}}">{{$ref->price2}}</b> 
                                            <em class="{{$ref->color}}">{{$ref->diff}}%</em>
                                        @endif
                                    </li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@stop

@section('script')
    <script type="text/javascript">
        function doSort(a, b) {
                return a.className < b.className;
        }

        $(function(){
            var elem = $('.my-list').find('.prodChange').sort(doSort);
            
            $('.my-list').prepend(elem);
        });
    </script>
@stop