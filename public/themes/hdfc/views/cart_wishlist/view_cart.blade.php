
<script>
		$(document).ready(function(){
			// binds form submission and fields to the validation engine
			$("#update_cart_form").validationEngine('attach', {promptPosition : "topLeft", autoPositionUpdate : true });
		});
	</script>
<?php if (Cart::total()==0): Currency::block_points($points=0)?>
	<div class="alert alert-info">
		<a class="close" data-dismiss="alert">×</a>
		<?php echo 'Your Cart is empty';  ?>
	</div>
<?php else: ?>
	<div class="accountoutbx">
	<div class="page-header">
		<h3>Shopping Cart</h3>
	</div>
	</div>

<div class="row">
&nbsp;
</div>
	{{ Form::open()}}
	<?php $amount_cash=0; $total_cash=0;  $get_customer_points=Currency::get_cutomer(); $customer_points=$get_customer_points['customer_points']; ?>

	<table class="table table-bordered table-striped">

		<thead>
			<tr>
				
				<th style="width:20%;">Item</th>
				<th style="width:15%;">Quantity</th>
				<th style="width:8%;">Points</th>
				<th style="width:8%;">Cash</th>
			</tr>
		</thead>

		<tfoot>
			<?php if(Cart::group_discount() > 0)  : ?>
			<!--<tr>
				<td colspan="7"><strong><?php echo lang('group_discount');?></strong></td>
				<td><?php echo get_currency_value(0-$this->go_cart->group_discount()); ?></td>
			</tr>-->
			<?php endif; ?>



			<?php if(Cart::coupon_discount() > 0)  : ?>
			<?php if(Cart::order_tax() != 0) : // Only show a discount subtotal if we still have taxes to add (to show what the tax is calculated from) ?>
			<tr>
				<td colspan="2"><strong><?php echo lang('discounted_subtotal');?></strong></td>
				<td><?php echo Currency::get_currency_value(Cart::discounted_subtotal()); ?></td>
			</tr>

			<?php endif;
			endif;
			// Custom Charges
			$charges = Cart::get_custom_charges();
			if(!empty($charges)):
				foreach($charges as $name=>$price) : ?>
					<tr>
						<td colspan="7"><strong><?php echo $name;?></strong></td>
						<td><?php echo Currency::get_currency_value($price); ?></td>
					</tr>

			<?php endforeach; 	endif;
                       // Show shipping cost if added before taxes
                      
			if(Config::get('laravel_cart.tax_shipping') && Cart::shipping_cost()>0) : ?>
			
				<tr>
			<td colspan="2"><strong><?php echo 'Shipping';?></strong></td>
				<td><?php echo Currency::get_currency_value(Cart::shipping_cost()); ?></td>
			</tr>
			<?php endif ?>
			<?php if(Cart::order_tax() != 0) : ?>
			<tr>
				<td colspan="7"><strong><?php echo 'Taxes';?></strong></td>
				<td><?php echo Currency::get_currency_value(Cart::order_tax()); ?></td>
			</tr>
			<?php endif;   ?>

			<?php // Show shipping cost if added after taxes
			
			if(!Config::get('laravel_cart.tax_shipping') && Cart::shipping_cost()>0) : ?>
				<tr>
				<td colspan="7"><strong><?php echo 'Shipping';?></strong></td>
				<td><?php echo Currency::get_currency_value(Cart::shipping_cost()); ?></td>
			</tr>
			<?php endif ?>

			<?php if(Cart::gift_card_discount() != 0) : ?>
			<tr>
				<td colspan="7"><strong><?php echo 'Gift Card Discount';?></strong></td>
				<td><?php echo Currency::get_currency_value(0-Cart::gift_card_discount()); ?></td>
			</tr>
			<?php endif;?>
			

		</tfoot>

		<tbody>
		<?php
		$subtotal = 0;
		$deal_cash=0;
		$deal_points=0;
		$point_flag=0;
		$count=1;
		foreach (Cart::content() as $cartkey=>$product){
		//echo '<pre>whole'; print_r($product);['items:protected']
		//echo '<pre>'; print_r($product['options']);
		}
		
		foreach (Cart::content() as $cartkey=>$product): ?>
         
		<?php
		
		
		if($cartkey<>'') { 
		
	        if(isset($product['options']['product_type']) && $product['options']['product_type']=='Digital')
	        Cart::update(array($cartkey=>0));
		
		//if(isset($product['options']['apiproduct']) && !empty($product['options']['apiproduct']))
		if(isset($product['options']) && !empty($product['options']))
		$quantitynew=$product['qty'];
		
		else{
		
		if(!(bool)$product['options']['fixed_quantity']){
		
		$quantitynew=$product['qty'];
		}
		else{
		$quantitynew=1;
		}
		}
		
		$points=( $product['options']['points'] *$quantitynew );
		
			if(isset($product['options']['custom_cash']) && $product['options']['custom_cash'] >0)
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
		$total_cash+=$cash;
		
		
		?>
		
		<?php if(isset($product['options']['timercode']))
			{

			$timer= DB::table('timer_check')->where('code',$product['timercode'])->first();
?>
<span class="float:left;width:50px;" id="timeview" ><SCRIPT language="JavaScript" SRC="<?php echo url::to('/');?>countdown.php?timezone=Asia/Calcutta&countto=<?php echo $timer->end_date; ?>&cartkey=<?php echo $cartkey;?>&cnt=<?php echo $count;?>&status=0&do=r&data=<?php echo url::to('cart/empty_item');?>"></SCRIPT></span>


<?php
			} ?>
		
			<tr>
				
				<td><?php  echo $product['options']['item'];  ?></td>
				

				<td>
				 
					<?php if(!(bool)$product['options']['fixed_quantity']):?>
						<div class="control-group">
							<div class="controls">
								<div class="input-append">
<input class="span1 validate[minSize[1],maxSize[5],custom[onlyNumberSp]]" style="margin:0px;" name="cartkey[<?php echo $cartkey;?>]"  id="cartkey[<?php echo $cartkey;?>]"  value="<?php echo $product['options']['quantity'] ?>" size="3" type="text"><button class="btn btn-danger" type="button" onclick="if(confirm('<?php echo 'Are you sure you want to remove this item from your cart?';?>')){window.location='<?php echo url::to('remove_item/'.$cartkey);?>';}"><i class="icon-remove icon-white"></i></button>
								</div>
							</div>
						</div>
					<?php else:?>
					<input type="text" name="cartkey[<?php echo $cartkey;?>]"	value="<?php echo $product['qty'] ?>"
			<?php //echo $product['options']['quantity'] ?>		
<input type="hidden" name="cartkey[<?php echo $cartkey;?>]" value="<?php echo $product['qty']; ?>"/>
						<button class="btn btn-danger" type="button" onclick="if(confirm('<?php echo 'Are you sure you want to remove this item from your cart?';?>')){window.location='<?php echo url::to('remove_item/'.$cartkey);?>';}"><i class="icon-remove icon-white"></i></button>
					<?php endif; ?>
					
				</td>

                                <td><?php   echo Currency::get_currency_value(($total_points),1);  ?></td>

				<td><?php  echo Currency::get_currency_value(Currency::cash_ratio($cash)); ?>


				</td>

			</tr>
				<?php $deal_points=$deal_points+$total_points; ?>
		<?php $count++; } endforeach; 
		
		                if($deal_points< Cart::offer_discount())
		                 $finaldeal= Cart::offer_discount()-$deal_points;
		                 else
	                        $finaldeal= $deal_points- Cart::offer_discount();
	                        if($total_cash < Cart::offer_discount())
		                 $finalcash= Cart::offer_discount()-$total_cash;
		                 else
	                        $finalcash= $total_cash-Cart::offer_discount();
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
				Currency::block_points($finaldealpoints);
				Cart::dealTotal($finaldealcash);  
				 ?>

                <input type="hidden" name="dealtotal" value="<?php echo Cart::deal(); ?>" />
		     
		
		<?php if(Cart::offer_discount() > 0)  : ?>
			<tr>
				<td colspan="2"><strong><?php echo 'Offer discount'; ?></strong></td>
				<td><?php echo Currency::get_currency_value(0-Cart::offer_discount(),1); ?></td>
				<td>&nbsp;</td>
			</tr>
                <?php endif; ?>

		
		<tr>
				<td colspan="2"><strong><?php echo 'Grand Total';?></strong></td>
				<td><?php 
				 echo Currency::get_currency_value(($finaldealpoints),1); ?></td>
				<td> <?php echo Currency::get_currency_value(Currency::cash_ratio($finaldealcash),$point_flag); ?></td>
			</tr>
			
			
		

		</tbody>
	</table>

