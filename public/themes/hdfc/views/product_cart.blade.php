<style>
.search {
background: none repeat scroll 0 0 #E10210;
float: right;
font-family: 'HelveticaNeueRegular',Arial,Helvetica,sans-serif;
font-size: 14px;
height: 30px;
line-height: 30px;
margin: 0;
padding: 0;
padding: 0px 0px 0px 0px;
margin: 0px 0px 0px 0px;
font-size: inherit;
text-align: center;
color: rgb(240, 235, 234);
border: 0pt ridge;
font-weight: bold;
text-decoration: none;
text-transform: none;
width: 26%;
cursor: pointer;
margin-left: 277px;

}


body {
    padding: 20px;
}
input {
    border: 1px solid lightgray;
    color: #f6931f;
    font-weight: bold;
    width: 30%;
}
input#amount2 { float: right; }
.error{ color:red;}
.del-goods {
background: #d7dde3 url(uploads/images/widget/0.png) no-repeat 50% 50%;
}
</style>
<link rel="stylesheet" href="themes/hdfc/assets/assets/css/jquery-ui.css" />	
<script src="themes/hdfc/assets/js/jquery.js"></script>	
<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Hotels</a></li>
					<li>/</li>
					<li><a href="#">U.S.A.</a></li>
					<li>/</li>					
					<li><a href="#" class="active">New York</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">
<form name="singleform" method="post" id="singleform"  class="form-horizontal" action="place_order">
		
		<div class="container mt25 offset-0">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
				
				<?php  $total = count(Cart::content());
                                if(count(Cart::content()) > 1)
                                {  ?>
                                 <span class="size16px bold dark left"><?php  echo 'Cart:'.$total.' Items'; ?></span>
                               <?php   }
                                else
                                { ?>
                            <span class="size16px bold dark left"><?php  echo 'Cart:'.$total.' Items'; ?></span>
                               <?php  } ?>
					
				
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					  <!-- BEGIN CONFIRM -->
              
                        <?php if (Cart::total()==0): Currency::block_points($points=0)?>
	<div class="alert alert-info">
		<a class="close" data-dismiss="alert">×</a>
		<?php echo 'Your Cart is empty';  ?>
	</div>
<?php else: ?>
	 <form action="add_to_cart" method="post" id="payment_form">

