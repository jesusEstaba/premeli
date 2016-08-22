@extends('recicler.main')
@section('title', 'Agregar Referencia')
@section('content')
	<h2>Agregar Referencia</h2>
	<div class="list">
		<div class="product" id="{{$product->id}}">
			<p>{{$product->id}}</p>
			<h4>{{$product->title}}</h4>
			<h5 class="green-text">Bs {{$product->price}}</h5>
		</div>
	</div>
		<input type="text" placeholder="Id Producto" name="refer"/><a class="btn green add-ref">Agregar</a>
	<ul class="ref-list">
		
	</ul>
	<a class="btn yellow darken-2 save waves-effect black-text">Guardar</a>
@stop

@section('script')
<script type="text/javascript">
	$(function(){
		$('.add-ref').on('click', function() {
			if ($('[name=refer]').val().trim()) {
				var len = $('.ref-list li').length;
				
				if (len<5) {
					$('.ref-list').append('<li>'+ $('[name=refer]').val() +'</li>');
					$('[name=refer]').val('');
				} else {
					Materialize.toast('Maximo 5 referencias', 3000);
				}
			} else {
				Materialize.toast('No Puede estar vacia la referencia', 3000);
			}
		});

		$('.save').on('click', function() {
			var len = $('.ref-list li').length;

			if (len>=1) {
				var idProc = $('.product').attr('id'),
				refers = [];

				$('.ref-list li').each(function(ind, ele){
					refers.push('MLV' + $(ele).html());
				});

				$.post('/add-product/save', 
				{
					'productId' : idProc,
					'references': refers,
				},
				function(data) {
					if (data.status=='added') {
						Materialize.toast('Agregado', 3000);
					} else if (data.status=="exist") {
						Materialize.toast('Ya registraste este producto', 3000);
					} else if (data.status=="not found") {
						Materialize.toast('No se encontro el producto', 3000);
					}
				});
			} else {
				Materialize.toast('Minimo 1 referencia', 3000);
			}
		});
	});
</script>
@stop