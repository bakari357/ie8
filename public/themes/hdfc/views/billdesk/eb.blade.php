<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script> 
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script>
 
<script type="text/javascript" >
$(document).ready(function() {
jQuery.validator.addMethod("numbersonly", function(value, element) {
    return this.optional(element) || /^[0-9\s]+$/i.test(value);
}, "This field should have only numbers."); 

jQuery.validator.addMethod("amount_starting_digit", function(value, element) {
    return this.optional(element) ||  /^([1-9]\d*)$/i.test(value); 
},"Amount field should start with valid numbers."); 

jQuery.validator.addMethod("no_special_char", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
}, "This field should have only numbers and alphabets.");




	$("#insurance_form").validate({
		rules: {
			
			eb_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				
				},
			service_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			no_special_char:true,
			remote: {
			url: "<?=URL::to('check_consumerno')?>",
			type: "post",
			data: {
			remote: function() {
			return;
			}
			}
			}
			
				},
				
				
				
			amount:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			amount_starting_digit:true,
			numbersonly:true
			},
			
			acc_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			}
			
						
		},
		messages: {
			eb_name: { 
			required: "Required."
			},
			acc_no: { 
			required: "Required."
			},
			amount: { 
			required: "Required."
			},
			service_no: { 
			required: "Required.",
			minlength: "Please enter valid  5 or 11 characters.",
			remote:"Please enter valid  5 or 11 characters."
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
             <li onclick="mySelectUpdate()" class="active col-xs-4 col-md-2"   style="background: #fff !important;"><a style="color: #004387 !important;">Electricity</a></li>
             <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('gas_payment', 'Gas'); ?></li> 
             <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('charity_payment', 'Charity'); ?></li>
             <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('insurance_payment', 'Insurance'); ?></li>
            <!-- <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2"><?php echo HTML::link('creditcard_payment', 'Credit Card'); ?></li>!-->
             
          </ul>

					<div class="tab-content2" id="myTabContent" style="height:auto !important;margin-top: 30px;">
							<div id="hotel2"  class="tab-pane fade active in" style="height:auto">
							 
<div class="clearfix"></div></br/></br/>
			</div>
<form name="insurance_form" id="insurance_form" method="post"  action="<?php echo $url = URL::action('ElectricityPayment@do_payment'); ?>" accept-charset="UTF-8">
<div class="prepaid">
<div class="container">

<div class="col-md-6 clearfix pbottom15">
			<div class="textleft">
				<span class="opensans size13"><b>Select Electricity Provider</b></span> <span class="red">*</span>
				<select name="eb_name" id="eb_name" class="form-control"> 
		 <option value=""><?php echo 'Select'; ?></option>
		<?php $i=1; foreach($electricity as  $electricitys ) { 
	
		  ?>
		<option value="<?php echo $electricitys->ubp_biller_id; ?>"><?php echo $electricitys->biller_name; ?></option>
 
		<?php  } ?>
		</select>
			</div>
		</div>
            <div class="col-md-6 clearfix pbottom15">
				<span class="opensans size13"><b> Consumer Number</b></span> <span class="red">*</span>
			<input name="service_no" type="text"   id="service_no" maxlength="11" class="form-control po_operator ">
					
			</div>
			 <div class="col-md-6 clearfix nopad pbottom15">
					<div class="col-md-6">
					<!--<span class="opensans size13"><b> Account Number</b></span>  <span class="red">*</span>
					<input name="acc_no" type="text"   id="acc_no"  class="form-control po_circle">!-->
					<span class="opensans size13"><b>  Amount ( INR )</b></span>  <span class="red">*</span>
								<input name="amount" type="text"  id="amount" maxlength="10" class="form-control po_amount">
					
					</div>
					<div class="col-md-6">
						<button type="submit" style="margin-top:18px"class="btn-search">Pay</button>
					</div>
				
			</div>
			
			<div class="clearfix"></div>

</div>

</div>
<br><br><br>

<br>

<input type="hidden" id="biller_id" name="biller_id">
 <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<inuput type="hidden" name="payment" id="payment" value="electricity">


</div>


		</form>
		</div>
		</div>

		<br>
		<!-- END CONTENT -->			

		</div>

		




<script type="text/javascript">
 
$("#eb_name").on('change', function(){
$("#biller_id").val($(this).val());
});


  
 </script>	


 
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

