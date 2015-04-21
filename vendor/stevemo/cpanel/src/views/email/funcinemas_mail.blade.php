<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body style="background-color:#f7f7f7;">
<div style="float:left; background-color:#f7f7f7; width:600; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:20px 13px 20px 13px; margin:0px auto; color:#333333;">
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
        <tr>
            <td><a href="#" style="text-decoration:none;"><img src="http://202.140.38.73/axis_edge/public/themes/hdfc/assets/images/edge.jpg" width="180" height="50" border="0" /></a></a></td>
            <td style="text-align:right;"><a href="#" style="text-decoration:none; color:#004c8f; font-family:Arial, Helvetica, sans-serif; font-size:14px;"><img src="http://202.140.38.73/axis_edge/public/themes/hdfc/assets/images/axis-logo.jpg" width="88" height="31" border="0" /></a></td>
        </tr>
        <tr><td colspan="2" style="height:30px;"></td></tr>
        <tr>
        	<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; width:674px; border:2px solid #f3f3f3; background-color:#ffffff; margin:0px 0px 0px 0px;">
            	<table cellpadding="0" cellspacing="0" border="0" align="center" style="width:634px;">
            		<tr>
            		 <?php if(isset($code['status']) && $code['status'] =='Successful') {  ?>
            		   <td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear <?php echo ucfirst($code['customer']['first_name']); ?>,<br /><br />Congratulations on the Successful Movie transaction against your Axis Edge.<br />Please find below your Transaction details. </td>
            		    <?php } elseif(isset($code['status']) && $code['status'] =='Declined') {  ?>
            		    <td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear <?php echo ucfirst($code['customer']['first_name']); ?>,<br /><br />Sorry! Your order has Failed.<br />Please find below your Transaction details. </td>
            		  <?php }
            		  
            		  elseif(isset($code['status']) && $code['status'] =='Pending') {  ?>
            		    <td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear <?php echo ucfirst($code['customer']['first_name']); ?>,<br /><br />Your Transaction is pending<br />Please find below your Transaction details. </td>
            		  <?php } else { ?>
              		  <td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear <?php echo ucfirst($code['customer']['first_name']); ?>,<br /><br />Sorry! Your order has Failed. The deducted amount will be refunded back to your account in the next 15 business days.<br />Please find below your Movie details. </td>
              		 <?php } ?>  
            		</tr>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:15px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td width="20%"></td>
                                    <td width="30%"></td>
                                    <td width="25%" style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Axis Edge Ref No : </td>
                                    <td width="25%" style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $code['order_number']; ?></td>
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
                                	<?php if(isset($code['status']) && $code['status'] =='Declined')
                                	{ ?>
                                    <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"> <?php echo 'Declined';  ?></td>
                                    <?php } elseif(isset($code['status']) && $code['status'] == 'Pending') { ?> 
                                       <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php   echo 'Pending'; ?> </td>
                                   <?php } elseif(isset($code['status']) && $code['status'] !='Successful') { ?> 
                                       <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php   echo 'Failed'; ?> </td>
                                   <?php } else { ?>
                                   <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php   echo 'Success'; ?> </td>
                                 <?php   } ?>
                                    
                                </tr>
                            </table>                       
                        </td>
                    </tr>
                    <tr><td colspan="2" style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;">Order Details</td></tr>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr><?php $details = $code['input']->Posted; ?>
                                	<td style="color:#808080; width:115px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Movie</td>
                                    <td style="color:#808080; width:110px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $details->Movie; ?></td>
                                </tr>
                                <tr>
                                	<td style="color:#808080; width:115px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Center/Screen</td>
                                    <td style="color:#808080; width:110px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $details->Center.' / '.$details->Screen; ?></td>
                                </tr>
                                 <tr>
                                	<td style="color:#808080; width:115px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Class</td>
                                    <td style="color:#808080; width:110px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $details->Class; ?></td>
                                </tr>
                                <tr>
                                	<td style="color:#808080; width:115px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">ShowTime</td>
                                    <td style="color:#808080; width:110px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $details->ShowTime; ?></td>
                                </tr>
                                <tr>
                                	<td style="color:#808080; width:115px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">No of Tickets</td>
                                    <td style="color:#808080; width:110px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $details->QTY; ?></td>
                                </tr>
                                <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;">Ticket Price</td>
                                   <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo round($details->amount); ?></td>
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
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"> <?php echo ucfirst($code['customer']['first_name']);; ?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:amit.chawla@reward360.co"><?php echo $code['customer']['email']; ?></a></td>
                                    
                                </tr>
                            </table>                       
                        </td>
                    </tr>
                    <?php
	$subtotal = 0; //echo "<pre>"; print_r($this->go_cart->contents());
	$deal_cash=0;
	$deal_points=0;
	$point_flag=0;
	foreach (Cart::content() as $cartkey=>$product):?>
	<?php

  
		if($cartkey<>'') { 
		if(isset($product['options']['apiproduct']) && !empty($product['options']['apiproduct']))
		$quantitynew=$product['options']['quantity'];
		else{
		if(!(bool)$product['options']['fixed_quantity'])
		$quantitynew=$product['options']['quantity'];
		else
		$quantitynew=1;
		}
		//$points=Rewards::point_to_case($product['points']*$quantitynew);
	//$total_cash+=$cash;
	//$total_points=$product['options']['custom_point'];
	$total_cash=$product['options']['custom_cash'];


		
		//$total_cash+=$cash;
		
		?>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:30px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Total Amount</td>
                                    <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php  echo round($details->amount);?> </td>
                                </tr>
                                <tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Paid by Credit Card</td>
                                	<?php if(isset($code['status']) && $code['status'] =='Successful') { 
                                	
                                	?>
                                	<td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"> <?php echo $product['options']['custom_cash']; ?></td>        	 <?php } else {?>
                         
                                	 <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo 'Rs'.' '.'0' ; ?></td>
                                    
                                    <?php } ?>
                                </tr>
                               
                                
                            </table>                       
                        </td>
                    </tr>
                    <?php } endforeach ?>
                    <tr>
                    	<td colspan="2" style="padding:5px 0px 0px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
                        	<table cellpadding="0" cellspacing="0" border="0" width="100%">    
                        	
                                <tr><td valign="top" colspan="2" style="color:#1a1a1a; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; margin:0px;">Important Information</td></tr>
                                <tr><td valign="top" width="18" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="width:700px; color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;">Please quote your Axis Edge reference number for all future communication with us on this booking.</td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;">Your Points serves as a confirmation of your movie booking.</td></tr>
                			</table>
                   		</td>
                  	</tr>
                  	  <tr><td colspan="2" style="padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#808080;"><span style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#1a1a1a;"></span> </td></tr>
                    <tr><td colspan="2" style="padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#808080;"><span style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#1a1a1a;"></span> </td></tr>
                    <tr><td colspan="2" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:20px 0px 15px 0px; margin:0px;">For any assistance please email <a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:support@axisedge.com">support@axisedge.com</a> or call <span style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;">1800 000 0000</span> (Toll free number).</td></tr>
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
