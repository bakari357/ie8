<?php 

class Hdfcpayment extends BaseController {
		


  public function __construct()
		{	
		   $this->pg_active=Config::get('pg_settings.active');


		}

  public function hdfc_do(){
    

		$p_data=Session::get('ptype');
		$data=Checkouthelper::payament_process($p_data,$this->pg_active);
		
	//storing for pg response
		$pg['order_id']=$data['order_number'];
        	$pg_reponse=DB::table('pg_response')->insertGetId($pg);
		
		if(empty($data['contents']))
		{
		Redirect::to('cart/view_cart');
		} 
			
			$TranTrackid = $data['order_number'];;

			$TranAmount=$data['custom_cash'];
						
			$email=$data['email'];


			/* to pass Tranportal ID provided by the bank to merchant. Tranportal ID is sensitive information
			of merchant from the bank, merchant MUST ensure that Tranportal ID is never passed to customer 
			browser by any means. Merchant MUST ensure that Tranportal ID is stored in secure environment & 
			securely at merchant end. Tranportal Id is referred as id. Tranportal ID for test and production will be 
			different, please contact bank for test and production Tranportal ID*/
			$ReqTranportalId="id=".$data['pg_setup']['tid'];

			/* to pass Tranportal password provided by the bank to merchant. Tranportal password is sensitive 
			information of merchant from the bank, merchant MUST ensure that Tranportal password is never passed 
			to customer browser by any means. Merchant MUST ensure that Tranportal password is stored in secure 
			environment & securely at merchant end. Tranportal password is referred as password. Tranportal 
			password for test and production will be different, please contact bank for test and production
			Tranportal password */
			$ReqTranportalPassword="password=".$data['pg_setup']['password'];

			/* Action Code of the transaction, this refers to type of transaction. Action Code 1 stands of 
			Purchase transaction and action code 4 stands for Authorization (pre-auth). Merchant should 
			confirm from Bank action code enabled for the merchant by the bank*/ 
			$ReqAction="action=1";

			/* Transaction language, THIS MUST BE ALWAYS USA. */


			$ReqLangid="langid=USA";

			/* Currency code of the transaction. By default INR i.e. 356 is configured. If merchant wishes 
			to do multiple currency code transaction, merchant needs to check with bank team on the available 
			currency code */


			$ReqCurrency="currencycode=356";

			/* Transaction Amount that will be send to payment gateway by merchant for processing
			NOTE - Merchant MUST ensure amount is sent from merchant back-end system like database
			and not from customer browser. In below sample AMT is hard-coded, merchant to pass 
			trasnaction amount here. */
			$ReqAmount="amt=".$TranAmount;

			/* Response URL where Payment gateway will send response once transaction processing is completed 
			Merchant MUST esure that below points in Response URL
			1- Response URL must start with http://
			2- the Response URL SHOULD NOT have any additional paramteres or query string */ 
			$ReqResponseUrl="responseURL=http://202.140.38.73/smartbuy_new/public/pgResponse";

			/* Error URL where Payment gateway will send response in case any issues while processing the transaction 
			Merchant MUST esure that below points in ErrorURL 
			1- error url must start with http://
			2- the error url SHOULD NOT have any additional paramteres or query string
			*/ 
			$ReqErrorUrl="errorURL=http://202.140.38.73/smartbuy_new/public/capture_errors";
			

			/* To pass the merchant track id, in below sample merchant track id is hard-coded. Merchant
			MUST pass his transaction ID (track ID) in this parameter. Track Id passed here should be 
			from merchant backend system like database and not from customer browser*/
			$ReqTrackId="trackid=".$TranTrackid;

			/* User Defined Fileds as per Merchant or bank requirment. Merchant MUST ensure merchant 
			merchant is not passing junk values OR CRLF in any of the UDF. In below sample UDF values 
			are not utilized */
			$ReqUdf1="udf1=".$email;
			if($p_data['ptype']==1)
			{
				$ReqUdf2="udf2=PG";
				$ReqUdf3="udf3=Nil";
				
			}
			else
			{	
			    $ReqUdf2="udf2=EMI";
			    $ReqUdf3="udf3=".(int)$p_data['emi_optn'];
			    
			}
			
			$ReqUdf4="udf4=Nil";
			/*
			ME should now do the validations on the amount value set like - 
			a) Transaction Amount should not be blank and should be only numeric
			b) Language should always be USA
			c) Action Code should not be blank
			d) UDF values should not have junk values and CRLF (line terminating parameters)Like--> [ !#$%^&*()+[]\\\';,{}|\":<>?~` ]
			*/
/*==============================HASHING LOGIC CODE START==============================================*/
	/*Below are the fields/prametres which will use for hashing using (GetSHA256) hashing 
	Algorithm,and need to pass same hashed valued in UDF5 filed only*/
	
	$strhashTID=trim($data['pg_setup']['tid']); 			 //USE Tranportal ID FIELD Value FOR HASHING 
	$strhashtrackid=trim($TranTrackid);	 //USE Trackid FIELD Value FOR HASHING 
	$strhashamt=trim($TranAmount);  		 //USE Amount FIELD Value FOR HASHING 
	$strhashcurrency=trim("356");			 //USE Currencycode FIELD Value FOR HASHING 
	$strhashaction=trim("1");				 //USE Action code FIELD Value FOR HASHING 
	
	//Create a Hashing String to Hash
	$str = trim($strhashTID.$strhashtrackid.$strhashamt.$strhashcurrency.$strhashaction);

	
	
	
	
	//Use hash method which is defined below for Hashing ,It will return Hashed valued of above string
	$hashstring= hash('sha256', $str); 


	Log::info('smartbuy|PG_Request|'.$str.'|'.$hashstring);

	
	$pgh = DB::table('pg_hash')->insertGetId(array("hash1"=>$hashstring));
	$ReqUdf5="udf5=".$hashstring;      // Passed Calculated Hashed Value in UDF5 Field 
	
/*==============================HASHING LOGIC CODE END==============================================*/		



			/* Now merchant sets all the inputs in one string for passing to the Payment Gateway URL */		
			//$param=$id."&".$password."&".$action."&".$langid."&".$currencycode."&".$amt."&".$responseURL."&".$errorURL."&".$trackid."&".$udf1."&".$udf2."&".$udf3."&".$udf4."&".$udf5;


$param=$ReqTranportalId."&".$ReqTranportalPassword."&".$ReqAction."&".$ReqLangid."&".$ReqCurrency."&".$ReqAmount."&".$ReqResponseUrl."&".$ReqErrorUrl."&".$ReqTrackId."&".$ReqUdf1."&".$ReqUdf2."&".$ReqUdf3."&".$ReqUdf4."&".$ReqUdf5;

			/* This is Payment Gateway Test URL where merchant sends request. This is test enviornment URL, 
			production URL will be different and will be shared by Bank during production movement */
			$url = Config::get('pg_settings.'.$this->pg_active.'.url');
			

			//echo $url; exit;

			
			//echo '<pre>';
			//print_r($param);
			//exit;

			/* 
			Log the complete request in the log file for future reference
			Now creating a connection and sending request
			Note - In PHP CURL function is used for sending TCPIP request
			*/
			$ch = curl_init() or die(curl_error()); 
			curl_setopt($ch, CURLOPT_POST,1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS,$param); 
			curl_setopt($ch, CURLOPT_PORT, 443); // port 443
			curl_setopt($ch, CURLOPT_URL,$url);// here the request is sent to payment gateway 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0); //create a SSL connection object server-to-server
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0); 
			curl_setopt($ch,CURLOPT_TIMEOUT,30);
			$data1=curl_exec($ch);
			$error=curl_error($ch);
			curl_close($ch); 


