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
                        <h3 class="box-title">Delete category</h3>
                    </div>

                    {!! Form::open(['method'=>'DELETE', 'action' => ['Backend\BackendCategoryController@destroy', $category->id], 'files'=>false]) !!}
                        <div class="box-body">



                                <p class="text-red">Attention!</p>
                                <div class="form-group">

                                    <div class="radio">
                                        <label for="delete_option_1">
                                            <input type="radio" name="delete_option" id="delete_option_1" value="1" checked>
                                             Delete category   @if($has_sub_category>0) and all sub category @endif
                                        </label>
                                    </div>


                                    @if($has_sub_category>0)

                                    <div class="radio">
                                        <label for="delete_option_2">
                                            <input type="radio" name="delete_option" id="delete_option_2" value="2">

                                            Move Sub category to :
                                            <select class="form-control" name="parent_id">
                                                <option value="0" >Root</option>
                                                @foreach ($categories_available as $category_item)
                                                    <option value="{{ $category_item['id'] }}"
                                                            @if( $category_item['id']==$category->parent_id) selected="selected" @endif > |
                                                        @for ($i = 0; $i < $category_item['depth']; $i++) - @endfor
                                                        {{ $category_item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>
                                  </div>
                            @endif







                        </div>

                        <div class="box-footer">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    @stop