
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="Hotels" class="active">Hotels</a></li>	
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
			
		<form method="post" action="<?php echo $url = URL::action('Hotels@Hotel_Checkout_final'); ?>" id="hotel_checkout" name="hotel_checkout" accept-charset="UTF-8">		
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					<span class="size16px bold dark left">Who's traveling? </span>
					<div class="roundstep right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					<br/>
					<?php for( $i=1;$i<=$getdetails['num_rooms'];$i++) { ?>

           <b>Room <?php echo $i; ?> Details
 </b>
<div class="clearfix"></div>
					
					<div class="col-md-4">
						<div class="margtop15"><span class="dark">Contact Name:</span><span class="red">*</span></div>
					</div>
<div class="col-md-2">
						<span class="size12">Title</span>
						<select name="title<?php echo $i;?>" class="form-control">
                                            	<option value="1">Mr</option>
                                            	<option value="2">Mrs</option>
                                            	<option value="3">Ms</option></select>

					</div>
					<div class="col-md-3">
						<span class="size12">First Name</span>
						<input type="text" name="firstName<?php echo $i; ?>" id="firstName<?php echo $i; ?>"class="form-control " placeholder="">
					</div>
					<div class="col-md-3 textleft">
					<span class="size12">Last Name</span>
						<input type="text" name="lastName<?php echo $i; ?>" id="lastName<?php echo $i; ?>" class="form-control " placeholder="">
					</div>
					<div class="clearfix"></div>
					
					<br/>
					<div class="col-md-4">
						<div class="margtop7"><span class="dark">Bedding / Smoking Request:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-4">
						<span class="size12">Bed Type</span>						
						<select name="bedTypeId<?php echo $i; ?>" id="bedTypeId<?php echo $i; ?>" class="form-control" >
	
                                                <option value="14">14 : 1 King</option>
                                                <option value="18">18 : 1 Twin</option>
                                        </select>
					</div>
					<div class="col-md-4 textleft">
<span class="size12">Smoking Preference</span>						
						<select name="smokingPreference<?php echo $i; ?>" id="smokingPreference<?php echo $i; ?>"  class="form-control" id="smokingPreference" >
	
                                        <option value="S">Smoking</option>
                                        <option value="NS">No Smoking</option>
                                        </select>
					</div>
					<div class="clearfix"></div>

					<br/>
					
					<div class="col-md-8 textleft right">
						
							
						Special Requests (optional)		
						<!-- Collapse 4 -->	
						
						
							<textarea name="specialrequests<?php echo $i; ?>" rows="3" class="form-control margtop10" style="margin: 10px -0.453125px 0px 0px;max-width: 418px;height: 96px;width: 418px;max-height: 200px;"></textarea>
						
<span class="size12">All special requests will be passed on to the property. However they are subject to availability and additional charges might be applicable.</span>
						<!-- End of collapse 4 -->
						<div class="clearfix"></div>	
						
					</div>
<div class="clearfix"></div>
<?php if($getdetails['num_rooms']<>1) { ?>
<div class="line4"></div>
<?php  } }  ?>
					
					
					<div class="clearfix"></div>
					<br/>
					<br/>

 
<span class="size16px bold dark left">Where can we reach you?</span>
					<div class="roundstep right">2</div>
					<div class="clearfix"></div>
					<div class="line4"></div>	
					<?php		
					$mess="<span class='size16px bold dark left'>Review and book your trip</span>
					<div class='roundstep right'>3</div>
					<div class='clearfix'></div>
					<div class='line4'></div><div class='alert alert-info'>	<b><span class='attention'>Attention!</span><span class='attention_sub'> Please read important hotel booking information!:</span></b><br/><br/>
<p class='size12' style='font-size: 13px;'>• The credit card/Debit card WILL be charged immediately for the full amount </p>
<p class='size12' style='font-size: 13px;'>• This hotel is booked through our partner Expedia</p>
	
<p class='size12' style='font-size: 13px;'>• For all queries and/or activities related to booking, please contact us at support@smartbuy.com and 1860 425 3322. Refund on hotel booking will be as per the hotel rules.</p>			


<p class='size12' style='font-size: 13px;'>• All bookings, modifications and cancellations are subject to Partner terms and conditions.</p>
<p class='size12' style='font-size: 13px'>• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>

<p class='size12' style='font-size: 13px'>• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
					</div>	
					<div class='alert alert-info'>
					<b>Hotel cancellation policy:</b><br/><br/>
					<p class='size12' style='font-size: 13px;'>".$cancellationPolicy."</p>
					</div>		
					By clicking on continue booking I acknowledge that I have read and accept the rules & restrictions, <a target='_blank' href='http://travel.ian.com/index.jsp?pageName=userAgreement&locale=en_US&cid=467181'>Terms and Conditions</a> and ". HTML::link('content/Privacy Policy', ' Privacy Policy',array("target"=>"_blank")).".<br/>";
					$check_data=array(
							   
							  
								'msg'=>$mess
							   );
						
					$view = View::make('checkout/common',$check_data);
					echo $view;
					?>	
					
					
					
					<br/>
					
					
						
					
					
						
			
