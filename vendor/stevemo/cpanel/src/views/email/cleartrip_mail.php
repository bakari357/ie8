  <?php
  
      	$book_passenger=json_decode(urldecode($code['post']['book_passenger']));
  	 $pass_cnt=$book_passenger->adults+$book_passenger->children+$book_passenger->infants+3;
		$clear_select=json_decode(urldecode($code['post']['clear_select']));
		$posted = $code['post']; 
		$onward = $clear_select[0]; 
		$ret = 0; 
		$return= array();
		$fares['onward'] = $onward->passenger_onward; 
		$onw_return = $onward->onwardfl; 
		if(isset($code['post']['return_select'])) {
		$return_select=json_decode(urldecode($code['post']['return_select']));
		$ret = 1; 
		$return = $return_select[0]; 
		$fares['return'] = $return->passenger_return; 
		$onw_return = array_merge($onward->onwardfl,$return->returnfl);	
		}
		//echo '<pre>'; //print_r($posted); 
		//print_r($onward->passenger_onward);
		//print_r($return->passenger_return);
		
		
		//print_r($onw_return); exit;
		//$base_fair = $onward->passenger_onward[0]->amount; 
		//echo $base_fair .'- Base';
				//echo '<pre>'; print_r($fares); 	
					$tax = array(); 
				foreach($fares as $type ){
					foreach($type as $key => $value){
					
				    $tax[$value->category][$value->pax_type][] = $value->amount; 
				    }
				}
				
				//echo '<pre>'; print_r($tax); exit;
				
		//print_r($code);
		//print_r($return_select);
         
             $customer = Session::get('customer_data'); ?>

<body style="background-color:#f7f7f7;">
<div style="float:left; background-color:#f7f7f7; width:674px; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:20px 13px 20px 13px; margin:0px auto; color:#333333;">
    <table  class="for_order" cellpadding="0" cellspacing="0" border="0" align="center" width="674">
        <tr>
          <td><a href="#" style="text-decoration:none;">
<img style="width:170px;" src="http://202.140.38.73/smartbuy/public/themes/hdfc/assets/images/smartbuy-logo.jpg" /></a></td>
            <td align="right"><a href="#" style="text-decoration:none;"><img style="width:170px;" src="http://202.140.38.73/smartbuy/public/themes/hdfc/assets/images/hdfc-logo.jpg"  /></a></td>
        </tr>
        <tr><td colspan="2" style="height:30px;">&nbsp;</td></tr>
        <tr>
        	<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; width:674px; border:2px solid #f3f3f3; background-color:#ffffff; margin:0px 0px 0px 0px;">
            	<table cellpadding="0" cellspacing="0" border="0" align="center" style="width:634px;">
       		
 
<tr><td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear,&nbsp;  <?php  echo $customer->first_name .' '.$customer->last_name; ?><br/>Thank you for your Flight booking with Smartbuy . <br />Please find below your Flight booking details.</td></tr>
            		
                    <tr>
                    	<td style="border-bottom:1px dotted #333333; padding:15px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
                    	
                    	<table cellpadding="0" cellspacing="0" border="0" width="320" align="right">
                                <tr>
							
							
                                    <td width="50%" class="td_no_border" style="color:#808080 importe; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Smartbuy Ref No : </td>
                                    <td  class="td_no_border" width="50%" style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php  echo $code['order_number']; ?></td>
                                </tr>
                            
                                   <tr>
                                  
                                    
                                    <td style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">Booking Ref Number: </td>
                                    <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">{{booking reference number}}</td>
                                </tr> 
                                <tr>
                                	<td style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">Booked on : </td>
                                    <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php echo date('d-m-y'); ?></td>
                                </tr>
                           <tr>
                               		
                                	<td style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">Status : </td>
                                    <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"> <?php echo $code['status']; ?> </td>
                                </tr>
                                    </table>                   
                        </td>
                    </tr>
                 
                    
                    <tr><td style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#333333;"><h3><font color="black">Itinerary Details</font></h3></td></tr>
                    <tr>
                    	<td style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>	
							
                                	<td style="color:#808080; width:315px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Flight: <span style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php  
			echo 'Flight Number'; 
