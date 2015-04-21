<?php

class InsurancePayment extends BaseController {

	//insurance payment home page
    	function insurance_payment($rtype = false)
    {
		/*$redirect    = Loginmodel::is_logged_in(false, false);
		if(!$redirect){
		return Redirect::to('securelogin');          
		}*/
                $data['insurance']= MobilePaymentmodel::getinsurance_payeername();
		$bread_crumb=array('Home'=>'/');
		$data['page'] ='testest';
      		$data['bread_crumb']=array('Home'=>'/');
       		$this->load_reward_region('common','left',$data); 
      	        $data['banners'] = Banner::get_todays_banner(5);
		$this->load_reward_region('auth','home',1);
	        return $this->render_reward_theme('billdesk.insurance',$data); 	
    
    }

	//do payments
      function do_payment()
    {    
     
        if(empty($_POST)){
        return Redirect::to('insurance_payment');
        }
     $s_data=Session::get('data');

     if(isset($_POST) && !empty($_POST)){	
       $rules=array();
	$rules['insurance_name'] = "required";
        $rules['policy_no'] = "required"; 
        $rules['client_id'] = "required";
	$rules['premium_amount'] = "required|regex:/^[0-9]{1,8}$/";
	$rules['amount'] = 'required|regex:/^[0-9]{1,10}$/';
        $messages = array(
	             'insurance_name.required' => 'please select insurance name.',
	            );
        $validator = Validator::make(Input::all(), $rules,$messages);
        if ($validator->fails())
	{
	$errors = $validator->messages();
	  return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
	}  
        
	 $_POST['payment'] ='insurance';
         $data = $_POST;
         $data['post'] = $_POST;
         }
	else {
	$s_data['payment'] ='insurance';
	$data = $s_data;
	$data['post'] = $s_data;
	} 
          
	 $data['bread_crumb']=array('Home'=>'/');
	 return $this->render_reward_theme('checkout.payment_checkout',$data); 
                                   
    }  	
    
    public function insurance_payment_final(){
     	
     	if(isset($_POST['s_email'])  && $_POST['s_email']!=''){				
        $validator = Rewards::validation_common();
	if ($validator->fails())
	{
	   $messages = $validator->messages();
	 return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
                     			
	}
        }
	

         $data = Rewards::redirect_helper('InsurancePayment@insurance_payment_final'); //Redirect Url after login
	 $data['getdetails']=$_POST; 
	 $_POST=$data;
    
         $_POST['payment'] ='insurance';
         $data = $_POST;
         $data['post'] = $_POST;
	 $data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_finalcheckout',$data); 
   
    }
	


   }
