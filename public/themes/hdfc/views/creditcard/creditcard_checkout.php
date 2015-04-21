
	<style> .error{ color:red; } </style>
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Payee</a></li>
					<li>/</li>
					<li><a href="#">Checkout</a></li>
					<li>/</li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
		<form method="post" action="<?php echo $url = URL::action('Hotels@Hotel_payment'); ?>" id="hotel_checkout" name="hotel_checkout">		
      
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					
					<div class="roundstep active right">1</div>
					<div class="clearfix"></div>
					
				

           <b>Contact Details </b>
<div class="clearfix"></div>
					<div class="line4"></div>
					<div class="col-md-4 textright">
						<div class="margtop15"><span class="dark">Mobile Number:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-4">
						<!--<span class="size12"> Mobile Number*</span>!-->
						<input type="text" name="mobile" id="mobile" maxlength="10" class="form-control " placeholder="">
						<label for="cname" class="error" style="display: inline-block;"> </label>
					</div>
					<!--<div class="col-md-4 textleft">
					<span class="size12">Last Name*</span>
						<input type="text" name="lastName" id="lastName" class="form-control " placeholder="">
					</div>!-->
					<div class="clearfix"></div>
					
					<br/>
					
					<div class="clearfix"></div>

					<br/>
					<div class="col-md-4">
					</div>
					<div class="col-md-8 textleft">
					
						<!-- End of collapse 4 -->
						<div class="clearfix"></div>	
						
					</div>

					<div class="clearfix"></div><div></div>
					
					
					
					



<span class="size16px bold dark left">Where should we send your confirmation?</span>
					<div class="roundstep active right">2</div>
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
			<br/><br/><br/>
					
				
						
					By selecting to complete this booking I acknowledge that I have read and accept the <a href="#" class="clblue">rules & 
					restrictions</a> <a href="#" class="clblue">terms & conditions</a> , and <a href="#" class="clblue">privacy policy</a>.	<br/>		
				

        
					 <input type="hidden" name="amount" id="discount_amount" value="<?php echo $amount; ?>"/>
					 <input type="hidden" name="urid" id="urid" value=""/>


					<button type="submit" class="bluebtn margtop20">Complete booking</button>	
					
			
				</div>
		
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
                                              <?php 
                                     $payeeing_for = DB::table('billers')->select('biller_name')->where('id',$creditcard_name)->first();
                                              ?>
							<tr>
								<td>Creditcard Name</td>
								<td class="center green bold"><?php echo $payeeing_for->biller_name;?></td>
							</tr>
							<tr>
								<td>Creditcard Number</td>
								<td class="center green bold"><?php echo $creditcard_number;?></td>
							</tr>
							<tr>
								<td> Card Holder Name</td>
								<td class="center green bold"><?php echo $cardholder_name;?></td>
							</tr>
							<tr>
								<td> Amount</td>
								<td class="center green bold"><?php echo $amount;?></td>
							</tr>
							
							
							
							
                                              
						</table>
					</div>	
					<div class="line3"></div>
					<div class="padding30">					
						<span class="left size14 dark">Total:</span>
							
	
	
	<span class="right lred2 bold size18">Rs.<?php echo $amount; ?></span>
	
						
						<div class="clearfix"></div>
					</div>


				</div><br/>
					
				
				<div class="pagecontainer2 loginbox">
					<div class="cpadding1">
						<span class="icon-lockk"></span>
						<h3 class="opensans">Log in</h3>
						<input type="text" class="form-control logpadding" placeholder="Username">
						<br/>
						<input type="text" class="form-control logpadding" placeholder="Password">
						<div class="margtop20">
							<div class="left">
								<div class="checkbox padding0">
									<label>
									  <input type="checkbox">Remember
									</label>
								</div>
								<a href="#" class="greylink">Lost password?</a><br/>
							</div>
							<div class="right">
								<button class="btn-search5" type="submit" onclick="errorMessage()">Login</button>	
							</div>
						</div>
						<div class="clearfix"></div><br/>
					</div>
				</div><br/><br/><br/><br/>
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	<script type="text/javascript" >
$(document).ready(function() {
	$("#hotel_checkout").validate({
		rules: {
			mobile : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			minlength: 10,
			maxlength: 10
			
				},
				
				
			
			s_email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email:true	
				}
						
		},
		messages: {
			s_email: { 
			required: "Email field is required.",
			email: "Please Enter a Valid Email-Address.",
			},
			
			mobile:{
			required: "Mobile number field is required.",
			minlength: "Please enter valid mobile number.",
			}
			
			
		},
        submitHandler: function(frm) {
        submit();
        }
		
		
		});
		});
	
</script>
	
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>	
	
	
