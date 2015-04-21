

<script type="text/javascript">

$(document).ready(function() {
	<?php if(isset($customer['ship_address'])):?>
		$.post('<?php echo url::to('checkout/customer_details');?>', function(data){
			//populate the form with their information
			$('#customer_info_fields').html(data);
		});
	<?php else:	?>
		get_customer_form();
	<?php endif;?>
});

function get_customer_form()
{
	//the loader will only show if someone is editing their existing information
	$('#save_customer_loader').show();
	//hide the button again
	$('#submit_button_container').hide();

	//remove the shipping and payment forms     
	$('#shipping_payment_container').html('<div class="checkout_block"><img alt="loading" src="<?php echo Theme::asset()->url('img/ajax-loader.gif');?>"/><br style="clear:both;"/></div>').hide();
	$.post('<?php echo url::to('customer_form'); ?>', function(data){
		//populate the form with their information
		$('#customer_info_fields').html(data);
		update_summary();

	});
}

// some behavior controlling global variables
var logged_in_user = <?php if(Loginmodel::is_logged_in(false, false)) echo "true"; else echo "false"; ?>;

var shipping_required = <?php echo (Cart::requires_shipping()) ? 'false' : 'false'; ?>;
var shipping = Array();
var shipping_choice = '<?php $shipping=Cart::shipping_method(); if($shipping) echo $shipping['method']; ?>';
var addr_context = '';
var ship_to_bill_address = '<?php if(isset($customer['ship_to_bill_address'])) { echo $customer['ship_to_bill_address']; } else { echo 'false'; } ?>';
var addresses;

// cart total is also set in the summary view
   //cart_total = echo Cart::deal();
cart_total = 2;
// payment method
var chosen_method = ''; // holds the current chosen method
var payment_method = {}; // list of payment method validators



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

	$.post('<?php echo url::to('checkout/save_shipping_method');?>', {shipping:$(':radio[name$="shipping_input"]:checked').val()}, function(response)
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

$("#timeview").html('<SCRIPT language="JavaScript" SRC="<?php echo url::to('/');?>countdown.php?timezone=Asia/Calcutta&countto=0&cartkey=0&cnt=0&status=1&do=r&data=<?php echo url::to('cart/empty_item');?>">');
	$('#submit-form-loader').show();
	clear_errors();

	errors = false;

	 if(shipping_required && $('input:radio[name=shipping_input]:checked').val()===undefined && $('input:radio[name=shipping_input]').length > 0)
	{
		display_error('shipping', '<?php echo 'Shipping  choosed not Correct';?>');
		errors = true;
	}

	// validate payment method if payment is required
	 //alert($('input[name=payment_method]').length);
		// verify a payment option is chosen
		if($('input[name=payment_method]').length > 0 && cart_total>0)
		{
			if($('input:radio[name=payment_method]:checked').val()===undefined)
			{
				display_error('payment', '<?php echo 'Choosed Payment error ';?>');
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
	$.post('<?php echo url::to('checkout/save_additional_details');?>', $('#additional_details_form').serialize(), function(){

		//thus must be a callback, otherwise there is a risk of the form submitting without the additional details saved
		// if we need to save a payment method
		if(cart_total>0) {

			frm_data = $('#pmnt_form_'+chosen_method).serialize();
			$.post('<?php echo url::to('checkout/save_payment_method');?>', frm_data, function(response)
			{
				if(typeof response != "object")
				{
					display_error('payment', '<?php echo 'Payment Save error'; ?>');
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
	$.post("<?php echo url::to("order_summary");?>", {}, function(response)
	{          alert(response);
		$('#summary_section').html(response);
	});
}


</script>

<div class="row">
	<div class="span12" style="margin-bottom:10px;">
		<div class="btn-group pull-right">
			<?php if(!Loginmodel::is_logged_in(false, false)) : ?>
				<input class="btn" type="button" onclick="window.location='<?php echo url::to('checkout/login');?>'" value="<?php echo 'Login';?>" />
				<input class="btn" type="button" onclick="window.location='<?php echo url::to('checkout/register');?>'" value="<?php echo 'Registration';?>"/>
			<?php endif;?>
			<input class="btn btn-primary" type="button" onclick="window.location='<?php echo url::to('/');?>'" value="<?php echo 'Continue Shopping';?>"/>
		</div>
	</div>
</div>

<div class="row" style="margin-bottom:10px;">
	<div class="span12" id="customer_info_fields" style="border-bottom:4px solid #ddd; padding-bottom:15px;">
		<img alt="loading" src="<?php echo Theme::asset()->url('img/ajax-loader.gif');?>"/>
	</div>
</div>

<div id="shipping_payment_container" style="display:none;">
	<img alt="loading" src="<?php echo Theme::asset()->url('img/ajax-loader.gif');?>"/>
</div>

<div id="summary_section">

<?php include_once(base_path().'/public/themes/hdfc/views/checkout/summary.blade.php'); ?>
</div>

<div id="submit_button_container" style="display:none; text-align:center; padding-top:10px; clear:both;">
	<form id="order_submit_form" action="<?php echo url::to('checkout/place_order'); ?>" method="post">
		<input type="hidden" name="process_order" value="true">

		<div style="text-align:center; margin:10px; display:none;" id="submit-form-loader">
			<img alt="loading" src="<?php echo Theme::asset()->url('img/ajax-loader.gif');?>"/>
		</div>
		<input style="padding:10px 15px; font-size:16px;" name="submitorder"  type="button" class="btn btn-primary btn-large" onclick="submit_payment_method()" value="<?php echo 'Submit Order';?>" />
	</form>
</div>


