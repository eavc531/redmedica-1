<!DOCTYPE html>
<html>
<head>
	<title>Medicossi</title>
	{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">

	{{-- <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.1.221/styles/kendo.common-material.min.css" />
	<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.1.221/styles/kendo.material.min.css" />
	<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.1.221/styles/kendo.material.mobile.min.css" /> --}}
	@yield('css')

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

	<nav class="navbar navbar-toggleable-md navbar-config">
		@if(Auth::check())
		<a class="navbar-brand pl-3" id="show" href="#"><i class="fas fa-bars"></i></a>
		@endif
			<ul class="navbar-nav nav">
				<div class="dropdown text-center">
					@if(Auth::check())
					<li class=""  id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a href="" class="font-navbar text-center">{{Auth::user()->name}}</a></li>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
					    <a href="#" class="btn-block my-1 btn-config-login btn">Editar perfil</a>
							<form action="{{route('logout')}}" method="POST">
								{{csrf_field()}}
								<button type="submit" name="button" class="btn-block btn-config-login btn my-1">Cerrar sesión</button>
							</form>
					  </div>
					@endif
				</div>

				<li class="font-navbar"> Servicios profesionales para tu salud</li>
			</ul>
		<a href="{{route('home')}}" class="position-img-navbar"><img src="{{asset('img/Medicossi-Marca original-01.png')}}" alt="" class="img-navbar"></a>
	</nav>


 <section class="section-dashboard mb-3">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-lg-2 ">
				@include('layouts.dashboard')
			</div>
			<div class="col-lg-8 col-12 box-mesage text-center">
				@include('notifications.alerts')
				@yield('content')
			</div>
			<div class="col-2"></div>
		</div>
	</div>
</section>
	<footer>
		<div class="section-footer fixed-bottom">
			<div class="row align-items-center nomargin p-1">
				<div class="col-lg-6 col-sm-6 col-12 text-center nopadding">
					<a href="" class="p-2"><img class="buttons-footer" src="{{asset('img/botones-medicossi-13.png')}}" alt=""></a>
					<a href="" class="p-2"><img class="buttons-footer" src="{{asset('img/botones-medicossi-14.png')}}" alt=""></a>
					<a href="" class="p-2"><img class="buttons-footer" src="{{asset('img/botones-medicossi-15.png')}}" alt=""></a>
					<a href="" class="p-2"><img class="buttons-footer" src="{{asset('img/botones-medicossi-16.png')}}" alt=""></a>
				</div>
				<div class="col-lg-6 col-sm-6 col-12 text-center nopadding">
					<span class="font-footer"><b>MedicosSi</b> siempre encontrarás tu mejor opción.</span>
				</div>
			</div>
		</div>
	</footer>

</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
	<script src="https://use.fontawesome.com/7886bdfbdc.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	{{-- <script src="https://kendo.cdn.telerik.com/2018.1.221/js/kendo.all.min.js"></script>
	<script src="https://kendo.cdn.telerik.com/2018.1.221/js/kendo.timezones.min.js"></script> --}}

	<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
	@yield('scriptJS')
</html>
