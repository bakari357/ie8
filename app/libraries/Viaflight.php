<?php
class Viaflight {

	
	public static function getflight($param) {
		$action='AirFareSearchRequest';
		$authkey = '&source=REWARDS360&auth=29360RE0WARDS';
		$xmlRequest="<AirFareSearchRequest>
				<Route>
				<Source>".$param[0]."</Source>
				<Destination>".$param[1]."</Destination>
				<DateOfDeparture>".$param[2]."</DateOfDeparture>";
		if($param[7]=='R'){
		$xmlRequest.="<DateOfArrival>".$param[8]."</DateOfArrival>	
		              <DiscountedReturnFareSearch>".$param[9]."</DiscountedReturnFareSearch>";		
		}		
		$xmlRequest.="</Route>
				<PassengerCount>
				<Adults>".(int)$param[3]."</Adults>
				<Children>".(int)$param[4]."</Children>
				<Infants>".(int)$param[5]."</Infants>
				</PassengerCount>
				<CabinPreference>
				<SeatingClass>".$param[6]."</SeatingClass>
				</CabinPreference>
				</AirFareSearchRequest>";
		$get_flights= 'http://api.viaworld.in/webserviceAPI?actionId='.$action.'&xmlRequest='.urlencode($xmlRequest).'&'.$authkey;
		$flightlist= Hungama::doMessage($get_flights); 
		return $flightlist;
	}


	public static function airprice_details($firstflight,$secondflight='',$post,$start="",$dest="") {
                   
		$p=unserialize(str_replace('quot','"',$post));
			
                if($p['type']=='R' && $p['discouted']=='on')
		{
		$airpricerequestxml='<AirPriceRequest>
					<RequestId></RequestId>
					<Mobile></Mobile>
					<Itinerary>';
		$airpricerequestxml .='<OnwardFlights>';
		$ex=(str_replace('quot','"',$firstflight));
		$FirstFlight=unserialize($ex);
		$response=Viaflight::split_flights($FirstFlight['Flights']['Flight'],$p['leavingfrom'],$p['goingto']);
		foreach($response['onward'] as $onward=>$flights)
		{
		   if(!empty($flights['Source']))
		     {		
		       if(empty($flights['Class']))
		          {
		$flights['Class']='-';
		}
		$airpricerequestxml .='<Flight>
					<CarrierId>'.$flights['Carrier_attr']['id'].'</CarrierId>
					<FlightNumber>'.$flights['FlightNumber'].'</FlightNumber>
					<Source>'.$flights['Source'].'</Source>
					<Destination>'.$flights['Destination'].'</Destination>
					<DepartureTimeStamp>'.$flights['DepartureTimeStamp'].'</DepartureTimeStamp>
					<ArrivalTimeStamp>'.$flights['ArrivalTimeStamp'].'</ArrivalTimeStamp>
					<Class>'.$flights['Class'].'</Class>
					<FareBasis>'.$flights['FareBasis'].'</FareBasis>
					</Flight>';
		}
		}
		$airpricerequestxml .='</OnwardFlights>';
               
		$airpricerequestxml .='<ReturnFlights>';
		foreach($response['return'] as $return=>$flights)
		{
		$airpricerequestxml .='<Flight>
					<CarrierId>'.$flights['Carrier_attr']['id'].'</CarrierId>
					<FlightNumber>'.$flights['FlightNumber'].'</FlightNumber>
					<Source>'.$flights['Source'].'</Source>
					<Destination>'.$flights['Destination'].'</Destination>
					<DepartureTimeStamp>'.$flights['DepartureTimeStamp'].'</DepartureTimeStamp>
					<ArrivalTimeStamp>'.$flights['ArrivalTimeStamp'].'</ArrivalTimeStamp>
					<Class>'.$flights['Class'].'</Class>
					<FareBasis>'.$flights['FareBasis'].'</FareBasis>
					</Flight>';
		}
		$airpricerequestxml .='</ReturnFlights>';
		$airpricerequestxml .='</Itinerary>';
		$airpricerequestxml .='<PassengerCount>
					<Adults>'.(int)$p['adults'].'</Adults>
					<Children>'.(int)$p['children'].'</Children>
					<Infants>'.(int)$p['infants'].'</Infants>
					</PassengerCount>';
		$airpricerequestxml .='</AirPriceRequest>';

		}

		else{
		$airpricerequestxml='<AirPriceRequest>
					<RequestId></RequestId>
					<Mobile></Mobile>';
		if($p['plantype']=='intFlight' && $p['type']=='R')
		{
		$airpricerequestxml.='<Itinerary isReturn="true" isIntl="true" dest="'.$dest.'">';
		}
		elseif($p['plantype']=='intFlight' && $p['type']=='O')
		{
		$airpricerequestxml.='<Itinerary>';
		}
		else
		{
		$airpricerequestxml.='<Itinerary>';
		}

		if(isset($firstflight) && $firstflight<>'')
		{
		$airpricerequestxml .='<OnwardFlights>';
		$ex=(str_replace('quot','"',$firstflight));
		$FirstFlight=unserialize($ex);
		if(array_key_exists(0,$FirstFlight['Flights']['Flight']))
		{
		foreach($FirstFlight['Flights']['Flight'] as $flights){
		if(!empty($flights['Source']))
		{		
		if(empty($flights['Class']))
		{
		$flights['Class']='-';
		}
		$airpricerequestxml .='<Flight>
					<CarrierId>'.$flights['Carrier_attr']['id'].'</CarrierId>
					<FlightNumber>'.$flights['FlightNumber'].'</FlightNumber>
					<Source>'.$flights['Source'].'</Source>
					<Destination>'.$flights['Destination'].'</Destination>
					<DepartureTimeStamp>'.$flights['DepartureTimeStamp'].'</DepartureTimeStamp>
					<ArrivalTimeStamp>'.$flights['ArrivalTimeStamp'].'</ArrivalTimeStamp>
					<Class>'.$flights['Class'].'</Class>
					<FareBasis>'.$flights['FareBasis'].'</FareBasis>
					</Flight>';
		}
		}
		}
		else
		{
		if(empty($FirstFlight['Flights']['Flight']['Class']))
		{
		$FirstFlight['Flights']['Flight']['Class']='-';
		}
		$airpricerequestxml .='<Flight>
					<CarrierId>'.$FirstFlight['Flights']['Flight']['Carrier_attr']['id'].'</CarrierId>
					<FlightNumber>'.$FirstFlight['Flights']['Flight']['FlightNumber'].'</FlightNumber>
					<Source>'.$FirstFlight['Flights']['Flight']['Source'].'</Source>
					<Destination>'.$FirstFlight['Flights']['Flight']['Destination'].'</Destination>
					<DepartureTimeStamp>'.$FirstFlight['Flights']['Flight']['DepartureTimeStamp'].'</DepartureTimeStamp>
					<ArrivalTimeStamp>'.$FirstFlight['Flights']['Flight']['ArrivalTimeStamp'].'</ArrivalTimeStamp>
					<Class>'.$FirstFlight['Flights']['Flight']['Class'].'</Class>
					<FareBasis>'.$FirstFlight['Flights']['Flight']['FareBasis'].'</FareBasis>
					</Flight>';
		}
		$airpricerequestxml .='</OnwardFlights>';
		}
		if(isset($secondflight) && $secondflight<>'')
		{
		$airpricerequestxml .='<ReturnFlights>';
		$sx=(str_replace('quot','"',$secondflight));
		$SecondFlight=unserialize($sx);
		if(array_key_exists(0,$SecondFlight['Flights']['Flight']))
		{
		foreach($SecondFlight['Flights']['Flight'] as $sflights){
		$airpricerequestxml .='<Flight>
					<CarrierId>'.$sflights['Carrier_attr']['id'].'</CarrierId>
					<FlightNumber>'.$sflights['FlightNumber'].'</FlightNumber>
					<Source>'.$sflights['Source'].'</Source>
					<Destination>'.$sflights['Destination'].'</Destination>
					<DepartureTimeStamp>'.$sflights['DepartureTimeStamp'].'</DepartureTimeStamp>
					<ArrivalTimeStamp>'.$sflights['ArrivalTimeStamp'].'</ArrivalTimeStamp>
					<Class>'.$sflights['Class'].'</Class>
					<FareBasis>'.$sflights['FareBasis'].'</FareBasis>
					</Flight>';
		}				
		}
		else
		{
		$airpricerequestxml .='<Flight>
					<CarrierId>'.$SecondFlight['Flights']['Flight']['Carrier_attr']['id'].'</CarrierId>
					<FlightNumber>'.$SecondFlight['Flights']['Flight']['FlightNumber'].'</FlightNumber>
					<Source>'.$SecondFlight['Flights']['Flight']['Source'].'</Source>
					<Destination>'.$SecondFlight['Flights']['Flight']['Destination'].'</Destination>
					<DepartureTimeStamp>'.$SecondFlight['Flights']['Flight']['DepartureTimeStamp'].'</DepartureTimeStamp>
					<ArrivalTimeStamp>'.$SecondFlight['Flights']['Flight']['ArrivalTimeStamp'].'</ArrivalTimeStamp>
					<Class>'.$SecondFlight['Flights']['Flight']['Class'].'</Class>
					<FareBasis>'.$SecondFlight['Flights']['Flight']['FareBasis'].'</FareBasis>
					</Flight>';
		}
		$airpricerequestxml .='</ReturnFlights>';
		}
		$airpricerequestxml .='</Itinerary>';
		$po=str_replace('quot','"',$post);
		$postvalue=unserialize($po);
		$airpricerequestxml .='<PassengerCount>
					<Adults>'.(int)$postvalue['adults'].'</Adults>
					<Children>'.(int)$postvalue['children'].'</Children>
					<Infants>'.(int)$postvalue['infants'].'</Infants>
					</PassengerCount>';
		$airpricerequestxml .='</AirPriceRequest>';
		}

                 

		$action='AirPriceRequest';
		$authkey = '&source=REWARDS360&auth=29360RE0WARDS';
		$airpricerequest = 'http://api.viaworld.in/webserviceAPI?actionId='.$action.'&xmlRequest='.urlencode($airpricerequestxml).'&'.$authkey; 
		//print_r($airpricerequest); exit;
		$price= Hungama::doMessage($airpricerequest); 
         //echo '<pre>'; print_r($price); exit; 
		return $price;
	}



