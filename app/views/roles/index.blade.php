@extends('cpanel::layouts')

@section('header')
    <h1>Roles</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Roles</li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{ route('cpanel.roles.create') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Role">
                                <i class="fa fa-plus"></i>
                                New Role
                            </a>
                        </div>
                    </h3>
                </div>
             
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="hidden-xs">Name</th>
                             <th class="hidden-xs">Created on</th>
                             <th class="hidden-xs">Updated on</th>
                            <th class="hidden-xs"> </th>
                            <th class="hidden-xs"> </th>
                            <th class="hidden-xs"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $customer)  
                        <tr> <?php  $role=$customer->name;   ?>
                            <td>{{ HTML::linkRoute('cpanel.roles.show',$role, array($customer->id)) }}</td>
                            <td class="hidden-xs">{{{ $customer->created_at }}}</td>
                              <td class="hidden-xs">{{{ is_null($customer->updated_at) ? 'Never Visited' : $customer->updated_at }}}</td>
                            <td class="hidden-xs"></td>
                             <td class="hidden-xs"></td>
                           
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        Action
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('cpanel.roles.show', array($customer->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View Role
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.roles.edit', array($customer->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Edit Role 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.roles.destroy', array($customer->id)) }}"
                                               data-method="delete"
                                               data-message="delete this Role?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete Role
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                     
                                       
                                    </ul>
                                </div>
                            </td>
			
			
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
