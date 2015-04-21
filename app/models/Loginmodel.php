<?php
class Loginmodel extends Eloquent {
	
  public static function authenicate($credentials)
   {
        $result = DB::table('users')->where('email' , $credentials['email'])->first();


    
        if(count($result)>0){ 
        	$string=$credentials['password'];
		$hashedString=$result->password;
		$hasher=hasher::checkhash($string, $hashedString);
                if(!$hasher)
	         return 0; 
		$customer_id = $result->id;
		Session::put('customer_id',$customer_id); 
                unset($result->password); 
          	Session::put('customer_data', $result);       
		return 1;
        	    }
	        else{ 
		return 0; 
		}
   }
  
   public static function Update_password($customer_id,$new_password)
   {
         $hashed=hasher::hash($new_password);
         $update_result = DB::table('users')->where('id', $customer_id)->update(array('password'=>$hashed)); 
            if(count($update_result) == 1){
	     return 1;
	     }else{
	    return 0;}
   }
   
   
   //registration
   public static function registration($id=false,$regis_details)
   {
       
         
        if($id <> ''){  $birth_date =  date('Y-m-d', strtotime($regis_details['dob']));
           $id = DB::table('users')->where('id', $id)->update(array(
		        'first_name'    => $regis_details['firstname'], 
			'last_name'     => $regis_details['lastname'],
			'email'         => $regis_details['email'],
			'mobile'        => $regis_details['mobile'],
			'dob'           => $birth_date,
			'gender'        => $regis_details['gender'],		         
			'updated_at'    => date ( 'Y-m-d H:i:s' )));
		         return $id;	         
		         
                     }
         else{  

         //check the guest
	  $uflag=Loginmodel::check_guest($regis_details['email']);  
	  if($uflag)    
	  {
		// update the user entry
		DB::table('users')->where('email', $regis_details['email'])->where('user_type',2)->update(
			array(
			       'activated'  => '1',
			       'password'   => hasher::hash($regis_details['password']),
			       'user_type'=>1,
			       'created_at'=> date( 'Y-m-d H:i:s' )));
				
			       $result = DB::table('users')->where('email' , $regis_details['email'])->first();
				if(!empty($result)){
				$customer_id = $result->id;
				Session::put('customer_id',$customer_id); 
				unset($result->password); 
				Session::put('customer_data', $result);       
				return 1;
				}else{
				return 0;
				}      




	  }else{

          $id = DB::table('users')->insertGetId(array(
			'email'      => $regis_details['email'],
                        'activated'  => '1',
			'password'   => hasher::hash($regis_details['password']),
			'created_at'=> date( 'Y-m-d H:i:s' )));
			$result = DB::table('users')->where('id' , $id)->first();
			if(!empty($id)){
			$customer_id = $result->id;
			Session::put('customer_id',$customer_id); 
			unset($result->password); 
			Session::put('customer_data', $result);       
			return 1;
			}else{
			return 0;
			}        
			}
		}
                         
    }
 
      public static function is_logged_in($redirect = false, $default_redirect = 'securelogin')
	{
	   $customer = Session::get('customer_data'); 
	      if(isset($customer)&& isset($customer->id)){
		$customer_id = $customer->id;
               } 
              if (!isset($customer_id))
		{
		   if ($redirect) { return Redirect::to('securelogin');	}
		   if ($default_redirect) { redirect($default_redirect); }
         		return false;
	        }
	     else
		{
			return true;
		}
	}

         //getting all categories
     public static function get_all_categories($id)
	{
	    $result =  DB::table('categories_relation')->leftJoin('categories', 'f_categories_id', '=', 'categories.id')          
            ->select('categories.id', 'name')->where('active',1)->where('f_userid',$id)->get();
	   return (array)$result;
	}
	
	//get customer details
     public static function get_customer($id)
	{
                $result = DB::table('users')->where('users.id' , $id)->get();
		return $result;
	}
	
	//saving category based on the users
     public static function save_category($id,$regis_details)
	{    
	        DB::table('customer_category')->where('customer_id', '=', $id)->delete();
	        if(isset($regis_details['interestcat']) && !empty($regis_details['interestcat']))
	        {
	                foreach($regis_details['interestcat'] as $categtory)
	                {
	                $save['customer_id']=$id;
	                $save['category_id']=$categtory;	               
	                DB::table('customer_category')->insert($save);
	                }
	
	        }
	}

       //get customer selected category
     public static function get_customer_category($id)
	{       $result = DB::table('customer_category')->where('customer_id' , $id)->get();
	        return $result;
	}

      //checking password when changing password 
      public static function check_password($customer_id,$password)
        {
           $password_result = DB::table('users')->select('password')->where('id',$customer_id)->get();  
           $curr_pass = hasher::checkhash($password,$password_result[0]->password);
           if($curr_pass == $password_result){ 
	      return 1;
	     }else{
	    return 0 ;}
        }
     
