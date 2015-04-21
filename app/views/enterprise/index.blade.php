@extends('cpanel::layouts')

@section('header')
    <h1>Enterprises</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Clients</li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{ route('cpanel.enterprise.create') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Enterprise">
                                <i class="fa fa-plus"></i>
                                New Enterprise
                            </a>
                        </div>
                    </h3>
                </div>
             
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="hidden-xs">Enterprise Name</th>
                            <th class="hidden-xs">Email</th>
                             <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Created On</th>
                            <th class="hidden-xs">Updated On</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($enterprise as $enterprises)   
                      
                        
                      <tr> <?php $client=$enterprises->name;  $email=$enterprises->email; $active=$enterprises->status;?>     
                            <td>{{ HTML::linkRoute('cpanel.enterprise.show',$client, array($enterprises->id)) }}</td>
                            <td>{{ HTML::linkRoute('cpanel.enterprise.show',$email, array($enterprises->id)) }}</td>
                             <td class="hidden-xs">{{{ ($enterprises->status) ? 'yes' : 'no' }}}</td>
                            <td class="hidden-xs">{{{ $enterprises->created_at }}}</td>
                            
                            <?php if($enterprises->updated_at != "-0001-11-30 00:00:00") { ?>
                            <td class="hidden-xs">{{{ $enterprises->updated_at }}}</td> 
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
                                            <a href="{{ route('cpanel.enterprise.show', array($enterprises->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View Enterprise
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.enterprise.edit', array($enterprises->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Edit Enterprise
                                            </a>
                                        </li>
                                        <li>
                                          <!--  <a href="{{ route('cpanel.enterprise.destroy', array($enterprises->id)) }}"
                                               data-method="delete"
                                               data-message="delete this Customer?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete Client
                                            </a>
                                        </li>!-->
                                         <li>
                                            <a href="{{ route('cpanel.enterprise.deactivate', array($enterprises->id)) }}"
                                               data-method="delete"
                                               data-message="delete this Customer?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete Enterprise
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                       <li class="divider"></li>
                                        <li>
                                            @if ($enterprises->status)
                                            <a href="{{ route('cpanel.enterprise.deactivate', array($enterprises->id)) }}"
                                               data-method="put"
                                               data-message="Deactivate this User?">
                                                <i class="fa fa-minus-circle"></i>&nbsp;Deactivate
                                            </a>
                                            @else
                                            <a href="{{ route('cpanel.enterprise.activate', array($enterprises->id)) }}"
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
