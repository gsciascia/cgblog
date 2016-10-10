@extends('layouts.backend')

@section('content')

    <section class="content-header">
        <h1>Users</h1>
    </section>

    <section class="content-header">
        <div class="row-fluid">
            <a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa  fa-angle-double-left"></i> Back
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
                {!! Form::model($user, ['method'=>'PATCH', 'action' => ['Backend\BackendUserController@update', $user->id], 'files'=>false]) !!}


                <div class="row">
                    <div class="col-md-8">
                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <h3 class="box-title">Edit User</h3>
                            </div>


                            <div class="box-body">

                                <div class="form-group  @if ($errors->has('name')) has-error @endif">
                                    {!! Form::label('name','Name') !!}
                                    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter name']) !!}
                                    @if ($errors->has('name'))
                                        <small class="help-block">{{ $errors->first('name') }}</small> @endif
                                </div>


                                <div class="form-group  @if ($errors->has('last_name')) has-error @endif">
                                    {!! Form::label('last_name','Last name') !!}
                                    {!! Form::text('last_name',null, ['class'=>'form-control', 'placeholder'=>'Enter last name']) !!}
                                    @if ($errors->has('last_name'))
                                        <small class="help-block">{{ $errors->first('last_name') }}</small> @endif
                                </div>


                                <fieldset class="form-group">
                                    {!! Form::label('title','email') !!}
                                    {!! Form::email('email',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('email'))
                                        <small class="help-block">{{ $errors->first('email') }}</small> @endif
                                </fieldset>

                                <div class="form-group  @if ($errors->has('password')) has-error @endif">
                                    {!! Form::label('password','Password') !!}
                                    {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Leave empty for not change']) !!}
                                    <small class="text-red"> The password must be lenght between 5 and 10 characters.</small>
                                </div>


                            </div>


                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Status and role</h3>
                            </div>


                            <div class="box-body">
                                <div class="form-group  ">
                                    <label for="status">Role</label>
                                    {{ Form::select('role_id', $roles, $user->role_id, ['class'=>'form-control']) }}

                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group  ">
                                    <label for="status">Status</label>
                                    {!! Form::select('is_active',[1=>'active',0=>'Not active'],null,['class'=>'form-control']) !!}

                                </div>
                            </div>



                            <div class="box-footer">
                                {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                            </div>

                        </div>
                    </div>


                </div>
        {!! Form::close() !!}
    </section>
@stop