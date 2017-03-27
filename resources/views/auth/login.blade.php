<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<form class="form-horizontal margin-form" role="form" method="POST" action="{{ url('/login') }}" id="login-form">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<div class="col-xs-4 col-sm-4 col-md-4 center-vertical text-right">
						<a class="txt-content" href="#" data-dismiss="modal" data-toggle="modal" data-target="#formUsuarioPsd">¿Olvido su contraseña?</a>
						<a href="#" class="txt-content" data-dismiss="modal" data-toggle="modal"  data-target="#formUsuario">Registrarme</a>
					</div>
					
					<div class="col-xs-2 col-sm-2 col-md-2 center-vertical" style="padding: 0px !important;">
						<div class="input-group">
							<input type="email" class="form-control login-control" name="email" id="email" placeholder="Correo Electrónico" value="{{ old('email') }}">
						</div>	
					</div>

					<div class="col-xs-2 col-sm-2 col-md-2" style="padding: 0px !important;">
						<div class="input-group">
							<input type="password" class="form-control login-control" name="password" id="password" placeholder="Contraseña">
						</div>	
					</div>
					
					<div class="col-xs-4 col-sm-4 col-md-4">
						<button type="submit" class="btn btn-primary">Login</button>
						<fb:login-button scope="public_profile,email,user_likes" onlogin="checkLoginState();">
					</fb:login-button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>