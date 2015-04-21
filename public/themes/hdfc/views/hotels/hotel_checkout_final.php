
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="Hotels" class="active">Hotels</a></li>
					<li>/</li>
					<li><a href="#">Summary</a></li>
					<li>/</li>					
				</ul>				
			</div>
			
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt5 offset-0">
			
		<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>" id="passenger_checkout" onsubmit="return term_condition();" name="passenger_checkout" accept-charset="UTF-8">		
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					<span class="size16px bold dark left">Who's traveling? </span>
					<div class="roundstep right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					<?php for( $i=1;$i<=$getdetails['num_rooms'];$i++) { ?>

           <b>Room <?php echo $i; ?> Details
  </b>
<div class="clearfix"></div>
					
					<div class="col-md-12">
						
					</div>
<div class="col-md-12"> 

<div class="mt15">
						 <?php if($values['title'.$i.'']==1) { $title='Mr';}elseif($values['title'.$i.'']==2){ $title='Mrs'; }else{  $title='Miss'; }?> <span class="dark">  <?php echo $title;?>  <?php echo $values['firstName'.$i.''];?>  <?php echo $values['lastName'.$i.''];?></span><br><br> <span class="dark">Bed Type : </span>  <?php if($values['bedTypeId'.$i.'']==14){ $bed="14 : 1 King"; }else{ $bed="18 : 1 Twin"; } echo $bed;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="dark">Smoking Preference : </span><?php if($values['smokingPreference'.$i.'']=='S'){ $somke='Smoking'; }else{ $somke='No Smoking';  } echo $somke;?></div>  <br><br><span class="dark"> Special requests : </span><?php if(empty($values['specialrequests'.$i.''])){ echo 'None'; }else{ echo $values['specialrequests'.$i.'']; }  ?>
						
						

					</div>
					
					<div class="clearfix"></div>

	<input type="hidden" name="title<?php echo $i; ?>" value="<?php echo $values['title'.$i.'']; ?>" >				
	<input type="hidden" name="firstName<?php echo $i; ?>" value="<?php echo $values['firstName'.$i.'']; ?>" >
<input type="hidden" name="lastName<?php echo $i; ?>" value="<?php echo $values['lastName'.$i.'']; ?>" >
<input type="hidden" name="bedTypeId<?php echo $i; ?>" value="<?php echo $values['bedTypeId'.$i.'']; ?>" >
<input type="hidden" name="smokingPreference<?php echo $i; ?>" value="<?php echo $values['smokingPreference'.$i.'']; ?>" >
<input type="hidden" name="specialrequests<?php echo $i; ?>" value="<?php echo $values['specialrequests'.$i.'']; ?>" >
<div class="clearfix"></div><?php if($getdetails['num_rooms']!=1) { ?>
<div class="line4"></div>
<?php  } }  ?>
					<div class="clearfix"></div>
<br><br>
					<span class="size16px bold dark left">Where can we reach you?</span>
					<div class="roundstep  right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					<div class="col-md-12"><div class="col-md-4">
						<span class="dark">First Name:</span>
						&nbsp;&nbsp;<?php echo $post['first_name']; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $post['first_name']; ?>">
					</div>
					<div class="col-md-4 textleft">
					<span class="dark">Last Name:</span>
						&nbsp;&nbsp;<?php echo $post['last_name']; ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $post['last_name']; ?>">
					</div>

					</div>
<br>
					<div class="col-md-12">
					
					
					<div class="col-md-8 textright">
						<div class="mt15"><span class="dark" style="float: left;">Email Address:</span><span style="float: left;"> &nbsp;&nbsp;<?php echo $post['s_email']; ?><span></div>
<input type="hidden" name="s_email" class="form-control margtop10" placeholder="" value="<?php echo $post['s_email']; ?>">
					</div>
