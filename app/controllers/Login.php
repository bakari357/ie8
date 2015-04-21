<?php
class Login extends BaseController {

  public  function securelogin()
    { 
	$validation = '';
	if(Input::get()){		
	$credentials = Input::get();
       
	 $login = Loginmodel::authenicate($credentials); 
        $active=DB::table('users')->select('activated')->where('email',$credentials['email'])->first(); 
      	if($login == 1 && $active->activated == 1){
	$value = Session::get('customer_data'); 
	$url = Session::get('request_url');
       
	Session::forget('request_url');
	
	return Redirect::to($url);
	}
	else { $validation = 'Sorry! Your login details do not match our records. Please try again!';  }
	}
	$menus=array('one','two');    		
	$data['bread_crumb']=array('Home'=>'/');
	$data['validation'] = $validation;
	$bread_crumb =array('Home'=>'/');
	$this->load_reward_withoutheader_theme('HDFC Superia-Credit Card','auth.login','auth',$bread_crumb,'','',''); 
	return $this->render_login_theme('auth.login','auth',$data); 
    }
   
    public  function poplogin()
    { 
	$validation = '';
	if(Input::get()){		
	$credentials = Input::get();
		
	 $login = Loginmodel::authenicate($credentials); 
        $active=DB::table('users')->select('activated')->where('email',$credentials['email'])->first(); 
      	if($login == 1 && $active->activated == 1){
	$value = Session::get('customer_data');
		$value = base64_encode(json_encode($value)); 
	
    $validation['value'] = $value;
	$validation['status'] = 'Success';
	echo json_encode($validation);
	exit;
	}
	else { $validation['status'] = 'Login details do not match our records.'; 
			echo json_encode($validation);
			exit;
	 }
	}
	$menus=array('one','two');    		
	$data['bread_crumb']=array('Home'=>'/');
	$data['validation'] = $validation;
	$bread_crumb =array('Home'=>'/');
	$this->load_reward_withoutheader_theme('HDFC Superia-Credit Card','auth.login','auth',$bread_crumb,'','',''); 
	return $this->render_login_theme('auth.poplogin','ajax',$data); 
    }
    
    public function redirections($val){
    	
    	$customer = json_decode(base64_decode($val)); 
    	Session::put('customer_data', $customer); 
    	$data = Session::get('login_redirect');
    	$action = $data['method'];
    	if(empty($data)){
    	
    	$action = 'to';
    	}
    	
		//echo '<pre>'; print_r($data); exit; 
    	return Redirect::to($data['url']);
    }
    public  function checkout_login()
    {
	$validation = '';
	if(Input::get()){		
	$credentials = Input::get();
	 $login = Loginmodel::authenicate($credentials); 
        $active=DB::table('users')->select('activated')->where('email',$credentials['email'])->first(); 
        
	if($login == 1 && $active->activated == 1){
	$value = Session::get('customer_data'); 
	$error = ''; 
	}
	else {  $error = 'Login details do not match our records.';  }
	}
		
			$key = Session::get('for_redirect'); 
			$key['error'] = $error; 
			Session::put('for_redirect', $key); 
		return Redirect::action($key['refer']);
    }


	//logout function
  public function logout()
    {
	Session::flush();     
	return Redirect::to('');  
    }

	//customer registration function
  public function registration()
    { 
        
	$redirect = Loginmodel::is_logged_in(false, false);   
	$templ=DB::table('template')->where('active','1')->get();
     
	if($redirect){
	return Redirect::to('myaccount');  
	 }
       
      if(Input::get()){
	$rules = array();        
        $validation = Validator::make(Input::all(), $rules);
	if($validation->fails()) {  
	return Redirect::back()->withInput()->withErrors($validation);
	}             

        $regis_details = Input::get();
        $otp_number =  Loginmodel::generateRandomString();
	$result = Loginmodel::registration($id=false,$regis_details,$otp_number);
    
                   
	    if($result){ 
             $user_id['id'] = base64_encode($result);
             $mail_result = Loginmodel::send_otp($_POST['email'],$otp_number,$user_id['id']);
             return Redirect::to('otp_number/'. $user_id['id'])->with('data',$user_id);
            
	       } 
	}
	
	$menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	
	return $this->render_reward_theme('auth.register',$data);
   }



