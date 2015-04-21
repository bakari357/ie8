@extends('cpanel::layouts')

@section('header')
    <h1>Entity</h1>
@stop

@section('breadcrumb')
@parent

<li>
    <a href="{{route('cpanel.clients.index')}}">
        <i class="fa fa-page"></i>
        Entity
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
                    {{ $entity->entity_name }} Entity
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                <span style="float:right;margin-bottom:10px;"><a class="btn btn-primary" href="{{route('cpanel.entity.index')}}">Cancel</a></span>

                    <div class="tab-content">

                        <div class="tab-pane active" id="info">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><strong>Entity Name</strong></td>
                                    <td>{{ $entity->entity_name }}</td>
                                </tr>
                                     <tr>
                                    <td><strong>Entity Email</strong></td>
                                    <td>{{ $entity->email }}</td>
                                </tr>
                                  <tr>
                                    <td><strong>Created Date</strong></td>
                                    <td>{{ date('Y-m-d', strtotime($entity->created_on)) }}</td>
                                     
                                </tr>
                                 <tr>
                                    <td><strong>Status</strong></td>
                                    <?php if($entity->entity_status == 1){
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
