<?php  
$order_number = $code['order_number']; 
$rm_details=$code['recharge_details']; 
   $operator     = @$code['operator'];
 //echo '<pre>'; print_r( $rm_details); exit;
 $recharge_result =  explode('~',$rm_details[0]['Response']);
// echo '<pre>'; print_r( $recharge_result); exit;
 $post_values=$code['post']; 
 //echo '<pre>'; print_r($post_values); exit;
 ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body style="background-color:#f7f7f7;">
<div style="float:left; background-color:#f7f7f7; width:745px; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:20px 13px 20px 13px; margin:0px auto; color:#333333;">
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="674">
        <tr>
          <td><a href="#" style="text-decoration:none;">
<img style="width:170px;" src="http://202.140.38.73/smartbuy/public/themes/hdfc/assets/images/smartbuy-logo.jpg" /></a></td>
            <td ><a href="#" style="text-decoration:none;"><img style="width:170px;" src="http://202.140.38.73/smartbuy/public/themes/hdfc/assets/images/hdfc-logo.jpg"  /></a></td>
        </tr>
         <?php
          
             $customer = Session::get('customer_data');
         
          ?>
        <tr><td colspan="2" style="height:30px;"></td></tr>
        <tr>
        	<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; width:674px; border:2px solid #f3f3f3; background-color:#ffffff; margin:0px 0px 0px 0px;">
            	<table cellpadding="0" cellspacing="0" border="0" align="center" style="width:634px;">
            	   <?php if($recharge_result[6] =="Y") {  ?>
            		<tr><td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear  <b><?php if(isset($customer)!='') { echo $customer->first_name .' '.$customer->last_name;} else{ echo 'Guest User';} ?></b>,<br/><br/><b>Congratulations on the successful  order on your Smartbuy.<br/><br/>Please find below your order details. </b></td></tr>
              <?php } else { ?>
              		<tr><td colspan="2" style="border-bottom:1px dotted #333333; padding:20px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#333333;">Dear <b><?php  echo $customer->first_name .' '.$customer->last_name; ?><b/>,<br/><br/>Sorry! Your order has failed.<br/><br/>Please find below your Recharge details.</td></tr>
              		 <?php } ?>  
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:15px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                                
                                   
                                        <tr>
                               		 
                                	 <td style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">Order Number: </td>
                                    <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php print_r($order_number); ?></td>
                                </tr>
                                    
                                 
                                   
                                    <?php if($post_values['ttype'] =='etop') { ?>
                                    <tr>    <td width="25%" style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Transaction Number : </td>
                                      <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php echo $recharge_result[1]; ?></td>  </tr>
                                   <?php } else{ ?>
                                       <tr>    <td width="25%" style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Transaction Number : </td>
                                     <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php echo $recharge_result[9]; ?></td> </tr>
                                    <?php }?>
                                
                                <tr>
                               		 
                                	 <td style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">Recharged on : </td>
                                    <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;"><?php echo date('d-m-y'); ?></td>
                                </tr>
                                
                            </table>                       
                        </td>
                    </tr>
                    <tr><td colspan="2" style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;">Order Details</td></tr>
                    <tr>
                    	<td colspan="2" style="border-bottom:1px dotted #333333; padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:300px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Customer Name</td>
                                   
                                    <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Amount</td>
                                                            
                          <?php if($post_values['payment'] =='postpaid') {   ?>
                             <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Operator</td>
                         <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Mobile Number</td>
                             <?php } elseif($post_values['payment'] =='recharge') {?>
                                 <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Operator</td>
                         <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Mobile Number</td>
                             
                             <?php }  else if($post_values['payment'] =='electricity') { ?>
                           <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Electricity Name</td>
                           <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Consumer Number</td>
                           
                           <?php } else if($post_values['payment'] =='DTH') { ?>
                           <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Operator</td>
                              <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">DTH Number</td>
                           <?php } else if($post_values['payment'] =='insurance') { ?>
                           
                            <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Insurance Name</td>
                              <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Policy Number</td>
                           <?php }  else if($post_values['payment'] =='gas') {?>
                           
                              <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">GAS Service Name</td>
                              <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Consumer Number</td>
                           
                           <?php }  else if($post_values['payment'] =='charity') {  ?>
                           
                            <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Charity Name</td>
                              <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Contribution Scheme</td>
                           
                           <?php } else if($post_values['payment'] =='creditcard') { ?>
                                <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Creditcard  Name</td>
                              <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Creditcard Number</td>
                           
                           
                           
                           <?php } ?>
                           
                           <!--common--!-->
                        <td style="color:#808080; width:290px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;">Order Status</td>
                        <!--end--!-->          
                          
                                </tr>
                               <br/> <br/>
                                <tr>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $customer->first_name .' '.$customer->last_name; ?>
                                    </td>
                                    
                                     <?php if($post_values['payment'] =='recharge') {
                                       ?>
                                       
                                     <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;">Rs. <?php echo $post_values['amount']; ?></td>
                       <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo @$operator; ?></td>
                       <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['mobile'];; ?></td>
                                      
                                     <?php } elseif($post_values['payment']=='postpaid'){ ?>
                                     <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $post_values['amount']; ?></td>
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo  @$operator; ?></td>
                                     
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['mobile'];; ?></td>
                                     <?php } elseif($post_values['payment']=='DTH') { ?>
                                       <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $post_values['amount']; ?></td>
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['biller_name']; ?></td>
                                     
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['subscriber_id'];; ?></td>
                                      
                                      <?php } elseif($post_values['payment']=='electricity') {  ?>
                                        <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $post_values['amount']; ?></td>
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['biller_name']; ?></td>
                                     
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['service_no'];; ?></td>
                                      
                                      <?php }  else if($post_values['payment'] =='insurance') { ?>
                                      
                                       <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $post_values['amount']; ?></td>
                                       <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['biller_name']; ?></td>
                                     
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['policy_no'];; ?></td>
                                      <?php }  else if($post_values['payment'] =='gas') { ?>
                                      
                                        <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $post_values['amount']; ?></td>
                                       <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['biller_name']; ?></td>
                                     
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['customer_id'];; ?></td>
                                      
                                      <?php }  else if($post_values['payment'] =='charity') { ?>
                                      
                                         <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $post_values['amount']; ?></td>
                                       <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['biller_name']; ?></td>
                                     
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['contribution_scheme'];; ?></td>
                                      
                                      
                                      
                                      <?php }  else if($post_values['payment'] =='creditcard') {?>
                                      
                                        <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php echo $post_values['amount']; ?></td>
                                       <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['biller_name']; ?></td>
                                     
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $post_values['creditcard_number'];; ?></td>
                                      
                                      
                                      
                                      <?php } ?>
                                      
                                      
                                     <?php if($recharge_result[6] =="Y") {  ?>
                                     <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $order_status='Success' ; ?></td>
                                     <?php } else { ?>
                                      <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><?php echo $order_status='Failure' ;  ?></td>
                                  <?php } ?>   
                                   
                                </tr>
                            </table>                       
                        </td>
                    </tr>
                    <tr><td colspan="2" style="padding:10px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333;">Payment Details</td></tr>
                    <tr>
                    	<td colspan="2" style="padding:0px 0px 15px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            	<tr>
                                	<td style="color:#808080; width:315px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><b>Member Name</b></td>
                                    <td style="color:#808080; width:190px; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; margin:0px;"><b>Email ID<b/></td>
                                    
                                </tr> <br/><br/>
                                <tr>
                                	<td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:0px; line-height:16px; margin:0px;"><?php if(isset($customer)!='') { echo $customer->first_name .' '.$customer->last_name; } else { echo 'Guest User';   }?></td>
                                    <td style="color:#333333; font-size:11px; font-family:Arial, Helvetica, sans-serif; line-height:16px; padding:0px; margin:0px;"><a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:amit.chawla@reward360.co"><?php echo $post_values['s_email']; ?></a></td>
                                    
                                </tr>
                                	 <td style="color:#808080; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">Paid By Cash </td>
                                    <td style="color:#333333; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:15px 0px 0px 0px; margin:0px;">Rs.<?php echo $post_values['amount']; ?></td>
                                </tr><br/>
                            </table>                       
                        </td>
                    </tr>
                    
                   
                                
                           
              
                    <tr>
                    	<td colspan="2" style="padding:5px 0px 0px 0px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
                        	<table cellpadding="0" cellspacing="0" border="0" width="100%">    
                                <tr><td valign="top" colspan="2" style="color:#1a1a1a; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; margin:0px;">Attention! Please read important information!</td></tr>
                                
                                
                                <tr><td valign="top" colspan="2" style="color:#1a1a1a; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; margin:0px;">  Please quote your HDFC Bank SmartBuy reference number for all future</td></tr>
                              
                                <tr>
                               <td valign="top" style="float:left;color:#808080;margin-left: -18px">. On us to provide correct payment information lies with the customer.</td></tr>
                            
                             <tr>
                               <td valign="top" style="float:left;color:#808080;margin-left: -18px">. Bills paid through the portal cannot be cancelled or modified.</td></tr>
                            
                             <tr>
                               <td valign="top" style="float:left;color:#808080;margin-left: -18px">. For any query related to payment status, please contact us at email address and  call centre number.</td></tr>
                               <tr>
                               <td valign="top" style="float:left;color:#808080;margin-left: -18px">.For any query and/or activity related to the service, payment status and certificates (if any), <br/>&nbsp;&nbsp;please contact Billdesk at <email address> and <call centre number>.</td></tr>
                            
                			</table>
                   		</td>
                  	</tr>
                    
                   <!-- <tr><td colspan="2" style="color:#808080; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:20px 0px 15px 0px; margin:0px;">For any assistance please email <a style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;" href="mailto:support@smartbuy.com">support@smartbuy.com</a> or call<span style="text-decoration:none; color:#0058ff; font-family:Arial, Helvetica, sans-serif; font-size:11px;">1800-0000-000</span> (Toll free number)</td></tr>
                </table>!-->
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
</body>    
</html>