<input type="hidden" name="supplierType" id="supplierType" value="<?php echo $post['supplierType']; ?>" />
                                        
        <input type="hidden" name="rateKey" id="rateKey" value="<?php echo $post['rateKey']; ?>" />
        <input type="hidden" name="roomTypeCode" id="roomTypeCode" value="<?php echo $post['roomTypeCode']; ?>" />
        <input type="hidden" name="rateCode" id="rateCode" value="<?php echo $post['rateCode']; ?>" />
        <input type="hidden" name="postvalue"  id="postvalue" value="<?php echo $post['postvalue']; ?>" />
        <input type="hidden" name="pid" id="pid" value="1" />
        <input type="hidden" name="hotelid" id="hotelid" value="<?php echo $post['hotelid']; ?> " />
        <input type="hidden" name="name" id="name" value="<?php echo $post['name']; ?>" />
        
        <input type="hidden" name="rm_desc" id="rm_desc" value="<?php echo $post['rm_desc']; ?>" />
        <input type="hidden" name="image" id="image" value="<?php echo str_replace('http','https',$post['image']); ?>" />
       
	<input type="hidden" name="ctrack_id" id="ctrack_id" value="<?php if(isset($post['ctrack_id'])) echo $post['ctrack_id']; ?>"/>
      
					 <input type="hidden" name="discount_amount" id="discount_amount" value="<?php echo $post['discount_amount']; ?>"/>
					 <input type="hidden" name="urid" id="urid" value=""/>

 <input type="hidden" name="ctype" id="ctype" value="hotels"/>



			
				
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
<?php 

if(isset($room_info[0]['RateInfos']['RateInfo']['nonRefundable'])) 
$refund_status=$room_info[0]['RateInfos']['RateInfo']['nonRefundable']; 
if($room_info[0]['RateInfos']['RateInfo']['ChargeableRateInfo']['@currencyCode']=='INR')
{
$rate_info=$room_info[0]['RateInfos']['RateInfo']['ChargeableRateInfo']; 
}else
{
$rate_info=$room_info[0]['RateInfos']['RateInfo']['ConvertedRateInfo'];
}
$cancel_polcy=$room_info[0]['RateInfos']['RateInfo']['cancellationPolicy']; 
$rcode=$room_info[0]['roomTypeCode']; ?>


				<?php $start_date=$getdetails['check_in'];
                          $end_date=$getdetails['check_out'];
                          $date1 = new DateTime($start_date);
                $date2 = new DateTime($end_date);
                $diff = $date1->diff($date2); 
                $days=($diff); 
$begin = new DateTime( $start_date );
$end = new DateTime( $end_date );
//$end = $end->modify( '+1 day' );

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);
 

