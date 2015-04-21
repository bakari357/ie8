<script type="text/javascript">
	window.onload = function()
	{
		$('.product').equalHeights();
	}
</script>
<script type="text/javascript">
$.validator.setDefaults({
	//submitHandler: function() { alert("submitted!"); }
});

$(document).ready(function() {
	// validate the comment form when it is submitted
	$.validator.addMethod("numericvalue", function(value, element) {
	
	var intRegex = /^\d+$/;
var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

		return this.optional(element) || intRegex.test(value);
		}, "Field must contain only digits");
	// validate signup form on keyup and submit
	$("#checkoutform").validate({
		rules: {
		quantity: {
			required: true,
			numericvalue:true,
			max: <?php echo $product->quantity; ?>
			}

		},
		messages: {
		quantity: {
			required: "Field is required",
			max: "Quantity limit exceeds.",
			numericvalue: "Field must contain only digits"
		}
		}
	});
});
</script>
<div class="in_lftbx">
	<div class="over-imbx">
	<?php   
	//$cats=get_cat_by_product($id);
	//$getcate=$cats;
	//$checkoffer=get_client_offer($id,$cats['category_id']);
	//$discount_amount=0;
	
	if($product->price){
        if(($product->price< $product->saleprice))
        {
        $point_to_cash=(($product->price-$product->saleprice)*100)/($product->price);
        }

        else{
        $point_to_cash=point_to_case(0);
        } 
        $points= Currency::get_currency_value(point_to_case(get_offer($product->saleprice,$product->offer),$point_to_cash),1);
        }
        else if($product->price==0)
        {
        $point_to_cash=Currency::point_to_case(0);
        $points= Currency::get_currency_value(Currency::point_to_case(Currency::get_offer($product->saleprice,$product->offer),$point_to_cash),1);
      
        }
	/*	
		
	if(!empty($checkoffer))
	{
	$price = (float) $product->saleprice;
	if($checkoffer['offer_type']=="percent")
		{

			$reduction_amount	= 100 - (float) $checkoffer['amount'];
			$discount			= ($price * ($reduction_amount/100));
			$discount_amount	= abs($price-$discount);
		}
		else
		{
			$discount_amount = (float) $checkoffer['amount'];
			// Prevent fixed discounts from resulting a negative discount amount
			if($discount_amount > $product->saleprice)
			{
				$discount_amount = $product->saleprice;
			}
		}
		
		if($checkoffer['level']==2)
	{
	if(in_array($id,$checkoffer['product_list'][0]))
	{
	$points=$product->saleprice - $discount_amount;
	}
	}
	else
	$points=$product->saleprice - $discount_amount;
	}
		
		*/
	
	$get_customer_points=Currency::get_cutomer(); $customer_points=$get_customer_points['customer_points'];
	 // $debit_cart=$this->go_cart->debit_points(); echo  $debit_cart;  $customer_points=$customer_points-$debit_cart;
	?>
	<?php
	$photo	= Theme::asset()->url('img/no_picture.png'); 
	
	if(array_key_exists('custom',$product->images))
        {
        $image_path=Rewards::custom_url();
        $img=1;
        }
        else{$image_path=Rewards::rewards_url();}
        
	$product->images	= array_values($product->images);
        if(!empty($product->images[0]))
	{
		$primary	= $product->images[0];
		foreach($product->images as $photo)
		{
			if(isset($photo->primary))
			{
				$primary	= $photo;
			}
		}
	      if(isset($img)&&$img==1)
	      {
	         $filepath=$image_path.''.$primary->filename;
                 $image_name=Rewards::getExtension($filepath);
                 $thumb= str_replace('original','thumb',str_replace('.'.$image_name,'_thumb.'.$image_name, $filepath));
                 $photo	= '<img class="responsiveImage" src="'.$thumb.'" alt="'.$product->seo_title.'"/>';
              }else{
	$photo	= '<img class="responsiveImage" width="300" height="200"  src="'.$image_path.''.$primary->filename.'" alt="'.$product->seo_title.'"/>';
	}
	}
	echo $photo
	?>
	</div>
	<div class="over-samptotbx">
	<?php if(count($product->images) > 1):?>
		<?php foreach($product->images as $image): ?>
		
		<div class="over-samp"> <img class="span1"  onclick="$(this).squard('390', $('#primary-img'));" src="<?php echo $image_path.''.$image->filename; ?>"/> </div>
		<?php endforeach;?>
	<?php endif;?>
	</div>
