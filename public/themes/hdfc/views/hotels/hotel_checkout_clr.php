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
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	
<?php $hotels_details=$hotel_dect['hotel-search-response']['hotels']['hotel']['basic-info'];
 $hotels_rooms=$hotel_dect['hotel-search-response']['hotels']['hotel']['room-rates'];
//echo '<pre>'; print_r($hotels_rooms); exit; 
?>
	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
	<form method="post" action="<?php echo $url = URL::action('Hotels@Hotel_clrn_Checkout_final'); ?>" id="hotel_checkout" name="hotel_checkout" accept-charset="UTF-8">		
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">		
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					<span class="size16px bold dark left">Who's traveling? </span>
					<div class="roundstep  right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					
					<div class="col-md-4">
						<div class="margtop15"><span class="dark">Contact Name:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-2">
						<span class="size12">Title*</span>
						<select class="form-control " name="title">
						  <option vlaue="Mr" selected>Mr</option>
						  <option  vlaue="Ms">Ms</option>
							<option  vlaue="Mrss">Mrs</option>
						</select>
					</div>
					<div class="col-md-3">
						<span class="size12">First Name*</span>
						<input type="text" name="firstname" class="form-control " placeholder="">
					</div>
					<div class="col-md-3">
						<span class="size12">Last Name*</span>
						<input type="text" name="lastname" class="form-control " placeholder="">
					</div>
					<div class="clearfix"></div>
					
					<br/>
					<div class="col-md-4">
						<div class="margtop15"><span class="dark">Details:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-4">
						<span class="size12">Email*</span>						
						<input type="text" name="email" class="form-control " placeholder="">
					</div>
					<div class="col-md-4 textleft">
						<span class="size12">Preferred Phone Number*</span>	
						<input type="text" name="cmobile" class="form-control" placeholder="">
					</div>
					<div class="clearfix"></div>

					<br/>
					<div class="col-md-4">
						<div class="margtop7"><span class="dark">Address:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-8">
						<span class="size12">Address*</span>						
						<textarea name="address" rows="3" class="form-control margtop10"></textarea>
					</div>
					<div class="clearfix"></div>

					<br/>

					<div class="col-md-4 textleft">
					</div>
					
					<div class="clearfix"></div>
					<div class="col-md-4 textright">
						<div class="margtop7"></div>
					</div>
					<div class="col-md-4">
						<span class="size12">City*</span>	
						<input type="text" name="citys" class="form-control" placeholder="">
					</div>
					
					
					<div class="col-md-4">
						<span class="size12">Pincode*</span>						
						<input type="text" name="postal" class="form-control " placeholder="">
					</div>
<div class="clearfix"></div>

					<br/>

					<div class="col-md-4 textleft">
					</div>
					
					<div class="clearfix"></div>
					<div class="col-md-4 textright">
						<div class="margtop7"></div>
					</div>
					<div class="col-md-4 textleft">
						<span class="size12">Country*</span>	
						<input type="text" name="country_clr" class="form-control" placeholder="">
					</div>
					
					<div class="clearfix"></div>

					<br/>
					<div class="col-md-4">
					</div>
					
					<div class="clearfix"></div>
					
					<br/>
					
					
					<span class="size16px bold dark left">Where can we reach you?</span>
					<div class="roundstep right">2</div>
					<div class="clearfix"></div>
					<div class="line4"></div>


					<?php		
					$mess="<span class='size16px bold dark left'>Review and book your trip</span>
					<div class='roundstep right'>3</div>
					<div class='clearfix'></div>
					<div class='line4'></div>
					<div class='alert alert-info'>	<b><span class='attention'>Attention!</span><span class='attention_sub'> Please read important hotel booking information!:</span></b><br/><br/>
                                        <p class='size12' style='font-size: 13px'>• This ticket is booked though our partner Cleartrip.</p>
                                        <p class='size12' style='font-size: 13px;'>• For any query and/or activity related to the service and/or modification and cancellation, please contact Cleartrip at agencysupport@cleartrip.com and +91 124 4837444/ 445/ 448. Refund on hotel booking will be as per the hotel rules.</p>
 <p class='size12' style='font-size: 13px;'>• All bookings, modifications and cancellations are subject to Partner terms and conditions. </p>
                                        <p class='size12' style='font-size: 13px;'>• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side.</p>
                                       
                                        <p class='size12' style='font-size: 13px'>• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
					</div>	
							
					By clicking on continue booking I acknowledge that I have read and accept the rules & restrictions, ".HTML::link('content/Terms & Conditions', 'Terms & conditions ',array("target"=>"_blank")) ."and". HTML::link('content/Privacy Policy', ' Privacy Policy',array("target"=>"_blank")).".<br/>'";
					$check_data=array('msg'=>$mess);
						
					$view = View::make('checkout/common',$check_data);
					echo $view; 
					?>	
					
						
					
		<br><br>	
				
		
			</div>
<?php $total=$post['total_amount'];?>
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
			<input type="hidden" name="room_code" value="<?php echo $post['room_type_code']; ?>"/>
			<input type="hidden" name="booking_code" value="<?php echo $post['booking_code']; ?>"/>
			<input type="hidden" name="hotel_id" value="<?php echo $post['hotelid']; ?>"/>
