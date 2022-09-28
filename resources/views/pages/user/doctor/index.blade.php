@extends('layouts.user-dashboard')

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
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ isset($_GET['name'])?$_GET['name']:'' }}">
                                &nbsp;<input type="text" class="form-control" name="expertise" placeholder="Enter Expertised Feild" value="{{ isset($_GET['expertise'])?$_GET['expertise']:'' }}">
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
                            <th class="text-center">Profile</th>
                            <th class="text-center">Doctor's Name</th>
                            <th class="text-center">Expertised In</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($doctors as $doctor)
                            <tr>
                                <td class="text-center"><img src="{{ ProfileHelper::getProfileImageFromFile($doctor->profile_image,FileDestinations::DOCTOR . $doctor->id. '/profile/') }}" alt="{{ $doctor->first_name }}" width="90px"></td>
                                <td class="text-center">Dr. {{ Str::limit(($doctor->first_name . ' ' . $doctor->last_name), 20, '...') }}</td>
                                <td class="text-center">{{ $doctor->expertise}}</td>
                                <td class="text-center">{{ $doctor->mobile}}</td>
                                <td class="text-center">{{ $doctor->email}}</td>
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
                    if (confirm('Are you sure you want to remove this item?')) {
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
