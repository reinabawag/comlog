@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add Software to <strong>{{ $computer->hostname }}</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well">Computer Information</div>
                            <p><strong>Hostname:</strong> {{ $computer->hostname }}</p>
                            <p><strong>User:</strong> {{ $computer->user }}</p>
                            <p><strong>Syteline IP:</strong> {{ $computer->syteline }}</p>
                            <p><strong>Internet IP:</strong> {{ $computer->internet }}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="well">Sofware Information</div>
                            <form action="{{ route('software.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="computer_id" value="{{ $computer->id }}">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label for="description" class="control-label">Description</label>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Description">

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('license_type') ? 'has-error' : '' }}">
                                    <label for="license_type" class="control-label">License Type</label>
                                    <select name="license_type" id="license_type" class="form-control">
                                        <option value="OEM">OEM</option>
                                        <option value="VL">VL</option>
                                        {{-- @foreach($licenses as $license)
                                            <option value="{{ $license->licenseType }}">{{ $license->licenseType }}</option>
                                        @endforeach --}}
                                    </select>

                                    @if ($errors->has('license_type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('license_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{-- <div class="form-group {{ $errors->has('license_key') ? 'has-error' : '' }}" id="div_license_key">
                                    <label for="license_key" class="control-label">License Key</label>
                                    <input type="text" class="form-control" name="license_key" id="license_key" placeholder="License Key">
                                </div> --}}
                                <div class="form-group {{ $errors->has('sel_license_key') ? 'has-error' : '' }}" id="div-license-key">
                                    <label for="sel_license_key">License Key</label>
                                    <select name="sel_license_key" id="sel_license_key" class="form-control">
                                        {{-- <option value="">Please Select</option>
                                        @foreach($licences as $license)
                                            <option value="{{ $license->id }}">{{ $license->productVersion.' - '.$license->productKey }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                
                                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                    {{ Form::label('type', 'Type', ['class' => 'control-label']) }}
                                    {{ Form::select('type', ['' => '-- Select Type --', 'Default' => 'Default', 'Upgrade' => 'Upgrade', 'Downgrade' => 'Downgrade'], old('type'), ['class' => 'form-control', 'id' => 'type']) }}
                                    
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success">Add</button>
                                    <a role="button" href="{{ route('computer.show', [$computer->id]) }}" class="btn btn-default">Cancel</a>
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

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        loadLicense();    
        $('#license_type').change(function() {
            loadLicense();
        });

        @if (old('license_type'))
            $('#license_type').val('{{ old('license_type') }}');
        @endif
        
        function loadLicense() {
            $.get('{{ route('license.type') }}', {license_type: $('#license_type').val()}, null, 'json')
            .done(function(data) {
                $('#sel_license_key').empty();
                $.each(data, function(index, elem) {
                    $('#sel_license_key').append('<option value="'+elem.id+'">'+elem.productVersion+' '+elem.productKey+'</option>')
                });

                @if (old('sel_license_key'))
                    $('#sel_license_key').val({{ old('sel_license_key') }});
                @endif
            })
            .fail(function() {
                console.log('Cannot Process Request');
            });
        };
    })
</script>
@endsection