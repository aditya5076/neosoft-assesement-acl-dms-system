@extends('layouts.my-app')

@section('content')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Of Users</h6>
        </div>
        @if($users->count() <= 0) <div class="card-body">
            <h1><strong>Please add the Users</strong></h1>
    </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable-users" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr id="row-{{ $user->id }}">
                        <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @can('user-edit')
                            <a href="{{ route('users.edit',['user'=>$user]) }}" class="btn btn-secondary">Edit</a>
                            @endcan

                            @can('user-delete')
                            <!-- Add delete button with a confirmation dialog -->
                            <button type="submit" class="btn btn-danger" onclick="deleteUser(<?php echo $user->id; ?>)">Delete</button>
                            @endcan('user-delete')

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->



<script>
    function deleteUser(id) {
        var token = $('meta[name="csrf-token"]').attr('content');
        let isConfirmed = confirm('Are you sure you want to delete this User ?');
        if (isConfirmed) {
            $.ajax({
                url: "{{ url('/users') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: token,
                },
                dataType: 'json',
                success: function() {
                    Swal.fire('User deleted!');
                    $('#row-' + id).hide();
                },
                error: function(error) {
                    console.log("error while deleting ", error);
                }

            })
        }
    }
</script>

@endsection