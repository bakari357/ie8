<style>
#line {width: 153px;height: 40px;}
.lh1 {
line-height: 30px !important;
font-size: 20px;
font-weight: bold;
}
.pr_hot{
background: none;
padding: 4px 0;
border: none;
color: #fff;
font-size: 12px;
font-family: 'Helvetica', Arial, sans-serif;
outline: none;
}
</style>
    
	<link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css"> 
	
	
	
	
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="Hotels" class="active">Hotels</a></li>	
                                        <li>/</li>
					
					<li><a href="#">Details</a></li>
									
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	
<?php $hotels_details=array(); 
foreach(Theme::get('hotels_details') as $key => $hotels){

 $hotels_details[$key] = $hotels; 
}

  $hotels_details= array_filter($hotels_details);
  

  ?>

	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0" style="max-height: 360px;overflow: hidden;">	

			<!-- SLIDER -->
			<div class="col-md-8 details-slider">
			
				<div id="c-carousel_hot">
				<div id="wrapper_hot">
				<div id="inner_hot">
					<div id="caroufredsel_wrapper2" style="width:500px !important; padding: 7px 2px 2px 205px;">
						<div id="carousel" >
							<?php   foreach($hotels_details['HotelImages']['HotelImage'] as $hotel_images) {


                $ima1 = str_replace('http:','https:',$hotel_images['url']);                        
                                       ?>
							<img src="<?php echo str_replace('_t.jpg','_b.jpg',$hotel_images['thumbnailUrl']); ?>"  alt=""/>
							<?php }    ?>  
						</div>
					</div>
					<div id="pager-wrapper">
						<div id="pager">
														<?php  $c=0; foreach($hotels_details['HotelImages']['HotelImage'] as $hotel_images) {


                $ima1 = str_replace('http:','https:',$hotel_images['url']);                        
                                       ?>
							<img src="<?php echo str_replace('_t.jpg','_b.jpg',$hotel_images['thumbnailUrl']); ?>" alt=""/>
							<?php }     ?> 
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="{{Theme::asset()->url('images/spacer.png')}" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="{{Theme::asset()->url('images/spacer.png')}" alt=""/></button>		
					
		</div>
“Note: It is the responsibility of the hotel chain and/or the individual property to ensure the accuracy of the photos displayed. ‘ Yourwebsite.com’ is not responsible for any inaccuracies in the photos.”
		</div> <!-- /c-carousel -->
			
			
			
			
			
			</div>
			<!-- END OF SLIDER -->			
			
			<!-- RIGHT INFO -->
			<div class="col-md-4 detailsright offset-0">
				<div class="padding20">
					<h4 class="lh1"><?php echo $hotels_details['HotelSummary']['name']; ?></h4><br>
<h5><?php if(isset($hotels_details['HotelSummary']['address2'])) echo $address2 = $hotels_details['HotelSummary']['address2']; else echo $address2 = $hotels_details['HotelSummary']['address1']; ?>, 
        <?php echo $hotels_details['HotelSummary']['city']; ?></h5>

					
				</div>
				
				<div class="line3"></div>
				
				<div class="hpadding20">
					<h2 class="opensans slim green2" style="font-size: 20px;">Best Price Guarantee</h2>
				</div>
				
				<div class="line3 margtop20"></div>
				
				
				<div class="col-md-12 bordertype2_hot padding20">
					<img src="themes/hdfc/assets/images/filter-rating-<?php echo round($hotels_details['HotelSummary']['hotelRating']) ; ?>.png" class="imgpos1" alt=""/><span class="opensans size30 bold grey2"><?php echo $hotels_details['HotelSummary']['hotelRating'] ; ?></span>/5<br/>
					Guest Ratings
				</div>
				
				
			</div>
			<!-- END OF RIGHT INFO -->

		</div>
		<!-- END OF container-->
		
		<div class="container mt25 offset-0">

			<div class="col-md-8 pagecontainer2 offset-0">
				<div class="cstyle10 color_hot"></div>
		
				<ul class="nav nav-tabs" id="myTab">
					<li onclick="mySelectUpdate()" id="line" class=""><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext">Amenities & info</span>&nbsp;</a></li>
					<li onclick="mySelectUpdate()" id="line" class="active"><a data-toggle="tab" href="#roomrates"><span class="rates"></span><span class="hidetext">Room rates</span>&nbsp;</a></li>
					<li onclick="mySelectUpdate()" id="line" class=""><a data-toggle="tab" href="#preferences"><span class="preferences"></span><span class="hidetext">Policies & Fees</span>&nbsp;</a></li>
					
				</ul>			
				<div class="tab-content4" >
					<!-- TAB 1 -->				
					<div id="summary" class="tab-pane fade">
						<div class="container">
						<div style="padding: 14px;"><?php echo html_entity_decode($hotels_details['HotelDetails']['propertyDescription']); ?> </div>
						</div>
						<div class="line4"></div>
						
						
						<!-- Collapse 6 -->	
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse6">
						  <?php echo 'Property Amenities';?> <span class="collapsearrow"></span>
						</button>
						
						<div id="collapse6" class="collapse in">
							<div class="hpadding20">
								<div class="col-md-8">
									<ul class="checklist">
										<?php 
                                if(isset($hotels_details['PropertyAmenities']['PropertyAmenity']))
                                {
                                foreach($hotels_details['PropertyAmenities']['PropertyAmenity'] as $prp_amentis) { ?>
                                
                                <li><?php echo $prp_amentis['amenity'];?></li>

                                
                                <?php } 
                                }?> 
									</ul>
								</div>
								
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 6 -->								
				
					</div>
					<!-- TAB 2 -->
					<div id="roomrates" class="tab-pane fade active in">
					    <br/>
						
						<p class="hpadding20 dark">Room type</p>