?>




</span></td> <td></td>
                                
                                    <td style="color:#808080; width:120px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Status: <span style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $code['status']; ?></span></td>
                                </tr>
			<?php  
			
			foreach($onw_return as $onwa){ ?>
				
				          <tr>
                                	<td style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:20px 0px 0px 0px;  margin:0px;">Depart</td>
                                    <td colspan="2" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif;  padding:20px 0px 0px 0px; margin:0px;">Arrive</td>

                                </tr>
                                <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $onwa->sour; ?><br /><?php $pieces = explode(" ", date('d-m-Y H:i',strtotime(str_replace("T"," ",$onwa->dst_tym)))); echo $pieces[0].' '.$pieces[1] ; ?> </td>
                                    <td colspan="2" style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $onwa->desti; ?><br /><?php $pieces = explode(" ", date('d-m-Y H:i',strtotime(str_replace("T"," ",$onwa->arr_tym)))); echo $pieces[0].' '.$pieces[1] ; ?></td>
                                </tr>
			
			<?php } 
			 ?>
                                   </table>                 
                        </td>
                    </tr>
                    
                    <tr><td style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;"><h3><font color="black">Passenger Details</font></h3></td></tr>
                    <tr>
                    	<td style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:315px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Name</td>
                                    <td style="color:#808080; width:190px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Type of Passenger</td>
                                    <td style="color:#808080; width:120px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Status</td>
                                </tr>
                        <?php $j =3; for($i=3;  $i<$pass_cnt; $i++){ 
                             		if($j < $book_passenger->adults + 3){ $type ='Adult'; }
                             		 else if ($j < $book_passenger->adults+$book_passenger->children+ 3){ $type ='Child'; }else{ $type = 'Infant'; }
                             		?>
                              <tr>
                                	<td style="color:#808080; width:315px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $posted['firstname'.$i].' '.$posted['lastname'.$i]; ?> </td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $type; ?> </td>
                                    <td style="color:#808080; width:120px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $code['status'] ?></td>
                                </tr>
                                <?php $j++;  } ?>
                                  </table>                   
                        </td>
                    </tr>
                  
                    <tr><td style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;"><h3><font color="black">Pricing Details</font></h3></td></tr>
                    <tr>
                    	<td style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Type of Passenger</td>
                                    <td style="color:#808080; width:156px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">No.</td>
                                    <td style="color:#808080; width:190px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Base Fare</td>
                                    <td style="color:#808080; width:120px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Taxes & Other Charges</td>
                                </tr>
                                <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;">Adult</td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"> <?php echo $book_passenger->children; ?> </td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;">Rs. <?php echo round(array_sum($tax['BF']['ADT'])); ?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;">Rs. <?php echo round(array_sum($tax['TAX']['ADT'])); ?></td>
                                </tr>
                                <?php if($book_passenger->children >0){ ?>
                                  <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;">Children</td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $book_passenger->children; ?></td>
                                     <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;">Rs. <?php echo round(array_sum($tax['BF']['CHD'])); ?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;">Rs. <?php echo round(array_sum($tax['TAX']['CHD'])); ?></td>
                                </tr>
                                <?php } ?>
                                  <?php if($book_passenger->infants >0){ ?>
                                  <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;">Infants</td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"> <?php echo $book_passenger->infants; ?>   </td>
                                     <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;">Rs. <?php echo round(array_sum($tax['BF']['INF'])); ?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;">Rs. <?php echo round(array_sum($tax['TAX']['INF'])); ?></td>
                                </tr>
                                <?php }     ?>
                           
                          
                                    </table>                
                        </td>
                    </tr>

                    <tr><td style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;"><h3><font color="black">Payment Details</font></h3></td></tr>
                    <tr>
                    	<td style="padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:315px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Member Name</td>
                                    <td style="color:#808080; width:190px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Email ID</td>
                                    
                                </tr>
                                <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"> <?php  echo $posted['name']; ?> </td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:amit.chawla@reward360.co"> <?php  echo $posted['s_email']; ?></a></td>
                                    
                                </tr>
                                   </table>    
                                     <tr> 
                           <td>
                 
                            </td>
                    </tr>                
                        </td>
                    </tr>
                    
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:30px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Total Amount</td>
                                    <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"> 
                                    Rs. <?php  echo round($posted['amount']) ; ?>
                                    
                                     </td>
                                </tr> 
                             
                                 </table>
                                
                                              
                        </td>
                    </tr>
                   
                 <tr>
                    	<td style="padding:5px 0px 0px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
                        	<table cellpadding="0" cellspacing="0" border="0" width="100%">    
                                <tr><td valign="top" colspan="2" style="color:#1a1a1a; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; margin:0px;"><h3><font color="black">Important Information</font></h3></td></tr>
                                <tr><td valign="top" width="18" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="width:700px; color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>Please quote your Smartbuy Superia Ref No for all future communications related to this booking</li></ul></td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>Please quote the Airline PNR for all future communications with the airline</li></ul></td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>Please carry a print of this itinerary receipt at the time of Check-in</li></ul></td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; line-height:16px; margin:0px;"><ul><li>Please carry a valid photo identity card (Passport, Voter ID Card, PAN Card, Driving License) at the time of check-in, 	without which the airline may deny you a seat on the flight</li></ul></td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>Your travel on this itinerary is subject to Airline terms and conditions</li></ul></td></tr>
                			</table>
                   		</td>
                  	</tr>
                    <tr><td style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#808080;"><span style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#1a1a1a;">Note:</span> You can redeem the remaining amount on the voucher on any other product of your choice. The voucher is valid for period of 1 month from the time it is generated. After a period of one month the unused balance will be credited back to your account between 15 working days. </td></tr>
                    <tr><td valign="top" style="color:#1a1a1a; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; margin:0px;"><br/><h3><font color="black">Cancellation and Modification Rules</font></h3></td></tr>
                    <tr>
                    	<td style="padding:0px 0px 0px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
                        	<table cellpadding="0" cellspacing="0" border="0" width="100%">    
                                <tr><td valign="top" colspan="2" style="color:#1a1a1a; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><br/>Cancellation Charges</td></tr>
                                <tr><td valign="top" width="18" style="padding:5px 0px 0px 0px;"></td><td valign="top" style=" width:700px; color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>Standard airline charges will be applicable for cancellations/ modifications on flight booking </li></ul></td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;"><ul><li>In addition to the ariline charges , Smartbuy Superia will levy Rs 150 per passenger per flight for each cancellation/ modification.</li></ul></td></tr>
                                <tr><td valign="top" colspan="2" style="color:#1a1a1a; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:10px 0px 10px 0px; margin:0px;"><h3><font color="black">Refund on cancellation</font></h3></td></tr>
                                <tr><td valign="top" width="18" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 5px 0px; margin:0px;">Please allow 15 working days for the refund amount to reflect in your account.</td></tr>
                			</table>
                   		</td>
                  	</tr>
                    <tr><td style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:20px 0px 15px 0px; margin:0px;">For any assistance please email <a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:support@smartbuy.com">support@smartbuy.com</a> or call <span style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;">1800-0000-000</span> (Toll free number).</td></tr>

 <tr>
   <td  style="padding:15px 0 0;">
   <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td style="color: #808080; font-size: 11px;">Copyright ©2014 Reward360. All rights reserved.</td>
    <td align="right"><img src="http://202.140.38.73/smartbuy/public/themes/hdfc/assets/images/s_rlogo.jpg" alt="" /></td>
  </tr>
                </table>
            </td>
        </tr>		
    </table>
</div>

 
  



