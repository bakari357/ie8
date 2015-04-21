<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body style="background-color:#f7f7f7;">
<div style="float:left; background-color:#f7f7f7; width:745; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:20px 13px 20px 13px; margin:0px auto; color:#333333;">
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
     <tr>
           <td><a href="#" style="text-decoration:none;">
<img style="width:170px;" src="http://202.140.38.73/smartbuy/public/themes/hdfc/assets/images/smartbuy-logo.jpg" /></a></td>
            <td align="right"><a href="#" style="text-decoration:none;"><img style="width:170px;" src="http://202.140.38.73/smartbuy/public/themes/hdfc/assets/images/hdfc-logo.jpg"  /></a></td>
        </tr>

        <tr><td colspan="2" style="height:30px;"></td></tr>
        <tr>
        	<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; width:674px; border:2px solid #f3f3f3; background-color:#ffffff; margin:0px 0px 0px 0px;">
            	<table cellpadding="0" cellspacing="0" border="0" align="center" style="width:634px;">
            		<tr>
            		 <?php if(isset($code['status']) && $code['status'] =='Successful') {  ?>
            		   <td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear <?php echo ucfirst($code['customer']['first_name']); ?>,<br /><br />Congratulations on the Successful music transaction against your Smartbuy.<br />Please find below your song download details. </td>
            		    <?php } elseif(isset($code['status']) && $code['status'] =='Declined') {  ?>
            		    <td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear <?php echo ucfirst($code['customer']['first_name']); ?>,<br /><br />Sorry! Your order has Failed.<br />Please find below your Song details. </td>
            		  <?php } else { ?>
              		  <td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear <?php echo ucfirst($code['customer']['first_name']); ?>,<br /><br />Sorry! Your order has Failed. The deducted amount will be refunded back to your account in the next 15 business days.<br />Please find below your Song details. </td>
              		 <?php } ?>  
            		</tr>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:15px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td width="20%"></td>
                                    <td width="30%"></td>
                                    <td width="25%" style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Smartbuy Ref No : </td>
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
                    <?php $music_details = base64_decode($code['input']['Posted']['music_details']);
                    $music=explode('|',$music_details); ?>
                    
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="50%">
                            	<tr>
                                	<td style="color:#808080; width:20px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Song</td>
                                    <td style="color:#808080; width:20px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $music[2];?></td>
                                     </tr>
                                <tr>
                                    <td style="color:#808080; width:55px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Album</td>
                                      <td style="color:#808080; width:55px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $music[1];?></td>
                               
                                </tr>
                            </table>                       
                        </td>
                    </tr>
                    <tr><td colspan="2" style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;">Payment Details</td></tr>
                    <tr>
                    	<td colspan="2" style="padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:315px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"> Name</td>
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
	$total_cash=$product['options']['custom_cash'];


		
		//$total_cash+=$cash;
		
		?>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:30px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Total Amount</td>
                                    <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">10 </td>
                                </tr>
                                <tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Paid Cash</td>
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
                                <tr><td valign="top" width="18" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="width:700px; color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;">Please quote your Smartbuy reference number for all future communication with us on this booking.</td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;">Your transaction serves as a confirmation of your song download.</td></tr>
                			</table>
                   		</td>
                  	</tr>
                  	  <tr><td colspan="2" style="padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#808080;"><span style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#1a1a1a;"></span> To download your song please login to www.smartbuy.com, go to My Redemption under My Account tab.After a successful purchase, you may download the same song any number of times.
If you are a guest user, you may be requested for additional information to download/view booking order status and other details.</td></tr>
                   
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
