@extends('layouts.backend')

@section('content')

    <section class="content-header">
        <h1> Post </h1>
    </section>


    <section class="content-header">
        <div class="row-fluid">
            <a href="{{ route('posts.index') }}" class="btn btn-info"><i class="fa  fa-angle-double-left"></i> Back </a>
        </div>
    </section>



        <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

            @include('includes.form_error')
            @include('includes.message')


                {{ Form::open(['method'=>'POST', 'action' => 'Backend\BackendPostController@store','files'=>true]) }}
                <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create a new post</h3>
                        </div>


                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#text_tab" data-toggle="tab" aria-expanded="true">Post</a></li>
                                <li class=""><a href="#category_tab" data-toggle="tab" aria-expanded="false">Categories</a></li>
                                <li class=""><a href="#photo_tab" data-toggle="tab" aria-expanded="false">Image</a></li>
                                <li class=""><a href="#seo_tab" data-toggle="tab" aria-expanded="false">Seo</a></li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="text_tab">
                                    <div class="box-body">
                                        <div class="form-group  @if ($errors->has('title')) has-error @endif">
                                            {{ Form::label('title','Title (required) ') }}
                                            {{ Form::text('title',null,['class'=>'form-control','placeholder'=>'Enter the title']) }}
                                            @if ($errors->has('title'))
                                                <small class="help-block">{{ $errors->first('title') }}</small> @endif
                                        </div>

                                        <div class="form-group  @if ($errors->has('abstract')) has-error @endif">
                                            {{ Form::label('abstract','Abstract') }}
                                            {{ Form::textarea('abstract',null,['class'=>'form-control','placeholder'=>'Enter the abstract', 'rows'=>5]) }}
                                            @if ($errors->has('abstract'))
                                                <small class="help-block">{{ $errors->first('abstract') }}</small> @endif
                                        </div>


                                        <div class="form-group  @if ($errors->has('content')) has-error @endif">
                                            {{ Form::label('content','Text') }}
                                            {{ Form::textarea('content',null,['class'=>'form-control editorBootstrap','placeholder'=>'Enter the text here.']) }}
                                            @if ($errors->has('content'))
                                                <small class="help-block">{{ $errors->first('content') }}</small> @endif
                                        </div>


                                    </div>
                                </div>

                                <div class="tab-pane " id="category_tab">
                                    <div class="box-body">
                                        <div class="form-group">
                                            @foreach ($all_categories as $category)
                                                <div class="checkbox">
                                                    <label for="category_{{ $category['id']  }}">
                                                        <input type="checkbox" name="categories[]" id="category_{{ $category['id']  }}"
                                                               value="{{ $category['id'] }}"  >
                                                        @for ($i = 0; $i < $category['depth']; $i++) - @endfor
                                                        {{ $category['name'] }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                                {{-- Photo Tabs  --}}
                                <div class="tab-pane" id="photo_tab">
                                    <div class="box-body">
                                        <div class="form-group  @if ($errors->has('photo_filename')) has-error @endif">
                                            {{ Form::label('photo_filename','Image') }}
                                            {{ Form::file('photo_filename',['class'=>'form-control']) }}
                                            <p class="help-block">The image must have the following dimensions: Min-Width 750px - Min-Height 350px  </p>
                                            @if ($errors->has('photo_filename'))
                                                <small class="help-block">{{ $errors->first('photo_filename') }}</small> @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Photo Tabs End --}}



                                <div class="tab-pane" id="seo_tab">
                                    <div class="box-body">

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
                                </div>

                            </div>

                        </div>


                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Publish</h3>
                        </div>

                        <div class="box-body">

                            <div class="form-group  @if ($errors->has('name')) has-error @endif">
                                {{ Form::label('status','Status') }}
                                {{ Form::select('status', ['draft' => 'Draft', 'publish' => 'Publish'], null, ['class' => 'form-control']) }}
                                @if ($errors->has('name'))
                                    <small class="help-block">{{ $errors->first('name') }}</small>
                                @endif
                            </div>




                            <div class="form-group  @if ($errors->has('publish_date')) has-error @endif">
                                {{ Form::label('publish_date','Publish date') }}
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {{ Form::text('publish_date', \Carbon\Carbon::now()->format('d/m/Y') ,['class' => 'form-control datepicker'])}}
                                </div>
                                @if ($errors->has('publish_date'))
                                    <small class="help-block">{{ $errors->first('publish_date') }}</small>
                                @endif
                            </div>

                        </div>






                        <div class="box-footer">
                            {{ Form::submit('Save', ['class'=>'btn btn-primary']) }}
                        </div>

                    </div>
                </div>
            </div>
            </div>
            </form>


        </div>
    </section>
    @stop