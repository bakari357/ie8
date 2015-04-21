<script>
$(function() {
	// keep the cart total up to date for other JS functionality
	cart_total = 1; ?>;
	/*if(cart_total==0)
	{
		$('#payment_section_container').hide();
		$('#no_payment_necessary').show();
	} else {
		//$('#payment_section_container').show();
		//$('#no_payment_necessary').hide();
	}*/
});
</script>
<?php $amount_cash=0; $total_cash=0;  $get_customer_points=Currency::get_cutomer(); $customer_points=$get_customer_points['customer_points']; ?>
	<table class="table table-striped table-bordered">
		<thead>
			<thead>
				<tr>
					
					<th style="width:20%;">Item</th>
					<th style="width:10%;">Quantity</th>
					<th style="width:8%;">Points Total</th>
					<th style="width:8%;">Cash</th>
				</tr>
			</thead>
		</thead>

		<tfoot>
			<?php
			/**************************************************************
			Subtotal Calculations
			**************************************************************/
			?>
			<?php if(Cart::group_discount() > 0)  : ?>
        	<!--<tr>
				<td colspan="5"><strong><?php echo lang('group_discount');?></strong></td>
				<td><?php echo get_currency_value(0-$this->go_cart->group_discount()); ?>                </td>
			</tr>-->
			<?php endif; ?>



			<?php if(Cart::coupon_discount() > 0) {?>
		    <!--<tr>
		    	<td colspan="3"><strong><?php echo lang('coupon_discount');?></strong></td>
				<td id="gc_coupon_discount">-<?php echo get_currency_value($this->go_cart->coupon_discount());?></td>
			</tr>
				<?php if($this->go_cart->order_tax() != 0) { // Only show a discount subtotal if we still have taxes to add (to show what the tax is calculated from)?>
				<tr>
		    		<td colspan="3"><strong><?php echo lang('discounted_subtotal');?></strong></td>
					<td id="gc_coupon_discount"><?php echo get_currency_value($this->go_cart->discounted_subtotal());?></td>
				</tr>-->
				<?php
				}
			}
			/**************************************************************
			 Custom charges
			**************************************************************/
			$charges = Cart::get_custom_charges();
			if(!empty($charges))
			{
				foreach($charges as $name=>$price) : ?>

			<tr>
				<td colspan="3"><strong><?php echo $name?></strong></td>
				<td><?php echo Currency::get_currency_value($price); ?></td>
			</tr>

			<?php endforeach;
			}

			/**************************************************************
			Order Taxes
			**************************************************************/
			 // Show shipping cost if added before taxes
			if(Config::get('laravel_cart.tax_shipping') && Cart::shipping_cost()>0) : ?>
				<tr>
				<td colspan="3"><strong><?php echo 'Shipping';?></strong></td>
				<td><?php echo Currency::get_currency_value(Cart::shipping_cost()); ?></td>
			</tr>
			<?php endif;
			if(Cart::order_tax() > 0) :  ?>
		    <tr>
		    	<td colspan="3"><strong><?php echo 'Tax';?></strong></td>
				<td><?php echo Currency::get_currency_value(Cart::order_tax());?></td>
			</tr>
			<?php endif;
			// Show shipping cost if added after taxes
			if(!Config::get('laravel_cart.tax_shipping') && Cart::shipping_cost()>0) : ?>
				<tr>
				<td colspan="3"><strong><?php echo 'Shipping';?></strong></td>
				<td><?php echo Currency::get_currency_value(Cart::shipping_cost()); ?></td>
			</tr>
			<?php endif ?>

			<?php
			/**************************************************************
			Gift Cards
			**************************************************************/
			if(Cart::gift_card_discount() > 0) : ?>
			<tr>
				<td colspan="3"><strong><?php echo 'Gift Card Discount';?></strong></td>
				<td>-<?php echo Currency::get_currency_value(Cart::gift_card_discount()); ?></td>
			</tr>
			<?php endif; ?>



		</tfoot>

		<tbody>
			<?php


			$deal_cash=0;
		       $deal_points=0;
			$subtotal = 0;

			$count=1;foreach (Cart::content() as $cartkey=>$product):?>
		<?php

