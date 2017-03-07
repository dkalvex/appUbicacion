@extends('app')

@section('content')

<div class="container-fluid map-container">
	<div class="row map-container">
		<div class="col-xs-2 col-sm-2 col-md-2 "></div>
		<div class="col-xs-10 col-sm-10 col-md-10 map-container">
			<div class="form-grup">				
				<input type="text" class="form-control input-sm controls pac-input" id="search_box">
			</div>
			<div class="map" id="map"></div>
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