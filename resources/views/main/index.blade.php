@extends('layouts.app')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List of American Wire & Cable Computers</div>
                <div class="panel-body">
                    <div class="form-group">
                        <a href="{{ route('computer.create') }}"><span class="glyphicon glyphicon-plus"></span> Add Computer</a>
                    </div>
                    <table class="table table-hover table-condensed" id="tbl-computer-info">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Hostname</th>
                                <th>User</th>
                                <th>internet</th>
                                <th>Syteline</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach($info as $key => $value)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $value->hostname }}</td>
                                    <td>{{ $value->user }}</td>
                                    <td>{{ $value->internet }}</td>
                                    <td>{{ $value->syteline }}</td>
                                    <td><a href="{{ route('computer.show', ['computer' => $value->id]) }}">View</a></td>
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
		$('.table').DataTable();
	});
</script>
@endsection