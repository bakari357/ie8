<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script> 
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script>
<style> 
.po_mobile{width:151%}
.po_operator{width:93%}
.oper_circle{width:50%}
.oper_left{width:34%}
.oper_right{width:34%}
.relation_no{width:104%}
.customer_name{width:111%}
.po_amount{width:94%}
.po_button{width:100%;margin-top:20px;padding-top:5.5px; float:left}
.pre_button{margin-top:20px;padding-top:5.5px; float:left}
</style>

 
	<script>
$(document).ready(function() {
$(".post_paid").hide();

$("#postp").click(function(){
$(".post_paid").show();
$(".prepaid").hide();

//$("#complaintregisterpage").attr('action', "<?php echo 'recharge_post';?>"); 
//$("#complaintregisterpage").submit();
});
$("#pre_mobile").click(function(){

$(".post_paid").hide();
$(".prepaid").show();
$("#complaintregisterpage").attr('action', "<?php echo 'recharge_mob';?>"); 

//$("#complaintregisterpage").submit();
});
$("#dth").click(function(){
$("#complaintregisterpage").attr('action', "<?php 'recharge_dth';?>"); 
$("#complaintregisterpage").submit();
});

});
</script>
<script type="text/javascript" >
$(document).ready(function() {
jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));
	$("#prepaid_form").validate({
		rules: {
			
			mobile : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				number:true,
				minlength:10,
				maxlength:10
				
				
				},
			circle : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				
			amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				min_val:10
				},
			paying_to:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			},
			
			operator : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			
			}
						
		},
		messages: {
			email: { 
			required: "required.",
			email: "Please Enter a Valid Email-Address."
			},
			mobile: { 
			required: "required.",
			minlength: "Please enter a valid mobile number."
			},
			amount: { 
			required: "required."
			},
			paying_to: { 
			required: "required."
			},
			operator: { 
			required: "required."
			},
		},
        submitHandler: function(frm) {
        submit();
        }
		
		
		});
		});
	
</script>
<script type="text/javascript" >
$(document).ready(function() {

           jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));
 
	$("#postpaid_form").validate({
		rules: {
			
			po_mobile : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			number:true,
			minlength:10,
			maxlength:10	
				},
				po_amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			min_val:10,
			number:true
				
				},
			po_paying_to:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			},
			relation_no:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			},
			account_no:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			},
			customer_name:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			},
			
			po_operator : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },			
			}
						
		},
		messages: {
			email: { 
			required: "required.",
			email: "Please Enter a Valid Email-Address."
			},
			po_mobile: { 
			required: "required.",
			minlength: "Please enter a valid mobile number."
			},
			po_amount: { 
			required: "required."
			},
			relation_no: { 
			required: "required."
			},
			customer_name: { 
			required: "required."
			}, 
			po_paying_to:{ 
			required: "required."
			},
			account_no:{
			required: "required."
			}
		},
        submitHandler: function(frm) {
      submit();
        }
		
		
		});
		});
	
</script>
<style>

.btn-search-new{
margin-top: 107px!important;
margin-right: 696px!important;

}
</style>

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
		

		



	<!-- WRAP -->
	<div class="wrap cstyle03">
		
		<div class="container mt-130 z-index100">		
		  <div class="row">
			<div class="col-md-12">
				<div class="bs-example bs-example-tabs cstyle04">
				
					<ul class="nav nav-tabs" style="background:none" id="myTab">
						<li onclick="mySelectUpdate()" style="position: absolute;margin-top: 30px;" class="active"><a data-toggle="tab" href="#hotel2"><span class="hotel"></span><span class="hidetext">Recharge / Payment</span>&nbsp;</a></li>
						
					</ul>
				

					<div class="tab-content2" id="myTabContent" style="height:auto !important;margin-top: 30px;">
							<div id="hotel2"  class="tab-pane fade active in" style="height:auto">
							 <input type="hidden" +value="<?php echo 'id'; ?>" name="pid" /> 
                    	<?php $rtype ='mobile'; if($rtype !='dth') { ?>
                        
                           <div class="col-md-4">
                               <input type="radio" name="rtype" id="pre_mobile" value="mobile" <?php if($rtype=='mobile') echo 'checked'; ?> /><span class="space">Pre-Paid</span></div>
                            <div class="col-md-4 "><input type="radio" name="rtype" id="postp" value="postp" <?php if($rtype=='postp') echo 'checked'; ?> /><span class="space">  Post-Paid</span></div>    
                   <?php } else { ?>  
                   <div class="hide" style="display:none">  
          <input class="int-radio" type="radio" name="rtype" id="dth" value="dth" <?php if($rtype=='dth') echo 'checked'; else echo 'checked'; ?> />
                        <span class="spn-lable"><?php echo 'dth'; ?></span> </div>
               <?php }?>
               
          
                <input type="hidden" name="etop" value="etop">
	
