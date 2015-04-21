<?php  
$details=$code['details']; 
 ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Edge - Emailers ::</title>
</head>

<body style="background-color:#f7f7f7;">
<div style="float:left; background-color:#f7f7f7; width:745px; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:20px 13px 20px 13px; margin:0px auto; color:#333333;">
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="674">
        <tr>
           <td><a href="#" style="text-decoration:none;">
<img style="width:170px;" src="http://202.140.38.73/smartbuy/public/themes/hdfc/assets/images/smartbuy-logo.jpg" /></a></td>
            <td align="right"><a href="#" style="text-decoration:none;"><img style="width:170px;" src="http://202.140.38.73/smartbuy/public/themes/hdfc/assets/images/hdfc-logo.jpg"  /></a></td>
        </tr>
<?php
          
             $customer = Session::get('customer_data');
         
            
          ?>
        <tr><td colspan="2" style="height:30px;"></td></tr>
        <tr>
        	<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; width:674px; border:2px solid #f3f3f3; background-color:#ffffff; margin:0px 0px 0px 0px;">
            	<table cellpadding="0" cellspacing="0" border="0" align="center" style="width:634px;">
            		<tr><td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear,&nbsp;  <?php  echo $customer->first_name .' '.$customer->last_name; ?><br/>Thank you for your Hotel booking with Smartbuy. <br />Please find below your Hotel booking details.</td></tr>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:15px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
							<?php if(isset($details['itinerary'])) {  ?>
                                
                                    <td width="20%" style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Receipt No:</td>
                                    <td width="30%" style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $details['itinerary']['trip-ref']; ?></td>
                                    <?php } ?>
                                    <td width="25%" style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Smartbuy Ref No : </td>
                                    <td width="25%" style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $code['order_num']; ?></td>
                                </tr>
                                <tr>
                               		<td></td>
                                    <td></td>
                                	<td style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">Booked on : </td>
                                    <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php echo date('d-m-y'); ?></td>
                                </tr>
                                <tr>
                               		<td></td>
                                    <td></td>
                                	<td style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">Status : </td>
                                    <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php if(isset($status) && $status=='fail') echo 'Failure'; else echo 'Success'; ?></td>
                                </tr>
                            </table>                       
                        </td>
                    </tr>
                    <tr><td colspan="2" style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;">Booking Details</td></tr>
                    <tr>
                    	<td valign="top" style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; width:380px;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td valign="top" style="color:#808080; width:130px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Hotel:</td>
                                    <td valign="top" style="color:#333333; width:250px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo $details['itinerary']['hotel-detail']['name']; ?></td>
                                </tr>
                                <tr>
                                	<td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Address:</td>
                                    <td valign="top" style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo $details['itinerary']['hotel-detail']['address']; ?>,</br><?php echo $details['itinerary']['hotel-detail']['city']; ?></td>
                                </tr>
                                <tr>
                                	<td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"></td>
                                    <td valign="top" style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"></td>
                                </tr>
                                <tr>
                                	<td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"></td>
                                    <td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:gghgolden@gmail.com"></a><br /><a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:monika.meel@cleartrip.com"></td>
                                </tr>
                            </table>                       
                        </td>
                        <td valign="top" style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; width:245px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td valign="top" style="color:#808080; width:125px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Checkin Date: </td>
                                    <td valign="top" style="color:#333333; width:120px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo $details['itinerary']['check-in-date']; ?></td>
                                </tr>
                                <tr>
                                	<td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Checkout Date: </td>
                                    <td valign="top" style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo $details['itinerary']['check-out-date']; ?></td>
                                </tr>
                                <tr>
                                	<td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">No. of Rooms: </td>
                                    <td valign="top" style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo $details['itinerary']['room-count']; ?></td>
                                </tr>
                                <tr>
                                	<td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Room Type: </td>
                                    <td valign="top" style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo $details['itinerary']['rooms']['room']['type']; ?></td>
                                </tr>
                                
                            
                                  
                                    <tr>
                                    <td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">No. of Guests: </td>
                                    <td valign="top" style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo $details['itinerary']['rooms']['room']['guests']; ?> </td></tr>
                               
                                
                            </table>                       
                        </td>
                    </tr>
                    
                    <tr><td colspan="2" style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;">Tariff Details</td></tr>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Base Fare</td>
                                    <td style="color:#808080; width:206px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Taxes & Other Charges</td>
                                    <td style="color:#808080; width:260px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Total</td>
                                </tr>
                                <?php
                                 $roombook=$details['itinerary']['room-rates']['room-rate']['pricing-elements']['pricing-element'];
