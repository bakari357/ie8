
	<style> .error{ color:red; } </style>
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Hotels</a></li>
					<li>/</li>
					<li><a href="#">U.S.A.</a></li>
					<li>/</li>					
					<li><a href="#" class="active">New York</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">
<form method="post" action="<?php echo $url = URL::action('Hotels@Hotel_payment'); ?>"   id="checkout_form"  name="checkout_form"  >		
		
		<div class="container mt25 offset-0">
			
			
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
						<input type="text" name="mobile"  id="mobile"class="form-control " placeholder="">
						<label for="cname" class="error" style="display: inline-block;"> </label>
					</div>
					
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
					
					<br/>
					<br/>
					<span class="size16px bold dark left">Review and book your trip</span>
					<div class="roundstep active right">3</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					
					<div class="alert alert-info">
					Important information about your booking:<br/>
					<p class="size12">• This reservation is non-refundable and cannot be changed or canceled.</p>
					</div>		
					By selecting to complete this booking I acknowledge that I have read and accept the <a href="#" class="clblue">rules & 
					restrictions</a> <a href="#" class="clblue">terms & conditions</a> , and <a href="#" class="clblue">privacy policy</a>.	<br/>		
					
					<button type="submit" class="bluebtn margtop20">Complete booking</button>
					
	<input type="hidden" name="amount" value="<?php echo trim($post['amount']);?>"/>
	
			
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
                                            
							<tr>
								<td>Electricity Name</td>
								<td class="center green bold"><?php echo $post['eb_name']; ?></td>
							</tr>
							<tr>
								<td>Service Number</td>
								<td class="center green bold"><?php echo $post['service_no']; ?></td>
							</tr>
							<tr>
								<td>Account Number</td>
								<td class="center green bold"><?php echo $post['acc_no']; ?></td>
							</tr>
							<tr>
								<td> Amount </td>
								<td class="center green bold"><?php echo $post['amount']; ?></td>
							</tr>
							
						
						</table>
					</div>	
					<div class="line3"></div>
					<div class="padding30">					
						<span class="left size14 dark">Total:</span>
						
	<span class="right lred2 bold size18">Rs.<?php echo $post['amount']; ?></span>

						
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
				</div><br/>
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	

	
	
	<!-- FOOTER -->
	
	<div class="footerbgblack">
		<div class="container">		
			
			<div class="col-md-3">
				<span class="ftitleblack">Let's socialize</span>
				<div class="scont">
					<a href="#" class="social1b"><img src="images/icon-facebook.png" alt=""/></a>
					<a href="#" class="social2b"><img src="images/icon-twitter.png" alt=""/></a>
					<a href="#" class="social3b"><img src="images/icon-gplus.png" alt=""/></a>
					<a href="#" class="social4b"><img src="images/icon-youtube.png" alt=""/></a>
					<br/><br/><br/>
					<a href="#"><img src="images/logosmal2.png" alt="" /></a><br/>
					<span class="grey2">&copy; 2013  |  <a href="#">Privacy Policy</a><br/>
					All Rights Reserved </span>
					<br/><br/>
					
				</div>
			</div>
			<!-- End of column 1-->
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Golf Vacations</a></li>
					<li><a href="#">Ski & Snowboarding</a></li>
					<li><a href="#">Disney Parks Vacations</a></li>
					<li><a href="#">Disneyland Vacations</a></li>
					<li><a href="#">Disney World Vacations</a></li>
					<li><a href="#">Vacations As Advertised</a></li>
				</ul>
			</div>
			<!-- End of column 2-->		
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Weddings</a></li>
					<li><a href="#">Accessible Travel</a></li>
					<li><a href="#">Disney Parks</a></li>
					<li><a href="#">Cruises</a></li>
					<li><a href="#">Round the World</a></li>
					<li><a href="#">First Class Flights</a></li>
				</ul>				
			</div>
			<!-- End of column 3-->		
			
			<div class="col-md-3 grey">
				<span class="ftitleblack">Newsletter</span>
				<div class="relative">
					<input type="email" class="form-control fccustom2black" id="exampleInputEmail1" placeholder="Enter email">
					<button type="submit" class="btn btn-default btncustom">Submit<img src="images/arrow.png" alt=""/></button>
				</div>
				<br/><br/>
				<span class="ftitleblack">Customer support</span><br/>
				<span class="pnr">1-866-599-6674</span><br/>
				<span class="grey2">office@travel.com</span>
			</div>			
			<!-- End of column 4-->			
		
			
		</div>	
	</div>
	
	<div class="footerbg3black">
		<div class="container center grey"> 
		<a href="#">Home</a> | 
		<a href="#">About</a> | 
		<a href="#">Last minute</a> | 
		<a href="#">Early booking</a> | 
		<a href="#">Special offers</a> | 
		<a href="#">Blog</a> | 
		<a href="#">Contact</a>
		<a href="#top" class="gotop scroll"><img src="images/spacer.png" alt=""/></a>
		</div>
	</div>
	<script type="text/javascript" >
$(document).ready(function() {

 
	$("#checkout_form").validate({
		rules: {
			
			mobile : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			number:true,
				minlength:10,
				maxlength:10
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
		   mobile: { 
			required: "This field is required.",
			minlength: "Please enter a valid mobile number."
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
	
	
