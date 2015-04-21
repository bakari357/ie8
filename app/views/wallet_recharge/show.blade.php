@extends('cpanel::layouts')

@section('header')
    <h1>Users</h1>
@stop

@section('breadcrumb')
@parent

<li>
    <a href="{{route('cpanel.walletsrecharge.rechargelist')}}">
        <i class="fa fa-page"></i>
        Pages
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
                    {{ $rechargelist->enterprise_name }} 
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                <span style="float:right;margin-bottom:10px;"><a class="btn btn-primary" href="{{route('cpanel.walletsrecharge.rechargelist')}}">Cancel</a></span>

                    <div class="tab-content">

                        <div class="tab-pane active" id="info">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><strong>Enterprise name</strong></td>
                                    <td>{{ $rechargelist->enterprise_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong> credit limit </strong></td>
                                    <td>{{ $rechargelist->credit_limit  }}</td>
                                </tr>
                               <tr>
                                    <td><strong> Threshold limit </strong></td>
                                    <td>{{ $rechargelist->threshold_limit  }}</td>
                                </tr>
                                <tr>
                                    <td><strong> Recharge amount </strong></td>
                                    <td>{{ $rechargelist->recharge_amount  }}</td>
                                </tr>
                               <tr>
                                    <td><strong>Service charge</strong></td>
                                    <td>{{ $rechargelist->service_charge }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fee</strong></td>
                                    <td>{{ $rechargelist->fee }}</td>
                                </tr>
                               <tr>
                                    <td><strong> Tax </strong></td>
                                    <td>{{ $rechargelist->tax  }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Discount</strong></td>
                                    <td>{{ $rechargelist->discount }}</td>
                                </tr>
                               <tr>
                                    <td><strong>Comment</strong></td>
                                    <td>{{ $rechargelist->comment }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Bank name</strong></td>
                                    <td>{{ $rechargelist->bank_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Branch name</strong></td>
                                    <td>{{ $rechargelist->branch_name }}</td>
                                </tr>
 <tr>
                                    <td><strong>IFSC code</strong></td>
                                    <td>{{ $rechargelist->IFSC_code }}</td>
                                </tr>
 <?php if( $rechargelist->recharge_mode==2 ) { ?>
 <tr>
                                    <td><strong>Cheque date</strong></td>
                                    <td>{{ $rechargelist->cheque_date }}</td>
                                </tr>
 <tr>
                                    <td><strong>Cheque number</strong></td>
                                    <td>{{ $rechargelist->cheque_number }}</td>
                                </tr>
 <?php } ?>
 <tr>
                                    <td><strong>Journal number</strong></td>
                                    <td>{{ $rechargelist->journal_number }}</td>
                                </tr>
     <?php if( $rechargelist->recharge_mode==3 ) { ?>
 <tr>
                                    <td><strong>Transaction date & time</strong></td>
                                    <td>{{ $rechargelist->transaction_datetime }}</td>
                                </tr>
 <tr>
                                    <td><strong>Commision</strong></td>
                                    <td>{{ $rechargelist->commision }}</td>
                                </tr>
 <tr>
                                    <td><strong>Amount</strong></td>
                                    <td>{{ $rechargelist->amount }}</td>
                                </tr>
 <tr>
                                    <td><strong>Pg Name</strong></td>
                                    <td>{{ $rechargelist->pg_name }}</td>
                                </tr>
 <tr>
                                    <td><strong>Pg commision</strong></td>
                                    <td>{{ $rechargelist->pg_commision }}</td>
                                </tr>
   <?php } ?>
 <tr>
                                    <td><strong>Created on</strong></td>
                                    <td>{{ $rechargelist->created_on }}</td>
                                </tr>
 <tr>
                                    <td><strong>Recharge request date</strong></td>
                                    <td>{{ $rechargelist->recharge_request_date }}</td>
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
