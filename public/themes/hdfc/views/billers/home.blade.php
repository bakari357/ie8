<style> .error{ color:red; } </style>

</script>
<script type="text/javascript" >
$(document).ready(function() {
/*jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));*/
	$("#prepaid_form").validate({
		
		rules: {
			
			contribution_scheme : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				},
				amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			//min_val:10,
			number:true
				
				},
			
			biller_id : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },			
			}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
			},
			amount: { 
			required: "Amount field is required."
			}
		},
        submitHandler: function(frm) {
        submit();
        }
		
		
		});
		});
	
</script>
	

<
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
					<p class="lato size30 slim">Payees</p>
				</div>
				<div class="line3"></div>
<div class="container col-md-12">
		
			</div>
				
				
<form name="prepaid_form" id="prepaid_form" method="post">
   <div class="prepaid">
   <div class="container">
   <div class="col-md-12">


       <div class="col-md-6">
	<div class="w50percent">
		<div class="wh90percent textleft">
			<span class="opensans size13"><b> Select Paying for</b></span>
		        <select name="biller_id" id="biller_id" class="form-control"> 
		        <option value=""><?php echo 'select'; ?></option>
		     <?php foreach($billers as $biller) { ?>
		     <option value="<?php echo ucwords($biller->id) ; ?>"><?php echo ucwords($biller->biller_name) ; ?></option>
		    <?php  } ?>
		    </select>
		  	</div>
			</div></div></div>
<div id="scheme"> </div>


      <div class="col-md-12">
          <div class="col-md-6" id="hide_scheme">
		<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Contribution Scheme </b></span> 
		       <select  class="form-control"> 
		       <option value=""><?php echo 'select'; ?></option>
		       </select>
	
		</div>
	</div></div>
         <div class="col-md-6">
		<div class="w50percent">
			<div class="wh90percent textleft">
				<span class="opensans size13"><b> Amount ( INR )</b></span>
				<input name="amount"   type="text" value=""   maxlength="10" id="amount"  class="form-control"></a>
									</div>
								</div>
</div></div>
<div class="searchbg" style="background: white;margin-left: -15px; margin-top:12px;">
								<button type="submit" value="submit" id="submit" class="btn-search">Search</button>
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
  
 </script>
 

<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

