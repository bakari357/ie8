<?php 

$book_passenger=json_decode(urldecode($post['book_passenger']));
$odept_date=$book_passenger->departure;

if(isset($book_passsenger->type) && $book_passsenger->type=='R')
{
$arr_date=$book_passsenger->return;
}
if(isset($post['clear_select']) && $post['clear_select']<>'')
{
$clear_select=json_decode(urldecode($post['clear_select']));
}
//cleartrip

if(isset($post['itinerary_id']) && $post['itinerary_id']<>'')
{
 //flight display starts
            $onward= $clear_select[0];
            
            $ret = 0; 
            $return= array();
            
            $onw_return = Xml2array::toArray( $onward->onwardfl); 
            
            $faretype=Xml2array::toArray($onward->cleartrip_faretype);
            
            if(isset($onward->returnfl))
            {
              $faretype_return=Xml2array::toArray($onward->cleartrip_faretype);  
            }

            if(isset($post['return_select']) && $post['return_select']<>'') {
            $return_select=json_decode(urldecode($post['return_select']));
            
            $ret = 1; 
            $return = $return_select[0]; 

            $ret_return = Xml2array::toArray($return->returnfl);
            $faretype_return=Xml2array::toArray($return->cleartrip_faretype);
            }
            //international
            if(isset($onward->returnfl) && !empty($onward->returnfl)) {
            $return_selectint=Xml2array::toArray($onward->returnfl);
            

            $ret_return= $return_selectint;
            
            
            }
           

          
            //flight display ends
   
}
else
{
        
    //flight checkout starts
        $json_decoded=$data['json_decoded']=json_decode(urldecode($post['reprice_data']));
        $onwards = $json_decoded->onwardflights['0']; 
        
      // echo "<pre>";print_r($onwards);
        $new_array = array();
        $new_array[0]['sour'] = $onwards->origin;
        $onw_return['sour'][] = $onwards->origin;
        $new_array[0]['dst_tym']  = strtoupper($onwards->depdate);
        $new_array[0]['car_id']  = $onwards->carrierid;
        $new_array[0]['fnum']  = $onwards->flightno;
        $new_array[0]['desti']  = $onwards->destination;
        $new_array[0]['arr_tym'] = strtoupper($onwards->arrdate);
        if(isset($onwards->onwardflights)){
            $count = 1; 
        foreach($onwards->onwardflights as $oconnect){
      $onw_return['sourc'][] = $oconnect->origin;
      $new_array[$count]['sour'] = $oconnect->origin;
        $onw_return['sour'][] = $oconnect->origin;
        $new_array[$count]['dst_tym']  = strtoupper($oconnect->depdate);
        $new_array[$count]['car_id']  = $oconnect->carrierid;
        $new_array[$count]['fnum']  = $oconnect->flightno;
        $new_array[$count]['desti']  = $oconnect->destination;
        $new_array[$count]['arr_tym'] = strtoupper($oconnect->arrdate);
        
        $count++; 
        
        }
        }
        
        $faretype=array(array('fare_type'=>$onwards->warnings));
        $data['faretype']=$faretype;
        
        // Return Flights 
        if(isset( $json_decoded->returnflights['0']))
        {
        $return = $json_decoded->returnflights['0']; 
        $new_array_ret = array();
        
        $new_array_ret[0]['sour'] = $return->origin;
        $onw_return['sour'][] = $return->origin;
        $new_array_ret[0]['dst_tym']  = strtoupper($return->depdate);
        $new_array_ret[0]['car_id']  = $return->carrierid;
        $new_array_ret[0]['fnum']  = $return->flightno;
        $new_array_ret[0]['desti']  = $return->destination;
        $new_array_ret[0]['arr_tym'] = strtoupper($return->arrdate);
        if(isset($return->onwardflights)){
        $count = 1; 
        foreach($return->onwardflights as $oconnect){
        $onw_return['sourc'][] = $oconnect->origin;
        $new_array_ret[$count]['sour'] = $oconnect->origin;
        $onw_return['sour'][] = $oconnect->origin;
        $new_array_ret[$count]['dst_tym']  = strtoupper($oconnect->depdate);
        $new_array_ret[$count]['car_id']  = $oconnect->carrierid;
        $new_array_ret[$count]['fnum']  = $oconnect->flightno;
        $new_array_ret[$count]['desti']  = $oconnect->destination;
        $new_array_ret[$count]['arr_tym'] = strtoupper($oconnect->arrdate);

        $count++; 

        }
        }
        }
        
        $onw_return=$new_array;
        
        if(isset($new_array_ret) && $new_array_ret<>'')
            {
            $ret_return=$new_array_ret;    
            $faretype_return=array(array('fare_type'=>$return->warnings));
            $data['faretype_return']=$faretype_return;
            }
            
       //flight checkout ends
}
//echo "<pre>";print_r($post);exit;

//goibibo

