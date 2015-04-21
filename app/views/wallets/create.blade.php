@extends('cpanel::layouts')

@section('header')
<h1>Wallet</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.wallets.index')}}">
        <i class="fa fa-user"></i>
        Wallets
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php


            $option = array(
                'route' => 'cpanel.wallets.store',
                'class' => 'form-horizontal',
                 'files' =>true
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new Wallet</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#credentials" data-toggle="tab">Wallet Credentials</a>
                            </li>
                            

                        <li>
                                <a href="#account" data-toggle="tab">Extended Data</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="credentials">
                                
                               <div class="form-group">
                                 <label class="col-sm-2 control-label" for="last_name">Wallet Status</label>
                                    <div class="col-md-4">
                                        <?php $status = array(''=>'Select','1' => 'Enable', '2' => 'Disable');?>
                               <?php echo Form::select('wallet_status',$status,null,array( "class"=>" select2 form-control","id"=>"Enable","style"=>"width: 300px;")); ?>
                                    </div>
                                </div>
<div id="Entity">
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="last_name">Wallet type</label>
                                    <div class="col-md-4">
                                        <?php $type = array(''=>'Select','1' => 'Prepaid', '2' => 'Postpaid');?>
                               <?php echo Form::select('wallet_type',$type,null,array( "class"=>" select2 form-control","id"=>"wallet_type","style"=>"width: 300px;")); ?>
                                    </div>
                                </div>


                            <div id="wal_typ">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Credit or overdraft limit</label>
                                    <div class="col-md-4">
                                        {{ Form::text('crd_limit',null,array('class'=>'form-control','placeholder'=>'Credit or overdraft limit')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="email">credit or overdraft limit duration</label>
                                    <div class="col-md-4">
                                        {{ Form::text('crd_duration',null,array('class'=>'form-control','placeholder'=>'credit or overdraft limit duration')) }}
                                    </div>
                                </div>



</div>



                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Min balance to be maintained on wallet</label>
                                    <div class="col-md-4">
                                        {{ Form::text('min_balance',null,array('class'=>'form-control','placeholder'=>'Min balance')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="email">Max balance allowed on the wallet</label>
                                    <div class="col-md-4">
                                        {{ Form::text('max_balance',null,array('class'=>'form-control','placeholder'=>'Max Balance')) }}
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="mnumber">Min recharge amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('min_recharge',null,array('class'=>'form-control','placeholder'=>'min recharge amount')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Landline Number">Max recharge amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('max_recharge',null,array('class'=>'form-control','placeholder'=>'Max recharge amount')) }}
                                    </div>
                                </div>

                             <div class="form-group">
                                 <label class="col-sm-2 control-label" for="rech_mode">Recharge mode</label>
                                    <div class="col-md-4">
                                        <?php $rech_mode = array(''=>'Select','1' => 'CC/DC', '2' => 'Internet banking','3'=>'Account transfer','4'=> 'Cheque deposit','5'=>'Other mode');?>
                               <?php echo Form::select('rech_mode',$rech_mode,null,array( "class"=>" select2 form-control","style"=>"width: 300px;")); ?>
                                    </div>
                                </div>

   

                          <div class="form-group">
                                 <label class="col-sm-2 control-label" for="rech_mode">Recharge fee</label>
                                    <div class="col-md-4">
                                        <?php $rech_fee = array(''=>'Select','1' => '%', '2' => 'Flat fee');?>
                               <?php echo Form::select('rech_fee',$rech_fee,null,array( "class"=>" select2 form-control","id"=>"rech_fee","style"=>"width: 300px;")); ?>
                                    </div>
                                </div>

                         <div id="fee"> 
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Min fee amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('min_fee',null,array('class'=>'form-control','placeholder'=>'Min Fee')) }}
                                    </div>
                                </div>


                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Max fee amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('max_fee',null,array('class'=>'form-control','placeholder'=>'Max Fee')) }}
                                    </div>
                                </div>
              </div>

                 <div id="flat">

  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Flat fee</label>
                                    <div class="col-md-4">
                                        {{ Form::text('flat_fee',null,array('class'=>'form-control','id'=>'flatfee','placeholder'=>'Max Fee')) }}
                                    </div>
                                </div>
</div>


                          <div class="form-group">
                                 <label class="col-sm-2 control-label" for="rech_mode">Recharge ST </label>
                                    <div class="col-md-4">
                                        <?php $rech_st = array(''=>'Select','1' => '%', '2' => 'Flat fee');?>
                               <?php echo Form::select('rech_st',$rech_st,null,array( "class"=>" select2 form-control","id"=>"rech_st","style"=>"width: 300px;")); ?>
                                    </div>
                                </div>
  <div id="st_fee"> 
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Min fee amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('stmin_fee',null,array('class'=>'form-control','placeholder'=>'Min Fee')) }}
                                    </div>
                                </div>


                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Max fee amount">Max fee amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('stmax_fee',null,array('class'=>'form-control','placeholder'=>'Max Fee')) }}
                                    </div>
                                </div>
              </div>

                 <div id="st_flat">

                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Flat fee">Flat fee</label>
                                    <div class="col-md-4">
                                        {{ Form::text('stflat_fee',null,array('class'=>'form-control','id'=>'flatfee','placeholder'=>'Max Fee')) }}
                                    </div>
                                </div>
</div>
        
                        

       
                    <div class="form-group">
                                 <label class="col-sm-2 control-label" for="rech_mode">service charge</label>
                                    <div class="col-md-4">
                                        <?php $service = array(''=>'Select','1' => '%', '2' => 'Flat fee');?>
                               <?php echo Form::select('service',$service,null,array( "class"=>" select2 form-control","id"=>"service","style"=>"width: 300px;")); ?>
                                    </div>
                                </div>
 
                                <div id="sfee"> 
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Min fee amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('sermin_fee',null,array('class'=>'form-control','placeholder'=>'Min Fee')) }}
                                    </div>
                                </div>


                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Max fee amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('sermax_fee',null,array('class'=>'form-control','placeholder'=>'Max Fee')) }}
                                    </div>
                                </div>
              </div>

                 <div id="sflat">

  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Flat fee</label>
                                    <div class="col-md-4">
                                        {{ Form::text('serflat_fee',null,array('class'=>'form-control','id'=>'flatfee','placeholder'=>'Max Fee')) }}
                                    </div>
                                </div>
