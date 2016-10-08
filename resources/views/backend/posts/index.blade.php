@extends('layouts.backend')

@section('content')

    <section class="content-header">
        <h1>
            Post
        </h1>
   </section>


    <section class="content-header">
        <div class="row-fluid">
            <a href="{{ route('posts.create') }}" class="btn btn-success">New</a>
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
                            Your posts
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr >
                                <th class="col-md-1">#</th>
                                <th class="col-md-3">Post title</th>
                                <th class="col-md-2">Author</th>
                                <th class="col-md-2">Status</th>
                                <th class="col-md-2">Publish date</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            @foreach($posts as $post)
                            <tr id="tr-{{$post->id}}">
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->status }}</td>
                                <td>{{ $post->publish_date }}</td>
                                <td>
                                    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a  class="btn btn-danger confirm-delete"
                                        data-element="{{ route('posts.destroy', $post->id) }}"  data-id="{{$post->id}}" data-message="Do you want delete this item?"  title="Delete" role="button" ><i class="fa fa-trash-o"></i></a>
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