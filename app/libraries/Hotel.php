<?php
class Hotel {
  public static function Hotels_List($api) {
        $param =explode('|',base64_decode($api));
        
	$d=4;
	$xmlurl='<HotelListRequest>
			<arrivalDate>'.$param[1].'</arrivalDate>
			<departureDate>'.date('m/d/Y',strtotime($param[2])).'</departureDate>
			<RoomGroup>';
			for($i=1;$i<=date('m/d/Y',strtotime($param[3]));$i++) {
			$ages='';$c='';
			$a=$d+1;
			$b=$a+1;
			$xmlurl .='<Room>
			<numberOfAdults>'.$param[$a].'</numberOfAdults>
			<numberOfChildren>0</numberOfChildren>';
			for($j=1;$j<=$param[$b];$j++)
			{ $c=$b+$j;
			if(!empty($param[$c]) && $param[$b]<>0)
			$ages[]=$param[$c];
			}
			
			if(!empty($ages))
			$xmlurl .='<childAges>'.implode(",",$ages).'</childAges>';
			 $xmlurl .='</Room>';
			if(!empty($c)) $d=$c;else $d=$b; }
			 $xmlurl .='</RoomGroup>';
			 if($param[1]<>''){
			 $xmlurl .='<propertyName></propertyName>';
			 }
			$xmlurl .='<numberOfResults>200</numberOfResults>
			<city>'.$param[0].'</city>
			<countryCode>IN</countryCode>
			</HotelListRequest>';
			
			 $url='http://api.eancdn.com/ean-services/rs/hotel/v3/list?cid=467181&minorRev=26&apiKey=cbrzfta369qwyrm9t5b8y8kf&locale=en_US&currencyCode=INR&customerIpAddress='.$_SERVER['REMOTE_ADDR'].'&customerUserAgent=Mozilla/5.0+%28X11;+Linux+i686;+rv:17.0%29+Gecko/17.0+Firefox/17.0&customerSessionId=&_type=xml&xml='.urlencode($xmlurl);
			 $curl = New Curl;
			// $hotel = $curl->simple_get($url);
			 $hotel= $curl->simple_get($url);
			 $hotels= Xml2array::xml2array_test($hotel);
			 
			 if(isset($hotels['ns2:HotelListResponse']['EanWsError']))
			 { 
			 $hotel ='';$count1=0;$ages='';
			$a=4+$i+$count1;
			$b=5+$i+$count1;
				 if(isset( $hotels['ns2:HotelListResponse']['LocationInfos']['LocationInfo'][1]['city']))
           {    
          $dest_str= $hotels['ns2:HotelListResponse']['LocationInfos']['LocationInfo'][1]['city'];

		$xmlurl='<HotelListRequest>
			<countryCode>'. $hotels['ns2:HotelListResponse']['LocationInfos']['LocationInfo'][1]['countryCode'].'</countryCode>
			<city>'.$dest_str.'</city> 
			<arrivalDate>'.date('m/d/Y',strtotime($param[2])).'</arrivalDate>
			<departureDate>'.date('m/d/Y',strtotime($param[3])).'</departureDate>
			<RoomGroup>';
			$d=4; for($i=1;$i<=$param[4];$i++) {
			$ages='';$c='';
			$a=$d+1;
			$b=$a+1;
			$xmlurl .='<Room>
			<numberOfAdults>'.$param[$a].'</numberOfAdults>
			<numberOfChildren>'.$param[$b].'</numberOfChildren>';
			for($j=1;$j<=$param[$b];$j++)
			{ $c=$b+$j;
			if(!empty($param[$c]) && $param[$b]<>0)
			$ages[]=$param[$c];
			}
			if(!empty($ages))
			$xmlurl .='<childAges>'.implode(",",$ages).'</childAges>';
			 $xmlurl .='</Room>';
			if(!empty($c)) $d=$c;else $d=$b; }
			 $xmlurl .='</RoomGroup>';
			  if($param[1]<>''){
			 $xmlurl .='<propertyName>'.$param[1].'</propertyName>';
			 }
			$xmlurl .='<numberOfResults>200</numberOfResults>
			</HotelListRequest>';
                      

		 $url='http://api.eancdn.com/ean-services/rs/hotel/v3/list?cid=467181&minorRev=26&apiKey=cbrzfta369qwyrm9t5b8y8kf&locale=en_US&currencyCode=INR&customerIpAddress='.$_SERVER['REMOTE_ADDR'].'&customerUserAgent=Mozilla/5.0+%28X11;+Linux+i686;+rv:17.0%29+Gecko/17.0+Firefox/17.0&customerSessionId=&_type=xml&xml='.urlencode($xmlurl);

		$hotel = $this->curl->simple_get($url);
		$hotels= Xml2array::xml2array_test($hotel);
		} 
		}	 
	return $hotels;
    }
  