<div class="row">
&nbsp;
</div>
	
	<?php $amount_cash=0; $total_cash=0;  $get_customer_points=Currency::get_cutomer(); $customer_points=100000; ?>

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
		
		}
		
		foreach (Cart::content() as $cartkey=>$product): ?>
         
		<?php
		   
		   
	
		$pieces = explode(",", $product['options']['product_images']);
		$ima1 = str_replace('|1',' ',$pieces[0]); ?>
		
		<?php if($cartkey<>'') { 
		
			$quantitynew = 1;
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
		
			<tr>
				
				<td><img src="<?php echo $ima1;?>" height="250px" width="250px"/></td>
				

				<td>
				  
					<?php if(!(bool)$product['options']['fixed_quantity']):
						 ?>
						<div class="control-group">
							<div class="controls">
								<div class="input-append">
<input class="span1 validate[minSize[1],maxSize[5],custom[onlyNumberSp]]" style="margin:0px;" name="cartkey[<?php echo $cartkey;?>]"  id="cartkey[<?php echo $cartkey;?>]"  value="<?php echo $product['options']['quantity'] ?>" size="3" type="text"><button class="del-goods" type="button" onclick="if(confirm('<?php echo 'Are you sure you want to remove this item from your cart?';?>')){window.location='<?php echo url::to('remove_item/'.$cartkey);?>';}"><i class="icon-remove icon-white"></i></button>
								</div>
							</div>
						</div>
					<?php else:?>
					<input type="hidden" name="cartkey[<?php echo $cartkey;?>]"	value="<?php echo $product['qty'] ?>" />
			<?php echo $product['options']['quantity'] ?>		
<input type="hidden" name="cartkey[<?php echo $cartkey;?>]" value="<?php echo $product['qty']; ?>"/>
						<button class="del-goods" type="button" onclick="if(confirm('<?php echo 'Are you sure you want to remove this item from your cart?';?>')){window.location='<?php echo url::to('remove_item/'.$cartkey);?>';}"><i class="icon-remove icon-white"></i></button>
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
			
			<div class="row" style="margin-bottom:10px;">
	<div class="span12" id="customer_info_fields" style="">
		<!--<img alt="loading" src="<?php echo Theme::asset()->url('img/ajax-loader.gif');?>"/>-->
	</div>
</div>
		

		</tbody>
	</table>

<input type="hidden" value="<?php echo $deal_points; ?>" name="deal_points" />
<input type="hidden" value="<?php echo $total_cash; ?>" name="total_cash" />
<!-- Points Escalator-->
<div class="span7" style="width: 410px;float:right;">


<?php
// 	Get Customer points value
	$get_customer_points=Currency::get_cutomer();
	$customer_points=100000;
	$totalpoints=$deal_points;
?> 
<?php if($customer_points >0 && $customer_points <>0):?>
	<div class="escalate-div">
	<div class="product-cart-form"  >
	  <input autocomplete="off" id="myTextInput" type="hidden" name="custompoint" value=""/>
	</div>
	<div class="signnambx" id="escalat" style="float: left;width: 112px;">
	
	
	
	</div>	
	
	  <input autocomplete="off" type="hidden" id="customerpoints" name="customcash1" readonly value="0"/>
	<input id="customerpoints1" autocomplete="off" name="customcash" type="hidden" readonly value="0"/>
	</div>
	
	<?php endif?> 
	
	</div>
	<div class="row" style="float:left"><div class="span5"> &nbsp;</div></div>
		
<?php endif; ?>
<p>

             
                                <div class="clearfix"></div><br/>
                                <span class="size16px bold dark left">Shipping Address</span>
                                <div class="clearfix"></div>
                                <div class="line4"></div><br/>
                                <div class="col-md-4">
                                </div><div class="col-md-4 textleft">
                                </div>
                                <div class="clearfix"></div>
                                <br/>
                                <!-- Nav tabs --><!-- Tab panes -->
                                <div class="tab-content4"><!-- Tab 1 -->
                                <div class="tab-pane active" id="card"><div class="col-md-4 textright">
                                <div class="margtop15"><span class="dark">Contact Name:</span><span class="red">*</span></div>
                                </div>
                                <div class="col-md-4">
                                <input type="text" id="cname" name="cname" class="form-control margtop10" placeholder="">
                                </div>
                                <div class="col-md-4 textleft">
                                </div>
                                <div class="clearfix"></div> <br/>
                                <div class="col-md-4 textright">
                                <div class="margtop15"><span class="dark">Mobile Number:</span><span class="red">*</span></div>
                                </div>
                                <div class="col-md-4">
                                <input type="text" name="mobile" id="mobile" class="form-control margtop10" placeholder="">
                                </div>
                                <div class="col-md-4 textleft">
                                </div>
                                <div class="clearfix"></div>

                                <br/>
                                <div class="col-md-4 textright">
                                <div class="margtop15"><span class="dark">Email Address:</span><span class="red">*</span></div>
                                </div>
                                <div class="col-md-4">
                                <input type="text" name="email" id="email" class="form-control margtop10" placeholder="">
                                </div>
                                <div class="col-md-4 textleft">
                                </div>
                                <div class="clearfix"></div><br/>
                                <div class="col-md-4 textright">
                                <div class="margtop15"><span class="dark">Address:</span><span class="red">*</span></div>
                                </div>
                                <div class="col-md-4">
                                <textarea rows="4" cols="50" name="address" id="address" class="form-control margtop10" placeholder="">
                                </textarea>
                                </div>  <div class="clearfix"></div>   <div class="col-md-4 textright">
                                <div class="margtop15"><span class="dark">Landmark:</span></div>
                                </div>
                                <div class="col-md-4">
                                <input type="text" class="form-control margtop10" placeholder="">
                                </div>
                                <div class="col-md-4 textleft margtop15">
                                </div>
                                <div class="clearfix"></div></div> </div>
                                <div class="clearfix"></div><br/>
					<br/>
					<span class="size16px bold dark left">Review</span>
			               <div class="clearfix"></div>
					<div class="line4"></div><table class="wh100percent margtop7">
                                        <tr>
                                        <td>
                                        <div class="radio radiomargin0">
                                        <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                        Credit/Debit Card&nbsp;&nbsp;&nbsp;
                                        </label>
                                        </div>
                                        </td>
                                        <td>
                                        <div class="radio radiomargin0">
                                        <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                        Net Banking
                                        </label>
                                        </div>
                                        </td>
                                        <td>
                                        <div class="radio radiomargin0">
                                        <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                        EMI
                                        </label>
                                        </div>
                                        </td>
                                        </tr></table>
                                        <br/>
					<div class="clearfix"></div>
					<div class="line4"></div><div class="">
					<input type="submit" name="go" id="submit" onclick="save_customer();" class="search" value="Continue to Checkout"/></div>		
					<div class="clearfix"></div>
					<div class="line4"></div>
					By selecting to complete this booking I acknowledge that I have read and accept the <a href="#" class="clblue">rules & 
					restrictions</a> <a href="#" class="clblue">terms & conditions</a> , and <a href="#" class="clblue">privacy policy</a>.	<br/>		</div></div>
						
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding20">
						<span class="opensans size18 dark bold caps">Summary</span>
					</div>
					<div class="line3"></div><div class="hpadding30 margtop30">
				        <!-- GOING TO -->
					<div>
						
						<div class="clearfix"></div>
					</div>
					
	<span class="grey2"><?php if(isset($product['options']['quantity']) && $product['options']['quantity']==1) { 
					echo $product['options']['quantity']; ?> Product:</span><?php } else{
					echo $product['options']['quantity']; ?> Products:
					<?php }?> <?php if(isset($total_cash) && !empty($total_cash))
    { ?>
  <span class="grey2"> &#8377 <?php echo $total_cash;?></span>
    
   <?php  }else{ ?>
  <span class="grey2"> &#8377 <?php echo $deal_points;?></span>
  <?php  }?>
     <br/>
					<span class="grey2">Shipping Charges:</span> 
					<br/>
					<br/>

					
					
					</div>	
					<div class="line3"></div>
				
	<p>
	<label for="amount">Points</label>
	
    <input type="text" id="amount1" value="<?php echo $deal_points;?>"  />
    <label for="amount">Cash</label>
    <input type="text" id="amount2" value="<?php echo $total_cash;?>" readonly value="0"/>
    <?php if(isset($total_cash) && !empty($total_cash))
    { ?>
     <input type="hidden" id="total_rate" id="total_rate" value="<?php echo $total_cash;?>"/>
    
   <?php  }else{ ?>
    <input type="hidden" id="total_rate" id="total_rate" value="<?php echo $deal_points;?>"/>
  <?php  }?>
     
</p>
<br />
<div id="slider"></div>
<div style="text-align: center;">
    <label for="amount">Price Range</label>
</div>
                       
                                </div><br/><div class="pagecontainer2 loginbox">
					<div class="cpadding1">
						<span class="icon-lockk"></span>
						<h3 class="opensans">Log in</h3>
						<input type="text" class="form-control logpadding" placeholder="Username">
						<br/>
						<input type="text" class="form-control logpadding" placeholder="Password">
						<div class="margtop20">
							<div class="left">
								<div class="checkbox padding0">
									<label>
									  <input type="checkbox">Remember
									</label>
								</div>
								<a href="#" class="greylink">Lost password?</a><br/>
							</div>
							<div class="right">
								<button class="btn-search5" type="submit" onclick="errorMessage()">Login</button>	
							</div>
						</div>
						<div class="clearfix"></div><br/>
					</div>
				</div><br/>
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	

	
	
	<!-- FOOTER -->
	
	<div class="footerbgblack">
		<div class="container">		
			
			<div class="col-md-3">
				<span class="ftitleblack">Let's socialize</span>
				<div class="scont">
					<a href="#" class="social1b"><img src="images/icon-facebook.png" alt=""/></a>
					<a href="#" class="social2b"><img src="images/icon-twitter.png" alt=""/></a>
					<a href="#" class="social3b"><img src="images/icon-gplus.png" alt=""/></a>
					<a href="#" class="social4b"><img src="images/icon-youtube.png" alt=""/></a>
					<br/><br/><br/>
					<a href="#"><img src="images/logosmal2.png" alt="" /></a><br/>
					<span class="grey2">&copy; 2013  |  <a href="#">Privacy Policy</a><br/>
					All Rights Reserved </span>
					<br/><br/>
					
				</div>
			</div>
			<!-- End of column 1-->
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Golf Vacations</a></li>
					<li><a href="#">Ski & Snowboarding</a></li>
					<li><a href="#">Disney Parks Vacations</a></li>
					<li><a href="#">Disneyland Vacations</a></li>
					<li><a href="#">Disney World Vacations</a></li>
					<li><a href="#">Vacations As Advertised</a></li>
				</ul>
			</div>
			<!-- End of column 2-->		
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Weddings</a></li>
					<li><a href="#">Accessible Travel</a></li>
					<li><a href="#">Disney Parks</a></li>
					<li><a href="#">Cruises</a></li>
					<li><a href="#">Round the World</a></li>
					<li><a href="#">First Class Flights</a></li>
				</ul>				
			</div>
			<!-- End of column 3-->		
			
			<div class="col-md-3 grey">
				<span class="ftitleblack">Newsletter</span>
				<div class="relative">
					<input type="email" class="form-control fccustom2black" id="exampleInputEmail1" placeholder="Enter email">
					<button type="submit" class="btn btn-default btncustom">Submit<img src="images/arrow.png" alt=""/></button>
				</div>
				<br/><br/>
				<span class="ftitleblack">Customer support</span><br/>
				<span class="pnr">1-866-599-6674</span><br/>
				<span class="grey2">office@travel.com</span>
			</div>			
			<!-- End of column 4-->			
		
			
		</div>	
	</div>
	
	<div class="footerbg3black">
		<div class="container center grey"> 
		<a href="#">Home</a> | 
		<a href="#">About</a> | 
		<a href="#">Last minute</a> | 
		<a href="#">Early booking</a> | 
		<a href="#">Special offers</a> | 
		<a href="#">Blog</a> | 
		<a href="#">Contact</a>
		<a href="#top" class="gotop scroll"><img src="images/spacer.png" alt=""/></a>
		</div>
	</div>
	<p>

	
	<script type="text/javascript" >
$(document).ready(function() {

	$("#singleform").validate({
		rules: {
			
			cname : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				address : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
			mobile : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
				number:true
				
				
				
			},
			
			email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email:true
			}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
			}
		},
        submitHandler: function(frm) {
      //  var point=$("#myTextInput").val();
     //   var cash=$("#customerpoints1").val();

        if(point==0 && cash==0)
        {
        $("#perror").css('display','block');

        return false;
        }
        else
        {
        frm.submit();
        $("#submit").css('display','none');
        return true;
        }
        }
		
		
		});
		});
	
