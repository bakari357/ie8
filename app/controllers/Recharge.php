<?php

class Recharge extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

        function dth_operators($id=false)
        {
//echo '<pre>'; print_r($_POST);exit;
        $data['post']=$_POST;
               $data['bread_crumb']=array('Home'=>'/');
       		return $this->render_reward_theme('mobile.mobile_checkout',$data);
        }
  
       function do_recharge()
    {   //echo '<pre>'; print_r($_POST); exit;
       
                      /* $recharge_data['operatorvalue']=  "IDEA";
                       $recharge_data['circlevalue']=  "KARNATAKA";
                       $recharge_data['operator']=  "IDEA";
                       $recharge_data['circle']=  "KK";
                       $recharge_data['amount']="10";
                       $recharge_data['rtype']=  "mobile";
                       $recharge_data['ttype']="etop";
                       $recharge_data['number']="9036232195";
                       $rech= json_encode($recharge_data);
                       $recharge_da=Oxigen::Oxigen_Recharge($rech);*/
             $data['post']=$_POST;
               $data['bread_crumb']=array('Home'=>'/');
       		return $this->render_reward_theme('mobile.mobile_checkout',$data); 	
                                   
    }  
    
    	function mobile_rec($rtype = false)
    {
    	if($rtype == 'recharge_dth'){
    	$operators['operator1']='AIRTELTV';
        $operators['operator2']='DISHTV';
        $operators['operator3']='TATASKY';
        $operators['operator4']='VIDEOCOND2H';
        $operators['operator5']='SUNTV';
        $operators['operator6']='BIGTV';
        $data['operators'] = $operators;
        }
        else{
        
        $result=DB::table('myoxi_operators')->get();
        	foreach($result as $te)
		{
		     
		$tt[$te->operator]=$te->abbr;
		
		}
		                $data['operators']=$tt;
		                $data['poperators']=$tt;
        }
        $data['circle']=DB::table('myoxi_circles')->get();
    			//$redis_menu=RedisCustom::Redis_reader('hung_category');
		    //print_r($_POST); exit;
				$bread_crumb=array('Home'=>'/');
			$data['page'] ='testest';
      		$data['bread_crumb']=array('Home'=>'/');
      		//$data['js_array'] = array('js/jquery.validate.min.js');
        	//$this->load_reward_region('auth','menus',$redis_menu); 
       		return $this->render_reward_theme('mobile.home',$data); 		
    
    }

	   	function dth_rec($rtype = false)
    {
    	$operators['operator1']='AIRTELTV';
        $operators['operator2']='DISHTV';
        $operators['operator3']='TATASKY';
        $operators['operator4']='VIDEOCOND2H';
        $operators['operator5']='SUNTV';
        $operators['operator6']='BIGTV';
        $data['operators'] = $operators;
$data['rtype'] = 'dth';
    			//$redis_menu=RedisCustom::Redis_reader('hung_category');
		    //print_r($_POST); exit;
				$bread_crumb=array('Home'=>'/');
			$data['page'] ='testest';
      		$data['bread_crumb']=array('Home'=>'/');
      		
        	//$this->load_reward_region('auth','menus',$redis_menu); 
       		return $this->render_reward_theme('mobile.dth',$data); 		
    
    }
   
    function get_mobile_info($number=false)
{



$mobile=DB::table('oxy_test')->where('ServiceID',$number)->first();
$opertaor = $mobile->operatorvalue;

		
if($opertaor == 'AIRCEL'){

$mobile->operator = 'AIRC';

}
if($opertaor == 'AIRTEL'){

$mobile->operator = 'AIRTFTT';

}
if($opertaor == 'BSNL'){

$mobile->operator = 'BSNL';

}
if($opertaor == 'docomo'){

$mobile->operator = 'DOCO';

}
if($opertaor == 'IDEA'){

$mobile->operator = 'IDEA';

}
if($opertaor == 'TATA INDICOM'){

$mobile->operator = 'INDI';

}
if($opertaor == 'MTS'){

$mobile->operator = 'MTS';

}
if($opertaor == 'RELIANCE CDMA'){

$mobile->operator = 'RELC';

}
if($opertaor == 'RELIANCE GSM'){

$mobile->operator = 'RELG';

}if($opertaor == 'UNINOR'){

$mobile->operator = 'UNIN';

}
if($opertaor == 'VIDEOCON'){

$mobile->operator = 'VIDEOCON';

}
if($opertaor == 'VODAFONE'){

$mobile->operator = 'VODA';
}
$circle = $mobile->circlevalue;
if($circle =='ANDHRA PRADESH')
{
$mobile->circle = 'AP';
}
if($circle =='ASSAM')
{
$mobile->circle = 'ASM';
}
if($circle =='BIHAR')
{
$mobile->circle = 'BIH';
}
if($circle =='CHENNAI')
{
$mobile->circle = 'CHE';
}
if($circle =='DELHI')
{
$mobile->circle = 'DEL';
}
if($circle =='GUJRAT')
{
$mobile->circle = 'GUJ';
}
if($circle =='HARYANA')
{
$mobile->circle = 'HAR';
}
if($circle =='HIMACHAL PRADESH')
{
$mobile->circle = 'HP';
}
if($circle =='Jammu And Kashmir')
{
$mobile->circle = 'JK';
}
if($circle =='KERELA')
{
$mobile->circle = 'KER';
}
if($circle =='KARNATAKA')
{
$mobile->circle = 'KK';
}
if($circle =='KOLKATA')
{
$mobile->circle = 'KOL';
}
if($circle =='MAHARASHTRA')
{
$mobile->circle = 'MAH';
}
if($circle =='MUMBAI')
{
$mobile->circle = 'MP';
}if($circle =='Mumbai')
{
$mobile->circle = 'MUM';
}
if($circle =='NORTHEAST')
{
$mobile->circle = 'NE';
}
if($circle =='Rajasthan')
{
$mobile->circle = 'RAJ';
}
if($circle =='ORISSA')
{
$mobile->circle = 'ORI';
}
if($circle =='KARNATAKA')
{
$mobile->circle = 'KK';
}
if($circle =='PUNJAB')
{
$mobile->circle = 'PUN';
}
if($circle =='TAMILNADU')
{
$mobile->circle = 'TN';
}
if($circle =='UTTAR PRADESH(East)')
{
$mobile->circle = 'UPE';
}
if($circle =='UTTAR PRADESH(West)')
{
$mobile->circle = 'UPW';
}
echo json_encode($mobile);
//echo json_encode($cir);
}                     
      
 }

