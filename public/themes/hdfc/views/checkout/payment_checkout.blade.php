	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
				<li>/</li> <?php if(isset($_POST['ttype']) && $_POST['ttype'] =="etop") { ?>
				<li><a href="#">Recharge</a></li>
				<?php } else { ?>
				<li><?php echo HTML::link('dth_payments', ' Billpayment');?></li>
				<?php } ?>
					<li>/</li>
					<li><a href="#">Checkout</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">
	
	<?php
					
					$type = $post['payment']; 
					if(isset($_POST['ttype'])){
					$ttype = $_POST['ttype'];
					}
					elseif(isset($post['ttype'])){
					$ttype = $post['ttype'];
					}
					
					switch($type) {
					
					case 'recharge': 
					if($ttype =="etop"){?>
					
					<form method="post" action="<?php echo $url = URL::action('MobilePayment@prepaid_payment_final'); ?>" id="checkout_form"  name="checkout_form" accept-charset="UTF-8">
			
					<?php } else { ?>
					<form method="post" action="<?php echo $url = URL::action('MobilePayment@postpaid_payment_final'); ?>" id="checkout_form"  name="checkout_form" accept-charset="UTF-8" >
					
					<?php }
					 break; case 'DTH':?>
				 
					<form method="post" action="<?php echo $url = URL::action('DthPayment@do_payment_final'); ?>" id="checkout_form"  name="checkout_form" accept-charset="UTF-8" >
				
					<?php  break; case 'electricity': ?>
					<form method="post" action="<?php echo $url = URL::action('ElectricityPayment@eb_payment_final'); ?>" id="checkout_form"  name="checkout_form" accept-charset="UTF-8" >
					
					<?php  break; case 'gas':  ?>
					<form method="post" action="<?php echo $url = URL::action('GasPayment@gas_payment_final'); ?>" id="checkout_form"  name="checkout_form" accept-charset="UTF-8" >


					<?php break; case 'subscription':?>


					<?php break; case 'charity': ?>

<form method="post" action="<?php echo $url = URL::action('CharityPayment@charity_payment_final'); ?>" id="checkout_form"  name="checkout_form" accept-charset="UTF-8" >


					<?php break; case 'creditcard': ?>
					<form method="post" action="<?php echo $url = URL::action('Creditcard@crditcard_payment_final'); ?>" id="checkout_form"  name="checkout_form" accept-charset="UTF-8" >

					<?php break;  case 'insurance':?> 
<form method="post" action="<?php echo $url = URL::action('InsurancePayment@insurance_payment_final'); ?>" id="checkout_form"  name="checkout_form" accept-charset="UTF-8">


					<?php break; } ?>

		
		
		<div class="container mt8 offset-0">
			
			
			<!-- LEFT CONTENT -->
				<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					
					
					<div class="clearfix"></div>
					<span class="size16px bold dark left">Where can we reach you?</span>
					<div class="roundstep  right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					
				

