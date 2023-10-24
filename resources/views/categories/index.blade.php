@extends('layouts.my-app')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Category Management</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 10px;">
                @can('category-create')
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Of Categories</h6>
        </div>
        @if($categories->count() <= 0) <div class="card-body">
            <h1><strong>Please add the Category</strong></h1>
    </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable-categories" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr id="row-{{ $category->id }}">
                        <td>{{ $category->name }} </td>
                        <td>{{ $category->description }} </td>
                        <td>
                            <div style="display: flex;">
                                @can('category-edit')
                                <a href="{{ route('categories.edit',['category'=>$category]) }}" class="btn btn-secondary">Edit</a>
                                @endcan

                                @can('category-delete')
                                <!-- Add delete button with a confirmation dialog -->
                                <button type="submit" class="btn btn-danger" onclick="deleteCategory(<?php echo $category->id; ?>)" style="margin-left: 5px;">Delete</button>
                                @endcan
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
<script>
    function deleteCategory(id) {
        var token = $('meta[name="csrf-token"]').attr('content');
        let isConfirmed = confirm('Are you sure you want to delete this Category ?  all the products related to that category will be deleted.');
        if (isConfirmed) {
            $.ajax({
                url: "{{ url('/categories') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: token,
                },
                dataType: 'json',
                success: function() {
                    Swal.fire('Category deleted!');
                    $('#row-' + id).hide();
                },
                error: function(error) {
                    console.log("error while deleting ", error);
                }

            })
        }
    }
</script>
<!-- /.container-fluid -->


@endsection