<div class="clearfix"></div>
<hr/></br/></br/>
			</div>
		
<form name="prepaid_form" id="prepaid_form" method="post">
<div class="prepaid">
<div class="container">

		<div class="col-md-6">
			<div class="w50percent">
				<div class="wh90percent textleft">
					<span class="opensans size13"><b>Enter Prepaid Mobile Number</b></span> <span class="red">*</span>
					<input type="text" name="mobile" id="mobile" class="form-control po_mobile" onkeypress="return IsNumeric(event);"  autocomplete="off" ondrop="return false;" onpaste="return false;" maxlength="10" onkeyup="showUser(this.value)" /> 
					<label for="mobile" generated="true" class="error"></label>

				</div>
			</div>
		</div>
				<div class="clearfix"></div></br>
		<div class="col-md-6">
			<div class="w50percent">
				<div class="wh90percent textleft">
						<span class="opensans size13"><b> Select operator</b></span> <span class="red">*</span>
						<select name="operator" id="operator" class="form-control po_mobile"> 
						<option value=""><?php echo 'select'; ?></option>
						<?php $i=1; foreach($operators as $key=>$value) { 

						?>
						<option value="<?php echo ucwords($value) ; ?>"><?php echo ucwords($key) ; ?></option>

						<?php  } ?>
						</select>
						<label for="operators" style="color:white;" generated="true" class="error"> Operator field is required.                 </label>
				</div>
			</div>
		</div>

			<input type="hidden" value="1" name="circle"  id="circle"/>
			<div class="clearfix"></div>

	     <div class="col-md-4 oper_circle">
			<div class="w50percent oper_left">
					<span class="opensans size13"><b> Amount ( INR )</b></span> <span class="red">*</span>
					<input name="amount" type="text" value=""   maxlength="10" id="amount"  class="form-control po_amount">	
					<label for="amount" generated="true" class="error"></label>				
					<input type="hidden" id="flag" name="flag" value="1"/>	
					
			</div>
			<div class="w50percent oper_right">
			<button type="submit" value="submit" id="submit" class="btn-search po_button">Recharge</button>
			</div>
		</div>
			
	


<br>

<input type="hidden" name="prepaid_biller_id"  id="prepaid_biller_id" >

<div class="clearfix"></div>
		
	
<input type="hidden" value="<?php echo ''; ?>" name="pid" />
        <input type="hidden" value="<?php echo 'prepaid'; ?>" name="rtype" />
        <input type="hidden" value="etop" name="ttype" />
          <input type="hidden" value="recharge" name="ctype" />
        <input type="hidden" value=""  name="discount_amount" id="discount_amount"  />
        <input type="hidden" value="oxy_mob" name="sku" />


