@extends('layouts.doctor-dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <form action="">
                            <div class="input-group">
                                &nbsp;<input type="date" class="form-control" name="doa" placeholder="Enter appointment date" value="{{ isset($_GET['doa'])?$_GET['doa']:'' }}">
                                &nbsp;
                                &nbsp;<button type="submit" class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filter</button>
                            </div>
                            <!-- /.input group -->
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="dataTable1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">Starting Time Slot</th>
                            <th class="text-center">Ending Time Slot</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointmentdates as $appointmentdate)
                            <tr>
                                <td class="text-center">{{ $appointmentdate->d_o_a}}</td>
                                <td class="text-center">{{ $appointmentdate->time_slot}}</td>
                                <td class="text-center">{{ $appointmentdate->end_time_slot}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    
    <script>
        $(document).ready(function () {
            var App = {
                initialize: function () {
                    var datatable = $('#dataTable1').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                    });
                    
                },
            };
            App.initialize();
        })
    </script>
    
@endpush