@extends('layouts.backend')

@section('content')

    <section class="content-header">
        <h1>
            Categories
        </h1>
   </section>


    <section class="content-header">
        <div class="row-fluid">
            <a href="{{ route('categories.create') }}" class="btn btn-success">New</a>
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
                            @if( $parent_name )
                                Sub categories of {{ $parent_name }} - <a href="{{ route('categories.index',$next_parent_id) }}">get back to parent</a>
                            @endif
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th class="col-md-1">#</th>
                                <th class="col-md-7">Category</th>
                                <th class="col-md-2">Sub Category</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if($category->children()->count()>0)
                                        <a href="{{ route('categories.index',$category->id) }}">
                                    @endif

                                            {{ $category->children()->count() }}

                                    @if($category->children()->count()>0)
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-primary" title="Edit category"><i class="fa fa-pencil"></i></a>



                                    <a href="{{ route('categories.delete',$category->id) }}" class="btn btn-danger" title="Delete items" ><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {{ $categories->links() }}
                    </div>
                </div>
                <!-- /.box -->

            </div>
        </div>
    </section>
    @stop