<div class="clearfix"></div>
					

					<div class="clearfix"></div><div></div>
					
				
					
					<div class="clearfix"></div>
					
					
					
					
						
				<?php

				if(isset($post['po_amount'])!=''){
				$amount = $post['po_amount'];
				}else{
				$amount = $post['amount'];
				}
				   
					$data=array(
					            'amount'=>$amount,
                                                           'book'=>'trip',	
							   'cash'=>0,
							   'display_term'=>'1',
							   'ctype'=>'recharge',
							   'emi_data'=>'',
							   'interest'=>'',
							   'form_option'=>1,
							   'msg'=>Lang::get('partners.recharge.checkout')
					
						    );
				
				
					$view = View::make('checkout/billdeskcommon',$data);	echo $view;		?>
					
					<br/>
					<br/>
					
					<?php
					
					$type = $post['payment']; ?>
					 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<?php switch($type) {
					
					case 'recharge': 
					if($ttype =="etop"){?>
					
			<input type="hidden" name="prepaid_biller_id" value="<?php echo trim($post['prepaid_biller_id']);?>"/>
						<input type="hidden" name="mobile" value="<?php echo trim($post['mobile']);?>"/>
						<input type="hidden" name="ctype" value="<?php echo trim($post['ctype']);?>"/>
						<input type="hidden" name="payment" value="<?php echo trim($post['payment']);?>"/>
						<input type="hidden" value="<?php echo $post['circle'];?>" name="circle" />
						<input type="hidden" value="<?php echo $post['operator'];?>" name="operator" />
						<input type="hidden" value="recharge" name="flag" />
						<input type="hidden" value="etop" name="ttype" />
						<input type="hidden" value="Prepaid" name="rtype" />
						<input type="hidden" name="payment"  value="recharge"/>
						<input type="hidden" name="amount" value="<?php echo trim($post['amount']);?>"/>
					<?php } else { ?>
					
					<input type="hidden" name="amount" value="<?php echo trim($post['po_amount']);?>"/>
					<input type="hidden" name="biller_id" value="<?php echo trim($post['biller_id']);?>"/>
					<input type="hidden" name="mobile" value="<?php echo trim($post['po_mobile']);?>"/>
					<input type="hidden" value="AAAAAAAAA" name="customer_name" />
					<input type="hidden" value="<?php echo $post['account_no'];?>" name="account_no" /> 
					<input type="hidden" name="po_amount" value="<?php echo trim($post['po_amount']);?>"/>
					<input type="hidden" name="po_mobile" value="<?php echo trim($post['po_mobile']);?>"/>
					<input type="hidden" value="<?php echo $post['po_circle'];?>" name="po_circle" />
					<input type="hidden" value="<?php echo $post['po_operator'];?>" name="po_operator" />
					<input type="hidden" value="<?php echo $post['po_payee_presence'];?>" name="po_payee_presence" />   
					<input type="hidden" value="postpaid" name="flag" />
					<input type="hidden" name="ctype" value="recharge"/>
					<input type="hidden" name="rtype" value="Postpaid"/>
					<input type="hidden" name="relation_no" value="<?php echo trim($post['relation_no']);?>"/>
					<input type="hidden" value="BILL" name="ttype" />
					<input type="hidden" name="payment"  value="postpaid"/>
					
					<?php }
					 break; case 'DTH':
				 $payeeing_for = DB::table('billers')->select('biller_name')->where('id',@$post['dth_name'])->first();
					?> 
					<form method="post" action="<?php echo $url = URL::action('DthPayment@do_payment_final'); ?>" id="checkout_form"  name="checkout_form" accept-charset="UTF-8" >
					<input type="hidden" name="biller_id"  value="<?php echo $post['biller_id']; ?>"/>
					<input type="hidden" name="subscriber_id"  value="<?php echo $post['subscriber_id']; ?>"/>
					
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="dth_name"  value="<?php echo $post['dth_name']; ?>"/> 
					<input type="hidden" name="subscriber_name"  value="<?php echo $post['subscriber_name']; ?>"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="biller_name"  value="<?php echo  @$payeeing_for->biller_name;?>"/>
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
					<input type="hidden" name="eb_name"  value="<?php echo  $post['eb_name'];?>"/>
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
					<input type="hidden" name="gas_name"  value="<?php echo  $post['gas_name'];?>"/>
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
				     $charity_for = DB::table('billers')->select('biller_name')->where('id',$post['biller_id'])->first();?> 
				    
				    <input type="hidden" name="chartity_billerid"  value="<?php echo $post['chartity_billerid']; ?>"/>
					<input type="hidden" name="donor_name"  value="<?php echo $post['donor_name']; ?>"/>
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="address1"  value="<?php echo $post['address1']; ?>"/>
					<input type="hidden" name="address2"  value="<?php echo $post['address2']; ?>"/>
				<input type="hidden" name="contribution_scheme"  value="<?php echo $post['contribution_scheme']; ?>"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="biller_id"  value="<?php echo $post['biller_id'];?>"/>
					<input type="hidden" name="biller_name"  value="<?php echo $charity_for->biller_name;?>"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="flag"  value="charity"/>
					<input type="hidden" name="payment"  value="charity"/>
				    
				    
				    <?php break; case 'creditcard': 
				     $credit_for = DB::table('billers')->select('biller_name')->where('id',$post['creditcard_name'])->first();
					?> 
					<input type="hidden" name="biller_id"  value="<?php echo $post['biller_id']; ?>"/>
					<input type="hidden" name="creditcard_number"  value="<?php echo $post['creditcard_number']; ?>"/>
					<input type="hidden" name="cardholder_name"  value="kjhohohihih"/>
					<input type="hidden" name="amount"  value="<?php echo $post['amount']; ?>"/>
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="creditcard_name"  value="<?php echo  $post['creditcard_name'];?>"/>
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
					<input type="hidden" name="customer_name"  value="dfdffdff">
					<input type="hidden" name="operator"  value=""/>
					<input type="hidden" name="ctype"  value="recharge"/>
					<input type="hidden" name="ttype"  value="bill"/>
					<input type="hidden" name="biller_name"  value="<?php if(isset($insuarance_for->biller_name))  echo  @$insuarance_for->biller_name;?>"/>
					<input type="hidden" name="flag"  value="insurance"/>
					<input type="hidden" name="payment"  value="insurance"/>
				    
				    
				    <?php break; } ?>

