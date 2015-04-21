
<?php 
$book_passenger=json_decode(urldecode($post['book_passenger']));


if(isset($post['clear_select']) && $post['clear_select']<>'')
{
$clear_select=json_decode(urldecode($post['clear_select']));
}

//goibibo

if(isset($response->booking_id) && $response->booking_id<>'')
{
    $response_goibibo=  json_decode($response->booking_id);
    
    //echo "<pre>"; print_r($response_goibibo);exit;
    
    
            
    $booking_id=$response_goibibo->data['0']->bookingid;
    
}


?>
<link href="themes/hdfc/assets/updates/update1/css/style01.css" rel="stylesheet" media="screen">
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Flights</a></li>
					<li>/</li>
					<li><a href="#">Confirmation</a></li>
									
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
	<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>"  id="passenger_checkout">

           
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
                                        <div class="row">
                                        <?php if(isset($xml_array['book-response']['trip-id']) && $xml_array['book-response']['trip-id']<>'' ||  isset($booking_id) && $booking_id<>'')
                                        {
                                            
                                        ?> 
                                        <span class="size16px bold dark left">Flight has been booked successfully !!!
                                        <br/><br/>Your order ID : 
                                        <?php 
                                        echo $order_number;
                                        echo "</span>";
                                        }
                                        else
                                        {
                                           
                                        ?>
                                        <span class="size16px bold dark left">Flight booking is Failed !!!<br/>
                                        <?php 
                                        
                                         echo "<br/>";
                                            echo "Sorry! Your booking is not confirmed. Your order ID :";
                                            echo $order_number;
                                        } ?>
                                            </span>
                                        <div class="clearfix"></div>
					<div class="line4"></div>
						<div class="col-md-4">
                                                    <b><?php if(isset($xml_array['book-response']['trip-id']) && $xml_array['book-response']['trip-id']<>'' ||  isset($booking_id) && $booking_id<>'')
                                                       {
                                                       ?> 
                                                    Booking ID
                                                       <?php }
                                                       else
                                                       {
                                                       echo "Status";
                                                       }
                                                        ?> </b> :
                                                   
                                                    <?php if(isset($xml_array['book-response']['trip-id']) && $xml_array['book-response']['trip-id']<>'')
                                                       {
                                                    
                                                     echo $xml_array['book-response']['trip-id'];    
                                                     }
                                                     else if(isset($booking_id) && $booking_id<>'')
                                                     {
                                                         echo $booking_id;
                                                     }
                                                     else
                                                     {
                                                     echo "Failed";
                                                     }
                                                     ?>
						</div>
						<div class="col-md-4">
                                                    <b>Booking Total</b> : ₹
                                                    <?php 
                                                   if(isset($clear_select['0']->price) && $clear_select['0']->price<>'')
                                                   {
                                                    echo round($clear_select['0']->price['0']->cash);   
                                                   }
                                                   else
                                                   {
                                                       echo $post['amount'];
                                                   }
                                                    ?>
                                                   <br/>
                                                    <font  size="1" color="grey" style="font-family: Helvetica, Arial, sans-serif;">( Inclusive Tax )</font>
						</div>
	                        </div>
                                 <br/>  
	                        <?php
	                        if(isset($xml_array['book-response']['flights']['flights']) && $xml_array['book-response']['flights']['flights']<>'')
	                        {
	                       $count_data=count($xml_array['book-response']['flights']['flight']);
	                       
	                       
	                       if($count_data>1 && $count_data<3)
	                       {
	                       for($i=0;$i<$count_data;$i++)
	                       {  
	                        ?>
							<div class="padding30 grey">				
							<div class="col-md-4">
							<b>Departure</b> :
							<?php
							//echo "<pre>";print_r($xml_array['AirBookingStatusResponse']['Bookings']);exit;
							echo $xml_array['book-response']['flights']['flight']['segments']['segment'][$i]['departure-airport']; ?>
							</div>
							<div class="col-md-4">
							<div class="w100percent">
							<b>Arrival</b> :
							<?php echo $xml_array['book-response']['flights']['flight']['segments']['segment'][$i]['arrival-airport']; ?>
							</div>

							</div>

							<div class="clearfix"></div><br/>



							</div>
						<?php }
						}
						else
						{
						 ?>	
				  <div class="padding30 grey">				
						<div class="col-md-4">
                                                    <b>Departure</b> :
                                                   <?php
                                                   //echo "<pre>";print_r($xml_array['AirBookingStatusResponse']['Bookings']);exit;
                                                    echo $xml_array['book-response']['flights']['flight']['segments']['segment']['departure-airport']; ?>
						</div>
						<div class="col-md-4">
							<div class="w50percent">
<b>Arrival</b> :
                                                    <?php echo $xml_array['book-response']['flights']['flight']['segments']['segment']['arrival-airport']; ?>
							</div>
												
						</div>
						
						<div class="clearfix"></div><br/>
						
						

					</div>
				 <?php } 
				 }
				 ?>
				
					<span class="size16px bold dark left">Passenger Details</span>
					
					<div class="clearfix"></div>
					<div class="line4"></div>
					<?php 
                                       
                                         //echo "<pre>";print_r($post);exit;
                                        $book_passsenger=json_decode(urldecode($post['book_passenger']));
                                        // echo "<pre>";print_r($book_passsenger);exit;
                                        $count_passengers=$book_passsenger->adults+$book_passsenger->children+$book_passsenger->children;
                                        $adults=$book_passsenger->adults;
                                        $children=$book_passsenger->children;
                                        $infants=$book_passsenger->infants;
                                       
					$i=0;
					if(isset($adults) && $adults<>'')
					{
					$j=$adults+3;
					for($i=3;$i<$j;$i++)
					{
					 ?>
					<!-- ROW -->
					<div class="row">
					<?php 
					$i=0;
					if(isset($adults) && $adults<>'')
					{
					$j=$adults+3;
					for($i=3;$i<$j;$i++)
					{
					 ?>
                                                
                                            <div class="col-md-3">
							<?php
                                                        echo $post['firstname'.$i].' '.$post['lastname'.$i];
                                                        ?>
                                                        
						</div>
						<div class="col-md-2">
							
							<?php  //echo $post['firstname'.$i] ; ?>
                                                    <?php echo $post['datepicker'.$i] ; ?>
							<input type="hidden" name="firstname<?php echo $i;?>" id="firstname<?php echo $i;?>" class="form-control " value="<?php echo $post['firstname'.$i] ; ?>" placeholder="">
						</div>
						<div class="col-md-3">
							
							<?php 
                                                        if($post['gender'.$i]==1)
                                                            {
                                                                echo "Male";
                                                            }
                                                            else
                                                            {
                                                                echo "Female";
                                                            }
                                                    //echo $post['lastname'.$i] ; ?>
							<input type="hidden" name="lastname<?php echo $i;?>" id="lastname<?php echo $i;?>" class="form-control " placeholder="" value="<?php echo $post['lastname'.$i] ; ?>">
						</div>
						<div class="col-md-3">
							<div class="w50percent">
                                                            
								<?php //echo $post['datepicker'.$i] ; 
                                                                
                                                                ?>
								<input type="hidden"name="datepicker<?php echo $i;?>" readonly="readonly" class="form-control mySelectCalendar" id="datepicker<?php echo $i;?>" value="<?php echo $post['datepicker'.$i] ; ?>" placeholder="mm-dd-yyyy"/>
							</div>
                                                    <script>
                                                    $(document).ready(function() {
                                                    $( "#datepicker<?php echo $i;?>" ).datepicker({
                                                    dateFormat: 'dd-mm-yy',	
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    maxDate: '-18Y',
                                                    yearRange: "-75:+0"	

                                                    });


                                                    });
                                                    </script>
                                                 </div>   
                                                    
							<div class="col-md-1">
                                                            <?php
//                                                            if($post['gender'.$i]==1)
//                                                            {
//                                                                echo "Male";
//                                                            }
//                                                            else
//                                                            {
//                                                                echo "Female";
//                                                            }
                                                            ?>
                                                        </div>						
						
						
						<div class="clearfix"></div><br/>
						
						
                                        <?php } } ?>        
					
                                        </div>
					<!-- END OF ROW -->
                                        <?php } 
                                        }
                                        ?>
                                        <?php
                                        if(isset($children) && $children<>'')
					{
					$j=$j=$adults+$children+3;
					for($i=3+$adults;$i<$j;$i++)
					{
					 ?>
					<!-- ROW -->
					<div class="col-md-3">
							<?php
                                                        echo $post['firstname'.$i].' '.$post['lastname'.$i];
                                                        ?>
                                                        
						</div>
						<div class="col-md-2">
							
							<?php  //echo $post['firstname'.$i] ; ?>
                                                    <?php echo $post['datepicker'.$i] ; ?>
							<input type="hidden" name="firstname<?php echo $i;?>" id="firstname<?php echo $i;?>" class="form-control " value="<?php echo $post['firstname'.$i] ; ?>" placeholder="">
						</div>
						<div class="col-md-3">
							
							<?php 
                                                        if($post['gender'.$i]==1)
                                                            {
                                                                echo "Male";
                                                            }
                                                            else
                                                            {
                                                                echo "Female";
                                                            }
                                                    //echo $post['lastname'.$i] ; ?>
							<input type="hidden" name="lastname<?php echo $i;?>" id="lastname<?php echo $i;?>" class="form-control " placeholder="" value="<?php echo $post['lastname'.$i] ; ?>">
						</div>
						<div class="col-md-3">
							<div class="w50percent">
                                                            
								<?php //echo $post['datepicker'.$i] ; 
                                                                
                                                                ?>
								<input type="hidden"name="datepicker<?php echo $i;?>" readonly="readonly" class="form-control mySelectCalendar" id="datepicker<?php echo $i;?>" value="<?php echo $post['datepicker'.$i] ; ?>" placeholder="mm-dd-yyyy"/>
							</div>
                                                    <script>
                                                    $(document).ready(function() {
                                                    $( "#datepicker<?php echo $i;?>" ).datepicker({
                                                    dateFormat: 'dd-mm-yy',	
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    maxDate: '-18Y',
                                                    yearRange: "-75:+0"	

                                                    });


                                                    });
                                                    </script>
                                                 </div>   
                                                    
							<div class="col-md-1">
                                                            <?php
//                                                            if($post['gender'.$i]==1)
//                                                            {
//                                                                echo "Male";
//                                                            }
//                                                            else
//                                                            {
//                                                                echo "Female";
//                                                            }
                                                            ?>
                                                        </div>						
						
						
						<div class="clearfix"></div><br/>
						
						
					<!-- END OF ROW -->
                                        <?php } 
                                        }
                                        ?>
                                        
                                        <?php
                                        if(isset($infants) && $infants<>'')
					{
					$j=$j=$infants+$adults+$children+3;
					for($i=3+$adults+$children;$i<$j;$i++)
					{
					 ?>
					<!-- ROW -->
					<div class="col-md-3">
							<?php
                                                        echo $post['firstname'.$i].' '.$post['lastname'.$i];
                                                        ?>
                                                        
						</div>
						<div class="col-md-2">
							
							<?php  //echo $post['firstname'.$i] ; ?>
                                                    <?php echo $post['datepicker'.$i] ; ?>
							<input type="hidden" name="firstname<?php echo $i;?>" id="firstname<?php echo $i;?>" class="form-control " value="<?php echo $post['firstname'.$i] ; ?>" placeholder="">
						</div>
						<div class="col-md-3">
							
							<?php 
                                                        if($post['gender'.$i]==1)
                                                            {
                                                                echo "Male";
                                                            }
                                                            else
                                                            {
                                                                echo "Female";
                                                            }
                                                    //echo $post['lastname'.$i] ; ?>
							<input type="hidden" name="lastname<?php echo $i;?>" id="lastname<?php echo $i;?>" class="form-control " placeholder="" value="<?php echo $post['lastname'.$i] ; ?>">
						</div>
						<div class="col-md-3">
							<div class="w50percent">
                                                            
								<?php //echo $post['datepicker'.$i] ; 
                                                                
                                                                ?>
								<input type="hidden"name="datepicker<?php echo $i;?>" readonly="readonly" class="form-control mySelectCalendar" id="datepicker<?php echo $i;?>" value="<?php echo $post['datepicker'.$i] ; ?>" placeholder="mm-dd-yyyy"/>
							</div>
                                                    <script>
                                                    $(document).ready(function() {
                                                    $( "#datepicker<?php echo $i;?>" ).datepicker({
                                                    dateFormat: 'dd-mm-yy',	
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    maxDate: '-18Y',
                                                    yearRange: "-75:+0"	

                                                    });


                                                    });
                                                    </script>
                                                 </div>   
                                                    
							<div class="col-md-1">
                                                            <?php
//                                                            if($post['gender'.$i]==1)
//                                                            {
//                                                                echo "Male";
//                                                            }
//                                                            else
//                                                            {
//                                                                echo "Female";
//                                                            }
                                                            ?>
                                                        </div>						
						
						
						<div class="clearfix"></div><br/>
						
						
					<!-- END OF ROW -->
                                        <?php } 
                                        }
                                        ?>
                                        
					
					<br/>
					<div class="fdash"></div>
					<br/>
					
					
					
					<span class="size16px bold dark left">Customer </span>
					
					<div class="clearfix"></div>
					<div class="line4"></div>
					<br/>
							
					<div class="col-md-4">
						<span class="dark">First Name:</span>
						&nbsp;&nbsp;<?php echo $post['first_name']; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $post['first_name']; ?>">
					</div>
					<div class="col-md-4 textleft">
					<span class="dark">Last Name:</span>
						&nbsp;&nbsp;<?php echo $post['last_name']; ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $post['last_name']; ?>">
					</div>
					
					<div>
					
					
					
					<div class="col-md-8 textright">
						<div class="mt15"><span class="dark" style="float: left;">Email Address:</span><span style="float: left;"> &nbsp;&nbsp;<?php echo $post['s_email']; ?><span></div>
					</div>
					<div class="col-md-4">
						<input type="hidden" name="s_email" class="form-control margtop10" placeholder="" value="<?php echo $post['s_email']; ?>">
					</div>