	public static function int_airprice_details($firstflight,$secondflight='',$post,$start="",$dest="") 
	{
	$p=unserialize(str_replace('quot','"',$post));

	$airpricerequestxml='<AirPriceRequest>
				<RequestId></RequestId>
				<Mobile></Mobile>';
	if($p['plantype']=='intFlight' && $p['type']=='R')
	{
	$airpricerequestxml.='<Itinerary isReturn="true" isIntl="true" dest="'.$dest.'">';
	}
	elseif($p['plantype']=='intFlight' && $p['type']=='O')
	{
	$airpricerequestxml.='<Itinerary>';
	}
	else
	{
	$airpricerequestxml.='<Itinerary>';
	}
	if(isset($firstflight) && $firstflight<>'')
	{
	$airpricerequestxml .='<OnwardFlights>';
	$ex=(str_replace('quot','"',$firstflight));
	$FirstFlight=unserialize($ex);
	if(array_key_exists(0,$FirstFlight['Flights']['Flight']))
	{
	foreach($FirstFlight['Flights']['Flight'] as $flights){
	if(!empty($flights['Source']))
	{		
	if(empty($flights['Class']))
	{
	$flights['Class']='-';
	}
	$airpricerequestxml .='<Flight>
				<CarrierId>'.$flights['Carrier_attr']['id'].'</CarrierId>
				<FlightNumber>'.$flights['FlightNumber'].'</FlightNumber>
				<Source>'.$flights['Source'].'</Source>
				<Destination>'.$flights['Destination'].'</Destination>
				<DepartureTimeStamp>'.$flights['DepartureTimeStamp'].'</DepartureTimeStamp>
				<ArrivalTimeStamp>'.$flights['ArrivalTimeStamp'].'</ArrivalTimeStamp>
				<Class>'.$flights['Class'].'</Class>
				<FareBasis>'.$flights['FareBasis'].'</FareBasis>
				</Flight>';
	}
	}
	}
	else
	{
	if(empty($FirstFlight['Flights']['Flight']['Class']))
	{
	$FirstFlight['Flights']['Flight']['Class']='-';
	}
	$airpricerequestxml .='<Flight>
				<CarrierId>'.$FirstFlight['Flights']['Flight']['Carrier_attr']['id'].'</CarrierId>
				<FlightNumber>'.$FirstFlight['Flights']['Flight']['FlightNumber'].'</FlightNumber>
				<Source>'.$FirstFlight['Flights']['Flight']['Source'].'</Source>
				<Destination>'.$FirstFlight['Flights']['Flight']['Destination'].'</Destination>
				<DepartureTimeStamp>'.$FirstFlight['Flights']['Flight']['DepartureTimeStamp'].'</DepartureTimeStamp>
				<ArrivalTimeStamp>'.$FirstFlight['Flights']['Flight']['ArrivalTimeStamp'].'</ArrivalTimeStamp>
				<Class>'.$FirstFlight['Flights']['Flight']['Class'].'</Class>
				<FareBasis>'.$FirstFlight['Flights']['Flight']['FareBasis'].'</FareBasis>
				</Flight>';
	}
	$airpricerequestxml .='</OnwardFlights>';
	}
	if(isset($secondflight) && $secondflight<>'')
	{
	$airpricerequestxml .='<ReturnFlights>';
	$sx=(str_replace('quot','"',$secondflight));
	$SecondFlight=unserialize($sx);
	if(array_key_exists(0,$SecondFlight['Flights']['Flight']))
	{
	foreach($SecondFlight['Flights']['Flight'] as $sflights){
	$airpricerequestxml .='<Flight>
				<CarrierId>'.$sflights['Carrier_attr']['id'].'</CarrierId>
				<FlightNumber>'.$sflights['FlightNumber'].'</FlightNumber>
				<Source>'.$sflights['Source'].'</Source>
				<Destination>'.$sflights['Destination'].'</Destination>
				<DepartureTimeStamp>'.$sflights['DepartureTimeStamp'].'</DepartureTimeStamp>
				<ArrivalTimeStamp>'.$sflights['ArrivalTimeStamp'].'</ArrivalTimeStamp>
				<Class>'.$sflights['Class'].'</Class>
				<FareBasis>'.$sflights['FareBasis'].'</FareBasis>
				</Flight>';
	}				
	}
	else
	{
	$airpricerequestxml .='<Flight>
				<CarrierId>'.$SecondFlight['Flights']['Flight']['Carrier_attr']['id'].'</CarrierId>
				<FlightNumber>'.$SecondFlight['Flights']['Flight']['FlightNumber'].'</FlightNumber>
				<Source>'.$SecondFlight['Flights']['Flight']['Source'].'</Source>
				<Destination>'.$SecondFlight['Flights']['Flight']['Destination'].'</Destination>
				<DepartureTimeStamp>'.$SecondFlight['Flights']['Flight']['DepartureTimeStamp'].'</DepartureTimeStamp>
				<ArrivalTimeStamp>'.$SecondFlight['Flights']['Flight']['ArrivalTimeStamp'].'</ArrivalTimeStamp>
				<Class>'.$SecondFlight['Flights']['Flight']['Class'].'</Class>
				<FareBasis>'.$SecondFlight['Flights']['Flight']['FareBasis'].'</FareBasis>
				</Flight>';
	}
	$airpricerequestxml .='</ReturnFlights>';
	}

	//print_r($airpricerequestxml); exit;
	$airpricerequestxml .='</Itinerary>';
	$po=str_replace('quot','"',$post);
	$postvalue=unserialize($po);
	$airpricerequestxml .='<PassengerCount>
				<Adults>'.(int)$postvalue['adults'].'</Adults>
				<Children>'.(int)$postvalue['children'].'</Children>
				<Infants>'.(int)$postvalue['infants'].'</Infants>
				</PassengerCount>';
	$airpricerequestxml .='</AirPriceRequest>';
	$action='AirPriceRequest';
	$authkey = '&source=REWARDS360&auth=29360RE0WARDS';
	$int_airpricerequest = 'http://api.viaworld.in/webserviceAPI?actionId='.$action.'&xmlRequest='.urlencode($airpricerequestxml).'&'.$authkey; 
	$int_price= Hungama::doMessage($int_airpricerequest);  	//print_r($int_price); exit;
	return $int_price;
	}



