<?php 

$output_status=(array)$output;

?>
	<style> .error{ color:red; } </style>
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Movies</a></li>
					<li>/</li>
					<li><a href="#">Checkout</a></li>
					<li>/</li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
				
      
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					
					<div class="mt15"><span class="dark"><b> <?php if(isset($status) && $status =='Successful'){ echo ' Your payment has successfully gone through and your booking is confirmed! <br><br> Your order ID : '.$order_number.'

';}else{ echo  ' Sorry! Your booking is not confirmed. Your order ID : '.$order_number.'

';; }?> </b></span></div></span>
					
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					<?php if(isset($payment['description'])):?>
	<div class="span4">
		<h3 class="cndetail"><?php echo Lang::get('common.payment_information');?></h3>
		<?php if(isset($payment['description']) && $payment['description']<>'') {echo $payment['description'];} else {echo "Points";}?>
	</div>
	<?php endif ?>
					
					<div class="clearfix"></div>

					

					
					
					
					<br/>
					




							
	
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
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div>
					
					

					<br/>
					
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address).<br/> 
					
					<br/>
					
					
					
					<div class="clearfix"></div>
					<div class="line4"></div>		
					
					<div class="alert alert-info">
					<b>Attention! Please read important information!</b></br></br>
<p class="size12" style="font-size: 13px;">• This movie hotel is being booked though <?php echo $input->Posted->partner; ?></p>
<p class="size12" style="font-size: 13px;">• For queries related to booking and payment, please email support@smartbuy.com or call 1800-0000-000.</p>
<p class="size12" style="font-size: 13px;">• The movie ticket once booked cannot be modified or cancelled.</p>

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
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<span class="opensans size18 dark bold"><?php  if(isset($produ['Movie'])) echo $produ['Movie']; ?></span><br/>
						<span class="opensans size13 grey"> <?php  echo date('D, d M Y',strtotime($produ['ShowTime'])); ?></span><br/>
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							<tr>
								<td>Class</td>
								<td class="center green bold"><?php if(isset($produ['Class']) ) echo $produ['Class'];?></td>
							</tr>
							<tr>
								<td>QTY</td>
								<td class="center green bold"><?php if(isset($produ['QTY']) ) echo $produ['QTY'];?></td>
							</tr>
							<tr>
								<td>Show Time</td>
								<td class="center green bold"><?php  if(isset($produ['ShowTime'])) echo $produ['ShowTime'] ; ?></td>
							</tr>
							<tr>
								<td>Finish Time</td>
								<td class="center green bold"><?php  if(isset($produ['FinishTime'])) echo $produ['FinishTime'] ; ?></td>
							</tr>
							<tr>
								<td>Ticket Price</td>
								<td class="center green bold"> &#8377 <?php echo round($produ['amount'] ) ;  ?> </td>
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
					<div class="padding30">					
					


						<div class="clearfix"></div>
					</div>

	<div class="padding30">					
						<span class="left size14 dark">Cash:</span>
					<span class="right lred2 bold size18">&#8377 <?php if(isset($produ['amount'])) 
					echo round($produ['amount'] ) ;  ?></span>


						<div class="clearfix"></div>
					</div>


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
	

