<?php

class Billers extends BaseController {

       //biller paying home page
       function home($rtype = false)
       {
        $data['billers']=DB::table('billers')->select('ubp_biller_id','biller_name','id')->where('category','=','charity')->get();
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('billers.home',$data); 		
    }


   //biller checkout page
   public function biller_details(){
   
   //echo '<pre>'; print_r($_POST); exit;
    $data = $_POST;
    $bread_crumb=array('Home'=>'/');
    $data['page'] ='testest';
    $data['bread_crumb']=array('Home'=>'/');
   return $this->render_reward_theme('billers.payee_checkout',$data); 
   }


 //loading biller remarks calling by ajax
  function load_biller() {
   $biller_id =  $_POST['biller_id']; 
   $billers_details = DB::table('billers')->select('remarks')->where('id',$biller_id)->first();
    $billers = explode("~", $billers_details->remarks);
    //echo '<pre>'; print_r($billers); exit;
    if($billers[0] == ''){
    $billers =array('n/a'=>'N/A');
    }
    
    $out ='';
            $out .='<div class="col-md-12"> <div class="col-md-6">
	            <div class="w50percent">
		    <div class="wh90percent textleft">
			<span class="opensans size13"><b> Contribution Scheme</b></span>
			<select name="contribution_scheme" id="contribution_scheme" class="form-control"><option value="">Select</option> ';
		      foreach($billers as $key=>$value) { 
		       $out .='<option value='.$value.'>'.$value.'</option>';
 
		      }
	   $out .='</select></div></div></div>';
	
									
	echo $out;							

  
  }	  

      
 }