	public static function via_booking($api,$customer,$id) 
        {
	$persondetails=Viaflight::toArray(json_decode($customer));
	if(isset($api) && !empty($api))
	{
	$OnwardFlights=$api;
	$flight_res=$OnwardFlights['AirPriceResponse']['PricedItinerary']['OnwardFlights']['Flight'];
	$OnwardFlightsxml="<OnwardFlights>";
	if(array_key_exists(0,$flight_res))
	{
	foreach($flight_res as $FlightSegment) 
	{
	if(!empty($FlightSegment['Carrier_attr']['id']))
	{				
	$OnwardFlightsxml .="<Flight>
				<CarrierId>".$FlightSegment['Carrier_attr']['id']."</CarrierId>
				<FlightNumber>".$FlightSegment['FlightNumber']."</FlightNumber>
				<Source>".$FlightSegment['Source']."</Source>
				<Destination>".$FlightSegment['Destination']."</Destination>
				<DepartureTimeStamp>".$FlightSegment['DepartureTimeStamp']."</DepartureTimeStamp>
				<ArrivalTimeStamp>".$FlightSegment['ArrivalTimeStamp']."</ArrivalTimeStamp>
				<Class>".$FlightSegment['Class']."</Class>
				<FareBasis>".$FlightSegment['FareBasis']."</FareBasis>
				</Flight>";
	}
	}			
	}
	else
	{			
        $OnwardFlightsxml .="<Flight>
				<CarrierId>".$flight_res['Carrier_attr']['id']."</CarrierId>
				<FlightNumber>".$flight_res['FlightNumber']."</FlightNumber>
				<Source>".$flight_res['Source']."</Source>
				<Destination>".$flight_res['Destination']."</Destination>
				<DepartureTimeStamp>".$flight_res['DepartureTimeStamp']."</DepartureTimeStamp>
				<ArrivalTimeStamp>".$flight_res['ArrivalTimeStamp']."</ArrivalTimeStamp>
				<Class>".$flight_res['Class']."</Class>
				<FareBasis>".$flight_res['FareBasis']."</FareBasis>
				</Flight>";
	}			
	$OnwardFlightsxml .="</OnwardFlights>";
	}
	else
	{
	$OnwardFlightsxml='';
	}

	//return flight	
	if(isset($api) && !empty($api))
	{
	$ReturnFlights=$api;
	if(isset($OnwardFlights['AirPriceResponse']['PricedItinerary']['ReturnFlights']) && !empty($OnwardFlights['AirPriceResponse']['PricedItinerary']['ReturnFlights'])) {
	$flight_res1=$OnwardFlights['AirPriceResponse']['PricedItinerary']['ReturnFlights']['Flight'];
	$ReturnFlightsxml="<ReturnFlights>";
	if(array_key_exists(0,$flight_res1))
	{
	foreach($flight_res1 as $ReturnFlightSegment) 
	{
	$ReturnFlightsxml .="<Flight>
				<CarrierId>".$ReturnFlightSegment['Carrier_attr']['id']."</CarrierId>
				<FlightNumber>".$ReturnFlightSegment['FlightNumber']."</FlightNumber>
				<Source>".$ReturnFlightSegment['Source']."</Source>
				<Destination>".$ReturnFlightSegment['Destination']."</Destination>
				<DepartureTimeStamp>".$ReturnFlightSegment['DepartureTimeStamp']."</DepartureTimeStamp>
				<ArrivalTimeStamp>".$ReturnFlightSegment['ArrivalTimeStamp']."</ArrivalTimeStamp>
				<Class>".$ReturnFlightSegment['Class']."</Class>
				<FareBasis>".$ReturnFlightSegment['FareBasis']."</FareBasis>
				</Flight>";
	}			
	}			
	else
	{
	$ReturnFlightsxml .="<Flight>
				<CarrierId>".$flight_res1['Carrier_attr']['id']."</CarrierId>
				<FlightNumber>".$flight_res1['FlightNumber']."</FlightNumber>
				<Source>".$flight_res1['Source']."</Source>
				<Destination>".$flight_res1['Destination']."</Destination>
				<DepartureTimeStamp>".$flight_res1['DepartureTimeStamp']."</DepartureTimeStamp>
				<ArrivalTimeStamp>".$flight_res1['ArrivalTimeStamp']."</ArrivalTimeStamp>
				<Class>".$flight_res1['Class']."</Class>
				<FareBasis>".$flight_res1['FareBasis']."</FareBasis>
				</Flight>";
	}
	$ReturnFlightsxml .="</ReturnFlights>";
	}

	else
	{
	$ReturnFlightsxml="";
	}}

	$Passenger='';
	if($persondetails['post']['adults']>0){
	for($i=1;$i<=$persondetails['post']['adults'];$i++)
	{		
	$Passenger .="<Passenger><Type>A</Type>
			<Title>".$persondetails['adult'.$i.'title']."</Title>
			<FirstName>".$persondetails['adult'.$i.'fname']."</FirstName>
			<LastName>".$persondetails['adult'.$i.'lname']."</LastName>
			<ffnumber id=\"9W\">abcdef</ffnumber>";
	if(isset($persondetails['adult'.$i.'passport']))
	{
	$Passenger .="<identificationdetail type=\"1\">
			<number>".$persondetails['adult'.$i.'passport']."</number>
			</identificationdetail>";
	}
	$Passenger .="</Passenger>";
	}
	}
	if($persondetails['post']['children']>0){
	for($j=1;$j<=$persondetails['post']['children'];$j++)
	{		
	$Passenger .="<Passenger><Type>C</Type>
			<Title>".$persondetails['child'.$j.'title']."</Title>
			<FirstName>".$persondetails['child'.$j.'fname']."</FirstName>
			<LastName>".$persondetails['child'.$j.'lname']."</LastName>
			<Age>".agecalculate($persondetails['child'.$j.'dob'])."</Age>"; 
	if(isset($persondetails['child'.$i.'passport']))
	{
	$Passenger .="<identificationdetail type=\"1\">
			<number>".$persondetails['child'.$i.'passport']."</number>
			</identificationdetail>";
	}
	$Passenger .="</Passenger>";
	}
	}
	if($persondetails['post']['infants']>0){
	for($k=1;$k<=$persondetails['post']['infants'];$k++)
	{
	$Passenger .="<Passenger><Type>I</Type>
			<Title>".$persondetails['infant'.$k.'title']."</Title>
			<FirstName>".$persondetails['infant'.$k.'fname']."</FirstName>
			<LastName>".$persondetails['infant'.$k.'lname']."</LastName>
			<Age>".agecalculate($persondetails['infant'.$k.'dob'])."</Age>";
	if(isset($persondetails['infants'.$i.'passport']))
	{
	$Passenger .="<identificationdetail type=\"1\">
			<number>".$persondetails['infants'.$i.'passport']."</number>
			</identificationdetail>";
	}
	$Passenger .="</Passenger>";
	}
	}
	$action='AirBookingRequest';
	$authkey = '&source=REWARDS360&auth=29360RE0WARDS';

	$xmlRequest="<AirBookingRequest>
			<RequestID>".$id.date('YmdHis')."</RequestID>
			<Mobile>".$persondetails['contactPhone']."</Mobile>
			<Email>".$persondetails['contactEmail']."</Email>
			<BookingRequestId>".$id."</BookingRequestId>
			<Itinerary>
	".$OnwardFlightsxml."
	".$ReturnFlightsxml."
			</Itinerary>
			<Passengers>
	".$Passenger."
			</Passengers>
			<DeliveryInformation>
			<Street>".$persondetails['addrStreet']."</Street>
			<City>".$persondetails['addrCity']."</City>
			<Pincode>".$persondetails['addrPincode']."</Pincode>
			<Phone>".$persondetails['contactLandline']."</Phone>
			</DeliveryInformation>
			<PaymentInformation>
			<PaymentType>2</PaymentType>
			</PaymentInformation>
			</AirBookingRequest>";
	$booking = 'http://www.test.viaworld.in/webserviceAPI?actionId='.$action.'&xmlRequest='.urlencode($xmlRequest).'&'.$authkey;             
	$flightbook= Hungama::doMessage($booking); 
	return $flightbook;
	}



	public static function airresponse($flights) 
        { 
	$authkey = '&source=REWARDS360&auth=29360RE0WARDS';
	$pnraction='AirBookingStatusRequest';
	$pnrxml='<AirBookingStatusRequest>
	<RequestID>'.$flights['AirBookingResponse']['RequestId'].'</RequestID>
	<BookingID>'.$flights['AirBookingResponse']['BookingId'].'</BookingID>
	</AirBookingStatusRequest>';
	$booking_res = 'http://www.test.viaworld.in/webserviceAPI?actionId='.$pnraction.'&xmlRequest='.urlencode($pnrxml).'&'.$authkey;  
	$response= Hungama::doMessage($booking_res); 
	return $response;
	}
        

        public static function toArray($obj)
	{
	    if(is_object($obj)) $obj = (array) $obj;
		if(is_array($obj)) {
		$new = array();
	    foreach($obj as $key => $val) {
		$new[$key] = Viaflight::toArray($val);
	}
	}
	  else {
	        $new = $obj;
	       }
	 return $new;
	}


