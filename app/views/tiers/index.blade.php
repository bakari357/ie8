@extends('cpanel::layouts')

@section('header')
    <h1>Tiers</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Tiers</li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{route('cpanel.tiers.create')}}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New tier">
                                <i class="fa fa-plus"></i>
                                New Tier
                            </a>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                           <!-- <th>Name</th>
                            <th class="hidden-xs">Email</th>
                            <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Joined</th>
                            <th class="hidden-xs">Last Visit</th>
                            <th>Action</th>-->
			    
                        </tr>
                        </thead>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
