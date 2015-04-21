
<br>
<?php if(isset($form_option) && $form_option!=0){ ?>
<span class="size16px bold dark left">Where can we reach you?</span>
					
					<div class="clearfix"></div>
					<div class="line4"></div>
					<div class="col-md-4 textright" style="margin-right: 13px;">
						<div class="margtop15"><span class="dark">Contact Name:</span><span class="red">*</span></div>
					</div>
					
					<div class="col-md-3">
						<span class="size12">First Name</span>
						<input type="text" name="first_name" id="firstName"class="form-control " placeholder=""></div>
					<div class="col-md-3">
						<span class="size12">Last Name</span>
						<input type="text" name="last_name" id="lastName" class="form-control " placeholder="">
					</div>
					<div class="clearfix"></div>
					
					<br/>
					
					
					
					<div style="margin-left: -203px;">
					<div class="col-md-6 textright">
						<div class="mt15"><span class="dark">Email Address:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-6">
						<input type="text" name="s_email" class="form-control margtop10" placeholder="" style="width: 310px;"><br>
					</div>
<div class="col-md-6 textright">
						<div class="mt15"><span class="dark">Preferred Phone Number:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-5">
						<input style="width:16%;position: absolute;" type="text" readonly value="+91" class="form-control"/><input type="text" name = "mobile" class="form-control" placeholder="" style="
    margin-left: 17%;width: 254px;">
					</div>
</div>
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div><br><br>
( All email notifications will be sent to the above address).<br/> <br/>
<?php } ?>

	<?php if(isset($display_term) && $display_term==1){ ?>
		<span class='size16px bold dark left'>Review and proceed for payment</span><div class="roundstep  right">2</div>
					
					 <div class="clearfix"></div>
					<div class="line4"></div> 
					<div class="payment">
				<?php } ?>	
					<?php if(!empty($msg)) { ?>
					<div class="alert alert-info">
					<?php echo $msg; ?>
					</div>
					<?php } ?>
					
					<?php if(isset($display_term) && $display_term==1){ ?>
					<input type="checkbox" name="check_term" id="check_term" value="2" checked/>&nbsp;You have accepted the <?php echo HTML::link('content/Terms & Conditions', 'Terms & conditions ',array('target'=>'_blank',"style"=>"color:#3a87ad !important;")); ?> 
					
					<div id="term_error"></div>
					<br/>	
			                <?php } ?>
			                <?php if(isset($display_term) && $display_term==2){ ?>
					<input type="checkbox" name="check_term" id="check_term" value="2" checked/>&nbsp;You have accepted the <?php echo HTML::link('content/Terms & Conditions', 'Terms & conditions ',array('target'=>'_blank')); ?> 
					
					<div id="term_error"></div>
					<br/>	
			                <?php } ?>
					
					 
					 
					 <div class="clearfix"></div>
					
					<span class="size16px bold dark left">How would you like to pay?</span> </br>
					<div class="line4"></div> 
<span style="color:#e20613;display: inline-block;"><?php //echo $book; ?>  Total:</span>
						<span style="color: #e20613;">&#8377 <?php  if(isset($amount)) echo $amount ; ?></span>
					<div class="pay_option" style="float:right">
                                 <div style="float:left">       <label>
                                        <input style="margin-right: 6px;" type="radio" name="ptype" class="payment" value="1" checked>
                             		 Credit/Debit Card &nbsp;&nbsp;&nbsp;
                                        </label></div>

								<div style="float:left">	<label>
                                        <input style="margin-right: 6px;" type="radio" name="ptype" class="payment" value="2">
                                        Net Banking&nbsp;&nbsp;&nbsp;
                                        </label> </div>
                                        <?php  if(!empty($emi_data)) {?>
					<div style="float:left"><label>
                                        <input style="margin-right: 6px;" type="radio" name="ptype" class="payment" value="3">
                                        EMI
                                        </label></div>
					<?php } ?>
					
					</div>

				<div class="clearfix"></div>
				<div class="emi_details col-md-12 col-xs-12">
				<?php if(!empty($emi_data)){ ?>
					<span  style="margin-left:10px" > <b>Please choose an EMI Plan <b><span>
					<table class="emi_table">
						<tbody><tr>
							<td width=25px></td>
							<td>EMI Tenure</td>
							<td>Bank Interest Rate</td>
							<td>Monthly Installments</td>
							<td>Interest paid to Bank</td></tr>
							<?php $cnt=1; if(!empty($emi_data)) foreach($emi_data as $erow=>$evalue){ ?>
							<tr>
								<td colspan="1">
								<input type="radio" <?php if($cnt==1)  ?> class="emi_radio" name="emi_option" value="<?php echo $erow; ?> ">
								</td>
								<td>
								<?php echo $erow; ?> Months
								</td>
								
								<td class="emi_font">
								<?php echo $interest[$erow]; ?> %
								</td>
								<td class="emi_font">
								
								<span>&#8377 <?php echo $evalue; ?></span>
								</td>
								<td class="emi_font">
								   <span> &#8377 <?php echo ($evalue * $erow) - $amount; ?></span>
								  
								</td>
							
							</tr>

							<?php $cnt ++; } ?>
						</tbody>
					</table>
					<?php }?>
					</div>
<div id="emi_error"></div>
				</div>
<div class="col-xs-12 clearfix nopad pbottom15">

		<div class="col-xs-12 col-md-4 col-lg-4 pull-right">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<input type="submit" name="go" id="submit"  class="btn-search" value="Continue Booking"/>		
		</div>
		
<div class="clearfix"></div>		
				


<script>
function term_condition(){
if(!$("#check_term").is(':checked'))
{
  $("#term_error").html("<font color='#F35958'  style='margin-top: -1px;margin-left: -2px;position: absolute; font-size:12px; font-weight: 400 !important;'>Please read the Terms & conditions and check the check box.</font>");
return false;
}
	var paytype=$('input[name=ptype]:checked', '#passenger_checkout').val()
			if(paytype==3)
			{  
				var ischecked_method = false; 
				var radio = document.getElementsByName("emi_option");

				for (var i = 0; i < radio.length; i++) { 
				if (radio[i].checked) { // Checked property to check radio Button check or not
				var ischecked_method = true; // Show the checked value
				return true;
				}}	
				if(!ischecked_method)   { //payment method button is not checked
				$("#emi_error").html("<font color='#F35958'  style='margin-top: -1px;margin-left: -2px;position: absolute; font-size:12px; font-weight: 400 !important;'>Please Choose an EMI option.</font>");     // if not checked any RadioButton from the RadioButtonList
				return false;  
 			} } }
</script>
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>					