        public static function split_flights($array,$src,$dst,$intl="")
	{
	
	
  		unset($array['0_attr']);
		

	        $cnt=1;
	        foreach($array as $arr=>$arow)
	        {
	      
	       if(isset($arow['Carrier'])&&!empty($arow['Carrier']))
	         $onward[]=$arow;
		
		
	          //get the onward flights
	          if(isset($arow['Destination']) && $arow['Destination']==$dst)
	          {
	             break;
	          }
	         $cnt= $cnt+1;
	       }
	             
	       $output = array_slice($array,$cnt); 
	       unset($output['0_attr']);
	       $return=$output;
	      	
	      		
	          $fly['onward']= array_filter($onward);
	         $fly['return']=array_filter($return);
	          
	          // get the destination flghts
		//echo '<pre>';	 	
		//print_r($fly);  exit; 
	      return array_filter($fly);
		
	}
	//cleartrip flightsr
	public static function cleartrip_booking($api,$customer,$id) 
        {
			$clear_api=array();
			$itinerary_id=trim($api['Posted']['itinerary_id']);
			$clear_api['acc']='225464742';
			$clear_api['url']="http://api.staging.cleartrip.com/air/1.0/itinerary/book/".$itinerary_id;  //staging
			$clear_api['auth']='5caebd280ccdf3463b025eca00fa5e78';

			$my_array=Config::get('partner_settings.clear_trip_booking');
			
			

			$cur_array=array($api['Posted']['first_name'],$api['Posted']['last_name'],$api['Posted']['s_email'],$api['Posted']['mobile']);

			$verify=(count(array_diff($my_array, $cur_array)) === 0);
			
/*
			if($verify)
			{
			$clear_api['acc']='22495437';
			$clear_api['url']="http://api.cleartrip.com/air/1.0/itinerary/book/".$itinerary_id; //live
			$clear_api['auth']='8ab8e687cd57ebd32ce8537ff8b53ede';
			}
				

*/		
			$xmlRequest='<booking xmlns="http://www.cleartrip.com/air/">
			<contact-detail>
			<title>Mr</title>
			<first-name>'.$api['Posted']['first_name'].'</first-name>
			<last-name>'.$api['Posted']['last_name'].'</last-name>
			<email>'.$api['Posted']['s_email'].'</email>
			<address>Unit No 001, Ground Floor, DTC Bldg, Sitaram mills
			compound, N.M.joshi Marg, Lower parel (E)</address>
			<mobile>'.$api['Posted']['mobile'].'</mobile>
			<landline>02240554000</landline>
			<city-name>Bangalore</city-name>
			<state-name>Karnataka</state-name>
			<country-name>India</country-name>
			<pin-code>400011</pin-code>
			</contact-detail>
			<payment-detail>
			<payment-type>DA</payment-type>
			<deposit-account-id>'.$clear_api['acc'].'</deposit-account-id>
			</payment-detail>
			</booking>';


			
		
			
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL,$clear_api['url']);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY:'.$clear_api['auth'],
								   'X-CT-SOURCETYPE:API','Content-Type: application/xml'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, trim($xmlRequest));
			$data = curl_exec($ch); 
			//echo '<pre>'; print_r((htmlspecialchars($data)));exit;
			if(curl_errno($ch))
			print curl_error($ch);
			else
			curl_close($ch);
			//enable booking logs
			$save['api_details']=json_encode($clear_api);
			$save['itenary_id']=$api['Posted']['itinerary_id'];
			$save['request']=$xmlRequest;
			$save['response']=$data;
			$connection = DB::connection('mongodb');
			$ext_entry=$connection->getCollection('cleartrip_bookings')->insert($save);

			
			return $data;
       }
	
        public static function cleartrip_checkout($value)
        {

        $json['Posted']=$_POST;
        $json['Customer_Id']=1;
        $json['Created_Date']=date('Y-m-d H:i:s');
        $json['Patner_Id']=7;
        $json['API_Type']='Cleartrip_flights';
        
        $json['name'] ='Flights';
        
        $test =json_encode($json);
        $save['input']=$test;
        $save['order_id']='';
        $json['api_pid'] = Checkoutmodel::do_checkout($save);

        $ticket['quantity']=1;
        $ticket['description']='<b>Flights:</b> ';
        $ticket['json']=$json;
        $ticket['partner']='clear trip Flights';
        
        return $ticket;


        }
         public static function goibibo_checkout($value)
        {
        
        $json['Posted']=$_POST;
        $json['Customer_Id']=1;
        $json['Created_Date']=date('Y-m-d H:i:s');
        $json['Patner_Id']=5;
        $json['API_Type']='goibibo_flights';
        $json['name'] ='Flights';
        
        $test =json_encode($json);
        $save['input']=$test;
        $save['order_id']='';
        $json['api_pid'] = Checkoutmodel::do_checkout($save);
        $ticket['partner']='goibibo';
        $ticket['quantity']=1;
        $ticket['description']='<b>Flights:</b> ';
        $ticket['json']=$json;

        return $ticket;


        }
        
        public static function goibibo_booking($api,$customer,$id)
        { 
         
          
          //$booking_data=urldecode($api['Posted']['booking_data']);
          
          $booking_data_decode=json_decode(urldecode($api['Posted']['booking_data']));
          //echo "<pre>";print_r($booking_data_decode);exit;
          //$booking_data_decode.=array("carriers"=>"ALL");
          
         
          //echo "<pre>";print_r(urldecode($api['Posted']['booking_data']));exit;
          
         // echo "<pre>";print_r(json_encode($booking_data_decode->data->onwardflights));exit;
          $booking_data0= (array) $booking_data_decode->data->onwardflights['0'];
          $booking_data1= array("carriers"=>"ALL");
          $onward=json_encode(array_merge_recursive($booking_data0,$booking_data1));
          
          //connection flights    
          if(isset($booking_data_decode->data->onwardflights['0']->onwardflights) && $booking_data_decode->data->onwardflights['0']->onwardflights)    
          {
              //echo "<pre>";print_r($booking_data_decode->data->onwardflights['0']->onwardflights);exit;
             $count=count($booking_data_decode->data->onwardflights['0']->onwardflights);
             $con_onward = '';
             
             for($i=0;$i<$count;$i++)
             {
                 $booking_data4= array("carriers"=>"ALL"); 
                 //echo "<pre>";print_r(json_encode((array)$booking_data_decode->data->onwardflights['0']->onwardflights[$i]));
                $con_onward_temp=$booking_data_decode->data->onwardflights['0']->onwardflights[$i];
                //echo "<pre>";print_r($con_onward_temp);
                $con_onward .= json_encode(array_merge_recursive((array)$con_onward_temp,$booking_data4)); 
                //echo "<pre>";print_r($con_onward);exit;
             }
             //exit;
             //echo "<pre>";print_r($con_onward);exit;
             $conection_onward=rtrim($con_onward, ',');
             //echo "<pre>";print_r($conection_onward);exit;
              
              
          }
          
          //connection return flights    
          if(isset($booking_data_decode->data->returnflights['0']->onwardflights) && $booking_data_decode->data->returnflights['0']->onwardflights)    
          {
              //echo "<pre>";print_r($booking_data_decode->data->returnflights['0']->returnflights);exit;
             $count=count($booking_data_decode->data->returnflights['0']->onwardflights);
             $con_return = '';
             
             for($i=0;$i<$count;$i++)
             {
                 $booking_data4= array("carriers"=>"ALL"); 
                 //echo "<pre>";print_r(json_encode((array)$booking_data_decode->data->returnflights['0']->returnflights[$i]));
                $con_return_temp=$booking_data_decode->data->returnflights['0']->onwardflights[$i];
                //echo "<pre>";print_r($con_return_temp);
                $con_return .= json_encode(array_merge_recursive((array)$con_return_temp,$booking_data4)); 
                //echo "<pre>";print_r($con_return);exit;
             }
             //exit;
             //echo "<pre>";print_r($con_return);exit;
             $conection_return=rtrim($con_return, ',');
             //echo "<pre>";print_r($conection_return);exit;
              
              
          }
          
          if(isset($booking_data_decode->data->returnflights['0']) && $booking_data_decode->data->returnflights['0']<>'')
          {
          $booking_data2= (array) $booking_data_decode->data->returnflights['0'];
          
          $booking_data3= array("carriers"=>"ALL"); 
          
          //$onward=json_encode(array_merge_recursive($booking_data0,$booking_data1));
          $return=json_encode(array_merge_recursive($booking_data2,$booking_data3));
          
          
          if(isset($booking_data_decode->data->onwardflights['0']->onwardflights) && !empty($booking_data_decode->data->onwardflights['0']->onwardflights) && isset($booking_data_decode->data->returnflights['0']->onwardflights) && !empty($booking_data_decode->data->returnflights['0']->onwardflights))
          {
           
          $booking_data="[".$onward.",".$conection_onward.",".$return.",".$conection_return."]";
          //echo "<pre>";print_r($booking_data);exit;
          }
          else if(isset($booking_data_decode->data->onwardflights['0']->onwardflights) && !empty($booking_data_decode->data->onwardflights['0']->onwardflights))
          {
          $booking_data="[".$onward.",".$conection_onward.",".$return."]";    
          }
          else if(isset($booking_data_decode->data->returnflights['0']->onwardflights) && !empty($booking_data_decode->data->returnflights['0']->onwardflights))
          {
         $booking_data="[".$onward.",".$return.",".$conection_return."]";  
          }    
          else
          {
            $booking_data="[".$onward.','.$return."]";
          }
          
          
          
          
          
          
          //$booking_data="[".$onward.','.$return."]";
          //echo "<pre>";print_r($booking_data);exit;
          $searchKey_return=$booking_data_decode->data->returnflights['0']->searchKey; 
          }
          else
          {
          //echo "<pre>";print_r($booking_data_decode->data->onwardflights['0']->onwardflights);exit;    
          
          if(isset($booking_data_decode->data->onwardflights['0']->onwardflights) && !empty($booking_data_decode->data->onwardflights['0']->onwardflights))
          {
              //echo "hai";exit;
           
           $booking_data="[".$onward.",".$conection_onward."]"; 
          //$booking_data="[".$onward.",".$conection_onward."]";
          //echo "<pre>";print_r($booking_data);exit;
          }
          else
          {
              //echo "hello";exit;
              $booking_data="[".$onward."]"; 
            //$booking_data="[".$onward.",".$conection_onward."]";  
          }
          }
          $query_data=urldecode($api['Posted']['querydata']);
          //echo "<pre>";print_r($query_data);exit;
          //echo "<pre>";print_r($booking_data);exit;
          //total fare
          if(isset($booking_data_decode->data->returnflights['0']) && $booking_data_decode->data->returnflights['0']<>'')
          {
          $fare=$booking_data_decode->data->onwardflights['0']->fare->totalfare+$booking_data_decode->data->returnflights['0']->fare->totalfare;
          }
          else
          {
           $fare=$booking_data_decode->data->onwardflights['0']->fare->totalfare;    
          }
          //echo "<pre>";print_r($fare);exit;
          //search key
          $searchKey_onward=$booking_data_decode->data->onwardflights['0']->searchKey; 
          //echo "<pre>";print_r($searchKey_return);exit;
          $book_passenger=json_decode(urldecode($api['Posted']['book_passenger']));
          
          
          $count_passengers=$book_passenger->adults+$book_passenger->children+$book_passenger->infants;
          
          $i=3;
        
          $passenger_info="[";   
           
           for($j=0;$j<$book_passenger->adults;$j++)
           {
            
          $passenger_info.='{ 
        "FirstName": "'.$api['Posted']['firstname'.$i].'",
        "eticketnumber": "",
        "LastName": "'.$api['Posted']['lastname'.$i].'",
        "Title": "1",
        "DateOfBirth": "'.$api['Posted']['datepicker'.$i].'",
        "Type": "A"
        }';
          $i++;
          
          if($j>=0 && $j<$book_passenger->adults-1)
          {
              $passenger_info.= ',';
          }
           }
          
          
           for($k=0;$k<$book_passenger->children;$k++)
           { 
          $passenger_info.=',{ 
        "FirstName": "'.$api['Posted']['firstname'.$i].'",
        "eticketnumber": "",
        "LastName": "'.$api['Posted']['lastname'.$i].'",
        "Title": "1",
        "DateOfBirth": "'.$api['Posted']['datepicker'.$i].'",
        "Type": "C"
        }';
          $i++;
           }
             
           for($l=0;$l<$book_passenger->infants;$l++)
           {
          $passenger_info.=',{ 
        "FirstName": "'.$api['Posted']['firstname'.$i].'",
        "eticketnumber": "",
        "LastName": "'.$api['Posted']['lastname'.$i].'",
        "Title": "1",
        "DateOfBirth": "'.$api['Posted']['datepicker'.$i].'",
        "Type": "I"
        }';
           }
          
         $passenger_info.="]";  
         
        
         
        $Contact_Info = '{
        "pincode": "110110",
        "state": "delhi",
        "firstname": "'.$api['Posted']['first_name'].'",
        "lastname": "'.$api['Posted']['last_name'].'",
        "email": "'.$api['Posted']['s_email'].'",
        "landline": "08049058444",
        "mobile": "'.$api['Posted']['mobile'].'",
        "payment": "HDFC",
        "address": "new_address123",
        "city": "New Delhi"
        }'; 
	//this is for production for specific persons
	
	if($api['Posted']['first_name']=='Test'&&
           $api['Posted']['last_name']=='Test'   &&
	   $api['Posted']['s_email']=='test@test.com' &&
	   $api['Posted']['mobile']=='9739660088'
	)
	{
	
		 $url = Config::get('flights_settings.url.goibibo_booking');
		
		$details=Config::get('flights_settings.url.username_password');
	}
	else
	{
	
         $url = 'http://pp.goibibobusiness.com/api/book/';
	
	 $details='hdfcsmartbuy@reward360.co:reward-123';
	
	}


       //echo "<pre>";print_r($passenger_info);exit;
        $ch=curl_init($url);
        //$data_string = urlencode(json_encode($data));
        curl_setopt($ch, CURLOPT_USERPWD, $details);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        //echo "<pre>";print_r($passenger_info);
        //echo "<pre>";print_r($Contact_Info);
        if(isset($booking_data_decode->data->returnflights['0']) && $booking_data_decode->data->returnflights['0']<>'')
          {
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("bookingdata"=>$booking_data,"querydata"=>$query_data,"fare"=>$fare,"searchKey_onward"=>$searchKey_onward,"searchKey_return"=>$searchKey_return,'paxinfo'=>$passenger_info,'contactinfo'=>$Contact_Info ));
          }
          else
          {
              Log::info(json_encode(array("bookingdata"=>$booking_data,"querydata"=>$query_data,"fare"=>$fare,"searchKey_onward"=>$searchKey_onward,'paxinfo'=>$passenger_info,'contactinfo'=>$Contact_Info )));
              
          curl_setopt($ch, CURLOPT_POSTFIELDS, array("bookingdata"=>$booking_data,"querydata"=>$query_data,"fare"=>$fare,"searchKey_onward"=>$searchKey_onward,'paxinfo'=>$passenger_info,'contactinfo'=>$Contact_Info ));    
          }

    $result = curl_exec($ch);
    
    $decode=json_decode($result);
    
         //enable booking logs
    $save['url']=$url;
    $save['bookingdata']=$booking_data;
    $save['querydata']=$query_data;
    $save['fare']=$fare;
    $save['searchKey_onward']=$searchKey_onward;
    if(isset($searchKey_return) && $searchKey_return<>'')
    {
     $save['searchKey_return']=$searchKey_return;   
    }
    $save['paxinfo']=$passenger_info;
    $save['contactinfo']=$Contact_Info;
    
   
    $save['response']=$result;
    $connection = DB::connection('mongodb');
    $ext_entry=$connection->getCollection('goibibo_bookings')->insert($save);
    
    if(isset($decode->Error))
    {
     return $result;   
    }
    else
    {
    //echo "<pre>";print_r($result);
    //exit;
    $json_decode=json_decode($result);
    
    if(isset($json_decode->data->Error))
    {
       return  $json_decode->data->Error;
    }
    //print_r($json_decode);exit;
//    echo "<pre>";print_r($booking_data);
//    echo "<pre>";print_r($query_data);
//    echo "<pre>";print_r($fare);
//    echo "<pre>";print_r($searchKey_onward);
////    echo "<pre>";print_r($searchKey_return);
//    echo "<pre>";print_r($passenger_info);
//    echo "<pre>";print_r($Contact_Info);
//    echo "<pre>";print_r($json_decode);
//    echo "<pre>";print_r($json_decode);exit;
$test=trim("reward-123".$json_decode->data->customReference."|".$json_decode->data->amount."|".strtolower($json_decode->data->productinfo)."|".strtolower($api['Posted']['first_name'])."|".strtolower($api['Posted']['s_email'])."|temp|true|travelibibo");
    //$test=trim("HDFC@reward360".$json_decode->data->customReference."|".$json_decode->data->amount."|".strtolower($json_decode->data->productinfo)."|".strtolower($api['Posted']['first_name'])."|".strtolower($api['Posted']['s_email'])."|temp|true|travelibibo");
//    echo "<pre>";print_r($test);
    //exit;
    $sha=hash( 'sha512', trim($test) );

    //this is for production for specific persons
		if($api['Posted']['first_name']=='Test'&&
		   $api['Posted']['last_name']=='Test'   &&
		   $api['Posted']['s_email']=='test@test.com' && 
	 	   $api['Posted']['mobile']=='9739660088'
		)
	{
	
		 $url1 = Config::get('flights_settings.url.goibibo_confirm_booking');
		
	}
	else
	{
         $url1 = Config::get('flights_settings.url.goibibo_confirm_booking');
	}

    //$url1 = 'http://pp.goibibobusiness.com/api/confirm/';
    $ch=curl_init($url1);
    curl_setopt($ch, CURLOPT_USERPWD,$details);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     //echo "<pre>";print_r($sha);exit;
    curl_setopt($ch, CURLOPT_POSTFIELDS, array("BookingId"=>$json_decode->data->customReference,"secret"=>trim($sha) ));
    $result1 = curl_exec($ch);
    
   
    
        //enable booking logs
     $save1['url']=$url1;
    $save1['BookingId']=$json_decode->data->customReference;
    $save1['secret']=trim($sha);
    $save1['response']=$result1;
    $connection = DB::connection('mongodb');
    $ext_entry1=$connection->getCollection('goibibo_confirm_bookings')->insert($save1);

    return $result1;
    }

    
        
    
        }
        
        public static function reprice($book_passsenger,$reprice_request)
        {
        //echo "<pre>";print_r($reprice_request);exit;
           
        //$url = 'http://pp.goibibobusiness.com/api/reprice/';
	$url=Config::get('flights_settings.url.reprice');

        //$url='www.goibibobusiness.com/api/reprice/';
        //echo "<pre>";print_r($reprice_request);exit;
            //connection flights
        if(isset($reprice_request->onwardflights) && $reprice_request->onwardflights<>'')
        {
            //echo "<pre>";print_r(urldecode($_POST['fuldata']));exit;
            $booking_data_temp= urldecode($_POST['fuldata']);
            
            
            $count=count($reprice_request->onwardflights);
            
            for($i=0;$i<$count;$i++)
            { 
               
               $booking_data_temp.= ",". json_encode($reprice_request->onwardflights[$i]) ;
            }
            //echo "<pre>";print_r($booking_data_temp);exit;
            
              
            //international flights
            //echo "<pre>";print_r($reprice_request->returnfl);exit;
        if(isset($reprice_request->returnfl) && !empty($reprice_request->returnfl))
        {
           //echo "<pre>";print_r(urldecode($_POST['fuldata']));exit;
            $booking_data_temp11= '';
            $booking_data_temp1= '';
            
           $count=count($reprice_request->returnfl);
           
            for($i=0;$i<$count;$i++)
            { 
               
               $booking_data_temp .=  ",". json_encode($reprice_request->returnfl[$i]) ;
               
            }
            //echo "<pre>";print_r($booking_data_temp11);exit;
            //echo "<pre>";print_r($reprice_request->returnfl['0']->onwardflights);exit;
            if(isset($reprice_request->returnfl['0']->onwardflights) && !empty($reprice_request->returnfl['0']->onwardflights))
            {
            $count1=count($reprice_request->returnfl['0']->onwardflights);
            
            for($i=0;$i<$count1;$i++)
            { 
               
               $booking_data_temp1.=  ",". json_encode($reprice_request->returnfl['0']->onwardflights[$i]) ;
            }
            
               
               $booking_data_temp.=$booking_data_temp1;
               
               
            } 

        
          
            }
             //echo "<pre>";print_r($booking_data_temp);exit;
            
               
              
               $booking_data_onward=$booking_data_temp;

        }
        else
        {
            $booking_data_onward= "[". urldecode($_POST['fuldata']. "]");
            
            
        }
        
        //echo "<pre>";print_r($booking_data_onward);exit;
        
           
        //echo "<pre>";print_r($booking_data_returnfl);exit;
        //round trip return
        if(isset($_POST['returndata']) && $_POST['returndata']<>'')
        {
        $reprice_return_request=json_decode(urldecode($_POST['returndata']));
        
        if(isset($reprice_return_request->onwardflights) && $reprice_return_request->onwardflights<>'')
        {
            //echo "<pre>";print_r(urldecode($_POST['returndata']));exit;
            $booking_data_temp=  urldecode($_POST['returndata']);
            
            
            $count=count($reprice_return_request->onwardflights);
            
            for($i=0;$i<$count;$i++)
            { 
               
               $booking_data_temp.= ",". json_encode($reprice_return_request->onwardflights[$i]) ;
            }
               
              
               $booking_data_return=$booking_data_temp;
               
               //search key
               $searchKey_return=$reprice_return_request->searchKey;

        }
        else
        {
            $booking_data_return= urldecode($_POST['returndata']);
        }
        
        //forming a json structure
        $booking_data="[".$booking_data_onward.",".$booking_data_return."]";
        }
        else if(isset($reprice_request->returnfl) && !empty($reprice_request->returnfl))
        {
        //search key
               $searchKey_return=$reprice_request->returnfl['0']->searchKey;
           $booking_data="[".$booking_data_onward."]"; 
          
        }
        else
        {
            
        //forming a json structure
        $booking_data="[".$booking_data_onward."]";
        }
        
        
            
        
       //echo "<pre>";print_r($booking_data);exit;
        //echo "<pre>";print_r($searchKey_return);exit;
       
        
         // $booking_data="[".urldecode($booking_construct)."]";           
          //echo "<pre>";print_r($book_passsenger);exit;         
                    // details entered in the search form
        if(isset($_POST['returndata']) && $_POST['returndata']<>''|| isset($reprice_request->returnfl) )
        {
            
         $querydata_temp=array
                                (
                        "origin"=> $book_passsenger['leavingfrom'],
                        "destination"=> $book_passsenger['goingto'],
                        "arrdate"=>date('Y-m-d',strtotime($book_passsenger['return'])),
                        "depdate"=> date('Y-m-d',strtotime($book_passsenger['departure'])),
                        "adults"=> $book_passsenger['adults'],
                        "infants"=> $book_passsenger['infants'],
                        "children"=> $book_passsenger['children']
                                );   
        }
        else
        {
                    $querydata_temp=array
                                (
                        "origin"=> $book_passsenger['leavingfrom'],
                        "destination"=> $book_passsenger['goingto'],
                        "depdate"=> date('Y-m-d',strtotime($book_passsenger['departure'])),
                        "adults"=> $book_passsenger['adults'],
                        "infants"=> $book_passsenger['infants'],
                        "children"=> $book_passsenger['children']
                                );
        }          
                    
                    $querydata= json_encode($querydata_temp);
                    
                     //echo "<pre>";print_r($querydata);exit;   
                    //total fare
                    if(isset($_POST['returndata']) && $_POST['returndata']<>'')
                    {
                    $fare=$reprice_request->fare->totalfare+$reprice_return_request->fare->totalfare;
                    }
                    else
                    {
                    //    echo "<pre>";print_r($reprice_request);exit;
                    $fare=$reprice_request->fare->totalfare;
                    }
                    //echo "<pre>";print_r($fare);exit;
                    //search key
                     
                    $searchKey_onward=$reprice_request->searchKey;       
                    //echo "<pre>";print_r($searchKey_return);exit;
                    $ch=curl_init($url);
                    //$data_string = urlencode(json_encode($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    //curl_setopt($ch, CURLOPT_USERPWD, "hdfcsmartbuy@reward360.co:reward-123");
	            curl_setopt($ch, CURLOPT_USERPWD, Config::get('flights_settings.url.username_password'));	
                    //curl_setopt($ch, CURLOPT_USERPWD, "sharath@reward360.co:sharath123");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    if(isset($_POST['returndata']) && $_POST['returndata']<>'' || isset($searchKey_return) && $searchKey_return<>'' )
                    {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array("bookingdata"=>$booking_data,"querydata"=>$querydata,"fare"=>$fare,"searchKey_onward"=>$searchKey_onward,"searchKey_return"=>$searchKey_return));
                    }
                    else
                    {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array("bookingdata"=>$booking_data,"querydata"=>$querydata,"fare"=>$fare,"searchKey_onward"=>$searchKey_onward));
                    }
		
                    $request_data=json_encode(array("bookingdata"=>$booking_data,"querydata"=>$querydata,"fare"=>$fare,"searchKey_onward"=>$searchKey_onward));
                    $result = curl_exec($ch);
		    Log::info('smartbuy|Goibibo_reprice_request|'.$_SERVER['REMOTE_ADDR'].'|'.$url.'|'.$request_data);
		    Log::info('smartbuy|Goibibo_reprice_response|'.$_SERVER['REMOTE_ADDR'].'|'.$result);
                  
                    //this is for sending to view
                    $data['booking_data']=$_POST['fuldata'] ;    
                    $data['querydata']=$querydata;
                    
                     //total fare
                    $data['fare']=$reprice_request->fare->totalfare;
                    
                    //search key
                    $data['searchKey_onward']=$reprice_request->searchKey;
                    
                    
                    //echo "<pre>";print_r($result);exit;    
                  
        return $json_data=$result;
        
        return '{
    "data": {
        "returnflights": [
            {
                "origin": "BOM", 
                "fare": {
                    "adultpromotionamount": 0.0, 
                    "totalbasefare": 7280.0, 
                    "goairgrossamount": 11822.0, 
                    "adultbasefare": 7280.0, 
                    "totalpromotionamount": 0.0, 
                    "transactionfee": 0, 
                    "totalfare": 11822.0, 
                    "adultudf": 774.0, 
                    "adultfuelsurcharge": 2950.0, 
                    "discount": 0, 
                    "totalsurcharge": 2950.0, 
                    "adultpassengerhandlingfee": 50.0, 
                    "adultairportdevelopmentfee": 113.0, 
                    "adultgoairservicetax": 148.0, 
                    "adultpassengerservicefee": 147.0, 
                    "adulttotalfare": 11822.0, 
                    "totalcommission": 0.0
                }, 
                "ibibopartner": "goair", 
                "farebasis": "WGOSAVE", 
                "sellcarrierid": "G8", 
                "LFID": "30956", 
                "deptime": "06:00", 
                "operatingflight": "333", 
                "flightcode": "329", 
                "FareTypeName": "GoSmart", 
                "duration": "2h 5m", 
                "International": "false", 
                "guid": "4cdb1fd9-1533-4688-8573-4f0e3cfef03f", 
                "qtype": "fbs", 
                "tickettype": "e", 
                "flightno": "329", 
                "FCCode": "W ", 
                "FareTypeID": "1", 
                "destination": "DEL", 
                "stops": "0", 
                "seatsavailable": "9", 
                "carrierid": "G8", 
                "flighttime": "125", 
                "searchKey": "0:0:774.0:2950.0:50.0:7280.0:147.0:11822.0:0:0:0:0:0:0:0:0:11822.0:7280.0:11822.0:0:2950.0:0:0:0.0:0:", 
                "PFID": "16654", 
                "promotionText": "", 
                "warnings": "Refundable", 
                "company": "", 
                "onwardflights": [
                    {
                        "origin": "AMD", 
                        "flightcode": "368", 
                        "deptime": "09:25", 
                        "duration": "1h 10m", 
                        "International": "false", 
                        "tickettype": "e", 
                        "flightno": "368", 
                        "destination": "3", 
                        "carrierid": "G8", 
                        "flighttime": "70", 
                        "fare": {
                            "adultpromotionamount": 0.0, 
                            "totalbasefare": 0.0, 
                            "goairgrossamount": 0.0, 
                            "adultbasefare": 0.0, 
                            "totalfare": 0.0, 
                            "adultuserdevelopmentfee": 0.0, 
                            "adultfuelsurcharge": 0.0, 
                            "totalpromotionamount": 0.0, 
                            "totalsurcharge": 0.0, 
                            "adultpassengerhandlingfee": 0.0, 
                            "adultairportdevelopmentfee": 0.0, 
                            "adultgoairservicetax": 0.0, 
                            "adultpassengerservicefee": 0.0, 
                            "adulttotalfare": 0.0, 
                            "totalcommission": 0.0
                        }, 
                        "PFID": "17135", 
                        "promotionText": "", 
                        "warnings": "Refundable", 
                        "seatingclass": "E", 
                        "operatingcarrier": "G8", 
                        "splitduration": "1h 10m", 
                        "farerule": "", 
                        "airline": "goair", 
                        "depdate": "2014-09-23t0925", 
                        "arrtime": "10:35", 
                        "arrdate": "2014-09-23t1035"
                    }
                ], 
                "seatingclass": "E", 
                "operatingcarrier": "G8", 
                "aircraftTypecode": "320", 
                "FareID": "237", 
                "farerule": "", 
                "splitduration": "2h 5m", 
                "airline": "goair", 
                "rowbody": " ", 
                "depdate": "2014-09-24t0600", 
                "arrtime": "08:05", 
                "arrdate": "2014-09-24t0805"
            }
        ], 
        "onwardflights": [
            {
                "origin": "DEL", 
                "fare": {
                    "adultpromotionamount": 0.0, 
                    "totalbasefare": 7280.0, 
                    "goairgrossamount": 11598.0, 
                    "adultbasefare": 7280.0, 
                    "totalpromotionamount": 0.0, 
                    "transactionfee": 0, 
                    "totalfare": 11598.0, 
                    "adultudf": 551.0, 
                    "adultfuelsurcharge": 2950.0, 
                    "discount": 0, 
                    "totalsurcharge": 2950.0, 
                    "adultpassengerhandlingfee": 50.0, 
                    "adultairportdevelopmentfee": 113.0, 
                    "adultgoairservicetax": 148.0, 
                    "adultpassengerservicefee": 146.0, 
                    "adulttotalfare": 11598.0, 
                    "totalcommission": 0.0
                }, 
                "ibibopartner": "goair", 
                "farebasis": "WGOSAVE", 
                "sellcarrierid": "G8", 
                "LFID": "32221", 
                "deptime": "06:05", 
                "operatingflight": "163/368", 
                "flightcode": "163", 
                "FareTypeName": "GoSmart", 
                "duration": "4h 30m", 
                "International": "false", 
                "guid": "4cdb1fd9-1533-4688-8573-4f0e3cfef03f", 
                "qtype": "fbs", 
                "tickettype": "e", 
                "flightno": "163", 
                "FCCode": "W ", 
                "FareTypeID": "1", 
                "destination": "AMD", 
                "stops": "1", 
                "seatsavailable": "9", 
                "carrierid": "G8", 
                "flighttime": "90", 
                "searchKey": "0:0:551.0:2950.0:50.0:7280.0:146.0:11598.0:0:0:0:0:0:0:0:0:11598.0:7280.0:11598.0:0:2950.0:0:0:0.0:0:", 
                "PFID": "17105", 
                "promotionText": "", 
                "warnings": "Refundable", 
                "company": "", 
                "onwardflights": [
                    {
                        "origin": "AMD", 
                        "flightcode": "368", 
                        "deptime": "09:25", 
                        "duration": "1h 10m", 
                        "International": "false", 
                        "tickettype": "e", 
                        "flightno": "368", 
                        "destination": "BOM", 
                        "carrierid": "G8", 
                        "flighttime": "70", 
                        "fare": {
                            "adultpromotionamount": 0.0, 
                            "totalbasefare": 0.0, 
                            "goairgrossamount": 0.0, 
                            "adultbasefare": 0.0, 
                            "totalfare": 0.0, 
                            "adultuserdevelopmentfee": 0.0, 
                            "adultfuelsurcharge": 0.0, 
                            "totalpromotionamount": 0.0, 
                            "totalsurcharge": 0.0, 
                            "adultpassengerhandlingfee": 0.0, 
                            "adultairportdevelopmentfee": 0.0, 
                            "adultgoairservicetax": 0.0, 
                            "adultpassengerservicefee": 0.0, 
                            "adulttotalfare": 0.0, 
                            "totalcommission": 0.0
                        }, 
                        "PFID": "17135", 
                        "promotionText": "", 
                        "warnings": "Refundable", 
                        "seatingclass": "E", 
                        "operatingcarrier": "G8", 
                        "splitduration": "1h 10m", 
                        "farerule": "", 
                        "airline": "goair", 
                        "depdate": "2014-09-23t0925", 
                        "arrtime": "10:35", 
                        "arrdate": "2014-09-23t1035"
                    }
                ], 
                "seatingclass": "E", 
                "operatingcarrier": "G8", 
                "aircraftTypecode": "320", 
                "FareID": "12", 
                "farerule": "", 
                "splitduration": "1h 30m", 
                "airline": "goair", 
                "rowbody": " ", 
                "depdate": "2014-09-23t0605", 
                "arrtime": "07:35", 
                "arrdate": "2014-09-23t0735"
            }
        ], 
        "faredict": {
            "kbb": "YtZy8cQ=", 
            "totalsurcharge": 5900, 
            "passengercount": "1", 
            "netpayable": 23420, 
            "tokenec": "c5995fadeaeb09d872429e7f61757bb5", 
            "lead_message": "", 
            "promocode": "", 
            "totalbasefare": 14560, 
            "kb": "temp", 
            "totalfare": 23420, 
            "goibibofee": 0, 
            "credits": "False", 
            "transactionfee": 0, 
            "leaddiscount": 0, 
            "premiermiles": 0, 
            "fuelsurcharge": 0, 
            "leadcode": "", 
            "cafecommission": 0, 
            "discount": 0, 
            "dob": false, 
            "k": "temp", 
            "promo_message": "", 
            "promodiscount": 0, 
            "leadlist": []
        }, 
        "active_offers": [
            {
                "key": "GO5000", 
                "value": "Free shopping worth Rs.5000", 
                "chunk_key": "go5000_promo_popup"
            }
        ], 
        "offer_key": ""
    }, 
    "data_length": 5
}';
        }
        //goibibo 
        public static function check_pnr_status($xml_array,$oid,$booking_id)
        {
           //checking count
            $count=count($xml_array->data['0']->flightdetails);
            
            
            for($i=0;$i<$count;$i++)
            {
                $flag=0;
                if(isset($xml_array->data['0']->flightdetails[$i]->airlinepnr) && $xml_array->data['0']->flightdetails[$i]->airlinepnr<>'')
                {
                    $flag=1;
                }
                
            }
            $details=array('flag'=>$flag,'order_id'=>$oid);
            
            
                $save['flag'] = $flag;
                $save['booking_id'] = $booking_id;
		$save['order_id'] = $oid;
		
		
                
		DB::table('flights_pnr_status')->insert($save);
                
            
        }
        public static function fare_rules($itineraryid)
        {
            
        $authkey='5caebd280ccdf3463b025eca00fa5e78';
        $url="http://api.staging.cleartrip.com/air/1.0/itinerary/rules/".$itineraryid;
        //$url = 'http://api.staging.cleartrip.com/air/1.0/itinerary/create?xmlRequest='.$xmlRequest;

        $post = curl_init();



        //curl_setopt($post, CURLOPT_HTTPHEADER, array('X-CT-API-KEY:5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
	curl_setopt($post, CURLOPT_HTTPHEADER, array('X-CT-API-KEY:5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
        curl_setopt($post, CURLOPT_URL, $url);
        //curl_setopt($post, CURLOPT_CUSTOMREQUEST, "Delete");
        //curl_setopt($post, CURLOPT_POST, count($data));

        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($post);

        curl_close($post);
            
//            $test=Xml2array::xml2array_test(trim('<fare-rules xmlns="http://www.cleartrip.com/air/">
//<sections>
//<section>
//<title> Penalities and Cancellation</title>
//<text> &lt;b> Fare Rules from BLR  to MAA &lt;/b> &lt;br>&lt;br>&lt;ul>	&lt;li>Agent classifies this as a &lt;strong>Refundable&lt;/strong> fare&lt;/li>	&lt;li>&lt;strong>Cancellation Charges&lt;/strong>	&lt;ul>		&lt;li>Adult: only Rs. 125.0 will be deducted&lt;/li>		&lt;li>Child: only Rs. 33.0 will be deducted&lt;/li>		&lt;li>Infant: only Rs. 0.0 will be deducted&lt;/li>	&lt;/ul>&lt;/li>	&lt;li>&lt;strong>Amendment in Higher Class Charges&lt;/strong>&lt;/li>	&lt;li>&lt;strong>Amendment in Same Class Charges&lt;/strong>&lt;/li>&lt;/ul>&lt;ul>	&lt;li>Over and above the airline cancellation charges, We will levy Rs. 250 per passenger per flight and a service tax of 12.36% on it if you cancel it online from your Agent account.&lt;/li>&lt;/ul>&lt;ul>	&lt;li>Over and above the airline amendment charges, We will levy Rs. 300 per passenger per flight if you amend it online from your Agent account.&lt;/li>&lt;/ul> </text>
//</section>
//</sections>
//</fare-rules>'));
                //echo "<pre>";print_r(htmlspecialchars($result));exit;
		//echo "<pre>";print_r(htmlspecialchars($result));
               
                $test=Xml2array::xml2array_test(trim($result));
                
                if(!empty($test) && isset($test['fare-rules']['sections']['section']['text']) && $test['fare-rules']['sections']['section']['text']<>'')
                {
                return $test['fare-rules']['sections']['section']['text'];
                }
                else
                {
                    return 'fare rules not updated';
                }
    
         
        
        }
        
        public static function fare_rules_goibibo($booking_id)
        {
            
            $authkey='5caebd280ccdf3463b025eca00fa5e78';
            $url="http://pp.goibibobusiness.com/api/getfarerules/";
            //$url = 'http://api.staging.cleartrip.com/air/1.0/itinerary/create?xmlRequest='.$xmlRequest;

            $ch=curl_init($url);
            //$data_string = urlencode(json_encode($data));
            curl_setopt($ch, CURLOPT_USERPWD, "hdfcsmartbuy@reward360.co:reward-123");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array("bookingId"=>$booking_id ));


            $result = curl_exec($ch);
            
            return $result;
        
        
        }
        //developing xml structure
        public static function createitinerary($clear_select,$return_select,$book_passsenger)
        {
            $xmlRequest='<itinerary xmlns="http://www.cleartrip.com/air/">';
//                        for($i=0;$i<$count1;$i++)
//                                {
                                   //$onwardfl_temp[$i]['sour'] ;
                                    $xmlRequest.= "<cabin-type>".$clear_select['0']->booking[0]->cabin."</cabin-type>";

//                                }
                        $xmlRequest.="<flights><flight-spec><fare-key>".$clear_select['0']->price[0]->farekey."  </fare-key>  "; 
                        
                        
                        $xmlRequest.="<segments>";
                        
                        //echo "<pre>";print_r($clear_select);exit;
                        $count2=count($clear_select['0']->onwardfl);
                        //echo $count1;exit;
                        for($i=0;$i<$count2;$i++)
                        {
                        $xmlRequest.="<segment-spec>";
                        $xmlRequest.="
                                         <departure-airport>".$clear_select['0']->onwardfl[$i]->sour."</departure-airport>
                                         <arrival-airport>".$clear_select['0']->onwardfl[$i]->desti."</arrival-airport>
                                         <flight-number>".$clear_select['0']->onwardfl[$i]->fnum."</flight-number>
                                         <airline>".$clear_select['0']->onwardfl[$i]->car_id."</airline>
                                         <operating-airline>".$clear_select['0']->onwardfl[$i]->car_id."</operating-airline>
                                         <departure-date>".date('Y-m-d',strtotime($clear_select['0']->onwardfl[$i]->arr_tym))."</departure-date>    
                                     ";
                         $xmlRequest.="</segment-spec>";
                         
                        }
                        
                        $xmlRequest.="</segments>";
                        $xmlRequest.="</flight-spec>";
                        
                        
                        //this is for the international flights
                        if(isset($clear_select['0']->returnfl) && $clear_select['0']->returnfl<>'')
                        {

                        $count_int=count($clear_select['0']->returnfl);
                        }
                         //this is for international
                        if(isset($count_int) && $count_int>0)
                        {
                        
                        
                        $xmlRequest.="<flight-spec><fare-key>".$clear_select['0']->price[0]->farekey."  </fare-key>  "; 
                        $xmlRequest.="<segments>";
                        for($j=0;$j<$count_int;$j++)
                        {
                        
                        $xmlRequest.="<segment-spec>";
                        $xmlRequest.="
                                         <departure-airport>".$clear_select['0']->returnfl[$j]->sour."</departure-airport>
                                         <arrival-airport>".$clear_select['0']->returnfl[$j]->desti."</arrival-airport>
                                         <flight-number>".$clear_select['0']->returnfl[$j]->fnum."</flight-number>
                                         <airline>".$clear_select['0']->returnfl[$j]->car_id."</airline>
                                         <operating-airline>".$clear_select['0']->returnfl[$j]->car_id."</operating-airline>
                                         <departure-date>".date('Y-m-d',strtotime($clear_select['0']->returnfl[$j]->arr_tym))."</departure-date>    
                                     ";
                         $xmlRequest.="</segment-spec>";
                        }
                        $xmlRequest.="</segments>";
                        $xmlRequest.="</flight-spec>";
                        }
                       
                        //return flights
                        if(isset($return_select) && $return_select<>'')
                        {
                         
                            $xmlRequest.="<flight-spec><fare-key>".$return_select['0']->price[0]->farekey."  </fare-key>  "; 
                        
                        
                        $xmlRequest.="<segments>";
                        
                        $count2=count($return_select['0']->returnfl);
                        //echo $count1;exit;
                        for($i=0;$i<$count2;$i++)
                        {
                        $xmlRequest.="<segment-spec>";
                        $xmlRequest.="
                                         <departure-airport>".$return_select['0']->returnfl[$i]->sour."</departure-airport>
                                         <arrival-airport>".$return_select['0']->returnfl[$i]->desti."</arrival-airport>
                                         <flight-number>".$return_select['0']->returnfl[$i]->car_id."</flight-number>
                                         <airline>".$return_select['0']->returnfl[$i]->car_id."</airline>
                                         <operating-airline>".$return_select['0']->returnfl[$i]->car_id."</operating-airline>
                                         <departure-date>".date('Y-m-d',strtotime($return_select['0']->returnfl[$i]->arr_tym))."</departure-date>    
                                     ";
                         $xmlRequest.="</segment-spec>";
                         
                        }
                        
                        $xmlRequest.="</segments>";
                        $xmlRequest.="</flight-spec>";
                            
                        }
                        
                        //end of return flights
                        
//                        //return flights international
//                        if(isset($return_select) && $return_select<>'')
//                        {
//                            $xmlRequest.="<flight-spec><fare-key>".$return_select['0']->price[0]->farekey."  </fare-key>  "; 
//                        
//                        
//                        $xmlRequest.="<segments>";
//                        
//                        $count2=count($return_select['0']->returnfl);
//                        //echo $count1;exit;
//                        for($i=0;$i<$count2;$i++)
//                        {
//                            
//                        $xmlRequest.="<segment-spec>";
//                        $xmlRequest.="
//                                         <departure-airport>".$return_select['0']->returnfl[$i]->sour."</departure-airport>
//                                         <arrival-airport>".$return_select['0']->returnfl[$i]->desti."</arrival-airport>
//                                         <flight-number>".$return_select['0']->returnfl[$i]->car_id."</flight-number>
//                                         <airline>".$return_select['0']->returnfl[$i]->car_id."</airline>
//                                         <operating-airline>".$return_select['0']->returnfl[$i]->operating_airline."</operating-airline>
//                                         <departure-date>".date('Y-m-d',strtotime($return_select['0']->returnfl[$i]->arr_tym))."</departure-date>    
//                                     ";
//                         $xmlRequest.="</segment-spec>";
//                         
//                        }
//                        
//                        $xmlRequest.="</segments>";
//                        $xmlRequest.="</flight-spec>";
//                            
//                        }
//                        //end of return flights international
                        $xmlRequest.="</flights>";
                         //echo "<pre>";print_r(htmlspecialchars($xmlRequest));exit;   
//                        <pax-info-list>
//                        <pax-info>
//                        <title>Mr</title>
//                        <first-name>Sharath</first-name>
//                        <last-name>Nath</last-name>
//                        <type>ADT</type>
//                        </pax-info>
//                        </pax-info-list>
//                        ";
//             
//  		 $xmlRequest.="</itinerary>";
                 //echo "<pre>";print_r(htmlspecialchars($xmlRequest));exit;
                        
                 $xmlRequest.="
                       <pax-info-list>
                        ";
            //by means if tickets creating the itinerary
            if(isset($book_passsenger->adults) && $book_passsenger->adults>0)
                {
            $adults=$book_passsenger->adults;
                }
                if(isset($book_passsenger->children) && $book_passsenger->children>0)
                {
                    $children=$book_passsenger->children;
                }
                if(isset($book_passsenger->infants) && $book_passsenger->infants>0)
                {
                    $infants=$book_passsenger->infants;
                }
                   
                    
            
                $i=3;
                if(isset($book_passsenger->adults) && $book_passsenger->adults>0)
                {
                 for($j=0;$j<$adults;$j++)
                    {
                    
                    $xmlRequest.="
                        <pax-info>
                        <title>".$_POST['title'.$i]."</title>
                        <first-name>".$_POST['firstname'.$i]."</first-name>
                        <last-name>".$_POST['lastname'.$i]."</last-name>
                        ";
                     if(isset($_POST['passport_number'.$i]) && $_POST['passport_number'.$i]<>'')
                     {   
                     $xmlRequest.="   <passport-detail>
                        <passport-number>".$_POST['passport_number'.$i]."</passport-number>
                        </passport-detail>";
                     }
                       $xmlRequest.=" 
                        <date-of-birth>".date('Y-m-d',strtotime($_POST['datepicker'.$i]))."</date-of-birth>
                        <poi-detail>
                        <id-card-number/>
                        <id-card-type/>
                        <visa-type>Business</visa-type>
                        </poi-detail>
                        <type>ADT</type>
                        </pax-info>
                        ";
                    $i++;
                    }
                }
                
                if(isset($book_passsenger->children) && $book_passsenger->children>0)
                {
                    for($j=0;$j<$children;$j++)
                    {
                    $xmlRequest.="
                        <pax-info>
                        <title>Mstr</title>
                        <first-name>".$_POST['firstname'.$i]."</first-name>
                        <last-name>".$_POST['lastname'.$i]."</last-name>
                        ";
                        if(isset($_POST['passport_number'.$i]) && $_POST['passport_number'.$i]<>'')
                     {   
                     $xmlRequest.="   <passport-detail>
                        <passport-number>".$_POST['passport_number'.$i]."</passport-number>
                        </passport-detail>";
                     }
                     $xmlRequest.="
                        <type>CHD</type>
                        <date-of-birth>".date('Y-m-d',strtotime($_POST['datepicker'.$i]))."</date-of-birth>
                        </pax-info>
                        ";
                    $i++;
                    }
                }
                
                if(isset($book_passsenger->infants) && $book_passsenger->infants>0)
                {
                    
                    for($j=0;$j<$infants;$j++)
                    {
                    $xmlRequest.="
                        <pax-info>
                        <title>Mstr</title>
                        <first-name>".$_POST['firstname'.$i]."</first-name>
                        <last-name>".$_POST['lastname'.$i]."</last-name>
                         ";
                        if(isset($_POST['passport_number'.$i]) && $_POST['passport_number'.$i]<>'')
                     {   
                     $xmlRequest.="   <passport-detail>
                        <passport-number>".$_POST['passport_number'.$i]."</passport-number>
                        </passport-detail>";
                     }
                     $xmlRequest.="
                        <date-of-birth>".date('Y-m-d',strtotime($_POST['datepicker'.$i]))."</date-of-birth>    
                        <type>INF</type>
                        </pax-info>
                        ";
                    }
                }
                   
             
			$xmlRequest.="
			</pax-info-list></itinerary>"; 
                       // echo "<pre>";print_r(htmlspecialchars($xmlRequest));exit;
//            curl_setopt($ch, CURLOPT_POSTFIELDS,$xmlRequest);

			//            echo "<pre>";print_r(htmlspecialchars(trim($xmlRequest)));exit;

			//$authkey='5caebd280ccdf3463b025eca00fa5e78';// staging
			$authkey='8ab8e687cd57ebd32ce8537ff8b53ede';
			// $url = 'http://api.cleartrip.com/air/1.0/itinerary/create';

			//$url="http://api.staging.cleartrip.com/air/1.0/itinerary/create"; //staging
			$url="https://api.cleartrip.com/air/1.0/itinerary/create"; //staging
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY:'.$authkey,'X-CT-SOURCETYPE:API'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($ch, CURLOPT_POSTFIELDS,array($xmlRequest));
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, trim($xmlRequest));
			$create_itinerary = curl_exec($ch); 
			if(curl_errno($ch))
			print curl_error($ch);
			else
			curl_close($ch);
                        //echo "<pre>";print_r($create_itinerary);exit;
                        return $create_itinerary;
        }
        
        //mango pnr updating
        public static function pnr_rebuild_structure($orderid,$updatable_pnr)
        {
             //connecting to mongodb
           $connection = DB::connection('mongodb');
           $criteria = array('order_id'=>(int)$orderid);
              
           $query = $connection->getCollection('extended_products')->find($criteria);
           
            foreach($query as $mongodata)
           {
              
               $flight_details_temp=(array) json_decode($mongodata['output']);
               
               
               $flight_details_temp1=json_decode($flight_details_temp['booking_data']);
               $flight_details_temp2=$flight_details_temp1->data['0']->flightdetails;
               
               
               $count_flights=count($flight_details_temp2);
               //echo "<pre>";print_r($count_flights);exit;
               
               for($j=0;$j<$count_flights;$j++)
               {
                   $flight=$flight_details_temp2[$j];
                  
                   $flight->airlinepnr=$updatable_pnr[$j];
                   $updated_flight_details[]=$flight;
                   
               }
               
               
               
               unset($flight_details_temp1->data['0']->flightdetails);
               $flight_details_temp1->data['0']->flightdetails=$updated_flight_details;
                
               $flight_details_temp['booking_data']=json_encode($flight_details_temp1);
              
               
           }
           return json_encode($flight_details_temp);
        }

        public static function cleartrip_pnr_rebuild_structure($response,$oid,$trip_id)
        {	
        	echo "<pre>";print_r($response);exit;
        }
        

}