<div class="col-md-10 textright"><br>
						<div class="mt15" style="float: left;"><span class="dark">Preferred Phone Number:</span>&nbsp;&nbsp;<span> <?php echo $post['mobile']; ?></span></div>
					</div>
					<div class="col-md-4">
						<input style="width:20%;position: absolute;" type="hidden" readonly value="91" class="form-control"/><input type="hidden" name = "mobile" class="form-control" placeholder="" value="<?php echo $post['mobile']; ?>" >
					</div></div>
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address)<br/> 
					
					<br/>
					<br/>
					
					
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					<div class="alert alert-info">
                                        <?php
                                        if(isset($post['clear_select']) && $post['clear_select']<>'')
                                        {
                                        ?>
					<b>Attention! Please read important flight ticket information!	</b><br/><br/>
<p class="size12">• This ticket is booked though our partner Cleartrip.</p>
                                        <p  class="size12">
                                        • HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side.
                                        </p>
                                         <p  class="size12">
                                        • All bookings, modifications and cancellations are subject to Partner terms and conditions.
                                        </p>
                                        <p class="size12">• For queries related to payment status and booking confirmation, please contact us at support@smartbuy.com and 1800-000-000.</p>
                                        <p class="size12">• For any query and/or activity related to the service and/or modification and cancellation, please contact Cleartrip at support@cleartrip.com and 1800-000-000. Refund on flight ticket will be as per the airline rules.</p>
                                        <?php } 
                                        else
                                        {
                                        ?>
                                        <b>Attention! Please read important flight ticket information!	</b><br/><br/>
<p class="size12">• This ticket is booked though our partner Goibibo.</p>
                                        <p  class="size12">
                                        • HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side.
                                        </p>
                                         <p  class="size12">
                                        • All bookings, modifications and cancellations are subject to Partner terms and conditions.
                                        </p>
                                        <p class="size12">• For queries related to payment status and booking confirmation, please contact us at support@smartbuy.com and 1800-000-000.</p>
                                        <p class="size12">• For any query and/or activity related to the service and/or modification and cancellation, please contact Goibibo at support@goibibo.com and 1800-000-000. Refund on flight ticket will be as per the airline rules.</p>
                                        <?php 
                                        } ?>
                                        </div>
