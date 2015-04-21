<style> 
.login{
 color: #333333 !important; 
 font-size:24px !important; 
 width: auto !important; 
 font-family: "Open Sans" !important;
 margin-top: 14px !important; 
 padding: aas !important;  
 float: none !important; 
}
</style>
<link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css"> 	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					 <li><?php echo HTML::link('cinemas', 'Movies'); ?></li>
					<li>/</li>
					<li><a href="#">Summary</a></li>
					
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
			<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>" onsubmit="return term_condition();">			
  <input type="hidden" name="BookingId" id="BookingId" value="<?php echo $BookingId; ?>" />
    <input type="hidden" name="seatcount" id="seatcount" value="0" />
      <input name="seats" type="hidden" id="seats" />
      <input type="hidden" id="pid" name="pid" value="10" />
      <input type="hidden" id="convfee" name="convfee" />
 <input type="hidden" id="ptype" name="ptype" value="<?php echo $ptype ;?>" />
<input type="hidden" id="selectedclass" name="selectedclass" value="<?php echo $selectedclass; ?>" />

 <input type="hidden" id="amount" name="amount" value="<?php echo $post['totalamount'] ;?>" />
    <input type="hidden" id="servicetax" name="servicetax" />
    <input type="hidden" id="totalamount" name="totalamount" />
   <input type="hidden" value="23" name="pid" id="pid" />
   <input name="ctype" type="hidden" id="ctype" value="movie1" />
  <input type="hidden" id="moviename" name="moviename"  value="<?php echo $moviename; ?>"/>
   <input type="hidden" value="<?php echo $ScreenId ;?>" name="ScreenId" id="ScreenId" />
   <input name="filmid" type="hidden" id="filmid" value="<?php echo $filmid;?>" />
    <input name="theatreid" type="hidden" id="theatreid" value="<?php echo $theatreid;?>" />
      <input name="QTY" type="hidden" id="QTY" value="<?php echo $QTY;?>"/>
    <input name="showtime" type="hidden" id="showtime" value="<?php echo $showtime;?>" />
      <input name="showdate" type="hidden" id="showdate" value="<?php echo $showdate;?>"/>
<input type="hidden" id="centername" name="centername"  value="<?php echo $city; ?>"/>
 
   

		<?php		if(isset($responseseats['seatlist']['ShowSeatsResult']['TicketRate']) && !empty($responseseats['seatlist']['ShowSeatsResult']['TicketRate'])) ?>
					<!-- End of seat layout -->
				
					


<span class="size16px bold dark left">Where can we reach you?</span>
					<div class="roundstep right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					<div class="col-md-4">
						<span class="dark">First Name:</span>
						&nbsp;&nbsp;<?php echo $post['first_name']; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $post['first_name']; ?>">
					</div>
					<div class="col-md-4 textleft">
					<span class="dark">Last Name:</span>
						&nbsp;&nbsp;<?php echo ucfirst($post['last_name']); ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $post['last_name']; ?>">
					</div>
					
					<div>
					
					
					
					<div class="col-md-8 textright">
						<div class="mt15"><span class="dark" style="float: left;">Email Address:</span><span style="float: left;"> &nbsp;&nbsp;<?php echo $post['s_email']; ?><span></div>
					</div>
					<div class="col-md-4">
						<input type="hidden" name="s_email" class="form-control margtop10" placeholder="" value="<?php echo $post['s_email']; ?>">
					</div>
<div class="col-md-10 textright"><br>
						<div class="mt15" style="float: left;"><span class="dark">Preferred Phone Number:</span>&nbsp;&nbsp;<span> <?php echo $post['mobile']; ?></span></div>
					</div>
					<div class="col-md-4">
						<input style="width:20%;position: absolute;" type="hidden" readonly value="91" class="form-control"/><input type="hidden" name = "mobile" class="form-control" placeholder="" value="<?php echo $post['mobile']; ?>" >
					</div></div>
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div><br><br>
( All email notifications will be sent to the above address).<br/> <br/>

	
					<span class="size16px bold dark left">Review and book your movie ticket.</span>
					<div class="roundstep right">2</div>
					<div class="clearfix"></div>
					<div class="line4"></div><div class="alert alert-info" style="color:#3a87ad;margin-top: 25px;margin-bottom: 20px;margin-left: 1%;text-shadow: 0 1px 0 rgba(255,255,255,0.5);background-color: #EBF2F7;border: 1px solid #2296EA;
-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;padding: 8px 15px 8px 14px;position: relative;width: 98%;border: teal;background-color: #d9edf7;border-color: #bce8f1;">	<b> <span class="attention">Attention!</span><span class="attention_sub"> Please read important movie ticket information!<span></b><br/><br/>
					<p class="size12" style="font-size: 13px">• This ticket is booked though our partner Cinepolis.</p>
					<p class="size12" style="font-size: 13px;">• For all queries and/or activities related to booking, please contact us at support@smartbuy.com and  1860 425 3322.</p>
