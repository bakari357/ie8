<?php 

$output_status=(array)$output;

?>
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					 <li><?php echo HTML::link('cinemas', 'Movies'); ?></li>
					
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
					
					<div class="mt15"><span class="dark"><b> <?php if(isset($status) && $status =='Successful'){ 
					 foreach (Cart::content() as $key=>$item)
                                           {
                        
                                           $saved_amount =  $item['options']['offer_amount'];
                                           }
					
					echo ' Your payment has successfully gone through and your purchage  is confirmed! <br><br> Order Number : '.$order_number.'

'; if(isset($saved_amount) && $saved_amount !='') $msg.=' <br><br> You have saved ₹  '.$saved_amount.' for this order'; }else{ echo  ' Sorry! Your booking is not confirmed. <br><br> Order Number: '.$order_number.'

'; }?> </b></span></div></span>
					
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					<?php if(isset($payment['description'])):?>
	<div class="span4">
		<h3 class="cndetail"><?php echo Lang::get('common.payment_information');?></h3>
		<?php if(isset($payment['description']) && $payment['description']<>'') {echo $payment['description'];} else {echo "Points";}?>
	</div>
	<?php endif ?>
					
					<div class="clearfix"></div>

					<div class="col-md-6 textright" style="text-align: left;">
						<div class="mt15"><span class="dark" style="float: left;">First Name: </span> &nbsp;&nbsp;<?php echo ucfirst($input->Posted->first_name); ?></div>
					</div>
<div class="col-md-6 textright">
						<div class="mt15" style="float: left;
margin-left: -25px;"><span class="dark">Last Name: </span> &nbsp;&nbsp;<?php echo ucfirst($input->Posted->last_name); ?></div>
					</div>
					</br></br>
					<div class="col-md-6 textright">
						<div class="mt15" style="float: left;"><span class="dark">Email Address: </span> &nbsp;&nbsp;<?php echo $input->Posted->s_email; ?></div>
					</div>
<div class="col-md-10 textright"><br>
						<div class="mt15" style="float: left;"><span class="dark">Preferred Phone Number:</span>&nbsp;&nbsp;<span> <?php echo $input->Posted->mobile; ?></span></div>
					</div>
					<div class="col-md-4 ">
						<div class="mt15"><span class="dark"></span></div><input type="hidden" name="s_email" value="" >
					</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					
					<div style="color: #3a87ad; background-color: #d9edf7; border-color: #bce8f1;padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
               <b> <span class="attention"> Attention!</span><span class="attention_sub"> Please read important movie ticket information!</span></b><br/><br/>
               <p class="size12" style="font-size: 13px">• This ticket is booked through our partner Funcinemas.</p>
                <p class="size12" style="font-size: 13px;">• For all queries and/or activities related to booking, please contact us at support@smartbuy.com and 1860 425 3322.</p>
               <p class="size12" style="font-size: 13px;">• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>
               <p class="size12" style="font-size: 13px;">• All bookings are subject to Partner terms and conditions.</p>
               <p class="size12" style="font-size: 13px;">• Movie tickets booked through the portal cannot be cancelled or modified.</p>
              <p class="size12" style="font-size: 13px;">• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
            </div>	<br>
					

					
					<br/>
					<br/>
					



						
					
			
				

				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
<br/>
				
			<?php foreach (Cart::content() as $cartkey=>$produs):
			
$produ=$produs['options']['apiproduct']['Posted']; 


//echo '<pre>'; print_r($produ); exit;?>
				<div class="pagecontainer2 paymentbox grey" style="margin-top: -20px;">
					<div class="padding30">
						<span class="opensans size18 dark bold"><?php  if(isset($produ['Movie'])) echo $produ['Movie']; ?></span><br/>
						<span class="opensans size13 grey"> <?php  echo date('D, d M Y',strtotime($produ['ShowTime'])); ?></span><br/>
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							<tr>
								<td class="dark">Class</td>
								<td><?php if(isset($produ['Class']) ) echo $produ['Class'];?></td>
							</tr>
							<tr>
								<td class="dark">Quantity</td>
								<td><?php if(isset($produ['QTY']) ) echo $produ['QTY'];?></td>
							</tr>
							<tr>
								<td class="dark">Show Time</td>
								<td><?php  if(isset($produ['ShowTime'])) echo $produ['ShowTime'] ; ?></td>
							</tr>
							<tr>
								<td class="dark" >Finish Time</td>
								<td><?php  if(isset($produ['FinishTime'])) echo $produ['FinishTime'] ; ?></td>
							</tr>
							<tr>
								<td class="dark">Ticket Price</td>
								<td> &#x20b9 <?php echo round($produ['amount']);  ?> </td>
							</tr>
							<!--<tr>
								<td>Tax</td>
								<td class="center green bold"><?php  if(isset($movie_details['ServiceFee'])) echo $movie_details['ServiceFee'] ; ?></td>
							</tr>-->
							<!--<tr>
								<td>Service fee</td>
								<td class="center green bold">1.24</td>
							</tr>-->
						</table>
					</div>	
					<div class="line3"></div>
				<div class="padding20" style="padding-bottom: 40px;">									
			<span class="left size14">Total:</span>
			
<span class="right size14">&#x20b9; <?php  echo  round($produ['amount']);?> </span>

						
						</div>
						
			<?php  $offer = Offerhelper::offer_calculate(3,round($produ['amount'])); if(!empty($offer)){ ?>
					<div class="padding20">					
					<span class="left size14">Exclusive Offer:</span>

<span class="right lred2 size14"> &#x20b9; <?php echo $offer['discount_amount'];?> </span>
						
					</div>
					
					<div class="padding20">					
					<span class="left size14"> Amount Paid:</span>
	
<span class="right size14">&#x20b9; <?php echo round(round($produ['amount']) - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                      <?php } ?>

	


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
