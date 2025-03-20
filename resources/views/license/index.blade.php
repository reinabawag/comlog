@extends('layouts.app')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">licenses</div>
				<div class="panel-body">
					<div class="form-group">
						<a href="{{ route('license.create') }}"><span class="glyphicon glyphicon-plus"></span> Add New License</a>	
					</div>
					<table class="table table-hover table-condensed" id="tbl-license">
						<thead>
							<tr>
								<th>Description</th>
								<th>License ID</th>
								<th>Product Key</th>
								<th>Type</th>
								<th>Available</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							@foreach($licenses as $license)
								<tr>
									<td>{{ $license->productVersion }}</td>
									<td>{{ $license->license_id }}</td>
									<td>{{ $license->productKey }}</td>
									<td>{{ $license->licenseType }}</td>
									<td>{{ $license->license_count }}</td>
									<td><a href="{{ route('license.show', $license->id) }}">View</a> | <a href="{{ route('license.show', $license->id) }}">Delete</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tbl-license').DataTable();
	});
</script>
@endsection