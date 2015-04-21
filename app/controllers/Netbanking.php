<?php 

class Netbanking extends BaseController {
		
	public function __construct()
		{	


				   $this->nb_active=Config::get('nb_settings.active');
 			$contents=Cart::content();
				
			 foreach($contents as $key=>$product)
       		 	{
				$uinput=$product['options']['apiproduct']['Posted'];
			$m_array=array('fname'=>'sivaranjani','lname'=>'p','email'=>'sivaranjani.p@reward360.co','fone'=>'9008219083');	
				$p_array=array('fname'=>$uinput['first_name'],'lname'=>$uinput['last_name'],'email'=>$uinput['s_email'],'fone'=>$uinput['mobile']);
				$verify=(count(array_diff($m_array, $p_array)) === 0);

				
				if($verify)
				{
				   $this->nb_active='production';
				}

			


			}
	


		}



	public function online_banking()
	{
		
		$data=Checkouthelper::payament_process(2);
		$time_stamp=date("d/m/Y H:i:s", time());
		$ckey=Config::get('nb_settings.'.$this->nb_active.'.ckey');

	         $net_params=array(
			 'ClientCode'=>Config::get('nb_settings.'.$this->nb_active.'.c_code'),
			 'MerchantCode'=>Config::get('nb_settings.'.$this->nb_active.'.m_code'),
			 'TxnCurrency'=>Config::get('nb_settings.'.$this->nb_active.'.currency'),
			 'TxnAmount'=>$data['custom_cash'],
			 'TxnScAmount'=>0,
			 'MerchantRefNo'=>$data['order_number'],
			 'SuccessStaticFlag'=>'N',
			 'FailureStaticFlag'=>'N',
			 'Date'=>$time_stamp,
			 'Ref1'=>$data['email'],
			 'Ref2'=>'NB',
			 'Ref3'=>'',
			 'Ref4'=>'',
			 'Ref5'=>'',
			 'Ref6'=>'',
			 'Ref7'=>'',
			 'Ref8'=>'',
			 'Ref9'=>'',
			 'Ref10'=>'',
                         'Ref11'=>'',
			 'Ref12'=>'',
			 'Date1'=>'',
			 'Date2'=>'',
			 'DynamicUrl'=>Config::get('nb_settings.'.$this->nb_active.'.durl'),
			 );
	                 $url=Config::get('nb_settings.'.$this->nb_active.'.url');
			
			$str="";
			$gen_str="";
			$i=1;
			$net_count=count($net_params);
				foreach($net_params as $nrow=>$value)
				{
					if($nrow=='Date')
					$str.=$nrow.'='.str_replace(' ','%20',$value);	
					else
					$str.=$nrow.'='.$value;	

					if($i!=$net_count)
					$str.='&';
					
					

					$gen_str.=$value;

					$i++;
				}
			
			$f_str=$gen_str.$ckey;	
			

			
			$checksum =crc32($f_str);
			if (0 > $checksum)
			{
			//Implicitly casts i as float, and corrects this sign.
			$checksum += 0x100000000;
			}
			$final=$url.$str.'&CheckSum='.$checksum;
			Log::info('smartbuy|Netbnking|1|'.$_SERVER['REMOTE_ADDR'].'|'.$final);
				
		  


	
			return Redirect::to($final);
	         

	}


	public function payment_data()
	{
			
		$url=Config::get('nb_settings.'.$this->nb_active.'.vurl');
		/*$_POST=array ('MerchRefNo' =>'R3601234567','TxnAmount' =>'100.00','TxnCurrency' => 'INR',
		              'ClientCode' => 'REWARDS360', 'TxnScAmount' =>'0.00' ,'CheckSum'=>'2996428715',
			      'BankRefNo' => '814155508' ,'MerchantCode'=>'REWARDS36',
			      'Date'=>'08/14/2014 15:56:51' ,'StFailFlg' =>'N',
			      'StSucFlg'=> 'N' ,'Message' =>'', 'fldSessionNbr' => 5 ) ;*/
		$ckey=Config::get('nb_settings.'.$this->nb_active.'.ckey');
		$time_stamp=date("d/m/Y H:i:s", time());
		$net_params=array(
			           'ClientCode'=>$_POST['ClientCode'],
			           'MerchantCode'=>$_POST['MerchantCode'],
				   'TxnAmount'=>$_POST['TxnAmount'],
				   'MerchantRefNo'=>$_POST['MerchRefNo'],
				   'TransactionId'=>'XTXTV01',
				   'FlgVerify'=>'Y',
				   'SuccessStaticFlag'=>$_POST['StSucFlg'],
			 	   'FailureStaticFlag'=>$_POST['StFailFlg'],
			 	   'Date'=>str_replace(' ','%20',date('d/m/Y H:i:s',strtotime($_POST['Date']))),
				   'Ref1'=>'',
				   'B1'=>'Submit'
				 );

			
		        $str="";
			$gen_str="";
			$i=1;
			$net_count=count($net_params);
				foreach($net_params as $nrow=>$value)
				{
				
					$str.=$nrow.'='.$value;	

					if($i!=$net_count)
					$str.='&';
					
					

					$gen_str.=$value;

					$i++;
				}
			
			$f_str=$gen_str.$ckey;	
			$checksum =crc32($f_str);
			$final=$url.$str;
			
			Log::info($final);
			$obj= new Curl;
			$response=$obj->simple_get($final);
			
			$response1=strip_tags($response);
			$rdata=explode('//',$response1);
			$rurl='http://'.$rdata[1];
			$parts = parse_url($rurl);
			parse_str($parts['query'], $query);
			$verify=$query['flgSuccess'];
			Log::info('NB|verifyresponse|'.$verify);
			if($verify=='S')
			{
			    $status='Aprroved';
			  
	$REDIRECT = 'http://202.140.38.73/smartbuy_new/public/payment_checkout?data='.base64_encode('Message=Transaction Successful&ResTrackId='.$net_params['MerchantRefNo'].'&ResAmount='.$net_params['TxnAmount'].'&ResError='.$_POST['Message'].'&Udf1=&Udf2=NB');
				

			   

			}
			else	
			{
				$REDIRECT = 'http://202.140.38.73/smartbuy_new/public/payment_checkout?data='.base64_encode('Message=Transaction Declined&ResTrackId='.$net_params['MerchantRefNo'].'&ResAmount='.$net_params['TxnAmount'].'&ResError='.$_POST['Message'].'&Udf1=&Udf2=NB');
			


			}
			
			
			  return Redirect::to($REDIRECT);
	


	}


	function entry()
	{

		print_r($_POST);


		print_r($_GET);




	}


}
