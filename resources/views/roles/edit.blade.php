@extends('layouts.my-app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if ($message = Session::get('message'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Of Roles</h6>
        </div>
        <div style="margin: 30px;">
            <form action="{{ route('roles.update',['role'=>$role]) }}" id="userForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
                </div>

                <div class="form-check">
                    @foreach($permission as $value)
                    <input type="checkbox" name="permission[]" id="permission_{{ $value->id }}" value="{{ $value->id }}" class="form-check-input name" @if(in_array($value->id, $rolePermissions)) checked @endif>
                    <label class="form-check-label" for="permission_{{ $value->id }}">
                        {{ $value->name }}
                    </label>
                    <br />
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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