			 $response = $data1;
			
			//print_r($response);
			//exit;
			//track request and response for PG send request
				$pg=array();
				$pg['order_id']=$TranTrackid;
				$pg['url']=$url;
				$pg['param']=$param;
				$pg['send_req_response']=$response;
		
		
		
            		try
			{
				
				
				$index=strpos($response,"!-");
				$ErrorCheck=substr($response, 1, $index-1);//This line will find Error Keyword in response
				
				if($ErrorCheck == 'ERROR' || !empty($error))//This block will check for Error in response
				{
				     $failedurl=URL::to('capture_errors');
				     return Redirect::to($failedurl);
				}
				else
				{

					
				$filter='/^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/';
					// If Payment Gateway response has Payment ID & Pay page URL		
					$i =  strpos($response,":");
					// Merchant MUST map (update) the Payment ID received with the merchant Track Id in his database at this place.
					$paymentId = substr($response, 0, $i);
					$paymentPage = substr( $response, $i + 1);
					// here redirecting the customer browser from ME site to Payment Gateway Page with the Payment ID
					$r = $paymentPage . "?PaymentID=" . $paymentId;
					if(preg_match($filter, $paymentPage))
					{
						
					        return Redirect::to($r);
					}
					else
					{
					        $failedurl=URL::to('capture_errors');
						return Redirect::to($failedurl);
					}
				}
				
				
							
			}
			catch(Exception $e)
			{
				var_dump($e->getMessage());
			}
}
   public function gethandleresponse(){

      		$cap_response=json_encode($_POST);
		$pg_save=array();
		$pg_save['handle_response']=$cap_response;
		$pg = DB::table('pg_track')->insertGetId(array("response"=>$cap_response,"ip"=>getenv('REMOTE_ADDR')));
        
		
        try
	{

	//capture the response to mongo
		$cap_response=json_encode($_POST);
		$pg_save=array();
		$pg_save['handle_response']=$cap_response;
		$pg = DB::table('pg_track')->insertGetId(array("response"=>$cap_response,"ip"=>getenv('REMOTE_ADDR')));
		
		
	/* Capture the IP Address from where the response has been received */
		$strResponseIPAdd = getenv('REMOTE_ADDR');
		$ResTrackID = isset($_POST['trackid']) ? $_POST['trackid'] : ''; 
		$ResAmount = isset($_POST['amt']) ? $_POST['amt'] : ''; 
		$ResErrorText= isset($_POST['ErrorText']) ? $_POST['ErrorText'] : '';  

	/* Check whether the IP Address from where response is received is PG IP */
	if($strResponseIPAdd == "221.134.101.175" || $strResponseIPAdd == "221.134.101.187" || $strResponseIPAdd == "221.134.101.169")
	{

	//====================================================================================================================================	
		$ResErrorText= isset($_POST['ErrorText']) ? $_POST['ErrorText'] : ''; 	//Error Text/message
		$ResPaymentId = isset($_POST['paymentid']) ? $_POST['paymentid'] : '';	//Payment Id
		$ResTrackID = isset($_POST['trackid']) ? $_POST['trackid'] : '';        //Merchant Track ID
		$ResErrorNo = isset($_POST['Error']) ? $_POST['Error'] : '';            //Error Number

		//To collect transaction result
		$ResResult = isset($_POST['result']) ? $_POST['result'] : '';           //Transaction Result
		$ResPosdate = isset($_POST['postdate']) ? $_POST['postdate'] : '';      //Postdate
		//To collect Payment Gateway Transaction ID, this value will be used in dual verification request
		$ResTranId = isset($_POST['tranid']) ? $_POST['tranid'] : '';           //Transaction ID
		$ResAuth = isset($_POST['auth']) ? $_POST['auth'] : '';                 //Auth Code		
		$ResAVR = isset($_POST['avr']) ? $_POST['avr'] : '';                    //TRANSACTION avr					
		$ResRef = isset($_POST['ref']) ? $_POST['ref'] : '';                    //Reference Number also called Seq Number
		//To collect amount from response
		$ResAmount = isset($_POST['amt']) ? $_POST['amt'] : '';                 //Transaction Amount

		$Resudf1 = isset($_POST['udf1']) ? $_POST['udf1'] : '';                  //UDF1
		$Resudf2 = isset($_POST['udf2']) ? $_POST['udf2'] : '';                  //UDF2
		$Resudf3 = isset($_POST['udf3']) ? $_POST['udf3'] : '';                  //UDF3
		$Resudf4 = isset($_POST['udf4']) ? $_POST['udf4'] : '';                  //UDF4
		$Resudf5 = isset($_POST['udf5']) ? $_POST['udf5'] : '';                  //UDF5
					
	
		//LIST OF PARAMETERS RECEIVED BY MERCHANT FROM PAYMENT GATEWAY ENDS HERE 
	//====================================================================================================================================	
              
	/* Merchant (ME) checks, if error number is NOT present, then create Dual Verification 
	request, send to Paymnent Gateway. ME SHOULD ONLY USE PAYMENT GATEWAY TRAN ID FOR DUAL
	VERIFICATION */
    /* NOTE - MERCHANT MUST LOG THE RESPONSE RECEIVED IN LOGS AS PER BEST PRACTICE */

		if ($ResErrorNo == '')
		{
			 
			 /*******************HASHING CODE LOGIC START************************************/
					/*IMP NOTE: For Hashing below listed parameters have been used. In case merchant develops 
					his/her own pages, merchant to 		make note of these parameters to ensure hashing 
					logic remains same.
					Tranportal ID, TrackID, Amount, Result, Payment ID, Reference Number, Auth Code, Transaction ID 
				
					If any Hashing parameters is null of blank then merchant need to exclude those parameters 
					from hashing*/					
									
					/*
					USE Tranportal ID FIELD as one parameter for hashing.
					Tranportal ID is a sensitive parameter, Merchant can store the Tranportal ID field in 
					database as well in page as config value. We recommend merchant storing this parameter 
					in database and then calling from database.
					*/
					// get the pg keys
						
					$pg_setup=Checkouthelper::pg_keys($Resudf2,$Resudf3,$this->pg_active);
					
					
					$strHashTraportalID=trim($pg_setup['tid']); //USE Tranportal ID FIELD FOR HASHING ,Mercahnt need to take this filed value  from his Secure channel such as DATABASE.
					//$strhashstring="";            //Declaration of Hashing String 
					
					$strhashstring=trim($strHashTraportalID);
					
					//Below code creates the Hashing String also it will check NULL and Blank parmeters and exclude from the hashing string
					if ($ResTrackID != '' && $ResTrackID != null )
					$strhashstring=trim($strhashstring).trim($ResTrackID);					
					if ($ResAmount != '' && $ResAmount != null )
					$strhashstring=trim($strhashstring).trim($ResAmount);					
					if ($ResResult != '' && $ResResult != null )
					$strhashstring=trim($strhashstring).trim($ResResult);					
					if ($ResPaymentId != '' && $ResPaymentId != null )
					$strhashstring=trim($strhashstring).trim($ResPaymentId);					
					if ($ResRef != '' && $ResRef != null )
					$strhashstring=trim($strhashstring).trim($ResRef);					
					if ($ResAuth != '' && $ResAuth != null )
					$strhashstring=trim($strhashstring).trim($ResAuth);					
					if ($ResTranId != '' && $ResTranId != null )
					$strhashstring=trim($strhashstring).trim($ResTranId);					
										
			//Use sha256 method which is defined below for Hashing ,It will return Hashed valued of above strin				
				$hashvalue= hash('sha256', $strhashstring); 
				Log::info('smartbuy|PG_response|'.$strhashstring.'|'.$hashvalue);
										
		

			//$phashed = DB::table('pg_hash_verfy')->insertGetId(array("hash"=>$hashvalue,'udf5'=>$Resudf5));
					
					
					/*******************HASHING CODE LOGIC END************************************/
				if ($hashvalue == $Resudf5)
					{
					/* NOTE - MERCHANT MUST LOG THE RESPONSE RECEIVED IN LOGS AS PER BEST PRACTICE */
					/*IMPORTANT NOTE - MERCHANT DOES RESPONSE HANDLING AND VALIDATIONS OF 
					TRACK ID, AMOUNT AT THIS PLACE. THEN ONLY MERCHANT SHOULD UPDATE 
					TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
					AND THEN REDIRECT CUSTOMER ON RESULT PAGE*/

					/* !!IMPORTANT INFORMATION!!
					During redirection, ME can pass the values as per ME requirement.
					NOTE: NO PROCESSING should be done on the RESULT PAGE basis of values passed in the RESULT PAGE from this page. 
					ME does all validations on the responseURL page and then redirects the customer to RESULT PAGE ONLY FOR RECEIPT PRESENTATION/TRANSACTION STATUS CONFIRMATION
					For demonstration purpose the result and track id are passed to Result page	*/
					
					/* Hashing Response Successful	*/
									
		$REDIRECT = 'REDIRECT=http://202.140.38.73/smartbuy_new/public/payment_checkout?data='.base64_encode('ResResult='.$ResResult.'&ResTrackId='.$ResTrackID.'&ResAmount='.$ResAmount.'&ResPaymentId='.$ResPaymentId.'&ResRef='.$ResRef.'&ResTranId='.$ResTranId.'&ResAuth='.$ResAuth.'&ResError='.$ResErrorText.'Hashing Response Successful&Udf1='.$Resudf1.'&Udf2='.$Resudf2.'&Udf5='.$Resudf5);
						echo $REDIRECT;
					}
					else
					{		
					/* NOTE - MERCHANT MUST LOG THE RESPONSE RECEIVED IN LOGS AS PER BEST PRACTICE */
					/*Udf5 field values not matched with calculetd hashed valued then show appropriate message to
					Mercahnt for E.g.Hashing Response NOT Successful*/

					/* Hashing Response NOT Successful */

			Log::info('smartbuy|PG_response|Hashing Response Mismatch'.$hashvalue.'|'.$Resudf5);
			$REDIRECT = 'REDIRECT=http://202.140.38.73/smartbuy_new/public/capture_errors?ResError=Hashing Response Mismatch';
		       	echo $REDIRECT;														
					

					}
		
	
				}
	
			}
		else{

				Log::info('smartbuy|PG_response|IP Response Mismatch');
				$REDIRECT = 'REDIRECT=http://202.140.38.73/smartbuy_new/public/capture_errors?ResError=--IP MISSMATCH-- Response IP Address is: '.$strResponseIPAdd;
			echo $REDIRECT;


		    }


	}


catch(Exception $e)
{
	var_dump($e->getMessage());
}



}

	  function capture_errors()
	  {
		$ip=getenv('REMOTE_ADDR');
		$data['bread_crumb']=array('Home'=>'/');
		return $this->render_reward_theme('checkout.pg_expired',$data);
	  }


	 function paymentinfo()
	 {
		
		
		if(!empty($_GET['data']))
		{
		    
		    $data=explode('&',base64_decode($_GET['data']));
			foreach($data as $row)
			{
				$row_data=explode('=',$row);
				$payment_info[$row_data[0]]=$row_data[1];

			}
			
		    return $this->load_admin_theme('payment','payment_info',array('data'=>$payment_info)); 
		}else{
		      return $this->load_admin_theme('payment','payment_info',array('data'=>$data))
		      ->with('danger', 'Error Occured while processing your request');
		     }
	
	}

	function payment_checkout()
	 {

		 if (Cart::count() == 0){
                
                     return Redirect::to('cart_expired');
                }
		
		$data['pmethod']= '';
		$decode=base64_decode($_GET['data']);
		$explodeed= explode("&",$decode);


				
		foreach($explodeed as $key=>$value)
		{
			$values= explode("=",$value);
			if(isset($values[1]))
			$val=$values[1];
			else
			$val='';
			$response[$values[0]]=$val;
		}
		$response['active']=$this->pg_active;

			
		$pg_reponse['reponse']=json_encode($explodeed);
		$res=DB::table('pg_response')->where('order_id',$response['ResTrackId'])->update($pg_reponse);


		//$res=DB::table('orders')->where('order_number',$response['ResTrackId'])->first();
		$res=DB::table('orders')->where('order_number',$response['ResTrackId'])->first();
		
		
		if(empty($res))
		{
			echo "orderId doesnt exist";

	        }
		else
		{
			$order_id=(int)$res->id;
		}
		
		
		$data=Paymenthelper::payment_process($response);
		
	
		// $order_id=Ordermodel::update_order($data);
		 $contents=Cart::content();
		
		$Resrefernece=$data['ResRef'];

		
		$orderdata=Cartlibrary::save_digital_order($order_id,true,$data['status'],$Resrefernece);
		$exprod=Ordermodel::get_extended_products($order_id);
		 foreach($contents as $key=>$product)
       		 {
			
		    $api_type=$product['options']['apiproduct']['API_Type'];
		   
			switch($api_type)
			{
				case 'Hungama':
				
				  $data['download_section']="";
				  $data['status'] = 'Failed';	
				  
					if(!empty($exprod))
					{
					$resu=json_decode($exprod['output']);
					$res=json_decode($exprod['input']);
					$data['input']=$res;
					$data['music']=explode('|',base64_decode($res->Posted->music_details));
					}
					$data['order_number']= $orderdata;
				if(isset($resu->Output->result->response->code) && $resu->Output->result->response->code==1)
					{
						if(isset($resu->Output->result->response->url))
						$data['download_section']=$resu->Output->result->response->url;
						$data['status'] = 'Successful';
					}
					
					$view = 'checkout.music_placed'; 
				break;

				case 'hotels':
					$data['order_number']=$orderdata;
					$val=json_decode($exprod['input']);
					$data['input']=$val;
					$data['values'] = (array)$val->Posted;
					$data['rm_details'] = array();
					$response=json_decode($exprod['output']);
					$data['status'] = 'Failed';
					if(isset($response->booking_id)){
					$data['status'] = 'Successful';
					$data['rm_details'] = Xml2array::toArray($response->booking_id);
					
					}
					
					
					$view = 'checkout.hotel_placed'; 
				

				break;


				case 'cleartrip':
					$data['order_number']=$orderdata;
					$val=json_decode($exprod['input']);
					$data['input']=$val;
					$data['values'] = (array)$val->Posted;
					$data['rm_details'] = array();
					$response=json_decode($exprod['output']);
					$data['status'] = 'Failed';
					if(isset($response->booking_id)){
					$hotel_details = Xml2array::toArray($response->booking_id);
					$details=Hotel::Hotel_clr_inter($hotel_details['book-response']['booking-id']);
					$hotels_d=Xml2array::toArray($details);
					$post=Xml2array::toArray($data['input']);
					}
					$data['status'] = $response->status;
					$data['details'] = array(); 
					if(isset($hotels_d['itinerary']['trip-ref'])){
					$data['status'] = 'Successful';
					$data['details']=$hotels_d;
					
					}
					
					
					$view = 'checkout.hotel_clr_placed'; 
				

				break;

				case 'recharge' :

						$data['values'] = $exprod['output'];
						$data['input']=json_decode($exprod['input']);
						$response[]=json_decode($exprod['output']);
						$oper = $data['input']->Posted->operator;
						$operator = DB::Select(DB::RAW("select operator from pp_myoxi_operators where abbr='".$oper."'"));

						$data['operator']=@$operator[0]->operator;
						$data['recharge_details']= $response;
						$post = $data['input']->Posted;
						
						$rm_details=$data['recharge_details'];
						$data['order_number'] = $res->order_number; 
						$data['post']=array_merge($data,(array)($post));
						$recharge_result =  explode('~',$rm_details[0]->Response);
						if(isset($recharge_result[6]) && $recharge_result[6] =="Y") {$data['status'] = 'Successful'; }
						else { $data['status'] = 'Failed'; }
						
						$view = 'checkout.recharge_placed';

					break ;

					case 'cinepolis' :
								$val=json_decode($exprod['input']);
								$data['input']=$val;
								$data['values'] = (array)$val->Posted;
								$data['order_details'] = $res; 
								$data['order_number'] = $res->order_number; 
								 $data['input']->Posted->partner = 'Cinepolis';
								$data['output']=json_decode($exprod['output']);
								$data['status'] = 'Failed';
								$view = 'checkout.cinepolis_placed';
					break;
					
					case 'funcinemas' :
								$val=json_decode($exprod['input']);
								$data['input']=$val;
								$data['values'] = (array)$val->Posted;
								$data['order_details'] = $res; 
								$data['order_number'] = $res->order_number; 
								 $data['input']->Posted->partner = 'Funcinemas';
								$data['output']=json_decode($exprod['output']);
								$data['status'] = 'Failed';
								$view = 'checkout.order_placed';
					break;
					
					case 'Cleartrip_flights' ;
								$data['output']=json_decode($exprod['output']);
								//echo '<pre>'; print_r($data['output']); exit;
								$data['xml_array']= Xml2array::xml2array_test(urldecode($data['output']->booking_data));
								$data['status'] = 'Failed';
								  if(isset($data['xml_array']['book-response']['trip-id']) && $data['xml_array']['book-response']['trip-id']<>'')
                                                         {
                                                         $data['status'] = 'Successful';
                                                         }
                                  $val=json_decode($exprod['input']);
  							      $data['input']=$val;
								  $val=(array)$data['input'];
                                  $data['post'] = (array)$val['Posted'];
                               $data['order_number'] = $res->order_number; 
								if(isset($data['input']->Posted->type) && $data['input']->Posted->type=='R')
								       	 {
								        $view = 'goibibo.booking_summary_round';
								        }
								        else
								        {
								        $view = 'goibibo.booking_summary';
								        }
					break;
					
				    case 'goibibo_flights' ;
					
				 //   $orderdata=Cartlibrary::save_digital_order($order_id,true,$data['status'],$Resrefernece);
                                    $exist=array('order_id'=>(int)($order_id));
                                    
                                    $condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);
                                    
                                    foreach($condrestwo as $condrestw){
                                    
                                   
                                    $response=json_decode($condrestw['output']);
                                    
                                    
                                    //$data['status']="Failed";
                                    //$response. =json_decode(urldecode($val->Posted->booking_data));
                                    
                                    
                                    $val=json_decode($condrestw['input']);
                                    
                                   //echo "<pre>";print_r($response);exit;
                                    $data['response']=$response;
                                    if(isset(json_decode($response->booking_data)->data['0']->bookingid) && isset(json_decode($response->booking_data)->data['0']->bookingid)<>'')
                                    {
                                    $data['rules']=Viaflight::fare_rules_goibibo(json_decode($response->booking_data)->data['0']->bookingid); 
                                    $data['status']="Successful"; 
                                    $data['booking_id']=json_decode($response->booking_data)->data['0']->bookingid;
                                    
                                    }
                                    else
                                    {
                                     $data['status']="Failed";
                                    
                                    }
                                    
  				    $data['input']=$val;
                                    $data['post']=(array)$val->Posted;
                                    $data['book_passenger']=$val->Posted->book_passenger;    


                                    
                                    $val=Xml2array::toArray(json_decode($condrestw['input']));


                                    $data['post'] = $val['Posted'];
                                     $data['order_number'] = $res->order_number; 
                                    //$data['flight_details']=$flight_details= json_decode(urldecode($data['post']['details_checkout']));
                                    $data['bread_crumb']=array('Home'=>'/');
                                    if(isset($val['Posted']['type']) && $val['Posted']['type']=='R')
                                    {
                                    $view = 'goibibo.booking_summary_round';
                                    }
                                    else
                                    {
                                    $view = 'goibibo.booking_summary';
                                    }
                                    
                                    }
					break;

			}
			
			
			Hdfcpayment::Mailing($data);
			$data['bread_crumb']=array('Home'=>'/');
                        $data['css_array'] = array('frontend_left/layout/css/style.css','frontend_left/pages/css/style-shop.css','frontend_left/layout/css/style-responsive.css','frontend_left/layout/css/custom.css');
                        $data['js_array'] = array('frontend_left/layout/scripts/back-to-top.js','global/plugins/jquery-slimscroll/jquery.slimscroll.min.js','frontend_left/layout/scripts/layout.js','frontend_left/pages/scripts/checkout.js');
			return $this->render_reward_theme($view,$data);
		 }

}

		public function Mailing($data){
					
					if($data['status']=='Successful'){
						  foreach (Cart::content() as $key=>$item){
                                                    $saved_amount = @ $item['options']['offer_amount'];
                                                  }
						 }
					
  					$mail = $data;
  					//echo '<pre>'; print_r($data); exit;
					$replace['{{project}}'] = 'HDFC Bank SmartBuy';
					$replace['{{bank}}'] = 'HDFC Bank'; 
					$replace['{{customer}}'] = $data['input']->Posted->first_name .' '.$data['input']->Posted->last_name;
					$replace['{{email}}'] = $data['input']->Posted->s_email; 
					$replace['{{support}}'] = 'support@smartbuy.com'; 
					$replace['{{call_support}}'] ='1860 425 3322'; 
					$offer_amount =  isset($saved_amount) ? $saved_amount : ''  ;
					$header_footer = Emailhelper::header($data);
					
					
					
				switch($data['input']->API_Type)
					{
						case 'Hungama':	
						
						 $content = Emailhelper::hungama($data,$offer_amount); 
						 $information = Emailhelper::alert_information('music');
						 $replace['{{type}}'] = 'Music';
						 $replace['{{partner}}'] = 'Hungama';
						 $mail['subject'] = 'Music Download';
						break;

						case 'funcinemas':
						
						$content = Emailhelper::funcinemas($data,$offer_amount);
						 $information = Emailhelper::alert_information('movies'); 
						 $replace['{{type}}'] = 'Movie';
						  $replace['{{partner}}'] = 'Funcinemas';
						 $mail['subject'] = 'Movie Ticket';
						break;
						case 'cinepolis':
						 $content = Emailhelper::cinepolis($data,$offer_amount); 
						  $information = Emailhelper::alert_information('movies');
						 $replace['{{type}}'] = 'Movie';
						  $replace['{{partner}}'] = 'Cinepolis';
						 $mail['subject'] = 'Movie Ticket';
						break;
						
						case 'hotels':
						
						 $content = Emailhelper::hotels($data,$offer_amount); 
						  $information = Emailhelper::alert_information('hotels');
						 $replace['{{type}}'] = 'Hotel';
						  $replace['{{partner}}'] = 'Expedia';
						 $mail['subject'] = 'Hotel Booking';
						break;
			
						case 'cleartrip':
						 $content = Emailhelper::cleartrip_hotels($data,$offer_amount); 
						  $information = Emailhelper::alert_information('hotels_cleartrip');
						 $replace['{{type}}'] = 'Hotel';
						  $replace['{{partner}}'] = 'Cleartrip';
						 $mail['subject'] = 'Hotel Booking';
						break;

						case 'recharge':
						 $content = Emailhelper::recharge($data,$offer_amount); 
						  $information = Emailhelper::alert_information('recharge');
						 $replace['{{type}}'] = 'Recharge/Bill Payments';
						  $replace['{{partner}}'] = 'Billdesk';
						 $mail['subject'] = 'Recharge/Bill Payments';
						break;

						case 'Cleartrip_flights':
						 $content = Emailhelper::cleartrip_flights($data,$offer_amount); 
						  $information = Emailhelper::alert_information('flights');
						 $replace['{{type}}'] = 'Air ticket';
						  $replace['{{partner}}'] = 'Cleartrip';
  $replace['{{partner_contact}}']='Cleartrip at agencysupport@cleartrip.com, 1860 233 5000 and +91 22 40554955';
						 $mail['subject'] = 'Air Ticket';
						break;

						  case 'goibibo_flights':
                                                 
						$content = Emailhelper::goibibo_flights($data,$offer_amount); 
						$information = Emailhelper::alert_information('flights');
						$replace['{{type}}'] = 'Air ticket';
						$replace['{{partner}}'] = 'Goibibo';
						$replace['{{partner_contact}}']='Goibibo at support@goibibo.com and 1800-000-000';
						$mail['subject'] = 'Air Ticket';
						 
						break; 
  					}
  			
						if($data['status'] <> 'Successful'){
  						     $information = '';
  						}		
 					
  			$main_content = $header_footer['header'].''.$header_footer['message'].''.$content.''.$information.' '.$header_footer['footer'];
  					
  					foreach($replace as $rep => $with ){
  					
  						$main_content = str_replace($rep,$with,$main_content);
  					}
						$message="Email";
						$code = $main_content;
						//echo '<pre>'; echo $code; exit;
						
						Mail::send('emails.common_mail', compact('code'), function($message) use ($mail)
						{
						$message->to($mail['input']->Posted->s_email)->subject($mail['subject']);
						//$message->to('sharath@reward360.co')->subject($mail['subject']);
						}); 
					
						$customer = Session::get('customer_data');
						if(isset($customer->b_type) && $customer->b_type ==2){
						Session::forget('customer_data');
  						}
					

  				}
	




	

}
					
