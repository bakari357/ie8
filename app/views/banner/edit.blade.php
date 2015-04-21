@extends('cpanel::layouts')

@section('header')
<h1>Pages</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.pages.index')}}">
        <i class="fa fa-page"></i>
        Pages
    </a>
</li>
<li class="active">Edit</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <?php
        $option = array(
            'route' => array('cpanel.pages.update',$page->id),
            'method' => 'put',
            'class' => 'form-horizontal'
        );
        ?>
        {{ Form::model($page,$option) }}
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Page &quot;{{ $page->title }}&quot;</h3>
            </div>
            <div class="panel-body">
                <div class="tabbable">

                  
                    <div class="tab-content">
                        <div class="tab-pane active" id="credentials">
                            <div class="margin-top-20">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Title</label>
                                    <div class="col-md-4">
                                        {{ Form::text('title',null,array('class'=>'form-control','placeholder'=>'Title')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Short Description</label>
                                    <div class="col-md-4">
                                        {{ Form::textarea('short_description',null,array('class'=>'form-control','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Description</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('description',null,array('class'=>'form-control ckeditor','placeholder'=>'Description')) }}
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
        </div>

        {{Form::close()}}

    </div>
</div>
@stop
