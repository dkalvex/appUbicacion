@extends('app')

@section('content')

<div class="container-fluid map-container">
	<div class="row map-container">

		<div class="col-xs-2 col-sm-2 col-md-2 ">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<label>{{ \Session::get('user.nombre') }} {{ \Session::get('user.apellido') }}</label>
					<a href="{{ url('/logout') }}">
						<i class="glyphicon glyphicon-off"></i>
					</a>
				</div>
			</div>		
			<div class="row pre-scrollable"  id="container_ubicaciones"> 				
			</div>		
			<div class="row">
				<div class='alert alert-success' id="alert_model" style="display:none"></div>
			</div>	
		</div>

		<div class="col-xs-10 col-sm-10 col-md-10 map-container">
			<div class="form-grup">				
				<input type="text" class="form-control input-sm controls pac-input" id="search_box">
			</div>
			<div class="map" id="map"></div>
		</div>

		<div id="formUbicacion" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<form role="form" method="POST" id="ubicacionForm" class="form-horizontal">
						<div class="modal-header text-center">
							Nueva Ubicacion
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-xs-12 col-md-4">Codigo Postal</label>
								<div class="col-xs-12 col-md-8">
									<input type="text" required class="form-control input-sm " name="codPostal" id="codPostal">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-md-4">Pais</label>
								<div class="col-xs-12 col-md-8">
									<input type="text" required class="form-control input-sm" name="pais" id="pais">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-md-4">Comunidad</label>
								<div class="col-xs-12 col-md-8">
									<input type="text" required class="form-control input-sm " name="comunidad" id="comunidad">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-md-4">Ciudad</label>
								<div class="col-xs-12 col-md-8">
									<input type="text" required class="form-control input-sm " name="ciudad" id="ciudad">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-md-4">Direccion</label>
								<div class="col-xs-12 col-md-8">
									<input type="text" required class="form-control input-sm" name="direccion" id="direccion">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-md-4">Num</label>
								<div class="col-xs-12 col-md-8">
									<input type="text" required class="form-control input-sm" name="num" id="num">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-md-4">Piso</label>
								<div class="col-xs-12 col-md-8">
									<input type="text" required class="form-control input-sm" name="piso" id="piso">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-md-4">Esc</label>
								<div class="col-xs-12 col-md-8">
									<input type="text" required class="form-control input-sm" name="esc" id="esc">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-md-4">Puerta</label>
								<div class="col-xs-12 col-md-8">
									<input type="text" required class="form-control input-sm" name="puerta" id="puerta">
								</div>
							</div>
							<input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
							<input type="hidden" class="form-control input-sm" name="lat"  id="lat">
							<input type="hidden" class="form-control input-sm" name="long" id="lng">
						</div>
						<div class="modal-footer">
							<button id="guardar" class="btn btn-primary">Guardar</button>
							<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>


		<div id="confirModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Ubicaciones</h4>
					</div>
					<div class="modal-body">
						<p>Desea guardar ubicación?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#formUbicacion">Si</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('/js/maps.js') }}"></script>
<script src="{{ asset('/js/ubicaciones.js') }}"></script>
@endsection