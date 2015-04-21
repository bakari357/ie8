@extends('cpanel::layouts')

@section('header')
    <h1>Entity</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Entity</li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{ route('cpanel.entity.create') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Entity">
                                <i class="fa fa-plus"></i>
                                New Entity
                            </a>
                        </div>
                    </h3>
                </div>
             
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="hidden-xs">Entity Name</th>
                            <th class="hidden-xs">Email</th>
                             <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Created On</th>
                            <th class="hidden-xs">Updated On</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($entity as $entities)   
                       
                      
                      <tr> <?php $ent_details=$entities->name;  $email=$entities->email; $active=$entities->status;?>     
                            <td>{{ HTML::linkRoute('cpanel.entity.show',$ent_details, array($entities->id)) }}</td>
                            <td>{{ HTML::linkRoute('cpanel.entity.show',$email, array($entities->id)) }}</td>
                             <td class="hidden-xs">{{{ ($entities->status) ? 'yes' : 'no' }}}</td>
                            <td class="hidden-xs">{{{ $entities->created_at }}}</td>
                              <?php if($entities->updated_at != "-0001-11-30 00:00:00") { ?>
                            <td class="hidden-xs">{{{ $entities->updated_at }}}</td> 
                           <?php } else { ?>
                            <td class="hidden-xs"></td> 
                            <?php } ?>
                            <td> 
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        Action
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('cpanel.entity.show', array($entities->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View Client
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.entity.edit', array($entities->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Edit Client
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.entity.deactivate', array($entities->id)) }}"
                                               data-method="delete"
                                               data-message="delete this Customer?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete Client
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                     <li>
                                            @if ($entities->status)
                                            <a href="{{ route('cpanel.entity.deactivate', array($entities->id)) }}"
                                               data-method="put"
                                               data-message="Deactivate this User?">
                                                <i class="fa fa-minus-circle"></i>&nbsp;Deactivate
                                            </a>
                                            @else
                                            <a href="{{ route('cpanel.entity.activate', array($entities->id)) }}"
                                               data-method="put"
                                               data-message="Activate this User?">
                                                <i class="fa fa-check"></i>&nbsp;Activate
                                            </a>
                                            @endif
                                       </li>
                                       
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
