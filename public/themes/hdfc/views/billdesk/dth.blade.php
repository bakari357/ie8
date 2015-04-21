<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script> 
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script>
 
<script type="text/javascript" >
$(document).ready(function() {

	
jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 100;
}, jQuery.validator.format("Please enter minimum amount of 100 Rupees."));
jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "This field should have only alphabets."); 
jQuery.validator.addMethod("numbersonly", function(value, element) {
    return this.optional(element) || /^[0-9\s]+$/i.test(value);
}, "This field should have only numbers."); 
jQuery.validator.addMethod("amount_starting_digit", function(value, element) {
    return this.optional(element) ||  /^([1-9]\d*)$/i.test(value); 
},"Amount field should start with valid numbers."); 
 

	$("#prepaid_form").validate({
		
		rules: {
			
			dth_name: {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				},
				
				
				subscriber_id: {
			     required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			       numbersonly:true,
			        minlength:10,
				maxlength:10
			
				},
				amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			amount_starting_digit:true,
			 numbersonly:true,
			min_val:100,
				
				},
			
			subscriber_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			lettersonly:true			
			}
						
		},
		messages: {
			email: { 
			required: "Required.",
			email: "Please Enter a Valid Email-Address."
			},
			dth_name:{
			required: "Required."
			},
			
			subscriber_name:{
			required: "Required."
			},
			subscriber_id:{
			required: "Required.",
			minlength: 'please enter valid 10 digit.'
			
			},
			amount:{
			required: "Required."
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

            <li onclick="mySelectUpdate()"  style="background: #fff !important;" class="active col-xs-4 col-md-2"><a style="color: #004387 !important;">DTH </a></li>
              
            <li  onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2"><?php echo HTML::link('electricity_payment', 'Electricity'); ?></li>
             <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('gas_payment', 'Gas'); ?></li> 
              <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('charity_payment', 'Charity'); ?></li>
                <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('insurance_payment', 'Insurance'); ?></li>
                <!-- <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2"><?php echo HTML::link('creditcard_payment', 'Credit Card'); ?></li>!-->
             
          </ul>

					<div class="tab-content2" id="myTabContent" style="height:auto !important;margin-top: 30px;">
							<div id="hotel2"  class="tab-pane fade active in" style="height:auto">
							 
</br/></br/>
			</div>
<form name="prepaid_form" id="prepaid_form"  action="<?php echo $url = URL::action('DthPayment@do_payment'); ?>" method="post" accept-charset="UTF-8">
   <div class="prepaid">
   <div class="container">
	
				<div class="col-md-6">
					<span class="opensans size13"><b> DTH Service Provider</b></span> <span class="red">*</span>
					        <select name="dth_name" id="dth_name" class="form-control"> 
					        <option value=""><?php echo 'Select'; ?></option>
		    				 <?php foreach($dth as $dths) { ?>
		   					  <option value="<?php echo ucwords($dths->id) ; ?>"><?php echo ucwords($dths->biller_name) ; ?></option>
		   					 <?php  } ?>
						    </select>
				<label for="operatorss" style="color:white;" generated="true" class="error"> Operator field is required.                 </label>
					
				</div> 
				<div class="col-md-6 clearfix nopad pbottom15">
					<div class="col-md-6">	
					<span class="opensans size13"><b>Subscriber Name </b></span>   <span class="red">*</span>
		    		<input name="subscriber_name"   type="text" value=""    id="subscriber_name"  class="form-control">
					</div>
					<div class="col-md-6">
						<span class="opensans size13"><b>Subscriber ID</b></span>  <span class="red">*</span>
						<input name="subscriber_id"   type="text" value=""   maxlength="10" id="subscriber_id"  class="form-control"><div id="card_error"> </div>
					</div> 
			</div>
			


     <div class="col-md-6 clearfix nopad">
			   	<div class="col-md-6">
						<span class="opensans size13"><b> Amount ( INR )</b></span>  <span class="red">*</span>
						<input name="amount"   type="text" value=""   maxlength="10" id="amount"  class="form-control po_amount">
				</div>
				<div class="col-md-6">
					<button type="submit" class="btn-search" style="margin-top:18px">Pay</button>
				</div>

				
	</div>
			
<br>



</div><br/>
</div>
						
           <input type="hidden" name="biller_id" id="biller_id" /> 
            <input type="hidden" name="_token" id="_token"  value="<?php echo csrf_token(); ?>">
</form>

<br>

</div></div></div></div><br/><br/><br/>

<script type="text/javascript">
   


$("#dth_name").on('change',function(){

var dth_id =  $(this).val();
var _token = $("#_token").val();

 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_dthid')?>",
                      data: {
               "dth_id":dth_id,
                 "_token":_token
              },             
                        success: function(data) {
                         var obj=jQuery.parseJSON(data);
	                 $("#biller_id").val(obj);
	                 
                         
                      }
                  });
});
  
 </script>
 

<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