</script>
 <script>
    
    function save_customer()
{
       form_data  = $('#singleform').serialize();
       $.post('<?php echo url::to('save_customer') ?>', form_data, function(response)
	{
		if(typeof response != "object") // error
		{
			display_error('customer', '<?php echo 'communication_error';?>');
			return;
		}

		if(response.status=='success')
		{
			//populate the information from ajax, so someone cannot use developer tools to edit the form after it's saved
			$('#customer_info_fields').html(response.view);
			 // and update the summary to show proper tax information / discounts
			 update_summary();
		}
		else if(response.status=='error')
		{
			display_error('customer', response.error);
			$('#save_customer_loader').hide();
		}
	}, 'json');
	

	
}
    </script>
 <script type="text/javascript" src="themes/hdfc/assets/js/jquery-ui-1.9.2.js"></script>
          <script type="text/javascript" src="themes/hdfc/assets/js/jquery-ui-1.9.2.min.js"></script>
 <script type="text/javascript" src="themes/hdfc/assets/js/jquery-1.8.3.js"></script>

	<!-- end -->
	<script>
    $(document).ready(function(){
             var total=$("#total_rate").val();
             var point=$("#amount1").val();
             var cash=$("#amount2").val();
               $( "#slider" ).slider({
                value:0,
                min: 0,
                max: total,
                slide: function( event, ui ) {
                if (point > cash){

                $( "#amount2" ).val( " " + ui.value );
                var bal =  point - ui.value; 
                $( "#amount1" ).val(bal);
                }else{
                //multiply by -1 to make positive

                $( "#amount1" ).val( " " + ui.value );
                var bcash =  cash - ui.value; 

                $( "#amount2" ).val(bcash);
                }
                }
                });
});
</script>
<script src="themes/hdfc/assets/assets/js/jquery.validate.js"></script>
