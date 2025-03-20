@extends('home')

@section('heading')<strong>Computer Reports</strong>@endsection

@section('body')
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Computer Report</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="" class="control-label">Hostname</label>
						<select class="form-control" width="100px" name="computer_id" id="computer_id">
							
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Harware Monitoring Report</h3>
				</div>
				<div class="panel-body">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic iure molestias at rem, assumenda, facere error minima reprehenderit odit doloremque! Nihil voluptatibus quo est, ut maxime vero vel quibusdam quae.
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Software Monitoring Report</h3>
				</div>
				<div class="panel-body">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic iure molestias at rem, assumenda, facere error minima reprehenderit odit doloremque! Nihil voluptatibus quo est, ut maxime vero vel quibusdam quae.
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script>
	$(document).ready(function() {
		reloadHostnames();
		
		$('#computer_id').multiselect({
			buttonWidth: '100%',
			onDropdownShow: function(event) {
				console.log('it worked');
			}
		});

		function reloadHostnames() {
			$.get('{{ url("/getComputerHostnames") }}')
			.then(function(data) {
				$('select#computer_id').empty();
				$.each(data, function(index, elem) {
					$('select#computer_id').append('<option value="'+elem.id+'">'+elem.hostname+'</option>');
				})
			})
			.done(function() {
				$('#computer_id').multiselect('rebuild');
				$('#computer_id').multiselect('refresh');
			});
		};
	})
</script>
@endsection