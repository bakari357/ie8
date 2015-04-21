<?php
class Checkouthelper
{

 public static function cart_process($data,$cdata)
	{   
                $partner = Commonmodel::getPartnerId($cdata['partner']);
		$offer = Offerhelper::offer_calculate($partner->id,$cdata['amount']);
		$product['custom_cash'] =round($cdata['amount'] - $offer['discount_amount']);
		$product['total'] = round($cdata['amount']);
		$product['payable_amount'] = round($cdata['amount'] - $offer['discount_amount']);
		$product['offer_type'] = $offer['offer_type'];
		$product['offer_amount'] = $offer['discount_amount'];
		$product['item']=$data['description'];
		$product['original_cash'] =$cdata['amount'];
		$product['product_type']   = 'Digital';
		$product['id'] ='10';
		$product['name'] =$cdata['ctype'];
		$product['quantity'] =$data['quantity'];
		$product['price'] =$cdata['amount'];
		$product['fixed_quantity']=0;
		$product['apiproduct']= $data['json'];
		if(isset($cdata['emi_option']) && $cdata['ptype']==3)
		$product['emi']=Checkouthelper::month_emi(round($cdata['amount']),$cdata['emi_option']);
		Cart::add($product);


	        return $product;

	}

	public static function order_process($ext_id,$oid,$orderstatus,$item,$response,$mupdate,$pg_ref=false)
	{  

		
		$update['order_id']=$oid;
                $mupdate['order_id']=$oid;
		$api=unserialize($item);
                $product_info=$api['options']['apiproduct']['API_Type'];
		DB::table('extended_products')->where('id',$ext_id)->update($update);
		Ordermodel::insert_order_items($oid,$orderstatus,$item,$count=false,$pg_ref);
		Ordermodel::insert_order_items_mongodb($oid,$orderstatus,$item,$count=false);
		Ordermodel::update_extended_products($ext_id,$mupdate);
		$upd_order['status']=$orderstatus;
		Rewards::update_mdr($orderstatus,$update['order_id']);
		DB::table('orders')->where('id',$update['order_id'])->update($upd_order);
		DB::table('order_items')->where('order_id',$update['order_id'])->update($upd_order);
		$msg='OrderINFO|smartbuy|1|'.$product_info.'|'.$oid.'|'.$orderstatus.'|'.$_SERVER['SERVER_ADDR'];
		Log::info($msg);
		return true;
	}

    
     public static function billdesk_order_process($ext_id,$oid,$orderstatus,$item,$response,$order_number)
	{        $order_id = $oid;
		Ordermodel::bildesk_insert_order_items($oid,$orderstatus,$item,$count=false,$response,$order_number,$order_id);
		
	}


   public static function emi_logic($amount=false)
   {

	if($amount > 3000)
	{
		$period=array(3,6,9,12);// period should load from partner setting

		$int_setting=array(
					'3'=>Config::get('emi_settings.interst.3'),
					'6'=>Config::get('emi_settings.interst.6'),
					'9'=>Config::get('emi_settings.interst.9'),
					'12'=>Config::get('emi_settings.interst.12')

				   );


		
		$interest=array('3'=>round(($int_setting['3']/12)/100,4),
				'6'=>round(($int_setting['6']/12)/100,4),
				'9'=>round(($int_setting['9']/12)/100,4),
				'12'=>round(($int_setting['12']/12)/100,4)
				);

		
	

		foreach($period as $prow)
		{
			$factor=pow(1+$interest[$prow],($prow))-1;
		
			$emi=$amount*$interest[$prow]*pow((1+$interest[$prow]),$prow)/$factor;

			$emi_value[$prow]=round($emi);
		}

		return $emi_value;
	}

	return false;

    }


     public static function interest()
     {
		$int_setting=array(
					'3'=>Config::get('emi_settings.interst.3'),
					'6'=>Config::get('emi_settings.interst.6'),
					'9'=>Config::get('emi_settings.interst.9'),
					'12'=>Config::get('emi_settings.interst.12')

				   );



		return $int_setting;

      }




