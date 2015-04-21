<?php
class Hungama {
    public static function doMessage($url) {
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 60); //timeout in seconds
	$output = curl_exec($ch);
	curl_close($ch);    
        return $output;
    }
    	public static function hungama_music($api)
	{
		
		
		$track_id=$api['options']['apiproduct']['track_id'];
		

		$customer = Session::get('customer_data');
	        $data['herror']=array();
		$data['hsuccess']=array();
		$curl = New Curl;
	        $xml =$curl->simple_get('https://secure.hungama.com/redeem/reward360/v2/user.php?auth_key=112b28a14454e5e35b7e613747975bd2&action=register&email='.$customer->email.'&mobile='.$customer->mobile.'&first_name='.$customer->first_name.'&last_name='.$customer->last_name);
		$result=json_decode($xml);
		
		if(isset($result->response->code) && ($result->response->code==1 ||$result->response->code==3))
		{
		$genorder =$curl->simple_get('https://secure.hungama.com/redeem/reward360/v2/redeem.php?auth_key=112b28a14454e5e35b7e613747975bd2&email='.$customer->email.'&content_id='.$track_id.'&plan_id=3');
		$redeem=json_decode($genorder);
		if(isset($redeem->response->code) && $redeem->response->code==1)
		{
		
		$songurl=$curl->simple_get('https://secure.hungama.com/redeem/reward360/v2/content_delivery.php?auth_key=112b28a14454e5e35b7e613747975bd2&order_id='.$redeem->response->order_id.'&content_id='.$track_id);
		$songurl1=json_decode($songurl);
		if(isset($songurl1->response->code) && $songurl1->response->code==1)
		{
		$data['hsuccess']['result']=$songurl1;

		}
		else
		{
		$data['herror']['songurl']=$songurl1;
		}
		$data['hsuccess']['order']=$redeem;
		}
		else
		{
		$data['herror']['RedeemOrder']=$redeem;
		}
		$data['hsuccess']['userreg']=$result;
		}
		else if(isset($result->response->code) && $result->response->code==4)
		{
			$xmln =$curl->simple_get('https://secure.hungama.com/redeem/reward360/v2/user.php?auth_key=112b28a14454e5e35b7e613747975bd2&action=register&email='.$customer->email.'&mobile=&first_name='.$customer->first_name.'&last_name='.$customer->last_name.'');
			$resultn=json_decode($xmln);
			if(isset($resultn->response->code) && ($resultn->response->code==1 ||$resultn->response->code==3))
			{
			$genordern =$curl->simple_get('https://secure.hungama.com/redeem/reward360/v2/redeem.php?auth_key=112b28a14454e5e35b7e613747975bd2&email='.$customer->email.'&content_id='.$api['id'].'&plan_id=3');
			$redeemn=json_decode($genordern);
			if(isset($redeemn->response->code) && $redeemn->response->code==1)
			{
			$songurln=$curl->simple_get('https://secure.hungama.com/redeem/reward360/v2/content_delivery.php?auth_key=112b28a14454e5e35b7e613747975bd2&order_id='.$redeemn->response->order_id.'&content_id='.$track_id);
			$songurl1n=json_decode($songurln);
			if(isset($songurl1n->response->code) && $songurl1n->response->code==1)
			{
			$data['hsuccess']['result']=$songurl1n;

			}
			else
			{
			$data['herror']['songurl']=$songurl1n;
			}
			$data['hsuccess']['order']=$redeemn;
			}
			else
			{
			$data['herror']['RedeemOrder']=$redeemn;
			}
			$data['hsuccess']['userreg']=$resultn;
			}
			else
			{
			
			$data['herror']['userregerr']=$resultn;
			}
		}
		else
		{
		$data['herror']['userregerr']=$result;
		}
		
		return $data;


	}


	public static function checkout($cdata)
	{

			
			$json['Posted']=$cdata;
			$json['Customer_Id']=1;
			$json['Created_Date']=date('Y-m-d H:i:s');
			$json['Patner_Id']=1;
			$json['API_Type']='Hungama';
			$test =json_encode($json);
			$save['input']=$test;
			$save['order_id']='';
			$json['api_pid'] = Checkoutmodel::do_checkout($save);
			$str=base64_decode($_POST['music_details']);
			$s_details=explode('|',$str);
			$data['track_id']=$s_details[0];
			$json['track_id']=$s_details[0];
			$data['track_name']=$s_details[1];
			if(isset($s_details[2]))
			{
				$data['alb_name']=$s_details[2];
				$data['image']=$s_details[3];
				$data['type']=$s_details[4];
			}
			else{
				$data['alb_name']='';
				$data['image']='';
				$data['type']='';
			     }
			$ticket['quantity']=1;
			$ticket['json']=$json;
			$ticket['description']='<b>Album Name:</b> '.$data['alb_name'].' , <b>Track Name:</b> '.$data['track_name'].'<img src="'.$data['image'].'"/>';
			return $ticket;
	}
    

}
