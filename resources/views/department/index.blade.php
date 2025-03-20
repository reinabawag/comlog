@extends('layouts.app')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    <div class="row">
                    	<div class="col-md-12">
                    		@if(Session::get('message'))
                    			<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                    		@endif
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-8">
                    		<table class="table table-hover table-condensed" id="tbl-department">
                    			<thead>
                    				<tr>
                    					<th>Department</th>
                    					<th>Option</th>
                    				</tr>
                    			</thead>
                    			<tbody>
                    				{{-- @foreach($departments as $department)
                    					<tr>
                    						<td>{{ $department->name }}</td>
                    						<td><a href="{{ route('department.show', ['department' => $department->id]) }}">View</a> | <a href="{{ route('department.edit', ['department' => $department->id]) }}" id="a-department-update">Update</a></td>
                    					</tr>
                    				@endforeach --}}
                    			</tbody>
                    		</table>
                    	</div>
                    	<div class="col-md-4">
                    		<p>Add Department</p>
                    		<form action="{{ route('department.store') }}" method="POST">
                    			{{ csrf_field() }}
                    			<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    				<label for="name">Name</label>
                    				<input type="text" name="name" id="name" class="form-control" placeholder="Department Name" required="">

                    				@if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                    			</div>
                    			<button class="btn btn-primary btn-block">Add</button>
                    		</form>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-dept">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update <span id="modal-dept-name">Department</span></h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" id="form-department">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<label for="name" class="control-label">Department</label>
						<input type="text" name="name" id="name" class="form-control" placeholder="Department">

						<span class="help-block" style="display: none;"></span>
					</div>
				</form>				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="$('#form-department').trigger('submit')">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script>
var table = $('.table').DataTable({
	processing: true,
	serverSide: true,
	ajax: {
		url: '{{ route('department.list') }}',
		type: 'POST',
		data: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	},
});
$.noConflict();
jQuery(document).ready(function() {
	// $('#tbl-department a#a-department-update').click(function(e) {
	$('#tbl-department').on('click', ' a#a-department-update', function(e) {
		e.preventDefault();
		var department = $(this);
		$.get(department.attr('href'), null, null, 'json')
		.then(function(data) {
			$('#form-department input#id').val(data.id);
			$('#form-department input#name').val(data.name);
			$('#modal-dept').modal('show');
		})
		.fail(function() {
			toastr.error('Cannot process request', 'Error');
		})
	});

	$('.modal').on('hide.bs.modal', function(e) {
		$('#form-department :input').parent('div').removeClass('has-error').val('');
		$('#form-department :input').parent('div').find('span').hide().empty();
	});

	$('#form-department').submit(function(e) {
		e.preventDefault();
		$.post('{{ url('department') }}/'+$('#form-department input#id').val(), $(this).serialize(), null, 'json')
		.done(function(data) {
			if (data.status) {
				$('.modal').modal('toggle');
				toastr.success(data.msg, 'Success');
				table.ajax.reload();
			} else {
				$('.modal').modal('toggle');
				toastr.error(data.msg, 'Error');
			}
		})
		.fail(function(data) {
			$.each(data.responseJSON, function(index, elem) {
				$('#form-department input#'+index).parent('div').addClass('has-error');
				$('#form-department input#'+index).parent('div').find('span').show().html('<strong>'+elem[0]+'</strong>');
			});
		})
	});
});
</script>
@endsection