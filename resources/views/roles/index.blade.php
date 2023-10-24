@extends('layouts.my-app')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Role Management</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 10px;">
                @can('role-create')
                <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
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
            <h6 class="m-0 font-weight-bold text-primary">List Of Users</h6>
        </div>
        @if($roles->count() <= 0) <div class="card-body">
            <h1><strong>Please add the roles</strong></h1>
    </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable-roles" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                    <tr id="row-{{ $role->id }}">
                        <td>{{ $role->name }} </td>
                        <td>
                            @can('role-edit')
                            <a href="{{ route('roles.edit',['role'=>$role]) }}" class="btn btn-secondary">Edit</a>
                            @endcan

                            @can('role-delete')
                            <!-- Add delete button with a confirmation dialog -->
                            <button type="submit" class="btn btn-danger" onclick="deleteUser(<?php echo $role->id; ?>)">Delete</button>
                            @endcan
                        </td>

                    </tr>
                    @empty
                    <div class="card-body">
                        <h1><strong>Please add the Roles</strong></h1>
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->


@endsection