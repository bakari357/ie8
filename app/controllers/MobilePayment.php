<?php

class MobilePayment extends BaseController {


    //mobile payment home page function
    	function mobile_payment()
     {  
       
         $prepaid_result=MobilePaymentmodel::get_operators();
         $postpaid_result=MobilePaymentmodel::get_postpaid_operators();
         
        	foreach($prepaid_result as $te)
		{
		     
		$tt[$te->operator]=$te->abbr;
		
		}
		
		foreach($postpaid_result as $te)
		{
		     
		$postpaid[$te->operator]=$te->abbr;
		
		}
		$data['operators']=$tt;
		if(isset($postpaid)){
		$data['poperators']=$postpaid;
		}else{
		$data['poperators']=$tt;
		}
                $data['billers']= MobilePaymentmodel::getmobile_billername();
                //echo '<pre>'; print_R( $data['billers']); exit;
                $data['circle']=DB::table('myoxi_circles')->get();
		$bread_crumb=array('Home'=>'/');
		$data['page'] ='testest';
      		$data['bread_crumb']=array('Home'=>'/');
      		$this->load_reward_region('common','left',$data); 
      		$data['banners'] = Banner::get_todays_banner(4);
$this->load_reward_region('auth','home',1); 
       		return $this->render_reward_theme('billdesk.mobile',$data); 		
    
    }

	//do payments
      function do_payment(){
    
         
         if(empty($_POST)){
        return Redirect::to('mobile_payments');
        }
         $s_data=Session::get('data');
        if(isset($_POST) && !empty($_POST)){
         $rules=array();
         if($_POST['rtype'] =='prepaid'){
         $rules['mobile'] = "required|numeric|regex:/^[0-9]{1,10}$/";
         $rules['operator'] = 'required';
         $rules['amount'] = 'required|numeric|regex:/^[0-9]{1,8}$/';
         
         $messages = array(
	             'operator.required' => 'please select mobile operator.',
	            );
         }
         else
         {
         //echo '<pre>'; print_r($_POST); exit;
         $rules['po_mobile'] = "required|numeric|regex:/^[0-9]{1,10}$/";
         $rules['po_operator'] = 'required';
        
         
         if($_POST['check_circle']=='Tamil nadu (not including Chennai)' && $_POST['check_oper'] =='Airtel'){
         $rules['account_no'] = 'required';
         }else{
         $rules['relation_no'] = 'required';
         }
         
         $rules['po_amount'] = 'required|numeric|regex:/^[0-9]{1,8}$/';
            $messages = array(
	             'po_operator.required' => 'please select mobile operator.',
	            );
         }

         $validator = Validator::make(Input::all(), $rules, $messages);
	if ($validator->fails())
	{
	$errors = $validator->messages();
	 return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
	}
	else
	{
	$_POST['payment'] ='recharge';
	$data['post']=$_POST;
	}
	}
	else {
	$s_data['payment'] ='recharge';
	$data['post'] = $s_data;
	} 
	
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_checkout',$data);

	
                                   
    }  	
    
    public function prepaid_payment_final(){
        
         if(isset($_POST['s_email'])  && $_POST['s_email']!=''){
         $validator = Rewards::validation_common();
	if ($validator->fails())
	{  
	   $messages = $validator->messages();
	  
	 return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
                     			
	}
	}
	$data = Rewards::redirect_helper('MobilePayment@prepaid_payment_final'); //Redirect Url after login
	$data['getdetails']=$_POST; 
	$_POST=$data;
        $_POST['payment'] ='recharge';
	$data['post']=$_POST;
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_finalcheckout',$data); 
    }
    
    public function postpaid_payment_final(){
        
        if(isset($_POST['s_email'])  && $_POST['s_email']!=''){
        $validator = Rewards::validation_common();
	if ($validator->fails())
	{
	   $messages = $validator->messages();
	 return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
                     			
	}
        }
        $data = Rewards::redirect_helper('MobilePayment@postpaid_payment_final'); //Redirect Url after login
	$data['getdetails']=$_POST; 
	$_POST=$data;
        $_POST['payment'] ='recharge';
	$data['post']=$_POST;
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('checkout.payment_finalcheckout',$data); 
    }
	


   //loading payee presence area	
    function loadpayee_presence(){
     $area_id = $_POST['paying_to'];
     $area_details = DB::table('billers')->where('id',$area_id)->first(); 
     echo json_encode( $area_details);
   }	   	
   
   
   //load payee circle
   
   public static function loadpayee_circle(){
   
   $network = $_POST['operator'];
   $billercircle_details = MobilePaymentmodel::getbillers_circle($network);

            $out ='';
            $out .=' <div>
			<span class="opensans size13"><b>Select Circle</b></span> <span class="red">*</span>
			<select name="po_paying_to" id="po_paying_to" class="form-control" onchange="get_loc();"><option value="">Select</option> ';
		      foreach($billercircle_details as $key=>$value) { 
		       $out .='<option value="'.$value->id.'">'.$value->biller_name.'</option>';
 
		      }
	   $out .='</select></div>';
	
									
	echo $out;	
   
   }
   
   
   
   //get payment option
    public function payments(){
    
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('mobile_payments.homes',$data); 	

    }
   
   
    function get_mobile_info()
    {
        $number = $_POST['str'];
	$mobile=DB::table('oxy_test')->where('ServiceID',$number)->first();
	$opertaor = $mobile->operatorvalue;
        $operator_arr = array('VODA'=> 'VODAFONE','AIRC'=>'AIRCEL','AIRTFTT'=>'AIRTEL','DOCO'=>'docomo','IDEA'=>'IDEA','INDI'=>'TATA INDICOM','MTS'=>'MTS','RELC'=>'RELIANCE CDMA','RELG'=>'RELIANCE GSM','UNIN'=>'UNINOR','VIDEOCON'=>'VIDEOCON','LOOP'=>'LOOP','BSNL'=>'BSNL','MTNL'=>'MTNL','MTS'=>'MTS');          
	$key = array_search($mobile->operatorvalue, $operator_arr);
	
	echo json_encode($key);
	
	}    
	
	 
	
	
       
	                 
      
 }

