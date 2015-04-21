<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script> 
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script>

<script type="text/javascript" >
$(document).ready(function() {

$.validator.addMethod("pan", function(value, element)
    {
        return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
    }, "Invalid Pan Number");
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
			donor_name: {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			minlength:3,
			lettersonly:true,
			maxlength: 100
			
				},
				email: {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email: true
			
			
				},
				mobile : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				number:true,
				minlength:10,
				maxlength:10
				},
				pan: {
				required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				pan: true
				},
				contribution_scheme : {
				required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				},

				dummy_contribution_scheme:{
				required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				},
				amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			amount_starting_digit:true,
			numbersonly:true,
			number:true
				
				},
			
			biller_id : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },			
			},
			address1 : {
			required: {depends:function(){$(this).val($(this).val());return true;} },
			minlength: 3,
		        maxlength: 120
				
				},
				address2 : {
			required: {depends:function(){$(this).val($(this).val());return true;} },
				minlength: 3,
				maxlength: 120
				},
						
		},
		messages: {
		
		biller_id : {
			required: "Required.",			
			},
			email: { 
			required: "Required.",
			email: "Please Enter a Valid Email-Address."
			},
			contribution_scheme : {
			required: "Required."
			},

			dummy_contribution_scheme:{
			required: "Required."
			},
			amount: { 
			required: "Required."
			},
			pan: { 
			required: "Required."
			},
			donor_name:{
			required: "   Required.",
			minlength: "Please Enter at least 3 characters.",
			},
			address1:{
			required: "Required.",
			minlength: "Please enter at least 3 characters.",
			maxlength: "Please enter maximum 120 characters."
			},
			mobile: { 
			required: "Required.",
			minlength: "Please enter a valid mobile number."
			},
			address2:{
			required: "Required.",
			minlength: "Please enter at least 3 characters.",
			maxlength: "Please enter maximum 120 characters."
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
                 <li onclick="mySelectUpdate()"  class="inactive col-xs-4 col-md-2"><?php echo HTML::link('gas_payment', 'Gas'); ?></li>
             <li onclick="mySelectUpdate()" class="active col-xs-4 col-md-2"  style="background: #fff !important;"><a style="color: #004387 !important;">Charity </a></li>
             <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('insurance_payment', 'Insurance'); ?></li>
             <!--<li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2"><?php echo HTML::link('creditcard_payment', 'Credit Card'); ?></li>!-->
             
          </ul>

					<div class="tab-content2" id="myTabContent" style="height:auto !important;margin-top: 30px;">
							<div id="hotel2"  class="tab-pane fade active in" style="height:auto">
							 
<div class="clearfix"></div></br/></br/>
			</div>
<form name="prepaid_form" id="prepaid_form" action="<?php echo $url = URL::action('CharityPayment@biller_details'); ?>" method="post" accept-charset="UTF-8">
   <div class="prepaid">
   <div class="container">
                        <div class="col-md-6 clearfix pbottom15">
			<div class="textleft">
			  <span class="opensans size13"><b> Select Charity Name</b></span>  <span class="red">*</span>
		        <select name="biller_id" id="biller_id" class="form-control po_mobile"> 
		        <option value=""><?php echo 'Select'; ?></option>
		     <?php foreach($billers as $biller) { ?>
		     <option value="<?php echo ucwords($biller->id) ; ?>"><?php echo ucwords($biller->biller_name) ; ?></option>
		    <?php  } ?>
		    </select>
			</div>
			</div>
		
		
	
		
		 <div class="col-md-6 pbottom15 nopad clearfix"  >
			 <div class="col-md-6" id="scheme" style="margin-top: 6px;!important;">
			<div id="hide_scheme">
			
			<span class="opensans size13"><b> Contribution Scheme </b></span>  <span class="red">*</span>
		       
		       <select name="dummy_contribution_scheme" id="dummy_contribution_scheme" class="form-control po_mobile" id="scheme_hide">
		       <option value=""><?php echo 'Select'; ?></option>
		       </select>
	
			</div>
</div>
			
		
		
		
			
	
			
            <div class="col-md-6" style="margin-top: 6px;!important;">
				
					<span class="opensans size13"><b> Donor Name</b></span>  <span class="red">*</span>
				<input name="donor_name"   type="text" value=""   id="donor_name"  class="form-control po_operator">
				</div>
						
			   			
							
						</div>
			
			<!--
			<div class="clearfix"></div></br>
            <div class="col-md-4 oper_circle">
				<div class="w50percent oper_left">
				<span class="opensans size13"><b>Mobile Number</b></span> <span class="red">*</span>
				<input name="mobile"   type="text" value=""   maxlength="10" id="mobile"  class="form-control po_operator">
				</div>
						
			   			<div>
							<div class="w50percent oper_right">
			<span class="opensans size13"><b> PAN Number</b></span> <span class="red">*</span>
		      <input name="pan"   type="text" value="" maxlength="10" id="pan"  class="form-control po_circle">
							</div>
						</div>
			</div>!-->
					
	<div class="col-md-6 pbottom15 nopad clearfix" style="margin-top: 6px;!important;">
			
            <div class="col-md-6">
			 <span class="opensans size13"><b> Address Line1</b></span> <span class="red">*</span>
		        
		          <textarea rows="4" cols="60" name="address1" id="address1" class=" form-control margtop10  po_mobile">  </textarea>
			</div>
			
		
		
			 <div class="col-md-6" style="margin-top: 6px;!important;">
			
			 <span class="opensans size13"><b> Address Line2</b></span> <span class="red">*</span>
		           <textarea rows="4" cols="60" name="address2" id="address2" class=" form-control margtop10  po_mobile">  </textarea>
			</div>
			</div>
		
			<div class="col-md-6 pbottom15 nopad clearfix">
			
            <div class="col-md-6">
			<span class="opensans size13"><b> Amount ( INR )</b></span> <span class="red">*</span>
				<input name="amount"   type="text" value=""   maxlength="10" id="amount"  class="form-control po_circle">
			</div>
			<div class="col-md-6">
			<input type="hidden" id="chartity_billerid" name="chartity_billerid">
                         <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
			<button type="submit" style="margin-top:18px" class="btn-search">Pay</button>
</div>
</div>
</div>
						

</form>


<br>


			<div class="clearfix"></div><br/><br/>
			</div>
			<!-- END CONTENT -->			
			
</div>
		
		

			
		</div>
		
		
	</div></div>


<script type="text/javascript">

$("#biller_id").on('change',function(){
var biller_id =  $(this).val();
var _token = $("#_token").val();
$("#hide_scheme").hide();


 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_biller')?>",
                      data: {
               "biller_id":biller_id,
                 "_token":_token
              },             
                        success: function(data) {
                          $("#scheme").html(data);
                      }
                  });
});
  
  
  $("#biller_id").on('change',function(){
  var biller_id =  $(this).val();
  var _token = $("#_token").val();
    $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_chartitybiller')?>",
                      data: {
               "biller_id":biller_id,
                 "_token":_token
              },             
                        success: function(data) {
                          var obj=jQuery.parseJSON(data);
                          $("#chartity_billerid").val(obj);
                      }
                  });
  });
 </script>
 

<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

