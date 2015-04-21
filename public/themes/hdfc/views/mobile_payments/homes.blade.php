<style> .error{ color:red; } </style>


<script type="text/javascript" >
$(document).ready(function() {
/*jQuery.validator.addMethod("min_val", function(value, element, params) {
 return this.optional(element) || value >= 10;
}, jQuery.validator.format("Please enter the amount minimum 10."));*/
	$("#insurance_form").validate({
		rules: {
			
			 payment_name: {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				
				},
			consumer_no : {
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
			gas_name: { 
			required: "Gas Service name field is required."
			},
			acc_no: { 
			required: "Account Number field is required."
			},
			amount: { 
			required: "Amount field is required."
			},
			consumer_no: { 
			required: "Consumer number field is required."
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
					<li><a href="#" class="active">Payments</a></li>					
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
					<p class="lato size30 slim"> Payments</p>
				</div>
				<div class="line3"></div>
<div class="container col-md-12">
				
		

<div class="clearfix"></div><br/><br/>
			</div>
				
				
<form name="insurance_form" id="insurance_form" method="post">
<div class="prepaid">
<div class="container">

<!--here we removed subscription payments if its needs please add the array 6th index 
,'6'=>'Subscription'
!-->

<?php $payment = array('1'=>'DTH Payments','2'=>'Insuarance Payments','3'=>'Electricity Payments','4'=>'GAS Payments',
     '5'=>'Charity Payments','7'=>'Creditcard Payments');?>


			<div class="col-md-12">
			<div class="col-md-6">
			<div class="w50percent">
			<div class="wh90percent textleft">
	<span class="opensans size13"><b>Select Payment Type</b></span>
	<select name="payment_name" id="payment_name" class="form-control"> 
			<option value=""><?php echo 'select'; ?></option>
			<?php $i=1; foreach($payment as  $key=>$pay ) { 

			?>
			<option value="<?php echo $key; ?>"><?php echo $pay; ?></option>

			<?php  } ?>
			</select>

			</div>
			</div></div>
			</div>

</div>
<br><br><br>

<br>

<!--<div class="searchbg" style="background: white;margin-left: 1px;margin-top: 22px; width:100px!important;">
								<button type="submit" value="submit" id="submit" class="btn-search">Submit</button>
						</div>!-->


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
     $("#payment_name").on('change', function(){
     var id = $(this).val();
     switch(id) {
    case "1":
      window.location.replace('dth_payments');
        break;
    case "2":
  window.location.replace('insurance_payment');
        break;
         case "3":
  window.location.replace('electricity_payment');
        break;
         case "4":
 window.location.replace('gas_payment');
        break;
         case "5":
 window.location.replace('charity_payment');
        break;
         case "6":
  window.location.replace('subscription');
        break;
        case "7":
 window.location.replace('creditcard_payment');
        break;
    default:
        window.location.replace('billpayment');
}
     });





  
 </script>	


 
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>

