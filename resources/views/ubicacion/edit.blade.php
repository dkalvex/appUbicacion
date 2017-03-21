			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form role="form" method="POST" id="ubicacionForm-edit" class="form-horizontal">
						<div class="modal-header text-center">
							<h5 class="modal-title" id="exampleModalLongTitle">Editar Ubicación</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
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
									<input type="hidden" name="token" id="token-edit" value="{{ csrf_token() }}">
									<input type="hidden" class="form-control input-sm" name="lat"  id="lat-edit">
									<input type="hidden" class="form-control input-sm" name="long" id="lng-edit">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-grup">				
										<input type="text" class="form-control input-sm controls pac-input" id="search_box_edit" name="search_box_edit">
									</div>
									<div id="conten_map_edit" style="height: 250px"></div>
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