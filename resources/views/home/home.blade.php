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
			<div class="row">
				
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="col-xs-12 text-center">
								<a href="#">
									<i class="glyphicon glyphicon-record">Titulo</i>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="col-xs-12 text-center">
								<a href="#">
									<i class="glyphicon glyphicon-record">Titulo</i>
								</a>
							</div>
						</div>
					</div>
				</div>
				
			</div>			
		</div>

		<div class="col-xs-10 col-sm-10 col-md-10 map-container">
			<div class="form-grup">				
				<input type="text" class="form-control input-sm controls pac-input" id="search_box">
			</div>
			<div class="map" id="map"></div>
		</div>


		<div class="modal fade" id="formUbicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header text-center">
						Nueva Ubicacion
					</div>
					<div class="modal-body">
						<form role="form" method="POST" action="{{ url('/ubucacion/newSave') }}" class="form-horizontal">
							<div class="form-grup">
								<label>Codigo Postal</label>
								<input type="text" class="form-control input-sm" name="codPostal">
							</div>
							<div class="form-grup">
								<label>Pais</label>
								<input type="text" class="form-control input-sm" name="pais">
							</div>
							<div class="form-grup">
								<label>Comunidad</label>
								<input type="text" class="form-control input-sm" name="comunidad">
							</div>
							<div class="form-grup">
								<label>Ciudad</label>
								<input type="text" class="form-control input-sm" name="ciudad">
							</div>
							<div class="form-grup">
								<label>Direccion</label>
								<input type="text" class="form-control input-sm" name="direccion">
							</div>
							<div class="form-grup">
								<label>Num</label>
								<input type="text" class="form-control input-sm" name="num">
							</div>
							<div class="form-grup">
								<label>Piso</label>
								<input type="text" class="form-control input-sm" name="piso">
							</div>
							<div class="form-grup">
								<label>Esc</label>
								<input type="text" class="form-control input-sm" name="esc">
							</div>
							<div class="form-grup">
								<label>Puerta</label>
								<input type="text" class="form-control input-sm" name="puerta">
							</div>
							<div class="form-grup">
								<label>Latitud</label>
								<input type="text" class="form-control input-sm" name="lat" id="lat">
							</div>
							<div class="form-grup">
								<label>Longitud</label>
								<input type="text" class="form-control input-sm" name="long" id="lng">
							</div>
						</form>
					</div>
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

		<!--<form role="form" method="POST" action="{{ url('/ubucacion/newSave') }}" class="form-horizontal">
			<div class="form-grup">
				<input type="text" class="form-control input-sm" name="lat">
			</div>
			<div class="form-grup">
				<input type="text" class="form-control input-sm" name="lat">
			</div>
		</form>-->

	</div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('/js/maps.js') }}"></script>
@endsection