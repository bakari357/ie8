<?php

class Creditcard extends BaseController {

       //biller paying home page
       function home($rtype = false)
       { 
         /*$redirect    = Loginmodel::is_logged_in(false, false);
	if(!$redirect){
	return Redirect::to('securelogin');          
	}*/
        $data['creditcard']=MobilePaymentmodel::get_creditcards();
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	$this->load_reward_region('common','left',$data); 
      	$data['banners'] = Banner::get_todays_banner(5);
	return $this->render_reward_theme('billdesk.creditcard',$data); 		
    }


   //creditcard checkout page
   public function do_payment(){
   
    $_POST['payment'] ='creditcard';
     $data = $_POST;
    $data['post'] = $_POST;
   
    $bread_crumb=array('Home'=>'/');
    $data['bread_crumb']=array('Home'=>'/');
  return $this->render_reward_theme('checkout.payment_checkout',$data); 
   }
   
   public function crditcard_payment_final(){
   
	$data = Rewards::redirect_helper('Creditcard@crditcard_payment_final'); //Redirect Url after login
	$data['getdetails']=$_POST; 
	$_POST=$data;
    
	$_POST['payment'] ='creditcard';
	$data = $_POST;
	$data['post'] = $_POST;
	$bread_crumb=array('Home'=>'/');
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_finalcheckout',$data); 
    }


 //loading card details calling by ajax
  function load_creditcardprefix() {
    $card_number ='';
    $id='';
   $id =  $_POST['creditcard_id']; 
   $card_number = $_POST['creditcard_number'];
   
    $card_details = MobilePaymentmodel::load_creditcardprefix($id);
    $cards_starts = explode("|", $card_details->starts_with);
    if($card_details->biller_name =="Amex Card"){
       $card = substr($card_number, 0, 4);  
       if(in_array($card,$cards_starts)){
       return 1;
       }else{
       return 0;
       }
       
    } 
    
     elseif($card_details->biller_name =="ICICI Credit Card"){
       $card = substr($card_number, 0, 6); 
       if(in_array($card,$cards_starts)){
       return 1;
       }else{
       return 0;
       }
   
     }	
     
   
    else{
    return "nothing";
    }	

  
  }	
  
  public static function load_creditcardbiller(){
   $card_details =MobilePaymentmodel::load_creditcard_biller($_POST['id']);
   echo json_encode($card_details->ubp_biller_id);
  }
    

      
 }

