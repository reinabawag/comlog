@extends('home')

@section('heading', 'List Of Employee In '.$department->name)

@section('body')
<div class="row">
	<div class="col-md-12">
		@foreach($department->computers as $computer)
			<p><a href="{{ route('computer.show', $computer->id) }}">{{ $computer->hostname }}</a> {{ $computer->user }}</p>
		@endforeach

		<a role="button" class="btn btn-default btn-sm" href="{{ URL::previous() }}">Back</a>
	</div>
</div>
@endsection