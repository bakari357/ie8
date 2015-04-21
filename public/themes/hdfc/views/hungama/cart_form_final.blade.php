
	<div class="container breadcrub" style="padding-bottom:5px;">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><?php echo HTML::link('allmusic', 'Music'); ?></li>
					<li>/</li>
					<li><a href="#">Summary</a></li>
					<li>/</li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		
	</div>	
						<?php $str=base64_decode($music_details);
			$s_details=explode('|',$str);
			$track_id=$s_details[0];
			$track_name=$s_details[1];
				if(isset($s_details[2]))
				{
				$alb_name=$s_details[2];
				$image=	$s_details[3];
				$type= $s_details[4];
				}else{
				$alb_name='';
				$image='';
				$type='';
				} ?>
	<!-- CONTENT -->
	<div class="container">
<form method="post" id="passenger_checkout" name="passenger_checkout" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>"  onsubmit="return term_condition();">		
		<input type="hidden" name="ctype" value="music" />
		<input type="hidden" name="music_details" value="<?php echo $music_details; ?>" /> 
		<input type="hidden" name="amount" value="<?php echo 10; ?>" /> 
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<div class="">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					
					
					<div class="clearfix"></div>
					<span class="size16px bold dark left">Where can we reach you?</span>
					<div class="roundstep  right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					<div class="col-md-12"><div class="col-md-4">
						<span class="dark">First Name:</span>
						&nbsp;&nbsp;<?php echo $post['first_name']; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $post['first_name']; ?>">
					</div>
					<div class="col-md-4 textleft">
					<span class="dark">Last Name:</span>
						&nbsp;&nbsp;<?php echo $post['last_name']; ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $post['last_name']; ?>">
					</div>

					</div>
<br>
					<div class="col-md-12">
					
					
					<div class="col-md-8 textright">
						<div class="mt15"><span class="dark" style="float: left;">Email Address:</span><span style="float: left;"> &nbsp;&nbsp;<?php echo $post['s_email']; ?><span></div>
<input type="hidden" name="s_email" class="form-control margtop10" placeholder="" value="<?php echo $post['s_email']; ?>">
					</div>
<div class="col-md-6 textright">
</div>
</div>
					
						
<div class="col-md-12">	<br>	<br>			
<div class="col-md-8  textright">
						<div class="mt15" ><span class="dark" style="float: left;">Preferred Phone Number:</span>&nbsp;&nbsp;<span style="float: left;"> <?php echo $post['mobile']; ?></span></div>
					</div>
<input style="width:20%;position: absolute;" type="hidden" readonly value="91" class="form-control"/><input type="hidden" name = "mobile" class="form-control" placeholder="" value="<?php echo $post['mobile']; ?>" >
</div>
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address).<br/> 
					
					<br/>

	
					<span class="size16px bold dark left">Review and Download your song</span>
					<div class="roundstep right">2</div>
					<div class="clearfix"></div>
					<div class="line4"></div><div class="alert alert-info">	<b> <span class="attention"> Attention!</span><span class="attention_sub"> Please read important music information!</span></b><br/><br/>
					<p class="size12" style="font-size: 13px">• This song is purchased/ downloaded through our partner Hungama.</p>
					<p class="size12" style="font-size: 13px;">• For all queries and/or activities related to music downloads, please contact us at support@smartbuy.com and 1860 425 3322.</p>
<p class="size12" style="font-size: 13px;">• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>
<p class="size12" style="font-size: 13px;">• All song downloads are subject to Partner terms and conditions.</p>
<p class="size12" style="font-size: 13px;">• Songs downloaded through the portal cannot be modified or cancelled.</p>
<p class="size12" style="font-size: 13px;">• HDFC Bank is acting merely as an facilitator and that the severices and/or goods are provided or sold by &nbsp; the merchants.</p>


					</div>	
					<input type="checkbox" name="check_term" id="check_term" value="2" checked/>You have accepted the 
<?php echo HTML::link('content/Terms & Conditions', 'Terms & Conditions',array('target'=>'_blank')); ?> <br/>	
	<div id="term_error"></div>		<br/>

		
 <?php		                       $offer = Offerhelper::offer_calculate(1,$amount); 
					     
					$check_data=array(
							   'amount'=>round(round($post['amount']) -  $offer['discount_amount']),
                                                           'book'=>'trip',	
							   'cash'=>0,
							   'ctype'=>'music',
							   'emi_data'=>$emi_data,
							   'interest'=>$interest,
							   'form_option'=>0
							   );
						
					$view = View::make('payment_form',$check_data);
					echo $view;
					?>
</div><br/><br/><br/>		
			</div>			
				
				
					</div>
		<div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<img src="<?php echo $image;?>" style="width: 69px;" class="left margright20" alt=""/>
						<span class="opensans size18 dark bold"><?php echo $alb_name;?></span><br/><span class="opensans size13 grey"><?php echo $track_name;?></span><br/>
						
						
					</div>
					<div class="line3"></div>
					
					
					<div class="padding20" style="padding-bottom: 40px;">					
						<span class="left size14">Total:</span>
						<span class="right">&#8377 <?php echo $amount; ?></span>
					
					</div>
					

		<?php  if(!empty($offer)){ ?>
					   <div class="padding20" style="padding-bottom: 40px;">					
                                        <span class="left size14 ">SmartBuy Exclusive Offer:</span>

                                        <span class="right " style="color:#e20613;" > ₹ <?php echo $offer['discount_amount'];?> </span>

                                        </div>
					
					<div class="padding20" style="padding-bottom: 40px;">					
										
					<span class="left size14 ">Net Payable Amount:</span>
	
<span class="right" style="text-align: right;">₹ <?php echo round($amount - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                    <?php } ?>
				</div><br/>

</form>	
<?php 
			$login=Session::get('customer_data'); if(!$login){
 echo Form::open(array("id"=>"form-login","role"=>"form",'method'=>'post','onsubmit' => 'return validateForm();', 'action'=>'Login@checkout_login')); ?>		
				<div class="pagecontainer2 loginbox">
					<div class="cpadding1">
					
						<span class="icon-lockk"></span>
						
						<h3 class="opensans">Log in</h3></br>
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
				</div>
			</form>
			<?php } ?>
		
						
			</div>
				</div>
<!-- END OF CONTENT -->
<script src="<?php echo Theme::asset()->url('assets/js/jquery.validate.js')?>"></script>
<script>
$(document).ready(function() {
$.validator.addMethod("falpha", function(value, element) {
return this.optional(element) || /^[a-z\-\s]+$/i.test(value);
},  "Name field must contain only letters");
$.validator.addMethod("lalpha", function(value, element) {
return this.optional(element) || /^[a-z\-\s]+$/i.test(value);
},  "Last name field must contain only letters");

		$("#passenger_checkout").validate({

		rules: {
		first_name : {
		required: {depends:function(){$(this).val($.trim($(this).val()));return true;}},
		falpha:true
		},
		last_name : {
		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
		lalpha:true
		},
		mobile : {
		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

		},        
                s_email : {
		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
		email:true	
		    },},
		messages: {
		email: { 
		required: "This field is required.",
		email: "Please Enter a Valid Email-Address."
		}
		},
		submitHandler: function(frm) {


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
				
				
				
<script>
$(document).ready(function() {
$('.emi_details').hide();
})

</script>	

	
	
	
	