<p class="size12" style="font-size: 13px;">• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>
<p class="size12" style="font-size: 13px;">• All bookings are subject to Partner terms and conditions.</p>
<p class="size12" style="font-size: 13px;">• Movie tickets booked through the portal cannot be cancelled or modified.</p>


					</div>		
					<input type="checkbox" name="check_term" id="check_term" value="2" checked/>You have accepted the <?php echo HTML::link('content/Terms & Conditions', 'Terms & conditions ',array('target'=>'_blank')); ?> 
					
					<div id="term_error"></div>

			<?php			   
					$offer = Offerhelper::offer_calculate(2,$post['totalamount']); 
					 
					$check_data=array(
							   'amount'=>round(round($post['totalamount']) -  $offer['discount_amount']),
                                                           'book'=>'Movie Ticket',	
							   'cash'=>0,
							   'ctype'=>'movie2',
							   'emi_data'=>$emi_data,
							   'interest'=>$interest,
							   'form_option'=>0
							   );
						
					$view = View::make('payment_form',$check_data);
					echo $view;
					?>			
				  <br>

                                       <br>
	
					<div class="clearfix"></div>
				
				
					<div>
		
			
				</div></div></div>
		
			
			<!-- END OF LEFT CONTENT -->			

			<!-- END OF LEFT CONTENT -->		
		<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<span class="opensans size18 dark bold"><?php  if(isset($moviename)) echo $moviename; ?></span><br/>
						<span class="opensans size13 grey"> <?php  echo date('D, d M Y',strtotime($showdate)); ?>, Cinepolis - <?php echo $city;?> , <?php echo  $ScreenId ;?></span><br/>
					</div>
					<div class="line3"></div>
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							<tr><td>
               			<?php if($QTY>1){?>Tickets<?php } else {?>Ticket <?php } ?></td><td class="center"> <?php if(isset($QTY) ) echo $QTY;?></td>
							<tr><td>Class</td>
							<td class="center"><?php  if(isset($selectedclass) ) if($selectedclass=='VP') echo 'Vip'.''.'  Class';
 else if($selectedclass=='PR') echo 'Premium'.''.'  Class' ;
 else if($selectedclass=='NL') echo 'Normal'.''.'  Class';
 else if($selectedclass=='EX') echo 'Executive'.''.'  Class';?>
	</tr>						
							<tr>
								<td>Show Date</td>
								<td class="center"><?php  if(isset($showdate)) echo $showdate ; ?></td>
							</tr>

							<tr>
								<td>Show Time</td>
								<td class="center"><?php  if(isset($showtime)) echo $showtime ; ?></td>
							</tr>
							<!--<tr>
								<td >Ticket</td>
								<td> <?php  if(isset($check_data['amount'])) echo $check_data['amount'] ; ?></td>
							</tr>
							<!--<tr>
								<td colspan=2>Service fee</td>
								<td>1.24</td> 
								
							</tr>-->
						</table>
					</div>		
					<div class="line3"></div>
					
					
					<div class="padding30">
                                        <span class="left size14 dark"  style="color:#e20613;width: 120px;">Booking Total: <span style="font-size:10px"></br> <span class="red"></span> </span></span>
                                        <div class="right  bold size18"> <div style ="float:left"> &#8377; </div><div id="Total_Amount2" class="right bold size18" style="margin-left: 7px;width: 50px;" ><?php echo round($post['totalamount']) ;?></div>
                                        <div class="clearfix"></div>
                                        <span style="font-size:10px"> <span class="red"></span>(Inclusive Tax) </span>
                                        </div>
                                        </span>
                                       
                                        </div>
<?php  if(!empty($offer)){ ?>
					<div class="padding30">					
					<span class="left size14 dark">Exclusive Offer:</span>
	
<span class="right bold size18" style="margin-left: 6px;width: 58px;"> ₹ <?php echo $offer['discount_amount'];?> </span>						
					</div>
					
					<div class="padding30">					
					<span class="left size14 dark">Payable Amount:</span>
	
<span class="right lred2 bold size18" style="margin-left: 6px;width: 58px;">₹ <?php echo round($post['totalamount'] - $offer['discount_amount']);?> </span>
	
	
						<div class="clearfix"></div>
					</div>
<?php } ?>
<div class="clearfix"></div>
				</div><br/>
				
				<?php 
			$login=Session::get('customer_data'); if(!$login){
 echo Form::open(array("id"=>"form-login","role"=>"form",'method'=>'post','onsubmit' => 'return validateForm();', 'action'=>'Login@checkout_login')); ?>		
				<div class="pagecontainer2 loginbox">
					<div class="cpadding1">
					
						<span class="icon-lockk"></span>
						
						<h3 class="opensans login">Log in</h3></br></br>
						<font color="red" style="margin-top: -28px;margin-left: 2px;position: absolute;"><?php echo $validation; ?> </font>
						<input type="text" class="form-control logpadding" name="email" placeholder="Username">
						<br/>
						<input type="password" class="form-control logpadding" name="password" placeholder="Password">
						<div class="margtop20">
							
							<div class="right">
								<button class="btn-search5" type="submit" onclick="errorMessage()">Login</button>	
							</div>
						</div>
						<div class="clearfix"></div><br/>
					</div>
				</div><br/>
			</form>
			<?php } ?>
				
				
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	

	</form>
	
<script>
$(document).ready(function() {
$('.emi_details').hide();
		$('.payment').change(function() {
			
			var paytype=$('input[name=payment]:checked', '#passenger_checkout').val()
			console.log(paytype);
			if(paytype==3)
			{
				$('.emi_details').show();
				$('.emi_showup').hide();
				$('.emi').prop('checked', false);
			}
			else
			{
			  $('.emi_details').hide();
			}
		});

		$('.emi').change(function() {


				if($(".emi").is(':checked'))
				{
				$('.emi_showup').show();

				}
				else
				{
				$('.emi_showup').hide();
				}



		});});
</script>

	
