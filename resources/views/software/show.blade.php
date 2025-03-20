@extends('home')

@section('heading', 'Software Information')

@section('body')
<div class="row">
	<div class="col-md-12">
		@if(Session::get('message'))
			<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
		@endif
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="well">Computer Information</div>
		<p><strong>Hostname:</strong> {{ $software->computer->hostname }}</p>
		<p><strong>User:</strong> {{ $software->computer->user }}</p>
		<p><strong>Department:</strong> {{ $software->computer->department->name }}</p>
		<p><strong>Syteline IP:</strong> {{ $software->computer->syteline }}</p>
		<p><strong>Internet IP:</strong> {{ $software->computer->internet }}</p>
		<p><strong>Installed:</strong> {{ $software->created_at->diffForHumans() }}</p>
	</div>
	<div class="col-md-6">
		<div class="well">Software Information</div>
		<form action="{{ route('software.update', [$software->id]) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<input type="hidden" name="computer_id" value="{{ $software->computer->id }}">
			<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
				<label for="description">Description</label>
				<input type="text" class="form-control" id="description" name="description" value="{{ old('description', $software->description) }}" placeholder="Description">

				@if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group">
				
			</div>
			<div class="form-group">
				<button class="btn btn-success">Update</button>
				{{-- <a href="{{ route('computer.show', $software->computer->id) }}" class="btn btn-default">Cancel</a> --}}
				<a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
</div>
@endsection