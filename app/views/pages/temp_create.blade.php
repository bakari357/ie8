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
                'route' => 'cpanel.pages.tempstore',
                'class' => 'form-horizontal'
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new Template</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">


                        <div class="tab-content">

                            <div class="tab-pane active" id="credentials">
                                <legend class="margin-top-10">Template Informations</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('templ_name',null,array('class'=>'form-control','placeholder'=>'Name')) }}
                                    </div>
                                </div>

                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Content</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('function_name',null,array('class'=>'form-control ckeditor','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>
                                <?php if(isset($position) && !empty($position)) { 
                   foreach ($position as $positions) { ?>
				 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="active"><?php echo $positions->position; ?></label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('region[]',@$positions->position) }}
                                     </div>
                                </div>
		<?php } }?>
                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
					 
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
