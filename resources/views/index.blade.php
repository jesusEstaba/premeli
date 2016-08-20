@extends('recicler.main')
@section('title', 'Jeecs Meli APP')
@section('content')
	<h2>Bienvenidos</h2>
	<input placeholder="email" type="email" name="email" />
	<input placeholder="password" type="password" name="password">
	<button class="btn yellow darken-2 waves-effect login">Entrar</button>
	<a href="http://auth.mercadolibre.com/authorization?response_type=token&client_id={{$meliAppId}}" class="btn blue">Registrase</a>
@stop

@section('script')
<script type="text/javascript">
	$(function(){
		$('.login').on('click', function(event) {
			var email = $('[name=email]').val(),
				pass = $('[name=password]').val();

			if (email && pass) {
				$.post('/login', 
				{
					'email': email,
					'password' : pass,
				},
				function(data) {
					if (data.response === 'ok') {
						window.location.href = '/home';
					} else {
						Materialize.toast('Datos Invalidos', 3000);
					}
				});
			} else {
				Materialize.toast('Campo Vacio', 3000);
			}
		});
	});
</script>
@stop