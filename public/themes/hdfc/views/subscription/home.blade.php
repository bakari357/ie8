

</script>
<script type="text/javascript" >
$(document).ready(function() {
$.validator.addMethod("pan", function(value, element)
    {
        return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
    }, "Invalid Pan Number");
$("#postpaid_form").validate({
		
		rules: {
			
			subscribe_id : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				},
				amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				},
				customer_name:{
				required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				},
			
			scheme : {
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
				}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
			},
			customer_name:{
			required: "Subscriber Name field is required."
			},
			address1:{
			required: "Address Line1 field is required.",
			minlength: "Please enter at least 3 characters.",
			maxlength: "Please enter maximum 120 characters.",
			},
			subscribe_id: { 
			required: "Subscription id field is required."
			},
			amount:{
			required:"Amount field is required."
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
					<li><a href="#" class="active">Subscription</a></li>					
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
					<p class="lato size30 slim">Subscription Payments</p>
				</div>
				<div class="line3"></div>
<div class="container col-md-12">
                        
                           <div class="col-md-4">
                         </div>    
              
                   <div class="hide" style="display:none">  
      
                   </div>
              

<div class="clearfix"></div><br/><br/>
			</div>
				
				

<form name="postpaid_form" id="postpaid_form" method="post">
<div class="post_paid">				
<div class="container">
<div class="col-md-12">
			<div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b> Select Subscription</b></span>
			<select name="subscribe_id" id="subscribe_id" class="form-control"> 
			<option value=""><?php echo 'select'; ?></option>
			<?php foreach($subscription as $subscriptions) { ?>
			<option value="<?php echo ucwords($subscriptions->id) ; ?>"><?php echo ucwords($subscriptions->biller_name) ; ?></option>
			<?php  } ?>
			</select>
			</div>
			</div>
			</div>
			<div id="scheme"> </div>
<div class="col-md-6" id="hide_scheme">
								<div class="w50percent">
									<div class="wh90percent textleft">
									<span class="opensans size13"><b> Subscription Scheme  </b></span> 
		       <select  class="form-control"> 
		       <option value=""><?php echo 'select'; ?></option>
		       </select>
									</div>
								</div>
</div></div>
<div class="col-md-12">
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
									<span class="opensans size13"><b> Amount ( INR )</b></span>
				<input name="amount"   type="text" value=""   maxlength="10" id="amount"  class="form-control">
									</div>
								</div>
</div>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
						<span class="opensans size13"><b> Subscriber Name</b></span>
<input name="customer_name"   type="text" value=""   id="customer_name"  class="form-control">
									</div>
								</div>
</div></div>
<div class="col-md-12">
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
								<span class="opensans size13"><b> Address Line1</b></span>
		          <textarea name="address1"rows="2" id="address1" maxlength="120" class="form-control margtop10"></textarea>
									</div>
								</div>
</div>
<div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
					<span class="opensans size13"><b> Address Line2</b></span>
		            <textarea name="address2"rows="2" id="address2" maxlength="120" class="form-control margtop10"></textarea>	
									</div>
								</div>
</div></div>




               <div class="col-md-12">
                   <div class="col-md-6">
								<div class="w50percent">
									<div class="wh90percent textleft">
				<span class="opensans size13"></b></span>
			
			<input type="hidden" name="subscription_billerid" id="subscription_billerid">
			<input type="hidden" name="subscription_name" id="subscription_name">
									</div>
								</div>
								
</div>

</div></div>

<div class="searchbg" style="margin-top:143px;">
								<button type="submit" class="btn-search">Subscribe</button>
						</div>
                                    
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
	 $('#amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	}); 
    }); 


$("#subscribe_id").on('change',function(){
var subscribe_id =  $(this).val();
$("#hide_scheme").hide();
 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_subscription')?>",
                      data: {
               "subscribe_id":subscribe_id
              },             
                        success: function(data) {
                       
                          $("#scheme").html(data);
                      }
                  });
});
  
  $("#subscribe_id").on('change',function(){
  var biller_id =  $(this).val();
    $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_subscriptionbiller')?>",
                      data: {
               "biller_id":biller_id
              },             
                        success: function(data) {
                        
                          var obj=jQuery.parseJSON(data);
                         
                          $("#subscription_billerid").val(obj.ubp_biller_id);
                          $("#subscription_name").val(obj.biller_name);
                      }
                  });
  }); 
  
 </script>
 

<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>


