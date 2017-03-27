<div class="modal-body">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<form role="form" method="POST" id="resetPsdForm" class="form-horizontal">
					<div class="form-group">
						<label for="email" class="col-xs-12 col-md-4">Correo electrónico</label>
						<div class="col-xs-12 col-md-8">
							<input type="email" class="form-control" name="email" required>
							<div id="error_email" class="label label-danger"></div>
						</div>
					</div>

					<div class="form-group">
						<label for="birth_date" class="col-xs-12 col-md-4">Nueva Contraseña</label>
						<div class="col-xs-12 col-md-8">
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>

					<div class="form-group">
						<label for="birth_date" class="col-xs-12 col-md-4">Repetir Contraseña</label>
						<div class="col-xs-12 col-md-8">
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>
					
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-xs-offset-4 col-sm-offset-4 col-md-offset-4">
					<div class="form-group">
						<div id="html_element2"></div>		
					</div>
				</div>
			</div>
		</div>
		<div clas="col-xs-12 col-sm-12 col-md-12">
			<div class='alert alert-success' id="alert_model_rest_psd" style="display:none"></div>
		</div>
		<input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
	</div>
	<div class="modal-footer">
		<button id="btnResetPsd" class="btn btn-primary btn-full" disabled>Guardar</button>
		<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div>
</form>
