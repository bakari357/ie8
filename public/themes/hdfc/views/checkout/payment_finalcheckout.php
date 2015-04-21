
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>  <?php if(isset($_POST['ttype']) && $_POST['ttype'] =="etop") { ?>
					<li><?php echo HTML::link('mobile_payments', ' Recharge');?></li>
					<?php } else { ?>
					<li><?php echo HTML::link('dth_payments', ' Billpayment');?></li>
					<?php } ?>
					<li>/</li>
					<li><a href="#">Summary</a></li>

				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">

<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>" id="checkout_form" onsubmit="return term_condition();"  name="checkout_form" accept-charset="UTF-8">		
		
		<div class="container mt8 offset-0">
			
			
			<!-- LEFT CONTENT -->
				<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					
					
					<div class="clearfix"></div>
					<span class="size16px bold dark left">Where can we reach you?</span>
					<div class="roundstep  right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					<div class="col-md-4" style="width:293px;"> 
						<span class="dark">First Name :</span>
						&nbsp;&nbsp;<?php echo $_POST['first_name']; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $_POST['first_name']; ?>">
					</div>
					<div class="col-md-4 textleft" style="width:293px;">
					<span class="dark">Last Name :</span>
						&nbsp;&nbsp;<?php echo $_POST['last_name']; ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $_POST['last_name']; ?>">
					</div>
					
						<div class="clearfix"></div>
					</br>
					<div>
					<div class="col-md-8 textright" style="margin-top:-11px;width: 534px;">
				<div class="mt15" style="margin-top: 11px;"><span class="dark" style="float: left; margin-top: -28px;">Email Address:</span><span style="float: left;margin-top: -28px;margin-left: 97px;"> &nbsp;&nbsp;<?php echo $_POST['s_email']; ?><span></div>
				<div class="col-md-4">
						<input type="hidden" name="s_email" class="form-control margtop10" placeholder="" value="<?php echo $_POST['s_email']; ?>">
					</div>
					</div>
				
