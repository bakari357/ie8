@extends('cpanel::layouts')

@section('header')
    <h1>Program</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Program</li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{ route('cpanel.program.create') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Program">
                                <i class="fa fa-plus"></i>
                                New Program
                            </a>
                        </div>
                    </h3>
                </div>
             
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="hidden-xs">Program Name</th>
                            <th class="hidden-xs">Program URL</th>
                              <th class="hidden-xs">Program Image</th>
                             <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Created On</th>
                            <th class="hidden-xs">Updated On</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($program as $programs)   
                      
                        
                      <tr> <?php $client=$programs->pgm_name; $url =$programs->pgm_url; 
                                         $image = $programs->image;
                                          $active=$programs->pgm_status;?>     
                            <td>{{ HTML::linkRoute('cpanel.program.show',$client, array($programs->id)) }}</td>
                            <td>{{ HTML::linkRoute('cpanel.program.show',$url, array($programs->id)) }}</td>
                           
                       
                              <td> <img src="<?php print_r(Config::get('app.url').'/uploads/program_images/'.$image);?>"height="42" width="42" ></td>
                             <td class="hidden-xs">{{{ ($programs->pgm_status) ? 'yes' : 'no' }}}</td>
                            <td class="hidden-xs">{{{ $programs->created_at }}}</td>
                            
                            <?php if($programs->updated_at != "0000-00-00 00:00:00") { ?>
                            <td class="hidden-xs">{{{ $programs->updated_at }}}</td> 
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
                                            <a href="{{ route('cpanel.program.show', array($programs->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View Program
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.program.edit', array($programs->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Edit Program
                                            </a>
                                        </li>
                                        <li>
                                          
                                         <li>
                                            <a href="{{ route('cpanel.program.deactivate', array($programs->id)) }}"
                                               data-method="delete"
                                               data-message="delete this Customer?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete Program
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                       <li class="divider"></li>
                                        <li>
                                            @if ($programs->pgm_status)
                                            <a href="{{ route('cpanel.program.deactivate', array($programs->id)) }}"
                                               data-method="put"
                                               data-message="Deactivate this User?">
                                                <i class="fa fa-minus-circle"></i>&nbsp;Deactivate
                                            </a>
                                            @else
                                            <a href="{{ route('cpanel.program.activate', array($programs->id)) }}"
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
