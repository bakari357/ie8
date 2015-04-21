@extends('cpanel::layouts')

@section('header')
    <h1>Program</h1>
@stop

@section('breadcrumb')
@parent

<li>
    <a href="{{route('cpanel.enterprise.index')}}">
        <i class="fa fa-page"></i>
        Program
    </a>
</li>
<li class="active">Show</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
   
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{ $program->pgm_name }} Program
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                <span style="float:right;margin-bottom:10px;"><a class="btn btn-primary" href="{{route('cpanel.program.index')}}">Cancel</a></span>
                   
                    <div class="tab-content">

                        <div class="tab-pane active" id="info">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><strong>Program Name</strong></td>
                                    <td>{{ $program->pgm_name }}</td>
                                </tr>
                                     <tr>
                                    <td><strong>Program URL</strong></td>
                                    <td>{{ $program->pgm_url }}</td>
                                </tr>
                                 <tr>
                                    <td><strong>Program Image</strong></td>
                                    
                                    
                              <td> <img src="<?php print_r(Config::get('app.url').'/uploads/program_images/'.$program->image);?>"height="42" width="42" ></td>
                                    
                                </tr>
                                </tr>
                                  <tr>
                                    <td><strong>Created Date</strong></td>
                                    <td>{{ date('Y-m-d', strtotime($program->created_at)) }}</td>
                                     
                                </tr>
                                 <tr>
                                    <td><strong>Status</strong></td>
                                    <?php if($program->pgm_status == 1){
                                    $status = "Active";
                                    }else{
                                     $status = "InActive";
                                    }?>
                                    
                                    <td>{{ $status  }}</td>
                                     
                                </tr>
                             
                                </tbody>
                            </table>
                        </div>

                     
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@stop
