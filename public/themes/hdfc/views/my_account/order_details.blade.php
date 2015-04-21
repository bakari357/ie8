<body id="top" class="thebg" >
   
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#" class="active"> Orders Details</a>
                                                </li>					
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
			
			<!-- CONTENT -->
			<div class="col-md-12 pagecontainer2 offset-0">
				
			
					
				<!-- RIGHT CPNTENT -->
				<div class="col-md-11 offset-0">
					<!-- Tab panes from left menu -->
					<div class="tab-content5">
					
					  <!-- TAB 1 -->
					  <div class="tab-pane padding40 active" id="profile">

						
						  
						  
						<div class="clearfix"></div>
						
						<div class="relative margtop10">
							
						
						</div>
						  
						
	<span class="size16 bold"> Order Details</span> 

                <?php $login=Session::get('customer_data');
                          if($login){?>
                     <div class="right"> <?php echo HTML::link('list_orders','<< Back'); ?>	</div>
              
                  <?php } else {  ?> 
                     <div class="right"> <?php echo HTML::link('guest_order','<< Back'); ?>	</div>
                             <?php  } ?>



		
			<div class="line2"></div>
						  
						<!-- COL 1 -->
 <div class="col-md-12 offset-0">

		<table class="table table-striped">
		    
		      <?php  if(isset($input)) { $input_values = $input->Posted; } 
  
                     // Movie starts here
             //   echo'<pre>'; print_r($input);  print_r($output); exit;

                           if(isset($input) && $input->API_Type == 'funcinemas') {
                         //  if(isset($output) && $output->booking_id <>'') { $booking_id = $output->booking_id;}
		                ?>  
                            <tr> 
		              <td>Movie </td> 
		              <td><?php echo $input_values->Movie; ?></td>
		         </tr>
                         <tr>
		              <td>Screen </td>
		              <td ><?php echo $input_values->Screen; ?></td>
                         </tr>
                         <tr> 
		              <td>Show Time </td> 
		              <td><?php echo $input_values->ShowTime; ?></td>
		         </tr>
                         <tr>
		              <td>Finish Time </td>
		              <td ><?php echo $input_values->FinishTime; ?></td>
                         </tr>
                          <tr> 
		              <td>Center </td> 
		              <td><?php echo $input_values->Center; ?></td>
		         </tr>                     
		         <tr> 
		              <td>Order Id </td> 
		              <td><?php echo $input_values->order_id; ?></td>
		          </tr> 
                         <?php  if(isset($output)) { ?>
                             
                          <tr>
		              <td>Status </td>
		              <td ><?php  echo $output->status; ?></td>
                         </tr>
                          <?php } ?>
                            <tr> 
		              <td>Row Id </td> 
		              <td><?php echo $input_values->rowid; ?></td>
		          </tr>
                             
                         <tr>
		              <td>Number of seat selected </td>
		              <td ><?php echo $input_values->QTY; ?></td>
                         </tr>

                              <tr> 
		              <td>Class </td> 
		              <td><?php echo $input_values->Class; ?></td>
		         </tr>
                         <tr>
		              <td>Ticket Price </td>
		              <td >Rs <?php echo round($input_values->TicketPrice);?> </td>
                         </tr>
                          <?php  if(isset($input_values->seats) && !empty($input_values->seats)) { ?>
                         <tr>
		              <td>Seats </td>
		              <td ><?php echo $input_values->seats; ?></td>
                         </tr> <?php } ?>
                          <tr> 
		              <td>Email </td> 
		              <td><?php echo $input_values->s_email; ?></td>
		         </tr>
                         <tr> 
		              <td>Amount </td> 
		              <td>Rs <?php echo round($input_values->amount);?> </td>
		         </tr>
                         <?php } 

                         // cinepolis
                                  if(isset($input) && $input->API_Type == 'cinepolis') {
                          // if(isset($output) && $output->booking_id <>'') { $booking_id = $output->booking_id;}
		                ?>  
                            <tr> 
		              <td>Movie </td> 
		              <td><?php echo $input_values->moviename; ?></td>
		         </tr>
                         <tr> 
		              <td>Booking Id </td> 
		              <td><?php echo $input_values->BookingId; ?></td>
		         </tr>
                         <tr>
		              <td>Screen </td>
		              <td ><?php echo $input_values->ScreenId; ?></td>
                         </tr>
                         <tr> 
		              <td>Show Date and Time </td> 
		              <td><?php echo $input_values->showdate .'  ' . $input_values->showtime; ?></td>
		         </tr>
                         
                         
                          <tr> 
		              <td>Center </td> 
		              <td><?php echo $input->Center; ?></td>
		         </tr>                     
		        
                         <?php  if(isset($output)) { ?>
                             
                          <tr>
		              <td>Status </td>
		              <td ><?php  echo $output->status; ?></td>
                         </tr>
                          <?php } ?>
                            
                             
                         <tr>
		              <td>Number of seat selected </td>
		              <td ><?php echo $input_values->QTY; ?></td>
                         </tr>

                              <tr> 
		              <td>Class </td> 
		              <td><?php echo $input_values->selectedclass; ?></td>
		         </tr>
                         
                          <?php  if(isset($input_values->seats) && !empty($input_values->seats)) { ?>
                         <tr>
		              <td>Seats </td>
		              <td ><?php echo $input_values->seats; ?></td>
                         </tr><?php } ?>
                          <tr> 
		              <td>Email </td> 
		              <td><?php echo $input_values->s_email; ?></td>
		         </tr>
                         <tr> 
		              <td>Amount </td> 
		              <td>Rs <?php echo round($input_values->amount);?> </td>
		         </tr>
                         <?php } 
                    // Hotels starts here
                          else if(isset($input) && $input->API_Type == 'hotels') {
                 
                      if(isset($output)) { $out_result = Xml2array::toArray($output); 
                        $outs = $out_result['booking_id']['HotelRoomReservationResponse'] ;
                        $cancel_policy = $outs['RateInfos']['RateInfo']['cancellationPolicy'];


}
                      //echo'<pre>'; print_r($out_result['booking_id']['HotelRoomReservationResponse']['RateInfos']['RateInfo']['cancellationPolicy']); exit;
                             ?>                       
		         <tr> 
		              <td>Hotel </td> 
		              <td><?php echo $input_values->name; ?></td>
		          </tr> 
                            <tr> 
		              <td>City </td> 
		              <td><?php echo $input_values->cityname;  ?></td>
		          </tr> 

                           <?php if(isset($out_result) && !empty($out_result)) { ?>

                        <tr> 
		              <td>Itinerary Id </td> 
		              <td><?php echo $outs['itineraryId'];  ?></td>
		          </tr> 

                      <tr> 
		              <td>Confirmation Numbers </td> 
		              <td><?php echo $outs['confirmationNumbers'];  ?></td>
		          </tr> 
                          <tr> 
		              <td>Cancellation Policy  </td> 
		              <td><?php echo $cancel_policy;  ?></td>
		          </tr> 
                       <?php } ?>  

                            <tr>
		              <td>Status </td>
		              <td ><?php  echo $output->status; ?></td>
                         </tr>
                          
                          <tr> 
		              <td>Hotel Id</td> 
		              <td><?php echo $input_values->hotelid; ?></td>
		          </tr> 
                          
                           <tr> 
		              <td>Check In  </td> 
		              <td><?php echo $input_values->check_in; ?></td>
		         </tr>
                         <tr>
		              <td>Check Out </td>
		              <td ><?php echo $input_values->check_out; ?></td>
                         </tr>
                         <tr> 
		              <td>Number of Roomes </td> 
		              <td><?php echo $input_values->num_rooms; ?></td>
		         </tr>
                         <tr>
		              <td>Name </td>
		              <td ><?php echo $input_values->firstName1; ?></td>
                         </tr>
                          <tr> 
		              <td>Email </td> 
		              <td><?php echo $input_values->s_email; ?></td>
		         </tr>
                         <tr>
		              <td>Room Type Code </td>
		              <td ><?php echo $input_values->roomTypeCode; ?></td>
                         </tr>

                              <tr> 
		              <td>Amount </td> 
		              <td>Rs <?php echo round($input_values->amount); ?> </td>
		         </tr>
                           <?php } 


                       // clear trip hotels
                           else if(isset($input) && $input->API_Type == 'cleartrip') {
                                  if(isset($output)) { $booking_id = Xml2array::toArray($output);}
                            	$clear_id=$booking_id['booking_id']['book-response']['booking-id'];
				$details = Hotel::Hotel_clr_inter($clear_id);
                                $intinery = $details['itinerary'];
                                $hotel_details = $intinery['hotel-detail'];  
                                $room_details = $intinery['rooms']['room'];
                                $status = $intinery['booking-info-list']['booking-info'];
                                $payment = $intinery['payment-detail'];
                             ?>  
                              

                          <?php  if(isset($booking_id))  {  ?>                   
		           <tr> 
		              <td>Hotel </td> 
		              <td><?php echo $hotel_details['name']; ?></td>
		          </tr>  
                        <tr> 
		              <td>City </td> 
		              <td><?php echo $hotel_details['city'];  ?></td>
		          </tr>
                           <tr> 
		              <td>Address </td> 
		              <td><?php echo $hotel_details['address'];  ?></td>
		          </tr>
                           
                          <tr> 
		              <td>Hotel Id</td> 
		              <td><?php echo $hotel_details['hotel-id']; ?></td>
		          </tr> 

                           <tr> 
		              <td>Hotel Booking Id</td> 
		              <td><?php echo $intinery['trip-ref'];?></td>
		          </tr> 
                          
                           <tr> 
		              <td>Check In  </td> 
		              <td><?php echo $intinery['check-in-date']; ?></td>
		         </tr>
                         <tr>
		              <td>Check Out </td>
		              <td ><?php echo $intinery['check-out-date']; ?></td>
                         </tr>
                         <tr> 
		              <td>Number of Roomes </td> 
		              <td><?php echo $room_details['index']; ?></td>
		         </tr>

                            <tr>
		              <td>Room Type </td>
		              <td ><?php echo $room_details['type']; ?></td>
                         </tr>


                         <tr>
		              <td>Name </td>
		              <td ><?php echo $intinery['contact-detail']['first-name'].' '.$intinery['contact-detail']['last-name']; ?></td>
                         </tr>
                          <tr> 
		              <td>Email </td> 
		              <td><?php echo $intinery['contact-detail']['email']; ?></td>
		         </tr>
                        
                         <tr> 
		              <td>Phone Number </td> 
		              <td><?php echo $intinery['contact-detail']['mobile']; ?></td>
		         </tr>
                          <?php if(isset($status['voucher-number']) && !empty($status['voucher-number'])) { ?>
                              <tr>
		              <td>Voucher Number </td>
		              <td ><?php echo $status['voucher-number'];  ?></td>
                         </tr>  <?php } ?>
  
                            <tr> 
		              <td>Payment Type</td> 
		              <td><?php echo $payment['payment-type']  ; ?></td>
		          </tr> 
                             <tr> 
		              <td>Amount </td> 
		              <td>Rs <?php echo round($payment['amount']); ?> </td>
		         </tr>
                            <tr> 
		              <td>Status</td> 
		              <td><?php if($payment['status'] == 'S') { echo "Success"; } else { echo "Pending";} ?></td>
		          </tr> 
                           
                      <?php } 
                                 }



                       // Recharge starts here
                          else if(isset($input) && $input->API_Type == 'recharge') {
                  
                               if(isset($output)) { $booking_id = $output->Response;}
                               $operator = DB::table('myoxi_operators')->select('operator')
                                     ->where('abbr','=',$input_values->operator)->first();
                                   ?>  
                                                
			<?php if(isset($input_values))  { ?>

                         <tr>
                            <td>Name</td>
                            <td><?php echo $input_values->first_name; ?></td>
                         </tr>    
                        <tr> 
			     <td>Email </td> 
			     <td><?php echo $input_values->s_email; ?></td>
			</tr>
 			<tr> 
			   <td>Mobile Number </td> 
			   <td><?php echo $input_values->mobile; ?></td>
			</tr>

			
			<tr> 
			     <td>Transaction Type</td> 
			     <td><?php echo $input_values->ttype; ?></td>
			</tr>   
			<tr>
			     <td>Payment </td> 
			     <td><?php echo $input_values->payment; ?></td>
                       <tr> 


			<?php if($input->payment == 'DTH') {?>
			<tr> 
			     <td>Subscriber Id </td> 
			     <td><?php echo $input_values->subscriber_id; ?></td>
			</tr>
			        <?php }  
 
			if($input->payment == 'recharge') { ?>
			<tr> 
			      <td>Operator</td> 
			      <td><?php echo $operator->operator; ?></td>
			</tr> 

			<tr> 
			      <td>Transaction Type</td> 
			      <td><?php echo $input_values->ttype; ?></td>
			</tr> 
			<?php } 

                       if($input->payment == 'postpaid') { ?>
			<tr> 
			      <td>Operator</td> 
			      <td><?php echo $operator->operator; ?></td>
			</tr> 
                        <tr> 
			      <td>Relationship Number</td> 
			      <td><?php echo $input->params->relation_no; ?></td>
			</tr> 
                        <tr> 
			      <td>Bill ID</td> 
			     <td><?php echo $input_values->biller_id; ?></td>
			</tr>
                             <tr> 
			      <td>Customer Name</td> 
			     <td><?php echo $input_values->customer_name; ?></td>
			</tr>  
			<tr> 
			      <td>Transaction Type</td> 
			      <td><?php echo $input_values->ttype; ?></td>
			</tr> 
			<?php } 

			if($input->payment == 'electricity') { ?>
                        <tr> 
			      <td>Bill Name</td> 
			      <td><?php echo $input_values->biller_name; ?></td>
			</tr> 
			 <tr> 
			      <td>Bill ID</td> 
			     <td><?php echo $input_values->biller_id; ?></td>
			</tr>
                         <?php     }

                         if($input->payment == 'insurance') { ?>
                        
                         <tr>
                              <td>Policy Number</td>
                              <td><?php echo $input_values->policy_no; ?></td>
                            </tr>
                         
			      <td>Bill Name</td> 
			      <td><?php echo $input_values->biller_name; ?></td>
			</tr> 
			 <tr> 
			      <td>Bill ID</td> 
			     <td><?php echo $input_values->biller_id; ?></td>
			</tr>
                        <tr>
                              <td>Premium Amount</td>
                              <td> Rs <?php echo $input_values->premium_amount; ?></td>
                            </tr>
                          <tr> 
                         <?php     }

			if($input->payment == 'creditcard') { ?>
                        <tr> 
			     <td>Credit Card Number</td> 
			     <td><?php echo $input_values->creditcard_number; ?></td>
			</tr> 
			<tr> 
			     <td>Card Holder Name</td> 
			     <td><?php echo $input_values-> cardholder_name; ?></td>
			</tr> 

			<tr> 
			       <td>Bill Name</td> 
			       <td><?php echo $input_values->biller_name; ?></td>
			</tr> 

			<tr> 
			       <td>Bill ID</td> 
			       <td><?php echo $input_values->biller_id; ?></td>
			</tr>
                           <?php     }


			if($input->payment == 'gas') { ?>
			<tr> 
			      <td>Customer Id</td> 
			      <td><?php echo $input_values->customer_id; ?></td>
			</tr> 
			<tr> 
		              <td>Meter Number</td> 
			      <td><?php echo $input_values->meter_no; ?></td>
			</tr> 
                        <tr> 
			       <td>Bill Name</td> 
			       <td><?php echo $input_values->biller_name; ?></td>
			</tr> 
			<tr> 
		        	<td>Bill ID</td> 
			        <td><?php echo $input_values->biller_id; ?></td>
			</tr>

			<?php } 

			if($input->payment == 'charity') { ?>
                         <tr> 
			       <td>Charity Biller Id Id</td> 
			       <td><?php echo $input_values->chartity_billerid; ?></td>
			</tr> 
			<tr> 
			       <td>Bill Name</td> 
			       <td><?php echo $input_values->biller_name; ?></td>
			</tr> 
			<tr> 
			       <td>Donor Name</td> 
			       <td><?php echo $input_values->donor_name; ?></td>
			</tr> 
			<tr> 
			       <td>First Address </td> 
			       <td><?php echo $input_values->address1; ?></td>
			</tr> 
			<tr> 
			       <td>second Address Name</td> 
			       <td><?php echo $input_values->address2; ?></td>
			</tr> 
                         <?php } ?>
                         
			     <td>Amount </td> 
			    <td> Rs <?php echo round($input_values->amount); ?> </td>
			</tr>
			<tr>
			<td>Status </td>
			<td ><?php if(isset($output)) { echo $output->status; } ?></td>
			</tr>       
			<?php  }

			}


                        // Music starts here
                          else if(isset($input) && $input->API_Type == 'Hungama') {
                              if(isset($output)) { $order = Xml2array::toArray($output) ;
                              	$order_id = $order['Output']['order']['response']['order_id'];
				$url = $order['Output']['result']['response'];   } 
				$in_values= Xml2array::toArray($input);
                                $music_name= base64_decode($in_values['Posted']['music_details']);
				$music_details =  explode('|',$music_name) ;   
                                           ?> 

                            <tr> 
		              <td>Music</td> 
		              <td><?php echo $music_details[1] ; ?></td>
		          </tr>  
                            
                              <?php if(isset($order)) {  ?>
                            <tr> 
		              <td>Order ID </td> 
		              <td><?php echo $order_id;  ?></td>
		            </tr> 
                            <tr>
		              <td>Status </td>
		              <td ><?php echo $order['status']; ?></td>
                         </tr>
                          <tr> 
		              <td>URL</td> 
		              <td><?php if(isset($url['url']) && $url['url']<>''){ ?> <a href="<?php echo $url['url']; ?>" >Download your song </a> <?php }; ?></td>
		          </tr> 
                             <?php } ?> 
                           <tr> 
		              <td>Amount </td> 
		              <td>Rs <?php echo round($input_values->amount); ?>  </td>
		         </tr>
                         <?php  } 


                     // Flights starts here
                              
                          else if(isset($input) && $input->API_Type == 'Cleartrip_flights') { 
                                 $onward = Xml2array::toArray(json_decode(urldecode($input_values->clear_select)));
                                foreach($onward as $oneway) { $oneard_flight =  $oneway;    }
                               if(isset($return)) { $return = Xml2array::toArray(json_decode(urldecode($input_values->return_select)));  
                                 foreach($return as $twoway) { $return_flight =  $twoway;    }} 
                                
                               if(isset($output) && $output->status =="Booked") {
				$book=Xml2array::xml2array_test(trim($output->booking_data));
                               // $booking_details=$book['book-response'];
                             
                               $trip_id = $book['book-response'];
                               $flights = $trip_id['flights']['flight']['segments']['segment'];
                               $class = $trip_id['pax-pricing-info-list']['pax-pricing-info']['booking-info-list']['booking-info'];              $contact = $trip_id['contact-detail']; }
                                    
         ?> 
                            
                     <tr> 
	              <td>Flight </td> 
		   <td><?php echo $oneard_flight['onwardfl'][0]['car_id'].' - '.$oneard_flight['onwardfl'][0]['fnum'];
                      if(isset($return_flight)) { echo ' , ' .$return_flight['returnfl'][0]['car_id'].' - '.$return_flight['returnfl'][0]['fnum'];}?> 
                        </td>
		          </tr> 
                              <tr> 
		              <td>Source</td> 
		              <td><?php echo $oneard_flight['onwardfl'][0]['sour'];
                                  if(isset($return_flight)) { echo ' - ' .$return_flight['returnfl'][0]['sour'];}?>
                             </td>
		          </tr> 
                          <tr> 
		              <td>Destination</td> 
		              <td><?php echo $oneard_flight['onwardfl'][0]['desti']; 

                                  if(isset($return_flight)) { echo ' - ' .$return_flight['returnfl'][0]['desti'];}  ?>
                              </td>
		          </tr> 
                         

                            <tr> 
		              <td>Arrival Time </td> 
		              <td><?php     $pieces = explode(" ", date('d-m-Y H:i',strtotime(str_replace("T"," ",$oneard_flight['onwardfl'][0]['arr_tym'])))); echo $pieces[0].'  '.$pieces[1] ; 
                                      if(isset($return_flight)) { echo ' , ' .$pieces = explode(" ", date('d-m-Y H:i',strtotime(str_replace("T"," ",$return_flight['returnfl'][0]['arr_tym'])))); echo $pieces[0].' '.$pieces[1] ;}  ?>
                               </td>
		          </tr> 
                             <tr> 
		              <td>Departure Time </td> 
               
		              <td><?php  $pieces = explode(" ", date('d-m-Y H:i',strtotime(str_replace("T"," ",$oneard_flight['onwardfl'][0]['dst_tym'])))); echo $pieces[0].'  '.$pieces[1] ; 
                                    if(isset($return_flight)) { echo ' , ' .$pieces = explode(" ", date('d-m-Y H:i',strtotime(str_replace("T"," ",$return_flight['returnfl'][0]['dst_tym'])))); echo $pieces[0].' '.$pieces[1] ;}  ?>
                               </td>
		          </tr> 
 
    

                      <?php   if(isset($output) && $output->status =="Booked") {
                                   ?> 
                         
                               
                        
		         <tr> 
		              <td>Flight Booking ID</td> 
		              <td><?php  echo $trip_id['trip-id'];?></td>
		          </tr> 
 
                           
                              <tr> 
		              <td>Booking Class</td> 
		              <td><?php  echo $class['booking-class'];?></td>
		          </tr> 

                            <tr> 
		              <td>Cabin Type </td> 
		              <td><?php  echo $class['cabin-type']; ?></td>
		          </tr> 
                             <tr> 
		              <td>Airline PNR </td> 
		              <td><?php echo $class['airline-pnr']; ?></td>
		          </tr> 
                            <tr> 
		            <td>Amount</td> 
		            <td>Rs <?php echo round($trip_id['payment-detail']['amount']); ?> </td>
		          </tr>
                
                         

                            <?php } ?>
                       
                         <tr> 
		              <td>Person Name </td> 
		              <td><?php  echo $input_values->firstname3;  ?> </td>
		          </tr>
                          

                           <tr> 
		              <td>Phone Number </td> 
		              <td><?php  echo $input_values->mobile; ?></td>
		          </tr>
                          <tr> 
		              <td>Email</td> 
		              <td><?php  echo $input_values->s_email; ?></td>
		          </tr>
                                <tr>
		              <td>Status </td>
                               <td><?php if(isset($output)) { echo $output->status; }  ?></td>
		             
                         </tr>                      
                                 <?php }
                         else { echo "No data found"; }?>
		


		</table>
                







						
						</div>
						<!-- END OF COL 1 -->
						
						<div class="clearfix"></div><br/><br/><br/>
						
						
						
						
						
					  </div>
				
					  
					

					  
					</div>
					<!-- End of Tab panes from left menu -->	
					
				</div>
				<!-- END OF RIGHT CPNTENT -->
			
			<div class="clearfix"></div><br/><br/>
			</div>
			<!-- END CONTENT -->			
			

			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->

