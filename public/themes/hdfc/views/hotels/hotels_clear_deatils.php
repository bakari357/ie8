<style>
#line {width: 153px;height: 40px;}
.lh1 {
line-height: 22px !important;
}
.lh1 {
line-height: 30px !important;
font-size: 20px;
font-weight: bold;
}
.hdg-pg h4, h4 {
color: #006ebe;
width: 111%;
font: normal 14px 'Helvetica', Arial, sans-serif;
margin: 0;
padding: 1px;
}
</style>
    
	
	
	
	
	
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Hotels</a></li>
					<li>/</li>
					<li><a href="#">Details</a></li>
					<li>/</li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		
	</div>	

<?php $hotels_details=$room_dect['hotel-search-response']['hotels']['hotel']['basic-info'];
$hotels_room=(array)$room_dect['hotel-search-response']['hotels']['hotel']['room-rates'];
$hotels_img=$room_image['hotel-info']['other-info']['image-info']['image'];
//echo '<pre>'; print_r($room_image); exit;?>
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
						<?php  $c=0; foreach($hotels_img as $hotel_images) {
if($c==1){
$imgs='http://www.cleartrip.com/places/hotels/'.$hotel_images['wide-angle-image-url'].'';
}

                                      
                                       ?>
							<img src="http://www.cleartrip.com/places/hotels/<?php echo $hotel_images['wide-angle-image-url']; ?>" alt=""/>
							<?php $c++;}     ?> 
						</div>
					</div>
					<div id="pager-wrapper">
						<div id="pager">
	<?php  $c=0; foreach($hotels_img as $hotel_images) {


                                      
                                       ?>
							<img src="http://www.cleartrip.com/places/hotels/<?php echo $hotel_images['thumbnail-image-url']; ?>" alt=""/>
							<?php }     ?>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="{{Theme::asset()->url('images/spacer.png')}" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="{{Theme::asset()->url('images/spacer.png')}" alt=""/></button>		
					
		</div>
		</div> <!-- /c-carousel -->
			
			
			
			
			
			</div>
			<!-- END OF SLIDER -->			
			<!-- RIGHT INFO -->
			<div class="col-md-4 detailsright offset-0">
				<div class="padding20">
					<h4 class="lh1"><?php echo $hotels_details['hotel-info:hotel-name']; ?></h4>
<h5><?php if(isset($hotels_details['hotel-info:hotel-name'])) echo $address2 = $hotels_details['hotel-info:address'];  ?>, 
        <?php echo $hotels_details['hotel-info:locality']; ?></h5>

					
				</div>
				
				<div class="line3"></div>
				
				<div class="hpadding20">
					<h2 class="opensans slim green2" style="font-size: 20px;">Best Price Guarantee</h2>
				</div>
				
				<div class="line3 margtop20"></div>
				
				
				<div class="col-md-12 bordertype2_hot padding20">
					
				</div>
				
				
			</div>
			<!-- END OF RIGHT INFO -->

		</div>
		<!-- END OF container-->
		
		<div class="container mt25 offset-0">

			<div class="col-md-8 pagecontainer2 offset-0">
				<div class="cstyle10"></div>
		
				<ul class="nav nav-tabs" id="myTab">
					<li onclick="mySelectUpdate()" id="line" class=""><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext">Amenities & info</span>&nbsp;</a></li>
					<li onclick="mySelectUpdate()" id="line" class="active"><a data-toggle="tab" href="#roomrates"><span class="rates"></span><span class="hidetext">Room rates</span>&nbsp;</a></li>
					<li onclick="mySelectUpdate()" id="line" class=""><a data-toggle="tab" href="#preferences"><span class="preferences"></span><span class="hidetext">Policies & Fees</span>&nbsp;</a></li>
					
				</ul>			
				<div class="tab-content4" >
					<!-- TAB 1 -->				
					<div id="summary" class="tab-pane fade">
						<p class="hpadding20">
						<?php echo '<pre style="background: none;
border: 0px;

