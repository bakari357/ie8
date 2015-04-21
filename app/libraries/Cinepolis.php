<?php
require_once(app_path().'/lib/nusoap.php');
class Cinepolis {
	public static function showmovie_list($data)
		{
			$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
			$client = new nusoap_client('http://www.cinepolisindia.com:5000/Schedule/Schedule_Service.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
			$showdetailsaction="http://tempuri.org/FnSchedule_ShowDetails";
			$showdetailsxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
			<soap:Body>
			<FnSchedule_ShowDetails xmlns="http://tempuri.org/">
			<CityId>'.$data['cityid'].'</CityId>
			<TheatreId>'.$data['theatreid'].'</TheatreId>
			<MovieId>'.$data['filmid'].'</MovieId>
			<ShowDate>'.$data['daterange'].'</ShowDate>
			<Qty>1</Qty>
			</FnSchedule_ShowDetails>
			</soap:Body>
			</soap:Envelope>';
			$showlist = $client->send($showdetailsxml,$showdetailsaction,'');

			if ($client->fault) {
					   return $showlist;
					    } else {
					 $err = $client->getError();  // Check for errors
					  if ($err) {
					   return $err;    // Display the error
					  } else {
					 return $showlist;
					}
				}
		}

	public static function show_screen($data)
		{
			$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
			$client = new nusoap_client('http://www.cinepolisindia.com:5000/Schedule/Schedule_Service.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
			$screenaction="http://tempuri.org/FnSchedule_Screen";
			$screenxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
			<soap:Body>
			<FnSchedule_Screen xmlns="http://tempuri.org/">
			<CityId>'.$data['cityid'].'</CityId>
			<TheatreId>'.$data['theatreid'].'</TheatreId>
			<ScreenId>'.$data['screennid'].'</ScreenId>
			</FnSchedule_Screen>
			</soap:Body>
			</soap:Envelope>';
			$screenlist = $client->send($screenxml,$screenaction,'');
			if ($client->fault) {
				return $screenlist;
					} else {
					$err = $client->getError();   // Check for errors
					if ($err) {
					return $err;    // Display the error
					} else {
					return $screenlist;
				}
			}
		}

	public static function show_theatre($data)
		{
			$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
			$client = new nusoap_client('http://www.cinepolisindia.com:5000/Schedule/Schedule_Service.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
			$theatreaction="http://tempuri.org/FnSchedule_Theatre";
			$theatrexml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
			<soap:Body>
			<FnSchedule_Theatre xmlns="http://tempuri.org/">
			<CityId>'.$data['cityid'].'</CityId>
			<TheatreId>'.$data['theatreid'].'</TheatreId>
			</FnSchedule_Theatre>
			</soap:Body>
			</soap:Envelope>';

			$theatrelist = $client->send($theatrexml,$theatreaction,'');
			if ($client->fault) {
				return $theatrelist;
				} else {
				$err = $client->getError();    // Check for errors
				if ($err) {
				return $err;      // Display the error
				} else {
				return $theatrelist;
				}
			}
		}

	public static function  showseats($data)
		{
	  
        	$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
			$client1 = new nusoap_client('http://www.cinepolisindia.com:5000/seatservice/SeatBook.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);

			$seatxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
			<soap:Body>
			<ShowSeats xmlns="http://tempuri.org/">
			<TheatreId>'.$data['theatreid'].'</TheatreId>
			<BookingId>'.$data['BookingId'].'</BookingId>
			<ShowClass>'.trim($data['ClassId']).'</ShowClass>
			<NoOfTickets>'.$data['seat'].'</NoOfTickets>
			<PartnerId>Re360</PartnerId>
			<PartnerPwd>re360@2013</PartnerPwd>
			</ShowSeats>
			</soap:Body>
			</soap:Envelope>
			';
			$seatsaction="http://tempuri.org/ShowSeats";
                        $seatlist = $client1->send($seatxml,$seatsaction,'');
	
			if ($client1->fault) {
				$data['error']=$seatlist;
				} else {
				$err = $client1->getError();    // Check for errors
				if ($err) {
				$data['error']=$err;     // Display the error
				} else {
				$data['seatlist']=$seatlist;
				}
			     }
			return $data;
		}

	public static function cinepolis_booking($data,$cust,$number)
		{
  
		$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
			$client = new nusoap_client('http://www.binepolisindia.com:5000/seatservice/SeatBook.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
			$seats=explode(',',$data['options']['apiproduct']['Posted']['seats']);
			$bookaction="http://tempuri.org/cookSeats";
			$bookxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
			<soap:Body>
			<BookSeats xmlns="http://tempuri.org/">
			<TheatreId>'.$data['options']['apiproduct']['Posted']['theatreid'].'</TheatreId>
			<BookingId>'.$data['options']['apiproduct']['Posted']['BookingId'].'</BookingId>
			<ShowClass>'.$data['options']['apiproduct']['Posted']['selectedclass'].'</ShowClass>
			<NoOfTickets>'.$data['options']['apiproduct']['Posted']['seatcount'].'</NoOfTickets>
			<Seat1>'.str_replace(':',':',$data['options']['apiproduct']['Posted']['seats']).'</Seat1>';
			//$cnt=1; foreach($seats as $key=>$value){
			//$bookxml .='<Seat'.$cnt.'>'.str_replace(':',':',$value).'</Seat'.$cnt.'>';
			//$cnt++; }
			$bookxml .='<PartnerId>Re360</PartnerId>
			<PartnerPwd>re360@2013</PartnerPwd>
			<UniqueRequestId>'.str_replace('re','',$number).'</UniqueRequestId>
			</BookSeats>
			</soap:Body>
			</soap:Envelope>';
			$bookstatus = $client->send($bookxml,$bookaction,'');
			if ($client->fault) {
				$rest['error']=$bookstatus;
				} else {
				$err = $client->getError();    // Check for errors
				if ($err) {
				$rest['error']=$err;     // Display the error
				} else {
				$rest['success']=$bookstatus;
				}
			}
			if(isset($rest['success']) && !empty($rest['success']['BookSeatsResult']) && $rest['success']['BookSeatsResult']['StatusId']==1)
			{
				$length=4;
				$code = md5(uniqid(rand(), true));
				if ($length != "") $ret= substr($code, 0, $length);
				else $ret= $code;
				$chars = '0123456789';
				$ret = '';
				for($i = 0; $i < 4; ++$i) {
				$random = str_shuffle($chars);
				$ret= $random[0];
				}
				$buyaction="http://tempuri.org/Buy";
				$buyxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				<soap:Body>
				<Buy xmlns="http://tempuri.org/">
				<TheatreId>'.$data['theatreid'].'</TheatreId>
				<PartnerId>Re360</PartnerId>
				<PartnerPwd>re360@2013</PartnerPwd>
				<UniqueRequestId>'.str_replace('re','',$data['order_number']).'</UniqueRequestId>
				<PayType>'.$ret.'</PayType>
				<PayConfNo>'.$data['order_number'].'</PayConfNo>
				<Remarks>test</Remarks>
				<MobileNo>'.$data['phn_num'].'</MobileNo>
				<Paid>Y</Paid>
				</Buy>
				</soap:Body>
				</soap:Envelope>';
				$buystatus = $client->send($buyxml,$buyaction,'');
				if ($client->fault) {
				$buyres['error']=$buystatus;
				} else {
				$err = $client->getError();     // Display the error
				if ($err) {
				$buyres['error']=$err;     // Display the error
				} else {
				$buyres['success']=$buystatus;
				}
				}
				if($buyres['success']['BuyResult']['StatusId']==3)
				{
				$soldstatus=soldstatus($api['Posted']['theatreid'],$buyres['success']['BuyResult']['UniqueRequestId']);
				$response['success']=array('buyresult'=>$buyres['success']['BuyResult'],'bookseatresult'=>$rest['success']['BookSeatsResult'],'soldstatus'=>$soldstatus['output'],'input'=>$soldstatus['input'],'tpin'=>$ret);
				}
				else
				{
				$response['error']=array('buyresult'=>$buyres['success']['BuyResult'],'bookseatresult'=>$rest['success']['BookSeatsResult'],'input'=>$buyxml,'tpin'=>$ret);
				}
			}
			else
			{
			$response['error']=array('bookseatresult'=>$rest,'input'=>$bookxml);
			}

			return $response;

		}
                public static function  checkout($data)
 		{
		$json['Posted']=$data;
                        $json['Customer_Id']=1;
			$json['Created_Date']=date('Y-m-d H:i:s');
			$json['Patner_Id']=1;
			$json['API_Type']='cinepolis';
			$json['movie']=$data['moviename'];
			$json['center']=$data['theatreid'];
                        $data['Center']=$json['Posted']['centername'];
                        $json['Center']=$data['Center'];
			$json['filmid']=$data['filmid'];
                        $json['showtime']=$data['showtime'];
			$json['showdate']=$data['showdate'];
			//$json['finishTime']=$data['FinishTime'];
			$json['class']=$data['selectedclass'];
			$test =json_encode($json);
                        $save['input']=$test;
			$save['order_id']='';
			$json['api_pid'] = Checkoutmodel::do_checkout($save);
     
			$ticket['quantity']=$data['QTY'];

			//cart description
			$ticket['description']='<b>Movie Name:</b> '.$data['moviename'].' , <b>Center Name:</b> '.$data['Center'].' , <b>Show Time: </b>'.($data['showtime'].' Show Date:'.$data['showdate']).' , <b>Class:</b> '.$data['selectedclass'];
			$ticket['json']=$json;
           
			return $ticket;


		}



}



