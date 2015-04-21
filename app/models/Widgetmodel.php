<?php

class Widgetmodel extends Eloquent {
  
  
  public static function authenicate($credentials){
   
    $result = DB::table('customers')->where('email' , $credentials['email'])->where('password', sha1($credentials['password']))->get();
    if(count($result)>0){  
    foreach($result as $customer_info){
     $customer_id = $customer_info->id;
    }  
     Session::put('customer_id',$customer_id);  
     Session::put('customer_data', $result);       
     return 1;
    }else{ return 0; }
   
   }
  
   public static function Update_password($customer_id,$new_password){
   
   $update_result = DB::table('customers')->where('id', $customer_id)->update(array('password' => sha1($new_password)));
   if($update_result == 1){
   return 1;
   }
   }
   
   
   //registration
   public static function registration($id=false,$regis_details){
  
   if($id <> ''){
  
	$id = DB::table('customers')
            ->where('id', $id)
            ->update(array('firstname' => $regis_details['firstname'], 
                         'lastname' => $regis_details['lastname'],
                         'email' => $regis_details['email'],
    			 'phone' => $regis_details['phone'],
		         'dob' => $regis_details['dob'],
		         'martial'=>$regis_details['martial_status'],
		         'statementdate'=> $regis_details['statementdate'] ,
		         'gender'=>$regis_details['gender'],		         
		         'organization' => $regis_details['organization'],
		         'email_subscribe' => isset($regis_details['email_subscribe']) ? $regis_details['email_subscribe'] : 0 ,
		          'sms_subscribe' => isset($regis_details['sms_subscribe']) ? $regis_details['email_subscribe'] : 0,
		         'date'=>date ( 'Y-m-d H:i:s' )));
		          return $id;	         
		         
   }
   else{
   $id = DB::table('customers')->insertGetId(
    array('firstname' => $regis_details['firstname'], 
                         'lastname' => $regis_details['lastname'],
                         'email' => $regis_details['email'],
    			 'phone' => $regis_details['phone'],
		         'dob' => $regis_details['dob'],
		         'password' => sha1($regis_details['password']),
		         'organization' => isset($regis_details['organization']) ? $regis_details['organization'] : '',
		         'email_subscribe' => isset($regis_details['email_subscribe']) ? $regis_details['email_subscribe'] : 0 ,
		         'created_date'=>date( 'Y-m-d H:i:s' )));
		    
    return $id;
    
    }
   }
 
      public static function is_logged_in($redirect = false, $default_redirect = 'securelogin')
	{

		$customer = Session::get('customer_data'); 
		if(isset($customer)){
		foreach($customer as $cust){
              $customer_id = $cust->id;
               }
               } 
		
		if (!isset($customer_id))
		{
			//this tells gocart where to go once logged in
			if ($redirect)
			{
				return Redirect::to('securelogin');
			}

			if ($default_redirect)
			{
				redirect($default_redirect);
			}

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
                $result = DB::table('customers')->where('customers.id' , $id)->get();
		return $result;
	}
	
	//saving category based on the customers
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
      public static function check_password($customer_id,$password){
       $password_result = DB::table('customers')->where('id',$customer_id)->where('password', sha1($password))->get();    
      
	  if(count($password_result) == 0){
	  return 0;
	  }else{
	  return 1;}
      
      }
     
     
     public static function get_address_list($customer_id ){
     
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
	
		if($address)
		{   
			$address_info			= unserialize($address->field_data);
			$address->field_data	= $address_info;
			$address				= array_merge((array)$address, $address_info);
		}
		return $address;
	}
     
     
      public static function save_address($a){
      
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
	     
		if (isset($save['default_shipping_address']))
		{ 
	   $id = DB::table('customers')->where('id', $customer_id)->update(array('default_shipping_address' => $save['default_shipping_address']));
		          return $id;	         
		         
             }
            else{
            $id = DB::table('customers')
            ->where('id', $customer_id)
            ->update(array('default_billing_address' => $save['default_billing_addresss']));
		          return $id;	         
            }


   }
public static function getwidget($region,$position)
	{
		$widget=DB::table('widget')->Join('widget_relation', 'widget_relation.widget_id', '=', 'widget.id')->Join('template', 'template.id', '=', 'widget_relation.temp_id')->where('template.active','1')->where('widget.region',$region)->where('widget.position',$position)->get();
		return $widget;
	}

}
