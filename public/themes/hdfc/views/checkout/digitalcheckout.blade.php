


	<?php $amount_cash=0; $total_cash=0;  $get_customer_points=Customermodel::get_customer(); 
	      $customer_points=$get_customer_points[0]->points; ?>

		<?php
		$subtotal = 0;
		$deal_cash=0;
		$deal_points=0;
		$point_flag=0;
		$count=1;
		$items=Cart::content();
		
		foreach(Cart::content() as $cartkey=>$product): ?>
               
		<?php
		
		if($cartkey<>'') { 
		if(isset($product['options']['apiproduct']) && !empty($product['options']['apiproduct']))
		$quantitynew=$product['options']['quantity'];
		else{
		if(!(bool)$product['options']['fixed_quantity'])
		$quantitynew=$product['options']['quantity'];
		else
		$quantitynew=1;
		}
		
		//$points=point_to_case($product['options']['points']*$quantitynew);
	//$total_cash+=$cash;
	
	
	$total_points=$product['options']['points'];
	//$total_cash=$product['options']['custom_cash'];
	?>
	<?php $deal_points=$deal_points+$total_points; ?>
	<?php $count++; } endforeach; 
	
	
	Cart::dealTotal($total_cash);  
		//echo 'asd'.$total_cash.'dddd';exit;
			
        ?>

<script type="text/javascript">

$(document).ready(function() { 
<?php if(isset($customer['ship_address'])):?>
	$.post('<?php echo url::to('Checkout/customer_details');?>', function(data){
		//populate the form with their information
		$('#customer_info_fields').html(data);
	});
<?php else:	?>
	get_customer_form();
<?php endif;?>

cart_totals = <?php echo Cart::deal(); ?>;
if(cart_totals==0)
{
$('#submitorder').trigger('click');
}
show_animation();

});

function get_customer_form()
{ 
//the loader will only show if someone is editing their existing information
$('#save_customer_loader').show();
//hide the button again
$('#submit_button_container').hide();

//remove the shipping and payment forms
$('#shipping_payment_container').html('<div class="checkout_block"><img alt="loading" src="<?php ?>"/><br style="clear:both;"/></div>').hide();
$.post("<?=URL::to('customer_details')?>", function(data){
	//populate the form with their information
	$('#customer_info_fields').html(data);
	update_summary();

});
}

// some behavior controlling global variables
 var customer= <?php echo Session::get('customer_data'); ?>;
 

var shipping_required = <?php echo (Cart::requires_shipping()) ? 'false' : 'false'; ?>;
var shipping = Array();
var shipping_choice = '<?php $shipping=Cart::shipping_method(); if($shipping) echo $shipping['method']; ?>';
var addr_context = '';
var ship_to_bill_address = '<?php if(isset($customer['ship_to_bill_address'])) { echo $customer['ship_to_bill_address']; } else { echo 'false'; } ?>';
var addresses;

// cart total is also set in the summary view
cart_total = <?php echo Cart::deal(); ?>;

// payment method
var chosen_method = ''; // holds the current chosen method
var payment_method = {}; // list of payment method validators



function submit_order()
{
// if we need to save a payment method
// 	if(cart_total>0) {
//
// 		frm_data = $('#pmnt_form_'+chosen_method).serialize();
//
// 		$.post('<?php echo url::to('Checkout/save_payment_method'); ?>', frm_data, function(response)
// 		{
// 			if(typeof response != "object")
// 			{
// 				display_error('payment', '<?php echo 'error';  ?>');
//
// 				return;
// 			}
//
// 			if(response.status=='success')
// 			{
// 				// send them on to place the order
// 				$('#order_submit_form').trigger('submit');
// 			}
// 			else if(response.status=='error')
// 			{
// 				display_error('payment', response.error);
// 			}
//
// 		}, 'json');
// 	} else {
// 		$('#order_submit_form').trigger('submit');
// 	}
}

function display_error(panel, message)
{
$('#'+panel+'_error_box').html(message).show();
}

function clear_errors()
{
$('.error').hide();

$('.required').each(function(){
		$(this).removeClass('require_fail');
});

$('.pmt_required').each(function(){
		$(this).removeClass('require_fail');
});
}


// shipping cost visual calculator
function set_shipping_cost()
{
clear_errors();

$.post('<?php echo url::to('Checkout/save_shipping_method');?>', {shipping:$(':radio[name$="shipping_input"]:checked').val()}, function(response)
{
	update_summary();
});
}

function set_chosen_payment_method(value)
{
chosen_method = value;
}

