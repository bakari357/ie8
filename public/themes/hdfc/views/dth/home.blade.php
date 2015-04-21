

</script>
<script type="text/javascript" >
$(document).ready(function() {

 $('#amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9.]/g, '');
	}); 
	
	
jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 100;
}, jQuery.validator.format("Please enter minimum amount of 100 Rupees."));
	$("#prepaid_form").validate({
		
		rules: {
			
			dth_name: {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				},
				
				
				subscriber_id: {
			     required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			       number:true,
				maxlength:10
			
				},
				amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			min_val:100
				
				},
			
			subscriber_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },			
			}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
			},
			dth_name:{
			required: "Dth name field is required."
			},
			
			subscriber_name:{
			required: "Subscriber name field is required."
			},
			subscriber_id:{
			required: " Subscriber id field is required."
			
			},
			amount:{
			required: " Amount field is required."
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
			<a class="homebtn left" href="<?php echo Config::get('app.url');?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#" class="active">DTH Payments</a></li>					
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
					<p class="lato size30 slim">DTH Payments</p>
				</div>
				<div class="line3"></div>
<div class="container col-md-12">
		
			</div>
	<br>			
				
<form name="prepaid_form" id="prepaid_form" method="post">
   <div class="prepaid">
   <div class="container">
   <div class="col-md-12">


       <div class="col-md-6">
	<div class="w50percent">
		<div class="wh90percent textleft">
			<span class="opensans size13"><b> Select DTH</b></span>
		        <select name="dth_name" id="dth_name" class="form-control"> 
		        <option value=""><?php echo 'select'; ?></option>
		     <?php foreach($dth as $dths) { ?>
		     <option value="<?php echo ucwords($dths->id) ; ?>"><?php echo ucwords($dths->biller_name) ; ?></option>
		    <?php  } ?>
		    </select>
		  	</div>
			</div></div></div>
<div id="scheme"> </div>


     
          <div class="col-md-6" >
		<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b>Subscriber Name </b></span> 
		    <input name="subscriber_name"   type="text" value=""    id="subscriber_name"  class="form-control">
	
		</div>
	</div></div>
<br><br><br>
<div class="col-md-12">
         <div class="col-md-6">
		<div class="w50percent">
			<div class="wh90percent textleft">
				<span class="opensans size13"><b> Subscriber ID</b></span>
				<input name="subscriber_id"   type="text" value=""   maxlength="10" id="subscriber_id"  class="form-control"><div id="card_error"> </div>
									</div>
								</div>
								
								
</div>
 
    <div class="col-md-6">
		<div class="w50percent">
			<div class="wh90percent textleft">
				<span class="opensans size13"><b> Amount ( INR )</b></span>
				<input name="amount"   type="text" value=""   maxlength="10" id="amount"  class="form-control">
									</div>
								</div>
</div>

</div>

<div class="searchbg" >
		<button type="submit" value="submit" id="submit" class="btn-search">Pay</button>
						</div>
</div>
</div>
						
           <input type="hidden" name="biller_id" id="biller_id" /> 
</form>

<br>


			<div class="clearfix"></div><br/><br/>
			</div>
			<!-- END CONTENT -->			
			

			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
<script type="text/javascript">
      $(document).ready(function(){ 
	/* $('#amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	}); */
	 $('#subscriber_id').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	});
	
    }); 


$("#dth_name").on('change',function(){

var dth_id =  $(this).val();

 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_dthid')?>",
                      data: {
               "dth_id":dth_id
              },             
                        success: function(data) {
                         var obj=jQuery.parseJSON(data);
	                 $("#biller_id").val(obj);
	                 
                         
                      }
                  });
});
  
 </script>
 

<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

