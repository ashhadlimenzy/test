@extends('layouts.admin-dashboard')

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
                                <input type="text" class="form-control" name="name" placeholder="Enter doctor's name" value="{{ isset($_GET['name'])?$_GET['name']:'' }}">
                                &nbsp;
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
                            <th class="text-center">Doctor's Name</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Starting Time Slot</th>
                            <th class="text-center">Ending Time Slot</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointmentdates as $appointmentdate)
                            <tr>
                                <td class="text-center">{{ $appointmentdate->first_name }}</td>
                                <td class="text-center">{{ $appointmentdate->d_o_a}}</td>
                                <td class="text-center">{{ $appointmentdate->time_slot}}</td>
                                <td class="text-center">{{ $appointmentdate->end_time_slot}}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        &nbsp;<a href="javascript:;" data-href="{{route('admin.available-appointment.destroy', $appointmentdate->id)}}" class="btn btn-danger delete" title="Delete"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
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
                    $('#dataTable1').on('click', '.delete', function(e) {
                        e.preventDefault();
                        var row = datatable.rows( $(this).parents('tr') );
                        var url = $(this).data('href');
                        App.deleteItem(row, url);
                    })    
                },
                deleteItem: function(row, url) {
                    if (confirm('Are you sure you want to delete this appointment')) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            success : function(data) {
                                row.remove().draw();
                                toastr.success(data.success);
                            }
                        });
                    }
                }
            };
            App.initialize();
        })
    </script>
    
@endpush