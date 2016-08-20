@extends('recicler.main')
@section('title', 'Registro')
@section('content')
	<h2>Registro</h2>
		<input type="email" placeholder="email" name="email" />
		<input type="password" placeholder="password" name="password" />
		<input type="password" placeholder="repeat" name="repeat">
		<button class="btn green register">Registrar</button>
	
@stop

@section('script')
<script type="text/javascript">
	function getToken() {
		var vars = {};
		var parts = window.location.href.replace(/[#]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
		});
		return vars['access_token'];
	}

	function getUserId() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
		});
		return vars['user_id'];
	}

	console.info(getToken());
	console.info(getUserId());

	$(function(){
		$('.register').on('click', function(event) {
			var email = $("[name=email]").val(),
				pass = $("[name=password]").val(),
				repeat = $("[name=repeat]").val();

			if (repeat===pass && email && pass && repeat) {
				if (getToken() && getUserId()) {
					$.post('/register/verify-email', 
					{
						'email': email,
					}, 
					function(data) {
						if (data.status==='free') {
							$.post('/register/meli-token', 
							{
								'email' : email,
								'password' : pass,
								'meliUserId' : getUserId(),
								'meliToken' : getToken(),
							}, function(data) {
								if (data.status==='registered') {
									$('.register')
										.removeClass('green')
										.addClass('blue')
										.html('Iniciar Sesion')
										.off()
										.on('click', function() {
											window.location.href = "/";
										});
								} else {//exist
									Materialize.toast('Este usuario ya existe', 3000);
								}
							});
						} else {
							Materialize.toast('Ya existe una cuenta con este correo', 3000);
						}
					});
				} else {
					Materialize.toast('No tenemos los datos de Mercadolibre '+
					'<a class="yellow-text" href="http://mercadolibre.com">PERMITIR</a>', 3000);
				}
			} else {
				if (repeat===pass) {
					Materialize.toast('Campo Vacio', 3000);
				} else {
					Materialize.toast('Las Contraseñas No Coinciden', 3000);
				}
				
			}
		});
	});

</script>
@stop