if(isset($response->booking_id) && $response->booking_id<>'')
{
    $response_goibibo=  json_decode($response->booking_id);
    
    //echo "<pre>"; print_r($response_goibibo);exit;
    
    $booking_id=$response_goibibo->data['0']->bookingid;
    $final_fare=$response_goibibo->data['0']->finalfare;
}
?>
<link href="themes/hdfc/assets/updates/update1/css/style01.css" rel="stylesheet" media="screen">
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="<?php  print_r(Config::get('app.url')); ?>">Flights</a></li>
					<li>/</li>
					<li><a href="#">Confirmation</a></li>
										
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
	<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>"  id="passenger_checkout">

           
			<!-- LEFT CONTENT -->
                        <div  id="toPopupajax" style="height:243px;top:36%;display:none;"> 
                        <img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/ajax-loader.gif">
                        </div>

                        <div id="toPopup" class="container col-xs-12" style="height:243px;top:5%; margin-left:-15px;"> 
                        <div class="topopup-inner">
                        <div class="close"></div>
                        <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
                        <div> 


                        <div id="popup_content" style="overflow-y:scroll;height:500px" > <!--your content start-->

                        </div> <!--your content end-->
                        </div>
                        </div>
                        </div> <!--toPopup end-->
                        <div class="loader"></div>
                        <div id="backgroundPopup"></div>
			
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
                                        <span class="size16px bold dark left">Flight booking is Failed !!!
                                        
                                        <?php 
                                        echo "<br/>";echo "<br/>";
                                            echo "Sorry! Your booking is not confirmed. Your order ID :";
                                            echo $order_number;
                                        
                                        } ?></span>
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
                                                    <b>Price</b> : ₹
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
						</div>
	                        </div>	<br/>
	                          <?php
	                       if(isset($xml_array['book-response']['flights']['flights']) && $xml_array['book-response']['flights']['flights']<>'')
	                        {   
	                       $count_data=count($xml_array['book-response']['flights']['flight']);
	                       
	                      
	                       if($count_data>1 && $count_data<3)
	                       {
	                       for($i=0;$i<$count_data;$i++)
	                       {  
	                       //echo "<pre>";print_r($xml_array['book-response']['flights']['flight']);exit;
	                        ?>
	                        <div class="padding30 grey">				
						<div class="col-md-4">
                                                    <b>Departure</b> :
                                                   <?php
                                                   //echo "<pre>";print_r($xml_array['AirBookingStatusResponse']['Bookings']);exit;
                                                    echo $xml_array['book-response']['flights']['flight'][$i]['segments']['segment']['departure-airport']; ?>
						</div>
						<div class="col-md-4">
							<div class="w50percent">
<b>Arrival</b> :
                                                    <?php echo $xml_array['book-response']['flights']['flight'][$i]['segments']['segment']['arrival-airport']; ?>
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
				 <?php }} ?>
				
					<span class="size16px bold dark left">Passenger Details</span>
					
					<div class="clearfix"></div>
					<div class="line4"></div>
					<?php 
                                       
                                         //echo "<pre>";print_r($post);exit;
                                        $book_passsenger=json_decode(urldecode($post['book_passenger']));
                                        
                                        $count_passengers=$book_passsenger->adults+$book_passsenger->children+$book_passsenger->infants;
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
					
					
					
					
					<div class="clearfix"></div>
					<div class="line4"></div>
					
                                        <div class="alert alert-info">
                                        <?php
                                        if(isset($post['clear_select']) && $post['clear_select']<>'')
                                        {
                                        echo Lang::get('partners.cleartrip.checkout');
                                        }
                                        else
                                        {
                                        echo Lang::get('partners.goibibo.checkout');    
                                        }
                                        ?>
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
                                        $count_faretype=0;
                                        foreach($onw_return as $onward)
                                        {
                                            ?>
					<div>
                                            <table border="0" > 
                                                    <tr>
                                                        <td width="70px">
                                                <img src="themes/hdfc/assets/images/via/<?php echo $onward['car_id'];?>.gif"  />
                                                
                                                        </td>
                                                        <td valign="top" width="80px">
                                                    <font size="1">
                                                    <?php  
                                                   
                                                    echo $onward['car_id'].' - '.$onward['fnum']."<br/>";
                                                    echo $faretype[0]['fare_type'];
                                                    ?>
                                                    
                                                    </font>      
                                                    </td>
                                                        <td valign="top">
                                                        <font size="1">
                                                            <?php echo date('D d M Y',strtotime(str_replace("T","",$onward['dst_tym'])));?>      
                                                        </font>    
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
                                        $count_faretype++;
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
                                                    <td valign="top" width="80px">
                                                    <font size="1">
                                                    <?php  echo $return['car_id'].' - '.$return['fnum'];?><br/>
                                                    <?php echo $faretype_return[0]['fare_type']; ?>
                                                    </font>      
                                                    </td>
                                                    <td valign="top">
                                                    <font size="1">
                                                    <?php echo date('D d M Y',strtotime(str_replace("T","",$return['dst_tym'])));?>      
                                                    </font>
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
	<script>

function funform(i){ 

$.ajax({
url : "fare_rule_goibibo",
type: "POST",
data : {req:i},
async:true,
success: function(response, textStatus, jqXHR)
{
$("#backgroundPopup").show();


$("#popup_content").html(response);
$("#backgroundPopup").show();
$("#toPopup").show();



$(".ecs_tooltip").click(function()
{	
$("#toPopup").hide();
$("#backgroundPopup").hide();
});  


$(".loader").load(function()
{
$("#popup_content").html(data);
});

$(this).keyup(function(event) {
if (event.which == 27) { // 27 is 'Ecs' in the keyboard
$("#toPopup").hide();
$("#backgroundPopup").hide();
}  	
});

$("div#backgroundPopup").click(function() {
$("#toPopup").hide();
$("#backgroundPopup").hide();
});  

$("div.close").click(function() {
$("#toPopup").hide();
$("#backgroundPopup").hide();
});

}
});




}
</script>

<?php Cart::destroy(); ?>			
	