</form>			
				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding20">
						<span class="opensans size18 dark bold">Trip Summary</span>
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
					
					
					<!-- GOING TO -->
					<span class="dark"><b>Onward Flights</b></span>
                                        
                                                <div class="fdash mt10"></div><br/>
                                                
                                                
                                        <?php
                                        foreach($onw_return as $onward)
                                        {
                                            ?>
					<div>
                                            <table border="0" > 
                                                    <tr>
                                                        <td width="70px">
                                                <img src="themes/hdfc/assets/images/via/<?php echo $onward['car_id'];?>.gif"  />
                                                
                                                        </td>
                                                        <td valign="top" width="70px">
                                                    <font size="1">
                                                    <?php  echo $onward['car_id'].' - '.$onward['fnum'];?>
                                                    </font>      
                                                    </td>
                                                        <td valign="top">
                                                            <?php echo date('D d M Y',strtotime(str_replace("T","",$onward['dst_tym'])));?>      
                                                        </td>
                                                    </tr>
                                            </table>
                                            <br/>
						<div class="wh33percent left size12 bold dark">
							<?php echo strtoupper($onward['sour']);
                                                        
                                                        ?>
						</div>
						<div class="wh33percent left center size12 bold dark">
							
						</div>
                                                
						<div class="wh33percent right textright size12 bold dark">
							<?php echo strtoupper($onward['desti']);?>
						</div>
						<div class="clearfix"></div>
						
						<div class="wh33percent left">
							<div class="fcircle">
								<span class="fdeparture"></span>
							</div>
						</div>
						<div class="wh33percent left">
							<div class="fcircle center">
								<span class="fstop"></span>
							</div>
						</div>
						<div class="wh33percent right">
							<div class="fcircle right">
								<span class="farrival"></span>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="fline2px"></div>
						
						<div class="wh33percent left size12">
                                                    <?php echo  date('g:i A',strtotime(str_replace("T"," ",$onward['arr_tym']))); ?>
                                                  
						</div>
						<div class="wh33percent left center size12">
                                                    <?php
							//if(isset($con_origin) && $con_origin<>'')
                                                        //{
                                                          //echo $con_deptime;  
                                                        //}
                                                     ?>    
						</div>
						<div class="wh33percent right textright size12">
                                                    <?php echo  date('g:i A',strtotime(str_replace("T"," ",$onward['dst_tym']))); ?>
						</div>
						<div class="clearfix"></div>
					</div><br/>
                                        <?php 
                                        } 
                                        if(isset($ret_return) && $ret_return<>'')
                                        {
                                        ?>
                                        
                                        <span class="dark"><b>Return Flights</b></span>
                                        
                                                <div class="fdash mt10"></div><br/>
                                                
                                                
                                        <?php
                                        
                                        foreach($ret_return as $return)
                                        {
                                            ?>
					<div>
                                            <table border="0" > 
                                                    <tr>
                                                    <td width="70px">
                                                    <img src="themes/hdfc/assets/images/via/<?php echo $return['car_id'];?>.gif"  />
                                                    
                                                    </td>
                                                    <td valign="top" width="70px">
                                                    <font size="1">
                                                    <?php  echo $return['car_id'].' - '.$return['fnum'];?>
                                                    </font>      
                                                    </td>
                                                    <td valign="top">
                                                    <?php echo date('D d M Y',strtotime(str_replace("T","",$return['dst_tym'])));?>      
                                                    </td>
                                                    </tr>
                                            </table>
                                            <br/>
						<div class="wh33percent left size12 bold dark">
							<?php echo strtoupper($return['sour']);
                                                        
                                                        ?>
						</div>
						<div class="wh33percent left center size12 bold dark">
							
						</div>
                                                
						<div class="wh33percent right textright size12 bold dark">
							<?php echo strtoupper($return['desti']);?>
						</div>
						<div class="clearfix"></div>
						
						<div class="wh33percent left">
							<div class="fcircle">
								<span class="fdeparture"></span>
							</div>
						</div>
						<div class="wh33percent left">
							<div class="fcircle center">
								<span class="fstop"></span>
							</div>
						</div>
						<div class="wh33percent right">
							<div class="fcircle right">
								<span class="farrival"></span>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="fline2px"></div>
						
						<div class="wh33percent left size12">
                                                    <?php echo  date('g:i A',strtotime(str_replace("T"," ",$return['arr_tym']))); ?>
                                                  
						</div>
						<div class="wh33percent left center size12">
                                                    <?php
							//if(isset($con_origin) && $con_origin<>'')
                                                        //{
                                                          //echo $con_deptime;  
                                                        //}
                                                     ?>    
						</div>
						<div class="wh33percent right textright size12">
                                                    <?php echo  date('g:i A',strtotime(str_replace("T"," ",$return['dst_tym']))); ?>
						</div>
						<div class="clearfix"></div>
					</div><br/>
                                        <?php } 
                                        }?>
					<!-- END OF GOING TO -->
					
					<br/>
					
					<br/>
					
					<!-- Collapse 1 -->	
