
</script>
<script type="text/javascript" >
$(document).ready(function() {
$.validator.addMethod("pan", function(value, element)
    {
        return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
    }, "Invalid Pan Number");
	$("#prepaid_form").validate({
		
		rules: {
			donor_name: {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			minlength: 3,
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
			//min_val:10,
			number:true
				
				},
			
			biller_id : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },			
			},
			address1 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				minlength: 3,
				maxlength: 120
				},
				address2 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				
				minlength: 3,
				maxlength: 120
				},
						
		},
		messages: {
		
		biller_id : {
			required: "Charity Name field is required.",			
			},
			email: { 
			required: "Email field is required.",
			email: "Please Enter a Valid Email-Address."
			},
			contribution_scheme : {
			required: "Contribution Scheme field is required."
			},

			dummy_contribution_scheme:{
			required: "Contribution Scheme field is required."
			},
			amount: { 
			required: "Amount field is required."
			},
			pan: { 
			required: "PAN Number field is required."
			},
			donor_name:{
			required: "Donor Name field is required.",
			minlength: "Please Enter at least 3 characters.",
			},
			address1:{
			required: "Address Line1 field is required.",
			minlength: "Please enter at least 3 characters.",
			maxlength: "Please enter maximum 120 characters.",
			},
			mobile: { 
			required: "Mobile field is required.",
			minlength: "Please enter a valid mobile number."
			},
			address2:{
			required: "Address Line2 field is required.",
			minlength: "Please enter at least 3 characters.",
			maxlength: "Please enter maximum 120 characters.",
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
					<li><a href="#" class="active">Charity Payments</a></li>					
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
					<p class="lato size30 slim">Charity Payment</p>
				</div>
				<div class="line3"></div><br><br>
<div class="container col-md-12">
		
			</div>
				
				
<form name="prepaid_form" id="prepaid_form" method="post">
   <div class="prepaid">
   <div class="container">
   <div class="col-md-12">


       <div class="col-md-6">
	<div class="w50percent">
		<div class="wh90percent textleft">
			<span class="opensans size13"><b> Select Charity Name</b></span>
		        <select name="biller_id" id="biller_id" class="form-control"> 
		        <option value=""><?php echo 'select'; ?></option>
		     <?php foreach($billers as $biller) { ?>
		     <option value="<?php echo ucwords($biller->id) ; ?>"><?php echo ucwords($biller->biller_name) ; ?></option>
		    <?php  } ?>
		    </select>
		  	</div>
			</div></div>
<div id="scheme"> </div>


      
          <div class="col-md-6" id="hide_scheme">
		<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Contribution Scheme </b></span> 
		       
		       <select name="dummy_contribution_scheme" id="dummy_contribution_scheme" class="form-control" id="scheme_hide">
		       <option value=""><?php echo 'select'; ?></option>
		       </select>
	
		</div>
	</div></div></div><br><br>
<div class="col-md-12"><br>
         <div class="col-md-6">
		<div class="w50percent">
			<div class="wh90percent textleft">
				<span class="opensans size13"><b> Donor Name</b></span>
				<input name="donor_name"   type="text" value=""   id="donor_name"  class="form-control"></a>
									</div>
								</div>
</div>
          <div class="col-md-6" >
		<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Amount ( INR )</b></span>
				<input name="amount"   type="text" value=""   maxlength="10" id="amount"  class="form-control">
		     
	
		</div>
	</div></div></div><br><br>
 <div class="col-md-12"><br>
         <div class="col-md-6">
		<div class="w50percent">
			<div class="wh90percent textleft">
				
				<span class="opensans size13"><b>Mobile Number</b></span>
				<input name="mobile"   type="text" value=""   maxlength="10" id="mobile"  class="form-control">
									</div>
								</div>
</div>

<!--<div class="col-md-12">

       <div class="col-md-6">
	<div class="w50percent">
		<div class="wh90percent textleft">
			<span class="opensans size13"><b> Email</b></span>
		      <input name="email"   type="text" value=""  id="email"  class="form-control">
		  	</div>
			</div></div></div>!-->
			
			


       <div class="col-md-6">
	<div class="w50percent">
		<div class="wh90percent textleft">
			<span class="opensans size13"><b> PAN Number</b></span>
		      <input name="pan"   type="text" value="" maxlength="10" id="pan"  class="form-control">
		  	</div>
			</div></div></div><br><br>
<div class="col-md-12"><br>
       <div class="col-md-6">
	<div class="w50percent">
		<div class="wh90percent textleft">
			<span class="opensans size13"><b> Address Line1</b></span>
		          <textarea name="address1"rows="2" id="address1" maxlength="120" class="form-control margtop10"></textarea>	
		  	</div>
			</div></div>
       <div class="col-md-6">
	<div class="w50percent">
		<div class="wh90percent textleft">
			<span class="opensans size13"><b> Address Line2</b></span>
		            <textarea name="address2"rows="2" id="address2" maxlength="120" class="form-control margtop10"></textarea>	
		  	</div>
			</div></div></div>
			
			<input type="hidden" id="chartity_billerid" name="chartity_billerid">
<div class="searchbg" style="position:initial !important;">
	<button type="submit" value="submit" id="submit" class="btn-search">Donate</button>
						</div>
</div>
</div>
						

</form>

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
	 $('#amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	}); 
    }); 


$("#biller_id").on('change',function(){
var biller_id =  $(this).val();
$("#hide_scheme").hide();


 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_biller')?>",
                      data: {
               "biller_id":biller_id
              },             
                        success: function(data) {
                          $("#scheme").html(data);
                      }
                  });
});
  
  
  $("#biller_id").on('change',function(){
  var biller_id =  $(this).val();
    $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_chartitybiller')?>",
                      data: {
               "biller_id":biller_id
              },             
                        success: function(data) {
                          var obj=jQuery.parseJSON(data);
                          $("#chartity_billerid").val(obj);
                      }
                  });
  });
 </script>
 

<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

