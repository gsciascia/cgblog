@extends('layouts.backend')

@section('content')

    <section class="content-header">
        <h1>Category</h1>
    </section>

    <section class="content-header">
        <div class="row-fluid">
            <a href="{{ route('categories.index') }}" class="btn btn-info"><i class="fa  fa-angle-double-left"></i> Back
            </a>
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


                    {!! Form::model($category,['method'=>'PATCH', 'action' => ['Backend\BackendCategoryController@update', $category->id], 'files'=>false]) !!}


                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Edit category</h3>
                                </div>


                                            <div class="box-body">

                                                <div class="form-group  @if ($errors->has('name')) has-error @endif">
                                                    {!! Form::label('name','Name') !!}
                                                    {!! Form::text('name', $category->name, ['class'=>'form-control', 'placeholder'=>'Enter category name']) !!}
                                                    @if ($errors->has('name'))
                                                        <small class="help-block">{{ $errors->first('name') }}</small> @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Child of</label>
                                                    <select class="form-control" name="parent_id">
                                                        <option value="0">none</option>
                                                        @foreach ($categories as $category_item)
                                                            <option value="{{ $category_item['id'] }}"
                                                                    @if( $category_item['id']==$category->parent_id) selected="selected" @endif >
                                                                |
                                                                @for ($i = 0; $i < $category_item['depth']; $i++)
                                                                    - @endfor
                                                                {{ $category_item['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <hr />
                                                <h5>Seo</h5>


                                                <div class="form-group  @if ($errors->has('title_tag')) has-error @endif">
                                                    {{ Form::label('title_tag','Title Tag ') }}
                                                    {{ Form::text('title_tag',$seo->title_tag ,['class'=>'form-control','placeholder'=>'Enter the title tag']) }}
                                                    @if ($errors->has('title_tag'))
                                                        <small class="help-block">{{ $errors->first('title_tag') }}</small> @endif
                                                </div>

                                                <div class="form-group  @if ($errors->has('description_tag')) has-error @endif">
                                                    {{ Form::label('description_tag','Description tag') }}
                                                    {{ Form::textarea('description_tag',$seo->description_tag ,['class'=>'form-control','placeholder'=>'Enter the description tag', 'rows'=>5]) }}
                                                    @if ($errors->has('description_tag'))
                                                        <small class="help-block">{{ $errors->first('description_tag') }}</small> @endif
                                                </div>


                                    </div>
                                </div>

                                <div class="box-footer">
                                    {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                                </div>
                                {!! Form::close() !!}


                            </div>
                            <!-- /.box -->
                        </div>

    </section>
@stop