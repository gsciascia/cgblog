@extends('layouts.backend')

@section('content')

    <section class="content-header">
        <h1>
            Users
        </h1>
   </section>


    <section class="content-header">
        <div class="row-fluid">
            <a href="{{ route('users.create') }}" class="btn btn-success">New</a>
        </div>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">

                @include('includes.form_error')
                @include('includes.message')

                <div class="box">
                    <div class="box-header with-border">

                        <h3 class="box-title">
                            Manage users
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th class="col-md-1">#</th>
                                <th class="col-md-3">Name</th>
                                <th class="col-md-3">Last name</th>
                                <th class="col-md-1">Role</th>
                                <th class="col-md-2">Active</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{$user->is_active ? 'Active' : 'Not Active' }}</td>
                                <td>
                                    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary" title="Edit category"><i class="fa fa-pencil"></i></a>

                                    <a href="{{ route('users.destroy',$user->id) }}" class="btn btn-danger" title="Delete items" ><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">

                    </div>
                </div>
                <!-- /.box -->

            </div>
        </div>
    </section>
    @stop