</div>
<div class="in_rgtbx">
	<h3><?php echo $product->name; ?></h3>
	<p class="in_spec" style="padding-bottom:0;" ><strong>
	<?php
	
	echo 'Points:';
	 if($product->price==0)
	  echo  Currency::get_currency_value(Currency::point_to_case(Currency::get_offer($product->saleprice,$product->offer),$point_to_cash),1);
	 else
	 echo   Currency::get_currency_value(Currency::point_to_case(Currency::get_offer($product->saleprice,$product->offer),$point_to_cash),1);
	 ?>
	 </strong></p>
	<?php if($point_to_cash<>0){
		?>
	<span class="price_sale"><?php echo 'Points';  echo  Currency::get_currency_value(Currency::point_to_case($product->price),1); echo '</span>'; ?>
	 </strong>
	 </p>
	 <p class="in_spec" style="padding:0;"><strong> Save : <?php echo floor($point_to_cash); ?> %</p>
	 
	 <p class="in_spec" style="padding:0;"><strong> Product Offer : <?php echo Currency::get_currency_value(Currency::point_to_case(get_offer($product->price,$point_to_cash)),1) ?></p>
	 
                                
                           <?php     }
                                ?>
        <div class="over-spec">
        <p><?php echo $product->description; ?></p>
        </div>
	<div class="over-spec">
	
	<!---'cart/add_to_cart', 'class="form-horizontal" id="checkoutform"' !-->
	
	{{ Form::open(array("id"=>"cart_product","role"=>"form")); }}
	  <?php // 	Get Customer points value
                                                $get_customer_points=Currency::get_cutomer();
                                                $customer_points=$get_customer_points['customer_points'];
                                                ?> 
                                                <?php if($customer_points >0 && $customer_points <>0):?>
                                                
                                 <div class="control-group" style="float:left;" >
						<label class="control-label"><?php echo 'Quantity'; ?></label>
						<div class="submitbuttonbx" style="padding:5px;margin-left:0px !important;width:269px;">
						<?php $allow_os_purchase = true;?>
							<?php if($allow_os_purchase || !(bool)$product->track_stock || $product->quantity > 0) : ?>
								<?php if(!$product->fixed_quantity) : ?>
									<input  maxlength="6" style="width:50px !important;" type="text" id="quantity" name="quantity" value="" class="txt_signup2 billfname"/>
								<?php endif; ?>
							<?php endif;?>
						</div></div>
                                                
                                                
                                                <div class="escalate-div">
                                                <div class="product-cart-form"  >
                                                <?php echo 'Points'; ?>  <input id="myTextInput" name="custompoint" autocomplete="off"  value=""/>
                                                </div>
                                                <div class="signnambx" id="escalat" style="float: left;width: 112px;">
                                                <?php Rewards::points_escalator($points,$customer_points); ?>
                                                </div>	
                                                <div class="product-cart-form" >
                                                <?php echo 'Cash'; ?>  <input id="customerpoints" autocomplete="off"  name="customcash1"  value="0" readonly style="float: left;width: 112px;" />
                                                <input id="customerpoints1" name="customcash" autocomplete="off"  type="hidden" readonly value="0"/>
                                                </div>
                                                </div>
                                                
                                                
		<!-- Start of yui jquery-->
		
		
					<input type="hidden" name="cartkey" value="<?php echo Session::get('cartkey');?>" />
					<input type="hidden" name="id" value="<?php echo $product->id; ?>"/>
					<input type="hidden" name="amount" value="<?php echo  Currency::get_offer($product->price,$point_to_cash);  ?>"/>
					<input type="hidden" name="sku" value="<?php echo $product->sku; ?>"/>
					

					<?php if(count($options) > 0): ?>
						<?php foreach($options as $option):
							$required	= '';
							if($option->required)
							{
								$required = ' <p class="help-block">Required</p>';
							}
							?>
							<div class="control-group">
								<label class="control-label"><?php echo $option->name;?></label>
								<?php
								/*
								this is where we generate the options and either use default values, or previously posted variables
								that we either returned for errors, or in some other releases of Go Cart the user may be editing
								and entry in their cart.
								*/

								//if we're dealing with a textfield or text area, grab the option value and store it in value
								if($option->type == 'checklist')
								{
									$value	= array();
									if($posted_options && isset($posted_options[$option->id]))
									{
										$value	= $posted_options[$option->id];
									}
								}
								else
								{
									$value	= $option->values[0]->value;
									if($posted_options && isset($posted_options[$option->id]))
									{
										$value	= $posted_options[$option->id];
									}
								}

								if($option->type == 'textfield'):?>
									<div class="controls">
										<input type="text" name="option[<?php echo $option->id;?>]" value="<?php echo $value;?>" class="span4"/>
										<?php echo $required;?>
									</div>
								<?php elseif($option->type == 'textarea'):?>
									<div class="controls">
										<textarea class="span4" name="option[<?php echo $option->id;?>]"><?php echo $value;?></textarea>
										<?php echo $required;?>
									</div>
								<?php elseif($option->type == 'droplist'):?>
									<div class="controls">
										<select name="option[<?php echo $option->id;?>]">
											<option value=""><?php echo lang('choose_option');?></option>

	<?php foreach ($option->values as $values):
		$selected	= '';
		if($value == $values->id)
		{
			$selected	= ' selected="selected"';
		}?>

		<option<?php echo $selected;?> value="<?php echo $values->id;?>">
			<?php echo($values->price != 0)?'('.Currency::format_currency($values->price).') ':''; echo $values->name;?>
		</option>

	<?php endforeach;?>
	</select>
	<?php echo $required;?>
