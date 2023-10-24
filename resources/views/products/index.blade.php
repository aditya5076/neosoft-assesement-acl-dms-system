@extends('layouts.my-app')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products Management</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 10px;">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
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
            <h6 class="m-0 font-weight-bold text-primary">List Of Products</h6>
        </div>
        @if($products->count() <= 0) <div class="card-body">
            <h1><strong>Please add the Product</strong></h1>
    </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable-products" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr id="row-{{ $product->id }}">
                        <td onclick="viewCategory(<?php echo $product->category->id; ?>)" data-toggle="modal" data-target="#staticBackdrop">{{ $product->category->name }} </td>
                        <td>{{ $product->name }} </td>
                        <td>{{ $product->description }} </td>
                        <td>{{ $product->price }} </td>
                        <td style="max-width: 70px;"><img src="{{ asset('product-images') }}/<?php echo $product->image;  ?>" alt="{{ $product->image }}" srcset="" style="width:100%"> </td>
                        <td style="display: flex;">
                            @can('product-edit')
                            <a href="{{ route('products.edit',['product'=>$product]) }}" class="btn btn-secondary">Edit</a>
                            @endcan

                            @can('product-delete')
                            <!-- Add delete button with a confirmation dialog -->
                            <button type="submit" class="btn btn-danger" style="margin-left: 5px;" onclick="deleteProduct(<?php echo $product->id; ?>)">Delete</button>
                            @endcan
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Category Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="" readonly>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" readonly>

                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    function deleteProduct(id) {
        var token = $('meta[name="csrf-token"]').attr('content');
        let isConfirmed = confirm('Are you sure you want to delete this Product ?');
        if (isConfirmed) {
            $.ajax({
                url: "{{ url('/products') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: token,
                },
                dataType: 'json',
                success: function() {
                    Swal.fire('Product deleted!');
                    $('#row-' + id).hide();
                },
                error: function(error) {
                    console.log("error while deleting ", error);
                }

            })
        }
    }

    function viewCategory(id) {

        $.ajax({
            url: "{{ url('/categories') }}/" + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#name').val(data.name);
                $('#description').val(data.description);
            },
            error: function(error) {
                console.log("error while deleting ", error);
            }
        })

    }
</script>
<!-- /.container-fluid -->


@endsection