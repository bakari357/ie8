<?php use Jenssegers\Mongodb\Connection;

class Ordermodel extends Eloquent {
  
  //number of orders
  public static function count_customer_orders($customer_id=false) {

		$count_orders =  DB::table('order_items')->Join('orders', 'orders.id', '=', 'order_items.order_id') 
		->orderBy('ordered_on', 'DESC')
		->groupBy('orders.order_number')         
		->where('orders.customer_id',$customer_id)->get();
		return count($count_orders);
	}
  
  //get customer order list
   public static function get_customer_orders($data=array(),$customer_id=false)
        {
        
	$result =  DB::table('order_items')->Join('orders', 'orders.id', '=', 'order_items.order_id')->orderBy        
	('ordered_on', 'DESC')->groupBy('orders.order_number')               
	->select('orders.id', 'orders.status','total_points','orders.order_number','orders.ordered_on','order_items.product_id','order_items.contents')->where('orders..customer_id',$customer_id)->skip($data['page'])->take($data['rows'])->get();
	return  json_decode(json_encode((array) $result), true);
  
  	}
  
  
 public static function get_order_edit($id)
        {
		$customer_id  = Session::get('customer_id');
		$user_id=$customer_id;

		$order =  DB::table('orders')          
		->where('id',$id)->where('customer_id',$user_id)->first();

		return $order;
        }
   
   //get order details
        public static function get_order($id)
        {
        
		$order =  DB::table('orders')          
		->where('id',$id)->first();

		$order->contents	= Ordermodel::get_items($order->id);
		return $order;
        }

        public static function insert_order_items($id,$status,$item,$count,$pg_ref=false)
        {
		
		$save				= array();
		//$save['contents']	= $item;
		$save['status'] = $status;
		$save['count'] = $count;
		$item = unserialize($item);
		$save['product_id']     = $item['id'];
		$save['quantity'] 	= $item['options']['quantity'];
		$save['cashpaid'] 	= $item['options']['custom_cash'];
		$save['pointspaid'] 	= 0;
		//  if(!empty($item['options']['apiproduct']['sku']))
		// $save['sku']               =$item['options']['apiproduct']['sku'];
		//for physical products
		if(!empty($item['options']['apiproduct']['sku']))
		$save['sku']               =$item['options']['apiproduct']['sku'];
		$save['partner_id']        =$item['options']['apiproduct']['Patner_Id'];

		$save['order_id']	= $id;
		$save['bank_ref_no']	= $pg_ref;
		$save['created_date']	= date('Y-m-d H:i:s');
		
		
		DB::table('order_items')->insert($save);
        
        }
        public static function update_order_items($id,$status,$item,$count)
        {

		$save	= array();
		$save['status'] = 'Successful';
		$save['count'] = $count;
		DB::table('order_items')->where('order_id',$id)->update($save);
        }
    
        public static function get_items($id)
        {
               
	$items =  DB::table('order_items')->select('order_id', 'contents','order_items.id as orderitemId','status as orderitemstatus')->where('order_id',$id)->get();        
            
     

        $return	= array();
        $count	= 0;
		foreach($items as $item)
		{

			$item_content	= unserialize($item->contents);
			//remove contents from the item array
			unset($item->contents);
			$return[$count]	= $item;

			//merge the unserialized contents with the item array
			if(!empty($item_content))
			$return[$count]	= array_merge((array)$return[$count], $item_content);

			$count++;
		}

       	   return $return;
        }
        public static function update_extended_products($id,$save)
        {
     
		
		
		$connection = DB::connection('mongodb');
		$criteria = array('exdid' =>$id);
		$connection->getCollection('extended_products')->update($criteria, array('$set' =>$save));
      	}
         
        public static function get_extended_products($id)
        {
		$connection = DB::connection('mongodb');
		$criteria = array('order_id'=>(int)$id);
		$query = $connection->getCollection('extended_products')->find($criteria); 
		if($query->count()==0)
		{
		$criteria = array('order_id'=>$id);
		$query = $connection->getCollection('extended_products')->find($criteria); 
		}
		 foreach($query as $extended_products)
		 {
		  $query= $extended_products;
		 
		 }
		return $query;
        }
        public static function save_order($data, $contents = false,$pgstatus='Approved',$pg_ref=false)
        {
		
		$orderstatus=$data['status'];
		$error=0;
		$order=Ordermodel::generate_orderid($data);
		$oid=$order['order_id'];
		$order_number=$order['order_number'];
                $cust= Session::get('customer_data');
		
        //if there are items being submitted with this order add them now
        if($contents)
        {
		
        $count=1; foreach($contents as $key=>$item)
        {
        $api=unserialize($item);
	
	
	
    
        if(!empty($api['options']['apiproduct']))
        {  
		$partner=$api['options']['apiproduct']['API_Type'];
		$ext_id=$api['options']['apiproduct']['api_pid'];
     
		switch($partner)
		{
			case 'funcinemas':

			$fun_order=$api['options']['apiproduct']['Posted']['order_id'];
			if($pgstatus=='Approved')
			{
			$response= Funcinemas::GenrateBookingID($fun_order,$api,$order_number);
			$check=  Funcinemas::checksuccess($response);
			}
			else
			{

			$response=array('pg_status'=>'declined','order_status'=>'declined');
			$check='Declined';
			}

			if($check=='success')
			{
			$orderstatus='Successful';
			$update['output']=json_encode(array('status'=>$orderstatus,'booking_id'=>$response));
			Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
			}
			else
			{
			$orderstatus='Failed';
			$update['output']=json_encode(array('status'=>$orderstatus,'booking_id'=>$response));
			Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
			}


			break;



			case 'cinepolis':

   
				$response=Cinepolis::cinepolis_booking($api,$cust,$order['order_number']);
				if(isset($response) && !empty($response))
				if(isset($response['success'])){
				$orderstatus='Successful';
				$update['output']=json_encode(array('buyresult'=>$response['success']['buyresult'],'bookseatresult'=>$response['success']['bookseatresult'],'soldstatus'=>$response['success']['soldstatus'],'status'=>$orderstatus,'tpin'=>$response['success']['tpin']));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update);
				}else{
				$orderstatus='Failed';
				$update['output']=json_encode(array('Output'=>$response,'status'=>'Pending','tpin'=>''));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update);
				}

				break;


				case 'Hungama':

				
				if($pgstatus=='Approved')
				{
					$response=Hungama::hungama_music($api);
					if(isset($response) && !empty($response)){
					if(isset($response['hsuccess']['result']->response->code) && $response['hsuccess']['result']->response->code==1){
					
					$update['output']=json_encode(array('Output'=>$response['hsuccess'],
					'Other'=>$response['herror'],'status'=>'Successful'));
					$orderstatus='Successful';
					Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
					}
					else
					{
						$orderstatus='Failed';
						$update['output']=json_encode(array('Output'=>"",'Other'=>"",'status'=>'Failed'));
						Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);

					}}
					else
					{
					$orderstatus='Failed';	
					$update['output']=json_encode(array('Output'=>'Content not found','Other'=>'Content not found','status'=>'Failed'));
					Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);

					}

	
				}
				else
				{	
				    $orderstatus=$pgstatus;
				    $response=array('pg_status'=>'declined','order_status'=>'declined');
				    $update['output']=json_encode($response);
				    Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);

				}


				
				

				break;
	
