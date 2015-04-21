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
					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		
	</div>	
<?php $hotels_details=$hotel_dect['hotel-search-response']['hotels']['hotel']['basic-info'];
 $hotels_rooms=$hotel_dect['hotel-search-response']['hotels']['hotel']['room-rates'];
//echo '<pre>'; print_r($hotels_rooms); exit; 
?>
	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
	<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>" id="passenger_checkout" name="passenger_checkout" onsubmit="return term_condition();" accept-charset="UTF-8">		
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">	
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					<span class="size16px bold dark left">Who's traveling? </span>
					<div class="roundstep  right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					
					
					
					<div class="col-md-12">
						<div class="margtop15">
<span class="dark"><?php echo $post['title']; ?> <?php echo $post['firstname']; ?> <?php echo $post['lastname']; ?></span><br><br>
<span class="dark"><?php echo $post['email']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dark"><?php echo $post['cmobile']; ?></span>	<br><br>
<span class="dark">Address :</span> &nbsp;&nbsp;<span class="dark"><?php echo $post['address']; ?> -<?php echo $post['citys']; ?>-<?php echo $post['postal']; ?>, <?php echo $post['country']; ?></span>

</div>
					</div>
					
						
						<input type="hidden" name="title" class="form-control " placeholder=""value="<?php echo $post['title']; ?>">
<input type="hidden" name="firstname" class="form-control " placeholder=""value="<?php echo $post['firstname']; ?>">
<input type="hidden" name="lastname" class="form-control " placeholder="" value="<?php echo $post['lastname']; ?>">
<input type="hidden" name="email" class="form-control " placeholder="" value="<?php echo $post['email']; ?>">	
<input type="hidden" name="mobile" class="form-control" placeholder="" value="<?php echo $post['cmobile']; ?>">	
<input type="hidden" name="address" class="form-control " placeholder="" value="<?php echo $post['address']; ?>">						
<input type="hidden" name="citys" class="form-control" placeholder="" value="<?php echo $post['citys']; ?>">
<input type="hidden" name="postal" class="form-control " placeholder="" value="<?php echo $post['postal']; ?>">
<input type="hidden" name="country_clr" class="form-control" placeholder="" value="<?php echo $post['country_clr']; ?>">			
					
					
					
					
					
					<div class="clearfix"></div>
					
					<br/>
					<br/>
					
					<span class="size16px bold dark left">Where can we reach you?</span>
					<div class="roundstep right">2</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					<div class="col-md-4">
						<span class="dark">First Name:</span>
						&nbsp;&nbsp;<?php echo $post['first_name']; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $post['first_name']; ?>">
					</div>
					<div class="col-md-4 textleft">
					<span class="dark">Last Name:</span>
						&nbsp;&nbsp;<?php echo $post['last_name']; ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $post['last_name']; ?>">
					</div>
					
					<div>
					
					
					
					<div class="col-md-8 textright ">
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
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address).<br/> 
					
					<br/>
					<br/>
					<span class="size16px bold dark left">Review and book your trip</span>
					<div class="roundstep right">3</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					<div class='alert alert-info'>	<b><span class='attention'>Attention!</span><span class='attention_sub'> Please read important hotel booking information!:</span></b><br/><br/>
					<p class='size12' style='font-size: 13px'>• This ticket is booked though our partner Cleartrip.</p>
					<p class='size12' style='font-size: 13px;'>• For any query and/or activity related to the service and/or modification and cancellation, please contact Cleartrip at agencysupport@cleartrip.com and +91 124 4837444/ 445/ 448. Refund on hotel booking will be as per the hotel rules.</p>
					<p class='size12' style='font-size: 13px;'>• All bookings, modifications and cancellations are subject to Partner terms and conditions. </p>
					<p class='size12' style='font-size: 13px;'>• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side.</p>
					
					<p class='size12' style='font-size: 13px'>• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
					</div>

					<input type="checkbox" name="check_term" id="check_term" value="2" checked/>You have accepted the <?php echo HTML::link('content/Terms & Conditions', 'Terms & conditions ',array("target"=>"_blank")); ?><br/>
