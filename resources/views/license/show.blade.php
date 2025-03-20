@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">ADD License</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							@if(Session::get('message'))
								<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="well">License</div>
							<form action="{{ route('license.update', $license->id) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								<div class="form-group {{ $errors->has('productVersion') ? 'has-error' : '' }}">
									<label for="productVersion" class="control-label">Description</label>
									<input type="text" class="form-control" id="productVersion" value="{{ old('productVersion', $license->productVersion) }}" name="productVersion" placeholder="Description">

				        			@if ($errors->has('productVersion'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('productVersion') }}</strong>
				                        </span>
				                    @endif
								</div>
								
								<div class="form-group {{ $errors->has('license_id') ? 'has-error' : '' }}">
									<label for="productVersion" class="control-label">License ID</label>
									<input type="text" class="form-control" id="license_id" value="{{ old('license_id', $license->license_id) }}" name="license_id" placeholder="License ID">

				        			@if ($errors->has('license_id'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('license_id') }}</strong>
				                        </span>
				                    @endif
								</div>

								<div class="form-group {{ $errors->has('productKey') ? 'has-error' : '' }}">
									<label for="productKey" class="control-label">Product Key</label>
									<input type="text" class="form-control" id="productKey" value="{{ old('productKey', $license->productKey) }}" name="productKey" placeholder="Product Key">

									@if ($errors->has('productKey'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('productKey') }}</strong>
				                        </span>
				                    @endif
								</div>
								<div class="form-group {{ $errors->has('licenseType') ? 'has-error' : '' }}">
									<label for="licenseType" class="control-label">License Type</label>
									<select name="licenseType" id="licenseType" class="form-control" value="{{ old('licenseType') }}">
										<option value="OEM" {{ old('licenseType', $license->licenseType) == 'OEM' ? 'selected="selected"' : '' }}>OEM</option>
										<option value="VL" {{ old('licenseType', $license->licenseType) == 'VL' ? 'selected="selected"' : '' }}>Volume License</option>
									</select>

									@if ($errors->has('licenseType'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('licenseType') }}</strong>
				                        </span>
				                    @endif
								</div>
								<div class="form-group {{ $errors->has('license_count') }}" style="{{ old('licenseType') == 'VL' ? '' : 'display: none;'  }}" id="form-license-count">
									<label for="license_count" class="control-label">License Count</label>
									<input type="number" class="form-control" name="license_count" value="{{ old('license_count') }}" id="license_count" placeholder="License Count">

									@if ($errors->has('license_count'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('license_count') }}</strong>
				                        </span>
				                    @endif
								</div>
								<div class="form-group">
									<button role="submit" class="btn btn-success btn-sm">Save</button>
									<a role="button" class="btn btn-default btn-sm" href="{{ URL::previous() }}">Cancel</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection