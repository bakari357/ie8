<?php
use Illuminate\Routing;
class PartnerUpdates extends BaseController  {
/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
        public function music()
        {
	  $base_url=Config::get('app.url');

		$save=array(	
			'cron'=>'music',
			'datetime'=>date("Y-m-d H:i:s")

		   );
		$connection = DB::connection('mongodb');
		$connection->getCollection('cron_jobs')->insert($save);
	 
         $updates=array(
			  'featured'=>$base_url.'featured/5',
			  'top'=>$base_url.'top/5',
			  'hot'=>$base_url.'hot/5',
			  'albums'=>$base_url.'albums/5',
			  'artist'=>$base_url.'artist/5',
			  'artist_alb'=>$base_url.'artist_alb/5',
			  'artist_trk'=>$base_url.'artist_trk/5',
			  'arrivals'=>$base_url.'arrivals/5',
			  'category'=>$base_url.'category',
			  'f_albums'=>$base_url.'f_albums/5'

			);
		
		
	        $curl= new Curl;	
		foreach($updates as $row=>$value)
		{
			 $response=$curl->simple_get($value);
			 print_r($response);
	        }

	}
	
	
	
	//billdesk recon function
       public static function billdesk_recon(){
	
       $billdesk = MobilePaymentmodel::get_billdesk_order_details();
       $delimiter = '|';
       $newline = "\r\n";
       
       
       $heading[]=array();
       $get_csv = Format2array::array_to_csv($billdesk,$heading,$delimiter, $newline);
       $output = str_replace('"','',$get_csv);
       

	$fileLocation = "/var/www/smartbuy/public/uploads/recon/RewSm_Mob_".date('dmY', strtotime(' -1 day')).".txt";
	$file = fopen($fileLocation,"w+");

	fwrite($file,$output);
	fclose($file);
	
	
	
	//here  sending local file ftp server
	
	$strServer     = Config::get('settings.recon.server_address');
	$strServerPort = Config::get('settings.recon.server_port');
	$strServerUsername = Config::get('settings.recon.username');
	$strServerPassword = Config::get('settings.recon.password');
	

       //connect to server
	$resConnection = ssh2_connect($strServer, $strServerPort);

	if(ssh2_auth_password($resConnection, $strServerUsername, $strServerPassword)){

	//Initialize SFTP subsystem
	$resSFTP = ssh2_sftp($resConnection);

	echo "Connected server";

	//Send/Download file here

	$result = ssh2_scp_send($resConnection, $fileLocation, '/var/www/sb_recon/billdesk_recon/RewSm_Mob_'.date('dmY', strtotime(' -1 day')).'.txt', 0644);
	
	echo '<pre>'; print_r($result);
	exit;
	
	}else{
	echo "Unable to authenticate on server";
	}

	
	
	
	}
        public static function flights_pnr_status()
       {
          
           $status_temp =  DB::table('flights_pnr_status')
		->where('flag',0)->get();
           
           foreach($status_temp as $status)
           {
            $url=  'http://pp.goibibobusiness.com/api/getstatus/';
           //$url=  'www.goibibobusiness.com/api/search/?'.$qstring;
           //echo $url;exit;
            // create curl resource 
            $ch = curl_init(); 
            // set url 
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            //return the transfer as a string 
            //curl_setopt($ch, CURLOPT_USERPWD, "sharath@reward360.co:sharath123");
            curl_setopt($ch, CURLOPT_USERPWD, "hdfcsmartbuy@reward360.co:reward-123");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
            curl_setopt($ch, CURLOPT_TIMEOUT, 60); //timeout in seconds
            // $output contains the output string 
            curl_setopt($ch, CURLOPT_POSTFIELDS, array("bookingId"=>$status->booking_id));
            $result = curl_exec($ch);
            curl_close($ch); 

            $json_decode=json_decode($result);

            $data=$json_decode->data;

            $count=count($data);

            for($i=0;$i<$count;$i++)
            {
            $updatable_pnr[]=$data[$i]->airlinepnr;
            }

            $orderid=$status->order_id;
            $rules=Viaflight::pnr_rebuild_structure($orderid,$updatable_pnr);

            
            $save['output']=$rules;
            //updating the mongodb
            $connection = DB::connection('mongodb');
            $criteria = array('order_id' =>(int) $orderid);
            $connection->getCollection('extended_products')->update($criteria, array('$set' =>$save));
           }
       }
	

      //billdesk pending transaction re-process
     
     public static function billdesk_pending_reprocess()
     {
       $getpending_order = MobilePaymentmodel::get_pending_orders();
       
       $reorder=array();
       
       foreach( $getpending_order as $order)
       {
        $reorder['input'] = json_decode($order->input);
        $reorder['bank_ref_no'] = $order->bank_ref_no;
        $result = array_merge((array)$reorder['input']->Posted,(array)$reorder['bank_ref_no']);
        $recharge_details = Billdeskhelper::all_payments($result,$result[0]);
        
         
		if(isset($recharge_details)){
		
			$resonse_result = explode('<',$recharge_details);

			if(isset($resonse_result[0]) && trim($resonse_result[0])!='') {

			$recharge_result = explode('~',$recharge_details);

			if(isset($recharge_result[6]) && $recharge_result[6]=="Y")
			{	
			$orderstatus='Successful';
			$update['output']=json_encode(array('status'=>'Success','Response'=>$recharge_details));
			Billdeskhelper::order_reprocess($ext_id='',$order->order_id,$orderstatus,$item='',$recharge_details,$update,  $reorder['bank_ref_no']);
			Checkouthelper::billdesk_order_process($ext_id='',$order->order_id,$orderstatus,$item='',$recharge_details,$order->order_number);
			echo "success</br>"; 
			}
			else
			{ 
			$errorcode =$recharge_result[7];
			$orderstatus='Failed';
			$update['output']=json_encode(array('status'=>'Failed','Response'=>$recharge_details,'error_code_reason'=>$errorcode));
			Billdeskhelper::order_reprocess($ext_id='',$order->order_id,$orderstatus,$item='',$recharge_details,$update,  $reorder['bank_ref_no']);
			Checkouthelper::billdesk_order_process($ext_id='',$order->order_id,$orderstatus,$item='',$recharge_details,$order->order_number);
			echo "Failed</br>"; 
			}}
			else{

			$orderstatus='Pending';
			$update['output']=json_encode(array('status'=>'Pending','Response'=>""));
			Billdeskhelper::order_reprocess($ext_id='',$order->order_id,$orderstatus,$item='',$recharge_details,$update,  $reorder['bank_ref_no']);
			echo "Pending</br>"; 
			}
		  }  else
			{
			$orderstatus='Failed';
			$update['output']=json_encode(array('status'=>'Failed','Response'=>""));
			Billdeskhelper::order_reprocess($ext_id='',$order->order_id,$orderstatus,$item='',$recharge_details,$update,  $reorder['bank_ref_no']);
			echo "Failed</br>"; 
			}	

     
            } //end of foreachloop
     
       }//end off function


	// movies cron

	public function movies()
        {
	  $base_url=Config::get('app.url');
		$save=array(	
			'cron'=>'movies',
			'datetime'=>date("Y-m-d H:i:s")

		   );
		$connection = DB::connection('mongodb');
		$connection->getCollection('cron_jobs')->insert($save);
         $updates=array(
			  'funcinemas'=>$base_url.'getmovies/funcinema',
			  'caching'   =>$base_url.'movie_list'

			);
		
		
	        $curl= new Curl;	
		foreach($updates as $row=>$value)
		{
			 $response=$curl->simple_get($value);
			 print_r($response);
	        }

	}


}