</div>
</div>
</form>
<form name="postpaid_form" id="postpaid_form" method="post">
<div class="post_paid">				
<div class="container">
		<div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Enter Post-Paid Mobile Number</b></span>   <span class="red">*</span>
			<input type="text" name="po_mobile" id="po_mobile" class="form-control po_mobile"   autocomplete="off" ondrop="return false;" onpaste="return false;" value=""   onkeypress="return IsNumeric(event);" tabindex="1" maxlength="10" onkeyup="show_network(this.value)" >

			</div>
			</div>
		</div>
	
			<div class="clearfix"></div></br>
            <div class="col-md-4 oper_circle">
				<div class="w50percent oper_left">
					<span class="opensans size13"><b> Select operator</b></span>   <span class="red">*</span>
						<select name="po_operator" id="po_operator" class="form-control po_operator"> 


						<option value=""><?php echo 'select'; ?></option>
						<?php $i=1; foreach($poperators as $key=>$value) { 
						?>
						<option value="<?php echo ucwords($value) ; ?>"><?php echo ucwords($key) ; ?></option>
						<?php  } ?>
						</select> 
						<label for="operatorss" style="color:white;" generated="true" class="error"> Operator field is required.                 </label>
					
				</div>
								<div id="show_circle"> </div>
			   			<div id="hide_circle">
							<div class="w50percent oper_right">
								<span class="opensans size13"><b> Select Circle</b></span>   <span class="red">*</span>
								<select  class="form-control po_circle"> 						 
								<option value=""><?php echo 'select'; ?></option>
								</select>
							</div>
						</div>
			</div>
			<div class="clearfix"></div></br>
			
		<div class="col-md-6">
			<div class="w50percent">
					<div class="wh90percent textleft">	
						<div id="relation">
							<span class="opensans size13"><b> Relationship Number</b></span><span  style="font-size:11px; color:red;" id="relation_rule"> </span>   <span class="red">*</span>
							<span style="font-size:11px; color:red;"></span>
							<input name="relation_no" type="text" value="" maxlength="13" id="relation_no"  class="form-control po_mobile">
             	         </div>
             	      <div id="acc_number" >
							<span class="opensans size13"><b> Account Number</b></span><span style="font-size:11px; color:red;" id="relation_rule"> </span>    <span class="red">*</span>
							<span style="font-size:11px; color:red;"></span>
							<input name="account_no" type="text" value="" maxlength="11" id="account_no"  class="form-control po_mobile"  >
                      </div> 
                    </div>  
             	</div>
             </div>
             	<!-- <div class="w50percent oper_right">
					<div class="wh90percent textleft">
						<span class="opensans size13"><b>Customer Name</b></span>
						<input name="customer_name" type="text" value="" maxlength="14" id="customer_name"  class="form-control customer_name">
					</div>
				</div> -->
		</div>
	<div class="clearfix"></div></br>			

		<div class="col-md-4 oper_circle">
			<div class="w50percent oper_left">
					<span class="opensans size13"><b> Amount ( INR )</b></span>    <span class="red">*</span>
					<input name="po_amount" type="text" value="" maxlength="10" id="po_amount"  class="form-control po_amount">
					
			</div>
			<div class="w50percent oper_right">
			<button type="submit" class="btn-search po_button">Pay</button>
			</div>
		</div>

<div class="clearfix"></div>

	<div class="col-md-12">

		<div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">

			<input name="biller_id" type="hidden" id="biller_id" readonly class="form-control"> </a>
			<input name="po_payee_presence" type="hidden" id="po_payee_presence" readonly class="form-control">

			</div>
			</div>

			</div>
			<input type="hidden" id="flag" name="flag" value="2"/>	
			</div></div>
			<input type="hidden" id="po_circle" name="po_circle" />
			<input type="hidden" value="<?php echo 'id'; ?>" name="pid" />
			<input type="hidden" value="<?php echo 'postpaid'; ?>" name="rtype" />
			<input type="hidden" value="BILL" name="ttype" />

			<input type="hidden" value="0" name="discount_amount" id="discount_amount"  />
			</form>
			</div>
<br>
<br>
<br>

			<br/><br/>
			</div>
						 
								
							</div>

						
						</div>
							
						<!--End of Flight + Hotel + Car -->
						
						
					
					
					
					
			</div>
		


<script type="text/javascript">
      $(document).ready(function(){ 
        $("#acc_number").hide();
	 $('#amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	}); 
	
	 $('#po_amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	}); 
	
                  
    }); 


$("#paying_to").on('change',function(){
var paying_to =  $(this).val();
 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('loadpayee_presence')?>",
                      data: {
               "paying_to":paying_to
              },             
                        success: function(data) {
                         var obj=jQuery.parseJSON(data);
                         
	                 $("#pre_biller_id").val(obj.ubp_biller_id);
	                 $("#payee_presence").val(obj.biller_presence); 
                         
                      }
                  });
});

