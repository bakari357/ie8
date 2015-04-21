<?php

class ElectricityPayment extends BaseController {

	//insurance payment home page
    	function electricity_payment($rtype = false)
       {
	/*$redirect    = Loginmodel::is_logged_in(false, false);
	if(!$redirect){
	return Redirect::to('securelogin');          
	}*/
	$data['electricity']= MobilePaymentmodel::getelectricity_payeername();
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	$this->load_reward_region('common','left',$data); 
      	$data['banners'] = Banner::get_todays_banner(5);
	$this->load_reward_region('auth','home',1);
	return $this->render_reward_theme('billdesk.eb',$data); 		

      }
  
	//do payments
      function do_payment()
      {    
        if(empty($_POST))  {
        return Redirect::to('electricity_payment');
        }
        $s_data=Session::get('data');
        if(isset($_POST) && !empty($_POST)){
        $rules=array();
	$rules['eb_name'] = "required";
	$rules['service_no'] = "required";
	$rules['amount'] = 'required|regex:/^[0-9]{1,10}$/';
        $messages = array(
	            'eb_name.required' => 'please select electricity provider.',
	            'service_no.required' => 'please enter valid consumer number.', );
        $validator = Validator::make(Input::all(), $rules,$messages);
        if ($validator->fails())
	{
	$errors = $validator->messages();
	 return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
	}
        else {
        $_POST['payment'] ='electricity';
	$data['post']=$_POST;
        } 
        } 
        else {
	$s_data['payment'] ='electricity';
	$data['post'] = $s_data;
	} 
        $data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_checkout',$data);                           
    }  
    
    public function eb_payment_final(){
        
        if(isset($_POST['s_email'])  && $_POST['s_email']!=''){
        $validator = Rewards::validation_common();
	if ($validator->fails())
	{
	   $messages = $validator->messages();
	 return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
                     			
	}
	}
        $data = Rewards::redirect_helper('ElectricityPayment@eb_payment_final'); //Redirect Url after login
	$data['getdetails']=$_POST; 
	$_POST=$data;
    
        $_POST['payment'] ='electricity';
	$data['post']=$_POST;
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_finalcheckout',$data); 
    }
    
    public function check_consumerno(){
    
    
      $serviceno_length = strlen($_POST['service_no']);
      $legth_array =array('5','11');
      
      if(!in_array($serviceno_length,$legth_array)){
      return 'false';
      }else{
      return 'true';
      }
    
    
    
    
    }
	
	


   }