if(isset($product['apiproduct']) && !empty($product['apiproduct']))
		$quantitynew=$product['qty'];
		else{
		if(!(bool)$product['options']['fixed_quantity'])
		$quantitynew=$product['qty'];
		else
		$quantitynew=1;
		}




		$points=Currency::point_to_case($product['options']['points']*$quantitynew);
			if($product['options']['custom_cash'] >0)
		{
		if($customer_points<($points))
		{
		if($customer_points >$product['options']['custom_point'])
		{
		 $total_points=$product['options']['custom_point']*$quantitynew;
		 $cash=$product['options']['custom_cash']*$quantitynew;
		 $customer_points=$customer_points-$product['options']['custom_point'];
		}

		else
		{
		$cash=$points-$customer_points;
		$customer_points=0;
		$total_points=$points-$cash;

		}
		}
		else
		{
		if($customer_points>0)
		{
		 $total_points=$product['options']['custom_point']*$quantitynew;
		 $cash=$product['options']['custom_cash']*$quantitynew;
		 $customer_points=$customer_points-$product['options']['custom_point'];
		}
		else
		{
		  $total_points=0;
		  $cash=$points;

		}
		}
		}

		else{
		if($customer_points<$points)
		{

		 $cash=$points-$customer_points;
		 $customer_points=0;
		 $total_points=$points-$cash;

		}
		else
		{
		 if($customer_points>0)
		 {
		  $total_points=$points;
		  $cash=0;

		  $customer_points=$customer_points-$points;
		 }
		 else
		 {
		   $total_points=0;
		   $cash=$points;

		 }
		}
		}
		$total_cash+=$cash;?>

	<?php if(!isset($_POST['submitorder']) && isset($product['options']['timercode']))
			{   $timer= DB::table('timer_check')->where('code',$product['timercode'])->first();

?>
<span class="float:left;width:50px;" id="timeview"><SCRIPT language="JavaScript" SRC="<?php echo base_url();?>countdown.php?timezone=Asia/Calcutta&countto=<?php echo $timer->end_date; ?>&cartkey=<?php echo $cartkey;?>&cnt=<?php echo $count;?>&status=0&do=r&data=<?php echo base_url('cart/empty_item');?>"></SCRIPT></span>


<?php
			} ?>


				<tr>
					
					<td><?php echo $product['options']['item']; ?></td>
					<td><?php echo $product['qty'];?></td>
					<td><?php  echo Currency::get_currency_value($total_points,1); ?></td>
				        <td><?php echo Currency::get_currency_value(Currency::cash_ratio($cash)); ?>
				</td>
				</tr>



			<?php $deal_points=$deal_points+$total_points; $count++; endforeach;?>

			

			<?php
			/**************************************************************
			Grand Total
			**************************************************************/
			?>
			
			
			
			<tr>
				<td colspan="2"><strong><?php echo 'Total';?></strong></td>
				<td><?php echo  Currency::get_currency_value($deal_points,1); ?></td>
				<td><?php echo Currency::get_currency_value(Currency::cash_ratio($total_cash)); ?></td>
                        <input type="hidden" name="totalcash" id="totalcash" value="<?php echo Currency::get_currency_value(Currency::cash_ratio($total_cash),1); ?>" />
				

			</tr>
			
			<?php if(Cart::offer_discount() > 0)  : ?>
			<tr>
				<td colspan="2"><strong><?php echo 'Offer Discount';?></strong></td>
				<td><?php echo Currency::get_currency_value(0 - Cart::offer_discount(),1); ?></td>
				<td>&nbsp;</td>
			</tr>
                <?php endif; ?>

		
		<tr>
				<td colspan="2"><strong><?php echo 'Grand Total';?></strong></td>
				<td><?php 
				
				if($deal_points< Cart::offer_discount())
		                 $finaldeal= Cart::offer_discount()-$deal_points;
		                 else
	                        $finaldeal= $deal_points - Cart::offer_discount();
	                        if($total_cash < Cart::offer_discount())
		                 $finalcash = Cart::offer_discount()-$total_cash;
		                 else
	                        $finalcash= $total_cash- Cart::offer_discount();
				 if(Cart::offer_discount()>0){
				if($deal_points==0)
				{
				$finaldealpoints=0;
				if($finalcash<=0)
				$finaldealcash=0;
				else
				$finaldealcash=$finalcash;
				
				}
				else if($total_cash==0)
				{
				if($finaldeal<=0)
				$finaldealpoints=0;
				else
				$finaldealpoints=$finaldeal;
				
				$finaldealcash=0; 
				}
				else if($deal_points<$total_cash)
				{
				$finaldealpoints=$finaldeal;
				$finaldealcash=$total_cash - $finaldeal; 
				}
				else
				{
				$finaldealpoints=$finaldeal;
				$finaldealcash=$total_cash; 
				}
				}
				else
				{
				$finaldealpoints=$finaldeal;
				$finaldealcash=$total_cash; 
				}
				 echo Currency::get_currency_value(($finaldealpoints),1); ?></td>
				<td> <?php echo Currency::get_currency_value(Currency::cash_ratio($finaldealcash)); ?></td>
			</tr>
			
		</tbody>
	</table>
