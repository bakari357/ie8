<?php

class Subscription extends BaseController {

       //biller paying home page
       function home($rtype = false)
       { /*$redirect    = Loginmodel::is_logged_in(false, false);
	if(!$redirect){
	return Redirect::to('securelogin');          
	} */
        $data['subscription']=MobilePaymentmodel::get_subscription();
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('subscription.home',$data); 		
    }


   //biller checkout page
       public function do_subscription(){
	$bread_crumb=array('Home'=>'/');
	$_POST['payment'] ='subscription';
	$data['post'] = $_POST;
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_checkout',$data); 
      }


 //loading biller remarks calling by ajax
  function load_subscription() {
    $subscribe_id =  $_POST['subscribe_id']; 
    $subscribe_details = MobilePaymentmodel::get_loadscheme($subscribe_id);
    $subscribe = explode("~", $subscribe_details->scheme);
    //echo '<pre>'; print_r($billers); exit;
    if($subscribe[0] == ''){
    $subscribe =array('n/a'=>'N/A');
    }
    
    $out ='';
            $out .='<div class="col-md-12"> <div class="col-md-6">
	            <div class="w50percent">
		    <div class="wh90percent textleft">
			<span class="opensans size13"><b>Subscription Scheme</b></span>
			<select name="scheme" id="scheme" class="form-control"><option value="">Select</option> ';
		      foreach($subscribe as $key=>$value) { 
		       $out .='<option value="'.$value.'">'.$value.'</option>';
 
		      }
	   $out .='</select></div></div></div>';
	
									
	echo $out;							

  
  }	
  
  
  //load biller ids
  
  public function load_subscriptionbiller(){
    $subscribe_id =  $_POST['biller_id'];
    $subscribe_details = MobilePaymentmodel::loadsubscribebiller($subscribe_id);
    //$subscribe = $subscribe_details->ubp_biller_id; 
    echo json_encode($subscribe_details);
  }  
  

      
 }

