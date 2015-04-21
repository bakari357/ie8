@extends('cpanel::layouts')

@section('header')
<h1>Pages</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.pages.index')}}">
        <i class="fa fa-user"></i>
        Pages
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php


            $option = array(
                'route' => 'cpanel.pages.store',
                'class' => 'form-horizontal'
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new page</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">


                        <div class="tab-content">

                            <div class="tab-pane active" id="credentials">
                                <legend class="margin-top-10">Page Informations</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Title</label>
                                    <div class="col-md-4">
                                        {{ Form::text('title',null,array('class'=>'form-control','placeholder'=>'Title')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Short Description</label>
                                    <div class="col-md-4">
                                        {{ Form::textarea('short_description',null,array('class'=>'form-control ','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>

                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Description</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('description',null,array('class'=>'form-control ckeditor','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>
                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="active">Active</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('active', '1') }}
                                     </div>
                                </div>
                 
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
					  <a class="btn btn-primary" href="{{route('cpanel.pages.index')}}">Cancel</a>
                                    </div>
                                </div>
                            </div>

                           
                        </div>

                    </div>
                </div>
            </div>



            {{Form::close()}}
        </div>
    </div>
@stop
