@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Information of <strong>{{ $computer->hostname }}</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(Session::get('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well">
                                Computer
                            </div>
                            <a href="{{ route('computer.edit', ['computer' => $computer->id]) }}"><span class="glyphicon glyphicon-pencil"></span> Update Computer Information</a><br><br>
                            <p><b>Hostname:</b> {{  $computer->hostname }}</p>
                            <p><b>User:</b> {{ $computer->user }}</p>
                            <p><b>Department:</b> {{ $computer->department->name }}</p>
                            <p><b>Syteline IP:</b> {{ $computer->syteline }}</p>
                            <p><b>Internet IP:</b> {{ $computer->internet }}</p>
                            <p><b>MAC Adress:</b> {{ $computer->macAddress }}</p>
                            <hr>
                            <div class="well">
                                Software
                            </div>
                            <a href="{{ url('software/create', [$computer->id]) }}"><span class="glyphicon glyphicon-plus"></span> Add Software</a><br><br>
                            @foreach($computer->softwares as $software)
                                <strong><a href="{{ route('software.show', [$software->id]) }}">{{ $software->description }}</a></strong> <small><a href="#" val="{{ $software->id }}" des="{{ $software->description }}" class="text-danger" id="a-software-remove">remove</a></small>
                                <ul>
                                    <li>License Type: {{ $software->licenseType }}</li>
                                    <li>License ID: {{ $software->license->license_id or 'None' }}</li>
                                    @if($software->license->productKey)
                                        <li>License Key: {{ $software->license->productKey }}</li>
                                    @endif
                                </ul>
                            @endforeach
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="well">
                                Hardware
                            </div>
                            <a href="{{ route('hardware.add', ['computer' => $computer->id]) }}"><span class="glyphicon glyphicon-plus"></span> Add Hardware</a><br><br>
                            @foreach($computer->hardwares as $hardware)                                
                                <strong><a href="{{ route('hardware.edit', ['hardware' => $hardware->id]) }}">{{ $hardware->description }}</a></strong> <small><a href="#" id="a-remove-hardware" data-id="{{ $hardware->id }}" data-desc="{{ $hardware->description }}" class="text-danger">remove</a></small>
                                <ul>
                                    <li>Category: {{ $hardware->category }}</li>
                                    <li>Status: {{ $hardware->status }}</li>
                                </ul>
                            @endforeach
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="" id="form-delete" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#license_type').change(function() {
            if ($(this).prop('selectedIndex') == 1) {
                $('#div-license-key').show();
                $('#div_license_key').hide();
            } else {
                $('#div-license-key').hide();
                $('#div_license_key').show();
            }
        });

        $('#frm_add_software').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.post(form.attr('action'), form.serialize(), null, 'json')
        });

        $('a#a-software-remove').click(function(e) {
            e.preventDefault();
            var software = $(this);

            bootbox.confirm({
                title: "Confirm Delete",
                message: "Are you sure you want to delete <strong>"+software.attr('des')+"</strong>",
                buttons: {
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    },
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $('form#form-delete').attr('action', '{{ url('software') }}/'+software.attr('val')).submit();
                    }
                }
            });
        });

        $('a#a-remove-hardware').click(function(e) {
            var hardware = $(this);

            bootbox.confirm({
                title: "Confirm Delete",
                message: "Are you sure you want to delete <strong>"+hardware.attr('data-desc')+"</strong>",
                buttons: {
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    },
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $('form#form-delete').attr('action', '{{ url('hardware') }}/'+hardware.attr('data-id')).submit();
                    }
                }
            });
        });
    })
</script>
@endsection