	//change password
  public function signup()
    {
	if(Input::get()){
	$rules['email'] = 'required|email'; 
	$rules['password'] = 'required|min:6|confirmed';        
        $validation = Validator::make(Input::all(), $rules);
	if($validation->fails()) {  
	return Redirect::back()->withInput()->withErrors($validation->messages());
	}             

        $regis_details = Input::get();
       	$data['result'] = Loginmodel::registration($id=false,$regis_details);
 
        $mail_result = Loginmodel::send_registrationMail($_POST['email']);
            if($data['result'] == 0){
	echo "0";     
          }
        else{ 
            
	echo 1;
		 return Redirect::to('');
	    }
                   
	     
	}

	$menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['test'] ='testest';
	$bread_crumb=array('Home'=>'/');
	$css_array = array('css/jquery-ui.css','css/style1.css','css/stream.css','css/tabcontent.css','css/jquery-ui-1.10.3.custom.css');

	$js_array = array('js/jquery.select_skin.js','js/jquery-ui-1.10.3.custom.js','js/jquery.validate.js');
	$this->load_reward_withoutheader_theme('HDFC Superia-Credit Card','auth.change_password','auth',$bread_crumb,'','',$css_array,$js_array); 

	return $this->render_login_theme('auth.signup','auth',$data); 
	
	}
 

