
<?php $hotels_details=array(); 
foreach(Theme::get('hotels_details') as $key => $hotels){

 $hotels_details[$key] = $hotels; 
}

  $hotels_details= array_filter($hotels_details);
  
// echo Theme::asset()->url('img/rs_symbol.png'); 
//echo '<pre>'; print_r( $hotels_details); exit;
 // echo '<pre>'; print_r($$hotels_details['rem_det']['HotelRoomResponse']);exit;
  ?>
<?php  //$rate_info=$room_info[0]['RateInfos']['RateInfo']['ChargeableRateInfo']; $cancel_polcy=$room_info[0]['cancellationPolicy']; $rcode=$room_info[0]['roomTypeCode'];  ?>
<style>

.thumb{margin: 4px;}
footer p{text-align: center}

</style>





<?php 
//print_r($postvalue1);
//$postedvalue=str_replace('"','quot',serialize($postvalue1)); 



?>
<section class="content_pad">

<?php 

if(!empty($hotels_details['HotelSummary'])) { ?>
            <section class="table_div space-pad">
            	<section class="top_head">
                	<section class="top_lft">
                        <h3><?php echo $hotels_details['HotelSummary']['name']; ?>,<?php if(isset($hotels_details['HotelSummary']['address2'])) echo $address2 = $hotels_details['HotelSummary']['address2']; else echo $address2 = $hotels_details['HotelSummary']['address1']; ?>, 
        <?php echo $hotels_details['HotelSummary']['city']; ?></h3>
                        <?php echo $hotels_details['HotelSummary']['city']; ?> (<?php echo $hotels_details['HotelSummary']['address1']; ?>)
                    </section>
                   <!-- <a href="#" class="select_button" rel="country0">Select Room</a>-->
                </section>
                <div class="tab_content_box"><!-- Tab content starts here-->
                    <ul id="countrytabs" class="shadetabs">
 			<li class="tab hot_room_rate"><a href="#" rel="country0"  class="selected">Rooms & rates</a></li>
                        <li class="tab" onclick="load_gal();"><a href="#" rel="country1"  >Photos</a></li>
                        <li class="tab"><a href="#" rel="country2">Amenities & info</a></li>   
                         <li class="tab"><a href="#" rel="country4"> Policies & Fees</a></li>
                       
                    </ul>
                       <div class="clear"></div>
                    <div class="tab_content_center">
                        <div id="country1" class="tabcontent">
                            <div class="tabcontent_box">
                          <?php if(isset($hotels_details['HotelImages']['HotelImage'])) 
                                        {   ?>
  <div id="gallery" class="ad-gallery">
  <div class="ad-image-wrapper"> </div>
  <div class="ad-controls"> </div>
  <div class="ad-nav">
    <div class="ad-thumbs">
      <ul class="ad-thumb-list">
     
                                 
                                     <?php   foreach($hotels_details['HotelImages']['HotelImage'] as $hotel_images) {
                                        
                                       ?>
                        <li>
                        
                           <?php //$ima= str_replace('_t.jpg','_b.jpg',$hotel_images['thumbnailUrl']);
                           $ima1 = str_replace('http:','https:',$hotel_images['url']);
                           ?>
                              <li><a href="<?php echo $ima1; ?>" id="t2"> 
                             
     <img src="<?php echo str_replace('http:','https:',$hotel_images['thumbnailUrl']);?>" title="sdfds" alt="" class="image1">  
          </a> </li>
                      <?php }    ?>  
                    
                   
   
           </ul>
</div>
</div>


</div>	
<?php }else { echo 'Currently no Photo Gallery is maintained by this hotel'; } ?>
                                   
</div>
</div>
 <?php } ?>  
                        <div id="country2" class="tabcontent">
                            <div class="tabcontent_box">
                              <section class="cont_pad">
                              <section class="amenties_lft">
                                <?php echo html_entity_decode($hotels_details['HotelDetails']['propertyDescription']); ?></section>
                                 <section class="amenties_rgt">
                                  <strong> <?php echo 'Property Amenities';?></strong>
                                
                                    <ul class="pad9">
                                        <?php 
                                if(isset($hotels_details['PropertyAmenities']['PropertyAmenity']))
                                {
                                foreach($hotels_details['PropertyAmenities']['PropertyAmenity'] as $prp_amentis) { ?>
                                
                                <li><?php echo $prp_amentis['amenity'];?></li>

                                
                                <?php } 
                                }?>        
                                    </ul>
                                    </section>
                                
                               
                                </section> 
                            </div>	
                        </div>
                        <div id="country4" class="tabcontent">
                            <div class="tabcontent_box">
                              <section class="cont_pad">
                                <section class="amenties_lft">
                                
                               
                                <div style="font-size:14px;padding:10px 0px 10px 0px;"><strong><?php echo 'policies Fees';?></strong></div><br>
                                <strong><?php echo 'Property Information';?></strong><section>
                              
                               
                                <?php if(isset($hotels_details['HotelDetails']['propertyInformation']) && $hotels_details['HotelDetails']['propertyInformation'] <>'') echo $hotels_details['HotelDetails']['propertyInformation'];?>
                                </section>
                                <section class="policy_cont">
                              <strong><?php echo 'Policies';?></strong>
                               
                               <p > <?php if(isset($hotels_details['HotelDetails']['checkInInstructions'])) echo $hotels_details['HotelDetails']['checkInInstructions'];?><br></p>
                                
                                <?php if(isset($sup_type)=='E') :?>
                                
                               <strong><?php echo 'policy for expedia collect hotels';?></strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php $terms='By proceeding with this reservation, you agree to all terms and conditions, which include the Cancellation Policy and all terms and conditions contained in the User Agreement. You agree to pay the cost of your reservation. If you do not pay this debt and it is collected through the use of a collection Hotel Collect, an attorney, or through other legal proceedings, you agree to pay all reasonable costs or fees, including attorney fees and court costs, incurred in connection with such collection effort.'?>
                                <?php echo $terms;?> 
                                
                                <?php endif ?>
                               

                        </section></section> 
                                </section> 
                            </div>	
                        </div>
                        <div id="country0" class="tabcontent">
                            <div class="tabcontent_box">	
                                <section class="rooms_table">
                                    <h4>Room & rates</h4>
                                    <?php //echo '<pre>'; print_r($hotels_details['rem_det']['HotelRoomResponse']); exit;?>
                                     <?php if(!empty($hotels_details['rem_det']['HotelRoomResponse'])&& array_key_exists(0,$hotels_details['rem_det']['HotelRoomResponse'])){
                                     
               //echo '<pre>'; print_r($hotels_details['rem_det']['HotelRoomResponse']); exit;
                                      ?>
                                     
                                    
                        <table cellpadding="0" cellspacing="0" border="0">
                      
                         <tr>
                            <th>Room type & Inclusions</th>
                            <th></th>
                            <th>Price</th>
                            <th></th>
                        </tr> 
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
                                
                               <tr>
                                        <td width="45%" align="left" valign="top"  >
                                       
                                        <?php echo trim($rm_dt['roomTypeDescription']);?>
                                        </br>

                                        <?php if(!empty($rm_dt['ValueAdds']['ValueAdd'])) {
                                     
                                       
                                       if(array_key_exists(0,$rm_dt['ValueAdds']['ValueAdd'])){
                                        foreach($rm_dt['ValueAdds']['ValueAdd'] as $rm_val) { ?>
                                        <?php echo '<p>'.trim($rm_val['description']).'</p>';?><br />
                                        <?php } 
                                        
                                        }
                                        else
                                        {
                                       echo '<p>'.trim($rm_dt['ValueAdds']['ValueAdd']['description']).'</p>';
                                        }
                                        
                                        
                                        } else echo "";?>
                                        </td>
                                        
                                        
                                         <td width="10%" align="left" valign="top"  ><?php  
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
	} ?></td>
                                        <td width="10%" align="left" valign="top" >
                                      
                                       {{ Form::open(array('action' => 'Hotels@Hotel_Booking')) }}
                                       <input type="hidden" value="<?php echo base64_encode($rm_dt['roomTypeCode']);?>" name="base64_roomTypeCode"/>
                                       <a  class="btn_price tt1" >
                                        <button style="background: none;padding: 4px 0;border: none;color: #fff;font-size: 12px;font-family: 'Helvetica', Arial, sans-serif;outline: none;"><img src="<?php echo Theme::asset()->url('img/rs_symbol.png');?>">&nbsp; <?php  echo  round($per_pr);?> ( <?php echo round($per_pr);?> Pts)
                                                <span class="tooltip">
                                                    <span class="top">
                                                        <section class="top_main_in">
                                                            <h3>Price Breakup</h3>
                                                            <div class="t-tip_row">
                                                            	<div>Per Night</div>
                                                                <div>1 x &#8377; <?php echo round($per_pr); ?></div>
                                                            </div>
                                                             <?php if(!empty($tax)) { ?>
                                                            <div class="t-tip_row">
                                                            	<div>Tax recovery<br>charges & fees</div>
                                                                <div>&#8377; <?php echo round($per_tax); ?></div>
                                                            </div>
                                                             <?php } ?>
                                                            
                                                            <div class="t-tip_row-btm">
                                                            	<div>Total Price</div>
                                            <div>&#8377; <?php  if(isset($totalpoints)) echo round($totalpoints) ; else  echo round($per_pr);?></div>
                                                            </div>
                                                            
                                                        </section>
                                                    </span>
                                                    <span class="bottom"></span>
                                                </span></button></a>
                                        
                                        
                                         <input type="hidden" name="pid" value="<?php echo $pid=1; ?>" />
                                <input type="hidden" name="postvalue" id="postvalue" value="<?php echo $postedvalue; ?>" />
                                
                                <input type="hidden" name="image" id="image" value="<?php if(isset($hotels_details['HotelImages']['HotelImage'][0]['url'])) echo $hotels_details['HotelImages']['HotelImage'][0]['url']; else echo  Theme::asset()->url('no-photo.png');?>" /> 
                                <input type="hidden" name="hotelid" id="hotelid" value="<?php echo $data['hotelid'];?>" />
                                <input type="hidden" name="supplierType" id="supplierType" value="<?php if(isset($supplierType)) echo $supplierType; ?>" />
                                <input type="hidden" name="rateKey" id="rateKey" value="" />
                                <input type="hidden" name="roomTypeCode" id="roomTypeCode" value="" />
                                <input type="hidden" name="rateCode" id="rateCode" value="" />
                                <!-- <?php $roominfo=str_replace('"','quot',serialize($rm_dt)); ?>-->
                                <input type="hidden" name="rateKey" id="rateKey" value="" />
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

                               {{ Form::close()}}
                                
                                </td>
                                        <td width="10%" align="left" valign="top" >
                                        <?php $change=unserialize(str_replace('quot','"',$postedvalue)); ?>
                                <form method="post" action="" >
                                  <input type="hidden" name="id" value="<?php echo $pid; ?>" />
                                <input type="hidden" name="check_in" id="check_in" value="<?php echo $change['check_in']; ?>" />
                                <input type="hidden" name="check_out" id="check_out" value="<?php echo $change['check_out']; ?>" />
                                <input type="hidden" name="num_rooms" id="num_rooms" value="<?php echo 1; ?> " />
                                <input type="hidden" name="cityname" id="cityname" value="<?php echo $change['cityname']; ?>" />
                                <input type="hidden" name="search_name" id="search_name" value="<?php echo $change['search_name']; ?>" />
                               <input type="hidden" name="henco" value="" />
                             <?php 
                             
                             $xmlurl='';  for($i=1;$i<=1;$i++) {
                             $o=$i-1;
			echo '<input type="hidden" name="numberOfAdults'.$i.'" value="" />'; 
			echo '<input type="hidden" name="numberOfChildren'.$i.'" value="" />';
			
			for($j=1;$j<=1;$j++)
			{
			if(!empty($change['room'.$i.'Child'.$j]))
			echo '<input type="hidden" name="room'.$i.'Child'.$j.'" value="'.$change['room'.$i.'Child'.$j].'" /> ';
			}
			}
                          
                          echo $xmlurl;     
                             ?>  
                               
                               
                               
                                  
                                        </form></td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                               
                                 
                                <?php }?>      
                        </table>
                   
                        <?php } else if(isset($hotels_details['rem_det']['HotelRoomResponse'])){ 
                       echo '<pre>'; print_r($hotels_details['rem_det']['HotelRoomResponse']); exit;
                        $single=$hotels_details['rem_det']['HotelRoomResponse'];
                     
$roomedetails=str_replace('"','quot',serialize($single));
                        ?>
                        <table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <th>Room type & Inclusions</th>
                                             <th></th>
                                            <th>Total </th>
                                            <th></th>
                                        </tr> 
                                        <tr>
                                <td width="45%" align="left" valign="top" >
                                <div  id="<?php echo $single['rateCode'];?>" >
                                
                                </div></br>
                                <?php echo trim($single['roomTypeDescription']);?>

                                <?php if(!empty($single['ValueAdds']['ValueAdd'])) {
                             //   echo lang('include');
                             
                             if(array_key_exists(0,$single['ValueAdds']['ValueAdd'])){
                                foreach($single['ValueAdds']['ValueAdd'] as $rm_val) {  
                                echo trim($rm_val['description']);
                               }
                                } else
                                {
                                echo trim($single['ValueAdds']['ValueAdd']['description']);
                                } } else echo "";?>
                                </td>
                                
                                <td width="10%" align="left" valign="top" >
                                <?php  
	$discount_amount=0;
	
	$points=trim($single['RateInfos']['RateInfo']['ChargeableRateInfo']['@total']);
	if(isset($single['RateInfos']['RateInfo']['ChargeableRateInfo']['@surchargeTotal']))
	$tax=$single['RateInfos']['RateInfo']['ChargeableRateInfo']['@surchargeTotal'];
	else
	$tax=0;
	$pre=$single['RateInfos']['RateInfo']['ChargeableRateInfo']['@averageRate'];
		//echo '<pre>';print_r($single['RateInfos']['RateInfo']['ChargeableRateInfo']);exit;
		//echo lang('product_points');
	 
	
                                     ?>
                                </td>
                                <td width="10%" align="left" valign="top" >
                                 <form method="post" action="" >
                                 <input type="hidden" name="henco" value="<?php echo $enco; ?>" />
                                  <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
                                <input type="hidden" name="postvalue" id="postvalue" value="<?php echo $postedvalue; ?>" />
                                <input type="hidden" name="hotelid" id="hotelid" value="<?php echo $hotelid;?>" />
                                <input type="hidden" name="supplierType" id="supplierType" value="<?php if(isset($supplierType)) echo $supplierType; ?>" />
                                <input type="hidden" name="rateKey" id="rateKey" value="<?php echo $rateKey; ?>" />
                                <input type="hidden" name="roomTypeCode" id="roomTypeCode" value="<?php echo $roomTypeCode; ?>" />
                                <input type="hidden" name="rateCode" id="rateCode" value="<?php echo $rateCode; ?>" />
                                <!-- <?php $roominfo=str_replace('"','quot',serialize($single)); ?>-->
                                <input type="hidden" name="rateKey" id="rateKey" value="<?php echo $rateKey; ?>" />
                                <input type="hidden" name="name" id="name" value="<?php echo $name; ?>" />
                                <input type="hidden" name="address2" id="address2" value="<?php echo $address2; ?>" />
                                 <input type="hidden" name="city" id="city" value="<?php echo $hotels_details['HotelSummary']['city']; ?>" />
                                <input type="hidden" name="rm_cd" id="rm_cd" value="<?php echo $single['roomTypeCode']; ?>" />
                                <input type="hidden" name="rm_desc" id="rm_desc" value="<?php echo $single['roomTypeDescription']; ?>" />
                                
                                <input type="hidden" name="image" id="image" value="<?php if(isset($hotels_details['HotelImages']['HotelImage'][0]['url'])) echo $hotels_details['HotelImages']['HotelImage'][0]['url']; else echo assets_url().'img/no_picture.png';?>" /> 
                                <?php if(!empty($single['RateInfos']['RateInfo']['ChargeableRateInfo']['@total'])) { ?>
                                <input type="hidden" name="average_rate" id="average_rate" value="<?php echo trim($single['RateInfos']['RateInfo']['ChargeableRateInfo']['@total']);?>" />
                                <input type="hidden" name="amount" value="<?php echo trim($single['RateInfos']['RateInfo']['ChargeableRateInfo']['@total']);?>"/>
					 <input type="hidden" name="discount_amount" value="<?php echo $discount_amount; ?>"/>
                                     
                                       
                                <?php } else {?><input type="hidden" name="average_rate" id="average_rate" value="" /><?php }?>
                                <input type="hidden" name="roomedetails" value="<?php echo $roomedetails; ?>" />
                               
                                 <input type="hidden" name="charge_info" value="<?php //echo $charge_info; ?>" />
	<?php //echo '</br>';
	//echo '</br>';
	if(!empty($tax)) {
	$room=$_POST['num_room'];$per_tax=$tax/$room;
	$totalpoints=$pre+$per_tax;// echo '<b>Tax Recovery Charges and Fees</b>:'. round($per_tax);
	} ?>
  
   <button class="login-btn tt1"><img src="<?php echo Theme::asset()->url('img/rs_symbol.png'); ?>">&nbsp; 
                                                <span class="tooltip">
                                                    <span class="top">
                                                        <section class="top_main_in">
                                                            <h3>Price Breakup</h3>
                                                            <div class="t-tip_row">
                                                            	<div>Per Night</div>
                                                                <div>1 x &#8377; <?php echo $pre; ?></div>
                                                            </div>
                                                            <?php if(!empty($tax)) { ?>
                                                            <div class="t-tip_row">
                                                            	<div>Tax recovery<br>charges & fees</div>
                                                                <div>&#8377; <?php echo $per_tax; ?></div>
                                                            </div>
                                                            <?php } ?>
                                                            <div class="t-tip_row-btm">
                                                            	<div>Total Price</div>
                                                                <div>&#8377; </div>
                                                            </div>
                                                        </section>
                                                    </span>
                                                    <span class="bottom"></span>
                                                </span></button>
                                </form>
                                
                             </td>
                                <td width="10%" align="left" valign="top" >
                                <?php $change=unserialize(str_replace('quot','"',$postedvalue)); ?>
                               <form method="post" action="" >
                                  <input type="hidden" name="id" value="<?php echo $pid; ?>" />
                                <input type="hidden" name="check_in" id="check_in" value="<?php echo $change['check_in']; ?>" />
                                <input type="hidden" name="check_out" id="check_out" value="<?php echo $change['check_out']; ?>" />
                                <input type="hidden" name="num_rooms" id="num_rooms" value="<?php echo $change['num_rooms'];?>" />
                                <input type="hidden" name="cityname" id="cityname" value="<?php echo $change['cityname']; ?>" />
                                <input type="hidden" name="search_name" id="search_name" value="<?php echo $change['search_name']; ?>" />
                               <input type="hidden" name="henco" value="<?php echo $enco; ?>" />
                             <?php 
                             
                             $xmlurl='';  for($i=1;$i<=$change['num_rooms'];$i++) {
                             $o=$i-1;
			echo '<input type="hidden" name="numberOfAdults'.$i.'" value="'.$change['numberOfAdults'][$o].'" />'; 
			echo '<input type="hidden" name="numberOfChildren'.$i.'" value="'.$change['numberOfChildren'][$o].'" />';
			
			for($j=1;$j<=$change['numberOfChildren'][$o];$j++)
			{
			if(!empty($change['room'.$i.'Child'.$j]))
			echo '<input type="hidden" name="room'.$i.'Child'.$j.'" value="'.$change['room'.$i.'Child'.$j].'" /> ';
			}
			}
                          
                          echo $xmlurl;     
                             ?>  
                               
                               
                               
                                   
                                        </form></td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                        </table>
                        
                        <?php }
                        else if(!empty($rem_det['EanWsError']['presentationMessage'])) { print_r($rem_det['EanWsError']['presentationMessage']); }?>
                                                                 
                            <span class="hot_note"> Note: The room rates listed are for double occupancy per room unless otherwise stated and exclude tax recovery charges and service fees. See <a href=""  target="_blank"> FAQs for more details</a></span>                                     
               
                                </section>    
                            </div>
                        </div>
                    </div>
                </div>
            </section> 
        </section> </section>
        <script type="text/javascript">
    var countries=new ddtabcontent("countrytabs")
    countries.setpersist(false)
    countries.setselectedClassTarget("link") //"link" or "linkparent"
    countries.init()