</div>
<?php elseif($option->type == 'radiolist'):?>
<div class="controls">
	<?php foreach ($option->values as $values):

		$checked = '';
		if($value == $values->id)
		{
			$checked = ' checked="checked"';
		}?>
		<label class="radio">
			<input<?php echo $checked;?> type="radio" name="option[<?php echo $option->id;?>]" value="<?php echo $values->id;?>"/>
			<?php echo $option->name;?> <?php echo($values->price != 0)?'('.format_currency($values->price).') ':''; echo $values->name;?>
		</label>
	<?php endforeach;?>
	<?php echo $required;?>
</div>
<?php elseif($option->type == 'checklist'):
foreach ($option->values as $values):

	$checked = '';
	if(in_array($values->id, $value))
					{
						$checked = ' checked="checked"';
					}?>
					<label class="checkbox">
						<input<?php echo $checked;?> type="checkbox" name="option[<?php echo $option->id;?>][]" value="<?php echo $values->id;?>"/>
						<?php echo($values->price != 0)?'('.format_currency($values->price).') ':''; echo $values->name;?>
					</label>
				<?php endforeach ?>
				<?php echo $required;?>
			<?php endif;?>
			</div>
	<?php endforeach;?>
<?php endif;?>


<div class="submitbuttonbx" style="margin-left:100px;width:auto;">
<?php 
$customer = (array)Session::get('customer_data');  

foreach( $customer as $cust_info){
$customerDetails = (array)$cust_info;
}   
// echo '<pre>'; print_r($customerDetails); exit;

$category_name= url::to('/');
if(isset($customerDetails['f_clientid'])) { 

//$customer_poits=$this->customer_points;
if($customerDetails['f_clientid'] != 0) {  ?>
<?php if($points>0):  ?>

<?php if($product->quantity>0):?>
<button class="btn btn-primary <!--btn-large-->" id="submitbtn"   onclick="checkbutton();" type="submit" value="submit"><i class="icon-shopping-cart icon-white"></i> <?php echo 'Add Cart';?></button>
<?php endif?>
<?php else: ?>

<div class="error enough_points"><?php echo 'Enough Product Points'; ?></div>

<?php endif; ?>


<?php	}
} else { ?>
<button class="btn btn-primary <!--btn-large-->"  id="submitbtn" onclick="checkbutton();" type="submit" value="submit"><i class="icon-shopping-cart icon-white"></i> <?php echo 'Add Cart';?></button>

<?php } ?>
</div>
</div>

{{ Form::close()}}

<?php endif; ?>
</div>
</div>

 <script>
 //onclick="$(this).css('display','none');"
 function checkbutton()
 { 
     
 var qclass= $("#quantity").attr('class');
 
 if(qclass=='valid')
 $("#submitbtn").css('display','none');
 else
 {
 $("#submitbtn").css({'display':'block','margin-left':'100px','width':'auto'});
 }
 }
 function show_animation()
{      
	$('#saving_container').css('display', 'block');
	$('#saving').css('opacity', '.8');
}

