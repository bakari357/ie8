@extends('cpanel::layouts')

@section('header')
    <h1>Merchants</h1>
@stop

@section('breadcrumb')
@parent

<li>
    <a href="{{route('cpanel.merchants.index')}}">
        <i class="fa fa-page"></i>
        Merchants
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
                    {{ $merchant->name }} Merchant
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                <span style="float:right;margin-bottom:10px;"><a class="btn btn-primary" href="{{route('cpanel.merchants.index')}}">Cancel</a></span>

                    <div class="tab-content">

                        <div class="tab-pane active" id="info">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><strong>Merchant Name</strong></td>
                                    <td>{{ $merchant->merchant_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $merchant->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Description</strong></td>
                                    <td>{{ $merchant->description }}</td>
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
