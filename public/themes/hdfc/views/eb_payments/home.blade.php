


<script type="text/javascript" >
$(document).ready(function() {
/*jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));*/
	$("#insurance_form").validate({
		rules: {
			
			eb_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				
				},
			service_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			minlength:5,
			maxlength:11,	
				},
				
				
				
			amount:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			},
			
			acc_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			}
			
						
		},
		messages: {
			eb_name: { 
			required: "Electricity name field is required."
			},
			acc_no: { 
			required: "Account Number field is required."
			},
			amount: { 
			required: "Amount field is required."
			},
			service_no: { 
			required: "Consumer Number field is required.",
			minlength: "Please Enter valid  5 or 11 chracters."
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
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#" class="active">Electricity  Payments</a></li>					
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
					<p class="lato size30 slim">Electricity Payments</p>
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
										<span class="opensans size13"><b>Select Electcricity Name</b></span><select name="eb_name" id="eb_name" class="form-control"> 
		 <option value=""><?php echo 'select'; ?></option>
		<?php $i=1; foreach($electricity as  $electricitys ) { 
	
		  ?>
		<option value="<?php echo $electricitys->ubp_biller_id; ?>"><?php echo $electricitys->biller_name; ?></option>
 
		<?php  } ?>
		</select>
										
									</div>
								</div></div>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Consumer Number</b></span>
										
		 
			<input name="service_no" type="text"   id="service_no" maxlength="11" class="form-control">
									</div>
								</div>
</div></div><br><br>
<div class="col-md-12"><br>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Account Number</b></span>
									
			<input name="acc_no" type="text"   id="acc_no"  class="form-control">
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




</div>

</div>
<br><br><br>

<br>

<input type="hidden" id="biller_id" name="biller_id">
<inuput type="hidden" name="payment" id="payment" value="electricity">


<div class="searchbg" style="margin-top:37px;">
				<button type="submit" value="submit" id="submit" class="btn-search">Pay</button>
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
	this.value = this.value.replace(/[^0-9]/g, '');
	}); 
	
    }); 


$("#eb_name").on('change', function(){
$("#biller_id").val($(this).val());
});


  
 </script>	


 
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

