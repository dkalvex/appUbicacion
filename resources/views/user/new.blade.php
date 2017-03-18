<div class="modal-body">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="col-xs-12">
				<form role="form" method="POST" action="{{ url('/user/newSave') }}" id="NewUser-form" class="form-horizontal">
					<div class="form-group">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</div>
					<div class="form-group">
						<label for="first_name" class="col-xs-12 col-md-4">Nombres</label>
						<div class="col-xs-12 col-md-8">
							<input type="text" class="form-control" name="nombre" id="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="last_name" class="col-xs-12 col-md-4">Apellidos</label>
						<div class="col-xs-12 col-md-8">
							<input type="text" class="form-control" name="apellido" id="apellido" required>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-xs-12 col-md-4">Correo electrónico</label>
						<div class="col-xs-12 col-md-8">
							<input type="email" class="form-control" name="email" id="email" required>
							<div id="error_email" class="label label-danger"></div>
						</div>
					</div>

					<div class="form-group">
						<label for="birth_date" class="col-xs-12 col-md-4">Contraseña</label>
						<div class="col-xs-12 col-md-8">
							<input type="password" class="form-control" name="password" id="password" required>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button id="guardar" class="btn btn-primary btn-full">Guardar</button>
		<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div>
</form>