<input type="hidden" value="<?php echo $deal_points; ?>" name="deal_points" />
<input type="hidden" value="<?php echo $total_cash; ?>" name="total_cash" />
<!-- Points Escalator-->
<div class="span7" style="width: 410px;float:right;">


<?php
// 	Get Customer points value
	$get_customer_points=Currency::get_cutomer();
	$customer_points=$get_customer_points['customer_points'];
	$totalpoints=$deal_points;
?> 
<?php if($customer_points >0 && $customer_points <>0):?>
	<div class="escalate-div">
	<div class="product-cart-form"  >
	<?php echo 'Points'; ?>  <input autocomplete="off" id="myTextInput" name="custompoint" value=""/>
	</div>
	<div class="signnambx" id="escalat" style="float: left;width: 112px;">
	
	
	<?php Rewards::points_escalator_cart($totalpoints+($total_cash),$totalpoints,($total_cash),$customer_points); ?>
	</div>	
	<div class="product-cart-form" >
	<?php echo 'Cash'; ?>  <input autocomplete="off" id="customerpoints" name="customcash1" readonly value="0"/>
	<input id="customerpoints1" autocomplete="off" name="customcash" type="hidden" readonly value="0"/>
	</div>
	</div>
	<?php endif?>
	
	</div>
	


	<div class="row" style="float:left">
		<div class="span5"> &nbsp;
			
			
<div style="float:left;">
<a class="btn btn-primary" href="<?php echo url::to('/'); ?>"><i class="icon-plus-sign"></i> <?php echo 'Continue Shopping';?></a>
</div>
		</div>

		<div class="span7" style="text-align:right;">
		
				<input id="redirect_path" type="hidden" name="redirect" value=""/>
				<?php if (!Loginmodel::is_logged_in()): ?>

					<input class="btn btn-primary" type="submit" onclick="$('#redirect_path').val('securelogin');" value="Login"/>
					<input class="btn btn-primary" type="submit" onclick="$('#redirect_path').val('register');" value="Register"/>
					<?php endif; ?>
					<input class="btn btn-primary" type="submit" value="<?php echo 'Update Cart';?>"/>

			<?php if (Loginmodel::is_logged_in(false,false)): ?>
				<input class="btn  btn-primary" type="submit" onclick="$('#redirect_path').val('checkout');" value="Checkout &raquo;"/>
			<?php endif; ?>


		</div>
	</div>

{{ Form::close()}}





<?php endif; ?>


