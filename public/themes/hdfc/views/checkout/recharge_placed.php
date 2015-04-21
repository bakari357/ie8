<?php 
$result = json_decode($values);

if(isset($result->Response)!= ''){
$recharge_result =  explode('~',$result->Response);//echo '<pre>'; print_r($recharge_result); exit;
if($post['input']->Posted->ttype  =='etop'){
$transaction_number = @$recharge_result[9];
$msg = 'Your payment has successfully gone through and your recharge/ payment is confirmed!';
}else{
$transaction_number = @$recharge_result[9];
$msg ='Your payment has successfully gone through and your bill payment is confirmed ';
}
}



?>

	</br>
	<div class="container breadcrub" style="margin-top:-11px;">
	     <div>
			<a class="homebtn left" href="<?php echo Config::get('app.url');?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<?php if(isset($post['input']->Posted->ttype) && $post['input']->Posted->ttype  =='etop'){ ?>
					<li><?php echo HTML::link('mobile_payments', ' Recharge');?></li>
					<?php } else { ?>
					<li><a href="#">Billpayment</a></li>
					<?php } ?>
					<li>/</li>		
					<li><a href="#">Confirmation</a></li>		
				</ul>				
			</div>
			<a class="backbtn right" href="<?php echo Config::get('app.url');?>"></a>
		</div>
	
		
	
</div>
	<!-- CONTENT -->
	<div class="container" >

		<div class="container mt10 offset-0">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">
			
				<div class="padding30 grey">
					<span class="size16px bold dark left"><?php
					if(isset($result) && isset($recharge_result[0]) && $recharge_result[0] != ''){ 
					 if($result->status=='Success') { 
					   foreach (Cart::content() as $key=>$item){$saved_amount =  $item['options']['offer_amount']; }
                        
					$msg.=' <br><br> Your order Number : '.$post['order_number'].'

'; if(isset($saved_amount) && $saved_amount !='') $msg.=' <br> <font style="color:#e20613;">You have saved ₹  '.$saved_amount.' for this order.</font>'; }else{ $msg='Sorry! Your booking is not confirmed. Your order Number : '.$post['order_number'].'

'; } } else {
 
$msg =' Sorry we are unable to process your request. please try again after sometime.<br><br> Your order Number : '.$post['order_number'].'';
 }
?>
<div class="mt3"><span class="dark"><b><?php echo $msg; ?></b></span></div></span>
					
			               <br/><br/>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					<div class="col-md-4"  style="width:293px;">
						<span class="dark">First Name :</span>&nbsp;&nbsp;
						<?php echo $post['input']->Posted->first_name; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $post['input']->Posted->first_name; ?>">
					</div>
					<div class="col-md-4 textleft"  style="width:293px;">
					<span class="dark">Last Name :</span>&nbsp;&nbsp;
						<?php echo $post['input']->Posted->last_name; ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $post['input']->Posted->last_name; ?>">
					</div>
					
					
				<div class="clearfix"></div>
					</br>
					
					<div class="col-md-8 textright" style="margin-top:-11px;width: 534px;">
				<div class="mt15" style="margin-top: 11px;"><span class="dark" style="float: left; margin-top: -28px;">Email Address:</span><span style="float: left;margin-top: -28px;margin-left: 97px;"><?php echo  '&nbsp'.$post['input']->Posted->s_email; ?></div>
					</div>
					<div class="col-md-4">
						
					</div>
				
					
<div class="col-md-10 textright">
						<div class="mt15" style="float: left; margin-top: 1px;"><span class="dark">Preferred Phone Number:</span>&nbsp;&nbsp;<span style=" margin-top: -12px;"><?php echo '&nbsp'.$post['input']->Posted->b_mobile; ?></div>
					</div>
					<div class="col-md-4">
					
					</div>
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address ) 
					
					<br/>
					
					
					
					<div class="clearfix"></div>
					<div class="line4"></div>		
					
					<div class="alert alert-info">
					<b><span class="attention">Attention!</span> <span class="attention_sub">Please read important recharge / bill payment information!</span></b><br/><br/>
					 <p class='size12' style='font-size: 13px'>• This recharge / bill payment is processed through our partner Billdesk.</p>
					 <p class='size12' style='font-size: 13px'>• For any query related to payment status, please contact us at support@smartbuy.com and &nbsp;&nbsp;1860 425 3322</p>
			 <p class='size12' style='font-size: 13px'>• Onus to provide correct payment information lies with the customer.</p>

