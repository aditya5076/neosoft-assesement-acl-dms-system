@extends('layouts.my-app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    @if ($errors->any())
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
            <h6 class="m-0 font-weight-bold text-primary">List Of Properties</h6>
        </div>
        <div style="margin: 30px;">
            <form action="{{ route('users.store') }}" id="userForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="form-group">
                    <label for="roles">Roles :</label>
                    <select name="roles[]" id="roles">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>

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