?>
 <?php 
                           //echo '<pre>';print_r($rate_info);exit;                 	 
                 $rooms=$getdetails['num_rooms'];
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
          $r=$getdetails['num_rooms'];
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


         //echo '<pre>';print_r($getdetails);exit;
          //$t=$day*$total;
          
   ?>
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<img src="<?php echo $post['image']; ?>" style="width: 50px;
height: 50px;" class="left margright20" alt=""/>
						<span class="opensans size18 dark bold"><?php echo $post['name']; ?></span>
						<br><span class="opensans size13 grey" style="margin-left: 73px;"><?php if(isset($post['address2'])) echo $post['address2'].', '.$getdetails['cityname']; ?></span><br/>
						
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							
							<tr>
								<td colspan=2><span class="dark">Room Type</span></td><td> <?php echo $room_info[0]['roomTypeDescription']; ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark"> Nights</span></td><td> <?php echo $check_in = date('M d',strtotime($getdetails['check_in'])); ?> - <?php echo $check_out = date('M d',strtotime($getdetails['check_out'])); ?></td>
							</tr>
						<tr>
								<td colspan=2><span class="dark">Refundable</span></td><td> <?php  if(isset($refund_status) && ($refund_status==1)) { echo "No"; }else{ echo "Yes";  } ?></td>
							</tr>
							
								
								                                      <?php 
            
            if($rooms==1)
            { 
            ?><tr>
		<td colspan=2>							<span class="dark">Room 1  </span>
</td>
<td>
	<?php echo $getdetails['numberOfAdults1']; ?> Adult(s) <?php if($getdetails['numberOfChildren1']==0){
                                            echo ''; } else { ?> 
                                           <?php echo '&'.' '.$getdetails['numberOfChildren1'].' ' .'Children'; } ?> </td></tr>	
<?php foreach($daterange as $date){  ?>							
	<tr><td colspan=2>									<!-- Collapse 1 -->	
									
									<div >
										<div class="left dark">
											Date<br/>
											Base fare<br/>
										</div>
										</td>	
<td>

<div>
											<?php echo $date->format("M d") . "<br>"; ?>
											&#x20b9 <?php echo round($pernight); ?><br/>
										</div></td></tr>
<?php } ?>
<?php if(!empty($tax)) { ?>
<tr><td colspan=2>
<div class="left dark">Total Tax & Fee</div>
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
<?php echo $getdetails['numberOfAdults'.$j.'']; ?>  Adult(s) <?php if($getdetails['numberOfChildren'.$j.'']==0){
                                                        echo''; } else { ?>
                                   <?php echo '&'.' '.$getdetails['numberOfChildren'.$j.''].' ' .'Children';} ?> </td>
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

<div >
											<?php echo $date->format("M d") . "<br>"; ?>								
									
									
											&#x20b9 <?php echo round($pernight); ?> <br/>
										</div><div class="clearfix"></div>	
									</div>
									<!-- End of collapse 1 -->
									<div class="clearfix"></div>	
									
								</td>
								</tr>
<?php } ?><?php if(!empty($tax)) { ?>
<tr><td colspan=2>
<div class="left size12 dark">Total Tax & Fee</div>
</td>
<td>

&#x20b9 <?php echo round($tax_room); ?> 
</td>
</tr>
<?php } ?>
<?php } } ?>
									
							
						</table>
					</div>	
					<div class="line3"></div>
					<div class="padding20">	
					<span class="left size14 dark">Total Base fare</span>
 <?php $totalprice_night=(round($pernight)*$getdetails['num_rooms']*round($days->days)) ?>
						<span class="right  size13">&#x20b9 <?php echo $totalprice_night; ?>
</span></br></br>
 <?php if(isset($tax)) { ?>
<span class="left size14 dark">Total Tax Recovery <br> Charges and Fees </span>
						<span class="right  size13">&#x20b9 <?php echo round($tax);?>
</span></br></br></br>
<?php } ?>
				
						<span class="left size14 dark ">Booking Total</span>
						<span class="right  size14" style="margin-right: -15px;">&#x20b9 <?php echo round($total);?>
</br><font  size="1" color="grey" >(Inclusive Tax)</font></span>
						
<input type="hidden" name="Refundable" id="Refundable" value="<?php  if(isset($refund_status)) echo $refund_status; ?>" />
<input type="hidden" name="average_rate" id="average_rate" value="<?php echo $total; ?>" />
 <input type="hidden" name="amount" value="<?php echo trim($total);?>"/>					</div>
                                            <?php 
                                        
                                        $offer = Offerhelper::offer_calculate(6,$total);    
                                       
                                        if(!empty($offer)){ ?>
                                        <div class="padding20" style=" padding-top: 27px;">					
                                        <span class="left size14 dark">SmartBuy Exclusive Offer</span>

                                        <span class="right " style="color:#e20613;" > ₹ <?php echo $offer['discount_amount'];?> </span>

                                        </div>
                                        
                                        <div class="padding20" >					
					<span class="left size14 dark">Net Payable Amount</span>
	
<span class="right" style="text-align: right;">₹ <?php echo round($total - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                        <?php } ?>
        <br/><br/>
				</div><br/>
				
</form>				
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
<script src="themes/hdfc/assets/assets/js/jquery.validate.js"></script>	
	<script type="text/javascript" >
$(document).ready(function() {
jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "This field only contain letters.");
	$("#hotel_checkout").validate({
		rules: {
			firstName1 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				lastName1 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				bedTypeId1 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference1 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				firstName2 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				lastName2 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				bedTypeId2 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference2 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				firstName3 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				lastName3 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				bedTypeId3 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference3 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				
				firstName4 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				lastName4 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				bedTypeId4 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference4 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				firstName5 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				lastName5 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				bedTypeId5 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference5 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				firstName6 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				lastName6 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				bedTypeId6 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference6 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				smokingPreference6 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				firstName7 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				lastName7 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				bedTypeId7 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference7 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				firstName8 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				lastName8 : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				
				},
				bedTypeId8 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference8 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
			
			s_email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email:true	
				},
			mobile : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
			last_name : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				},
			first_name : {
			required: {depends:function(){$(this).val();return true;},lettersonly:true }
				}
						
		},
		messages: {
			email: { 
			required: "This field is required.",
			email: "Please Enter a Valid Email-Address."
			}
		},
		onkeyup:false,
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
	

	
	