</div>      
                              
                               
                              <div class="form-group">
                                 <label class="col-sm-2 control-label" for="rech_mode">Discount type</label>
                                    <div class="col-md-4">
                                        <?php $discount = array(''=>'Select','1' => '%', '2' => 'Flat fee');?>
                               <?php echo Form::select('discount',$discount,null,array( "class"=>" select2 form-control","id"=>"discount","style"=>"width: 300px;")); ?>
                                    </div>
                                </div>
                                   <div id="disc_fee"> 
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Min fee amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('discmin_fee',null,array('class'=>'form-control','placeholder'=>'Min Fee')) }}
                                    </div>
                                </div>


                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Max fee amount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('discmax_fee',null,array('class'=>'form-control','placeholder'=>'Max Fee')) }}
                                    </div>
                                </div>
              </div>

                 <div id="disc_flat">

  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Flat fee</label>
                                    <div class="col-md-4">
                                        {{ Form::text('discflat_fee',null,array('class'=>'form-control','id'=>'flatfee','placeholder'=>'Max Fee')) }}
                                    </div>
                                </div>
</div>      
                              

                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="discount">Discount on regular basis</label>
                                    <div class="col-md-4">
                                         {{ Form::checkbox('discount_mode', '1')}}
                                    </div>
                                </div>



                          <div id="discounts">       
                              
                      


                                  <div class="form-group" id="nodiscount">
                                    <label class="col-sm-2 control-label" for="Flat fee">Enterprise is eligible for the discount</label>
                                    <div class="col-md-4">
                                        {{ Form::text('eligible',null,array('class'=>'form-control','id'=>'flatfee','placeholder'=>'enterprise is eligible for the discount.')) }}
                                    </div>
                                </div>

