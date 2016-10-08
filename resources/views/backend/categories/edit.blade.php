@extends('layouts.backend')

@section('content')

    <section class="content-header">
        <h1>Category</h1>
    </section>

    <section class="content-header">
        <div class="row-fluid">
            <a href="{{ route('categories.index') }}" class="btn btn-info"><i class="fa  fa-angle-double-left"></i> Back </a>
        </div>
    </section>



        <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

            @include('includes.form_error')
            @include('includes.message')

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit category</h3>
                    </div>

                    {!! Form::model($category,['method'=>'PATCH', 'action' => ['Backend\BackendCategoryController@update', $category->id], 'files'=>false]) !!}
                        <div class="box-body">

                            <div class="form-group  @if ($errors->has('name')) has-error @endif">

                                    {!! Form::label('name','Name') !!}
                                    {!! Form::text('name', $category->name, ['class'=>'form-control', 'placeholder'=>'Enter category name']) !!}
                                    @if ($errors->has('name')) <small class="help-block">{{ $errors->first('name') }}</small> @endif

                            </div>

                            <div class="form-group">
                                <label>Child of</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0" >none</option>
                                    @foreach ($categories as $category_item)

                                        <option value="{{ $category_item['id'] }}"
                                                @if( $category_item['id']==$category->parent_id) selected="selected" @endif > |
                                            @for ($i = 0; $i < $category_item['depth']; $i++) - @endfor
                                            {{ $category_item['name'] }}
                                        </option>


                                    @endforeach
                                </select>
                            </div>



                        </div>

                        <div class="box-footer">
                            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    @stop