<div id="term_error"></div>					
				<?php $total=$post['amount']; ?>	
					 <?php		
					
					$check_data=array(
							   'amount'=>round($total),
                                                           'book'=>'trip',	
							   'cash'=>0,
							   'ctype'=>'hotels2',
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
			<input type="hidden" name="amount" value="<?php echo $total;?>"/>
			<input type="hidden" name="booking_date" value="<?php echo $hotel_dect['hotel-search-response']['search-criteria']['booking-date']; ?>"/>
			<input type="hidden" name="check_in_date" value="<?php echo $hotel_dect['hotel-search-response']['search-criteria']['check-in-date'];?>"/>
			<input type="hidden" name="check_out_date" value="<?php echo $hotel_dect['hotel-search-response']['search-criteria']['check-out-date']; ?>"/>
			<input type="hidden" name="number_rooms" value="<?php echo $hotel_dect['hotel-search-response']['search-criteria']['number-of-rooms']; ?>"/>
			<input type="hidden" name="number_nights" value="<?php echo  $hotel_dect['hotel-search-response']['search-criteria']['number-of-nights']; ?>"/>
			<input type="hidden" name="number_room-nights" value="<?php echo $hotel_dect['hotel-search-response']['search-criteria']['number-of-room-nights']; ?>"/>
			<input type="hidden" name="city" value="<?php echo $hotel_dect['hotel-search-response']['search-criteria']['city']; ?>"/>
			<input type="hidden" name="country" value="<?php echo $hotel_dect['hotel-search-response']['search-criteria']['country']; ?>"/>
<input type="hidden" name="req" value="<?php echo $post['req']; ?>"/>
			<input type="hidden" name="room_code" value="<?php echo $post['room_code']; ?>"/>
			<input type="hidden" name="booking_code" value="<?php echo $post['booking_code']; ?>"/>
			<input type="hidden" name="hotel_id" value="<?php echo $post['hotel_id']; ?>"/>
<input type="hidden" name="hotel_name" value="<?php echo $hotels_details['hotel-info:hotel-name']; ?>"/>
<input type="hidden" name="hotel_address" value="<?php echo $hotels_details['hotel-info:address']; ?>"/>

		        <input type="hidden" name="postvalue" value="<?php echo $post['postvalue']; ?>"/>	
<input type="hidden" name="ctype" value="hotels2"/>	
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey" style="font-weight: normal;">
					<div class="padding30">
						<img src="<?php echo $post['image']; ?>" style="width: 60px;
height: 54px;" class="left margright20" alt=""/>
						<span class="opensans size18 dark bold"><?php echo $hotels_details['hotel-info:hotel-name']; ?></span><br>
						<br><span class="opensans size13 grey" style="margin-left: 73px;"><?php if(isset($hotels_details['hotel-info:hotel-name'])) echo $address2 = $hotels_details['hotel-info:address'];  ?>, 
        <?php echo $hotels_details['hotel-info:locality']; ?></span><br/>
						
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							
							<tr>
								<td colspan=2><span class="dark">Room </span>:</td><td> <?php echo $post['room_dec']; ?></td>
							</tr>
							<tr>
								<td colspan=2><span class="dark"> Nights</span>:</td><td> <?php echo $check_in = date('M d',strtotime($hotel_dect['hotel-search-response']['search-criteria']['check-in-date'])); ?> - <?php echo $check_out = date('M d',strtotime($hotel_dect['hotel-search-response']['search-criteria']['check-out-date'])); ?></td>
							</tr>


<?php //echo '<pre>'; print_r($hotels_rooms); exit;
if(array_key_exists("0",$hotels_rooms['room-rate'])){ 
foreach($hotels_rooms['room-rate'] as $rooms) {

if($rooms['room-type']['room-type-code']==$post['room_code']) {
 $rate=$rooms['rate-breakdown']['common:rate']; 
  
  if (array_key_exists("0",$rate)){
foreach($rate as $room_rate){
//echo '<pre>'; print_r($room_rate); exit;
$rates=$room_rate['common:pricing-elements']['common:pricing-element'];
$tax=0;foreach($rates as $room_rates){

if($room_rates['common:category']=='BF'){
$mainamount=$room_rates['common:amount'];
}elseif($room_rates['common:category']=='TAX'){
$tax=$room_rates['common:amount']+$tax;
}elseif($room_rates['common:category']=='DIS'){
$DIS=$room_rates['common:amount'];
}

}


?>

							<tr>
								<td colspan=2>
									<span class="dark"><?php echo $check_in = date('M d',strtotime($room_rate['common:date'])); ?>  </span>: <br/>
									 
									<!-- Collapse 1 -->	
									
									
										<div class="left size12 dark">
											Room prices<br>
											Taxes & Fees per night
										</div></td><td>
										<div class=" size12"><br>
										&#x20b9 <?php echo $mainamount; ?> <br>
										&#x20b9 <?php echo $tax; ?>
										</div><div class="clearfix"></div>	
									
									<!-- End of collapse 1 -->
									<div class="clearfix"></div>	
									
									
									<!-- Collapse 1 -->	
									
									
								</td></tr>
<?php } }else{ 
if($rooms['room-type']['room-type-code']==$post['room_code']) {
$rates=$rooms['rate-breakdown']['common:rate']['common:pricing-elements']['common:pricing-element'];
$tax=0;foreach($rates as $room_rates){
if($room_rates['common:category']=='BF'){
$mainamount=$room_rates['common:amount'];
}elseif($room_rates['common:category']=='TAX'){
$tax=$room_rates['common:amount']+$tax;
}elseif($room_rates['common:category']=='DIS'){
$DIS=$room_rates['common:amount'];
}

}

?>   

<tr>
								<td colspan=2>
									<span class="dark"><?php echo $check_in = date('M d',strtotime($rooms['rate-breakdown']['common:rate']['common:date'])); ?>  </span> <br/>
									 
									<!-- Collapse 1 -->	
									
									
										<div class="left size12 dark">
											Room prices<br>
											Taxes & Fees per night
										</div></td><td>
										<div class=" size12"><br>
										&#x20b9 <?php echo $mainamount; ?> <br>
										&#x20b9 <?php echo $tax; ?>
										</div><div class="clearfix"></div>	
									
									<!-- End of collapse 1 -->
									<div class="clearfix"></div>	
									
									
									<!-- Collapse 1 -->	
									
									
								</td></tr>



<?php   } } } } }else{
$rooms=$hotels_rooms['room-rate']; 
$rate=$rooms['rate-breakdown']['common:rate'];
if (array_key_exists("0",$rate)){
foreach($rate as $room_rates){
$rates=$room_rates['common:pricing-elements']['common:pricing-element'];
$tax=0;foreach($rates as $room_rates){
if($room_rates['common:category']=='BF'){
$mainamount=$room_rates['common:amount'];
}elseif($room_rates['common:category']=='TAX'){
$tax=$room_rates['common:amount']+$tax;
}elseif($room_rates['common:category']=='DIS'){
$DIS=$room_rates['common:amount'];
}

}


?>	




<tr>
								<td colspan=2>
									<span class="dark"><?php echo $check_in = date('M d',strtotime($room_rate['common:date'])); ?>  </span> <br/>
									 
									<!-- Collapse 1 -->	
									
									
										<div class="left size12  dark">
											Room prices<br>
											Taxes & Fees per night
										</div></td><td>
										<div class="size12"><br>
										&#x20b9 <?php echo $mainamount; ?> <br>
										&#x20b9 <?php echo $tax; ?>
										</div><div class="clearfix"></div>	
									
									<!-- End of collapse 1 -->
									<div class="clearfix"></div>	
									
									
									<!-- Collapse 1 -->	
									
									
								</td></tr>

<?php } } } ?>							
	<?php if(isset($DIS)) { ?>							
		<tr>
								<td colspan=2 class="dark">Discount amount	</td>
														<td><div class="size12">&#x20b9 <?php echo round(str_replace('-','',$DIS)); ?></div></td>
</tr>	
<?php } ?>							
							
						</table>
					</div>	
					<div class="line3"></div>
					<div class="padding20">					
						<span class="left size14 dark " style="font-weight:normal;">Trip Total</span>
                                                <span id="priceloader" style="margin-left:10px;" ></span>
						<span  class="right" style="text-align: right;font-weight:normal;" >₹ 
                                                    <?php echo round($total); ?>
                                                <br/>
                                                
                                                 <font  size="1" color="grey">( Inclusive Tax )</font>
                                                </span>
                                                
                                               
					</div>
                                        
                                        <?php 
                                        
                                        $offer = Offerhelper::offer_calculate(8,round($total));    
                                        
                                        if(!empty($offer)){ ?>
                                        <div class="padding20">					
                                        <span class="left size14 dark" style="font-weight:normal;">SmartBuy Exclusive Offer</span>

                                        <span class="right " style="color:#e20613;font-weight:normal;"> ₹ <?php echo $offer['discount_amount'];?> </span>

                                        </div>
                                        
                                        <div class="padding20" >					
					<span class="left size14 dark" style="font-weight:normal;">Payable Amount</span>
	
<span  class="right" style="text-align: right;font-weight:normal;">₹ <?php echo round(round($total) - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                        <?php } ?>

				</div><br/>
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
			
			s_email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
			email:true	
				},
				firstname : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				lastname : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				title : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				citys : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				state : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				country : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				phonenumber : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				email : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
				
				},
				address : {
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
	