<div class="col-md-6 textright">
</div>
</div>
					
						
<div class="col-md-12">	<br>	<br>			
<div class="col-md-8  textright">
						<div class="mt15" ><span class="dark" style="float: left;">Preferred Phone Number:</span>&nbsp;&nbsp;<span style="float: left;"> <?php echo $post['mobile']; ?></span></div>
					</div>
<input style="width:20%;position: absolute;" type="hidden" readonly value="91" class="form-control"/><input type="hidden" name = "mobile" class="form-control" placeholder="" value="<?php echo $post['mobile']; ?>" >
</div>
					
						
					
					
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address).<br/> 
					
					<br/>
					<br/>
	
					<span class="size16px bold dark left">Review and book your trip</span>
					<div class="roundstep right">3</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					<div class="alert alert-info">
					<b><span class='attention'>Attention!</span><span class='attention_sub'> Please read important hotel booking information!:</span></b><br/><br/>
<p class='size12' style='font-size: 13px;'>• The credit card/Debit card WILL be charged immediately for the full amount </p>					
<p class="size12" style="font-size: 13px;">• This hotel is booked through our partner Expedia</p>
<p class="size12" style="font-size: 13px;">• For all queries and/or activities related to booking, please contact us at support@smartbuy.com and 1860 425 3322. Refund on hotel booking will be as per the hotel rules.</p>
<p class="size12" style="font-size: 13px;">• All bookings, modifications and cancellations are subject to Partner terms and conditions.</p>
<p class="size12" style="font-size: 13px;">• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>

<p class='size12' style='font-size: 13px'>• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
					</div>	
					
					<div class="alert alert-info">
					<b>Hotel Cancellation Policy:</b><br/><br/>
					<p class="size12" style="font-size: 13px;"><?php echo $cancellationPolicy; ?></p>
					</div>		
					<input type="checkbox" name="check_term" id="check_term" value="2" checked/>You have accepted the <a target='_blank' href='http://travel.ian.com/index.jsp?pageName=userAgreement&locale=en_US&cid=467181'>Terms and Conditions</a><br/>	
	<div id="term_error"></div>		<br/><br/>
<input type="hidden" name="supplierType" id="supplierType" value="<?php echo $post['supplierType']; ?>" />
                                        
        <input type="hidden" name="rateKey" id="rateKey" value="<?php echo $post['rateKey']; ?>" />
        <input type="hidden" name="roomTypeCode" id="roomTypeCode" value="<?php echo $post['roomTypeCode']; ?>" />
        <input type="hidden" name="rateCode" id="rateCode" value="<?php echo $post['rateCode']; ?>" />
        <input type="hidden" name="postvalue"  id="postvalue" value="<?php echo $post['postvalue']; ?>" />
        <input type="hidden" name="pid" id="pid" value="1" />
        <input type="hidden" name="hotelid" id="hotelid" value="<?php echo $post['hotelid']; ?> " />
        <input type="hidden" name="name" id="name" value="<?php echo $post['name']; ?>" />
        <input type="hidden" name="average_rate" id="average_rate" value="<?php echo $post['average_rate']; ?>" />
        <input type="hidden" name="rm_desc" id="rm_desc" value="<?php echo $post['rm_desc']; ?>" />
        <input type="hidden" name="image" id="image" value="<?php echo str_replace('http','https',$post['image']); ?>" />
        <input type="hidden" name="amount" value="<?php echo trim($post['average_rate']);?>"/>
	<input type="hidden" name="ctrack_id" id="ctrack_id" value="<?php if(isset($post['ctrack_id'])) echo $post['ctrack_id']; ?>"/>
      
					 <input type="hidden" name="discount_amount" id="discount_amount" value="<?php echo $post['discount_amount']; ?>"/>
					 <input type="hidden" name="urid" id="urid" value=""/>

 <input type="hidden" name="ctype" id="ctype" value="hotels1"/>
 <?php		
					
					$check_data=array(
							   'amount'=>round($post['average_rate']),
                                                           'book'=>'trip',	
							   'cash'=>0,
							   'ctype'=>'hotels1',
							   'emi_data'=>$emi_data,
							   'interest'=>$interest,
							   'form_option'=>0
							   );
						
					$view = View::make('payment_form',$check_data);
					echo $view;
					?>		
				</div>
		
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
$daterange = new DatePeriod($begin, $interval ,$end); ?>
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
					
					<div class="hpadding30 margtop30" style="font-weight: 100;">
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
<?php } ?><?php if(!empty($tax)) { ?>
<tr><td colspan=2>
<div class="left dark">Total Tax & Fee</div>
</td>
<td>

&#x20b9 <?php echo round($tax_room); ?>
</td>
</tr> <?php }?>
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
<tr><td colspan=2>
<div class="left dark">Total Tax & Fee</div>
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
	<span class="left size14 dark" style="font-weight:normal;">Total Base fare</span>
 <?php $totalprice_night=(round($pernight)*$getdetails['num_rooms']*round($days->days)) ?>
						<span class="right size13" style="font-weight:normal;">&#x20b9 <?php echo $totalprice_night; ?>
