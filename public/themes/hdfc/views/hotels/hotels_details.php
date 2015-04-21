<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script> 
	<script src="themes/hdfc/assets/assets/js/jquery-ui.js"></script>	
<script type="text/javascript" src="themes/hdfc/assets/plugins/jslider/js/jshashtable-2.1_src.js"></script>
	<script type="text/javascript" src="themes/hdfc/assets/plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
	<script type="text/javascript" src="themes/hdfc/assets/plugins/jslider/js/tmpl.js"></script>
	<script type="text/javascript" src="themes/hdfc/assets/plugins/jslider/js/jquery.dependClass-0.1.js"></script>
	<script type="text/javascript" src="themes/hdfc/assets/plugins/jslider/js/draggable-0.1.js"></script>
	<script type="text/javascript" src="themes/hdfc/assets/plugins/jslider/js/jquery.slider.js"></script>
<style>
.lh2 { line-height: 30px !important;
font-size: 20px;
font-weight: bold; }
</style>
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Hotels</a></li>
					<li>/</li>
					<li><a href="#">U.S.A.</a></li>
					<li>/</li>					
					<li><a href="#" class="active">New York</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	
<?php $hotels_details=array(); 
foreach(Theme::get('hotels_details') as $key => $hotels){

 $hotels_details[$key] = $hotels; 
}

  $hotels_details= array_filter($hotels_details);
  

  ?>
	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- SLIDER -->
			<div class="col-md-8 details-slider">
			
				<div id="c-carousel">
				<div id="wrapper">
				<div id="inner">
					<div id="caroufredsel_wrapper2">
						<div id="carousel" >
						<?php   foreach($hotels_details['HotelImages']['HotelImage'] as $hotel_images) {
                $ima1 = str_replace('http:','https:',$hotel_images['url']);                        
                                       ?>
							<img src="<?php echo str_replace('http:','https:',$hotel_images['thumbnailUrl']);?>" alt=""/>
							<?php }    ?>  
						</div>
					</div>
					<div id="pager-wrapper">
						<div id="pager">
<?php   foreach($hotels_details['HotelImages']['HotelImage'] as $hotel_images) {
                $ima1 = str_replace('http:','https:',$hotel_images['url']);                        
                                       ?>
							<img src="<?php echo str_replace('http:','https:',$hotel_images['thumbnailUrl']);?>" width="120" height="68" alt=""/>
							<?php }    ?>  
							
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="images/spacer.png" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="images/spacer.png" alt=""/></button>		
					
		</div>
		</div> <!-- /c-carousel -->
			
			
			
			
			
			</div>
			<!-- END OF SLIDER -->			
			
			<!-- RIGHT INFO -->
			<div class="col-md-4 detailsright offset-0">
				<div class="padding20">
					<span class="lh2"><?php echo $hotels_details['HotelSummary']['name']; ?></span><br>
