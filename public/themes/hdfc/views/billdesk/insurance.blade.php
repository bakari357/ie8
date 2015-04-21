<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script> 
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script>


<script type="text/javascript" >
$(document).ready(function() {
/*jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));*/
jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "This field should have only alphabets.");
jQuery.validator.addMethod("numbersonly", function(value, element) {
    return this.optional(element) || /^[0-9\s]+$/i.test(value);
}, "TThis field should have only numbers."); 
jQuery.validator.addMethod("amount_starting_digit", function(value, element) {
    return this.optional(element) ||  /^([1-9]\d*)$/i.test(value); 
},"Amount field should start with valid numbers."); 

jQuery.validator.addMethod("no_special_char", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
}, "This field should have only numbers and alphabets.");

	$("#insurance_form").validate({
		rules: {
			
			insurance_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				
				},
				customer_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			lettersonly:true
				
				},
				email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email:true
			
				
				},
			policy_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			no_special_char:true
				
				},
				
				
				client_id : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			no_special_char:true,
			minlength:6,
			maxlength:10	
				},
			premium_amount:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			amount_starting_digit:true,
			numbersonly:true
			},
			
			amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			amount_starting_digit:true,
			numbersonly:true
			},
			contact_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			number:true,
				minlength:10,
				maxlength:10
			}
						
		},
		messages: {
			insurance_name: { 
			required: "Required."
			},
			customer_name: { 
			required: "Required."
			},
			policy_no: { 
			required: "Required."
			},
			premium_amount: { 
			required: "Required."
			},
			amount: { 
			required: "Required."
			},
			client_id: { 
			required: "Required.",
			minlength :"Please enter valid client id."
			},
			email: { 
			required: "Email field is required."
			},
			contact_no: { 
			required: "Required.",
			minlength: "Please enter a valid Mobile number."
			}
		},
		onkeyup:false,
        submitHandler: function(frm) {
        submit();
        }
		
		
		});
		});
	
</script>
<!-- /Top wrapper -->


	<!--
	#################################
		- THEMEPUNCH BANNER -
	#################################
	-->
	<div id="dajy" class="fullscreen-container mtslide sliderbg fixed">
  <div class="fullscreenbanner">
    <ul>
      
    			<!-- papercut fade turnoff flyin slideright slideleft slideup slidedown-->
				        <?php  foreach($banners as $banner){ 
                
                 
                 $prim = $banner->primary_image;
                 $images = json_decode($banner->images);
                $image = $images; 
               
                 if($prim <> ''){
                   $image  = $images->$prim; 
                 }
                 else{
                 foreach($images as $key => $image){
                 $prim = $key; 
                break; 
                }
                 $image =  $images->$prim; 
                 }
                
                
                  ?>
				
				<!--	 FADE -->
					<li data-transition="fade" data-slotamount="1" data-masterspeed="300"> 										
						
						<img src="<?php echo '/smartbuy_admin/public/uploads/banners/'.$image->filename; ?>" alt="" />
						<!--<div class="tp-caption scrolleffect sft"
							 data-x="center"
							 data-y="120"
							 data-speed="1000"
							 data-start="800"
							 data-easing="easeOutExpo"  >
							 <div class="sboxpurple textcenter">
								
							 </div>
						</div> -->	
					</li>	
					
					<?php } ?> 
    </ul>
    <div class="tp-bannertimer none"></div>
  </div>
