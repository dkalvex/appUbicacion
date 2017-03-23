<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" id="login-form">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group text-center">
					<h5>Iniciar Sesión</h5>
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
					<fb:login-button scope="public_profile,email,user_likes" onlogin="checkLoginState();">
					</fb:login-button>
					<a class="btn btn-link" href="{{ url('/password/email') }}">Recordar contraseña</a>
					<a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal"  data-target="#formUsuario">Registrarme</a>
				</div>
			</form>
		</div>
	</div>
</div>

