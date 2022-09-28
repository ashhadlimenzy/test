@extends('layouts.user-dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <livewire:live-table />

    <div class="modal" tabindex="-1" role="dialog" id="user-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    
                <div class="modal-body">
                    <livewire:user-form>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@push('scripts')
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
