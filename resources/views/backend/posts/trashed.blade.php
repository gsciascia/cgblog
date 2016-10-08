@extends('layouts.backend')

@section('content')

    <section class="content-header">
        <h1>
            Post trashed
        </h1>
   </section>



    <section class="content">
        <div class="row">
            <div class="col-md-12">

                @include('includes.form_error')
                @include('includes.message')

                <div class="box">
                    <div class="box-header with-border">

                        <h3 class="box-title">
                            Your posts trashed
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr >
                                <th class="col-md-1">#</th>
                                <th class="col-md-5">Post title</th>
                                <th class="col-md-2">Deleted at</th>
                                <th class="col-md-2">Deleted By</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            @foreach($posts as $post)
                            <tr id="tr-{{$post->id}}">
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->deleted_at }}</td>
                                <td>{{ $post->deletedBy->name }} [ {{ $post->deletedBy->role->name }} ]  </td>
                                <td>
                                    @can('manage-trashed', $post)
                                    <a href="{{ route('posts.restore',$post->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a  class="btn btn-danger confirm-delete"
                                        data-element="{{ route('posts.destroyTrashed') }}"  data-id="{{$post->id}}" data-message="Do you want delete this item?"  title="Delete" role="button" ><i class="fa fa-trash-o"></i></a>
                                    @endcan
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