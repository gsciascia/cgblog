@extends('layouts.backend')

@section('content')

    <section class="content-header" xmlns="http://www.w3.org/1999/html">
        <h1>User</h1>
    </section>

    <section class="content-header">
        <div class="row-fluid">
            <a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa  fa-angle-double-left"></i> Back </a>
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
                        <h3 class="box-title">Delete User <strong class="text-red">{{ $user->name }}</strong></h3>
                    </div>

                    {!! Form::open(['method'=>'DELETE', 'action' => ['Backend\BackendUserController@destroy', $user->id], 'files'=>false]) !!}
                        <div class="box-body">



                                <p class="text-red">Attention!</p>
                                <div class="form-group">

                                    <div class="radio">
                                        <label for="delete_option_1">
                                            <input type="radio" name="delete_option" id="delete_option_1" value="1" checked>
                                             Delete  <strong class="text-red">{{ $user->name }}</strong>  @if($has_posts>0) include his posts @endif
                                        </label>
                                    </div>



                            @if($has_posts>0)

                                <div class="radio">
                                    <label for="delete_option_2">
                                        <input type="radio" name="delete_option" id="delete_option_2" value="2">

                                        Move Posts to  :
                                        <select class="form-control" name="new_id_user">

                                            @foreach ($all_users as $user_item)
                                                <option value="{{ $user_item['id'] }}">
                                                    {{ $user_item['name'] }}   {{ $user_item['last_name'] }}
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