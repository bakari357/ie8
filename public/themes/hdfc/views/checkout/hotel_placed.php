<?php $check_in=date('m/d/Y',strtotime(str_replace('/','-',$values['check_in'])));
	$check_out=date('m/d/Y',strtotime(str_replace('/','-',$values['check_out'])));
		$values['check_in']=date('m/d/Y',strtotime(str_replace('-','/',$check_in)));
		$values['check_out']=date('m/d/Y',strtotime(str_replace('-','/',$check_out))); ?>
	<style> .error{ color:red; } </style>
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="Hotels" class="active">Hotels</a></li>
					<li>/</li>
					<li><a href="#">Confirmation</a></li>
					<li>/</li>					
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		<div class="clearfix"></div>
		<!--<div class="brlines"></div>-->
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container  offset-0">
			
				
      
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					<span class="size16px dark left"><?php if($status=='Successful') { $txt='<span class="dark"><b>   Your payment has successfully gone through and your booking is confirmed! <br><br> Your order ID : '.$order_number.'

&nbsp;&nbsp; Expedia Order Id : '.$rm_details['HotelRoomReservationResponse']['itineraryId'].'</b></span></br>

<span class="size14" >Note: Payment Made in full.    </span></br></br>



'; }else{ $txt='<span class="dark"><b>Sorry! Your booking is not confirmed. Your order ID : '.$order_number.'

</b></span>'; }?>
<div class="mt15"><?php echo $txt; ?></div></span>
					
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					<?php for( $i=1;$i<=$values['num_rooms'];$i++) { ?>

           <b>Room <?php echo $i; ?> Details
  </b>
<div class="clearfix"></div>
					
					<div class="col-md-12">
						
					</div>
<div class="col-md-12"> 

<div class="mt15">
						 <?php if($values['title'.$i.'']==1) { $title='Mr';}elseif($values['title'.$i.'']==2){ $title='Mrs'; }else{  $title='Miss'; }?> <span class="dark">  <?php echo $title;?>  <?php echo $values['firstName'.$i.''];?>  <?php echo $values['lastName'.$i.''];?></span><br><br> <span class="dark">Bed Type :  </span> <?php if($values['bedTypeId'.$i.'']==14){ $bed="14 : 1 King"; }else{ $bed="18 : 1 Twin"; } echo $bed;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dark"> Smoking Preference : </span><?php if($values['smokingPreference'.$i.'']=='S'){ $somke='Smoking'; }else{ $somke='No Smoking';  } echo $somke;?></div>  <br><br> <span class="dark">Special requests : </span><?php if(empty($values['specialrequests'.$i.''])){ echo 'None'; }else{ echo $values['specialrequests'.$i.'']; }  ?>
						

					</div>
					
					<div class="clearfix"></div>
<?php if($values['num_rooms']!=1) { ?>
<div class="line4"></div>
<?php  } }  ?>
					
					
					
					<br/>
					




					<div class="clearfix"></div>
					<div class="line4"></div>		
					<div class="col-md-4">
						<span class="dark">First Name:</span>
						&nbsp;&nbsp;<?php echo $values['first_name']; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $values['first_name']; ?>">
					</div>
					<div class="col-md-4 textleft">
					<span class="dark">Last Name:</span>
						&nbsp;&nbsp;<?php echo $values['last_name']; ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $values['last_name']; ?>">
					</div>
					
					<div>
					
					
					
					<div class="col-md-8 textright">
						<div class="mt15"><span class="dark" style="float: left;">Email Address:</span><span style="float: left;"> &nbsp;&nbsp;<?php echo $values['s_email']; ?><span></div>
					</div>
					<div class="col-md-4">
						<input type="hidden" name="s_email" class="form-control margtop10" placeholder="" value="<?php echo $values['s_email']; ?>">
					</div>
<div class="col-md-10 textright"><br>
						<div class="mt15" style="float: left;"><span class="dark">Preferred Phone Number:</span>&nbsp;&nbsp;<span> <?php echo $values['mobile']; ?></span></div>
					</div>
					<div class="col-md-4">
						<input style="width:20%;position: absolute;" type="hidden" readonly value="91" class="form-control"/><input type="hidden" name = "mobile" class="form-control" placeholder="" value="<?php echo $values['mobile']; ?>" >
					</div></div>
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address).<br/> 
					
					<br/>
					
					
					
					<div class="clearfix"></div>
					<div class="line4"></div>		
					
					<div class="alert alert-info">
					<b><span class='attention'>Attention!</span><span class='attention_sub'> Please read important hotel ticket information!:</span></b><br/><br/>
					<p class="size12" style="font-size: 13px;">• This hotel is booked through our partner Expedia</p>
<p class="size12" style="font-size: 13px;">• For all queries and/or activities related to booking, please contact us at support@smartbuy.com and 1860 425 3322. Refund on hotel booking will be as per the hotel rules.</p>
<p class="size12" style="font-size: 13px;">• All bookings, modifications and cancellations are subject to Partner terms and conditions.</p>
<p class="size12" style="font-size: 13px;">• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>