// Set payment info
function submit_payment_method()
{

$("#timeview").html('<SCRIPT language="JavaScript" SRC="<?php ?>">');
$('#submit-form-loader').show();
clear_errors();

errors = false;


 if(shipping_required && $('input:radio[name=shipping_input]:checked').val()===undefined && $('input:radio[name=shipping_input]').length > 0)
{
	display_error('shipping', '<?php echo 'error_choose_shipping';?>');
	errors = true;
}

// validate payment method if payment is required
 //alert($('input[name=payment_method]').length);
	// verify a payment option is chosen
	if($('input[name=payment_method]').length > 0 && cart_total>0)
	{
		if($('input:radio[name=payment_method]:checked').val()===undefined)
		{
			display_error('payment', '<?php echo 'error_choose_payment';?>');
			errors = true;
		}
	}

	// determine if our payment method has a built-in validator
	if(typeof payment_method[chosen_method] == 'function' )
	{
		if(!payment_method[chosen_method]())
		{
			errors = true;
		}
	}


// stop here if we have problems
if(errors)
{
	$('#submit-form-loader').hide();
	return false;
}

// send the customer data again and then submit the order
save_order();
}

function save_order()
{

//submit additional order details
$.post("<?=URL::to('save_additional')?>", $('#additional_details_form').serialize(), function(){

	//thus must be a callback, otherwise there is a risk of the form submitting without the additional details saved
	// if we need to save a payment method
	if(cart_total>0) {

		frm_data = $('#pmnt_form_'+chosen_method).serialize();
		$.post('<?php echo url::to('checkout/save_payment_method');?>', frm_data, function(response)
		{
			if(typeof response != "object")
			{
				display_error('payment', '<?php echo 'error_save_payment' ?>');
				$('#submit-form-loader').hide();
				return;
			}

			if(response.status=='success')
			{
				// send them on to place the order
				$('#order_submit_form').trigger('submit');
			}
			else if(response.status=='error')
			{
				display_error('payment', response.error);
				$('#submit-form-loader').hide();
				return;
			}

		}, 'json');
	} else {
		$('#order_submit_form').trigger('submit');
	}
});
}
// refresh the summary so that tax rows will be incorporated into the display
// (they'll be missing before the customer enters their address and change if they change it)

function update_summary()
{
// refresh confirmation content
$.post('<?php echo url::to('Checkout/order_summary');?>', {}, function(response)
{
	$('#summary_section').html(response);
});
}

</script>
<script type="text/javascript">
function show_animation()
{
$('#saving_container').css('display', 'block');
$('#saving').css('opacity', '.8');
}

function hide_animation()
{
$('#saving_container').fadeOut();
}
</script>

<script type="text/javascript">	
	function set_payment(value)
	 {  
		
	
	  axis_url = '<?php ?>';
	  hdfc_url = '<?php  ?>';
	  payu_url = '<?php ?>';
	 if(value=='axis')
	 {
	     window.location.assign(axis_url)
	 
	 } else if(value=='hdfc')
	 {
	 window.location.assign(hdfc_url)
	 }
	 else if(value=='payu')
	 {
	 window.location.assign(payu_url)
	 }
	 else{
	      chosen_method = value;		
	      $('.gc_payment_form').hide();
	      $('#pmnt_'+value).show();
	     }
	 }
	</script>
	
<!--xmlhttp.open("GET","demo_get.asp",true);
xmlhttp.send();-->
<div id="shipping_payment_container" style="display:none;">
<img alt="loading" src=""/>
</div>
<form id="additional_details_form" method="post" action="<?php echo url::to('Checkout/save_additional_details');?>">
							
							<input type="hidden" name="referral" />
							<input type="hidden" name="shipping_notes" />
			</form>
<div id="submit_button_container" style="display:none; text-align:center; padding-top:10px; clear:both;">
<form id="order_submit_form" action="<?php echo url::to('place_order'); ?>" method="post">
	<input type="hidden" name="process_order" value="true">

	<div style="text-align:center; margin:10px; display:none;" id="submit-form-loader">
		<img alt="loading" src="<?php ?>"/>
	</div>
	<input style="padding:10px 15px; font-size:16px;" name="submitorder" id="submitorder" type="button" class="btn btn-primary btn-large" onclick="submit_payment_method()" value="<?php echo 'submit_order';?>" />
</form>
</div>
<div id="saving_container" style="display:none;">
<div id="saving"></div>

