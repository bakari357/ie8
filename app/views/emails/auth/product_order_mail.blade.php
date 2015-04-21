<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body style="background-color:#f7f7f7;">
<div style="float:left; background-color:#f7f7f7; width:600; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:20px 13px 20px 13px; margin:0px auto; color:#333333;">
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
        <tr>
         
            <td style="text-align:right;"><a href="#" style="text-decoration:none; color:#004c8f; font-family:Arial, Helvetica, sans-serif; font-size:14px;"><?php echo HTML::image('laravel/public/themes/hdfc/assets/img/hungama_logo.jpg',"",array('border'=>'0'));?></a></td>
        </tr>
        <tr><td colspan="2" style="height:30px;"></td></tr>
        <tr>
        	<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; width:674px; border:2px solid #f3f3f3; background-color:#ffffff; margin:0px 0px 0px 0px;">
            	<table cellpadding="0" cellspacing="0" border="0" align="center" style="width:634px;">
            		<tr>
            		 <?php if(isset($product_output->status) && $product_output->status =='Successful') {  ?>
            		   <td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear <?php echo ucfirst($product_input->ship_address->firstname); ?>,<br /><br />Congratulations on the Successful Order.<br />Please find below your song Order details. </td>
            		    <?php } ?>
            		</tr>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:15px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td width="20%"></td>
                                    <td width="30%"></td>
                                    <td width="25%" style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"> Ref No : </td>
                                    <td width="25%" style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><?php echo $order_number; ?></td>
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
                                	
                                   <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php   echo $product_output->status; ?> </td>
                               
                                    
                                </tr>
                            </table>                       
                        </td>
                    </tr>
                    <tr><td colspan="2" style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;">Order Details</td></tr>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:115px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Product</td>
                                    <td style="color:#808080; width:110px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Name</td>
                                    <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Total</td>
                     
                                </tr>
                                <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $product_output->options->product_name; ?></td>
                                   <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $product_input->ship_address->firstname; ?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"></td>
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
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"> <?php echo ucfirst($product_input->ship_address->firstname);; ?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:amit.chawla@reward360.co"><?php echo $product_input->ship_address->email; ?></a></td>
                                    
                                </tr>
                            </table>                       
                        </td>
                    </tr>
            
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:30px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Total Amount</td>
                                    <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo  'Rs'.$product_output['options']->mrp;?> </td>
                                </tr>
                                <tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Paid by Credit Card</td>
                                	 
                                	 <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo 'Rs'.' '.'0' ; ?></td>
                                	
                                    <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"> <?php echo $product_output->options->customcash ; ?></td>
                                  
                                </tr>
                                <tr>
                                	<td style="color:#808080; width:160px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;">Paid by Points</td>
                                	
                                    <td style="color:#333333; width:470px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0px 5px 0px; margin:0px;"><?php echo $product_output->options->custompoint;?>
                                </tr>
                                
                               
                            </table>                       
                        </td>
                    </tr>
                    
                    <tr>
                    	<td colspan="2" style="padding:5px 0px 0px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
                        	<table cellpadding="0" cellspacing="0" border="0" width="100%">    
                        	
                                <tr><td valign="top" colspan="2" style="color:#1a1a1a; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; margin:0px;">Important Information</td></tr>
                                <tr><td valign="top" width="18" style="padding:5px 0px 0px 0px;"><img src="" width="18" height="7" border="0" /></td><td valign="top" style="width:700px; color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;">Please quote your HDFC Bank Superia reference number for all future communication with us on this booking.</td></tr>
                                <tr><td valign="top" style="padding:5px 0px 0px 0px;"><img src="" width="18" height="7" border="0" /></td><td valign="top" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px 0px 10px 0px; margin:0px;">Your voucher number serves as a confirmation of your song download.</td></tr>
                			</table>
                   		</td>
                  	</tr>
                  	  <tr><td colspan="2" style="padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#808080;"><span style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#1a1a1a;"></span> To download your song please login to www.hdfcbanksuperia.com, go to My Redemption under My Account tab.After a successful purchase, you may download the same song any number of times.
If you are a guest user, you may be requested for additional information to download/view booking order status and other details.</td></tr>
                    <tr><td colspan="2" style="padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#808080;"><span style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#1a1a1a;">Note:</span> You can redeem the remaining amount on the voucher on any other product of your choice. The voucher is valid for period of 1 month from the time it is generated. After a period of one month the unused balance will be credited back to your account between 15 working days.</td></tr>
                    <tr><td colspan="2" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:20px 0px 15px 0px; margin:0px;">For any assistance please email <a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:support@hdfcbanksuperia.com">support@hdfcbanksuperia.com</a> or call <span style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;">1800-1020-360</span> (Toll free number).</td></tr>
                </table>
               <tr>
   <td  style="padding:15px 0 0;">
   <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td style="color: #808080; font-size: 11px;">Copyright ©2014 Reward360. All rights reserved.</td>
    
  </tr>
</table>
            </td>
        </tr>		
    </table>
</div>
</body>    
</html>
