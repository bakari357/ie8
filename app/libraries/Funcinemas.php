<?php
require_once(app_path().'/lib/nusoap.php');
class Funcinemas {
    public static function getmoviedetails($post)
	{
                $proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
		$client = new nusoap_client('http://m.funcinemas.com/FunBookingSystem.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
		$detailsaction="http://tempuri.org/GetMovieDetails";
		$detailsxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<GetMovieDetails xmlns="http://tempuri.org/">
		<CenterCode>'.$post['centercode'].'</CenterCode>
		<MovieCode>'.$post['Film_strCode'].'</MovieCode>
		<ShowCode>'.$post['ShowCode'].'</ShowCode>
		<Key>ay6VkwkkGuc=</Key>
		</GetMovieDetails>
		</soap:Body>
		</soap:Envelope>';
		$detailslist = $client->send($detailsxml,$detailsaction,'');
		$details= Xml2array::xml2array_test($detailslist['GetMovieDetailsResult']);
		return $details;
	}

     public static function generateorderid($data)
	{ 
		$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
                $hostname = $_SERVER['REMOTE_ADDR'];  // UserBrowsingIP = usesit
		$client = new nusoap_client('http://m.funcinemas.com/FunBookingSystem.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
		$orderaction="http://tempuri.org/GenrateOrderID";
		$orderxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<GenrateOrderID xmlns="http://tempuri.org/">
		<CenterCode>'.$data['CenterCode'].'</CenterCode>
		<ShowCode>'.$data['ShowCode'].'</ShowCode>
		<ClassCode>'.$data['ClassCode'].'</ClassCode>
		<Class>'.$data['Class'].'</Class>
		<NOS>'.$data['QTY'].'</NOS>
		<TicketPrice>'.$data['Price'].'</TicketPrice>
		<ServiceFee>'.$data['ServiceFee'].'</ServiceFee>
		<NetPayable>'.$data['net'].'</NetPayable>
		<Discount>0</Discount>
		<DiscountSchemeID>0</DiscountSchemeID>
		<UserBrowsingIP>'.$_SERVER['REMOTE_ADDR'].'</UserBrowsingIP> 
		<RefID>SB</RefID>
		<Key>ay6VkwkkGuc=</Key>
		</GenrateOrderID>
		</soap:Body>
		</soap:Envelope>';
                //echo '<pre>';print_r(htmlspecialchars($orderxml));print_r($data);exit;
		$orderlist = $client->send($orderxml,$orderaction,'');
		$orders= Xml2array::xml2array_test($orderlist['GenrateOrderIDResult']);
		return $orderlist;
	}

    public static function GetAudiLayout($OrderId)
	{ 
          
		$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
		$client = new nusoap_client('http://m.funcinemas.com/FunBookingSystem.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
		$audiaction="http://tempuri.org/GetAudiLayout";
		$audixml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<GetAudiLayout xmlns="http://tempuri.org/">
		<OrderId>'.$OrderId['GenrateOrderIDResult'].'</OrderId>
		</GetAudiLayout>
		</soap:Body>
		</soap:Envelope>';
		$audilist = $client->send($audixml,$audiaction,'');
		if(empty($audilist['GetAudiLayoutResult']))
		return array();
		if($audilist['GetAudiLayoutResult']<>0002)
		{
		$audidetails= Xml2array::xml2array_test($audilist['GetAudiLayoutResult']);

		$audidetails = json_decode(json_encode((array)simplexml_load_string($audilist['GetAudiLayoutResult'])),1);
		}else
                {
		return array();	
                }
		return $audidetails;
	}

   public static function GenrateBookingID($OrderId)
	{
		$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
		$client = new nusoap_client('http://m.funcinemas.com/FunBookingSystem.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
		$bookingaction="http://tempuri.org/GenrateCookingID";
		$bookingxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<GenrateBookingID xmlns="http://tempuri.org/">
		<OrderID>'.$OrderId.'</OrderID>
		</GenrateBookingID>
		</soap:Body>
		</soap:Envelope>';
		$bookinglist = $client->send($bookingxml,$bookingaction,'');
		return $bookinglist;
	}

public static function checksuccess($err)
	{
		if(!isset($err['GenrateBookingIDResult']))
		return 'Failed';
		$ecode=$err['GenrateBookingIDResult'];
		$ercode="$ecode";
		$error = array(
		'0001'  =>  'Unknown Exception',
		'0002'  =>  'No data found',
		'0003'  =>  'Connectivity Error',
		'0004 ' =>  'Error while generating Transaction id',
		'0005 ' =>  'Error while Engaging Seat',
		'0006 ' =>  'Error while generating OrderId',
		'0007 ' =>  'Updating fail',
		'1006'  =>  'Not Valid User, Blocked User, Booking Limit Exceeded',
		'5555'  =>  'Link Expired');
		if (array_key_exists($ercode, $error)) {
		return $error[$err] ;}else{ 
		return 'success'; }
	}
         public static function  checkout($data)
 		{

			$json['Posted']=$data;
			$json['Customer_Id']=1;
			$json['Created_Date']=date('Y-m-d H:i:s');
			$json['Patner_Id']=1;
			$json['API_Type']='funcinemas';
			$json['movie']=$data['Movie'];
			$json['center']=$data['Center'];
			$json['showTime']=$data['ShowTime'];
			$json['finishTime']=$data['FinishTime'];
			$json['class']=$data['Class'];
			$test =json_encode($json);
			$save['input']=$test;
			$save['order_id']='';
			$json['api_pid'] = Checkoutmodel::do_checkout($save);

			$ticket['quantity']=$data['QTY'];

			//cart description
			$ticket['description']='<b>Movie Name:</b> '.$data['Movie'].' , <b>Center Name:</b> '.$data['Center'].' , <b>Show Time: </b>'.($data['ShowTime'].' End Time:'.$data['FinishTime']).' , <b>Class:</b> '.$data['Class'];
			$ticket['json']=$json;
		
			return $ticket;


		}



}