</div>

		<!--
		##############################
		 - ACTIVATE THE BANNER HERE -
		##############################
		-->
		<script type="text/javascript">

			var tpj=jQuery;
			tpj.noConflict();

			tpj(document).ready(function() {

			if (tpj.fn.cssOriginal!=undefined)
				tpj.fn.css = tpj.fn.cssOriginal;

				tpj('.fullscreenbanner').revolution(
					{
						delay:9000,
						startwidth:1170,
						startheight:200,

						onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off

						thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
						thumbHeight:50,
						thumbAmount:3,

						hideThumbs:0,
						navigationType:"bullet",				// bullet, thumb, none
						navigationArrows:"solo",				// nexttobullets, solo (old name verticalcentered), none

						navigationStyle:false,				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


						navigationHAlign:"left",				// Vertical Align top,center,bottom
						navigationVAlign:"bottom",					// Horizontal Align left,center,right
						navigationHOffset:30,
						navigationVOffset:30,

						soloArrowLeftHalign:"left",
						soloArrowLeftValign:"center",
						soloArrowLeftHOffset:20,
						soloArrowLeftVOffset:0,

						soloArrowRightHalign:"right",
						soloArrowRightValign:"center",
						soloArrowRightHOffset:20,
						soloArrowRightVOffset:0,

						touchenabled:"on",						// Enable Swipe Function : on/off


						stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
						stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

						hideCaptionAtLimit:0,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
						hideAllCaptionAtLilmit:0,				// Hide all The Captions if Width of Browser is less then this value
						hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value


						fullWidth:"on",							// Same time only Enable FullScreen of FullWidth !!
						fullScreen:"off",						// Same time only Enable FullScreen of FullWidth !!


						shadow:0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

					});


		});
		</script>
		

	<style>
	.nav-tabnew{
	height:10px!important;
	}
	</style>	



	<!-- WRAP -->
	<div class="wrap cstyle03">
		
		<div class="container mt-130 z-index100">		
		  <div class="row">
			<div class="col-md-12">
				<div class="bs-example bs-example-tabs cstyle04">
				
					<ul class="nav nav-tabs nav-tabnew billpayments" id="myTab" style="background: none !important; margin-top: -96px;">
                 
             <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('dth_payments', 'DTH'); ?></li>
             <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2"><?php echo HTML::link('electricity_payment', 'Electricity'); ?></li>
                <li onclick="mySelectUpdate()"  class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('gas_payment', 'Gas'); ?></li>
             <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('charity_payment', 'Charity'); ?></li>
             <li onclick="mySelectUpdate()" class="active col-xs-4 col-md-2" style="background: #fff !important;" ><a style="color: #004387 !important;" >Insurance</a></li>
            <!-- <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2"><?php echo HTML::link('creditcard_payment', 'Credit Card'); ?></li>!-->
             
          </ul>

					<div class="tab-content2" id="myTabContent" style="height:auto !important;margin-top: 30px;">
							<div id="hotel2"  class="tab-pane fade active in" style="height:auto">
							 
<div class="clearfix"></div></br/></br/>
			</div>
<form name="insurance_form" id="insurance_form" method="post" 
 action="<?php echo $url = URL::action('InsurancePayment@do_payment'); ?>" accept-charset="UTF-8">
<div class="prepaid">
<div class="container">

      <div class="col-md-6 clearfix pbottom15">
			<div class="textleft">
			 <span class="opensans size13"><b>Select Insurance Name</b></span></span> <span class="red">*</span>
			 <select name="insurance_name" id="insurance_name" class="form-control po_mobile"> 
		 <option value=""><?php echo 'Select'; ?></option>
		<?php $i=1; foreach($insurance as  $insurances ) { 
	
		  ?>
		<option value="<?php echo $insurances->ubp_biller_id; ?>"><?php echo $insurances->biller_name; ?></option>
 
		<?php  } ?>
		</select>
			</div>
			</div>
		
		
		
			
	
			
            <div class="col-md-6 clearfix pbottom15">
			<div class="textleft">
					<span class="opensans size13"><b> Policy Number</b></span></span> <span class="red">*</span>
			<input name="policy_no" type="text"   id="policy_no" maxlength="12" class="form-control po_operator">
				</div>
						
			   			</div>
							<div class="col-md-6 pbottom15 nopad clearfix">
				<div class="col-md-6">
			<span class="opensans size13"><b> Client Id </b></span></span> <span class="red">*</span>
			<input name="client_id" type="text"   id="client_id"  class="form-control po_circle">
							</div>
						
            <div class="col-md-6">
				
				<span class="opensans size13"><b>Premium Amount</b></span> </span> <span class="red">*</span>
			<input name="premium_amount" type="text"  id="premium_amount"  maxlength="10" class="form-control po_operator">
				</div>
						
			   			</div>
							<div class="col-md-6 pbottom15 nopad clearfix">
				<div class="col-md-6">
			<span class="opensans size13"><b>Installment Amount</b></span></span> <span class="red">*</span>
			<input name="amount" type="text" id="amount" maxlength="10"  class="form-control po_circle"> 
							</div>
						
			<!--<div class="clearfix"></div></br>
			<div class="col-md-4 oper_circle">
				<div class="w50percent oper_left">
				<span class="opensans size13"><b>Client Name</b></span></span> <span class="red">*</span>
			<input name="customer_name" type="text"  id="customer_name"  class="form-control po_operator"> 
				</div>
						
			   			<div>
							<div class="w50percent oper_right">
			<span class="opensans size13"><b>Mobile Number</b></span></span> <span class="red">*</span>
			<input name="contact_no" type="text"  id="contact_no"  class="form-control po_circle">	
							</div>
						</div></div>!-->
						
			
<input name="biller_id" type="hidden" id="biller_id" class="form-control"> 
 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<div class="col-md-6">


			<button type="submit" style="margin-top:18px" class="btn-search">Pay</button>
</div></div>
</div></div>
</form>

<br>


			<div class="clearfix"></div><br/><br/>
			</div>
			<!-- END CONTENT -->			
			
</div>
		
		

			
		</div>
		
		
	</div>


<script type="text/javascript">
     



$("#insurance_name").on('change',function(){

var insurance_name =  $(this).val();
	$("#biller_id").val(insurance_name); 
               
});

  
 </script>	


 
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