<div class="col-md-10 textright">
						<div class="mt15" style="float: left; margin-top: 1px;"><span class="dark">Preferred Phone Number:</span>&nbsp;&nbsp;<span style=" margin-top: -12px;"><?php echo $_POST['b_mobile']; ?></span></div>
					</div>
					<div class="col-md-4">
						<input style="width:20%;position: absolute;" type="hidden" readonly value="91" class="form-control"/><input type="hidden" name = "b_mobile" class="form-control" placeholder="" value="<?php echo $_POST['b_mobile']; ?>" >
					</div></div>
					
					<div class="clearfix"></div><br/></br>
					<span style="font-size:13.8px;"> ( All Email notification will be sent to the above address )</span>
					

				<div></div>
					
				
					
					<div class="clearfix"></div>
					
					<?php
					
					$type = $post['payment']; ?>
				        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<?php switch($type) {
					
					case 'recharge': 
					if($_POST['ttype'] =="etop"){?>
					
			<input type="hidden" name="prepaid_biller_id" value="<?php echo trim($post['prepaid_biller_id']);?>"/>
						<input type="hidden" name="mobile" value="<?php echo trim($post['mobile']);?>"/>
						<input type="hidden" name="ctype" value="<?php echo trim($post['ctype']);?>"/>
						<input type="hidden" name="payment" value="<?php echo trim($post['payment']);?>"/>
						<input type="hidden" value="<?php echo $_POST['circle'];?>" name="circle" />
						<input type="hidden" value="<?php echo $_POST['operator'];?>" name="operator" />
						<input type="hidden" value="recharge" name="flag" />
						<input type="hidden" value="etop" name="ttype" />
						<input type="hidden" name="payment"  value="recharge"/>
						<input type="hidden" name="amount" value="<?php echo trim($post['amount']);?>"/>
					<?php } else { ?>
					
					<input type="hidden" name="amount" value="<?php echo trim($post['po_amount']);?>"/>
					<input type="hidden" name="biller_id" value="<?php echo trim($post['biller_id']);?>"/>
					<input type="hidden" name="mobile" value="<?php echo trim($post['po_mobile']);?>"/>
					<input type="hidden" value="<?php echo $_POST['po_circle'];?>" name="circle" />
					<input type="hidden" value="<?php echo $_POST['po_operator'];?>" name="operator" /> 
					<input type="hidden" value="AAAAAAAAA" name="customer_name" />
					<input type="hidden" value="<?php echo $_POST['account_no'];?>" name="account_no" /> 
					<input type="hidden" value="postpaid" name="flag" />
					<input type="hidden" name="ctype" value="recharge"/>
					<input type="hidden" name="rtype" value="recharge"/>
					<input type="hidden" name="relation_no" value="<?php echo trim($post['relation_no']);?>"/>
					<input type="hidden" value="BILL" name="ttype" />
					<input type="hidden" name="payment"  value="postpaid"/>
					
					<?php }
					 break; case 'DTH':
				 $payeeing_for = DB::table('billers')->select('biller_name')->where('id',$post['dth_name'])->first();
					?> 
					<input type="hidden" name="biller_id"  value="<?php echo $post['biller_id']; ?>"/>
					<input type="hidden" name="subscriber_id"  value="<?php echo $post['subscriber_id']; ?>"/>
					<input type="hidden" name="subscriber_name"  value="<?php echo $post['subscriber_name']; ?>"/>
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="biller_name"  value="<?php echo  $payeeing_for->biller_name;?>"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="flag"  value="dth"/>
					<input type="hidden" name="payment"  value="DTH"/>
					<?php break;
					case 'electricity': 
					 $payeeing_for = DB::table('billers')->select('biller_name')->where('ubp_biller_id',$post['eb_name'])->first();
					?>
					
					<input type="hidden" name="biller_id"  value="<?php echo $post['biller_id']; ?>"/>
					<input type="hidden" name="service_no"  value="<?php echo $post['service_no']; ?>"/>
					
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="biller_name"  value="<?php echo  $payeeing_for->biller_name;?>"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="flag"  value="electricity"/>
					<input type="hidden" name="payment"  value="electricity"/>
					
					<?php  break;
					case 'gas': 
				 $gas_for = DB::table('billers')->select('biller_name')->where('ubp_biller_id',$post['gas_name'])->first();?>
					<input type="hidden" name="biller_id"  value="<?php echo $post['biller_id']; ?>"/>
					<input type="hidden" name="customer_id"  value="<?php echo $post['customer_id']; ?>"/>
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="meter_no"  value="<?php echo $post['meter_no']; ?>"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="biller_name"  value="<?php echo  $gas_for->biller_name;?>"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="flag"  value="gas"/>
					<input type="hidden" name="payment"  value="gas"/>
					
				    <?php break; case 'subscription':?>
		<input type="hidden" name="subscription_billerid"  value="<?php echo $post['subscription_billerid']; ?>"/>
					<input type="hidden" name="customer_name"  value="<?php echo $post['customer_name']; ?>"/>
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="address1"  value="<?php echo $post['address1']; ?>"/>
					<input type="hidden" name="address2"  value="<?php echo $post['address2']; ?>"/>
					<input type="hidden" name="scheme"  value="<?php echo $post['scheme']; ?>"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="biller_name"  value="<?php echo   $post['subscription_name'];?>"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="flag"  value="subscription"/>
					<input type="hidden" name="payment"  value="subscription"/>
				    
				    <?php break; case 'charity':
				     $charity_for = DB::table('billers')->select('biller_name')->where('id',$post['biller_id'])->first();
				     ?> 
				    
				    <input type="hidden" name="chartity_billerid"  value="<?php echo $post['chartity_billerid']; ?>"/>
					<input type="hidden" name="donor_name"  value="<?php echo $post['donor_name']; ?>"/>
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="address1"  value="<?php echo $post['address1']; ?>"/>
					<input type="hidden" name="address2"  value="<?php echo $post['address2']; ?>"/>
				<input type="hidden" name="contribution_scheme"  value="<?php echo $post['contribution_scheme']; ?>"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="biller_name"  value="<?php echo $charity_for->biller_name;?>"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="flag"  value="charity"/>
					<input type="hidden" name="payment"  value="charity"/>
				    
				    
				    <?php break; case 'creditcard': 
				     $credit_for = DB::table('billers')->select('biller_name')->where('id',$post['creditcard_name'])->first();
					?> 
					<input type="hidden" name="biller_id"  value="<?php echo $post['biller_id']; ?>"/>
					<input type="hidden" name="creditcard_number"  value="<?php echo $post['creditcard_number']; ?>"/>
					<input type="hidden" name="cardholder_name"  value="hffliflfff"/>
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="biller_name"  value="<?php echo  $credit_for->biller_name;?>"/>
					<input type="hidden" name="flag"  value="creditcard"/>
					<input type="hidden" name="payment"  value="creditcard"/>
				    
				    <?php break;  case 'insurance': 
			  $insuarance_for = DB::table('billers')->select('biller_name')->where('ubp_biller_id',$post['biller_id'])->first();
					?> 
					<input type="hidden" name="biller_id"  value="<?php echo $post['biller_id']; ?>"/>
					<input type="hidden" name="policy_no"  value="<?php echo $post['policy_no']; ?>"/>
					<input type="hidden" name="premium_amount"  value="<?php echo $post['premium_amount']; ?>"/>
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="customer_name"  value="sssssssss"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="biller_name"  value="<?php echo  $insuarance_for->biller_name;?>"/>
					<input type="hidden" name="flag"  value="insurance"/>
					<input type="hidden" name="payment"  value="insurance"/>
				    
				    
				    <?php break; } ?>
				    <?php
				if(isset($post['po_amount'])!=''){
				$amount = $post['po_amount'];
				}else{
				$amount = $post['amount'];
				}  
				   $offer = Offerhelper::offer_calculate(4,$amount); 
					$data=array(
					            'amount'=>round($amount -  $offer['discount_amount']),
                                                           'book'=>'trip',	
							   'cash'=>0,
							   'ctype'=>'recharge',
							   'display_term'=>'1',
							   'emi_data'=>'',
							   'interest'=>'',
							   'form_option'=>0,
							   'msg'=>Lang::get('partners.recharge.checkout')
					
						    );
				
				
					$view = View::make('payment_form',$data);	echo $view;		?>

