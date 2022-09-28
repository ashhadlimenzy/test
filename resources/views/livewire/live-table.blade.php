<div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="float-left mt-5">
                <button class="btn btn-success" wire:click="$emit('triggerCreate')">Create New User</button>
            </div>  
            <div class="float-right mt-5">
                <input wire:model="search" class="form-control" type="text" placeholder="Search Users...">
            </div>
        </div>
    </div>

    <div class="row">
        @if ($users->count())
        {{-- <div class="card-body table-responsive"> --}}
            <table id="dataTable1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Mobile Number</th>
                        <th class="text-center">Created at</th>
                        <th class="text-center">Delete</th>
                        <th class="text-center">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ Str::limit($user->email, 15) }}</td>
                            <td>{{ Str::limit($user->address, 25) }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->created_at->format('m-d-Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" wire:click="$emit('deleteTriggered', {{ $user->id }}, '{{ $user->name }}')">
                                    Delete
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-dark edit-user" wire:click="$emitTo('user-form', 'triggerEdit', {{ $user }})">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        {{-- </div> --}}
        @else
            <div class="alert alert-warning">
                Your query returned zero results.
            </div>
        @endif
    </div>
    
    

    <div class="row">
        <div class="col">
            {{ $users->links() }}
        </div>
    </div>

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
    
</div>
