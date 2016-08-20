<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link type="text/css" rel="stylesheet" href="{{url('vendors/materialize/css/materialize.min.css')}}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{url('css/regular.css')}}"/>

</head>
<body>
	<nav class="yellow black-text">
		<div class="container">
			<div class="row">
				<div class="col s6">
					
					@if(Auth::check())
						 <a href="/home" title="Meli Jeec App"><h4 class="black-text">Meli Jeec App</h4></a>
					@else
						<a href="/" title="Meli Jeec App"><h4 class="black-text">Meli Jeec App</h4></a>
					@endif

					
				</div>
				<div class="col s6">
					@if(Auth::check())
						<a href="/logout" class="blue-text">logout</a>
					@endif
					
				</div>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col s12">
				@yield('content')
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{url('vendors/jquery/jquery.min.js')}}"></script>
      <script type="text/javascript" src="{{url('vendors/materialize/js/materialize.min.js')}}"></script>
    @yield('script')
</body>
</html>