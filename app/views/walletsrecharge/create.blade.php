@extends('cpanel::layouts')

@section('header')
<h1>Wallet Recharge</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.walletsrecharge.index')}}">
        <i class="fa fa-user"></i>
        Users
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php
            $option = array(
                'route' => 'cpanel.walletsrecharge.store',
                'class' => 'form-horizontal'
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new Recharge</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#credentials" data-toggle="tab">Recharge Credentials</a>
                            </li>
                            <li>
                                <a href="#permissions" data-toggle="tab">DD/CC</a>
                            </li>
                           <li>
                                <a href="#cheque" data-toggle="tab">Cheque</a>
                            </li>

                        <li>
                                <a href="#account" data-toggle="tab">Account Transfer</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="credentials">
                                
                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="First Name">Enterprise name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('enterprise_name',null,array('class'=>'form-control','placeholder'=>'Enterprise name')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Available wallet credit limit</label>
                                    <div class="col-md-4">
                                        {{ Form::text('available_wallet',null,array('class'=>'form-control','placeholder'=>'Available wallet credit limit')) }}
                                    </div>
                                </div>


                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="mnumber">Balance to reach threshold limit</label>
                                    <div class="col-md-4">
                                        {{ Form::text('balance',null,array('class'=>'form-control','placeholder'=>'Balance to reach threshold limit')) }}
                                    </div>
                                </div>

                            <div class="form-group">
                                 <label class="col-sm-2 control-label" for="rech_mode">Recharge mode</label>
                                    <div class="col-md-4">
                                        <?php $rech_mode = array(''=>'Select','1' => 'Internet banking', '2' => 'Debit/ credit card','3'=>'Cheque','4'=> 'Account transfer','5'=>'Other mode');?>
                               <?php echo Form::select('walletrech_mode',$rech_mode,null,array( "class"=>" select2 form-control","style"=>"width: 300px;")); ?>
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="Landline Number">Recharge amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('rech_amt',null,array('class'=>'form-control','placeholder'=>'Recharge amount')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Date Of Birth">service charge (if any)</label>
                                    <div class="col-md-4">
                                        {{ Form::text('service',null,array('class'=>'form-control','placeholder'=>'service charge ')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                 <label class="col-sm-2 control-label" for="last_name">Fee</label>
                                    <div class="col-md-4">
                                        {{ Form::text('fee',null,array('class'=>'form-control','placeholder'=>'Fee')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                 <label class="col-sm-2 control-label" for="last_name">tax </label>
                                    <div class="col-md-4">
                                        {{ Form::text('tax',null,array('class'=>'form-control','placeholder'=>'Tax')) }}
                                    </div>
                                </div>
                             
                         <div class="form-group">
                                 <label class="col-sm-2 control-label" for="last_name">offer/ discount </label>
                                    <div class="col-md-4">
                                        {{ Form::text('offer',null,array('class'=>'form-control','placeholder'=>'offer/ discount')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                 <label class="col-sm-2 control-label" for="last_name"> recharge request date</label>
                                    <div class="col-md-4">
                                        {{ Form::text('recharge',null,array('class'=>'form-control','id'=>'recharge','placeholder'=>'offer/ discount')) }}
                                    </div>
                                </div>
                            
                               <div class="form-group">
                                 <label class="col-sm-2 control-label" for="last_name"> recharge request time</label>
                                    <div class="col-md-4">
                                        {{ Form::text('recharge_time',null,array('class'=>'form-control','id'=>'recharge_time','placeholder'=>'recharge request time')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">comment</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('comment',null,array('class'=>'form-control ')) }}
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">user name/ id</label>
                                    <div class="col-md-4">
                                        {{ Form::text('user_id',null,array('class'=>'form-control','placeholder'=>'user name/ id')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">new available credit limit after approval</label>
                                    <div class="col-md-4">
                                        {{ Form::text('new_available',null,array('class'=>'form-control','placeholder'=>'New available')) }}
         
                                    </div>
                                </div>
		 
                             <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Transaction Id</label>
                                    <div class="col-md-4">
                                        {{ Form::text('trns_id',null,array('class'=>'form-control','placeholder'=>'Transaction Id')) }}
         
                                    </div>
                                </div>
    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">PG Status</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pg_status',null,array('class'=>'form-control','placeholder'=>'PG Status')) }}
         
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Transaction Status</label>
                                    <div class="col-md-4">
                                        {{ Form::text('trns_status',null,array('class'=>'form-control','placeholder'=>'Transaction Status')) }}
         
                                    </div>
                                </div>
                         <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>




                            <div class="tab-pane" id="permissions">
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Bank Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('bank_name',null,array('class'=>'form-control','placeholder'=>'Bank Name ')) }}
                                    </div>
                                </div>
                             <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">PG txn id</label>
                                    <div class="col-md-4">
                                        {{ Form::text('txn_id',null,array('class'=>'form-control','placeholder'=>'PG txn id')) }}
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">PG name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('PG_name',null,array('class'=>'form-control','placeholder'=>'PG name')) }}
                                    </div>
                                </div>
                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">PG commission</label>
                                    <div class="col-md-4">
                                        {{ Form::text('PG_commission',null,array('class'=>'form-control','placeholder'=>'PG commission')) }}
                                    </div>
                                </div>
                         <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('amount',null,array('class'=>'form-control','placeholder'=>'amount')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </div>

                 
                       <div class="tab-pane" id="cheque">
                           <div class="form-group">
                               <label class="col-sm-2 control-label" for="short_description">Bank Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cbank_name',null,array('class'=>'form-control','placeholder'=>'Bank Name ')) }}
                                    </div>
                              </div>
                             <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Branch Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('branch_name',null,array('class'=>'form-control','placeholder'=>'Branch Name')) }}
                                    </div>
                               </div>
                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Cheque Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cheque_number',null,array('class'=>'form-control','placeholder'=>'Cheque Number')) }}
                                    </div>
                                </div>
                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">IFSC Code</label>
                                    <div class="col-md-4">
                                        {{ Form::text('IFSC_code',null,array('class'=>'form-control','placeholder'=>'IFSC Code')) }}
                                    </div>
                               </div>
                         <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('camount',null,array('class'=>'form-control','placeholder'=>'Amount')) }}
                                    </div>
                                </div>
                           <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Cheque Date</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cheque_date',null,array('class'=>'form-control','placeholder'=>'Cheque Date')) }}
                                    </div>
                                </div>
                        <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Journal Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('journal_number',null,array('class'=>'form-control','placeholder'=>'Journal Number')) }}
                                    </div>
                                </div>
                             <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>

                              <div class="tab-pane" id="account">
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Bank Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('abank_name',null,array('class'=>'form-control','placeholder'=>'Bank Name ')) }}
                                    </div>
                                </div>
                             <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Branch Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('abranch_name',null,array('class'=>'form-control','placeholder'=>'Branch Name')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('aamount',null,array('class'=>'form-control','placeholder'=>'Amount')) }}
                                    </div>
                                </div>
                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Date of Transaction</label>
                                    <div class="col-md-4">
                                        {{ Form::text('date_of_transaction',null,array('class'=>'form-control','id'=>'date_of_transaction','placeholder'=>'Date of Transaction')) }}
                                    </div>
                                </div>
                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Time of Transaction</label>
                                    <div class="col-md-4">
                                        {{ Form::text('time_of_transaction',null,array('class'=>'form-control','placeholder'=>'Time of Transaction')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Commission</label>
                                    <div class="col-md-4">
                                        {{ Form::text('commission',null,array('class'=>'form-control','placeholder'=>'Commission')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">IFSC Code</label>
                                    <div class="col-md-4">
                                        {{ Form::text('aIFSC_code',null,array('class'=>'form-control','placeholder'=>'IFSC Code')) }}
                                    </div>
                                </div>
                         <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Journal Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('ajournal_number',null,array('class'=>'form-control','placeholder'=>'Journal Number')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                           </div>

                             </div>

                    </div>
                </div>
            </div>



            {{Form::close()}}
        </div>
    </div>
<script type="text/javascript">
    $(function() { 
                //Date range picker
                $('#recharge').datepicker({dateFormat: 'dd-mm-yy'}); });
      $(function() { 
                //Date range picker
                $('#date_of_transaction').datepicker({dateFormat: 'dd-mm-yy'}); });
</script>

   <script>
        $(document).ready(function(){  
               $("#Entity").hide();
        });
$(function(){
   $('#link').on('change',function() {
    var value = $(this).val();
 if(value=='Enterprise')
                  {
                         $("#Entity").show();
                  }
                  else
                   {
                         $("#Entity").hide();
                  }
   });
});
      
       </script>

@stop
