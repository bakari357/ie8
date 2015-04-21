
	<style> .error{ color:red; } </style>
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Hotels</a></li>
					<li>/</li>
					<li><a href="#">Checkout</a></li>
					<li>/</li>					
				</ul>				
			</div>
			
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
				
      
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					<span class="size16px bold dark left">
                                            <?php 
                                            $offer = Offerhelper::offer_calculate(8,round($values['amount']));
                                            if($status=='Successful') {
                                                $txt='Your payment has successfully gone through and your booking is confirmed!<br><br>
                                                   ';
                                                
                                                    $txt .='
                                                
Your order ID : '.$order_number .'
                                            &nbsp;&nbsp; Clear trip Order Id : '.$details['itinerary']['trip-ref'].'
                                            <br/><br/>'; 
                                             if(!empty($offer)){
                                                   $txt .=' <span style="color:#e20613;">You have saved ₹  '.$offer['discount_amount'].' for this order</span><br><br>';
                                                    }
                                            }
else{ $txt='Sorry! Your booking is not confirmed. Your order ID : '.$order_number.'

'; }?>
<div class="mt15" style="top: 5px;"><span class="dark"><b><?php echo $txt; ?></b></span></div></span>
					
					
					

           

					<div class="clearfix"></div><div class="line4"></div>
					
<div class="col-md-12"> 

<div class="mt15"><span class="dark">
						 <?php echo $values['title'];?>  <?php echo $values['firstname'];?>  <?php echo $values['lastname'];?><br><br> Email : <?php echo $values['email'] ;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phone number : <?php  echo $values['mobile'];?></span></div>  <br> <br><span class="dark"> Address : <?php echo $values['address'] .', '. $values['citys'].'-'.$values['postal'].'</span>';   ?>
						

					</div>
					
					
					<div class="clearfix"></div>
					<div class="line4"></div>
<div class="col-md-12">		
					<div class="col-md-4">
						<span class="dark">First Name</span><span class="red">*</span>
						<?php echo $values['first_name']; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $values['first_name']; ?>">
					</div>
					<div class="col-md-4 textleft">
					<span class="dark">Last Name</span><span class="red">*</span>
						<?php echo $values['last_name']; ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $values['last_name']; ?>">
					</div>
					</div>
					<div class="col-md-12">
					
					
					
					<div class="col-md-8">
						<div class="mt15"><span class="dark">Email Address:</span><span class="red">*</span><?php echo $values['s_email']; ?></div>
					</div></div><br><br><br>
					
					

						<div class=" col-md-12" ><div class="col-md-8"><div class="mt15"><span class="dark">Preferred Phone Number:</span><span class="red">*</span><?php echo $values['mobile']; ?></div></div></div>
					
					
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address).<br/> 
					
					
					<div class='line4'></div><div class='alert alert-info'>	<b><span class='attention'>Attention!</span><span class='attention_sub'> Please read important hotel booking information!:</span></b><br/><br/>
					<p class='size12' style='font-size: 13px'>• This ticket is booked though our partner Cleartrip.</p>
					<p class='size12' style='font-size: 13px;'>• For any query and/or activity related to the service and/or modification and cancellation, please contact Cleartrip at agencysupport@cleartrip.com, 1860 233 5000 and +91 22 40554955. Refund on hotel booking will be as per the hotel rules.</p>
					<p class='size12' style='font-size: 13px;'>• All bookings, modifications and cancellations are subject to Partner terms and conditions. </p>
					<p class='size12' style='font-size: 13px;'>• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side.</p>
					
<p class='size12' style='font-size: 13px'>• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
					</div>	<br>
					

				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
			<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						
						<span class="opensans size18 dark bold"><?php echo $values['hotel_name']; ?></span><br>
						<br><span class="opensans size13 grey" style="margin-left: 73px;"><?php if(isset($values['hotel_address'])) echo $values['hotel_address']; ?></span><br/>
						
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							<tr>
								<td colspan=2><span class="dark">Number of Room </span></td><td> <?php echo $values['number_rooms']; ?></td>
							</tr>
							
							<tr>
								<td colspan=2><span class="dark"> Nights</span></td><td> <?php echo $check_in = date('M d',strtotime($values['check_in_date'])); ?> - <?php echo $check_out = date('M d',strtotime($values['check_out_date'])); ?></td>
							</tr>
							
						<tr>
								<td colspan=2><span class="dark">Pay by cash</span>
</td><td> &#x20b9  <?php echo round($values['amount']); ?> </td>
							</tr>
						</table>
					</div>	
					<div class="line3"></div>
					
                                        <div class="padding20">					
						<span class="left size14 dark" style="font-weight:normal;">Total</span>
                                                <span id="priceloader" style="margin-left:10px;" ></span>
						<span  class="right" style="text-align: right;font-weight:normal;" >₹ 
                                                   <?php echo round($values['amount']); ?>
                                                <br/>
                                                
                                                 <font  size="1" color="grey">( Inclusive Tax )</font>
                                                </span>
                                                
                                               
					</div>
                                        <?php 
                                        
                                            
                                        
                                        if(!empty($offer)){ ?>
                                        <div class="padding20">					
                                        <span class="left size14 dark">SmartBuy Exclusive Offer</span>

                                        <span class="right" style="text-align:right;color:#e20613;"> ₹ <?php echo $offer['discount_amount'];?> </span>

                                        </div>
                                        
                                        <div class="padding20" >					
					<span class="left size14 dark">Amount Paid</span>
	
<span class="right" style="text-align:right;">₹ <?php echo round(round($values['amount']) - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                        <?php } ?>
                                        

				</div><br/>	
				
				<br/>
					</div>
				</div><br/>
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
<?php Cart::destroy(); ?>		