</span></br></br>

 <?php if(isset($tax)) { ?>
<span class="left size14 dark"  style="font-weight:normal;">Total Tax Recovery <br> Charges and Fees </span>
						<span class="right size13" style="font-weight:normal;">&#x20b9 <?php echo round($tax);?>
</span></br></br></br>
<?php } ?>				
						<span class="left size14 dark" style="font-weight:normal;">Trip Total</span>
						<span class="right size14" style="font-weight:normal;text-align: right;">&#x20b9 <?php echo round($total);?></br><font  size="1" color="grey">(Inclusive Tax)</font></span>
						
                                                
					</div>
<?php 
                                        
                                        $offer = Offerhelper::offer_calculate(6,$total);    
                                       
                                        if(!empty($offer)){ ?>
                                        <div class="padding20" style=" padding-top: 27px;">					
                                        <span class="left size14 dark " style="font-weight:normal;">SmartBuy Exclusive Offer</span>

                                        <span class="right " style="color:#e20613;font-weight:normal;" > ₹ <?php echo $offer['discount_amount'];?> </span>

                                        </div>
                                        
                                        <div class="padding20" >					
					<span class="left size14 dark"style="font-weight:normal;">Net Payable Amount</span>
	
<span class="right" style="text-align: right;font-weight:normal;">₹ <?php echo round($total - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                        <?php } ?>
                        <br/><br/>
	<input type="hidden" name="Refundable" id="Refundable" value="<?php  if(isset($refund_status)) echo $refund_status; ?>" />			</div><br/>
				
</form>				
			<?php 
			$login=Session::get('customer_data'); if(!$login){
 echo Form::open(array("id"=>"form-login","role"=>"form",'method'=>'post','onsubmit' => 'return validateForm();', 'action'=>'Login@checkout_login',"accept-charset"=>"UTF-8")); ?>		
				<div class="pagecontainer2 loginbox">
					<div class="cpadding1">
					
						<span class="icon-lockk"></span>
						
						<h3 class="opensans">Log in</h3></br></br>
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
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	<script type="text/javascript" >
$(document).ready(function() {

$('.emi_details').hide();
		$('.payment').change(function() {
			$( "#emi_error" ).empty();
			var paytype=$('input[name=ptype]:checked', '#passenger_checkout').val()
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



		});
	$("#passenger_checkout").validate({
		rules: {
			firstName1 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				lastName1 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				bedTypeId1 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference1 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				firstName2 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				lastName2 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				bedTypeId2 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference2 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				firstName3 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				lastName3 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				bedTypeId3 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference3 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				
				firstName4 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				lastName4 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				bedTypeId4 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference4 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				firstName5 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				lastName5 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				bedTypeId5 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference5 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				firstName6 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				lastName6 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
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
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				lastName7 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				bedTypeId7 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference7 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				
				firstName8 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				lastName8 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				bedTypeId8 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				smokingPreference8 : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
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
	
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>	
	
	
