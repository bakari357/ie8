<?php

class TelephonePayment extends BaseController {

	//telephone payment home page
    	function telephone_payment($rtype = false)
    {
    	
                $data['telephone']= MobilePaymentmodel::get_telephonebiller();
                //echo '<pre>'; print_r($data['telephone']); exit;
		$bread_crumb=array('Home'=>'/');
		$data['page'] ='testest';
      		$data['bread_crumb']=array('Home'=>'/');
       		return $this->render_reward_theme('telephone_payments.home',$data); 		
    
    }

	//do payments
      function do_payment()
    {   // echo '<pre>'; print_r($_POST); exit;
	$data['post']=$_POST;
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('telephone_payments.telephone_checkout',$data); 	
                                   
    }  	
	


   }