         public static function Hotel_Details($details)
         {
         
        $check_in=date('m/d/Y',strtotime(str_replace('/','-',$details['check_in'])));
	$check_out=date('m/d/Y',strtotime(str_replace('/','-',$details['check_out'])));
          $img_id= $details['thumbnail'];
	  $hotel_id=$details['hotelid'];
          $xmlurl='<HotelRoomAvailabilityRequest>
		<hotelId>'.trim($details['hotelid']).'</hotelId>
		<arrivalDate>'.date('m/d/Y',strtotime(str_replace('-','/',$check_in))).'</arrivalDate>
		<departureDate>'.date('m/d/Y',strtotime(str_replace('-','/',$check_out))).'</departureDate>
		<RoomGroup>';
		for($i=1;$i<=$details['num_rooms'];$i++) { $ages='';
		$xmlurl .='<Room>
		<numberOfAdults>'.$details['numberOfAdults'.$i.''].'</numberOfAdults>
		<numberOfChildren>'.$details['numberOfChildren'.$i.''].'</numberOfChildren>';
                     
		for($j=1;$j<=$details['numberOfChildren'.$i.''];$j++)
		{
		        if(!empty($details['room'.$i.'Child'.$j]))
		        $ages[]=$details['room'.$i.'Child'.$j];
		}

		        if(!empty($ages))
		        $xmlurl .='<childAges>'.implode(",",$ages).'</childAges>';
		        $xmlurl .=' </Room>';
		}
		$xmlurl .='</RoomGroup>
		<includeRoomImages>true</includeRoomImages>
		<city>'.$details['cityname'].'</city><countryCode></countryCode>
		</HotelRoomAvailabilityRequest>';
		
			$url='http://api.eancdn.com/ean-services/rs/hotel/v3/avail?cid=467181&minorRev=26&apiKey=cbrzfta369qwyrm9t5b8y8kf&locale=en_US&currencyCode=INR&customerIpAddress='.$_SERVER['REMOTE_ADDR'].'&customerUserAgent=Mozilla/5.0+(X11;+Linux+i686;+rv:17.0)+Gecko/17.0+Firefox/17.0&customerSessionId=0ABAA82B-A55C-5691-3DF2-DD3AD4493E87&xml='.urlencode($xmlurl);
		 $curl = New Curl;	
                 $details = $curl->simple_get($url);
                 
                 $hotel_list=json_decode($details );
                 
//echo '<pre>'; print_r($url);print_r(htmlspecialchars($xmlurl));print_r($hotel_list); exit;
		 $expdiahotels= (array)$hotel_list;
		
                       $newhotel_list= $expdiahotels;
	                if(isset($newhotel_list['HotelRoomAvailabilityResponse']))
                        $rem_det=Xml2array::toArray($newhotel_list['HotelRoomAvailabilityResponse']); 
                        else
                        $rem_det=array();
		        $data['h_id']=$hotel_id;
		        $data['hotel_img'] =  $img_id;
		        $det_url='<HotelInformationRequest>
		        <hotelId>'.$hotel_id.'</hotelId>
		        </HotelInformationRequest>';
	                $uri='http://api.eancdn.com/ean-services/rs/hotel/v3/info?cid=467181&minorRev=26&apiKey=cbrzfta369qwyrm9t5b8y8kf&locale=en_US&currencyCode=INR&customerIpAddress='.$_SERVER['REMOTE_ADDR'].'&customerUserAgent=Mozilla/5.0+(X11;+Linux+i686;+rv:17.0)+Gecko/17.0+Firefox/17.0&customerSessionId=0ABAA83F-9BB5-D491-3D02-F70DA3892213&xml='.urlencode($det_url);
		$hotels =  $curl->simple_get($uri);
                $hotel_lists=json_decode($hotels);
		$hotelinfo=Xml2array::toArray($hotel_lists);
                $newhotel_lists=$hotelinfo;
		$data=$newhotel_lists['HotelInformationResponse'];
		$data['rem_det']=$rem_det;
		return $data;
		}
        public static function Hotel_Booking($book)
        {
        
            $det_url='<HotelInformationRequest>
		        <hotelId>'.$book['hotelid'].'</hotelId>
		        </HotelInformationRequest>';
		 $uri='http://api.eancdn.com/ean-services/rs/hotel/v3/info?cid=467181&minorRev=26&apiKey=cbrzfta369qwyrm9t5b8y8kf&locale=en_US&currencyCode=INR&customerIpAddress='.$_SERVER['REMOTE_ADDR'].'&customerUserAgent=Mozilla/5.0+(X11;+Linux+i686;+rv:17.0)+Gecko/17.0+Firefox/17.0&customerSessionId=0ABAA83F-9BB5-D491-3D02-F70DA3892213&xml='.urlencode($det_url);
   
		$curl = New Curl;
		$hotels = $curl->simple_get($uri);
		$hotel_lists=json_decode($hotels);
		$hotelinfo=  (array)$hotel_lists;
		echo '<pre>';
		print_r($uri);
		exit;
        
        }
        public static function Hotel_Checkout($book_hotel)
        {
   $check_in=date('m/d/Y',strtotime(str_replace('/','-',$book_hotel['check_in'])));
	$check_out=date('m/d/Y',strtotime(str_replace('/','-',$book_hotel['check_out'])));
        $bookingxml='<HotelRoomReservationRequest>
        <hotelId>'.trim($book_hotel['hotelid']).'</hotelId>
        <arrivalDate>'.date('m/d/Y',strtotime(str_replace('-','/',$check_in))).'</arrivalDate>
        <departureDate>'.date('m/d/Y',strtotime(str_replace('-','/',$check_out))).'</departureDate>
        <supplierType>'.$book_hotel['supplierType'].'</supplierType>
        <rateKey>'.$book_hotel['rateKey'].'</rateKey>
        <roomTypeCode>'.$book_hotel['roomTypeCode'].'</roomTypeCode>
        <rateCode>'.$book_hotel['rateCode'].'</rateCode>
        <chargeableRate>'.round($book_hotel['average_rate']).'</chargeableRate>';
        $bookingxml .='<RoomGroup>';
        for($i=1;$i<=$book_hotel['num_rooms'];$i++){ 
        $bookingxml .='<Room>
        <numberOfAdults>'.$book_hotel['numberOfAdults'.$i.''].'</numberOfAdults>
        <numberOfChildren>'.$book_hotel['numberOfChildren'.$i.''].'</numberOfChildren>';
        for($j=1;$j<=$book_hotel['numberOfChildren'.$i.''];$j++)
        {
        if(!empty($book_hotel['room']['room'.$i.'Child'.$j]))
        $ages[]=$book_hotel['room']['room'.$i.'Child'.$j];
        }
        if(!empty($ages))
        $bookingxml .='<childAges>'.implode(",",$ages).'</childAges>';
        
        $bookingxml .='<firstName>'.$book_hotel['firstName'.$i.''].'</firstName>
        <lastName>'.$book_hotel['lastName'.$i.''].'</lastName>
        <bedTypeId>'.$book_hotel['bedTypeId'.$i.''].'</bedTypeId>
        <smokingPreference>'.$book_hotel['smokingPreference'.$i.''].'</smokingPreference>';
        
        $bookingxml .='</Room>';
        }
        $bookingxml .='</RoomGroup>';
       	$bookingxml .='<sendReservationEmail>no</sendReservationEmail><ReservationInfo>
         <email>'.$book_hotel['s_email'].'</email>
        <firstName>Test Booking</firstName>
        <lastName>Test Booking</lastName>
        <homePhone>4178291392</homePhone>
        <workPhone>4178291392</workPhone>
        <creditCardType>MC</creditCardType>
        <creditCardNumber>5401999999999999</creditCardNumber>
        <creditCardExpirationMonth>11</creditCardExpirationMonth>
        <creditCardExpirationYear>2016</creditCardExpirationYear>
        <creditCardIdentifier>123</creditCardIdentifier>
        </ReservationInfo>
        <AddressInfo>
        <address1>travelnow</address1>
        <city>Seattle</city>
        <stateProvinceCode>WA</stateProvinceCode>
        <countryCode>US</countryCode>
        <postalCode>65807</postalCode>
        </AddressInfo>
        </HotelRoomReservationRequest> ';
//------------------ its live credentials please dont enable --------------//
//live booking-->amit

	/* $bookingxml .='<sendReservationEmail>no</sendReservationEmail><ReservationInfo>
        <email>'.$api['Posted']['email'].'</email>
        <firstName>Amit</firstName>
        <lastName>Chawla</lastName>
        <homePhone>43315520</homePhone>
        <workPhone>43315520</workPhone>
        <creditCardType>VI</creditCardType>
        <creditCardNumber>4854980600015111</creditCardNumber>
        <creditCardExpirationMonth>11</creditCardExpirationMonth>
        <creditCardExpirationYear>2016</creditCardExpirationYear>
        <creditCardIdentifier>905</creditCardIdentifier>
        </ReservationInfo>
        <AddressInfo>
        <address1>reward360,lavelle road</address1>
        <city>Bengaluru</city>
        <countryCode>IN</countryCode>
        <postalCode>560024</postalCode>
        </AddressInfo>
        </HotelRoomReservationRequest> ';


*/


     
//----------------------please dont edit--------------------//
         
        $url='https://book.api.ean.com/ean-services/rs/hotel/v3/res?'; $body='cid=467181&minorRev=26&apiKey=cbrzfta369qwyrm9t5b8y8kf&locale=en_EN&currencyCode=INR&customerIpAddress='.$_SERVER['REMOTE_ADDR'].'&customerUserAgent=Mozilla/5.0+(X11;+Linux+i686;+rv:17.0)+Gecko/17.0+Firefox/17.0&customerSessionId=0ABAA829-5805-BA91-3D82-226098E93283&xml= '.urlencode(trim($bookingxml));
       
                        $c = curl_init();
                        curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt ($c, CURLOPT_POST, true);
			curl_setopt ($c, CURLOPT_POSTFIELDS, $body);
			curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
                        $page['success'] = curl_exec ($c);
			//echo '<pre>'; print_r(htmlspecialchars($bookingxml));print_r(htmlspecialchars($page['success'])); exit;
			if(curl_errno($c))
			{
			$page['error']= curl_error($c);
			}
			curl_close ($c);
			$hotel_lists=json_decode($page['success']);
		$hotelinfo= (array)$hotel_lists;
                        return $hotelinfo;
        
        }
			  public static function Hotel_clr_provisional($data)
        {
$getdetails=(array)json_decode(urldecode($data['postvalue']));
	
				/*$body='<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
				<provisional-book-request xmlns="http://www.cleartrip.com/hotel/provisional-book-request">
				<nri>false</nri>
				<hotel-id>'.$data['hotel_id'].'</hotel-id>
				<check-in-date>'.$data['check_in_date'].'</check-in-date>
				<check-out-date>'.$data['check_out_date'].'</check-out-date>
				<number-of-rooms>'.$data['number_rooms'].'</number-of-rooms>';
			for($i=1;$i<=$data['number_rooms']; $i++){
				$body.='<adults-per-room>'.$getdetails['numberOfAdults'.$i.''].'</adults-per-room>';
				}
			for($i=1;$i<=$data['number_rooms']; $i++){
				$body.='<children-per-room>'.$getdetails['numberOfChildren'.$i.''].'</children-per-room>';
				}
			for($i=1;$i<=$data['number_rooms']; $i++){
					$body.='<child-ages-per-room>';
				for($j=1;$j<=$getdetails['numberOfChildren'.$i.'']; $j++){
				$body.='<age>'.$getdetails['room'.$i.'Child'.$j.''].'</age>';
				}
				$body.='</child-ages-per-room>';
				}
				$body.='<booking-code>'.$data['booking_code'].'</booking-code>
				<room-type-code>'.$data['room_code'].'</room-type-code>
				<customer-ip-address>'.$_SERVER['REMOTE_ADDR'].'</customer-ip-address>
				<booking-amount>'.$data['amount'].'</booking-amount>
				<customer>
				<title>'.$data['title'].'</title>
				<first-name>'.$data['firstname'].'</first-name>
				<last-name>'.$data['lastname'].'</last-name>
				<street-address-1>'.$data['address'].'</street-address-1>
				<city>'.$data['city'].'</city>
				<state>Maharashtra</state>
				<country>'.$data['country'].'</country>
				<postal-code>'.$data['postal'].'</postal-code>
				<mobile>'.$data['mobile'].'</mobile>
				<email>'.$data['email'].'</email>
				</customer>
				</provisional-book-request>';
			 $url='http://api.staging.cleartrip.com/hotels/1.0/provisionalbook'; 
      
                        $c = curl_init();
                        curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt($c, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API','Content-type: application/xml'));
			curl_setopt ($c, CURLOPT_POST, true);
			curl_setopt ($c, CURLOPT_POSTFIELDS, trim($body));
			curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
                        $page['success'] = curl_exec ($c);
			curl_close($c);
			
                           $trip_id=Xml2array::xml2array_test($page['success']);
 				<provisional-book-id>'.$trip_id['provisional-book-response']['provisional-book-id'].'</provisional-book-id>
//echo '<pre>';  print_r($trip_id); exit; */
				$body='<book-request  xmlns="http://www.cleartrip.com/hotel/book-request">
				<affiliate-txn-id>12322456</affiliate-txn-id>				
				<nri>false</nri>
				<hotel-id>'.$data['hotel_id'].'</hotel-id>
				<check-in-date>'.$data['check_in_date'].'</check-in-date>
				<check-out-date>'.$data['check_out_date'].'</check-out-date>
				<number-of-rooms>'.$data['number_rooms'].'</number-of-rooms>';
			for($i=1;$i<=$data['number_rooms']; $i++){
				$body.='<adults-per-room>'.$getdetails['numberOfAdults'.$i.''].'</adults-per-room>';
				}
			for($i=1;$i<=$data['number_rooms']; $i++){
				$body.='<children-per-room>'.$getdetails['numberOfChildren'.$i.''].'</children-per-room>';
				}
			for($i=1;$i<=$data['number_rooms']; $i++){
					$body.='<child-ages-per-room>';
				for($j=1;$j<=$getdetails['numberOfChildren'.$i.'']; $j++){
				$body.='<age>'.$getdetails['room'.$i.'Child'.$j.''].'</age>';
				}
				$body.='</child-ages-per-room>';
				}
				$body.='<booking-code>'.$data['booking_code'].'</booking-code>
				<room-type-code>'.$data['room_code'].'</room-type-code>
				<customer-ip-address>'.$_SERVER['REMOTE_ADDR'].'</customer-ip-address>
				<booking-amount>'.$data['amount'].'</booking-amount>
				<customer>
				<title>'.$data['title'].'</title>
				<first-name>'.$data['firstname'].'</first-name>
				<last-name>'.$data['lastname'].'</last-name>
				<street-address-1>'.$data['address'].'</street-address-1>
				<city>'.$data['city'].'</city>
				<state>Maharashtra</state>
				<country>'.$data['country'].'</country>
				<postal-code>'.$data['postal'].'</postal-code>
				<mobile>'.$data['mobile'].'</mobile>
				<email>'.$data['email'].'</email>
				</customer>
				<payment>
				<payment-type>DA</payment-type>
				<deposit-account-detail>
				<id>225464742</id>
				<password/>
				</deposit-account-detail>
				</payment>
				</book-request>';
			 $url='http://api.staging.cleartrip.com/hotels/1.0/book'; 
      
                        $c = curl_init();
                        curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt($c, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API','Content-type: application/xml'));
			curl_setopt ($c, CURLOPT_POST, true);
			curl_setopt ($c, CURLOPT_POSTFIELDS, trim($body));
			curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
                        $page['success'] = curl_exec ($c);
			//echo '<pre>'; print_r(htmlspecialchars($body));print_r(htmlspecialchars($page['success'])); exit;
                        return $page;



	}
		  public static function Hotel_clr_inter($book_hotel)
        {
//print_r($book_hotel); exit;
			$url='http://api.staging.cleartrip.com/hotels/1.0/trips/'.$book_hotel.'';
			$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); 
$hotels= Xml2array::xml2array_test($result);
     return $hotels;

	}
		
