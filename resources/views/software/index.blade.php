@extends('layouts.app')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Softwares</div>

                <div class="panel-body">
                    <table class="table table-hover table-condensed" id="tbl-software">
                    	<thead>
                    		<tr>
                    			<th>Description</th>
                    			<th>License Type</th>
                    			<th>License Key</th>
                    			<th>Hostname</th>
                    			<th>User</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($softwares as $software)
                                <tr>
                                    <td>{{ $software->description }}</td>
                                    <td>{{ $software->licenseType }}</td>
                                    <td>{{ $software->licenseKey }}</td>
                                    <td>{{ $software->computer->hostname }}</td>
                                    <td>{{ $software->computer->user }}</td>
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
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tbl-software').DataTable();
	});
</script>
@endsection