<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link type="text/css" rel="stylesheet" href="{{assets('vendors/materialize/css/materialize.min.css')}}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{assets('css/regular.css')}}"/>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
	<style type="text/css">
		body {
		    display: flex;
		    min-height: 100vh;
		    flex-direction: column;
	  	}
	
	 	main {
	 		padding-top: 1em;
			flex: 1 0 auto;
		}
	</style>
</head>
<body>
	<nav class="yellow black-text">
		<div class="container">
			<div class="row">
				<div class="col s6">
					
					@if(Auth::check())
						 <a href="/home" title="Premeli"><h4 class="black-text">Premeli</h4></a>
					@else
						<a href="/" title="Premeli"><h4 class="black-text">Premeli</h4></a>
					@endif

					
				</div>
				<div class="col s6">
					@if(Auth::check())
						<a href="/logout" class="blue-text pull-right">Cerrar sesión</a>
					@endif
					
				</div>
			</div>
		</div>
	</nav>
	<main>
		<div class="container">
			<div class="row">
				<div class="col s12">
					@yield('content')
				</div>
			</div>
		</div>
	</main>
	<footer class="page-footer yellow">
		<div class="footer-copyright black-text">
			<div class="container">
				© 2018 Copyright <a href="http://estaba.site" target="_blank">Jesús Estaba</a>
			</div>
		</div>
    </footer>
	<script type="text/javascript" src="{{assets('vendors/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{assets('vendors/materialize/js/materialize.min.js')}}"></script>
    @yield('script')
</body>
</html>