<h5><?php if(isset($hotels_details['HotelSummary']['address2'])) echo $address2 = $hotels_details['HotelSummary']['address2']; else echo $address2 = $hotels_details['HotelSummary']['address1']; ?>, 
        <?php echo $hotels_details['HotelSummary']['city']; ?></h5>
					<img src="images/smallrating-5.png" alt=""/>
				</div>
				
				<div class="line3"></div>
				
				<div class="hpadding20">
					<h2 class="opensans slim green2">Wonderful!</h2>
				</div>
				
				<div class="line3 margtop20"></div>
				
				<div class="col-md-6 bordertype1 padding20">
					<span class="opensans size30 bold grey2">97%</span><br/>
					of guests<br/>recommend
				</div>
				<div class="col-md-6 bordertype2 padding20">
					<span class="opensans size30 bold grey2">4.5</span>/5<br/>
					guest ratings
				</div>
				
				
				<div class="clearfix"></div><br/>
				
				<div class="hpadding20">
					<a href="#" class="add2fav margtop5">Add to favourite</a>
					<a href="#" class="booknow margtop20 btnmarg">Book now</a>
				</div>
			</div>
			<!-- END OF RIGHT INFO -->

		</div>
		<!-- END OF container-->
		
		<div class="container mt25 offset-0">

			<div class="col-md-8 pagecontainer2 offset-0">
				<div class="cstyle10"></div>
		
				<ul class="nav nav-tabs" id="myTab">
					<li onclick="mySelectUpdate()" class=""><a data-toggle="tab"  href="#summary"><span class="summary"></span><span class="hidetext">Amenities & info</span>&nbsp;</a></li>
					<li  onclick="mySelectUpdate()" class="active"><a  data-toggle="tab" href="#roomrates"><span class="rates"></span><span class="hidetext">Room rates</span>&nbsp;</a></li>
					<li onclick="mySelectUpdate()" class=""><a  data-toggle="tab" href="#preferences"><span class="preferences"></span><span class="hidetext"> Policies & Fees</span>&nbsp;</a></li>
					

				</ul>			
				<div class="tab-content4" >
					<!-- TAB 1 -->				
					<div id="summary" class="tab-pane fade">
						<div class="container">
						<?php echo html_entity_decode($hotels_details['HotelDetails']['propertyDescription']); ?> 
						</div>
						<div class="line4"></div>
						
						
						<!-- Collapse 6 -->	
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse6">
						  <?php echo 'Property Amenities';?> <span class="collapsearrow"></span>
						</button>
						
						<div id="collapse6" class="collapse in">
							<div class="hpadding20">
								<div class="col-md-4">
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
							
							<div class="col-md-8 offset-0">
								<div class="col-md-8 mediafix1">
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
									<ul class="hotelpreferences margtop10">
										<li class="icohp-internet"></li>
										<li class="icohp-air"></li>
										<li class="icohp-pool"></li>
										<li class="icohp-childcare"></li>
										<li class="icohp-fitness"></li>
										<li class="icohp-breakfast"></li>
										<li class="icohp-parking"></li>
									</ul>
									<div class="clearfix"></div>
									<ul class="checklist2 margtop10">
										<li>FREE Cancellation</li>
										<li>Pay at hotel or pay today </li>
									</ul>									
								</div>
