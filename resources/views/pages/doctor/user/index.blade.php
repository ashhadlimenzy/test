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
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ isset($_GET['name'])?$_GET['name']:'' }}">
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
                            <th class="text-center">Profile</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center"><img src="{{ ProfileHelper::getProfileImageFromFile($user->profile_image,FileDestinations::USER . $user->id. '/profile/') }}" alt="{{ $user->first_name }}" width="90px"></td>
                                <td class="text-center">{{ $user->first_name }}</td>
                                <td class="text-center">{{ $user->last_name }}</td>
                                <td class="text-center">{{ $user->mobile}}</td>
                                <td class="text-center">{{ $user->email}}</td>
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
