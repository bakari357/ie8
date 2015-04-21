<?php

class DthPayment extends BaseController {

       //dth paying home page
       function home($rtype = false)
       {  

		
        /*$redirect    = Loginmodel::is_logged_in(false, false);
	if(!$redirect){
	return Redirect::to('securelogin');          
	}*/
        $data['dth']=MobilePaymentmodel::get_dth_details();
        //echo '<pre>'; print_r($data['dth']); exit;
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	
	$data['bread_crumb']=array('Home'=>'/');
	$this->load_reward_region('common','left',$data); 
      	$data['banners'] = Banner::get_todays_banner(5);
	$this->load_reward_region('auth','home',1); 
	return $this->render_reward_theme('billdesk.dth',$data); 		
    }


   //dth checkout page
    public function do_payment(){
	
	if(empty($_POST))  {
        return Redirect::to('dth_payments');
        }
        $s_data=Session::get('data');
        if(isset($_POST) && !empty($_POST)){	
        $rules=array();
	$rules['dth_name'] = "required";
	$rules['subscriber_name'] = "required|regex:/^[a-z\s]+$/i";
        $rules['subscriber_id'] = "required|regex:/^[0-9]{1,10}$/";
	$rules['amount'] = 'required|regex:/^[0-9]{1,10}$/';

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
	{
	$errors = $validator->messages();
	 return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
	}
        else{
	$request=array();
	$_POST['payment'] ='DTH';
	$data['post']=$_POST;
	}
	
	}
	
	else {

	if(empty($s_data)){ 

	  return Redirect::to('oops');  
	}
	$s_data['payment'] ='DTH';
	$data['post'] = $s_data;
	} 
	
	$bread_crumb=array('Home'=>'/');
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_checkout',$data); 

        
    }
    
    public function do_payment_final(){
        
        if(isset($_POST['s_email'])  && $_POST['s_email']!=''){
        $validator = Rewards::validation_common();
	if ($validator->fails())
	{
	   $messages = $validator->messages();
	 return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
                     			
	}
        }
	$data = Rewards::redirect_helper('DthPayment@do_payment_final'); //Redirect Url after login
	$data['getdetails']=$_POST; 
	$_POST=$data;
	$_POST['payment'] ='DTH';
	$data['post']=$_POST;
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	//echo '<pre>'; print_r($data['post']); exit;
	return $this->render_reward_theme('checkout.payment_finalcheckout',$data); 
    }



    //loading card details calling by ajax
    function load_dth_biller_id() {
     $ubp_biller_id = $_POST['dth_id'];
     $area_details = DB::table('billers')->where('id',$ubp_biller_id)->first(); 
     echo json_encode( $area_details->ubp_biller_id);
  
  }	  

      
 }

