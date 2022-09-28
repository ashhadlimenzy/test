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
                                &nbsp;
                                <select name="status" class="form-control" id="">
                                    <option value="">Select Status</option>
                                    @foreach (DoctorConstants::STATUS as $key=>$status)
                                        <option value="{{ $key }}" {{ isset($_GET['status']) && $_GET['status'] != '' && $_GET['status'] == $key?'selected':'' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                                &nbsp;<button type="submit" class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filter</button>
                            </div>
                            <!-- /.input group -->
                        </form>
                    </div>
                    <div class="card-tools">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.doctor.create') }}">
                            <i class="fas fa fa-plus"></i>
                                Add Doctor
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="dataTable1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Expertise</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($doctors as $doctor)
                            <tr>
                                <td class="text-center">{{ $doctor->first_name }}</td>
                                <td class="text-center">{{ $doctor->last_name }}</td>
                                <td class="text-center">{{ $doctor->mobile}}</td>
                                <td class="text-center">{{ $doctor->expertise}}</td>
                                <td class="text-center">{{ $doctor->email}}</td>
                                <td class="text-center">
                                    @if (DoctorConstants::STATUS_ACTIVE == $doctor->status)
                                        <span class="badge badge-success">
                                            {{ DoctorConstants::STATUS[$doctor->status]}}
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            {{ DoctorConstants::STATUS[$doctor->status]}}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        &nbsp;<a href="{{route('admin.doctor.edit', $doctor->id)}}" class="btn btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                        &nbsp;<a href="javascript:;" data-href="{{route('admin.doctor.destroy', $doctor->id)}}" class="btn btn-danger delete" title="Delete"><i class="fas fa-trash"></i></a>
                                        &nbsp;<a href="{{url('admin/activedoctor', $doctor->id)}}" class="btn btn-success" title="Activate" onclick="return confirm('Are you sure you Want to activate this DOCTOR')"><i class="fas fa-check"></i></a>
                                        &nbsp;<a href="{{url('admin/inactivedoctor', $doctor->id)}}" class="btn btn-warning" title="Deactivate" onclick="return confirm('Are you sure you Want to deactivate this DOCTOR')"><i class="fas fa-ban"></i></a>
                                        &nbsp;<button type="button" class="btn btn-info btn-sm" title="ALOT SLOT" data-toggle="modal" data-target="#add-timeslot-{{$doctor->id}}"><i class="fas fa-calendar-alt"></i></button>
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
@include('pages.admin.doctor.modal.add-appointmentslot')
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
                    if (confirm('Are you sure you want to delete this doctor')) {
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
    <script>
        jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
              e.preventDefault();
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
              jQuery.ajax({
                  url: "{{ url('admin/addtimeslot') }}",
                  method: 'post',
                  data: {
                    doa: jQuery('#doa').val(),
                    docname: jQuery('#docname').val(),
                    timslot: jQuery('#timslot').val(),
                    //  score: jQuery('#score').val(),
                  },
                  success: function(result){
                    if(result.errors)
                    {
                      jQuery('.alert-danger').html('');

                      jQuery.each(result.errors, function(key, value){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<li>'+value+'</li>');
                      });
                    }
                    else
                    {
                      jQuery('.alert-danger').hide();
                      $('#open').hide();
                      $('#myModal').modal('hide');
                    }
                  }});
              });
            });
    </script>

    <script type="text/javascript">
        @if (count($errors) > 0)
            $('#add-timeslot-{{$doctor->id}}').modal('show');
        @endif
    </script>
    
@endpush
