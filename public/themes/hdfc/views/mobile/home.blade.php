<style> .error{ color:red; } </style>
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
				number:true
				
				},
			circle : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				
				amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				number:true,
				min_val:10
				},
			
			
			operator : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			
			}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
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
<script type="text/javascript" >
$(document).ready(function() {

           jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));
 
	$("#postpaid_form").validate({
		rules: {
			
			po_mobile : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			number:true	
				},
				po_amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			min_val:10,
			number:true
				
				},
			
			po_operator : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },			
			}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
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
<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#" class="active">About us</a></li>					
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
					<p class="lato size30 slim">Recharge</p>
				</div>
				<div class="line3"></div>
<div class="container col-md-12">
				
				 <input type="hidden" +value="<?php echo 'id'; ?>" name="pid" /> 
                    	<?php $rtype ='mobile'; if($rtype !='dth') { ?>
                        
                           <div class="col-md-4">
                               <input type="radio" name="rtype" id="pre_mobile" value="mobile" <?php if($rtype=='mobile') echo 'checked'; ?> /><span>Pre-Paid</span></div>
                            <div class="col-md-4"><input type="radio" name="rtype" id="postp" value="postp" <?php if($rtype=='postp') echo 'checked'; ?> /><span>Post-Paid</span></div>    
                   <?php } else { ?>  
                   <div class="hide" style="display:none">  
          <input class="int-radio" type="radio" name="rtype" id="dth" value="dth" <?php if($rtype=='dth') echo 'checked'; else echo 'checked'; ?> />
                        <span class="spn-lable"><?php echo 'dth'; ?></span> </div>
               <?php }?>
               
          
                <input type="hidden" name="etop" value="etop">

<div class="clearfix"></div><br/><br/>
			</div>
				
				
<form name="prepaid_form" id="prepaid_form" method="post">
<div class="prepaid">
<div class="container">
<div class="col-md-12">


           
				<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Enter Prepaid Mobile Number</b></span>
										<input type="text" name="mobile" id="mobile" class="form-control" onkeypress="return IsNumeric(event);"  autocomplete="off" ondrop="return false;" onpaste="return false;" maxlength="10" onkeyup="showUser(this.value)" > 
										 <label for="mobile" generated="true" class="error" style="display:none;width:300px; !important;float:left;"></label>
										
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
									</div>
								</div>
</div></div>
<div class="col-md-12">
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Select circle</b></span>
										<select  name="circle"  id="circle" class="form-control">
		<option value=""><?php echo 'select'; ?></option>
		<?php $i=1; foreach($circle as $key=>$circ) { ?>
		<option value="<?php echo ucwords($circ->abbr) ; ?>"><?php echo ucwords($circ->circle) ; ?></option>
    
		<?php }   ?>
		</select>
									</div>
								</div>
</div>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Amount ( INR )</b></span>
										<input name="amount" type="text" value=""   maxlength="10" id="amount"  class="form-control"></a>
									</div>
	<input type="hidden" id="flag" name="flag" value="1"/>							</div>
</div></div>
<div class="searchbg" style="background: white;margin-left: -15px; margin-top:12px;">
								<button type="submit" value="submit" id="submit" class="btn-search">Search</button>
						</div>
<input type="hidden" value="<?php echo ''; ?>" name="pid" />
        <input type="hidden" value="<?php echo 'prepaid'; ?>" name="rtype" />
        <input type="hidden" value="etop" name="ttype" />
        <input type="hidden" value=""  name="discount_amount" id="discount_amount"  />
        <input type="hidden" value="oxy_mob" name="sku" />

</form>
</div>
</div>
<form name="postpaid_form" id="postpaid_form" method="post">
<div class="post_paid">				
<div class="container">
<div class="col-md-12">
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Enter Post-Paid Mobile Number</b></span>
										<input type="text" name="po_mobile" id="po_mobile" class="form-control"  onkeypress="return IsNumeric(event);"  autocomplete="off" ondrop="return false;" onpaste="return false;" value="" tabindex="1" maxlength="10" onkeyup="showUser(this.value)" >
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
									</div>
								</div>
</div></div>
<div class="col-md-12">

<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Amount ( INR )</b></span>
										<input name="po_amount" type="text" value="" maxlength="10" id="po_amount"  class="form-control">
									</div>
								</div>
</div>
<input type="hidden" id="po_circle" name="po_circle" value="1"/>
<input type="hidden" id="flag" name="flag" value="2"/>	
</div></div>
<div class="searchbg" style="background: white;">
								<button type="submit" class="btn-search">Search</button>
						</div>
                                    <input type="hidden" value="<?php echo 'id'; ?>" name="pid" />
  <input type="hidden" value="<?php echo $rtype; ?>" name="rtype" />
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
        //var operator='INDI';
        //var circle=obj.cir;
        //alert(obj.circlevalue); 
	 $("#po_operator").val(obj.operator); 
        $("#operator").val(obj.operator); 
        $("#circle").val(obj.circle);  
         
 }); 
        }
  }
  
 </script>
 <script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
        var keyCode = e.which ? e.which : e.keyCode
        var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
        document.getElementById("error").style.display = ret ? "none" : "inline";
        return ret;
        }
    
</script>


<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

