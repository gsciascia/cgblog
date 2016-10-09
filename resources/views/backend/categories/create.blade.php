@extends('layouts.backend')

@section('content')

    <section class="content-header">
        <h1> Category </h1>
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
                        <h3 class="box-title">Add category</h3>
                    </div>

                    {!! Form::open(['method'=>'POST', 'action' => 'Backend\BackendCategoryController@store','files'=>false]) !!}
                        <div class="box-body">

                            <div class="form-group  @if ($errors->has('name')) has-error @endif">

                                    {!! Form::label('name','Name') !!}
                                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter category name']) !!}
                                    @if ($errors->has('name')) <small class="help-block">{{ $errors->first('name') }}</small> @endif

                            </div>

                            <div class="form-group">
                                <label>Child of</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">none</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}"> |
                                            @for ($i = 0; $i < $category['depth']; $i++) - @endfor
                                            {{ $category['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <hr />
                            <h5>Seo</h5>


                            <div class="form-group  @if ($errors->has('title_tag')) has-error @endif">
                                {{ Form::label('title_tag','Title Tag ') }}
                                {{ Form::text('title_tag',null,['class'=>'form-control','placeholder'=>'Enter the title tag']) }}
                                @if ($errors->has('title_tag'))
                                    <small class="help-block">{{ $errors->first('title_tag') }}</small> @endif
                            </div>

                            <div class="form-group  @if ($errors->has('description_tag')) has-error @endif">
                                {{ Form::label('description_tag','Description tag') }}
                                {{ Form::textarea('description_tag',null,['class'=>'form-control','placeholder'=>'Enter the description tag', 'rows'=>5]) }}
                                @if ($errors->has('description_tag'))
                                    <small class="help-block">{{ $errors->first('description_tag') }}</small> @endif
                            </div>

                        </div>

                        <div class="box-footer">
                            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    @stop