		public static function checkout($value)
	{

			     	$json['Posted']=$value;
				$json['Customer_Id']=1;
				$json['Created_Date']=date('Y-m-d H:i:s');
				$json['Patner_Id']=6;
				$json['API_Type']='hotels';
				$json['cityname']=$value['cityname'];
				$json['check_in']=$value['check_in'];
				$json['check_out']=$value['check_out'];
				$json['num_rooms']=$value['num_rooms'];
				$json['name']=$value['name'];
				$test =json_encode($json);
				$save['input']=$test;
				$save['order_id']='';
				$json['api_pid'] = Checkoutmodel::do_checkout($save);
				
				$ticket['quantity']=1;
				$ticket['description']='<b>Hotel Name:</b> '.$value['name'];
				$ticket['json']=$json;

			        return $ticket;


	}

		public static function clr_checkout($value)
	{

			     	$json['Posted']=$value;
				$json['Customer_Id']=1;
				$json['Created_Date']=date('Y-m-d H:i:s');
				$json['Patner_Id']=8;
				$json['API_Type']='cleartrip';
				$json['check_in']=$value['check_in_date'];
				$json['check_out']=$value['check_out_date'];
				$json['num_rooms']=$value['number_rooms'];
				$test =json_encode($json);
				$save['input']=$test;
				$save['order_id']='';
				$json['api_pid'] = Checkoutmodel::do_checkout($save);
				
				$ticket['quantity']=1;
				$ticket['description']='<b>Hotel Name:</b> ';
				$ticket['json']=$json;

			        return $ticket;


	}
			public static function clr_polic($data)
	{ 
$getdetails=(array)json_decode(urldecode($data['postvalue']));
//echo '<pre>'; print_r($data); exit;

					$body='<rate-rules-request xmlns="http://www.cleartrip.com/hotel/rate-rules-request">
					<nri>false</nri>
					<hotel-id>'.$data['hotelid'].'</hotel-id>
				<check-in-date>'.$data['hotel_dect']['hotel-search-response']['search-criteria']['check-in-date'].'</check-in-date>
				<check-out-date>'.$data['hotel_dect']['hotel-search-response']['search-criteria']['check-out-date'].'</check-out-date>
				<number-of-rooms>'.$getdetails['num_rooms'].'</number-of-rooms>';
			for($i=1;$i<=$getdetails['num_rooms']; $i++){
				$body.='<adults-per-room>'.$getdetails['numberOfAdults'.$i.''].'</adults-per-room>';
				}
			for($i=1;$i<=$getdetails['num_rooms']; $i++){
				$body.='<children-per-room>'.$getdetails['numberOfChildren'.$i.''].'</children-per-room>';
				}
			for($i=1;$i<=$getdetails['num_rooms']; $i++){
					$body.='<child-ages-per-room>';
				for($j=1;$j<=$getdetails['numberOfChildren'.$i.'']; $j++){
				$body.='<age>'.$getdetails['room'.$i.'Child'.$j.''].'</age>';
				}
				$body.='</child-ages-per-room>';
				}
				$body.='<booking-code>'.$data['booking_code'].'</booking-code>
				<room-type-code>'.$data['room_type_code'].'</room-type-code>
					</rate-rules-request>';
			$url='http://api.staging.cleartrip.com/hotels/1.0/getRateRules';
   				$c = curl_init();
                        curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt($c, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API','Content-type: application/xml'));
			curl_setopt ($c, CURLOPT_POST, true);
			curl_setopt ($c, CURLOPT_POSTFIELDS, trim($body));
			curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
                        $page = curl_exec ($c);
			//echo '<pre>'; print_r(htmlspecialchars($body));print_r(htmlspecialchars($page)); exit;
                        return $page;
			        return $ticket;


	}


		public static function cancel_exp()
	{ 


					$cancelxml='<HotelRoomCancellationRequest>
            <itineraryId>171123078</itineraryId>
            <confirmationNumber>1410931277245</confirmationNumber>
            <email>bharath.c@mahiti.org</email>';
            $cancelxml .='<reason>COP</reason>';
            $cancelxml .='</HotelRoomCancellationRequest>';
			$url='http://api.ean.com/ean-services/rs/hotel/v3/cancel?minorRev=26&cid=421905&apiKey=cbrzfta369qwyrm9t5b8y8kf&customerUserAgent=Mozilla/5.0+(X11;+Linux+i686)+AppleWebKit/537.22+(KHTML,+like+Gecko)+Chrome/25.0.1364.172+Safari/537.22&customerIpAddress='.$_SERVER['REMOTE_ADDR'].'&customerSessionId=0ABAA829-5805-BA91-3D82-226098E93283&locale=en_US&currencyCode=USD&xml='.urlencode($cancelxml);
echo '<pre>'; print_r($url);exit;
   				$c = curl_init();
                        curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt ($c, CURLOPT_POST, true);
			curl_setopt ($c, CURLOPT_POSTFIELDS, $cancelxml);
			curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
                        $page= curl_exec ($c);
			print_r(htmlspecialchars($page)); exit;
                        return $page;
			        


	}
		public static function dateDiff($start,$end=false)
{
   $return = array();
   
   try {
      $start = new DateTime($start);
      $end = new DateTime($end);
      $form = $start->diff($end);
   } catch (Exception $e){
      return $e->getMessage();
   }
   
   $display = array('y'=>'year',
               'm'=>'month',
               'd'=>'day',
               'h'=>'hour',
               'i'=>'minute',
               's'=>'second');
   foreach($display as $key => $value){
      if($form->$key > 0){
         $return[] = $form->$key.' '.($form->$key > 1 ? $value.'s' : $value);
      }
   }
   
   return implode($return, ', ');
}

  
 }