				case 'hotels':
				$value=$api['options']['apiproduct']['Posted'];
				$value['thumbnail']='';	
				$data['values']=$value;
				$response=Hotel::Hotel_Checkout($value);
				$hotel_details = Xml2array::toArray($response);
				$data['book_hotels']=$hotel_details;
				if(isset($hotel_details['HotelRoomReservationResponse']['itineraryId']))
				{
				$orderstatus='Successful';
				$update['output']=json_encode(array('status'=>'Booked','booking_id'=>$response));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);

				}
				else
				{
				$orderstatus='Failed';
				$update['output']=json_encode(array('Output'=>'Failed','status'=>'Failed'));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
				}


				break;

				case 'cleartrip':
				$value=$api['options']['apiproduct']['Posted'];
				$data['values']=$value;
				$respons=Hotel::Hotel_clr_provisional($value);
				$hotel_details=Xml2array::xml2array_test($respons['success']);
				$response=$hotel_details;
				if(isset($hotel_details['book-response']['booking-id']))
				{
				$orderstatus='Successful';
				$update['output']=json_encode(array('status'=>'Booked','booking_id'=>$response));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);

				}
				else
				{
				$orderstatus='Failed';
				$update['output']=json_encode(array('Output'=>'Failed','status'=>'Failed'));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
				}


				break;

				case 'Flights':

				$response=Viaflight::via_booking($api['options']['apiproduct']['api'],$customer_id=false,$oid);
				$xml_array=Xml2array::xml2array_test($response);
				if(isset($xml_array['AirBookingStatusResponse']['Bookings']['Booking']['BookingId']))
				{  
				$update['output']=json_encode(array('status'=>'Booked','booking_id'=>$response));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
				}else
				{
				$update['output']=json_encode(array('status'=>'Booked','booking_id'=>$response));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
				}


				break;
		
		
		
		/*Recharge Oxigen*/
			case 'recharge':
                              
				$value=$api['options']['apiproduct']['Posted'];
				$value['thumbnail']='';	
				$data['values']=$value;
				$recharge_details = Billdeskhelper::all_payments($value,$pg_ref);
				
			        //echo '<pre>'; print_r($recharge_details); exit;
				if(isset($recharge_details)){
				$resonse_result = explode('<',$recharge_details);
				
				
				
				if($resonse_result[0]!='') {
				$recharge_result = explode('~',$recharge_details);

				if(isset($recharge_result[6]) && $recharge_result[6]=="Y")
				{	
				$orderstatus='Successful';
				$update['output']=json_encode(array('status'=>'Success','Response'=>$recharge_details));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$recharge_details,$update,$pg_ref);
				Checkouthelper::billdesk_order_process($ext_id,$oid,$orderstatus,$item,$recharge_details,$order['order_number']);
				}
				else
				{ 
				$errorcode =$recharge_result[7];
				// $error = Billdeskhelper::error_message($errorcode);
				$orderstatus='Failed';
				$update['output']=json_encode(array('status'=>'Failed','Response'=>$recharge_details,'error_code_reason'=>$errorcode));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$recharge_details,$update,$pg_ref);
				Checkouthelper::billdesk_order_process($ext_id,$oid,$orderstatus,$item,$recharge_details,$order['order_number']);
				}}
				else{
				
				$orderstatus='Failed';
				$update['output']=json_encode(array('status'=>'Failed','Response'=>""));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$recharge_details,$update,$pg_ref);
				}
				}else
				{
				$orderstatus='Failed';
				$update['output']=json_encode(array('status'=>'Failed','Response'=>""));
				Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$recharge_details,$update,$pg_ref);

				}	
				break;
			
                case 'Cleartrip_flights':
                
                $response=Viaflight::cleartrip_booking($api['options']['apiproduct'],$customer_id=false,$oid);
                
                $xml_array=Xml2array::xml2array_test($response);
                if(isset($xml_array['book-response']['trip-id']))
                {  
                $orderstatus='Successful';
                $update['output']=json_encode(array('status'=>'Booked','booking_data'=>$response));
                Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
		//checking the pnr status
		//$status=Viaflight::cleartrip_pnr_status($xml_array,$oid,$xml_array['book-response']['trip-id']);
                }else
                {
                $orderstatus='Failed';
                $update['output']=json_encode(array('status'=>'Failed','booking_data'=>$response));
                Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
                }


                break;
                        
					case 'goibibo_flights':

					$response=Viaflight::goibibo_booking($api['options']['apiproduct'],$customer_id=false,$oid);

					$xml_array=json_decode($response);
					if(isset($xml_array->data['0']->bookingid) && $xml_array->data['0']->bookingid<>'')
					{   
					$orderstatus='Successful';
					$update['output']=json_encode(array('status'=>'Booked','booking_data'=>$response));
					Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
					//checking the pnr status
					$status=Viaflight::check_pnr_status($xml_array,$oid,$xml_array->data['0']->bookingid);
                        }else
                        {
				$orderstatus='Failed';
		                $update['output']=json_encode(array('status'=>'Failed','booking_data'=>$response));
		                Checkouthelper::order_process($ext_id,$oid,$orderstatus,$item,$response,$update,$pg_ref);
                        }


                        break;
        }
        }
}
	
      
        return  $order['order_number'] ;
       
}}
       

	 public static function insert_order_items_mongodb($id,$status,$item,$count,$pg_ref=false)
        {
		$item = unserialize($item);
		$json_data=json_encode((array)$item['options']);
		
		$save		   = array();
		$save['contents']  = $json_data;
		$save['status'] = $status;
		$save['count'] = $count;
		$save['product_id'] = $item['options']['id'];
		$save['quantity'] 	= $item['options']['quantity'];
		$save['order_id']	= $id;
		$save['partner_id']= $item['options']['apiproduct']['Patner_Id'];
		$save['created_date']	= date('Y-m-d H:i:s');
		$save['bank_ref_no']	= $pg_ref;
		$connection = DB::connection('mongodb');
		$ext_entry=$connection->getCollection('order_items')->insert($save);
        }  



	public static function generate_orderid($data)
	{
		if (isset($data['id']) && $data['id'] <>'')
		{
			$oid = $data['id'];
			//we don't need the actual order number for an update
			$onum=DB::table('orders')->where('id',$oid)->first();
			$order_number = $onum->order_number;
			
		}
		else
		{
			$pgstatus='Approved';
			$data['order_number']="";
			//print_r($data);exit;
			$oid=DB::table('orders')->insertGetId($data);
			$order=DB::table('orders')->where('id',$oid)->first();
			$customer= DB::table('orders')->select('id');
			$pointscash = $customer->get();
			//create a unique order number
			//unix time stamp + unique id of the order just submitted.
			$order_number	= array('order_number'=>str_replace("_","",(date('U').$order->id)));
			//update the order with this order id
			DB::table('orders')->where('id', $order->id)->update($order_number);
			//return the order id we generated
			$order_number =  $order_number['order_number'];
		}

		$order=array('order_id'=>$oid,'order_number'=>$order_number);
		return $order;
	}

	public static function get_order_number($order_number)
	{

		$order_details=DB::table('orders')->where('order_number',$order_number)->first();
		return $order_details;
	}

	public static function get_order_extended($order_id)
	{
		 $extended_products=Ordermodel::get_extended_products($order_id);
		 $data['input']=json_decode($extended_products['input']);
                 $data['output']=json_decode($extended_products['output']);
		 return $data;
	}

     
       public static function get_operator($oper){
       
       $operator = DB::Select(DB::RAW("select operator from pp_myoxi_operators where abbr='".$oper."'"));
       return @$operator[0]->operator;
       
       }


	      //inserting billdesk order items
       
    //inserting billdesk order items
       
      public static function bildesk_insert_order_items($id,$status,$item,$count,$response,$order_number,$order_id){
        
         // echo '<pre>'; print_r($response); exit;
          $ref_number = DB::Select(DB::RAW("select bank_ref_no from pp_order_items where order_id=$order_id"));
          $report = explode('~',$response);
     	  $save= array();
          if(isset($response)!='' && isset($report[6])=='Y'){
          $item = unserialize($item);
          $save['transaction_amount'] 	=$item['options']['custom_cash'];
          $save['transaction_date'] = date('Y-m-d H:i:s');
          
          $bank_refer_number =  $ref_number[0]->bank_ref_no;
            
	
		if($report[0]  =='U03014'){
			$billdesk_transaction_id = $report[10];
		}else{
			$billdesk_transaction_id = $report[9];
		 } 
                
		//$save['billdesk_transaction_id'] = $order_number;
		$save['billdesk_transaction_id'] = $billdesk_transaction_id;
		$save['bank_account_number'] = "";
		$save['bank_refence_number']= str_replace('REWSMART','',$bank_refer_number);
		$save['customer_id'] = $report[5];
		$save['response'] = serialize($response);
		if($status =="Successful"){
		$transaction_status ="S";
		$reason = "NA";
		}else{
		$reason = "Invalid details";
		$transaction_status ="F";
		}
                $save['transaction_status'] = $transaction_status;
		$save['failure_reason'] = $reason;
		DB::table('billdesk_order_items')->insert($save);
		}
       
       }
       


}