</script>

<script>

$(document).ready(function() {
$('#check_in').datepicker({ dateFormat: 'dd-mm-yy',minDate: -0,onSelect: function( selectedDate ) {
$('#check_out').datepicker( "option", "minDate", selectedDate );} });
$('#check_out').datepicker({ dateFormat: 'dd-mm-yy',minDate: -0,  onSelect: function( selectedDate ) {
$('#check_in').datepicker( "option", "maxDate", selectedDate );  } });
});

</script>
 <script type="text/javascript">
(function($){
 $("img").lazyload({
     effect       : "fadeIn"
 });
})(jQuery);
</script>
   <script>
                                $(document).ready(function() {

                                        $(".galimg").live('click',function() {
	                                        var image = $(this).attr("rel");
	                                        $('#feature').fadeOut('slow');
	                                        $('#feature').html('<img src="' + image + '" \/\>');
	                                        $('#feature').fadeIn('slow');
                                        });
                                });
                        </script>
                        <script>
                        var image = new Image();
image.src =    $('#feature').html('<img src="' + t2 + '" \/\>');;
image.onload = function() {
    context.drawImage(image, 50, 50);
};


  
  function load_gal(){
    var galleries = $('.ad-gallery').adGallery( {  width: false,  height: false, });    
  }
  
  </script> 
