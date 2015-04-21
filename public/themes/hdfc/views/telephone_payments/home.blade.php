<style> .error{ color:red; } </style>


<script type="text/javascript" >
$(document).ready(function() {
/*jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));*/
	$("#insurance_form").validate({
		rules: {
			
			telephone_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				
				},
			telephone_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
			customer_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
			amount:{
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			},
			
			acc_no : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			}
			
						
		},
		messages: {
			telephone_name: { 
			required: "Telephone name field is required."
			},
			acc_no: { 
			required: "Account Number field is required."
			},
			amount: { 
			required: "Amount field is required."
			},
			customer_name :{
			required: "Customer Name field is required."
			},
			telephone_no: { 
			required: "Telephone number field is required."
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
					<p class="lato size30 slim">Telephone Payments</p>
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
										<span class="opensans size13"><b>Select Telephone Biller Name</b></span><select name="telephone_name" id="telephone_name" class="form-control"> 
		 <option value=""><?php echo 'select'; ?></option>
		<?php $i=1; foreach($telephone as  $telephones ) { 
	
		  ?>
		<option value="<?php echo $telephones->biller_name; ?>"><?php echo $telephones->biller_name; ?></option>
 
		<?php  } ?>
		</select>
										
									</div>
								</div></div>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Telephone Number</b></span>
										
		 
			<input name="telephone_no" type="text"   id="telephone_no"  class="form-control">
									</div>
								</div>
</div></div>
<div class="col-md-12">
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b> Customer Name</b></span>
									
			<input name="customer_name" type="text"   id="customer_name"  class="form-control">
									</div>
								</div>
</div> 
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>  Account Number </b></span>
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

<div class="searchbg" style="background: white;margin-left: 1px;margin-top: 76px;">
								<button type="submit" value="submit" id="submit" class="btn-search">Search</button>
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





  
 </script>	


 
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

