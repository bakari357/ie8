
	<style> .error{ color:red; } </style>
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<!--<li>/</li>
					<li><a href="#">Hotels</a></li>
					<li>/</li>
					<li><a href="#">U.S.A.</a></li>
					<li>/</li>					
					<li><a href="#" class="active">New York</a></li>!-->					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>" id="checkout_form"  name="checkout_form" >		
		
		<div class="container mt25 offset-0">
			
			
			<!-- LEFT CONTENT -->
				<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					
					<div class="roundstep active right">1</div>
					<div class="clearfix"></div>
					
				

           <b>Contact Details </b>
<div class="clearfix"></div>
					

					<div class="clearfix"></div><div></div>
					
				
					
					<div class="clearfix"></div>
					<div class="line4"></div>		
					Please enter the email address where you would like to receive your confirmation.<br/> 
					
					
					<div class="col-md-4 textright">
						<div class="mt15"><span class="dark">Email Address:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-4">
						<input type="text" name="s_email" class="form-control margtop10" placeholder="">
					</div>
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div>
					
					<br/>
					<br/>
					<span class="size16px bold dark left">Review and book your Order</span>
					<div class="roundstep active right">2</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					
					<div class="alert alert-info">
					Important information about your booking:<br/>
					<p class="size12">• This transaction is non-refundable and cannot be changed or canceled.</p>
					</div>		
					By selecting to complete this booking I acknowledge that I have read and accept the <a href="#" class="clblue">rules & 
					restrictions</a> <a href="#" class="clblue">terms & conditions</a> , and <a href="#" class="clblue">privacy policy</a>.	<br/>		
					
					<button type="submit" class="bluebtn margtop20">Complete booking</button>
					
					<?php if($post['flag'] =="2") { ?>	
<input type="hidden" name="amount" value="<?php echo trim($post['po_amount']);?>"/>
<input type="hidden" name="biller_id" value="<?php echo trim($post['biller_id']);?>"/>
<input type="hidden" name="mobile" value="<?php echo trim($post['po_mobile']);?>"/>
<input type="hidden" value="<?php echo $_POST['po_circle'];?>" name="circle" />
<input type="hidden" value="<?php echo $_POST['po_operator'];?>" name="operator" /> 
<input type="hidden" value="<?php echo $_POST['customer_name'];?>" name="customer_name" />
<input type="hidden" value="2" name="flag" />
<input type="hidden" name="ctype" value="recharge"/>
<input type="hidden" name="rtype" value="recharge"/>
<input type="hidden" name="relation_no" value="<?php echo trim($post['relation_no']);?>"/>
<input type="hidden" value="BILL" name="ttype" />
<input type="hidden" name="payment"  value="postpaid"/>
	
	<?php }	else{ ?>
	
	
	<input type="hidden" name="prepaid_biller_id" value="<?php echo trim($post['prepaid_biller_id']);?>"/>
	<input type="hidden" name="mobile" value="<?php echo trim($post['mobile']);?>"/>
	<input type="hidden" name="ctype" value="<?php echo trim($post['ctype']);?>"/>
	<input type="hidden" name="payment" value="<?php echo trim($post['payment']);?>"/>
	<input type="hidden" value="<?php echo $_POST['circle'];?>" name="circle" />
	<input type="hidden" value="<?php echo $_POST['operator'];?>" name="operator" />
        <input type="hidden" value="1" name="flag" />
	<input type="hidden" value="etop" name="ttype" />
	<input type="hidden" name="payment"  value="recharge"/>
	<input type="hidden" name="amount" value="<?php echo trim($post['amount']);?>"/>
	<?php }?>
			
</form>				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<span class="opensans size18 dark bold">Payment Details</span>
						
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
                                              <?php if($post['flag'] =='1') { ?>
							<tr>
								<td>Mobile Number</td>
								<td class="center green bold"><?php echo $post['mobile']; ?></td>
							</tr>
							<tr>
								<td>Mobile type</td>
								<td class="center green bold"><?php echo $post['rtype']; ?></td>
							</tr>
							<tr>
								<td>Mobile operator</td>
								<td class="center green bold"><?php echo $post['operator']; ?></td>
							</tr>
							
							<tr>
								<td>Payee Presence</td>
								<td class="center green bold"><?php echo $post['payee_presence']; ?></td>
							</tr>
							<tr>
								<td>Payment Amount</td>
								<td class="center green bold"><?php echo $post['amount']; ?></td>
							</tr>
							<?php }elseif($post['flag'] =='2') { ?>
							
							<tr>
								<td>Mobile Number</td>
								<td class="center green bold"><?php echo $post['po_mobile']; ?></td>
							</tr>
							<tr>
								<td>Mobile type</td>
								<td class="center green bold"><?php echo $post['rtype']; ?></td>
							</tr>
							<tr>
								<td>Payee Presence</td>
								<td class="center green bold"><?php echo $post['po_payee_presence']; ?></td>
							</tr>
							
							
							
							<tr>
								<td>Payment Amount</td>
								<td class="center green bold"><?php echo $post['po_amount']; ?></td>
							</tr>
							
							
							
                                                 <?php }else { ?>
							
							<tr>
								<td>DTH operator</td>
								<td class="center green bold"><?php echo $post['operator']; ?></td>
							</tr>
							<tr>
								<td>DTH serviceno</td>
								<td class="center green bold"><?php echo $post['serviceno']; ?></td>
							</tr>
							<tr>
								<td>DTH amount</td>
								<td class="center green bold"><?php echo $post['amount']; ?></td>
							</tr>
                                          <?php } ?>
						</table>
					</div>	
					<div class="line3"></div>
					<div class="padding30">					
						<span class="left size14 dark">Total:</span>
						<?php if($post['flag'] =="2") { ?>	
	<span class="right lred2 bold size18">Rs.<?php echo $post['po_amount']; ?></span>
	<?php }	else{ ?>
	<span class="right lred2 bold size18">Rs.<?php echo $post['amount']; ?></span>
	<?php }?>
						
						<div class="clearfix"></div>
					</div>


				</div><br/>
				
				
				
			
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	

	
	
	<!-- FOOTER -->

	<script type="text/javascript" >
$(document).ready(function() {

 
	$("#checkout_form").validate({
		rules: {
			
			firstName : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			minlength: 3,
			maxlength: 100
			
				},
				lastName : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				minlength: 3,
			maxlength: 100
				},
				address1 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				minlength: 3,
				maxlength: 120
				},
				address2 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				
				minlength: 3,
				maxlength: 120
				},
			
			s_email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email:true	
				}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address.",
			},
			
			firstName:{
			required: "This field is required.",
			minlength: "Please Enter at least 3 characters.",
			},
			lastName:{
			required: "This field is required.",
			minlength: "Please enter at least 3 characters.",
			},
			lastName:{
			required: "This field is required.",
			minlength: "Please enter at least 3 characters.",
			},
			address1:{
			required: "This field is required.",
			minlength: "Please enter at least 3 characters.",
			maxlength: "Please enter maximum 120 characters.",
			},
			address2:{
			required: "This field is required.",
			minlength: "Please enter at least 3 characters.",
			maxlength: "Please enter maximum 120 characters.",
			}
		},
        submitHandler: function(frm) {
      //  var point=$("#myTextInput").val();
     //   var cash=$("#customerpoints1").val();

        if(point==0 && cash==0)
        {
        $("#perror").css('display','block');

        return false;
        }
        else
        {
        frm.submit();
        $("#submit").css('display','none');
        return true;
        }
        }
		
		
		});
		});
	
</script>
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>	
	
	
