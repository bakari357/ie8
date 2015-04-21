<?php 
   //Billdesk helper functions
class Billdeskhelper {

      //Billdesk All payments 
      public static function all_payments($request,$pg_ref=false){
       //echo '<pre>'; print_r($request); exit;
        $timestamp = date("Ymd").date("His");
	$current_date = date("Ymd");
	$random = Billdeskhelper::random_string(14);
	$customer_name =  Billdeskhelper::generateRandomName(10);
        $bank_refence_num =$pg_ref;
        //$bank_refence_num ='R'.Billdeskhelper::random_string(6); 
        $user_custom_id= Billdeskhelper::random_string(10); 
        $source_id=Config::get('settings.staging.source_id');
        $message_code_recharge =Config::get('settings.staging.prepaid');
        $message_code_payment =Config::get('settings.staging.payment');
        $message_code_recharge_pay =Config::get('settings.staging.prepaid_pay');
      
       
	switch($request['payment'])
	{      
		case 'recharge':
		if($request['ttype'] =="etop"){
		  $msg_without_Checksum =$message_code_recharge.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~~'.$request['prepaid_biller_id'].'~'.$request['mobile'].'~~~'.$request['amount'].'.00~NA~NA~NA';
		
		}
		break;
		case 'postpaid':
		
		     if($request['biller_id'] == "AIRTKA"){
                    $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['mobile'].'!'.$request['relation_no'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
	             }
	        
	        
	    else{
	           
	    $billers = $request['biller_id']; 
	         
	      //billers case starting here    
	           
	     switch ($billers){
	         
	          case 'AIRTCH':
	           $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['mobile'].'!'.$request['relation_no'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
	          break;
	          
	          case 'AIRTTN':
	        
	          $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['mobile'].'!'.$request['account_no'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
	          
	           break;
	          
	          default:
	           $operators = $request['operator'];
	           
	           //operators case starting here
	           switch($operators){
	               
	            case ($operators=='DOCO' || $operators== 'RELC'||  $operators=='AIRC') :
	        
	          
	        $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['mobile'].'!'.$request['relation_no'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
	        
	            break;
	       
	            case ($operators=='BSNL' || $operators== 'INDI') :
	       
	        
	          $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['mobile'].'!'.$request['account_no'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
	           break;
	         
	           case 'LOOP':
	          
	           $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['mobile'].'!'.$request['account_no'].'!'.$customer_name.'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
	        
	           break;
	        
	           case 'IDEA':
	         
	           $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['mobile'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
	        
	          
	          break;
	          
	          default:
	           $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['mobile'].'!'.$request['relation_no'].'!'.$customer_name.'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
	          } //operators case ending here
	          
	        }// //billers case ending here 
	     
	        }
		
		break;	
		
		case 'DTH':
		 $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['subscriber_id'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
		
		break;	
		case 'telephone':
		if($request['biller_id']=='ABTSCH'){

		$msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['telephone_no'].'!'.$request['acc_no'].'!udaya~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
		}

		else{

		$msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['telephone_no'].'!'.$request['acc_no'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';

		}

		break;

		case 'insurance':
		$msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['policy_no'].'!'.$request['premium_amount'].'.00~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
		break;
		case 'electricity':

		$msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['service_no'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA'; 
		break;


		case 'gas':

		$msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['customer_id'].'!'.$request['meter_no'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA'; 
		break;

		case 'subscription':

		$msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['subscription_billerid'].'~NA~~'.$request['customer_name'].'!'.$request['address1'].'!'.$request['address2'].'!'.$request['scheme'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
              break;

		case 'creditcard':

		 $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['biller_id'].'~NA~~'.$request['creditcard_number'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
		break;


		case 'charity':

		 $msg_without_Checksum =$message_code_payment.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['chartity_billerid'].'~NA~~'.$request['donor_name'].'!'.$request['address1'].'!'.$request['address2'].'!'.$request['contribution_scheme'].'~NA~~'.$current_date.'~~'.$request['amount'].'.00~PNY~'.$random.'~'.$bank_refence_num.'~NA~V~NA~NA~NA~NA';
		
		break;

		default: 
		$msg_without_Checksum="no match found";
       }
      
      
		//calling checksum function
		$checksum = Billdeskhelper::checksum($msg_without_Checksum);
		$msg = $msg_without_Checksum.'~'.$checksum;
		$result=Billdeskhelper::curl_request($msg);
		
		
		$report = explode('~',$result);
	       if($report[0]  =='U03006'){
	        $msg_without_Checksum =$message_code_recharge_pay.'~'.$random.'~'.$source_id.'~'.$timestamp.'~'.$user_custom_id.'~'.$user_custom_id.'~'.$request['prepaid_biller_id'].'~~~~'.$report[14].'~MOBILE~'.$request['amount'].'.00~RNP~'.$bank_refence_num.'~~NA~NA~NA';
	       
	         $checksum = Billdeskhelper::checksum($msg_without_Checksum);
		 $msg = $msg_without_Checksum.'~'.$checksum;
		 $result=Billdeskhelper::curl_request($msg);
		 //echo '<pre>'; print_r( $result); 
		 return  $result;
	        
	       }
	       else{
	        return  $result;
	       }
		
		
              
      
      }
      
      
      //calling curl request
      public static function curl_request($msg)
	{
		$url = Config::get('settings.staging.url'); // load url from config
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url.urlencode($msg));
		curl_setopt ($c, CURLOPT_POST, true);
		curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
		$page['success'] = curl_exec ($c);
		if(curl_errno($c))
		{
		$page['error']= curl_error($c);
		}
		curl_close ($c);
		return $page['success'];
	}


      
      
     //generating random string
       public static function random_string($length)
	{

		return substr(number_format(time() * rand(),0,'',''),0,$length);

	}
	
	
    public static function generateRandomName($length) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
    }
     
     
        //generating checksum
	 public static function checksum($msg_without_Checksum)
	{
		$common_string=Config::get('settings.staging.component');
		$string_new=$msg_without_Checksum."~".$common_string;
		$checksum =crc32($string_new);
		//avoiding sign number
		if (0 > $checksum)
		{
		 //Implicitly casts i as float, and corrects this sign.
		    $checksum += 0x100000000;
		}
		return $checksum;
	}
	
	
	//getting billdesk api parameters 
	public static function parameters($type)
	{
	   
	   $bill=array(
	                'recharge'=>array('prepaid_biller_id','mobile','amount'),
	                'postpaid'=>array('biller_id','mobile','relation_no','customer_name','amount'),
	   		'DTH'=>array('biller_id','subscriber_id','amount'),
	   		'electricity'=>array('biller_id','service_no','amount'),
	   		'gas'=>array('biller_id','customer_id','meter_no','amount'),
	   		'subscription'=>array('subscription_billerid','customer_name','address1','address2','scheme','amount'),
	   		'charity'=>array('chartity_billerid','donor_name','address1','address2','contribution_scheme','amount'),
	   		'creditcard'=>array('biller_id','creditcard_number','amount'),
	   		'insurance'=>array('biller_id','policy_no','premium_amount','amount')
	   	       );
	
	
	   return $bill[$type];
	
	}
	
	
	//get parameters and posted value 
	public static function get_params($type)
	{
	
	    $params=Billdeskhelper::parameters($type);
	    
	     foreach($params as $row)
	     {
	     
	        $values[$row]=$_POST[$row];
	     }
	    
	     return $values;
	
	}
	
	
	//checkout process calling from checkout controller
	
	 public static function checkout($data)
	      {

                $json['Posted']=$_POST;
		$json['Customer_Id']=1;
		$json['Created_Date']=date('Y-m-d H:i:s');
		$json['Patner_Id']=5;
		$json['API_Type']='recharge';
		$json['payment']=$_POST['payment'];
		$json['params']=Billdeskhelper::get_params($json['payment']);
		$test =json_encode($json);
		$save['input']=$test;
		$save['order_id']='';
		$json['api_pid'] = Checkoutmodel::do_checkout($save);
		$ticket['quantity']=1;
              //cart description
		$ticket['description']='<b>Recharge Name:</b> '.$data['ctype'];
                $ticket['json']=$json;
		return $ticket;
			

	   }
	   
	   
    public static function view_billerlist($request){
      
        $timestamp = date("Ymd").date("His");
	$random = Billdeskhelper::random_string(14);
        $source_id=Config::get('settings.staging.source_id');
        $message_code_viewbillers =Config::get('settings.staging.billers');
        $cat_type = $request['category'];
	switch($request['category'])
	{     
		case $cat_type :
		
		 $msg_without_Checksum = $message_code_viewbillers.'~'.$random.'~'.$source_id.'~'.$timestamp.'~NA~NA~Telecom
~National~NA~NA~NA';
		
		break;	
		
		default: 
		$msg_without_Checksum="no match found";
       }
		//calling checksum function
		$checksum = Billdeskhelper::checksum($msg_without_Checksum);
		echo  $msg = $msg_without_Checksum.'~'.$checksum;
		$result=Billdeskhelper::curl_request($msg);
	        return  $result;
	      
		
		
              
      
      }
	


     
}
