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
                            <div class="well">Hardware Information</div>
                            <form action="{{ route('hardware.store', $computer) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label for="description" class="control-label">Description</label>
                                    <input type="text" class="form-control" name="description" value="{{ old('description') }}" id="description" placeholder="Description">

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{-- <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                    <label for="type" class="control-label">Type</label>
                                    <select class="form-control" name="type" id="type" placeholder="Type">
                                        <option value="">Please Select Type</option>
                                        <option value="Desktop">Desktop</option>
                                        <option value="Laptop">Laptop</option>
                                    </select>

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div> --}}
                                <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                    <label for="category" class="control-label">Category</label>
                                    <select type="text" class="form-control" name="category" id="category" placeholder="Category">
                                        <option value="">Please Select Category</option>
                                        <option value="AVR">AVR</option>
                                        <option value="CD/DVD Rom">CD/DVD Rom</option>
                                        <option value="CMOS Battery">CMOS Battery</option>
                                        <option value="External Hard Drive">External Hard Drive</option>
                                        <option value="Video Card">Video Card</option>
                                        <option value="Hard Disk">Hard Disk</option>
                                        <option value="Ink Cartridge">Ink Cartridge</option>
                                        <option value="Keyboard">Keyboard</option>
                                        <option value="LAN Card">LAN Card</option>
                                        <option value="Laptop">Laptop</option>
                                        <option value="Laptop Adapter">Laptop Adapter</option>
                                        <option value="Laptop Battery">Laptop Battery</option>
                                        <option value="Monitor">Monitor</option>
                                        <option value="Motherboard">Motherboard</option>
                                        <option value="Mouse">Mouse</option>
                                        <option value="Power Supply">Power Supply</option>
                                        <option value="Processor">Processor</option>
                                        <option value="RAM">RAM</option>
                                        <option value="Switches/Hub">Switches/Hub</option>
                                        <option value="UPS Battery">UPS Battery</option>
                                        <option value="UPS">UPS</option>
                                    </select>

                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('sn') ? 'has-error' : '' }}">
                                    <label for="sn" class="control-label">Serial Number</label>
                                    <input type="text" class="form-control" name="sn" value="{{ old('sn') }}" id="sn" placeholder="Serial Number">

                                    @if ($errors->has('sn'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sn') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label for="status" class="control-label">Status</label>
                                    <select class="form-control" name="status" id="status" placeholder="Type">
                                        <option value="">Please Select Status</option>
                                        <option value="In Use">In Use</option>
                                        <option value="Replacement">Replacement</option>
                                        <option value="Defective">Defective</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                                    <label for="quantity" class="control-label">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" id="quantity" placeholder="Quantity">

                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('uom') ? 'has-error' : '' }}">
                                    <label for="uom" class="control-label">UoM</label>
                                    <select class="form-control" name="uom" id="uom" placeholder="UoM">
                                        <option value="">Please Select UoM</option>
                                        <option value="PCS">PCS</option>
                                        <option value="BX">BX</option>
                                    </select>

                                    @if ($errors->has('uom'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('uom') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                                    <label for="remarks" class="control-label">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" value="{{ old('remarks') }}" id="remarks" placeholder="Remarks">

                                    @if ($errors->has('remarks'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('remarks') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Add</button>
                                    <a href="{{ route('computer.show', [$computer->id]) }}" class="btn btn-default">Cancel</a>
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
        $('#status').val('{{ old('status') }}');
        $('#category').val('{{ old('category') }}');
        $('#uom').val('{{ old('uom') }}');
    });
</script>
@endsection