function hide_animation()
{
	$('#saving_container').fadeOut('1000');
}
 </script>
 <div id="saving_container" style="display:none;">
	<div id="saving" style="background-color:#000; position:fixed; width:100%; height:100%; top:0px; left:0px;z-index:100000"></div>
	<img id="saving_animation" src="<?php echo Theme::asset()->url('img/storing_animation.gif');?>" alt="saving" style="z-index:100001; margin-left:-32px; margin-top:-32px; position:fixed; left:50%; top:50%"/>
	<div id="saving_text" style="text-align:center; width:100%; position:fixed; left:0px; top:50%; margin-top:40px; color:#fff; z-index:100001"><?php echo 'Loading';?></div>
	

     <script>
     var _gaq = [], __bc = [], push = Array.prototype.push;
     _gaq.push = function () {
         var i = 0, max = arguments.length, arg;
         while (i < max) {
           arg = arguments[i++]; push.call(_gaq, arg); push.call(__bc, arg);
         }
     };
     (function() {
         var bc = document.createElement('script'); bc.type='text/javascript'; bc.async=true;
         bc.src = 'http://ec2-174-129-103-53.compute-1.amazonaws.com:8080/embed.js';
         var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(bc, s);
     })();
</script>

<script>
    __bc.push(["_setCustomerId", "R360"]); 
</script>
<style>

.over-imbx {
width: 300px;
height: 200px;
border: 1px solid #A50032;
float: left;
margin-right: 20px;
text-align: center;
}
.yui3-dial-ring {
background: #bebdb7;
background: -moz-linear-gradient(100% 100% 135deg,#7b7a6d,#fff);
background: -webkit-gradient(linear,left top,right bottom,from(#fff),to(#7b7a6d));
box-shadow: 1px 1px 5px rgba(0,0,0,0.4) inset;
-webkit-box-shadow: 1px 1px 5px rgba(0,0,0,0.4) inset;
-moz-box-shadow: 1px 1px 5px rgba(0,0,0,0.4) inset;
}
yui3-dial-content, .yui3-dial-ring {
position: relative;
}
.yui3-dial {
zoom: 1;
}

.yui3-skin-sam .yui3-dial-handle {
background: #6c3a3a;
opacity: .3;
-moz-box-shadow: 1px 1px 1px rgba(0,0,0,0.9) inset;
cursor: pointer;
font-size: 1px;
}
.yui3-dial-handle, .yui3-dial-marker, .yui3-dial-center-button, .yui3-dial-reset-string, .yui3-dial-handle-vml, .yui3-dial-marker-vml, .yui3-dial-center-button-vml, .yui3-dial-ring-vml v\:oval, .yui3-dial-center-button-vml v\:oval {
position: absolute;
}
.yui3-skin-sam .yui3-dial-center-button {
box-shadow: -1px -1px 2px rgba(0,0,0,0.3) inset,1px 1px 2px rgba(0,0,0,0.5);
-moz-box-shadow: -1px -1px 2px rgba(0,0,0,0.3) inset,1px 1px 2px rgba(0,0,0,0.5);
background: #dddbd4;
background: -moz-radial-gradient(30% 30% 0deg,circle farthest-side,#fbfbf9 24%,#f2f0ea 41%,#d3d0c3 83%) repeat scroll 0 0 transparent;
background: -webkit-gradient(radial,15 15,15,30 30,40,from(#fbfbf9),to(#d3d0c3),color-stop(.2,#f2f0ea));
cursor: pointer;
opacity: .7;
}
</style>


<script type="text/javascript">

$(document).ready(function() {
$("#cart_product").validate({
		 rules: {
			quantity:{
			      required: true,
			      number: true,
			      min: 1,
			}
                  },
		  messages: {
			quantity:{
			      required:"Required.",
			      number: "Quantity must contain only numbers."
			      
			}
          	}

		});
	$('#quantity').keyup(function() {
	show_animation();
	$("#quantity").submit(function(e){
                alert('submit intercepted');
                //e.preventDefault(e);
                });
	var qty=$(this).val();
	
	var points=<?php echo $points; ?>;
	
	var actualpoints= points * qty;
$.post("<?php echo url::to('dynamic_esclator');?>", {points:actualpoints,customerpoints:<?php if(isset($customer_points) && $customer_points<>'') echo $customer_points; else echo 0; ?>}, function(data){
				$("#escalat").html(data);
				 hide_animation();
				});
				});
				
				$('#quantity').change(function() {
	var qty=$(this).val();
	var points=<?php echo $points; ?>;
	var actualpoints= points * qty;
$.post("<?php echo url::to('dynamic_esclator');?>", {points:actualpoints,customerpoints:<?php if(isset($customer_points) && $customer_points<>'') echo $customer_points; else echo 0; ?>}, function(data){
				$("#escalat").html(data);
				});
				});
});
</script>