<p class='size12' style='font-size: 13px'>• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
					</div>	
					<div class="alert alert-info">
					<b>Hotel Cancellation Policy:</b><br/><br/>
					<p class="size12" style="font-size: 13px;"><?php if(isset($rm_details['HotelRoomReservationResponse']['RateInfos']['RateInfo']['cancellationPolicy'])) { echo $rm_details['HotelRoomReservationResponse']['RateInfos']['RateInfo']['cancellationPolicy']; }else{    echo ' No Cancellation Policy ';}  ?></p>
					</div>

					
				
					



						
					
			
				

				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
<?php if(isset($rm_details['HotelRoomReservationResponse'])) {
$room_info[0]=$rm_details['HotelRoomReservationResponse'];
if(isset($room_info[0]['RateInfos']['RateInfo']['nonRefundable'])) 
$refund_status=$room_info[0]['RateInfos']['RateInfo']['nonRefundable']; 
if($room_info[0]['RateInfos']['RateInfo']['ChargeableRateInfo']['@currencyCode']=='INR')
{
$rate_info=$room_info[0]['RateInfos']['RateInfo']['ChargeableRateInfo']; 
}else
{
$rate_info=$room_info[0]['RateInfos']['RateInfo']['ConvertedRateInfo'];
}
 ?>


				<?php $start_date=$values['check_in'];
                          $end_date=$values['check_out'];
                          $date1 = new DateTime($start_date);
                $date2 = new DateTime($end_date);
                $diff = $date1->diff($date2); 
                $days=($diff); 
$begin = new DateTime( $start_date );
$end = new DateTime( $end_date );
//$end = $end->modify( '+1 day' );

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end); ?>
 <?php 
                           //echo '<pre>';print_r($rate_info);exit;                 	 
                 $rooms=$values['num_rooms'];
                 if(isset($rate_info['@nightlyRateTotal'])){
          $day=round($rate_info['@nightlyRateTotal']/$rate_info['@maxNightlyRate']);
          if(isset($rate_info['@averageRate'])){
          $pernight=$rate_info['@averageRate'];
          }else{
           $pernight=$rate_info['@maxNightlyRate'];
          }
          if(isset($rate_info['@surchargeTotal']) && !empty($rate_info['@surchargeTotal']))
          {
          $tax=$rate_info['@surchargeTotal']; 
          
          $tax_room=$tax/$rooms;
          }
          if(isset($rate_info['@total']))
                  {
                  $total= $rate_info['@total'];
                  }
                  else
                  {
                  $total= $rate_info['@nightlyRateTotal'];
                  }
          } else
          {
          $r=$values['num_rooms'];
          $pernight=$rate_info['@maxNightlyRate'];
          if(isset($rate_info['@commissionableUsdTotal']))
          {
          $tax_room=$rate_info['@commissionableUsdTotal'];
          $tr=$pernight+$tax_room;
          }else
          {
          $tax_room=0;
          $tr=$pernight;
          }
          echo $tr;
           echo $r;
          $tota=$tr*$r;
          //$total=$days['days']*$tota;
          $tax=$tax_room*$r;
          }
          //room price calculation goes here 
          //echo '<pre>';print_r($rate_info);exit;
          

//print_r(toArray($diff));
          $startDate = DateTime::createFromFormat("d-m-Y","$start_date",new DateTimeZone("Europe/London"));
$endDate = DateTime::createFromFormat("d-m-Y","$end_date",new DateTimeZone("Europe/London"));

$periodInterval = new DateInterval( "P1D" ); // 1-day, though can be more sophisticated rule
//$period = new DatePeriod( $startDate, $periodInterval, $endDate );


         //echo '<pre>';print_r($values);exit;
          //$t=$day*$total;
          
   ?>
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<img src="<?php echo str_replace('httpss','https',$values['image']); ?>" style="width: 50px;
height: 50px;" class="left margright20" alt=""/>
						<span class="opensans size18 dark bold"><?php echo $values['name']; ?></span>
						<span class="opensans size13 grey"><?php if(isset($values['address2'])) echo $values['address2'].', '.$values['cityname']; ?></span><br/>
						
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30" style="font-weight: 100;">
						<table class="table table-bordered margbottom20">
							
							<tr>
								<td colspan=2><span class="dark">Room Type </span></td><td> <?php echo $room_info[0]['roomDescription']; ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark"> Nights</span></td><td> <?php echo $check_in = date('M d',strtotime($values['check_in'])); ?> - <?php echo $check_out = date('M d',strtotime($values['check_out'])); ?></td>
							</tr>
