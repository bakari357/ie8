<?php
class Oxigen {
    public static function Oxigen_Recharge($api) {
                 
                 $decode=json_decode($api);   
                 $api=(array)$decode;   
                 $url = 'https://osg.oximall.com/transservice.aspx'; 	
		 if($api['rtype']=='dth')
		$number=$api['serviceno'];
		else
		$number=$api['number'];
                if($api['rtype']=='postp')
                {
                 $body = 'Transid='.strtotime(date('Y-m-d H:i:s')).'&merchantrefno='.$api['ttype'].'*'.$api['operator'].','.$number.'&amount='.$api['amount'].'&requestdate='.date('YmdHis').'&status=0&bankrefno=85669';
               // echo '<pre>';
             //   print_r(htmlspecialchars($body));
             //   exit;
                }
                elseif($api['rtype']=='dth')
                {
                 $body = 'Transid='.strtotime(date('Y-m-d H:i:s')).'&merchantrefno='.$api['ttype'].'*'.$api['operator'].','.$number.'&amount='.$api['amount'].'&requestdate='.date('YmdHis').'&status=0&bankrefno=85669';
              }else{
		$body = 'Transid='.strtotime(date('Y-m-d H:i:s')).'&merchantrefno='.strtolower($api['ttype']).'*'.strtolower($api['operator']).'*'.strtolower($api['circle']).','.$number.'&amount='.$api['amount'].'&requestdate='.date('YmdHis').'&status=0&bankrefno=85669';
		 
		}
                        $authkey = 'UmV3YXJkczpSZXdhcmRzQG94aTEyMw==';
			$path ='osg.cer';
			$headers = array('Authorization: Basic ' . $authkey);
			$c = curl_init();
                        curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt ($c, CURLOPT_POST, true);
			curl_setopt ($c, CURLOPT_HTTPHEADER, $headers);
			curl_setopt ($c, CURLOPT_SSL_VERIFYPEER , $path);
			curl_setopt ($c, CURLOPT_POSTFIELDS, $body);
			curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
                        $page['success'] = curl_exec ($c);
			var_dump($page);
			if(curl_errno($c))
			{
			$page['error']= curl_error($c);
			}
			curl_close ($c);
			$page['input']=$body;
			return $page;
    
               }

}