<?php if(cart::deal()!=0) { ?>

<div class="checkout_block" style="font-size:22px;z-index:100001; margin-left:-114px; margin-top:-32px; position:fixed; left:50%; top:40%;color:#fff;width: 400px;">

<div id="no_payment_necessary" <?php if(Cart::deal()!=0) { ?> style="display:none" <?php } ?>>

		<table style="width:100%;">
		<tr>
			<td style="width:80%;">
				<div id="payments">
						
					<?php foreach ($payment_methods as $method=>$info):?>
					           <?php if ($method=='pay_by_points'):?>
						<input type="hidden" id="payment_<?php echo $method;?>" name="payment_method" value="<?php echo $method;?>" onchange="set_payment(this.value)" />
							<?php endif ?>
						<?php endforeach;?>
					
				</div>
			</td>
			<td>
				
				
					<?php foreach ($payment_methods as $method=>$info):?>
					
						<form id="pmnt_form_<?php echo $method;?>">
							<input type="hidden" name="module" value="<?php echo $method;?>" />
						<div class="gc_payment_form" id="pmnt_<?php echo $method;?>">
							<div class="gc_clr"></div>
						</div>
						</form>
						
					<?php endforeach;?>
			
			</td>
		</tr>
	</table>

</div>


<?php if(count($payment_methods) > 0 && $this->go_cart->deal()!=0):	?>
<div id="payment_section_container" >
	<div class="alert alert-error" id="payment_error_box" style="display:none"></div>
	<table style="width:100%;">
		<tr>
			<td style="width:80%;">
				<div id="payments">
					<h3 class="acninfo"> <?php echo lang('choose_payment_method');?></h3>
						
					<?php foreach ($payment_methods as $method=>$info):?>
					           <?php if ($method!='pay_by_points'): redirect('hdfc_payment/hdfc_do')?>

						
						<!--<input type="radio" id="payment_<?php echo $method;?>" name="payment_method" 
						value="<?php echo $method;?>" onchange="set_payment(this.value)" />
						<label for="payment_<?php echo $method;?>"><?php echo $info['name'];?></label><br/>-->
							<?php endif ?>
						<?php endforeach;?>
					
				</div>
			</td>
			<td>
				
				
					<?php foreach ($payment_methods as $method=>$info):?>
					
						<form id="pmnt_form_<?php echo $method;?>">
							<input type="hidden" name="module" value="<?php echo $method;?>" />
						<div class="gc_payment_form" id="pmnt_<?php echo $method;?>">
							<h3><?php echo $info['name']; ?></h3>
							<?php echo $info['form'];?>
							<div class="gc_clr"></div>
						</div>
						</form>
						
					<?php endforeach;?>
			
			</td>
		</tr>
	</table>


</div>

<?php else: ?>

<div id="payment_section_container">
	<div class="alert alert-error" id="payment_error_box" style="display:none"></div>

		<?php foreach ($payment_methods as $method=>$info):?>
			<input type="hidden" id="payment_<?php echo $method;?>" name="payment_method" value="<?php echo $method;?>"/>
		<?php endforeach;?>
	
		<?php foreach ($payment_methods as $method=>$info):?>
			<form id="pmnt_form_<?php echo $method;?>">
				<input type="hidden" name="module" value="<?php echo $method;?>" />
			<div class="gc_payment_form" id="pmnt_<?php echo $method;?>" >
				<h3><?php echo $info['name']; ?></h3>
				<?php echo $info['form'];?>
				<div class="gc_clr"></div>
			</div>
			</form>
		
			<script type="text/javascript">
				chosen_method = '<?php echo $method;?>';
			</script>
		
		<?php endforeach;?>
</div>
<?php endif; ?>

<div class="clear"></div>
</div>
<style>
.gc_payment_form{ display:none; }
</style>
<?php } else {  ?>

            <section class="forgot_div min_height">
               <section class="retrive_password">
                    <h3>Your order is Processing...</h3>
                    <div class="retrive_password_content">
                    <img style="padding-right: 57px;" src=""> </div>
                 </section>
             </section></section>
        <!--Content Ends here-->
<!--<p style="font-size:22px;z-index:100001; margin-left:-114px; margin-top:-32px; position:fixed; left:50%; top:40%;color:#fff;" >Your Order is Processing...</p>
<div id="saving_text" style="font-size:18px;text-align:center; width:100%; position:fixed; left:0px; top:40%; margin-top:40px; color:#fff; z-index:100001">Please Wait...</div>-->
<?php } ?>
</div>
</div>
<script>
function processing()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
}
xmlhttp.open("GET","place_order.php",true);
xmlhttp.send();
}
</script>

