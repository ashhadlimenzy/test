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
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ isset($_GET['name'])?$_GET['name']:'' }}">
                                &nbsp;<select name="status" class="form-control" id="">
                                    <option value="">Select Status</option>
                                    @foreach (UserConstants::STATUS as $key=>$status)
                                        <option value="{{ $key }}" {{ isset($_GET['status']) && $_GET['status'] != '' && $_GET['status'] == $key?'selected':'' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
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
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->first_name }}</td>
                                <td class="text-center">{{ $user->last_name }}</td>
                                <td class="text-center">{{ $user->mobile}}</td>
                                <td class="text-center">{{ $user->email}}</td>
                                <td class="text-center">
                                    @if (UserConstants::STATUS_ACTIVE == $user->status)
                                        <span class="badge badge-success">
                                            {{ UserConstants::STATUS[$user->status]}}
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            {{ UserConstants::STATUS[$user->status]}}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        &nbsp;<a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                        &nbsp;<a href="javascript:;" data-href="{{route('admin.user.destroy', $user->id)}}" class="btn btn-danger delete" title="Delete"><i class="fas fa-trash"></i></a>
                                        &nbsp;<a href="{{url('admin/activeuser', $user->id)}}" class="btn btn-success" title="Activate" onclick="return confirm('Are you sure you Want to activate this USER')"><i class="fas fa-check"></i></a>
                                        &nbsp;<a href="{{url('admin/inactiveuser', $user->id)}}" class="btn btn-warning" title="Deactivate" onclick="return confirm('Are you sure you Want to deactivate this USER')"><i class="fas fa-ban"></i></a>
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
                    if (confirm('Are you sure you want to delete this user?')) {
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
