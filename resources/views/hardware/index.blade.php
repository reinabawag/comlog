@extends('layouts.app')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Hardware</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>SN</th>
                                        <th>Status</th>
                                        <th>Quantity</th>
                                        <th>UoM</th>
                                        <th>Remarks</th>
                                        <th>Hostname</th>
                                        <th>User</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($hardwares as $hardware)
                                    <tr>
                                        <td title="{{ $hardware->description }}">{{ str_limit($hardware->description, 25) }}</td>
                                        <td>{{ $hardware->category }}</td>
                                        <td>{{ $hardware->sn }}</td>
                                        <td>{{ $hardware->status }}</td>
                                        <td>{{ $hardware->quantity }}</td>
                                        <td>{{ $hardware->uom }}</td>
                                        <td>{{ $hardware->remarks }}</td>
                                        @if ($hardware->computer)
                                            <td>{{ $hardware->computer->hostname }}</td>
                                            <td>{{ $hardware->computer->user }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        <td><a href="{{ route('hardware.edit', $hardware->id) }}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script type="text/javascript">
    $('.table').DataTable();
</script>
@endsection
