@extends('cpanel::layouts')

@section('header')
<h1>Roles <small>Create a new Role</small></h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.roles.index')}}">
        <i class="fa fa-users"></i>
        Roles
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
<?php
$option = array(
    'route' => 'cpanel.roles.store',
    'class' => 'form-horizontal'
);
?>
{{ Form::open($option) }}
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Role Informations</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-md-4">
                        {{Form::text('name',null,array('class'=>'form-control','placeholder'=>'Role Name'))}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Group Permissions</h3>
            </div>
            <div class="panel-body">
             
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
{{ Form::close() }}
@stop