foreach($roombook as $rateroom){
if($rateroom['category']=='BF')
{
$base= $rateroom['amount']; 
}
if($rateroom['category']=='TAX')
{
$tax= $rateroom['amount']; 
}

}
   $total=$details['itinerary']['payment-detail']['amount'];                      
                                ?>
                                <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;">Rs. <?php echo round($base); ?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;">Rs. <?php echo round($tax); ?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;">Rs. <?php echo round($total); ?></td>
                                </tr>
                            </table>                       
                        </td>
                    </tr>
                    <tr><td colspan="2" style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;">Payment Details</td></tr>
                    <tr>
                    	<td colspan="2" style="padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:315px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Member Name</td>
                                    <td style="color:#808080; width:190px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Email ID</td>
                                    
                                </tr>
                                <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php  echo $customer->first_name .' '.$customer->last_name;?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:amit.chawla@reward360.co"><?php echo $code['user']; ?></a></td>
                                    
                                </tr>
                            </table>                       
                        </td>
                    </tr>
                    
                    
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:30px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Total Amount</td>
                                    <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Rs. <?php echo round($total); ?> </td>
                                </tr>
<tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Paid by Credit Card</td>
                                    <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Rs. <?php echo round($total); ?></td>
                                </tr>
                             
                                
                            </table>                       
                        </td>
                    </tr>
                   
                    <tr><td colspan="2" style="color:#1a1a1a; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; margin:0px;">Hotel Cancellation Policy</td></tr>
                    
                    <tr>
                    	<td colspan="2" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;">
							<?php if(isset($rm_details['HotelRoomReservationResponse']['cancellationPolicy'])) echo $rm_details['HotelRoomReservationResponse']['cancellationPolicy']; else echo 'No cancellation Policy'; ?>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2" style="padding:5px 0px 0px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
                        	<table cellpadding="0" cellspacing="0" border="0" width="100%">    
                                <tr><td valign="top" colspan="2" style="color:#1a1a1a; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; margin:0px;">Important Information</td></tr>
                                <tr><td valign="top" width="18" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="width:700px; color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>Smartbuy will not be responsible for the change in the cancellation/modification charges revised by respective hotels.</li></ul></td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>All cancellation and amendment charges, taxes and surcharges are subject to change without notice and must be borne by the customer.</li></ul></td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>Please quote your Smartbuy reference number for all future communication with us on this booking.</li></ul></td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; line-height:16px; margin:0px;"><ul><li>Your receipt number serves as a confirmation of your hotel booking.</td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></li></ul></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>Carry a print out of this Hotel Receipt and present it at the hotel reception.</li></ul></td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>Kindly carry photo identification proof along with your Hotel Receipt.</li></ul></td></tr>
                			</table>
                   		</td>
                  	</tr>
                  	
                                
                			
                   
                    <tr><td colspan="2" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:20px 0px 15px 0px; margin:0px;">For any assistance please email <a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:support@smartbuy.com">support@smartbuy.com</a> or call <span style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;">1800-0000-000</span> (Toll free number).</td></tr>
                </table>
                          <tr>
   <td  style="padding:15px 0 0;">
   <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td style="color: #808080; font-size: 11px;">Copyright ©2014 Reward360. All rights reserved.</td>
    <td align="right"><img src="http://202.140.38.73/axis_edge/public/themes/hdfc/assets/images/s_rlogo.jpg" alt="" /></td>
  </tr>
</table>
            </td>
        </tr>		
    </table>
</div>
</body>    
</html>