</form>				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
					
					<?php 
					
					 switch($type){
					 
					 case 'recharge': if($ttype =="etop"){ ?>
					 
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
					 
					 case 'recharge': if($ttype =="etop"){
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
								<td><?php echo @$payeeing_for->biller_name;?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Subscriber ID</span></td>
								<td><?php echo $post['subscriber_id'];?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Subscriber Name</span></td>
								<td><?php echo @$post['subscriber_name'];?></td>
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
								<td style="vertical-align:middle;"><?php echo $post['service_no'];?></td>
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
		<td ><?php echo $charity_for->biller_name;?></td>
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
				<td  ><?php echo $post['address1'];?></td>
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
						<td><?php echo @$insuarance_for->biller_name;?></td>
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
	<span class="right" > &#8377; <?php echo $amount = $post['po_amount'];?> </span>
	<?php } else {?>
	<span class="right">&#8377; <?php echo $amount = $post['amount'];?> </span>
	 <?php }break; default: ?>
<span class="right">&#8377;  <?php echo $amount = $post['amount'];?> </span>
	
	<?php }?>	
						
					</div>
                                        <?php $offer = Offerhelper::offer_calculate(4,$amount);
                                        
                                         if(!empty($offer)){ ?>
                                        <div class="padding20">					
                                        <span class="left size14 ">SmartBuy Exclusive Offer:</span>

                                        <span class="right " style="color:#e20613;" > ₹ <?php echo @$offer['discount_amount'];?> </span>

                                        </div>
					
					<div class="padding20">					
										
					<span class="left size14 ">Net Payable Amount:</span>
	
<span class="right" style="text-align: right;">₹ <?php echo round($amount - @$offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
					<?php } ?>

				</div><br/>
						<div class="clearfix"></div><br/>
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
jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[A-Za-z\s'\-]+$/i.test(value);
}, "This field should have only alphabets."); 
jQuery.validator.addMethod("numbersonly", function(value, element) {
    return this.optional(element) || /^[0-9.\s]+$/i.test(value);
}, "This field should have only numbers."); 
jQuery.validator.addMethod("starting_digit", function(value, element) {
    return this.optional(element) ||  /^([6-9]\d*)$/i.test(value); 
}, "Mobile number start with valid number."); 
 
	$("#checkout_form").validate({
		rules: {
			
			first_name : {
			required: {depends:function(){$(this).val($(this).val());return true;} },
			lettersonly:true
				},
				last_name : {
			required: {depends:function(){$(this).val($(this).val());return true;} },
			    lettersonly:true
				},
				b_mobile : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			starting_digit:true,
			numbersonly:true,
			minlength:10,
		        maxlength:10
				},
				s_email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email:true
				}
						
		},
		messages: {
			first_name: { 
			required: "Required."
			},
			last_name: { 
			required: "Required."
			},
			b_mobile: { 
			required: "Required.",
			minlength: "Please enter a valid phone / mobile number."
			},
			s_email: { 
			required: "Required.",
			email: "Please enter a valid email address.",
			}
		},
		onkeyup:false,
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
	
	
