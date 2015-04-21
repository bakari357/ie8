<?php 

//$customer=(array)$product_input; 
//$customer_output=(array)$product_output;
//$output_status=(array)$output;

?>
	<style> .error{ color:red; } </style>
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><?php echo HTML::link('allmusic', 'Music'); ?></li>
					<li>/</li>
					<li><a href="#">Confirmation</a></li>
					<li>/</li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
				
      
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					<?php
					   foreach (Cart::content() as $key=>$item){$saved_amount =  $item['options']['offer_amount']; }
					 $stat['Successful'] = 'Your payment has successfully gone through and your booking is confirmed!</br>';
					 $stat['Approved'] = 'Your payment has successfully gone through and your purchage  is confirmed!';
					$stat['Declined'] = 'Sorry! Your payment did not go through. Please check your card details and balance and try again.'; 
					$stat['Failed'] = 'Sorry! Your Order is not confirmed.'; ?>
					 
<div class="mt15"><span class="dark"><b><?php echo $stat[$status].'</br>'; echo Lang::get('common.order_number');?>: <?php  echo $order_number;if(isset($saved_amount) && $saved_amount !='') {
if(isset($status) && $status=="Successful")
{
 echo $msg=' </br> </br><font style="color:#e20613;">You have saved ₹  '.$saved_amount.' for this order.</font></br>'; }?>
 <?php } ?></b></span></div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					<div class="clearfix"></div>
					<br/>
					



<span class="size16px bold dark left">Customer Details
</span>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					
					<div class="col-md-4">
						<span class="dark">First Name:</span>
						&nbsp;&nbsp;<?php echo @$input->Posted->first_name; ?>
					</div>
					<div class="col-md-4 textleft">
					<span class="dark">Last Name:</span>
						&nbsp;&nbsp;<?php echo @$input->Posted->last_name; ?>
					</div>
					
					
					<div class="col-md-6 textright">
						<div class="mt15" style="float: left;"><span class="dark">Email Address: </span> <?php echo @$input->Posted->s_email; ?> </div>
					</div>
					<div class="col-md-4 textleft">
						<div class="mt15 pull-right"><span class="dark" >
							<?php if(isset($download_section) && $download_section<>''){ ?>
					<a style="color:#004387;font-weight:bold;" href="<?php if(isset($download_section)) echo $download_section; ?>"><?php if(isset($download_section)) { ?> Download Your Song Here <?php } ?> </a> <?php } ?>
						
						</span></div>
					</div>
					</br></br>
					
					
					<div class="clearfix"></div>
					
					
<div class="line4"></div>		
					
					 <div class="alert alert-info">
            <b> <span class="attention"> Attention!</span><span class="attention_sub">Please read important music information!</span></b><br/><br/>
            <p class="size12" style="font-size: 13px">• This song is purchased/ downloaded thorugh our partner Hungama.</p>
            <p class="size12" style="font-size: 13px;">• For all queries and/or activities related to music downloads, please contact us at support@smartbuy.com and  1860 425 3322.</p>
            <p class="size12" style="font-size: 13px;">• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>
            <p class="size12" style="font-size: 13px;">• All song downloads are subject to Partner terms and conditions.</p>
            <p class="size12" style="font-size: 13px;">• Songs downloaded through the portal cannot be modified or cancelled.</p>
           <p class="size12" style="font-size: 13px;">• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
         </div>
					



						
					
			
				

				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4 musicdetails" >
			<?php foreach (Cart::content() as $cartkey=>$produs):
$produ=$produs['options']['apiproduct']['Posted']; 

$str=base64_decode($produ['music_details']);
			$music=explode('|',$str);?>
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<img src="<?php echo $music[3];?>" style="width: 69px;" class="left margright20" alt=""/>
						<span class="opensans size18 dark bold"><?php echo $music[2];?></span><br/><span class="opensans size13 grey"><?php echo $music[1];?></span><br/>
						
						
					</div>
					<div class="line3"></div>

		                               <div class="padding20" style="padding-bottom: 40px;">					
						<span class="left size14 ">Total:</span>
						<span class="right">&#x20b9; <?php echo $produ['amount']; ?></span>


						
					</div>
					<?php $offer = Offerhelper::offer_calculate(1,$produ['amount']); if(!empty($offer)){ ?>
					<div class="padding20" style="padding-bottom: 40px;">					
					<span class="left size14 ">Exclusive Offer:</span>

<span class="right " style="color:#e20613;" > &#x20b9; <?php echo $offer['discount_amount'];?> </span>
						
					</div>
					
					<div class="padding20" style="padding-bottom: 40px;">					
					<span class="left "> Amount Paid:</span>
	
<span  class="right" style="text-align: right;">&#x20b9; <?php echo round($produ['amount'] - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                      <?php } ?>
			
<div class="clearfix"></div>
				</div><br/>	
<?php endforeach; ?>				
				<br/>
					</div>
				</div><br/>
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
<?php Cart::destroy(); ?>	