<p class='size12' style='font-size: 13px'>• HDFC Bank SmartBuy is not responsible for any failures / delays that occur at the partner side.</p>


<p class='size12' style='font-size: 13px'>• Bills paid / recharges done through the portal cannot be cancelled or modified.</p>			 

  <p class='size12' style='font-size: 13px'>• HDFC Bank is acting merely as an facilitator and that the severices and/or goods are provided or sold by  the &nbsp;&nbsp;merchants.</p>
 
					</div>	
</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
					
					<?php $flag = $post['input']->Posted->flag; ?>
					  <?php switch ($flag) { case 'recharge':?>
						<span class="opensans size18 dark bold">Recharge Summary</span>
						<?php break; default: ?>
						<span class="opensans size18 dark bold">Payment Summary</span>
						
						<?php } ?>
						
						
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
                                              <?php switch($flag) { case 'recharge': ?>
				<tr>
				<td colspan=2><span class="dark">Mobile Number</span></td>
				<td ><?php echo $post['input']->Posted->mobile; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark">Mobile Type</span></td>
				<td ><?php echo  "Prepaid"; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark">Mobile operator</span></td>
				<td ><?php echo  $operator; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark"> Amount Paid</span></td>
				<td >&#8377; <?php echo  $post['input']->Posted->amount; ?></td>
				</tr>
				
				<?php break; case 'postpaid': ?>

				<tr>
				<td colspan=2><span class="dark">Mobile Number</span></td>
				<td ><?php echo  $post['input']->Posted->mobile; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark">Mobile Type</span></td>
				<td ><?php echo 'Postpaid'; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark">Mobile operator</span></td>
	
				<td ><?php echo  $operator; ?></td>
				</tr>

				<tr>
				<td colspan=2><span class="dark"> Amount Paid</span></td>
				<td >&#8377; <?php echo  $post['input']->Posted->amount; ?></td>
				</tr>
                               


				<?php break; case 'dth': ?>

				<tr>
				<td colspan=2><span class="dark">DTH operator</span></td>
				<td ><?php echo  $post['input']->Posted->biller_name; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark">Subscriber ID</span></td>
				<td ><?php echo  $post['input']->Posted->subscriber_id; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark">Subscriber Name</span></td>
				<td ><?php echo  $post['input']->Posted->subscriber_name; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark"> Amount Paid</span></td>
				<td >&#8377; <?php echo  $post['input']->Posted->amount; ?></td>
				</tr>
				
                  <?php break; case 'electricity':?>
                  <tr>
				<td colspan=2><span class="dark">Electricity Name</span></td>
				<td ><?php echo  $post['input']->Posted->biller_name; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark">Consumer Number</span></td>
				<td ><?php echo  $post['input']->Posted->service_no; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark"> Email</span></td>
				<td ><?php echo  $post['input']->Posted->s_email; ?></td>
				</tr>
				<tr>
				<td colspan=2> <span class="dark">Amount Paid</span></td>
				<td >&#8377; <?php echo  $post['input']->Posted->amount; ?></td>
				</tr>
				
                  
                  <?php break; case 'gas': ?>
                   <tr>
				<td colspan=2><span class="dark">GAS Name</span></td>
				<td ><?php echo  $post['input']->Posted->biller_name; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark">Customer ID</span> </td>
				<td ><?php echo  $post['input']->Posted->customer_id; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark">Meter No</span> </td>
				<td ><?php echo  $post['input']->Posted->meter_no; ?></td>
				</tr>
				<tr>
				<td colspan=2><span class="dark"> Amount Paid</span></td>
				<td >&#8377; <?php echo  $post['input']->Posted->amount; ?></td>
				</tr>
				
                  
                 <?php break;  case 'subscription':  ?>
                 
                  <tr>
		<td colspan=2><span class="dark">Subscription  Name</span></td>
		      <td ><?php echo  $post['input']->Posted->biller_name;?></td>
			</tr>
			<tr>
				<td colspan=2><span class="dark">Scheme</span></td>
				<td ><?php echo  $post['input']->Posted->scheme;?></td>
			</tr>
			<tr>
				<td colspan=2><span class="dark">Customer Name</span></td>
				<td ><?php echo  $post['input']->Posted->customer_name;?></td>
			</tr>
			
			<tr>
				<td colspan=2><span class="dark">Address 1</span></td>
				<td ><?php echo  $post['input']->Posted->address1;?></td>
			</tr>
			<tr>
				<td colspan=2><span class="dark">Address 2</span></td>
				<td ><?php echo  $post['input']->Posted->address2;?></td>
			</tr>
			<tr>
			
			<tr>
				<td colspan=2><span class="dark"> Amount Paid</span></td>
				<td >&#8377; <?php echo $post['input']->Posted->amount;?></td>
			</tr>
                 <?php break;  case 'charity':  ?>
                   <tr>
		    <td colspan=2><span class="dark">Charity  Name</span></td>
		      <td ><?php echo  $post['input']->Posted->biller_name;?></td>
			</tr>
			<tr>
				<td colspan=2><span class="dark">Contribution Scheme</span></td>
				<td ><?php echo  $post['input']->Posted->contribution_scheme;?></td>
			</tr>
			<tr>
				<td colspan=2><span class="dark">Donor Name</span></td>
				<td ><?php echo  $post['input']->Posted->donor_name;?></td>
			</tr>
			<!--<tr>
				<td colspan=2><span class="dark">Address 1</span></td>
				<td ><?php echo  $post['input']->Posted->address1;?></td>
			</tr>
			<tr>
				<td colspan=2><span class="dark">Address 2</span></td>
				<td ><?php echo  $post['input']->Posted->address2;?></td>
			</tr>!-->
			<tr>
			
			<tr>
				<td colspan=2><span class="dark"> Amount Paid</span></td>
				<td >&#8377; <?php echo $post['input']->Posted->amount;?></td>
			</tr>
                 <?php break; case 'creditcard': ?>
			<tr>
			<td colspan=2> <span class="dark">Creditcard Name</span></td>
			<td ><?php echo $post['input']->Posted->biller_name;?></td>
			</tr>
			
			<tr>
			<td colspan=2><span class="dark">Card Number ending with</span></td>
			<td > <?php echo "XXXX-XXXX-XXXX-".substr($post['input']->Posted->creditcard_number,-4,4); ?></td>
			</tr>
                        
			<tr>
			<td colspan=2> <span class="dark">Amount Paid</span></td>
			<td >&#8377; <?php echo $post['input']->Posted->amount;?></td>
			</tr>
                 
                 <?php break; case 'insurance' : ?>
                 
			<tr>
			<td colspan=2> <span class="dark">Insurance Name</span></td>
			<td ><?php echo $post['input']->Posted->biller_name;?></td>
			</tr>
			<tr>
			<td colspan=2><span class="dark">Policy No</span></td>
			<td ><?php echo $post['input']->Posted->policy_no;?></td>
			</tr>
			<tr>
			<td colspan=2><span class="dark">Client Name</span></td>
			<td ><?php echo $post['input']->Posted->customer_name;?></td>
			</tr>

			<tr>
			<td colspan=2> <span class="dark">Premium Amount</span></td>
			<td >&#8377; <?php echo $post['input']->Posted->premium_amount;?></td>
			</tr>
			<tr>
			<td colspan=2> <span class="dark">Installment Amount</span></td>
			<td > &#8377; <?php echo $post['input']->Posted->amount;?></td>
			</tr>
			<tr>
			
                 <?php break; } ?>
                 
			</table>
		</div>	
		<div class="line3"></div>
		
                                        <div class="padding20 pbottom40">					
                                        <span class="left size14 ">Total:</span>

                                        <span class="right">&#8377; <?php  echo  $post['input']->Posted->amount;?> </span>


                                        </div>
						
			<?php $offer = Offerhelper::offer_calculate(4,$post['input']->Posted->amount); if(!empty($offer)){ ?>
					<div class="padding20 pbottom40">					
					<span class="left size14 ">Exclusive Offer:</span>

<span class="right " style="color:#e20613;" > ₹ <?php echo $offer['discount_amount'];?> </span>
						
					</div>
					
					<div class="padding20 pbottom40">					
					<span class="left "> Amount Paid:</span>
	
<span  class="right" style="text-align: right;">₹ <?php echo round($post['input']->Posted->amount - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                      <?php } ?>
				</div><br/>
					</div>


				</div><br/>
				
			
			</div></div> </span>
			<!-- END OF RIGHT CONTENT -->
			
		
	<!-- END OF CONTENT -->
<script type="text/javascript">
$(document).ready(function(){
     $(document).on("keydown", disableF5);
});

</script>
	
	
<?php Cart::destroy(); ?>		