      public static function payament_process($type=false,$pg_active=false)
      {


	
		
		$contents=Cart::content();


	// are we processing an empty cart?

		foreach($contents as $pro => $items){
//echo '<pre>'; print_r($items);exit;
		 if(isset($items['options']['partner_id'])){
			$partner_id=$items['options']['partner_id'];
		}else{
			$partner_id=$items['options']['apiproduct']['Patner_Id'];
		}
		
			$custom_cash =  $items['options']['custom_cash'];
			$ext_id=$items['options']['apiproduct']['api_pid'];


			if(isset($items['options']['apiproduct']['Posted']))
			{
				$input=$items['options']['apiproduct']['Posted'];
			}

			$fname = isset($input['first_name']) ? $input['first_name'] : ''; 
			$lname = isset($input['last_name']) ?  $input['last_name']  : ''; 
			$mobile = isset($input['mobile']) ?  $input['mobile']  : ''; 
			$total = isset($custom_cash) ?  $custom_cash  : ''; 
			
		}

		$login=Session::get('customer_data'); 
		if(!$login)
		{
			foreach(Cart::content() as $key=>$item)
			{
				$s_email=$item['options']['apiproduct']['Posted']['s_email'];
				$result = DB::table('users')->where('email' , $s_email)->first();
				if(count($result)==0){ 
				$id = DB::table('users')->insertGetId(array(
				'email'      => $s_email,
				'user_type'  =>2,
				'created_at' =>date( 'Y-m-d H:i:s') ));
				$result = DB::table('users')->where('id' , $id)->first();
				Session::put('customer_id',$id); 
				unset($result->password); 
				Session::put('customer_data', $result); 
				$customer = Session::get('customer_data');
				$customer->b_type=2;

			}
			else{
				Session::put('customer_id',$result->id); 
				unset($result->password); 
				Session::put('customer_data', $result); 
				$customer = Session::get('customer_data');
				$customer->b_type=2;
			     }
		}

		}else{
				$customer = Session::get('customer_data');
				$s_email=$customer->email;
		     }


		
		$data['firstname']=isset($fname) ? $fname : '' ;
		$data['lastname']=isset($lname) ? $lname : '';
		$data['phone']=isset($mobile) ? $mobile : '' ;
		$data['email']=isset($s_email) ? $s_email : '';
		$data['customer_id']  = isset($customer->id) ? $customer->id : ''; 
		$data['status'] = 'pending';
		$data['payment_type'] =isset($type['ptype']) ? $type['ptype'] : ''; 
		$data['total']=isset($total) ? $total : '';

		
		$oid=DB::table('orders')->insertGetId($data);
		
		$order=DB::table('orders')->where('id',$oid)->first();
		
		$save['order_id']=(int)$oid;
		Rewards::store_mdr($oid,@$partner_id,@$custom_cash);
		Ordermodel::update_extended_products(@$ext_id,$save);
		$customer= DB::table('orders')->select('id');
		$pointscash = $customer->get();
		//create a unique order number
		//unix time stamp + unique id of the order just submitted.
		$order_number	= array('order_number'=>str_replace("_","",(date('U').$order->id)));
		//update the order with this order id
		DB::table('orders')->where('id', $order->id)->update($order_number);
		$data['order_number'] = $order_number['order_number']; 
		$data['contents']=$contents;
		$data['custom_cash']=@$custom_cash;
		

		// get the pg setup
		
		$data['pg_setup']=Checkouthelper::pg_setup(@$type,@$pg_active);
		
	


		
		return  $data;
	}


		public static function month_emi($amount,$month)
		{


			$inter_setting=array(
			'3'=>Config::get('emi_settings.interst.3'),
			'6'=>Config::get('emi_settings.interst.6'),
			'9'=>Config::get('emi_settings.interst.9'),
			'12'=>Config::get('emi_settings.interst.12')
			);


			$int_setting=$inter_setting[(int)$month];
			$interest=round(($int_setting/12)/100,4);
			$factor=pow(1+$interest,($month))-1;		
			$emi=$amount*$interest*pow((1+$interest),$month)/$factor;
			$emi_value =array('period'=>$month,'pay'=>round($emi));
			return $emi_value;

		}

		public static function do_typecast($data)
		{
			$data['first_name'] =(string)$data['first_name'] ;
			$data['last_name']  =(string)$data['last_name'] ;
			$data['s_email']    =(string)$data['s_email'] ;
			$data['mobile']     =(int)$data['mobile'] ;
		}


		public static function pg_setup($type,$pg_active)
		{
			


			
			if($type['ptype']==3 & $pg_active=='production')
			{
				// lets load the Tid from config for EMI options
				$emi_type=(int)$type['emi_optn'];

				$transport_setting=array(
				3=>Config::get('emi_settings.tid.3'),
				6=>Config::get('emi_settings.tid.6'),
				9=>Config::get('emi_settings.tid.9'),
				12=>Config::get('emi_settings.tid.12')
				);

				$pg_setup['tid']=$transport_setting[$emi_type];
				$pg_setup['password']=$transport_setting[$emi_type];

			}
			else
			{
				// lets load the Tid from config for PG options
				$pg_setup['tid']=Config::get('pg_settings.'.$pg_active.'.tid');
				$pg_setup['password']=Config::get('pg_settings.'.$pg_active.'.password');

			}

	

			return $pg_setup;
			
		}


		public static function pg_keys($udf2,$udf3,$pg_active)
		{
			
			if($udf2=='PG')
			{
				
				$pg_setup['tid']=Config::get('pg_settings.'.$pg_active.'.tid');
				


			}else
			{
				

				$transport_setting=array(
				3=>Config::get('emi_settings.tid.3'),
				6=>Config::get('emi_settings.tid.6'),
				9=>Config::get('emi_settings.tid.9'),
				12=>Config::get('emi_settings.tid.12')
				);
				$pg_setup['tid']=$transport_setting[$udf3];



			}


			return $pg_setup;


		}

	






}