<!--					<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse1"></button>
					<div id="collapse1" class="collapse in">
						<div class="left size14">
							Flight<br/>
							Taxes & Fees 
						</div>
						<div class="right size14">
							$458.00<br/>
							$329.25
						</div><div class="clearfix"></div>	
					</div>-->
					<!-- End of collapse 1 -->
                                  
					<!-- Collapse 1 -->	
<!--					<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse1"></button>
					<div id="collapse1" class="collapse in">
						<div class="left size14">
							Flight<br/>
							Taxes & Fees 
						</div>
						<div class="right size14">
							$458.00<br/>
							$329.25
						</div><div class="clearfix"></div>	
					</div>-->
					<!-- End of collapse 1 -->
                                   
                                        
					
					
					

                                        </div>	


				</div><br/>
				
				
				
				
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	
<script type="text/javascript">


$("#datepicker1").on('click',function(){
alert('coming');
});



</script>
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>	
<script type="text/javascript" >
$(document).ready(function() {
$("#passenger_checkout").validate({
rules: {
firstname3 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname3 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker3 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        

firstname4 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname4 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker4 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname5 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname5 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker5 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        


firstname6 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname6 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker6 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname7 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname7 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker7 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname8 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname8 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker8 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname9 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname9 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker9 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname10 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname10 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker10 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
name : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
countrycode : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
phonenumber : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},     
landline : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
},      
state : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},       
city : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
country : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
countrycode : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
pincode : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

}, 
email : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},         
        


},
messages: {
email: { 
required: "This field is required.",
email: "Please Enter a Valid Email-Address."
}
},
submitHandler: function(frm) {
//  var point=$("#myTextInput").val();
//   var cash=$("#customerpoints1").val();

if(point==0 && cash==0)
{
$("#perror").css('display','block');

return false;
}
else
{
frm.submit();
$("#submit").css('display','none');
return true;
}
}


});
});

</script>
<style> .error{ color:red; } </style>
<?php Cart::destroy(); ?>			
	