	//myaccount function
   public function myaccount()
    {     
        $redirect	= Loginmodel::is_logged_in(false, false);
	$templ=DB::table('template')->where('active','1')->get();
	if($redirect){
	$result = Session::get('customer_data'); 
           $customer_id = $result->id;
           
         $data['active']=DB::table('users')->select('activated')->where('id',$customer_id)->first(); 
 
	 $data['update']=Session::get('data');
	
	$data['customer'] =Loginmodel::get_customer($customer_id);
	//here 2 is user_id      
	$allcategories=Loginmodel::get_all_categories(2);
	foreach($allcategories as $allcategory)
	{
	$all_categories[$allcategory->id]=$allcategory->name;
	}
	$data['allcategories']=$all_categories;
	$data['interestcat'] = array();
	$categories= (array)Loginmodel::get_customer_category($customer_id);
	if(!empty($categories))
	{
	foreach($categories as $cate)
	{
	$categorys[]=$cate->category_id;
	}
	$data['interestcat']=$categorys;
	} 
 
	if(Input::get())
	{  
	$regis_details = Input::get();
    
        $otp = '';
	if($customer_id <>''){
	$result = Loginmodel::registration($customer_id,$regis_details,$otp);
        
	Loginmodel::save_category($customer_id,$regis_details);
	}   
        
	$data['update'] = '<font size="2px;" color="green" style="margin-top: 2px;margin-left: 9px; position: absolute;">Your account has been updated successfully..! </font>';

	return Redirect::to('myaccount')->with('data',$data['update']); 
             }
          


	$menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['test'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');

	
	
	return $this->render_reward_theme('auth.myaccount',$data); 
	}
	else{
	return Redirect::to('securelogin'); 	     
	}
  }
 

          
	//change password
  public function change_password()
    { 
	$redirect	= Loginmodel::is_logged_in(false, false);
	if($redirect){
	if(Input::get()){
	$result = Session::get('customer_data'); 
	
	
	        $customer_id = $result->id;
	    
	
	$new_password = Input::get('password1');
	$upadte =  Loginmodel::Update_password($customer_id,$new_password );
          
	if($upadte == 1){ 
          $mail_result = Loginmodel::send_pass_change_Mail($result->email);
	$data['update'] ='<font size="2px;" color="green" style="margin-top: 3px;margin-left: 10px; position: absolute;">Password Changed successfully...! </font>';
         return Redirect::to('myaccount')->with('data',$data['update']); 
	}
	}
	$menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['test'] ='testest';
	$bread_crumb=array('Home'=>'/');
	$css_array = array('css/jquery-ui.css','css/style1.css','css/stream.css','css/tabcontent.css','css/jquery-ui-1.10.3.custom.css');

	$js_array = array('js/jquery.select_skin.js','js/jquery-ui-1.10.3.custom.js','js/jquery.validate.js');
	$this->load_reward_withoutheader_theme('HDFC Superia-Credit Card','auth.change_password','auth',$bread_crumb,'','',$css_array,$js_array); 

	return $this->render_login_theme('auth.change_password','auth',$data); 
	}
	else{
	return Redirect::to('securelogin'); 
	}
  }
   

	//Create new password
  public function create_new_password($id)
   {   
       if(Input::get()){
	
	$new_password = Input::get('password');
       	$update =  Loginmodel::Update_password($id,$new_password );
	if($update==1){
	$data['update'] = 'Password has been updated successfully.';
           return Redirect::to('securelogin')->with('success','<font color="green" style="margin-top:10px;">Password has been updated successfully.<br/>Login with new password</font>');
	}}
	
	$menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['test'] ='testest';
	$bread_crumb=array('Home'=>'/');

	$js_array = array('js/jquery.validate.js');
	$this->load_reward_withoutheader_theme('HDFC Superia-Credit Card','auth.create_new_password','auth',$bread_crumb,'','','',$js_array); 
	return $this->render_login_theme('auth.create_new_password','auth',$data); 

	
	}


   
       //checking Password
	public function check_password()
             {
	      
                $result = Session::get('customer_data'); 
                $customer_id = $result->id;
	       
               $password = trim($_POST['current_password']);
                  if (isset($password)&&$password<>'')       {
               $valid_password =Loginmodel::check_password($customer_id,$password);
	   
	       if($valid_password == 0){
	      $valid = 'false';
                       }
                      else
                      {
                     $valid = 'true';
                      }
                 echo $valid; 
	      }
            }  
	



//checking Email


	public function check_email(){
	        
	      $email = trim($_POST['email']);

                if (isset($email)&&$email<>'')       {
	      $valid_email =Loginmodel::check_email($email);
	      $out ='';
          
	      if($valid_email == 1){
	      $valid = 'false';
                       }
                      else
                      {
                     $valid = 'true';
                      }
                 echo $valid; 
           }    
	}


  
  public function forgot_password() 
   {
	$validation = '';
	if($_POST){
	$email = Input::get('email');
	$result = Loginmodel::forgot_password($email);
	if($result == 1){
	return Redirect::to('securelogin')->with('success',"<font color='#00008B' size='2px;' style='margin-top: -27px;margin-left: 15px;'>New password has been sent to your registered email id</font>");
	
         
	}
	else{
	$validation = "<font  color='red' style='margin-top: -33px;margin-left: 2px;font-size:11px;position: absolute;'>The email ID you entered do not match our records. Please check and try again!</font>" ;
	}
	}  
	$menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['validation'] =  $validation;
	$bread_crumb=array('Home'=>'/');
	$this->load_reward_withoutheader_theme('HDFC Superia-Credit Card','auth.forgot_password','auth',$bread_crumb,'','',''); 
	return $this->render_login_theme('auth.forgot_password','auth',$data); 
   }
  
          
  /*  public static function  otp_number()
			{ 

	$randomString = Loginmodel::generateRandomString();
	$mobile =$_POST['mobile'];
	$amount =10;
	$smsmsg="Dear HDFC Bank Superia Customer, your voucher code ".$randomString." for Rs ".$amount." is generated. Login to www.hdfcbanksuperia.com to redeem your voucher right away!";
	
	// Below lines are for sms changed by joseph ugin
	$smsurl="wget -r 'http://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=".$mobile."&msg=".urlencode($smsmsg)."&msg_type=TEXT&userid=2000112885&auth_scheme=plain&password=abc1234&v=1.1&format=text'";
	//print_r($smsurl);exit;
	$output=exec($smsurl);
	//print_r($output);
	//exit;

        $out =$randomString;

            echo $out;



			} */
//checking OTP
	

public function check_otp()
  {                  
        $id = base64_decode($_POST['user_id']);
        $otp = trim($_POST['otp_num']);
      
        $valid_otp =Loginmodel::check_otp($id,$otp);
        
	if($valid_otp == 0){
	echo "0";     
          }
        else{
           $otps = DB::table('users')->where('id', $id)->update(array(  
           'activated' => '1','otp_used'=>'1'));
 
	echo 1;
		
	    }
	}


   public function otp_number() 
      {       
        $data['id']=Session::get('data');
       $menus=array('one','two');    		
	$data['bread_crumb']=array('Home'=>'/');
	$bread_crumb=array('Home'=>'/');
	$this->load_reward_withoutheader_theme('HDFC Superia-Credit Card','auth.otp_number','auth',$bread_crumb,'','',''); 
	return $this->render_login_theme('auth.otp_number','auth',$data); 
   
         }

}

