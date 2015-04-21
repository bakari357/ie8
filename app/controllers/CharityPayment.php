<?php

class CharityPayment extends BaseController {

       //biller paying home page
       function home($rtype = false)
       { 
        /*$redirect    = Loginmodel::is_logged_in(false, false);
	if(!$redirect){
	return Redirect::to('securelogin');          
	}*/
        $data['billers']=MobilePaymentmodel::get_charitypayeer();
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	$this->load_reward_region('common','left',$data); 
      	$data['banners'] = Banner::get_todays_banner(5);
	$this->load_reward_region('auth','home',1);
	return $this->render_reward_theme('billdesk.charity',$data); 		
    }


   //biller checkout page
   public function biller_details(){
        $s_data=Session::get('data');
        if(isset($_POST) && !empty($_POST)){
        $rules=array();
	$rules['biller_id'] = "required";
        $rules['contribution_scheme'] = "required";
	$rules['donor_name'] = "required|regex:/^[a-z\s]+$/i";
        $rules['address1'] = "required";
        $rules['address2'] = "required";
	$rules['amount'] = 'required|regex:/^[0-9]{1,10}$/';
        $messages = array(
	             'biller_id.required' => 'please select charity name.',
	             'contribution_scheme.required' => 'please select contribution scheme.',
	             'address1.required' => 'The address line 1 field is required.',
	             'address2.required' => 'The address line 2 field is required.',
	            );
        $validator = Validator::make(Input::all(), $rules,$messages);
        if ($validator->fails())
	{
	$errors = $validator->messages();
	return Redirect::to('charity_payment')->with('errors', $errors);
	}  
	else{
	$_POST['payment'] ='charity';
	$data['post'] = $_POST;
	}  
        }
        else {
	$s_data['payment'] ='charity';
	$data['post'] = $s_data;
	} 
	
	$bread_crumb=array('Home'=>'/');
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_checkout',$data);  	
	}

   public function charity_payment_final(){
        
        if(isset($_POST['s_email'])  && $_POST['s_email']!=''){
        $validator = Rewards::validation_common();
	if ($validator->fails())
	{
	   $messages = $validator->messages();
	 return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
                     			
	}
	}
        $data = Rewards::redirect_helper('CharityPayment@charity_payment_final'); //Redirect Url after login
	$data['getdetails']=$_POST; 
	$_POST=$data;
    
        $_POST['payment'] ='charity';
	$data['post']=$_POST;
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_finalcheckout',$data); 
    }


 //loading biller remarks calling by ajax
  function load_biller() {
   $biller_id =  $_POST['biller_id']; 
   $billers_details =MobilePaymentmodel::load_biller($biller_id);
    $billers = explode("~", $billers_details->remarks);
    if($billers[0] == ''){
    $billers =array('n/a'=>'N/A');
    }
   
    asort($billers);

    $out ='';
            $out .=' 
		<span class="opensans size13"><b> Contribution Scheme</b></span> <span class="red">*</span>
		<select name="contribution_scheme" id="contribution_scheme" class="form-control po_mobile">';
		if($billers_details->remarks !=''){
		 $out .='<option value="">Select</option> ';
		 }
		 
	    foreach($billers as $key => $value) {
		       $out .='<option value='.$value.'>'.$value.'</option>';
 
		      }
	   $out .='</select>';
	
									
	echo $out;							

  
  }	  

  //load charity billerids
  
   public function load_charitybiller(){
   $biller_id = $_POST['biller_id'];
   $billers_details =MobilePaymentmodel::load_charitybiller($biller_id);  
   $charity_biller_id = $billers_details->ubp_biller_id; 
   echo json_encode($charity_biller_id);
   
   }
  
   
      
 }

