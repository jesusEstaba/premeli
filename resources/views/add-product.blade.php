@extends('recicler.main')
@section('title', 'Agregar Producto')
@section('content')
	<h2>Agregar</h2>
	<div class="list">
		<!--Load Products-->
	</div>
	<div class="my-list hide">
		@foreach($products as $key => $product)
			<div class="product">{{$product->numProduct}}</div>
		@endforeach
	</div>
@stop

@section('script')
	<script type="text/javascript">
		//Prototype to remove object from array, removes first
		//matching object only
		Array.prototype.remove = function (v) {
		    if (this.indexOf(v) != -1) {
		        this.splice(this.indexOf(v), 1);
		        return true;
		    }
		    return false;
		}

		function myProducts()
		{
			var ids = [];

			$('.my-list.hide .product').each(function (ind, ele) {
				ids.push($(ele).html());
			});

			return ids;
		}

		function compareProdList(array1, array2)//optimizar
		{
			array1.forEach(function (ele1){
				array2.forEach(function (ele2, ind){
					if (ele1 == ele2.id) {
						console.log(ind);
						console.log(ele2);
						array2.remove(ele2);
					}
				});
			});

			console.log('finish');
			//return array2;
		}


		$(function(){
			$.get('https://api.mercadolibre.com/sites/MLV/search?seller_id=' + {{Auth::user()->meliUserId}}, 
			function(data) {
				var append = '';
				
				compareProdList(myProducts(), data.results);

				data.results.forEach(function(ele, inc){
					append += '<div class="product">' +
						'<img src="' + ele.thumbnail + '"/><h5>' + ele.title + '</h5>' + 
						'<p>Precio:<b class="price">' + ele.price + '</b></p>' +
						'<a class="btn green add" href="add-product/ref/' + ele.id + '">Agregar</a>' +
						'</div>';
				});

				$('.list').append(append);

			});

			/*
			$('.list').on('click', '.add', function() {
				var id = $(this),
					price = $(this).siblings().children('.price').html();

				$.post('/add-product', 
				{
					'numProduct': id.attr('id'),
					'price': price,

				}, 
				function(data) {
					if (data.status === 'added') {
						id.parents('.product').remove();
					} else {
						Materialize.toast('No se Pudo Agregar', 3000);
					}
					
				})
				.error(function() {
					Materialize.toast('<strong class="red-text">Error Interno</strong>', 3000);
				});;
				
			});
			*/
		});
	</script>
@stop