function get_loc(){
 var circle = $("#po_paying_to option:selected").text();
  var oper = $("#po_operator option:selected").text();
 
 if(circle=='Tamil nadu (not including Chennai)' && oper=='Airtel'){
  $("#relation").hide();
  $("#acc_number").show();
 
 }
 
var paying_to =  $("#po_paying_to").val();


 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('loadpayee_presence')?>",
                      data: {
               "paying_to":paying_to
              },             
                        success: function(data) {
                         var obj=jQuery.parseJSON(data);
	                 $("#biller_id").val(obj.ubp_biller_id); 
                          $("#po_payee_presence").val(obj.biller_presence); 
                      }
                  });
}
  
   
  
 </script>	

<script type="text/javascript">
 
        function IsNumeric(e) {
        
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57 )) {
               return false;
                 }
  
        }
function showUser(str)
  {      
        var l=4;
        var series = str.substring(0, 4);

        if((series==9531 || series == 9473 || series == 9468 || series == 9530 || series == 9264) && str.length <= 5)
        {
        l = 5;

        }
       if ((str.length) == l)
        {
        
        $.post("get_mobile_info/"+str,  function(data){
         var obj=jQuery.parseJSON(data);
         $("#operator").val(obj); 
         $("#circle").val(obj.circle);  
         $("#po_circle").val(obj.circle);  
         var oper_text = $("#operator option:selected").text();
         var search_biller = oper_text.toUpperCase() ;
        var  billers = new Array();
        billers["AIRCELPRE"] ='AIRCEL';
        billers['AIRTELPRE']='AIRTEL';
        billers['BSNLPRE']='BSNL';
        billers['IDEAPRE']='IDEA';
        billers['LOOPPRE']='LOOP MOBILE';
	billers['MTNLMUMPRE']='MTNL MUMBAI';
	billers['RIMCDMAPRE']='RELIANCE CDMA';
	billers['RIMGSMPRE']='RELIANCE GSM';
	billers['DOCOMOPRE']='TATA DOCOMO GSM';
	billers['TTSLPRE']='ATA TTSL';
	billers['UNINORPRE']='UNINOR';
	billers['VODAFONPRE']='VODAFONE';
       //console.log(billers);
  

	// show the values stored
	for (var i in billers) {
	if(billers[i]== search_biller){

	$("#prepaid_biller_id").val(i);
	}
	}

      }); 
      
    }
   
  }
  
  function show_network(str)
  {      
        var l=4;
        var series = str.substring(0, 4);

        if((series==9531 || series == 9473 || series == 9468 || series == 9530 || series == 9264) && str.length <= 5)
        {
        l = 5;

        }
       if ((str.length) == l)
        {
        $.post("get_mobile_info/"+str,  function(data){
         var obj=jQuery.parseJSON(data);
	 var operator = $("#po_operator").val(obj);
	  operator_load();
         $("#circle").val(obj.circle); 
         var mob_operator = $("#po_operator").val();
         //alert( mob_operator);
         if(mob_operator=='BSNL' || mob_operator=='LOOP' || mob_operator=='INDI'){
         $("#relation").hide();
         $("#acc_number").show();
         }else if(mob_operator=='IDEA'){
         $("#relation").hide();
         $("#acc_number").hide();
         }
         
         $("#po_circle").val(obj.circle);  
        

      }); 
      
    }
   
  }
  
 function operator_load(){ 
 
  var operator = $("#po_operator").val();
  //alert(operator);
  
                        $("#hide_circle").hide();
                    $.ajax({
                      type: "POST",
                      url: "<?=URL::to('loadpayee_circle')?>",
                      data: {
                   "operator":operator
              },             
                        success: function(data) {
                         $("#show_circle").html(data);
                        
                      }
                  });
 
 }
 
 
 $("#po_operator").on('change',function(){
  var operator = $("#po_operator").val();
  
                    $("#hide_circle").hide();
                    $.ajax({
                      type: "POST",
                      url: "<?=URL::to('loadpayee_circle')?>",
                      data: {
                   "operator":operator
              },             
                        success: function(data) {
                         $("#show_circle").html(data);
                        
                      }
                  });
                  });
 </script>
 
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

			
			
		

