


<script type="text/javascript" >
$(document).ready(function() {
/*jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));*/
	$("#insurance_form").validate({
		rules: {
			
			insurance_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				
				},
				customer_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email:true
			
				
				},
			policy_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				
				client_id : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			minlength:6,
			maxlength:10	
				},
			premium_amount:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			},
			
			amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
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
			required: "Insurance name field is required."
			},
			customer_name: { 
			required: "Client name field is required."
			},
			policy_no: { 
			required: "Policy Number field is required."
			},
			premium_amount: { 
			required: "Premium amount field is required."
			},
			amount: { 
			required: "Installment amount field is required."
			},
			client_id: { 
			required: "Client Id field is required.",
			minlength :"Please enter valid client id."
			},
			email: { 
			required: "Email field is required."
			},
			contact_no: { 
			required: "Mobile number field is required.",
			minlength: "Please enter a valid Mobile number."
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
					<li><a href="#" class="active">Insurance Payments</a></li>					
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
					<p class="lato size30 slim">Insurance Payments</p>
				</div>
				<div class="line3"></div>
<div class="container col-md-12">
				
		

<div class="clearfix"></div><br/><br/>
			</div>
				
				
<form name="insurance_form" id="insurance_form" method="post">
<div class="prepaid">
<div class="container">





                              <div class="col-md-12">
				<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Select Insurance Name</b></span><select name="insurance_name" id="insurance_name" class="form-control"> 
		 <option value=""><?php echo 'select'; ?></option>
		<?php $i=1; foreach($insurance as  $insurances ) { 
	
		  ?>
		<option value="<?php echo $insurances->ubp_biller_id; ?>"><?php echo $insurances->biller_name; ?></option>
 
		<?php  } ?>
		</select>
										
									</div>
								</div></div>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Policy Number</b></span>
										
		 
			<input name="policy_no" type="text"   id="policy_no" maxlength="12" class="form-control">
									</div>
								</div>
</div></div><br><br>
<div class="col-md-12"><br>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Client Id </b></span>
									
			<input name="client_id" type="text"   id="client_id"  class="form-control">
									</div>
								</div>
</div>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Premium Amount ( INR )</b></span>
										<input name="premium_amount" type="text"  id="premium_amount"  class="form-control"></a>
									</div>
	
							</div>
</div>
</div><br><br>
<div class="col-md-12"><br>

<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										
		    	<span class="opensans size13"><b>Installment Amount (INR)</b></span>
			<input name="amount" type="text" id="amount"  class="form-control"> </a>
									</div>
		
	
							</div>
</div>

<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Client Name</b></span>
										<input name="customer_name" type="text"  id="customer_name"  class="form-control"> </a>
									</div>
	
	
							</div>
</div>
</div><br><br>
<div class="col-md-12"><br>
		<!--<div class="col-md-6">
		<div class="w50percent">
		<div class="wh90percent textleft">

		<span class="opensans size13"><b>Email</b></span>
		<input name="email" type="text" id="email"  class="form-control"> </a>
		</div>


		</div>
</div>!-->
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Mobile Number</b></span>
										<input name="contact_no" type="text"  id="contact_no"  class="form-control"> </a>
									</div>
		
	
							</div>
</div>
</div>


<br>
<input name="biller_id" type="hidden" id="biller_id" class="form-control"> 

<div class="col-md-6">

<div class="searchbg"  style="position:initial !important;">
								<button type="submit" value="submit" id="submit" class="btn-search">Pay</button>
						</div></div>


</form>
</div>
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
	 $('#premium_amount').keypress(function () { 
	this.value = this.value.replace(/.[^0-9]/g, '');
	}); 
	$('#premium_amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	}); 
	 $('#policy_no').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	}); 
    }); 



$("#insurance_name").on('change',function(){

var insurance_name =  $(this).val();
	$("#biller_id").val(insurance_name); 
               
});

  
 </script>	


 
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

