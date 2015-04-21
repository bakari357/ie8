<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script> 
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script>


 
<script type="text/javascript" >
$(document).ready(function() {

 
	
	
jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "This field only contain letters.");
jQuery.validator.addMethod("numbersonly", function(value, element) {
    return this.optional(element) || /^[0-9\s]+$/i.test(value);
}, "This field only contain numbers."); 
	$("#prepaid_form").validate({
		
		rules: {
			
			creditcard_name: {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				},
				
				
				creditcard_number: {
			     required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				minlength:14,
				maxlength:16,
				numbersonly:true
			
				},
				amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			numbersonly:true,
				
				},
			
			cardholder_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			lettersonly:true			
			}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
			},
			cardholder_name:{
			required: "required."
			},
			
			creditcard_name:{
			required: "required."
			},
			creditcard_number:{
			required: "required.",
			minlength :"please enter valid credit card number."
			},
			amount:{
			required: "required."
			}
		},
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
             <li onclick="mySelectUpdate()" class="inactive col-xs-4 col-md-2" ><?php echo HTML::link('insurance_payment', 'Insurance'); ?></li>
             <li onclick="mySelectUpdate()" class="active col-xs-4 col-md-2" style="background: #fff !important;"><a style="color: #004387 !important;">Credit Card  </a></li>
             
          </ul>

					<div class="tab-content2" id="myTabContent" style="height:auto !important;margin-top: 30px;">
							<div id="hotel2"  class="tab-pane fade active in" style="height:auto">
							 
<div class="clearfix"></div></br/></br/>
			</div>
<form name="prepaid_form" id="prepaid_form" method="post">
   <div class="prepaid">
   <div class="container">
       <div class="col-md-6 clearfix pbottom15">
			<div class="textleft">
			 <span class="opensans size13"><b> Select Creditcard</b></span> </span> <span class="red">*</span>
		        <select name="creditcard_name" id="creditcard_name" class="form-control po_mobile"> 
		        <option value=""><?php echo 'select'; ?></option>
		     <?php foreach($creditcard as $creditcards) { ?>
		     <option value="<?php echo ucwords($creditcards->id) ; ?>"><?php echo ucwords($creditcards->biller_name) ; ?></option>
		    <?php  } ?>
		    </select>
			</div>
			</div>
		
		
		
			
	
			<div class="col-md-6 clearfix pbottom15">
				<div class="textleft">
					<span class="opensans size13"><b>Credit Card Number</b></span> </span> <span class="red">*</span>
				<input name="creditcard_number"   type="text"    maxlength="16" id="creditcard_number"  class="form-control po_operator"><div id="card_error"> </div>
				</div>
						
			   			</div>
							 <div class="col-md-6 pbottom15 nopad clearfix">
				<div class="col-md-6">
			
				<!--<span class="opensans size13"><b>Cardholder Name </b></span> </span> <span class="red">*</span>
		    <input name="cardholder_name"   type="text" value=""    id="cardholder_name"  class="form-control po_circle">!-->
		    <span class="opensans size13"><b> Amount ( INR )</b></span> </span> <span class="red">*</span>
				<input name="amount"   type="text" value=""   maxlength="10" id="amount"  class="form-control po_circle">
							</div>
						
            <div class="col-md-6">
				
						
			   			
			<button  type="submit" style="margin-top:18px" class="btn-search">Pay</button>
							</div>
						</div>
<input name="biller_id"   type="hidden" value=""  id="biller_id" >


</div>
</form>
<br>
<div class="clearfix"></div><br/><br/>
			</div>
			<!-- END CONTENT -->			
</div>
		
		</div></div>
		
		
	</div>


<script type="text/javascript">
   

//creditcard_number
$("#creditcard_number").change(function(){

if($("#creditcard_number").val() ==''){
 $("#card_error").hide();
}


var creditcard_id ='';
var creditcard_number ='';
var creditcard_id =  $("#creditcard_name").val();
var validation_ok='';
var creditcard_number = $(this).val();

 $.ajax({
                      type: "POST",
                        async: true,
                      url: "<?=URL::to('load_creditcardprefix')?>",
                      data: {
               "creditcard_id":creditcard_id,"creditcard_number":creditcard_number
              },             
                        success: function(data) {
                      
                        if(data=="0"){ 
                        validation_ok = "0";
                         $("#card_error").html("<font color='#F35958'  style='margin-top: -1px;margin-left: -2px;position: absolute; font-size:12px; font-weight: 400 !important;'> creditcard number is invalid.</font>");
                         if(validation_ok=="0"){
                          return false;
                         }
                        }
                         else if(data==1){ 
                         $("#card_error").html('');
                          validation_ok = "1";
                        }
                       else if(data =="nothing"){
                        $("#card_error").html('');
                           validation_ok = "1";
                       }
                       
                      }
                  });
                 
                  
});
  //$("#creditcard_number").trigger("change");



$("#creditcard_name").change(function(){

var c_num = $("#creditcard_number").val('');

var id = $(this).val();
 $.ajax({
                     type: "POST",
                      url: "<?=URL::to('load_creditcardbiller')?>",
                      data: {
               "id":id
              },             
                        success: function(data) {
                         var biller_id = jQuery.parseJSON(data);
                         $("#biller_id").val(biller_id);
                         }
               
               });
});

 </script>
 

<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

