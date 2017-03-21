@extends('app')

@section('content')
<div class="container-fluid map-container">
	<div class="row map-container">
		<div class="col-xs-2 col-sm-2 col-md-2" id="user_content">

			@if (\Session::get('user.nombre') != '')
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<label>{{ \Session::get('user.nombre') }} {{ \Session::get('user.apellido') }}</label>
					<a href="{{ url('/logout') }}">
						<i class="glyphicon glyphicon-off"></i>
					</a>
				</div>
			</div>	
			@else
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					@include('auth.login')
				</div>	
			</div>		
			@endif				

			<div class="row pre-scrollable"  id="container_ubicaciones"> 			
			</div>
			
			<div class="row">
				<div class='alert alert-success' id="alert_model" style="display:none"></div>
				@if(isset($errors) and count($errors) > 0)
				<div class='alert alert-warning' id="alert_model1">
					@foreach ($errors as $error)						
					<ul>
						<li> {{ $error }} </li>
					</ul>
					@endforeach
				</div>
				@endif

				@if(isset($message) and count($message) > 0)
				<div class='alert alert-success' id="alert_model2">
					@foreach ($message as $message)						
					<ul>
						<li> {{ $message }} </li>
					</ul>
					@endforeach
				</div>
				@endif
			</div>	
		</div>

		<div class="col-xs-10 col-sm-10 col-md-10 map-container">
			<div class="form-grup">				
				<input type="text" class="form-control input-sm controls pac-input" id="search_box">
			</div>
			<div class="map" id="map"></div>
		</div>

		<div id="formUsuario"  class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h5 class="modal-title" id="exampleModalLongTitle">Resgistrarme</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@include('user.new')
				</div>
			</div>
		</div>

		<div id="formUbicacion"  class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form role="form" method="POST" id="ubicacionForm" class="form-horizontal">
						<div class="modal-header text-center">
							<h5 class="modal-title" id="exampleModalLongTitle">Nueva Ubicación</h5>
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
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">									
									<div class="form-group">
										<label class="col-xs-12 col-md-4">Direccion</label>
										<div class="col-xs-12 col-md-8">
											<input type="text" required class="form-control input-sm" name="direccion" id="direccion">
										</div>
									</div>
									<div class="form-group">
										<label class="col-xs-12 col-md-4">Numero</label>
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
							</div>
						</div>
						<div class="modal-footer">
							<button id="guardar" class="btn btn-primary">Guardar</button>
							<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div id="formUbicacion-edit"  class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			@include('ubicacion.edit')	
		</div>


		<div id="confirModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Ubicaciones</h4>
					</div>
					<div class="modal-footer">
						<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>
						<!--<a style="margin-top: 5px" class="twitter-follow-button " data-show-count="false"
						href="https://twitter.com/TwitterDev">
						Follow</a>-->
						<button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal"  id="btnConfirm" data-target="#formUbicacion" >Si</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
	var APP_URL = {!! json_encode(url('/')) !!};
</script>
<script src="{{ asset('/js/maps.js') }}"></script>
<script src="{{ asset('/js/ubicaciones.js') }}"></script>
@endsection