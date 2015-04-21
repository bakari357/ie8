
	<style> .error{ color:red; } </style>
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
			
				
      
			<!-- LEFT CONTENT --->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
			<div class="mt15"><span class="dark"><b> <?php if(isset($status) && $status =='Successful'){ 
			foreach (Cart::content() as $key=>$item)
			{

			$saved_amount =  $item['options']['offer_amount'];
			}
			
			echo ' Your payment has successfully gone through and your booking is confirmed! <br><br> Your order ID : '.$order_number.'

'; if(isset($saved_amount) && $saved_amount !='') $msg.=' <br><br><font style="color:#e20613;"> You have saved ₹  '.$saved_amount.' for this order.</font>';}else{ echo  ' Sorry! Your booking is not confirmed. Your order ID : '.$order_number.'

';; }?> </b></span></div></span>
<div class="mt15"><span class="dcheck_in ark"><b></b></span></div></span>
					<div class="roundstep active right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					

					<div class="col-md-6 textright" style="text-align: left;">
						<div class="mt15"><span class="dark" style="float: left;">First Name: </span> <?php echo ucfirst($input->Posted->first_name); ?></div>
					</div>
<div class="col-md-6 textright">
						<div class="mt15" style="float: left;
margin-left: -25px;"><span class="dark">Last Name: </span> <?php echo ucfirst($input->Posted->last_name); ?></div>
					</div>
					</br></br>
					<div class="col-md-6 textright">
						<div class="mt15" style="float: left;"><span class="dark">Email Address: </span> <?php echo $input->Posted->s_email; ?></div>
					</div>
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div>
					
					

					<br/>
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address).<br/> 
					
					<br/>
					<br/>
					<br/>
					
					
					<div class="clearfix"></div>
					<div class="line4"></div>		
					
					<div class="alert alert-info" style="color:#3a87ad;margin-top: 25px;margin-bottom: 20px;margin-left: 1%;text-shadow: 0 1px 0 rgba(255,255,255,0.5);background-color: #EBF2F7;border: 1px solid #2296EA;
               -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;padding: 8px 15px 8px 14px;position: relative;width: 98%;border: teal;background-color: #d9edf7;border-color: #bce8f1; float:left; margin-left:2px">
               <b><font color=red>Attention!</font><font color=#ffbf00> Please read important Movie ticket information!</font>	</b><br/><br/>
               <p class="size12" style="font-size: 13px">• This ticket is booked through our partner Cinepolis.</p>
               <p class="size12" style="font-size: 13px;">• For all queries and/or activities related to booking, please contact us at support@smartbuy.com and  1860 425 3322.</p>
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
			
//$produ=$produs['options']['apiproduct']['Posted']; 

$produ = (array)$input->Posted;  

//echo '<pre>'; print_r($produ); exit;?>
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<span class="opensans size18 dark bold"><?php  if(isset($produ['moviename'])) echo $produ['moviename']; ?></span><br/>
						<span class="opensans size13 grey"> <?php  echo date('D, d M Y',strtotime($produ['showtime'])); ?></span><br/>
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							<tr>
								<td>Class</td>
								<td class="center"><?php if(isset($produ['selectedclass']) ) echo $produ['selectedclass'];?></td>
							</tr>
							<tr>
								<td>Quantity</td>
								<td class="center"><?php if(isset($produ['QTY']) ) echo $produ['QTY'];?></td>
							</tr>
							<tr>
								<td>Show Time</td>
								<td class="center "><?php  if(isset($produ['showtime'])) echo $produ['showtime'] ; ?></td>
							</tr>
						<!--	<tr>
								<td>Finish Time</td>
								<td class="center "><?php  if(isset($produ['FinishTime'])) echo $produ['FinishTime'] ; ?></td>
							</tr> -->
							<tr>
								<td>Ticket Price</td>
								<td class="center "><?php if(isset($produ['amount'])) echo round($produ['amount'] ) ;  ?> </td>
							</tr>
							<!--<tr>
								<td>Tax</td>
								<td class="center "><?php  if(isset($movie_details['ServiceFee'])) echo $movie_details['ServiceFee'] ; ?></td>
							</tr>-->
							<!--<tr>
								<td>Service fee</td>
								<td class="center ">1.24</td>
							</tr>-->
						</table>
					</div>	
					<div class="line3"></div>
 <div class="line3"></div>
         <div class="padding20">
            <span class="left "  style="width: 120px;">Booking Total: <span style="font-size:10px"></br> <span class="red"></span> </span></span>
            <div class="right "> <div style ="float:left"> &#x20b9; </div><div id="Total_Amount2" class="right " style="margin-left: 7px;width: 50px;" ><?php echo round($produ['amount']);?></div>
            <div class="clearfix"></div>
            <span style="font-size:10px"> <span class="red"></span>(Inclusive Tax) </span>
            </div>
			
				


				</div><br/>	
				<?php  $offer = Offerhelper::offer_calculate(2,round($produ['amount'])); if(!empty($offer)){ ?>
					<div class="padding20">					
					<span class="left "> SmartBuy Exclusive Offer:</span>

<span class="right" style="margin-left: 7px;width: 58px; color:#e20613;"> ₹ <?php echo $offer['discount_amount'];?> </span>
						
					</div>
					
					<div class="padding20">					
					<span class="left"> Amount Paid:</span>
	
<span class="right" style="margin-left: 7px;width: 58px;">₹ <?php echo round(round($produ['amount']) - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                      <?php } ?>	
<?php endforeach; ?>				
				<br/>
					</div>
				</div><br/>
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
<?php Cart::destroy(); ?>		
