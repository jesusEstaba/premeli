@extends('recicler.main')
@section('title', 'Agregar Producto')
@section('content')
	<h2>Agregar</h2>
	<div class="list">
		<!--Load Products-->
	</div>
@stop

@section('script')
	<script type="text/javascript">
		$(function(){
			$.get('https://api.mercadolibre.com/sites/MLV/search?seller_id=' + {{Auth::user()->meliUserId}}, 
			function(data) {
				var append = '';
				
				data.results.forEach(function(ele, inc){
					append += '<div class="product">' +
						'<img src="' + ele.thumbnail + '"/>' + ele.title + 
						'</div>';
				});

				$('.list').append(append);

			});
		});
	</script>
@stop