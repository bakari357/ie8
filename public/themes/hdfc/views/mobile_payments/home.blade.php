 
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
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
			},
			mobile: { 
			required: "Mobile field is required.",
			minlength: "Please enter a valid mobile number."
			},
			amount: { 
			required: "Amount field is required."
			},
			paying_to: { 
			required: "Circle field is required."
			},
			operator: { 
			required: "Operator field is required."
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
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
			},
			po_mobile: { 
			required: "Mobile field is required.",
			minlength: "Please enter a valid mobile number."
			},
			po_amount: { 
			required: "Amount field is required."
			},
			relation_no: { 
			required: "Relationship Number field is required."
			},
			customer_name: { 
			required: "Customer Name field is required."
			}, 
			po_paying_to:{ 
			required: "Circle Name field is required."
			},
			account_no:{
			required: "Account Number field is required."
			}
		},
        submitHandler: function(frm) {
      submit();
        }
		
		
		});
		});
	
</script>

<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php echo Config::get('app.url');?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#" class="active">Mobile Payments</a></li>					
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
			
			
			<!-- CONTENT -->
			<div class="col-md-12 pagecontainer2 offset-0">
				<div class="hpadding50c">
					<p class="lato size30 slim">Mobile Payments</p>
			
				
				
				</div>
				<div class="line3"></div>
<div class="container col-md-12">
				
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

<div class="clearfix"></div><br/><br/>
			</div>
				
		
		<!----------Prepaid Form----------!-->
				
<form name="prepaid_form" id="prepaid_form" method="post">
<div class="prepaid">
<div class="container">

	<div class="col-md-12">
		<div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b>Enter Prepaid Mobile Number</b></span>
			<input type="text" name="mobile" id="mobile" class="form-control" onkeypress="return IsNumeric(event);"  autocomplete="off" ondrop="return false;" onpaste="return false;" maxlength="10" onkeyup="showUser(this.value)" /> 
			<label for="mobile" generated="true" class="error"></label>

			</div>
			</div></div>
			<div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Select operator</b></span>
			<select name="operator" id="operator" class="form-control"> 
			<option value=""><?php echo 'select'; ?></option>
			<?php $i=1; foreach($operators as $key=>$value) { 

			?>
			<option value="<?php echo ucwords($value) ; ?>"><?php echo ucwords($key) ; ?></option>

			<?php  } ?>
			</select>
			<label for="operators" style="color:white;" generated="true" class="error"> Operator field is required.                 </label>
			</div>
			</div>
			</div></div>

			<input type="hidden" value="1" name="circle"  id="circle"/>


    <div class="col-md-12">
	     <div class="col-md-6">
		<div class="w50percent">
		<div class="wh90percent textleft">
		<span class="opensans size13"><b> Amount ( INR )</b></span>
		<input name="amount" type="text" value=""   maxlength="10" id="amount"  class="form-control">	
		<label for="amount" generated="true" class="error"></label>				
		</div>
		<input type="hidden" id="flag" name="flag" value="1"/>	

		</div>
		</div>

	<div class="col-md-6">
		<div class="w50percent">
		<div class="wh90percent textleft">
		</div>
		<input type="hidden" id="flag" name="flag" value="1"/>	

		</div>
		</div>
		<div class="col-md-6">
		<div class="w50percent">
		<div class="wh90percent textleft">
		</div>
		<input type="hidden" id="flag" name="flag" value="1"/>	
		</div>
		</div>
		</div>
<br><br><br><br><br>

<br>

<input type="hidden" name="prepaid_biller_id"  id="prepaid_biller_id" >


<div class="searchbg" style="margin-left:1px; margin-top:110px;">
		<button type="submit" value="submit" id="submit" class="btn-search">Recharge</button>
						</div>
<input type="hidden" value="<?php echo ''; ?>" name="pid" />
        <input type="hidden" value="<?php echo 'prepaid'; ?>" name="rtype" />
        <input type="hidden" value="etop" name="ttype" />
          <input type="hidden" value="recharge" name="ctype" />
        <input type="hidden" value=""  name="discount_amount" id="discount_amount"  />
        <input type="hidden" value="oxy_mob" name="sku" />

</form>
</div>
</div>

<!----------Postpaid Form----------!-->
<form name="postpaid_form" id="postpaid_form" method="post">
<div class="post_paid">				
<div class="container">
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Enter Post-Paid Mobile Number</b></span>
			<input type="text" name="po_mobile" id="po_mobile" class="form-control"   autocomplete="off" ondrop="return false;" onpaste="return false;" value=""   onkeypress="return IsNumeric(event);" tabindex="1" maxlength="10" onkeyup="show_network(this.value)" >

			</div>
			</div>
			</div>
                <div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Select operator</b></span>
			<select name="po_operator" id="po_operator" class="form-control"> 


			<option value=""><?php echo 'select'; ?></option>
			<?php $i=1; foreach($poperators as $key=>$value) { 
			?>
			<option value="<?php echo ucwords($value) ; ?>"><?php echo ucwords($key) ; ?></option>
			<?php  } ?>
			</select> 
			<label for="operatorss" style="color:white;" generated="true" class="error"> Operator field is required.                 </label>
			</div>
			</div>
			</div></div>
			
			
	<div class="col-md-12">
	<div id="show_circle"> </div>
	   <div class="col-md-6" id="hide_circle">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Select Circle</b></span>
			<select  class="form-control"> 						 
			<option value=""><?php echo 'select'; ?></option>

			</select>
			</div>
			</div>
			</div>
		
		 <div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<div id="relation">
			<span class="opensans size13"><b> Relationship Number</b></span>
			<span style="font-size:11px; color:red;"></span>
			<input name="relation_no" type="text" value="" maxlength="13" id="relation_no"  class="form-control">
                      </div>
                      <div id="acc_number">
			<span class="opensans size13"><b> Account Number</b></span>
			<span style="font-size:11px; color:red;"></span>
			<input name="account_no" type="text" value="" maxlength="11" id="account_no"  class="form-control"  >
                      </div>

			</div>
			</div>
			</div></div>
			
	<div class="col-md-12">
			
		<div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b>Customer Name</b></span>
			<input name="customer_name" type="text" value="" maxlength="14" id="customer_name"  class="form-control">
			</div>
			</div>
			</div>	
		<div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Amount ( INR )</b></span>
			<input name="po_amount" type="text" value="" maxlength="10" id="po_amount"  class="form-control">
			</div>
			</div>
			</div></div>




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
			<div class="searchbg" style="background: white; margin-top:201px; width:1098px">
			<button type="submit" class="btn-search">Pay</button>
			</div>
			<input type="hidden" value="<?php echo 'id'; ?>" name="pid" />
			<input type="hidden" value="<?php echo 'postpaid'; ?>" name="rtype" />
			<input type="hidden" value="BILL" name="ttype" />

			<input type="hidden" value="0" name="discount_amount" id="discount_amount"  />
			</form>
			</div>
<br>
<br>
<br>

			<div class="clearfix"></div><br/><br/>
			</div>
			<!-- END CONTENT -->			
			

			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
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

