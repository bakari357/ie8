<?php require_once(app_path().'/lib/nusoap.php');
   
   class Checkout extends BaseController {
   
   
    public function index()
	{
	      
                Loginmodel::is_logged_in('Checkout');
                if (Cart::count() == 0){
                
                return Redirect::to('view_cart');
                }
                $inventory_check	= Cartlibrary::check_inventory();
                $data['payment_methods']	= array();
                $data['customer']	=  Session::get('customer_data');
                $data['bread_crumb']=array('Home'=>'/');
      		$data['css_array'] = array('css/jquery-ui.css','css/style1.css','css/stream.css','css/tabcontent.css','css/jquery-ui-1.10.3.custom.css');
      		$data['js_array'] = array('js/jquery.select_skin.js','js/html5.js','js/chck_box.js','js/ddaccordion.js','js/jquery-ui-1.10.3.custom.js','js/jquery.lazyload.js');
	      return BaseController::render_reward_theme('checkout.physical_checkout',$data); 
                                	
	}
               function save_customer()
               {
                $customer['ship_to_bill_address'] = 'false';
                $customer['ship_address']['firstname']		= Input::get('cname');
               // $customer['ship_address']['lastname']		=Input::get('lastname');
                $customer['ship_address']['email']		= Input::get('email');
                $customer['ship_address']['phone']		= Input::get('mobile');
                $customer['ship_address']['address1']		= Input::get('address');
                Session::put('customer',$customer);
               }
         

               /* public function place_order()
                {
                $customer = Session::get('customer_data');
                $data['customer'] = (array)$customer;
                $payment = SettingModel::get_settings('payment_modules');
                $data['reason']='Your Order is successfull.';
                $data['status']='Successful';
                $contents = Cart::content();
                $order_details= Cartlibrary::save_physical_order();
exit;
                $data['order_number']			= $order_details->number;
                $data['order_id']			= $order_details->id;
                $data['download_section'] = '';
                       if(empty($contents))
                        {
                        return Redirect::to('view_cart');
                        }foreach (Cart::content() as $cartkey=>$product)
                        {

                        if($product['options'])
                        {
                        $extended_products=Ordermodel::get_extended_products($data['order_id']);
                        
                        echo '<pre>'; print_r($extended_products); exit;
                        
                        $input=json_decode($extended_products['input']);
                        $output=json_decode($extended_products['output']);
                        $user['email']= $input->ship_address->email;
                        $user['name']=ucfirst($input->ship_address->firstname);
                        if(isset($extended_products))
                        {
                        if (Config::get("auth.emailActivation")) {
                        $data['product_input'] =  $input;
                        $product_output = $output;
                        $data['product_output']=unserialize($product_output->Output);

                        $count = Mail::send(Config::get("auth.emailViewPath").".product_order_mail", $data, function($message) use ($user,  $user) {
                        $message->to($user['email'], $user['name'])->subject("Product Order Email");
                        });
                        }} }
                        $data['output']=$output->status;
                        $data['bread_crumb']=array('Home'=>'/');
                        $data['css_array'] = array('frontend_left/layout/css/style.css','frontend_left/pages/css/style-shop.css','frontend_left/layout/css/style-responsive.css','frontend_left/layout/css/custom.css');
                        $data['js_array'] = array('frontend_left/layout/scripts/back-to-top.js','global/plugins/jquery-slimscroll/jquery.slimscroll.min.js','frontend_left/layout/scripts/layout.js','frontend_left/pages/scripts/checkout.js');
                        return $this->render_reward_theme('checkout.order_placed',$data);
               }
               function  product_checkout(){
	       
	       return Redirect::to('checkout');
              }
               
              
          
	
  }*/
  
  
   public function place_order()
                {  
                
                $login=Session::get('customer_data'); if(!$login){
                       foreach(Cart::content() as $key=>$item)
                       {
                       $s_email=$item['options']['apiproduct']['Posted']['s_email'];
                        $result = DB::table('users')->where('email' , $s_email)->first();
                            if(count($result)==0){ 
                       $id = DB::table('users')->insertGetId(array(
                       'email'      => $s_email,
                       'created_at'=>date( 'Y-m-d H:i:s') ));
                       $result = DB::table('users')->where('id' , $id)->first();
                       Session::put('customer_id',$id); 
                       unset($result->password); 
                       Session::put('customer_data', $result); 
                       $customer = Session::get('customer_data');
                       
                       }else{
                       Session::put('customer_id',$result->id); 
                       unset($result->password); 
                       Session::put('customer_data', $result); 
                       $customer = Session::get('customer_data');
                       }
                       }
                       
                       }else{
                       $customer = Session::get('customer_data');
                       }
                
                $data['customer'] = (array)$customer;
                $payment = SettingModel::get_settings('payment_modules');
                $data['reason']='Your Order is successfull.';
                $data['status']='';
                $contents = Cart::content();
              
                $order_number= Cartlibrary::save_digital_order();
		
                $order_details=DB::table('orders')->where('order_number',$order_number)->first();
		$data['order_details']  = $order_details;		
		
                $data['order_number']			= $order_details->order_number;
                $data['order_id']			= $order_details->id;
                $data['download_section'] = '';
                
                
                       if(empty($contents))
                        {
                        return Redirect::to('view_cart');
                        }foreach (Cart::content() as $cartkey=>$product)
                        {

                        if($product['options'])
                        {
                        $extended_products=Ordermodel::get_extended_products($data['order_id']);
                   
						
                        $input=json_decode($extended_products['input']);
                       
                        $output=json_decode($extended_products['output']);
                    
                        $data['output']=$output->status;
                        if(isset($output->Output->result->response->url)){
						$data['download_section'] = $output->Output->result->response->url;
						$data['status'] = 'Successful';
						}
						$data['input']=$input;
						
					
						
                        $data['bread_crumb']=array('Home'=>'/');
                        $data['css_array'] = array('frontend_left/layout/css/style.css','frontend_left/pages/css/style-shop.css','frontend_left/layout/css/style-responsive.css','frontend_left/layout/css/custom.css');
                        $data['js_array'] = array('frontend_left/layout/scripts/back-to-top.js','global/plugins/jquery-slimscroll/jquery.slimscroll.min.js','frontend_left/layout/scripts/layout.js','frontend_left/pages/scripts/checkout.js');
						
						if($data['input']->API_Type == 'Hungama'){
						Checkout::mailing($data); 
						 return $this->render_reward_theme('checkout.music_placed',$data);
						}
                                            /* if($data['input']->API_Type == 'funcinemas'){
						Checkout::mailing($data); 
						 return $this->render_reward_theme('checkout.funcinemas_placed',$data);
						}*/
					 if($data['input']->API_Type == 'hotels'){
								Checkout::Mailing_hotels($data); 
								$val=Xml2array::toArray($data['input']);
								$data['values'] = $val['Posted'];

								return $this->render_reward_theme('checkout.hotel_placed',$data);
						}

                                                   if($data['input']->API_Type == 'cinepolis'){
								//Checkout::Mailing_hotels($data);
                                                                $val=Xml2array::toArray($data['input']);
								$data['values'] = $val['Posted'];

					return $this->render_reward_theme('checkout.cinepolis_placed',$data);
						}
						
							 if($data['input']->API_Type == 'cleartrip'){
								 
								$val=Xml2array::toArray($data['input']);
								$data['values'] = $val['Posted'];
								return $this->render_reward_theme('checkout.hotel_clr_placed',$data);
						}
						
						if($data['input']->API_Type == 'recharge'){
						$data['values'] = $extended_products['output'];
						$data['post'] = $data;
						$exist=array('order_id'=>(int)$data['order_id']);
						$condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);
						foreach($condrestwo as $condrestw){
						$data['input']=json_decode($condrestw['input']);
						$response[]=json_decode($condrestw['output']);
						}
						$post=Xml2array::toArray($data['input']);
						$data['user'] = $post['Posted']['s_email'];
						//echo '<pre>'; print_r($post); exit;
						$oper = $post['Posted']['operator'];
						$operator = DB::Select(DB::RAW("select operator from pp_myoxi_operators where abbr='".$oper."'"));

						$data['operator']=@$operator[0]->operator;
						$data['post']=array_merge($data,$post['Posted']);

						$data['recharge_details']= array_merge($response,$_POST);
						$rm_details=$data['recharge_details']; 
						
						$error_handle = explode('<',$rm_details[0]->Response);
						if(isset($error_handle[0])&& $error_handle[0]!=''){
						if(isset($rm_details[0]->Response)){
						
						$recharge_result =  explode('~',$rm_details[0]->Response);
						if($recharge_result[6] =="Y") {$data['status'] = 'Successful'; }
						else { $data['status'] = 'Failed'; }
						}
						} else { $data['status'] = 'Failed'; }

						$view = 'checkout.recharge_placed';
						
						
						}
                                          if($data['input']->API_Type == 'Flights'){
						$exist=array('order_id'=>(int)$data['order_id']);
							$condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);
							foreach($condrestwo as $condrestw){
							$response=json_decode($condrestw['output']);
							$data['xml_array']=Xml2array::xml2array_test($booking_details);
							}
							$val=Xml2array::toArray($data['input']);
								$data['post'] = $val['Posted'];
							$data['flight_details']=$flight_details= json_decode(urldecode($data['post']['details_checkout']));
							 return $this->render_reward_theme('flightraja.booking_summary',$data);
						 
						 }
						 //cleartrip flights
                                                        if($data['input']->API_Type == 'Cleartrip_flights'){
                                                        
                                                        $exist=array('order_id'=>(int)$data['order_id']);

                                                        $condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);

                                                        foreach($condrestwo as $condrestw){

                                                        $response=json_decode($condrestw['output']);
                                                        
                                                        $data['xml_array']=$xml_array=Xml2array::xml2array_test(urldecode($response->booking_id));

                                                         }
                                                         $data['status'] = 'Failed';
                                                         
                                                         if(isset($xml_array['book-response']['trip-id']) && $xml_array['book-response']['trip-id']<>'')
                                                         {
                                                         $data['status'] = 'Successful';
                                                         }
                                                                
                                                        
                                                        $val=Xml2array::toArray($data['input']);

                                                        $data['post'] = $val['Posted'];
                                                        //$data['flight_details']=$flight_details= json_decode(urldecode($data['post']['details_checkout']));
                                                       
                                                        Checkout::Mailing_flights($data); 
                                                        if(isset($data['input']->Posted->type) && $data['input']->Posted->type=='R')
                                                        {
                                                        return $this->render_reward_theme('goibibo.booking_summary_round',$data);
                                                        }
                                                        else
                                                        {
                                                        return $this->render_reward_theme('goibibo.booking_summary',$data);
                                                        }
                                                        /*}
                                                        
                                                        else
                                                        {
                                                         Session::flash('message', "Flight Selected is full or having some error for booking, please try another flight !!!");
                                                         return Redirect::to('flight_index');
                                                        }*/
                                                        	 
						 }
						 
						//goibibo flights
                                                        if($data['input']->API_Type == 'goibibo_flights'){
                                                        
                                                            
                                                        $exist=array('order_id'=>(int)$data['order_id']);

                                                        $condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);

                                                        foreach($condrestwo as $condrestw){
                                                        $response=json_decode($condrestw['output']);
                                                         }
                                                         
                                                         if(isset(json_decode($response->booking_data)->data['0']->bookingid))
                                                        {
                                                            $data['rules']=Viaflight::fare_rules_goibibo(json_decode($response->booking_data)->data['0']->bookingid);
                                                        }
                                                        
                                                        
 		                                         $val=array();                       
                                                        
                                                        $val=$data['input'];
                                                        $data['response']=$response;
                                                        //echo "<pre>";print_r($response);exit;
                                                        $data['post']=(array)$val->Posted;
                                                        $data['book_passenger']=$val->Posted->book_passenger;
                                                 
                                                     
                                                       //Checkout::Mailing_flights($data);
                                                       
                                                        if(isset($data['input']->Posted->type) && $data['input']->Posted->type=='R')
                                                        {
                                                    $view = 'goibibo.booking_summary_round';
                                                       
                                                        }
                                                        else
                                                        {
                                                    $view = 'goibibo.booking_summary';
                                                        }
                                                        	 
						 }
                        return $this->render_reward_theme($view,$data);
               }
        	}}
  
  		function checkout_process()
		{
			                       
			Cart::destroy();
			$ctype=$_POST['ctype'];
			$cdata=$_POST;
			$ptype=$_POST['ptype'];
			switch($ctype)
			{
				
				case 'movie2':
				$checkout=Funcinemas::checkout($cdata);
                                $cdata['partner']='Funcinemas';
				$cart=Checkouthelper::cart_process($checkout,$cdata);	
				break;
				case 'movie1':
				$checkout=Cinepolis::checkout($cdata);
                                $cdata['partner']='Cinepolis';
				$cart=Checkouthelper::cart_process($checkout,$cdata);	

				break;
				case 'music':
				$checkout=Hungama::checkout($cdata);
				$cdata['amount']=10;
				$cdata['partner']='Hungama';
				$cart=Checkouthelper::cart_process($checkout,$cdata);	
				break;	
			
			        case 'recharge':
				$checkout=Billdeskhelper::checkout($cdata);
				$cdata['amount'] = $cdata['amount'];
				$cdata['partner']='Billdesk';
				$cart=Checkouthelper::cart_process($checkout,$cdata);
				break;

				case 'hotels1':
				$data['getdetails']=(array)json_decode(urldecode($_POST['postvalue'])); 
				$value=array_merge($data['getdetails'],$_POST);
				$checkout=Hotel::checkout($value);
				$value['partner']='Expedia';
				$cart=Checkouthelper::cart_process($checkout,$value);
				break;
		
				case 'hotels2':
				$post=$_POST; 
				$checkout=Hotel::clr_checkout($post);
				
				$post['partner']='clear trip Hotels';
				$cart=Checkouthelper::cart_process($checkout,$post);
				break;
				
				case 'via_airlines':
				$post=$_POST;
				$data['flight_details']=$flight_details= json_decode(urldecode($_POST['details_checkout']));
				$api= json_decode(urldecode($_POST['check_airprice']));
				$checkout=Viaflight::checkout($api);
				$cart=Checkouthelper::cart_process($checkout,$post);
				break;
				
				case 'clear trip Flights':
				
				$post=$_POST;
				//$data['flight_details']=$flight_details= json_decode(urldecode($_POST['details_checkout']));
				//$api= json_decode(urldecode($_POST['check_airprice']));
				$value=$_POST;
				$itinerary_id=$_POST['itinerary_id'];
				$checkout=Viaflight::cleartrip_checkout($value);
				$post['partner']=$checkout['partner'];
				
				$cart=Checkouthelper::cart_process($checkout,$post);
				break;
				case 'Goibibo':
				
				$post=$_POST;
				//$data['flight_details']=$flight_details= json_decode(urldecode($_POST['details_checkout']));
				//$api= json_decode(urldecode($_POST['check_airprice']));
				$value=$_POST;
				
				$checkout=Viaflight::goibibo_checkout($value);
				$post['partner']=$checkout['partner'];
				
				$cart=Checkouthelper::cart_process($checkout,$post);
				break;
			}
		
			if($checkout['quantity'] > 0){
				if($ptype==1 || $ptype==3)
				{
				 
		 			$pay_info['ptype']=$ptype;
					if($ptype==3)
					$pay_info['emi_optn']=$_POST['emi_option'];
				            //return Redirect::action('Checkout@place_order');  
				 return Redirect::action('Hdfcpayment@hdfc_do')->with('ptype',$pay_info);
				}
				else
				{

					 return Redirect::action('Netbanking@online_banking');	

				}
				

			}
			

		}
 

		 public function Mailing_hotels($data){

							$exist=array('order_id'=>(int)$data['order_id']);
							$condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);
							foreach($condrestwo as $condrestw){
							$response=json_decode($condrestw['output']);
							$hotel_details = Xml2array::toArray($response->booking_id);
							}
							$post=Xml2array::toArray($data['input']);

  						$mail['user'] = $post['Posted']['s_email'];
						$mail['post']=$post['Posted'];
						$mail['rm_details']=$hotel_details;
						 $mail['order_num'] = $data['order_number'];
						if(!empty($customer)){
						$mail['customer']=$customer;}
						$view = 'cpanel::email.hotels_mail';$message="nijknkj";
						$code = $mail;
						Mail::queue($view, compact('code'), function($message) use ($mail)
						{
						$message->to($mail['user'])->subject('hotels booked ');
						});
  		
  				}


            //recharge mail 
            
            public static function recharge_mail($data){

				$exist=array('order_id'=>(int)$data['order_id']);
				$condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);
				foreach($condrestwo as $condrestw){
				$data['input']=json_decode($condrestw['input']);
				$response[]=json_decode($condrestw['output']);
				}

				$post=Xml2array::toArray($data['input']);

				$mail['user'] = $post['Posted']['s_email'];
				//echo '<pre>'; print_r($post); exit;
				$oper = $post['Posted']['operator'];
				$operator = DB::Select(DB::RAW("select operator from pp_myoxi_operators where abbr='".$oper."'"));
				
				$mail['operator']=@$operator[0]->operator;
				$mail['post']=$post['Posted'];
				$mail['recharge_details']= array_merge($response,$_POST);
				$mail['order_number'] = $data['order_number'];
				if(!empty($customer)){
				$mail['customer']=$customer;}
				$view = 'cpanel::email.recharge_mail';$message="nijknkj";
				$code = $mail;
				Mail::queue($view, compact('code'), function($message) use ($mail)
				{
				$message->to($mail['user'])->subject('Order Status');
				});
  		
  				}
  				
  				
  				 public static function Mailing_flights($data){
				
				$exist=array('order_id'=>(int)$data['order_id']);
				
				$mail = $data; 
				$condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);
				
				foreach($condrestwo as $condrestw){
				$data['input']=json_decode($condrestw['input']);
				$response[]=json_decode($condrestw['output']);
				}

				$post=Xml2array::toArray($data['input']);
				$mail['user'] = $post['Posted']['s_email'];
				
				$mail['post']=$post['Posted'];
				$mail['order_number'] = $data['order_number'];
				if(!empty($customer)){
				$mail['customer']=$customer;}
				$view = 'cpanel::email.cleartrip_mail';$message="nijknkj";
				$code = $mail;
				Mail::queue($view, compact('code'), function($message) use ($mail)
				{
				$message->to($mail['user'])->subject('Order Status');
				});
  		
  				}
  
  }
	