font-family:  Helvetica, Arial, sans-serif;
font-size: 14px;
line-height: 1.428571429;
color: #999;
/* background-color: #edf2f7; */
font-weight: 400;">'; echo $room_image['hotel-info']['other-info']['description']; echo '</pre>';?>

						</p>
							<div class="clearfix"></div>
						
						<!-- End of collapse 6 -->								
				
					</div>
					<!-- TAB 2 -->
					<div id="roomrates" class="tab-pane fade active in">
					    <br/>
						
						<p class="hpadding20 dark">Room type</p>
<div class="line2"></div>

<?php 

if(array_key_exists("0",$hotels_room['room-rate'])){
 foreach($hotels_room['room-rate'] as $rooms) { ?>
<form method="post" action="<?php echo $url = URL::action('Hotels@Hotel_clrn_Checkout'); ?>" accept-charset="UTF-8" >
					<div class="padding20">
							<div class="col-md-4 offset-0">
								<a href="#"><img src="<?php echo $imgs; ?>" alt="" class="fwimg"/></a>
							</div>
							<div class="col-md-8 offset-0">
								<div class="col-md-8 mediafix1" style="padding: 14px;">
									<h4 class="opensans dark bold margtop1 lh1"><?php echo $rooms['room-type']['room-description']; ?></h4>
									
									
									<div class="clearfix"></div>
									
								</div>
								<div class="col-md-4 center bordertype4">
<?php  $rate=$rooms['rate-breakdown']['common:rate'];
if (array_key_exists("0",$rate)){
$total_prices=0;foreach($rate as $room_rate){
//echo '<pre>'; print_r($room_rate); exit;
$rates=$room_rate['common:pricing-elements']['common:pricing-element'];
$prices=0;$tax=0;foreach($rates as $room_rates){

if($room_rates['common:category']=='BF'){
$mainamount=$room_rates['common:amount'];
}elseif($room_rates['common:category']=='TAX'){
$tax=$room_rates['common:amount']+$tax;
}
$prices=$prices+$room_rates['common:amount'];
}
$total_prices=$prices+$total_prices;
}

}else{
$rates=$rooms['rate-breakdown']['common:rate']['common:pricing-elements']['common:pricing-element'];
$total_prices=0;$prices=0;$tax=0;foreach($rates as $room_rates){
if($room_rates['common:category']=='BF'){
$mainamount=$room_rates['common:amount'];
}elseif($room_rates['common:category']=='TAX'){
$tax=$room_rates['common:amount']+$tax;
}
$prices=$prices+$room_rates['common:amount'];
}
$total_prices=$prices+$total_prices;
}
 ?>

									<span class="opensans green size24">&#x20b9 <?php echo round($mainamount); ?></span><br/>

									<span class="opensans lightgrey size13">avg/night</span><br/><br/>
									<br/>
									<button type="submit" class="bookbtn mt1">Book</button>	
								</div>										
							</div>
							<div class="clearfix"></div>
						</div>
<div class="line2"></div>
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" name="req"  value="<?php echo $req;?>" />
<input type="hidden" name="hotelid"  value="<?php echo $hotelid;?>" />
<input type="hidden" name="city"  value="<?php echo $city;?>" />
<input type="hidden" name="country_code"  value="<?php echo $country_code;?>" />
<input type="hidden" name="room_type_code" id="hotelid" value="<?php echo $rooms['room-type']['room-type-code']; ?>" />
<input type="hidden" name="room_dec"  value=" <?php echo $rooms['room-type']['room-description']; ?>" />
<input type="hidden" name="main_amount"  value="<?php echo $mainamount;?>" />
<input type="hidden" name="tax_amount" value="<?php echo $tax;?>" />
<input type="hidden" name="total_amount" value="<?php echo $total_prices;?>" />
<input type="hidden" name="postvalue" value="<?php echo $postvalue;?>" />
<input type="hidden" name="booking_code" value="<?php echo $rooms['booking-code'];?>" />
<input type="hidden" name="image" value="<?php echo $imgs; ?>" />
</form>





<?php } } else { 
$rooms=$hotels_room['room-rate'];
?>


<form method="post" action="<?php echo $url = URL::action('Hotels@Hotel_clrn_Checkout'); ?>" accept-charset="UTF-8" >
					<div class="padding20">
							<div class="col-md-4 offset-0">
								<a href="#"><img src="images/items2/item1.jpg" alt="" class="fwimg"/></a>
							</div>
							<div class="col-md-8 offset-0">
								<div class="col-md-8 mediafix1">
									<h4 class="opensans dark bold margtop1 lh1"><?php echo $rooms['room-type']['room-description']; ?></h4>
									
									
									<div class="clearfix"></div>
									<ul class="checklist2 margtop10">
										<li>FREE Cancellation</li>
										<li>Pay at hotel or pay today </li>
									</ul>									
								</div>
								<div class="col-md-4 center bordertype4">
<?php  $rate=$rooms['rate-breakdown']['common:rate'];
if (array_key_exists("0",$rate)){
$total_prices=0;foreach($rate as $room_rates){
$rates=$room_rates['common:pricing-elements']['common:pricing-element'];
$prices=0;$tax=0;foreach($rates as $room_rates){
if($room_rates['common:category']=='BF'){
$mainamount=$room_rates['common:amount'];
}elseif($room_rates['common:category']=='TAX'){
$tax=$room_rates['common:amount']+$tax;
}
$prices=$prices+$room_rates['common:amount'];
}
$total_prices=$total_prices+$prices;
}

}else{
$rates=$rooms['rate-breakdown']['common:rate']['common:pricing-elements']['common:pricing-element'];
$total_prices=0;$prices=0;$tax=0;foreach($rates as $room_rates){
if($room_rates['common:category']=='BF'){
$mainamount=$room_rates['common:amount'];
}elseif($room_rates['common:category']=='TAX'){
$tax=$room_rates['common:amount']+$tax;
}
$prices=$prices+$room_rates['common:amount'];
}
$total_prices=$total_prices+$prices;
}
 ?>

									<span class="opensans green size24">&#x20b9 <?php echo $mainamount; ?></span><br/>

									<span class="opensans lightgrey size13">avg/night</span><br/><br/>
									
									<button type="submit" class="bookbtn mt1">Book</button>	
								</div>										
							</div>
							<div class="clearfix"></div>
						</div>
<div class="line2"></div>
<input type="hidden" name="req"  value="<?php echo $req;?>" />
<input type="hidden" name="hotelid"  value="<?php echo $hotelid;?>" />
<input type="hidden" name="city"  value="<?php echo $city;?>" />
<input type="hidden" name="country_code"  value="<?php echo $country_code;?>" />
<input type="hidden" name="room_type_code" id="hotelid" value="<?php echo $rooms['room-type']['room-type-code']; ?>" />
<input type="hidden" name="room_dec"  value=" <?php echo $rooms['room-type']['room-description']; ?>" />
<input type="hidden" name="main_amount"  value="<?php echo $mainamount;?>" />
<input type="hidden" name="tax_amount" value="<?php echo $tax;?>" />
<input type="hidden" name="total_amount" value="<?php echo $total_prices;?>" />
<input type="hidden" name="postvalue" value="<?php echo $postvalue;?>" />
<input type="hidden" name="booking_code" value="<?php echo $rooms['booking-code'];?>" />
<input type="hidden" name="image" value="<?php echo $imgs; ?>" />
</form>


<?php } ?>
						
						
						
					</div>
					
					<!-- TAB 3 -->					
					<div id="preferences" class="tab-pane fade">
						<p class="hpadding20">
						 <?php $terms='By proceeding with this reservation, you agree to all terms and conditions, which include the Cancellation Policy and all terms and conditions contained in the User Agreement. You agree to pay the cost of your reservation. If you do not pay this debt and it is collected through the use of a collection Hotel Collect, an attorney, or through other legal proceedings, you agree to pay all reasonable costs or fees, including attorney fees and court costs, incurred in connection with such collection effort.'?>
                                <?php echo $terms;?> 
						</p>
						</div>
						<!-- End of collapse 8 -->				
						
						
					</div>
					</div>
					
			
			<div class="col-md-4" >
				
				
				
							
			
			</div>
		</div>
		
		
		
	</div>
	<!-- END OF CONTENT -->
	
	
	


	
	
	
