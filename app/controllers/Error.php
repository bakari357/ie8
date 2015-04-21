<?php

class Error extends BaseController {

function index($code=false)
{

	$code=Session::get('id');
	$data['code']=$code;
	$data['bread_crumb']=array('Home'=>'');

	

	switch($code)
	{
		case '404':
		$data['message']=$code." :Page not found";
		break;

		case '403':
		$data['message']=$code." :error occured";
		break;

		case '500':
		$data['message']=$code." :Internal error occured";
		break;
		
		default:
		$data['message']="Internal error occured";
		$data['code']=500;


	}
	

	return $this->render_login_theme('errors.error','error',$data);
}


   function log_check()
   {
	$data=array('Offers',1,'special offer',20);
	Loghelper::logwriter('offer',$data);
   }





}