<?php  
	$discount_amount=0;
	
	if(isset($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@total']))
	$points=trim($rm_dt['RateInfos']['RateInfo']['ChargeableRateInfo']['@total']);
	else
	$points=$per_pr*$sz;
	
	
	if(isset($rm_dt['nonRefundable']) && $rm_dt['nonRefundable']=1)
       // echo "<b>Non Refundable</b>";                             ?>
        
          <?php 
         // echo '</br>';
	//echo '</br>';echo '<b>Per Night</b>: '.$per_pr.' * 1 ' ?>
	<?php echo '</br>';
	//echo '</br>';
	if(!empty($tax)) {
	$room=$_POST['num_rooms'];$per_tax=$tax/$room; 
	$totalpoints=$per_pr+$per_tax;
	//echo '<b>Tax Recovery Charges and Fees</b>:'. round($per_tax);
	}else
	{
	$totalpoints=$per_pr;
	} ?>

                                       <input type="hidden" value="<?php echo base64_encode($rm_dt['roomTypeCode']);?>" name="base64_roomTypeCode"/>
								<div class="col-md-4 center bordertype4">
									<span class="opensans green size24">&nbsp; <?php  echo  round($per_pr);?> ( <?php echo round($per_pr);?> Pts)</span><br/>
									<span class="opensans lightgrey size12">avg/night</span><br/><br/>
									<span class="lred bold">3 left</span><br/><br/>
									<button class="bookbtn mt1">Book</button>	
								</div>										
							</div>
							<div class="clearfix"></div>
						
						<div class="line2"></div>		

                    </div>         
						
		<?php } }?> 					
						
		</div> 				
					
					<!-- TAB 3 -->					
					<div id="preferences" class="tab-pane fade ">
						<p class="hpadding20">
						 <?php $terms='By proceeding with this reservation, you agree to all terms and conditions, which include the Cancellation Policy and all terms and conditions contained in the User Agreement. You agree to pay the cost of your reservation. If you do not pay this debt and it is collected through the use of a collection Hotel Collect, an attorney, or through other legal proceedings, you agree to pay all reasonable costs or fees, including attorney fees and court costs, incurred in connection with such collection effort.'?>
                                <?php echo $terms;?> 
						</p>
						
						<div class="line4"></div>
						
						<!-- Collapse 7 -->	
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse7">
						  <?php echo 'policies Fees';?> <span class="collapsearrow"></span>
						</button>
						
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
					
					<!-- TAB 4 -->					
					
					
							
					
					
					
					</div>						
				</div>
			
			
			<div class="col-md-4" >
				
				
				
				<div class="pagecontainer2 mt20 alsolikebox">
					<div class="cpadding1">
						<span class="icon-location"></span>
						<h3 class="opensans">You May Also Like</h3>
						<div class="clearfix"></div>
					</div>
					<div class="cpadding1 ">
						<a href="#"><img src="images/smallthumb-1.jpg" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br/>
						<span class="opensans green bold size14">$36-$160</span> <span class="grey">avg/night</span><br/>
						<img src="images/filter-rating-5.png" alt=""/>
					</div>
					<div class="line5"></div>
					<div class="cpadding1 ">
						<a href="#"><img src="images/smallthumb-2.jpg" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br/>
						<span class="opensans green bold size14">$36-$160</span> <span class="grey">avg/night</span><br/>
						<img src="images/filter-rating-5.png" alt=""/>
					</div>
					<div class="line5"></div>			
					<div class="cpadding1 ">
						<a href="#"><img src="images/smallthumb-3.jpg" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br/>
						<span class="opensans green bold size14">$36-$160</span> <span class="grey">avg/night</span><br/>
						<img src="images/filter-rating-5.png" alt=""/>
					</div>
					<br/>
				
					
				</div>				
			
			</div>
		</div>
		
		
		
	</div>
	<!-- END OF CONTENT -->
	
	
	


	
	
	<!-- FOOTER -->

	<div class="footerbgblack">
		<div class="container">		
			
			<div class="col-md-3">
				<span class="ftitleblack">Let's socialize</span>
				<div class="scont">
					<a href="#" class="social1b"><img src="images/icon-facebook.png" alt=""/></a>
					<a href="#" class="social2b"><img src="images/icon-twitter.png" alt=""/></a>
					<a href="#" class="social3b"><img src="images/icon-gplus.png" alt=""/></a>
					<a href="#" class="social4b"><img src="images/icon-youtube.png" alt=""/></a>
					<br/><br/><br/>
					<a href="#"><img src="images/logosmal2.png" alt="" /></a><br/>
					<span class="grey2">&copy; 2013  |  <a href="#">Privacy Policy</a><br/>
					All Rights Reserved </span>
					<br/><br/>
					
				</div>
			</div>
			<!-- End of column 1-->
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Golf Vacations</a></li>
					<li><a href="#">Ski & Snowboarding</a></li>
					<li><a href="#">Disney Parks Vacations</a></li>
					<li><a href="#">Disneyland Vacations</a></li>
					<li><a href="#">Disney World Vacations</a></li>
					<li><a href="#">Vacations As Advertised</a></li>
				</ul>
			</div>
			<!-- End of column 2-->		
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Weddings</a></li>
					<li><a href="#">Accessible Travel</a></li>
					<li><a href="#">Disney Parks</a></li>
					<li><a href="#">Cruises</a></li>
					<li><a href="#">Round the World</a></li>
					<li><a href="#">First Class Flights</a></li>
				</ul>				
			</div>
			<!-- End of column 3-->		
			
			<div class="col-md-3 grey">
				<span class="ftitleblack">Newsletter</span>
				<div class="relative">
					<input type="email" class="form-control fccustom2black" id="exampleInputEmail1" placeholder="Enter email">
					<button type="submit" class="btn btn-default btncustom">Submit<img src="images/arrow.png" alt=""/></button>
				</div>
				<br/><br/>
				<span class="ftitleblack">Customer support</span><br/>
				<span class="pnr">1-866-599-6674</span><br/>
				<span class="grey2">office@travel.com</span>
			</div>			
			<!-- End of column 4-->			
		
			
		</div>	
	</div>
	
	<div class="footerbg3black">
		<div class="container center grey"> 
		<a href="#">Home</a> | 
		<a href="#">About</a> | 
		<a href="#">Last minute</a> | 
		<a href="#">Early booking</a> | 
		<a href="#">Special offers</a> | 
		<a href="#">Blog</a> | 
		<a href="#">Contact</a>
		<a href="#top" class="gotop scroll"><img src="images/spacer.png" alt=""/></a>
		</div>
	</div>
