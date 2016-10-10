@extends('layouts.backend')

@section('content')

    <section class="content-header" xmlns="http://www.w3.org/1999/html">
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
                        <h3 class="box-title">Delete category <strong class="text-red">{{ $category->name }}</strong></h3>
                    </div>

                    {!! Form::open(['method'=>'DELETE', 'action' => ['Backend\BackendCategoryController@destroy', $category->id], 'files'=>false]) !!}
                        <div class="box-body">



                                <p class="text-red">Attention!</p>
                                <div class="form-group">

                                    <div class="radio">
                                        <label for="delete_option_1">
                                            <input type="radio" name="delete_option" id="delete_option_1" value="1" checked>
                                             Delete this category <strong class="text-red">{{ $category->name }}</strong>  @if($has_sub_category>0) and all sub categories @endif even included posts
                                        </label>
                                    </div>


                                    @if($has_sub_category>0)

                                        <div class="radio">
                                            <label for="delete_option_2">
                                                <input type="radio" name="delete_option" id="delete_option_2" value="2">

                                                Move Sub category to :
                                                <select class="form-control" name="move_in_id_category">
                                                    <option value="0">Root</option>
                                                    @foreach ($categories_available as $category_item)
                                                        <option value="{{ $category_item['id'] }}"
                                                                @if( $category_item['id']==$category->parent_id) selected="selected" @endif >
                                                            |
                                                            @for ($i = 0; $i < $category_item['depth']; $i++) - @endfor
                                                            {{ $category_item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </div>
                                </div>
                            @endif



                            @if($has_posts>0)

                                <div class="radio">
                                    <label for="delete_option_3">
                                        <input type="radio" name="delete_option" id="delete_option_3" value="3">

                                        Move Posts to  :
                                        <select class="form-control" name="new_id_category">

                                            @foreach ($categories_available as $category_item)
                                                <option value="{{ $category_item['id'] }}"
                                                        @if( $category_item['id']==$category->parent_id) selected="selected" @endif >
                                                    |
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
                            {!! Form::submit('Execute', ['class'=>'btn btn-danger']) !!}
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    @stop