<td colspan=2><span class="dark">Refundable</span></td><td> <?php  if(isset($refund_status) && ($refund_status==1)) { echo "No"; }else{ echo "Yes";  } ?></td>
							 <?php 
            
            if($rooms==1)
            { 
            ?><tr>
		<td colspan=2>							<span class="dark">Room 1  </span>
 </td>
<td>
	<?php echo $values['numberOfAdults1']; ?> Adult(s) <?php if($values['numberOfChildren1']==0){
                                            echo ''; } else { ?> 
                                           <?php echo '&'.' '.$values['numberOfChildren1'].' ' .'Children'; } ?> <br/>
</td></tr>	
<?php foreach($daterange as $date){  ?>							
	<tr><td colspan=2>									<!-- Collapse 1 -->	
									
									<div >
										<div class="left dark">
											Date<br/>
											Base fare<br/>
										</div>
										</td>	
<td>

<div class="">
											<?php echo $date->format("M d") . "<br>"; ?>
											&#x20b9 <?php echo round($pernight); ?><br/>
										</div></td></tr>
<?php } ?><?php if(!empty($tax)) { ?>
<tr><td colspan=2>
<div class="left ">Total Tax & Fee</div>
</td>
<td>

&#x20b9 <?php echo round($tax_room); ?> 
</td>
</tr><?php } ?>
<?php }else{
            for($i=1; $i<=$rooms; $i++)
            { $j=$i; ?>
<tr>
<td colspan=2>
<span class="dark">Room <?php echo $i; ?></span> 
 </td>
</td><td>	
<?php echo $values['numberOfAdults'.$j.'']; ?>  Adult(s) <?php if($values['numberOfChildren'.$j.'']==0){
                                                        echo''; } else { ?>
                                   <?php echo '&'.' '.$values['numberOfChildren'.$j.''].' ' .'Children';} ?> <br/>
</td>
</tr>	
<?php foreach($daterange as $date){  ?>							
	<tr><td colspan=2>									<!-- Collapse 1 -->	
									
									<div >
										<div class="left dark">
											Date<br/>
											Base fare<br/>
										</div>
										</td>	
<td>

<div class="">
											<?php echo $date->format("M d") . "<br>"; ?>								
									
									
											&#x20b9 <?php echo round($pernight); ?> <br/>
										</div><div class="clearfix"></div>	
									</div>
									<!-- End of collapse 1 -->
									<div class="clearfix"></div>	
									
								</td>
								</tr>
<?php } ?><?php if(!empty($tax)) { ?>
<tr><td colspan=2><div class="left">Total Tax & Fee</div>

</td>
<td>

&#x20b9 <?php echo round($tax_room); ?> 
</td>
</tr><?php } ?>
<?php } } } else{ ?>


<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<img src="<?php echo str_replace('httpss','https',$values['image']); ?>" style="width: 50px;
height: 50px;" class="left margright20" alt=""/>
						<span class="opensans size18 dark bold"><?php echo $values['name']; ?></span>
						<br><span class="opensans size13 grey" style="margin-left: 73px;"><?php if(isset($values['address2'])) echo $values['address2'].', '.$values['cityname']; ?></span><br/>
						
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							<tr>
								<td colspan=2><span class="dark">Number of Room </span></td><td> <?php echo $values['num_rooms']; ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark">Room Type</span></td><td> <?php echo $values['rm_desc']; ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark"> Nights</span></td><td> <?php echo $check_in = date('M d',strtotime($values['check_in'])); ?> - <?php echo $check_out = date('M d',strtotime($values['check_out'])); ?></td>
							</tr>
							<td colspan=2><span class="dark">Refundable</span></td><td> <?php  if(isset($values['Refundable']) && ($values['Refundable'])) { echo "No"; }else{ echo "Yes";  } ?></td>
							<tr>
								<td colspan=2><span class="dark">Pay by cash</span>
</td><td> &#x20b9  <?php echo round($values['average_rate']); ?> </td>

<?php } ?>
							</tr>
						</table>
					</div>	
					<div class="line3"></div>
					<div class="padding20">	
<?php if(isset($pernight)) { ?>
<span class="left size14 dark">Total Base fare</span>
 <?php $totalprice_night=(round($pernight)*$values['num_rooms']*round($days->days)) ?>
						<span class="right size14">&#x20b9 <?php echo $totalprice_night; ?>
</span></br></br>
 <?php if(isset($tax)) { ?>
<span class="left size14 dark">Total Tax Recovery <br> Charges and Fees </span>
						<span class="right size14">&#x20b9 <?php echo round($tax);?>
</span></br></br></br>
<?php } } ?>				
						<span class="left size14 dark" >Booking Total</br><font  size="1" color="grey">(Payment In Full)</font></span>
							
	<span class="right size14" style="margin-right: -14px;">&#x20b9  <?php echo round($values['average_rate']); ?> </br><font  size="1" color="grey" >(Inclusive Tax)</font></span>
	
	
						
						<div class="clearfix"></div>
                                                
					</div>

                                        <?php
                                                $total=round($values['average_rate']);
                                                 $offer = Offerhelper::offer_calculate(6,$total);    
                                       
                                        if(!empty($offer)){ ?>
                                        <div class="padding20" style=" padding-top: 27px;">					
                                        <span class="left size14 dark" style="font-weight:normal;">SmartBuy Exclusive Offer</span>

                                        <span class="right " style="color:#e20613;font-weight:normal;" > ₹ <?php echo $offer['discount_amount'];?> </span>

                                        </div>
                                        
                                        <div class="padding20" >					
					<span class="left size14 dark" style="font-weight:normal;">Net Payable Amount</span>
	
<span class="right" style="text-align: right;font-weight:normal;">₹ <?php echo round($total - $offer['discount_amount'] );?> </span>
	
	
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
