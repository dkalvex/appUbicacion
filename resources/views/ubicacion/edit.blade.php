<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<form role="form" method="POST" id="ubicacionForm-edit" class="form-horizontal">
			<div class="modal-header text-center">
				<h5 class="modal-title txt-tittle color-black" id="exampleModalLongTitle">Editar Ubicación</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<input type="hidden" name="idUbicacion" id="idUbicacion">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-xs-12 col-md-4">Codigo Postal</label>
							<div class="col-xs-12 col-md-8">
								<input type="text" required class="form-control input-sm " name="codPostal" id="codPostal-edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-md-4">Pais</label>
							<div class="col-xs-12 col-md-8">
								<input type="text" required class="form-control input-sm" name="pais" id="pais-edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-md-4">Comunidad</label>
							<div class="col-xs-12 col-md-8">
								<input type="text" required class="form-control input-sm " name="comunidad" id="comunidad-edit">
							</div>
						</div>									
						<div class="form-group">
							<label class="col-xs-12 col-md-4">Ciudad</label>
							<div class="col-xs-12 col-md-8">
								<input type="text" required class="form-control input-sm " name="ciudad" id="ciudad-edit">
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">									
						<div class="form-group">
							<label class="col-xs-12 col-md-4">Direccion</label>
							<div class="col-xs-12 col-md-8">
								<input type="text" required class="form-control input-sm" name="direccion" id="direccion-edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-md-4">Numero</label>
							<div class="col-xs-12 col-md-8">
								<input type="text" required class="form-control input-sm" name="num" id="num-edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-md-4">Piso</label>
							<div class="col-xs-12 col-md-8">
								<input type="text" required class="form-control input-sm" name="piso" id="piso-edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-md-4">Esc</label>
							<div class="col-xs-12 col-md-8">
								<input type="text" required class="form-control input-sm" name="esc" id="esc-edit">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-md-4">Puerta</label>
							<div class="col-xs-12 col-md-8">
								<input type="text" required class="form-control input-sm" name="puerta" id="puerta-edit">
							</div>
						</div>
						<input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
					</div>
					<div class="col-xs-5 col-sm-5 col-md-5">
						<label class="col-xs-12 col-md-4">Latitud</label>
						<div class="col-xs-12 col-md-8">
							<input type="text" class="form-control input-sm" name="lat"  id="lat-edit" readonly="readonly">
						</div>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-5">
						<label class="col-xs-12 col-md-4">Longitud</label>
						<div class="col-xs-12 col-md-8">
							<input type="text" class="form-control input-sm" name="long" id="lng-edit" readonly="readonly">
						</div>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2">
						<input type="button" class="btn btn-default" id="btUpdateL" value="Actualizar">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="guardar" class="btn btn-primary">Guardar</button>
				<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</form>
	</div>
</div>