</form>				</div>
		
			</div></div>
			
			<!-- END OF LEFT CONTENT -->	
			
					
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
					<?php switch($type){
					 
					 case 'recharge': if($_POST['ttype'] =="etop"){ ?>
					 
					 <span class="opensans size18 dark bold">Recharge Details</span>
					 
					 <? } else { ?>
					 <span class="opensans size18 dark bold">Payment Details</span>
					 <? } break; default: ?>
						<span class="opensans size18 dark bold">Payment Details</span>
					 <?php } ?>
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
                                             
					<?php 
					
					 switch($type){
					 
					 case 'recharge': if($_POST['ttype'] =="etop"){
			 $prepaid_operator = DB::table('myoxi_operators')->select('operator')->where('abbr',$post['operator'])->first();
					 
					  ?>
					  
					  <tr>
								<td colspan=2><span class="dark">Mobile Number</span></td>
								<td><?php echo $post['mobile']; ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Mobile Type</span></td>
								<td><?php echo ucfirst($post['rtype']); ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Mobile Operator</span></td>
								<td><?php echo $prepaid_operator->operator; ?></td>
							</tr>
							
							
							<tr>
								<td colspan=2><span class="dark">Recharge Amount</span></td>
								<td>&#8377; <?php echo $post['amount']; ?></td>
							</tr>
					   
					<?php } else { 
					
				 $postpaid_operator = DB::table('myoxi_operators')->select('operator')->where('abbr',$post['po_operator'])->first();
					?>
					
							<tr>
								<td colspan=2><span class="dark">Mobile Number</span></td>
								<td><?php echo $post['po_mobile']; ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Mobile Type</span></td>
								<td><?php echo ucfirst($post['rtype']); ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Mobile Operator</span></td>
								<td><?php echo $postpaid_operator->operator; ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Payee Presence</span></td>
				<td><?php echo ucfirst($post['po_payee_presence']); ?></td>
							</tr>
							
							
							
							<tr>
								<td colspan=2><span class="dark">Payment Amount</span></td>
								<td>&#8377; <?php echo $post['po_amount']; ?></td>
							</tr>
							
					
					<?php } break; case 'DTH':
					 ?>
					
					 
							<tr>
								<td colspan=2><span class="dark">DTH Name</span></td>
								<td><?php echo $payeeing_for->biller_name;?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Subscriber ID</span></td>
								<td><?php echo $post['subscriber_id'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Subscriber Name</span></td>
								<td><?php echo $post['subscriber_name'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark"> Amount</span></td>
								<td>&#8377; <?php echo $post['amount'];?></td>
							</tr>
							
							
						<?php break;
					 case 'electricity': 
					 $payeeing_for = DB::table('billers')->select('biller_name')->where('ubp_biller_id',$post['eb_name'])->first();
					?>
					<tr>
								<td colspan=2><span class="dark">Electricity Name</span></td>
								<td><?php echo $payeeing_for->biller_name;?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Consumer Number</span></td>
								<td><?php echo $post['service_no'];?></td>
							</tr>
							<tr>
							
							<tr>
								<td colspan=2><span class="dark"> Amount</span></td>
								<td>&#8377; <?php echo $post['amount'];?></td>
							</tr>
					
					
					<?php break;   case 'gas':  ?>
					
					                   <tr>
								<td colspan=2><span class="dark">GAS Name</span></td>
								<td><?php echo $gas_for->biller_name;?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Customer ID</span></td>
								<td><?php echo $post['customer_id'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Meter Number</span></td>
								<td><?php echo $post['meter_no'];?></td>
							</tr>
							<tr>
							
							<tr>
								<td colspan=2><span class="dark"> Amount</span></td>
								<td>&#8377; <?php echo $post['amount'];?></td>
							</tr>
					
					
					<?php break;  case 'subscription': ?>	
                                              
                                              <tr>
								<td colspan=2><span class="dark">Subscription  Name</span></td>
						<td><?php echo  $post['subscription_name'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Scheme</span></td>
								<td><?php echo $post['scheme'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Customer Name</span></td>
								<td><?php echo $post['customer_name'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Address 1</span></td>
								<td><?php echo $post['address1'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Address 2</span></td>
								<td><?php echo $post['address2'];?></td>
							</tr>
							<tr>
							
							<tr>
								<td colspan=2><span class="dark"> Amount</span></td>
								<td>&#8377; <?php echo $post['amount'];?></td>
							</tr>
					
                                              
                                              <?php break; case 'charity': ?>
                                              
                                        
                                               <tr>
							<td colspan=2><span class="dark"> Charity Name</span></td>
						<td><?php echo $charity_for->biller_name;?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Contribution Scheme</span></td>
							<td><?php echo $post['contribution_scheme'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Donor Name</span></td>
								<td><?php echo $post['donor_name'];?></td>
							</tr>
							<!--<tr>
								<td colspan=2><span class="dark">Address 1</span></td>
								<td><?php echo $post['address1'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Address 2</span></td>
								<td><?php echo $post['address2'];?></td>
							</tr>!-->
							<tr>
							
							<tr>
								<td colspan=2><span class="dark"> Amount</span></td>
								<td>&#8377; <?php echo $post['amount'];?></td>
							</tr>
                                              
                                              <?php break; case 'creditcard': ?>
					
					       <tr>
						<td colspan=2><span class="dark">Creditcard Name</span></td>
						<td><?php echo $credit_for->biller_name;?></td>
							</tr>
							
							<tr>
								<td colspan=2><span class="dark">Card Number</span></td>
								<td><?php echo $post['creditcard_number'];?></td>
							</tr>
							
							<tr>
								<td colspan=2><span class="dark"> Amount</span></td>
								<td>&#8377; <?php echo $post['amount'];?></td>
							</tr>
					
					<?php break;  case 'insurance': 
		  $insuarance_for = DB::table('billers')->select('biller_name')->where('ubp_biller_id',$post['biller_id'])->first();
					?> 
					
					<tr>
						<td colspan=2><span class="dark"> Insurance Name</span></td>
						<td><?php echo $insuarance_for->biller_name;?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Policy No</span></td>
							<td><?php echo $post['policy_no'];?></td>
							</tr>
							
							
							<tr>
								<td colspan=2><span class="dark"> Premium Amount</span></td>
								<td>&#8377; <?php echo $post['premium_amount'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark"> Installment Amount</span></td>
								<td> &#8377; <?php echo $post['amount'];?></td>
							</tr>
					
				    
					<?php  break; } ?>
						</table>
					</div>	
					<div class="line3"></div>
					<div class="padding20 pbottom40">					
					<span class="left size14 ">Total:</span>
	<?php switch($type){
		 case 'recharge':	
		   if($post['flag'] =="2") { ?>			
	<span class="right" >&#8377; <?php echo $amount = $post['po_amount'];?> </span>
	<?php } else {?>
	<span class="right">&#8377; <?php echo $amount = $post['amount'];?> </span>
	 <?php }break; default: ?>
<span class="right">&#8377; <?php echo $amount = $post['amount'];?> </span>
	
	<?php }?>	</div>
					<?php  if(!empty($offer)){ ?>
					   <div class="padding20">					
                                        <span class="left size14 ">SmartBuy Exclusive Offer:</span>

                                        <span class="right " style="color:#e20613;" > ₹ <?php echo $offer['discount_amount'];?> </span>

                                        </div>
					
					<div class="padding20">					
										
					<span class="left size14 ">Net Payable Amount: </span>
	
<span class="right" style="text-align: right;">₹ <?php echo round($amount - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                    <?php } ?>
				</div><br/>
				
						<div class="clearfix"></div><br/>
							<?php 
			$login=Session::get('customer_data'); if(!$login){
 echo Form::open(array("id"=>"form-login","role"=>"form",'method'=>'post','onsubmit' => 'return validateForm();', 'action'=>'Login@checkout_login')); ?>		
				<div class="pagecontainer2 loginbox">
					<div class="cpadding1">
					
						<span class="icon-lockk"></span>
						
						<h3 class="opensans">Log in</h3></br></br>
						<font color="red" style="margin-top: -28px;margin-left: 2px;position: absolute;"><?php echo $validation; ?> </font>
						<input type="text" class="form-control logpadding" name="email" placeholder="Username">
						<br/>
						<input type="password" class="form-control logpadding" name="password" placeholder="Password">
						<div class="margtop20">
							
							<div class="right">
								<button class="btn-search5" type="submit" onclick="errorMessage()">Login</button>	
							</div>
						</div>
						<div class="clearfix"></div><br/>
					</div>
				</div><br/>
			</form>
			<?php } ?>
					</div>
				</div><br/>
				
			
			</div>
			
			
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	
	<!-- END OF CONTENT -->
	

	
	
	<!-- FOOTER -->

	<script type="text/javascript" >
$(document).ready(function() {

 
	$("#checkout_form").validate({
		rules: {
			
			
			s_email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email:true	
				}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address.",
			}
		},
        submitHandler: function(frm) {
      submit();
        }
		
		
		});
		
		
$('.emi_details').hide();
		$('.payment').change(function() {
			
			var paytype=$('input[name=payment]:checked', '#passenger_checkout').val()
			console.log(paytype);
			if(paytype==3)
			{
				$('.emi_details').show();
				$('.emi_showup').hide();
				$('.emi').prop('checked', false);
			}
			else
			{
			  $('.emi_details').hide();
			}
		});

		$('.emi').change(function() {


				if($(".emi").is(':checked'))
				{
				$('.emi_showup').show();

				}
				else
				{
				$('.emi_showup').hide();
				}



		});

		
		});
	
</script>
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>	
	
	
