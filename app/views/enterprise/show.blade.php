@extends('cpanel::layouts')

@section('header')
    <h1>Enterprise</h1>
@stop

@section('breadcrumb')
@parent

<li>
    <a href="{{route('cpanel.enterprise.index')}}">
        <i class="fa fa-page"></i>
        Enterprise
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
                    {{ $enterprise->name }} Enterprise
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                <span style="float:right;margin-bottom:10px;"><a class="btn btn-primary" href="{{route('cpanel.enterprise.index')}}">Cancel</a></span>

                    <div class="tab-content">

                        <div class="tab-pane active" id="info">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><strong>Enterprise Name</strong></td>
                                    <td>{{ $enterprise->name }}</td>
                                </tr>
                                     <tr>
                                    <td><strong>Enterprise Email</strong></td>
                                    <td>{{ $enterprise->email }}</td>
                                </tr>
                                </tr>
                                  <tr>
                                    <td><strong>Created Date</strong></td>
                                    <td>{{ date('Y-m-d', strtotime($enterprise->created_at)) }}</td>
                                     
                                </tr>
                                 <tr>
                                    <td><strong>Status</strong></td>
                                    <?php if($enterprise->status == 1){
                                    $status = "Active";
                                    }else{
                                     $status = "InActive";
                                    }?>
                                    
                                    <td>{{ $status  }}</td>
                                     
                                </tr>
                             <!---   <tr>
                                    <td><strong>Footer message</strong></td>
                                    <td>{{ $enterprise->message }}</td>
                                </tr>!-->
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