      //checking email when registering
      public static function check_email($email)
       {
         $email_result = DB::table('users')->select('email')->where('email',$email)->where('user_type',1)->first(); 
          if(count($email_result) == 1){
	  return 1;
	  }else{
	  return 0;}
       }

	 public static function check_guest($email)
       {


		
         $email_result = DB::table('users')->select('email')->where('email',$email)->where('user_type',2)->first(); 
          if(count($email_result) == 1){
	  return 1;
	  }else{
	  return 0;}
       }


     public static function get_address_list($customer_id )
      {
         $addresses = DB::table('customers_address_bank')->where('customer_id',$customer_id)->get();
    		// unserialize the field data
		if($addresses)
		{
	        	foreach($addresses as &$add)
			{
				$add->field_data = unserialize($add->field_data);
			}
		}

		return $addresses;
     } 
      
      public static function get_address($address_id)
	{           $address = DB::table('customers_address_bank')->where('id',$address_id)->first();
			if($address) {   
			$address_info		= unserialize($address->field_data);
			$address->field_data	= $address_info;
			$address		= array_merge((array)$address, $address_info);
		                   }
		        return $address;
	}
     
     
      public static function save_address($a)
       {
          $data['field_data'] = serialize($data['field_data']);
	   // update or insert
		if(!empty($data['id']))
		{      $update_result = DB::table('customers_address_bank')->where('id',$data['id'])->update($data);
			return $data['id'];
		} else {
		         $id = DB::table('customers_address_bank')->insertGetId($data);
			return $this->db->insert_id();
	                }
       }

  public static function delete_address($id, $customer_id)
	{      
	  DB::table('customers_address_bank')->where('id', '=',$id)->where('customer_id', '=',$customer_id)->delete();
		return $id;
	}


  public static  function ship_add($customer_id,$save)
	{  
           if (isset($save['default_shipping_address']))  { 
	   $id = DB::table('users')->where('id', $customer_id)->update(array('default_shipping_address' => $save['default_shipping_address']));
           return $id;	 }
            else {
            $id = DB::table('users')->where('id', $customer_id)->update(array('default_billing_address' => $save['default_billing_addresss']));
            return $id;	         
            }
 }

   public static function forgot_password($email)
     {
          $password_result = DB::table('users')->select('password','id')->where('email',$email)->get();    
          if(isset($password_result[0]->password)){
           $password =  Loginmodel::generateRandomString();    
           $update = array('password'=>hasher::hash($password)); 
             
	   DB::table('users')->where('id',$password_result[0]->id)->update($update);
                       
                         $mail['user']     = $email;
	                 $mail['password'] =  $password;
                         $mail['id']       = $password_result[0]->id;
                         Loginmodel::sendMail($mail);
                         return 1; }
            else{
	      return 0;}
      
}

 public static function send_otp($email,$otp_number,$id){
             $mail['url']     =  Config::get('app.url');              
             $mail['user']    = $email;
             $mail['otp_num'] = $otp_number;
             $mail['id']      = $id;  
             Loginmodel::sendOtpMail($mail);
     }

  


  public static function generateRandomString($length = 8) 
     {
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
     }
     return $randomString;
     }
 

      public static function  sendMail($mail)
    {
         $view = 'emails.mail';
	 $code = $mail;
	 Mail::queue($view, compact('code'), function($message) use ($mail)
	 {
	  $message->to($mail['user'])->subject('SmartBuy: Password Reset ');
	 });
   }

     public static function  sendOtpMail($mail)
    {
         $view = 'cpanel::email.otpmail';
	 $code = $mail;
	 Mail::queue($view, compact('code'), function($message) use ($mail)
	 {
	  $message->to($mail['user'])->subject('One Time Password ');
	 });
   }
         public static function  send_registrationMail($email)
    {
         $mail['user']    = $email;
         $view = 'emails.registrationmail';
	 $code = $mail;
	 Mail::queue($view, compact('code'), function($message) use ($mail)
	 {
	  $message->to($mail['user'])->subject('SmartBuy: Registration');
	 });
   }                
         

    public static function  send_pass_change_Mail($email)
    {
         $mail['user']    = $email;
         $view = 'emails.change_password';
	 $code = $mail;
	 Mail::queue($view, compact('code'), function($message) use ($mail)
	 {
	  $message->to($mail['user'])->subject('SmartBuy: Password Change confirmation');
	 });
   }                
             
               
   public static function check_otp($customer_id,$otp)
      {
           $otp_result = DB::table('users')->where('id',$customer_id)->where('otp_num', 'LIKE', $otp)->where('otp_used', '=', '0')->first();  
                if(!empty($otp_result)){
		Session::put('customer_id',$customer_id);  
		Session::put('customer_data', $otp_result);       
	  	return 1;
	  }else{
         return 0;
	  }
     }

 public static function get_balance($id)
       {
         $balance = DB::table('customers_points')->select('balance')->where('user_id',$id)->first(); 
         return $balance ;
     
      }
      
}
