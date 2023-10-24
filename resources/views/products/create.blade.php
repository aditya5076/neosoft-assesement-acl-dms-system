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
            <h6 class="m-0 font-weight-bold text-primary">List Of Category</h6>
        </div>
        <div style="margin: 30px;">
            <form action="{{ route('products.store') }}" id="userForm" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Select Category</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="category_id">
                        <option value="">Select One</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
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