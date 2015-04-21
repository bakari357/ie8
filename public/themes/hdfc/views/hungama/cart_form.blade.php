<div class="container breadcrub" style="padding-bottom: 5px;">
   <div>
     <a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
      <div class="left">
         <ul class="bcrumbs">
            <li>/</li>
           <li><?php echo HTML::link('allmusic', 'Music'); ?></li>
            <li>/</li>
            <li><a href="#">Checkout</a></li>
            <li>/</li>
         </ul>
      </div>
      <a class="backbtn right" href="#"></a>
   </div>
  
</div>
<!-- CONTENT -->
<div class="container">
<form method="post" id="passenger_checkout" name="passenger_checkout" action="<?php echo $url = URL::action('MusicController@checkout_final_process'); ?>"  >
   <input type="hidden" name="ctype" value="music" />
   <input type="hidden" name="music_details" value="<?php echo $str; ?>" /> 
   <input type="hidden" name="amount" value="<?php echo 10; ?>" /> 
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
   <div class="">
   <!-- LEFT CONTENT -->
   <div class="col-md-8 pagecontainer2 offset-0">
      <div class="padding30 grey">
         <span class="size16px bold dark left">
         </span>
         <div class="clearfix"></div>
        
         <span class="size16px bold dark left">Where can we reach you?</span>
		<div class="roundstep right">1</div>
         <div class="clearfix"></div>
         <div class="line4"></div>
        <div class="col-md-4">
						<div class="margtop15"><span class="dark">Contact Name:</span><span class="red">*</span></div>
					</div>
					
					<div class="col-md-3">
						<span class="size12">First Name</span>
						<input type="text" name="first_name" id="first_name"class="form-control " placeholder=""></div>
					<div class="col-md-3">
						<span class="size12">Last Name</span>
						<input type="text" name="last_name" id="last_name" class="form-control " placeholder="">
					</div>
					<div class="clearfix"></div>
					
					
					
					
					
					<div>
					<div class="col-md-4">
						<div class="margtop15"><span class="dark">Email Address:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-6">
						<input type="text" name="s_email" id="s_email " class="form-control margtop10" placeholder="" ><br>
					</div>
<div class="clearfix"></div>
					
					
<div class="col-md-4">
						<div class="margtop15"><span class="dark">Preferred Phone Number:</span><span class="red">*</span></div>
					</div>
				<div class="col-md-6 ">
						<div class="col-md-3 col-xs-3 col-lg-3 nopad">
						<input type="text" readonly value="+91" class="form-control"/>
						</div>
						<div class="col-md-9 col-xs-9 col-lg-9 nopad">
						<input type="text" name = "mobile" id="mobile" class="form-control" placeholder="">
						</div>
					</div>
           
</div>
					
					<div class="clearfix"></div><br><br>
( All email notifications will be sent to the above address).<br/> <br/>
         <span class="size16px bold dark left">Review and Download your song</span>
         <div class="roundstep right">2</div>
<div class="clearfix"></div>
 <div class="line4"></div>
         
         
         <div class="alert alert-info">
            <b> <span class="attention"> Attention!</span><span class="attention_sub"> Please read important music information!</span></b><br/><br/>
            <p class="size12" style="font-size: 13px">• This song is purchased/ downloaded thorugh our partner Hungama.</p>
             <p class="size12" style="font-size: 13px;">• For all queries and/or activities related to music downloads, please contact us at support@smartbuy.com and 1860 425 3322.</p>
            <p class="size12" style="font-size: 13px;">• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>
            <p class="size12" style="font-size: 13px;">• All song downloads are subject to Partner terms and conditions.</p>
            <p class="size12" style="font-size: 13px;">• Songs downloaded through the portal cannot be modified or cancelled.</p>
           <p class="size12" style="font-size: 13px;">• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
            
            
         </div>
         By clicking on continue booking I acknowledge that I have read and accept the rules & restrictions,
<?php echo HTML::link('content/Terms & Conditions', 'Terms & Conditions',array('target'=>'_blank')); ?> and <?php echo HTML::link('content/Privacy Policy', ' Privacy Policy',array('target'=>'_blank'));?>.<br>
      </div>
      
     <div class="col-xs-12 clearfix nopad pbottom15">

		<div class="col-xs-12 col-md-4 col-lg-4 pull-right">
      
         <input type="submit" name="go" id="submit"  class="btn-search"" value="Continue Booking" style="margin-top: -13px;"/>
      </div> </div>
      <br/><br/><br/>		
   </div>
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
         <span class="left  ">Total:</span>
         <span class="right ">&#8377 <?php echo $amount; ?></span>
        
      </div>
      
       <?php $offer = Offerhelper::offer_calculate(1,$amount); if(!empty($offer)){
       
       
        ?>
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
					 <div class="clearfix"></div>
</form>
</div>
</div><br/></div>
<!-- END OF CONTENT -->
<script src="<?php echo Theme::asset()->url('assets/js/jquery.validate.js')?>"></script>
<script>
   $(document).ready(function() {
   $.validator.addMethod("falpha", function(value, element) {
   return this.optional(element) || /^[A-Za-z\s'\-]+$/i.test(value);
   },  "Name field must contain only letters");
   $.validator.addMethod("lalpha", function(value, element) {
   return this.optional(element) || /^[A-Za-z\s'\-]+$/i.test(value);
   },  "Last name field must contain only letters");
   jQuery.validator.addMethod("numbersonly", function(value, element) {
    return this.optional(element) || /^[0-9\s]+$/i.test(value);
}, "This field only contain numbers."); 
 
   
   		$("#passenger_checkout").validate({
   
   		rules: {
   		first_name : {
   		required: {depends:function(){$(this).val($(this).val());return true;}},
   		falpha:true
   		},
   		last_name : {
   		required: {depends:function(){$(this).val($(this).val());return true;} },
   		lalpha:true
   		},
   		mobile : {
   		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
		numbersonly:true,
		minlength:10,
		maxlength:10
   		},        
                   s_email : {
   		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
   		email:true	
   		    },},
   		messages: {
			first_name: { 
			required: "required."
			},
			last_name: { 
			required: "required."
			},
			mobile: { 
			required: "required.",
			minlength: "Please enter a valid phone / mobile number."
			},
			s_email: { 
			required: "required.",
			email: "Please enter a valid email address.",
			}
   		},
   		onkeyup:false,
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
