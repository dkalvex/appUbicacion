@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-xs-12 col-sm-6 col-sm-offset-5 col-md-4 col-md-offset-6">
			<!--<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}" id="login-form">!-->
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" id="login-form">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<h1>Iniciar Sesión</h1>
					<h5>Usa tus credenciales para ingresar a la plataforma</h5>
					<?php 						
						if(count($errors) > 0){

							echo "<div class='alert alert-danger'>
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>";
									foreach($errors as $error){
										echo "<li>". $error ."</li>";
									}
								echo"</ul>
							</div>";
						}
					?>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="email" class="form-control login-control" name="email" id="email" placeholder="Correo Electrónico" value="{{ old('email') }}">
						<span class="input-group-addon login-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="password" class="form-control login-control" name="password" id="password" placeholder="Contraseña">
						<span class="input-group-addon login-addon"><i class="glyphicon glyphicon-lock"></i></span>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Login</button>
					<a class="btn btn-link" href="{{ url('/password/email') }}">Olvidé mi contraseña</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
