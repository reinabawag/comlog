@extends('home')

@section('heading', 'Update '.$computer->hostname. ' Computer Information')

@section('body')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="well">Computer Information</div>
		<form action="{{ route('computer.update', ['computer' => $computer->id]) }}" method="POST">
    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
    		{{ method_field('PUT') }}
    		<div class="form-group {{ $errors->has('hostname') ? 'has-error' : '' }}">
    			<label for="hostname" class="control-label">Hostname</label>
    			<input type="text" class="form-control" name="hostname" value="{{ old('hostname', $computer->hostname) }}" id="hostname" placeholder="Hostname">

    			@if ($errors->has('hostname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('hostname') }}</strong>
                    </span>
                @endif
    		</div>
    		<div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
    			<label for="user" class="control-label">User</label>
    			<input type="text" class="form-control" name="user" value="{{ old('user', $computer->user) }}" id="user" placeholder="User">

    			@if ($errors->has('user'))
                    <span class="help-block">
                        <strong>{{ $errors->first('user') }}</strong>
                    </span>
                @endif
    		</div>

			<div class="form-group {{ $errors->has('department_id') ? 'has-error' : '' }}">
    			<label for="department_id" class="control-label">Department</label>
    			<select class="form-control" name="department_id" id="department_id">
    				<option value="">-- Select Department --</option>
    				@foreach($departments as $department)
						<option{{ $department->id == old('department_id', $computer->department_id) ? ' selected' : ''}} value="{{ $department->id }}">{{ $department->name }}</option>
    				@endforeach
				</select>
    			@if ($errors->has('department_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('department_id') }}</strong>
                    </span>
                @endif
    		</div>

    		<div class="form-group {{ $errors->has('syteline') ? 'has-error' : '' }}">
    			<label for="syteline" class="control-label">Syteline IP</label>
    			<input type="text" class="form-control" name="syteline" value="{{ old('syteline', $computer->syteline) }}" id="syteline" placeholder="Syteline IP">

    			@if ($errors->has('syteline'))
                    <span class="help-block">
                        <strong>{{ $errors->first('syteline') }}</strong>
                    </span>
                @endif
    		</div>
    		<div class="form-group {{ $errors->has('internet') ? 'has-error' : '' }}">
    			<label for="internet" class="control-label">Internet IP</label>
    			<input type="text" class="form-control" name="internet" value="{{ old('internet', $computer->internet) }}" id="internet" placeholder="Internet IP">

    			@if ($errors->has('internet'))
                    <span class="help-block">
                        <strong>{{ $errors->first('internet') }}</strong>
                    </span>
                @endif
    		</div>
    		<div class="form-group {{ $errors->has('macAddress') ? 'has-error' : '' }}">
    			<label for="macAddress" class="control-label">MAC Address</label>
    			<input type="text" class="form-control" name="macAddress" value="{{ old('macAddress', $computer->macAddress) }}" id="macAddress" placeholder="MAC Address">

    			@if ($errors->has('macAddress'))
                    <span class="help-block">
                        <strong>{{ $errors->first('macAddress') }}</strong>
                    </span>
                @endif
    		</div>
    		<div class="form-group">
    			<button type="submit" class="btn btn-primary btn-sm">Update</button>
                <a role="button" href="{{ URL::previous() }}" class="btn btn-default btn-sm">Cancel</a>
    		</div>
    	</form>
	</div>
</div>
@endsection