<input type="hidden" name="hotel_name" value="<?php echo $hotels_details['hotel-info:hotel-name']; ?>"/>
<input type="hidden" name="hotel_address" value="<?php echo $hotels_details['hotel-info:address']; ?>"/>
<input type="hidden" name="room_dec" value="<?php echo $post['room_dec']; ?>"/>	
		        <input type="hidden" name="postvalue" value="<?php echo $post['postvalue']; ?>"/>	
<input type="hidden" name="ctype" value="cleartrip"/>	
<input type="hidden" name="image" value="<?php echo $post['image']; ?>" />
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
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

if($rooms['room-type']['room-type-code']==$post['room_type_code']) {
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
									<span class="dark"><?php echo $check_in = date('M d',strtotime($room_rate['common:date'])); ?>  </span> <br/>
									 
									<!-- Collapse 1 -->	
									
									
										<div class="left size12 dark">
											Room prices<br>
											Taxes & Fees per night
										</div></td><td>
										<div class="size12"><br>
										&#x20b9 <?php echo round($mainamount); ?> <br>
										&#x20b9 <?php echo round($tax); ?>
										</div><div class="clearfix"></div>	
									
									<!-- End of collapse 1 -->
									<div class="clearfix"></div>	
									
									
									<!-- Collapse 1 -->	
									
									
								</td></tr>
<?php } }else{ 
if($rooms['room-type']['room-type-code']==$post['room_type_code']) {
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
										<div class="size12"><br>
										&#x20b9 <?php echo round($mainamount); ?> <br>
										&#x20b9 <?php echo round($tax); ?>
										</div><div class="clearfix"></div>	
									
									<!-- End of collapse 1 -->
									<div class="clearfix"></div>	
									
									
									<!-- Collapse 1 -->	
									
									
								</td></tr>



<?php   } } } } }else{
//echo '<pre>'; print_r($hotels_rooms); exit;
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
									
									
										<div class="left size12 lblue dark">
											Room prices<br>
											Taxes & Fees per night
										</div></td><td>
										<div class="right size12 lblue"><br>
										&#x20b9 <?php echo round($mainamount); ?> <br>
										&#x20b9 <?php echo round($tax); ?>
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
						<span class="left size14 dark">Trip Total</span>
                                                <span id="priceloader" style="margin-left:10px;" ></span>
						<span  class="right" style="text-align: right;" >₹ 
                                                    <?php echo round($total); ?>
                                                <br/>
                                                
                                                 <font  size="1" color="grey">( Inclusive Tax )</font>
                                                </span>
                                                
                                               
					</div>
                                        
					
                                        
                                        <?php 
                                        
                                        $offer = Offerhelper::offer_calculate(8,round($total));    
                                        
                                        if(!empty($offer)){ ?>
                                        <div class="padding20">					
                                        <span class="left size14 dark">SmartBuy Exclusive Offer</span>

                                        <span class="right " style="color:#e20613;"> ₹ <?php echo $offer['discount_amount'];?> </span>

                                        </div>
                                        
                                        <div class="padding20" >					
					<span class="left size14 dark">Net Payable Amount</span>
	
<span class="right" style="text-align: right;">₹ <?php echo round(round($total) - $offer['discount_amount'] );?> </span>
	
	
						<div class="clearfix"></div>
					</div>
                                        <?php } ?>
                                        <br/>
				</div><br/>
	</form>				
				
				
				
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
	
		
	</div>
	<!-- END OF CONTENT -->
<script type="text/javascript" >

$(document).ready(function() {
jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "This field only contain letters.");
 
	$("#hotel_checkout").validate({
		rules: {
			
			s_email : {
			required: {depends:function(){$(this).val();return true;} },
			email:true	
				},
				firstname : {
			required: {depends:function(){$(this).val();return true;} },
				lettersonly:true
				},
				lastname : {
			required: {depends:function(){$(this).val();return true;} },
				lettersonly:true
				},
				title : {
			required: {depends:function(){$(this).val();return true;} }
				
				},
				citys : {
			required: {depends:function(){$(this).val();return true;} },
			       lettersonly:true,
				},
				state : {
			required: {depends:function(){$(this).val();return true;} },
				lettersonly:true,
				
				},
				country_clr : {
			required: {depends:function(){$(this).val();return true;} }
				
				},
				postal : {
			required: {depends:function(){$(this).val();return true;} },
				number:true,
				minlength:5,
				maxlength:6
				},
				phonenumber : {
			required: {depends:function(){$(this).val();return true;} },
				number:true,
				minlength:10,
				maxlength:10
				},
				email : {
			required: {depends:function(){$(this).val();return true;} },
				email:true
				},
				address : {
			required: {depends:function(){$(this).val();return true;} }
				
				},
			
			s_email : {
			required: {depends:function(){$(this).val();return true;} },
			email:true	
				},
			mobile : {
			required: {depends:function(){$(this).val();return true;} },
				number:true,
				minlength:10,
				maxlength:10
				},
			cmobile : {
			required: {depends:function(){$(this).val();return true;} },
				number:true,
				minlength:10,
				maxlength:10
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
			},
			mobile: { 
			required: "This field is required.",
			minlength: "Please enter a valid mobile number."
			},
			phonenumber: { 
			required: "This field is required.",
			minlength: "Please enter a valid mobile number."
			},
			country: { 
			required: "This field is required.",
			number: "Please enter a valid country."
			},
			state: { 
			required: "This field is required.",
			number: "Please enter a valid state."
			},
			city: { 
			required: "This field is required.",
			number: "Please enter a valid city."
			},
			postal: { 
			required: "This field is required.",
			number: "Please enter a valid postal Number."
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
	
