
</script>
<script type="text/javascript" >
$(document).ready(function() {

 $('#amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9.]/g, '');
	}); 
	
	
/*jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));*/
	$("#prepaid_form").validate({
		
		rules: {
			
			creditcard_name: {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				},
				
				
				creditcard_number: {
			     required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				minlength:14,
				maxlength:16
			
				},
				amount : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			
				
				},
			
			cardholder_name : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },			
			}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
			},
			cardholder_name:{
			required: "Cardholder name field is required."
			},
			
			creditcard_name:{
			required: " Creditcard field is required."
			},
			creditcard_number:{
			required: " Creditcard number field is required.",
			minlength :"please enter valid credit card number."
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
					<li><a href="#" class="active">Creditcard Payments</a></li>					
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
					<p class="lato size30 slim">Creditcard Payments</p>
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
			<span class="opensans size13"><b> Select Creditcard</b></span>
		        <select name="creditcard_name" id="creditcard_name" class="form-control"> 
		        <option value=""><?php echo 'select'; ?></option>
		     <?php foreach($creditcard as $creditcards) { ?>
		     <option value="<?php echo ucwords($creditcards->id) ; ?>"><?php echo ucwords($creditcards->biller_name) ; ?></option>
		    <?php  } ?>
		    </select>
		  	</div>
			</div></div>
<div id="scheme"> </div>


      
          <div class="col-md-6" >
		<div class="w50percent">
			<div class="wh90percent textleft">
			<span class="opensans size13"><b>Cardholder Name </b></span> 
		    <input name="cardholder_name"   type="text" value=""    id="cardholder_name"  class="form-control">
	
		</div>
	</div></div></div><br><br>
<div class="col-md-12"><br>
         <div class="col-md-6">
		<div class="w50percent">
			<div class="wh90percent textleft">
				<span class="opensans size13"><b>Credit Card Number</b></span>
				<input name="creditcard_number"   type="text"    maxlength="16" id="creditcard_number"  class="form-control"><div id="card_error"> </div>
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
<input name="biller_id"   type="hidden" value=""  id="biller_id" >
<div class="searchbg" style="position:initial !important;">
	<button type="submit" value="submit" id="submit" class="btn-search">Pay</button>
						</div>
</div>
</div>
						

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
	 $('#amount').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	}); 
	 $('#creditcard_number').keypress(function () { 
	this.value = this.value.replace(/[^0-9]/g, '');
	});
	
	
	
    }); 

//creditcard_number
$("#creditcard_number").change(function(){

if($("#creditcard_number").val() ==''){
 $("#card_error").hide();
}


var creditcard_id ='';
var creditcard_number ='';
var creditcard_id =  $("#creditcard_name").val();

var creditcard_number = $(this).val();

 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_creditcardprefix')?>",
                      data: {
               "creditcard_id":creditcard_id,"creditcard_number":creditcard_number
              },             
                        success: function(data) {
                      
                        if(data=="0"){ 
                  
                         $("#card_error").html("<font color='red' font-size:13px; style='margin-top: -1px;margin-left: -2px;position: absolute;'> creditcard number start with invalid number</font>");
                         return false;
                        }
                         else if(data==1){ 
                         $("#card_error").html('');
                        }
                       else if(data =="nothing"){
                        $("#card_error").html('');
                       }
                       
                      }
                  });
});
  //$("#creditcard_number").trigger("change");



$("#creditcard_name").change(function(){

var c_num = $("#creditcard_number").val('');

var id = $(this).val();
 $.ajax({
                     type: "POST",
                      url: "<?=URL::to('load_creditcardbiller')?>",
                      data: {
               "id":id
              },             
                        success: function(data) {
                         var biller_id = jQuery.parseJSON(data);
                         $("#biller_id").val(biller_id);
                         }
               
               });
});

 </script>
 

<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

