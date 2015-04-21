


<script type="text/javascript" >
$(document).ready(function() {
/*jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));*/
	$("#insurance_form").validate({
		rules: {
			
			gas_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				
				},
			customer_id : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
			amount:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			},
			
			meter_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			}
			
						
		},
		messages: {
			gas_name: { 
			required: "Gas Service name field is required."
			},
			meter_no: { 
			required: "Meter Number field is required."
			},
			amount: { 
			required: "Amount field is required."
			},
			customer_id: { 
			required: "Customer ID field is required."
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
					<li><a href="#" class="active">GAS Payments</a></li>					
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
					<p class="lato size30 slim">GAS Payments</p>
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
										<span class="opensans size13"><b>Select Gas Service Name</b></span><select name="gas_name" id="gas_name" class="form-control"> 
		 <option value=""><?php echo 'select'; ?></option>
		<?php $i=1; foreach($gas as  $gass ) { 
	
		  ?>
		<option value="<?php echo $gass->ubp_biller_id; ?>"><?php echo $gass->biller_name; ?></option>
 
		<?php  } ?>
		</select>
										
									</div>
								</div></div>
								
								<input type="hidden" name="biller_id" id="biller_id">
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Customer ID</b></span>
										
		 
			<input name="customer_id" type="text"   id="customer_id" maxlength="10"  class="form-control">
									</div>
								</div>
</div></div><br><br>
<div class="col-md-12"><br>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Meter Number</b></span>
									
			<input name="meter_no" type="text"   id="meter_no" maxlength="18" class="form-control">
									</div>
								</div>
</div>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>  Amount ( INR )</b></span>
										<input name="amount" type="text"  id="amount"  class="form-control"></a>
									</div>
	
	
							</div>
</div>

<div class="searchbg" style="position:initial !important;">
<button type="submit" value="submit" id="submit" class="btn-search">Pay</button>
</div>
<br><br><br><br><br>
</div>
</div>
</form>
</div>
</div>



			<div class="clearfix"></div><br/><br/>
			</div>
			<!-- END CONTENT -->			
			

			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
<script type="text/javascript">
      $(document).ready(function(){ 
	 $('#amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9.]/g, '');
	}); 
	$('#customer_id').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	}); 
	
    }); 


 $("#gas_name").on('change', function(){
 $("#biller_id").val($(this).val());
 });


  
 </script>	


 
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