<div class="line2"></div>
						<?php //echo '<pre>'; print_r($hotels_details['rem_det']['HotelRoomResponse']); exit;?>
                                     <?php if(!empty($hotels_details['rem_det']['HotelRoomResponse'])&& array_key_exists(0,$hotels_details['rem_det']['HotelRoomResponse'])){
                                     
               //echo '<pre>'; print_r($hotels_details['rem_det']['HotelRoomResponse']); exit;
                                      ?>
 <?php foreach($hotels_details['rem_det']['HotelRoomResponse'] as $rm_dt) { 
                            
                           
                              $sup_type=$rm_dt['supplierType'];
                                //$supplier_type=$rm_dt['']
                                $roomedetails=str_replace('"','quot',serialize($rm_dt));
                               
                                if($rm_dt['RateInfos']['RateInfo']['@priceBreakdown']==TRUE)
                                {
                                  foreach($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']as $row=>$val)
                                  {
                                  
                                    $cdata[$row]=$val;
                                 //echo '<pre>'; print_r($val); exit;
                                  
                                  
                                  
                                  }
                                   //print_r($rm); 
                                /*  foreach($rm as $key => $size)
                                          {
                                      echo '<pre>key =>'; print_r($key); //exit;
                                    //echo   $sz=$size[$key];
                                      
                                        
                                        } */
                                        
                                        if($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@currencyCode']=='INR')
                                        {
                                         if(isset($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@averageRate'])){
                                        $per_pr=$rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@averageRate'];
                                        }else{
                                        $per_pr=$rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@maxNightlyRate'];
                                        }
                                        
                                        
                                        if(isset($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@surchargeTotal']) && !empty($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@surchargeTotal']))
                                        {
                                        $tax=$rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@surchargeTotal'];
                                        }
                                        elseif(isset($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@commissionableUsdTotal']) && !empty($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@commissionableUsdTotal'])){
                                        $tax=$rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@commissionableUsdTotal'];
                                        }
                                                                         }
                                                                         else
                                        {
                                        if(isset($rm_dt['RateInfos']['RateInfo']['ConvertedRateInfo']['@averageRate'])){
                                        $per_pr=$rm_dt['RateInfos']['RateInfo']['ConvertedRateInfo']['@averageRate'];
                                        }else{
                                        $per_pr=$rm_dt['RateInfos']['RateInfo']['ConvertedRateInfo']['@maxNightlyRate'];
                                        }
                                        
                                        if(isset($rm_dt['RateInfos']['RateInfo']['ConvertedRateInfo']['@surchargeTotal']) && !empty($rm_dt['RateInfos']['RateInfo']['ConvertedRateInfo']['@surchargeTotal']))
                                        {
                                        $tax=$rm_dt['RateInfos']['RateInfo']['ConvertedRateInfo']['@surchargeTotal'];
                                        }
                                        elseif(isset($rm_dt['RateInfos']['RateInfo']['ConvertedRateInfo']['@commissionableUsdTotal']) && !empty($rm_dt['RateInfos']['RateInfo']['ConvertedRateInfo']['@commissionableUsdTotal'])){
                                        $tax=$rm_dt['RateInfos']['RateInfo']['ConvertedRateInfo']['@commissionableUsdTotal'];
                                        }
                                        }
                                        }
                                  $charge_info=json_encode($cdata);
                             
                                ?>
                                
						
						
						<div class="padding20">
							
							<div class="col-md-4 offset-0">
<a href="#"><img src="<?php if(isset($hotels_details['HotelImages']['HotelImage'][0]['url'])) echo $hotels_details['HotelImages']['HotelImage'][0]['url']; else echo  Theme::asset()->url('no-photo.png');?>" alt="" style="width: 244px;
height: 178px" class="fwimg"/></a></div>
								<div class="col-md-8 offset-0">
<div class="col-md-8 mediafix1" style="padding: 20px 30px;">
									<h4 class="opensans dark bold margtop1" style="line-height: 27px !important;"><?php echo trim($rm_dt['roomTypeDescription']);?></h4>
									<?php if(!empty($rm_dt['ValueAdds']['ValueAdd'])) {
                                     
                                       
                                       if(array_key_exists(0,$rm_dt['ValueAdds']['ValueAdd'])){
                                        foreach($rm_dt['ValueAdds']['ValueAdd'] as $rm_val) { ?>
                                        <?php echo ''.trim($rm_val['description']).'';?><br />
                                        <?php } 
                                        
                                        }
                                        else
                                        {
                                       echo ''.trim($rm_dt['ValueAdds']['ValueAdd']['description']).'';
                                        }
                                        
                                        
                                        } else echo "";?>
									
									<div class="clearfix"></div>
									
								</div>
<?php  
	$discount_amount=0;
	
	$supplierType=$rm_dt['supplierType'];
        $roomTypeCode=$rm_dt['roomTypeCode'];
        $rateCode=$rm_dt['rateCode'];                          
	if(isset($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@total']))
	$points=trim($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@total']);
	else
	$points=$per_pr*$sz;
	$rateKey; 
                                 $roomTypeCode;
                               $rateCode; 
	//echo '<pre>';print_r($rm_dt); exit;
	$nits=$rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['NightlyRatesPerRoom']['@size']
       // echo "<b>Non Refundable</b>";                             ?>
        
          <?php 
         // echo '</br>';
	//echo '</br>';echo '<b>Per Night</b>: '.$per_pr.' * 1 ' ?>
	<?php echo '</br>';
	//echo '</br>';
	if(!empty($tax)) {
	$room=$_POST['num_rooms'];$per_tax=($tax/$room)/$nits; 
	$totalpoints=$per_pr+$per_tax;
	//echo '<b>Tax Recovery Charges and Fees</b>:'. round($per_tax);
	}else
	{
	$totalpoints=$per_pr;
	} ?>

                                      <form method="post" action="<?php echo $url = URL::action('Hotels@Hotel_Checkout'); ?>" accept-charset="UTF-8">
								<div class="col-md-4 center bordertype4">

									<span class="opensans green size24">&nbsp; &#x20b9 <?php  echo  round($per_pr);?> </span><br/>
									<span class="opensans lightgrey size13">avg/night</span><br/><br/>
									
<?php 
if(isset($rm_dt['RateInfos']['RateInfo']['nonRefundable']) && ($rm_dt['RateInfos']['RateInfo']['nonRefundable']==1 ))
        echo "<span class='opensans lightgrey size13'>Non Refundable</span><br/><br/>";                             ?>
									<!--<button type="submit" class="bookbtn mt1">Book</button>	-->
 <a  class="btn_price tt1" style="padding: 0;
width: 107%;
background: #fff;
margin: 0;">
                                        <button type="submit" class="bookbtn mt1">Book
                                                <span class="tooltip" style="opacity: 1;background: #fff;">
                                                    <span class="top">
                                                        <section class="top_main_in">
                                                            <h3>Price Breakup</h3>
                                                            <div class="t-tip_row" style="width: auto;">
                                                            	<div>Per Night</div>
                                                                <div>1 x &#x20b9; <?php echo round($per_pr); ?></div>
                                                            </div>
                                                             <?php if(!empty($tax)) { ?>
                                                            <div class="t-tip_row" style="width: auto;">
                                                            	<div>Tax recovery<br>charges & fees Per night</div>
                                                                <div>1 x &#x20b9; <?php echo round($per_tax); ?></div>
                                                            </div>
                                                             <?php } ?>
                                                            
                                                            <div class="t-tip_row-btm" style="width: auto;">
                                                            	<div>Total Price</div>
                                            <div>&#x20b9; <?php  if(isset($totalpoints)) echo  round($totalpoints); else  echo  round($per_pr);?></div>
                                                            </div>
                                                            
                                                        </section>
                                                    </span>
                                                    <span class="bottom"></span>
                                                </span></button></a>
								</div>										
							</div>
							<div class="clearfix"></div>
						
								

                         </div>
			  <input type="hidden" name="pid" value="<?php echo $pid=1; ?>" />
                                <input type="hidden" name="postvalue" id="postvalue" value="<?php echo $postedvalue; ?>" />
                                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="image" id="image" value="<?php if(isset($hotels_details['HotelImages']['HotelImage'][0]['url'])) echo $hotels_details['HotelImages']['HotelImage'][0]['url']; else echo  Theme::asset()->url('no-photo.png');?>" /> 
                                <input type="hidden" name="hotelid" id="hotelid" value="<?php echo $data['hotelid'];?>" />
                                <input type="hidden" name="supplierType" id="supplierType" value="<?php if(isset($supplierType)) echo $supplierType; ?>" />
                                <input type="hidden" name="rateKey" id="rateKey" value="<?php echo $rateKey; ?>" />
                                <input type="hidden" name="roomTypeCode" id="roomTypeCode" value="<?php echo $roomTypeCode; ?>" />
                                <input type="hidden" name="rateCode" id="rateCode" value="<?php echo $rateCode; ?>" />
                                <!-- <?php $roominfo=str_replace('"','quot',serialize($rm_dt)); ?>-->
                                <input type="hidden" name="name" id="name" value="<?php echo $data['name']; ?>" />
                                 <input type="hidden" name="address2" id="address2" value="<?php echo $address2; ?>" />
                                 <input type="hidden" name="city" id="city" value="<?php echo $hotels_details['HotelSummary']['city']; ?>" />
                                 
                                <input type="hidden" name="rm_cd" id="rm_cd" value="<?php echo $rm_dt['roomTypeCode']; ?>" />
                                <input type="hidden" name="rm_desc" id="rm_desc" value="<?php echo $rm_dt['roomTypeDescription']; ?>" />
                                <input type="hidden" name="roomedetails" value="<?php echo $roomedetails; ?>" />
                                <input type="hidden" name="henco" value="" />
				
                                <?php if(!empty($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@total'])) { ?>
                                <input type="hidden" name="average_rate" id="average_rate" value="<?php echo trim($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@total']);?>" />
                                <input type="hidden" name="amount" value="<?php echo trim($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@total']);?>"/>
					 <input type="hidden" name="discount_amount" value="<?php echo $discount_amount; ?>"/>
                                
                              
                                <?php } else {?> <input type="hidden" name="average_rate" id="average_rate" value="" /> <?php }?>

                                </form>	
<div class="line2"></div>		
		<?php } } else { echo 'Sorry, currently rooms are not available at the selected hotel. Please try with new hotel.';  }?> 	
						
					</div>
					
					<!-- TAB 3 -->					
					<div id="preferences" class="tab-pane fade">
						<p class="hpadding20"></br>
						 <?php $terms='By proceeding with this reservation, you agree to all terms and conditions, which include the Cancellation Policy and all terms and conditions contained in the User Agreement. You agree to pay the cost of your reservation. If you do not pay this debt and it is collected through the use of a collection Hotel Collect, an attorney, or through other legal proceedings, you agree to pay all reasonable costs or fees, including attorney fees and court costs, incurred in connection with such collection effort.'?>
                                <?php echo $terms;?> 
						</p>
						
						
						<div id="collapse7" class="collapse in">
							<p class="hpadding20"><?php if(isset($hotels_details['HotelDetails']['propertyInformation']) && $hotels_details['HotelDetails']['propertyInformation'] <>'') echo $hotels_details['HotelDetails']['propertyInformation'];?></p>			
								<div class="clearfix"></div>
							</div>
							
						
						<!-- End of collapse 7 -->		
						<br/>
						<div class="line4"></div>									
						
						<!-- Collapse 8 -->	
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse8">
						  <?php echo 'Policies';?> <span class="collapsearrow"></span>
						</button>
						
						<div id="collapse8" class="collapse in">
							 <p class="hpadding20"> <?php if(isset($hotels_details['HotelDetails']['checkInInstructions'])) echo $hotels_details['HotelDetails']['checkInInstructions'];?><br></p>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 8 -->				
						
						
					</div>
<span style="font-size: 13px !important;">Note: It is the responsibility of the hotel chain and/or the individual property to ensure the accuracy of the photos displayed. SmartBuy is not responsible for any inaccuracies in the photos.</span>
					</div></div>
					
			
			<div class="col-md-4" >
				
				
				
							
			
			</div>
		</div>
		
		
		
	</div>
	<!-- END OF CONTENT -->
	
	
	


	
	
	