</div>

              <div class="form-group" id="nodiscount">
                                    <label class="col-sm-2 control-label" for="Flat fee">Threshold limit</label>
                                    <div class="col-md-4">
                                        {{ Form::text('threshold',null,array('class'=>'form-control','placeholder'=>'Threshold limit')) }}
                                    </div>
                                </div>








                               <div class="form-group">
                                 <label class="col-sm-2 control-label" for="rech_mode">points pool currency to 1 Rupee ratio</label>
                                    <div class="col-md-4">
                                        <?php $pp_currency = array(''=>'Select');?>
                               <?php echo Form::select('pp_currency',$pp_currency,null,array( "class"=>" select2 form-control","style"=>"width: 300px;")); ?>
                                    </div>
                                </div>

                           
                         <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
</div>




                 
                     

                              <div class="tab-pane" id="account">
                                  
                                     <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Maker Comments</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('maker_comment',null,array('class'=>'form-control ')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Checker Comments</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('checker_comment',null,array('class'=>'form-control ')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Other Details</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('Details',null,array('class'=>'form-control ')) }}
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
 <script>
	$(document).ready(function(){  
	$("#Entity").hide(); 
        $("#fee").hide();
        $("#flat").hide();
        $("#st_fee").hide();
        $("#st_flat").hide();
        $("#discounts").hide();
         $("#nodiscount").hide();
        $("#sfee").hide();
        $("#sflat").hide();
        $("#disc_fee").hide();
        $("#disc_flat").hide();
         $("#wal_typ").hide();
        
              });

	$(function(){  
	$('#Enable').on('change',function() {
	var value = $(this).val();
	if(value==1)
	{
	     $("#Entity").show();
	 }
	else
	{
	$("#Entity").hide();
	}
	});
	});


		$(function(){  
		$('#rech_fee').on('change',function() {
		var value = $(this).val();
		if(value==1)
		{
		     $("#fee").show();
		 }
		else
		{
		$("#fee").hide();
		}
		});
		});

		$(function(){  
		$('#rech_fee').on('change',function() {
		var value = $(this).val();
		if(value==2)
		{
		     $("#flat").show();
		 }
		else
		{
		$("#flat").hide();
		}
		});
		}); 

      $(function(){  
		$('#rech_st').on('change',function() {
		var value = $(this).val();
		if(value==1)
		{
		     $("#st_fee").show();
		 }
		else
		{
		$("#st_fee").hide();
		}
		});
		});

		$(function(){  
		$('#rech_st').on('change',function() {
		var value = $(this).val();
		if(value==2)
		{
		     $("#st_flat").show();
		 }
		else
		{
		$("#st_flat").hide();
		}
		});
		});

            $(function(){  
		$('#discount_regular').on('change',function() {
		var value = $(this).val();
		if(value==1)
		{
		     $("#discounts").show();
		 }
		else
		{
		$("#discounts").hide();
		}
		});
		});

		$(function(){  
		$('#discount_regular').on('change',function() {
		var value = $(this).val();
		if(value==2)
		{
		     $("#nodiscount").show();
		 }
		else
		{
		$("#nodiscount").hide();
		}
		});
		});


               
            $(function(){  
		$('#service').on('change',function() {
		var value = $(this).val();
		if(value==1)
		{
		     $("#sfee").show();
		 }
		else
		{
		$("#sfee").hide();
		}
		});
		});

		$(function(){  
		$('#service').on('change',function() {
		var value = $(this).val();
		if(value==2)
		{
		     $("#sflat").show();
		 }
		else
		{
		$("#sflat").hide();
		}
		});
		});

               $(function(){  
		$('#discount').on('change',function() {
		var value = $(this).val();
		if(value==1)
		{
		     $("#disc_fee").show();
		 }
		else
		{
		$("#disc_fee").hide();
		}
		});
		});

		$(function(){  
		$('#discount').on('change',function() {
		var value = $(this).val();
		if(value==2)
		{
		     $("#disc_flat").show();
		 }
		else
		{
		$("#disc_flat").hide();
		}
		});
		});

       $(function(){  
		$('#wallet_type').on('change',function() {
		var value = $(this).val();
		if(value==2)
		{
		     $("#wal_typ").show();
		 }
		else
		{
		$("#wal_typ").hide();
		}
		});
		});
       </script>
@stop
