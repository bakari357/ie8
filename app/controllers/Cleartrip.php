<?php
use Carbon\Carbon;
class Cleartrip extends BaseController  {
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
	
        public function index()
        {


            $flight=array();
            $flight['leavingfrom']='BLR';
            $flight['goingto'] ='BOM';
            $flight['type']='O';
            $flight['leavingfrom1'] = 'Bangalore';
            $flight['goingto1'] ='Mumbai';
            $flight['departure'] = '28-03-2014';
            $flight['return'] = '28-03-2014';
            $flight['adults'] ='1';
            $flight['children'] ='0';
            $flight['class'] = 'Economy';
            $flight['infants'] = '0';
            //echo json_encode($flight);
		    $flight['bread_crumb']=array('Home'=>'/');
      		$flight['banners'] = Banner::get_todays_banner(3);
	        
        	$this->load_reward_region('hungama','home',1);
       		return $this->render_reward_theme('cleartrip.home',$flight); 
         }
   
	public function indexint()
	{
		        $data['leavefrom']='';
		        $data['goto']='';
		        $data['class']='';
		        $data['adultsid']=1;
        		$data['childrenid']=0;
			$data['infantsid']=0;
			$data['home']='page';
			$data['category_name'] = '';
			$data['bread_crumb']=array('Home'=>'/');
      		$data['banners'] = Banner::get_todays_banner(3);
        	$this->load_reward_region('hungama','home',1);
       		return $this->render_reward_theme('cleartrip.inthome',$data); 
	}

	public function Listing_Flights()
	{

	if((isset($_POST) && !empty($_POST)) )
		{
			$return="";
			$dis_fare='Y';
			$ttype='DOM';
			if((isset($_POST) && !empty($_POST))){
			$data=$_POST;
			$data['post']=$_POST;
			}
				
			if(isset($data['departure']) && $data['departure']<>'')
			{
			
			$deptime_temp=date('Y-m-d',strtotime($data['departure']));

			$deptime_array=explode('-',$deptime_temp);
			
			$deptime=$deptime_temp;
			
			}
			else
			{
			$deptime=date('Y-m-d');
			$deptime=$deptime_array[0].$deptime_array[1].$deptime_array[2];
			}

			if(isset($data['return']) && $data['return']<>''){

			$return_temp=date('Y-m-d',strtotime($data['return']));
			$return_array=explode('-',$return_temp);

			
			$return=$return_temp;

			$reqtype=$data['type'];
			}
			else
			{
			$reqtype="";
			$tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y"));
			$return_temp=date('Y-m-d',$tomorrow);
			
			$return_array=explode('-',$return_temp);

			
			$return=$return_array[0].$return_array[1].$return_array[2];

	
			}
			
			if($data['type']=='R')
			{
			$returnxml="<DateOfArrival>".$return."</DateOfArrival>";
			$view='via_new_one';
			if($_POST['plantype']<>'intFlight')
			{	
			if(isset($_POST['discouted']) && $_POST['discouted']=='on'){
				
				$dis_fare='Y';
				
			}
			else
			{
				$dis_fare='N';
				$view='round_trip';
			}
			}
			else
			{
				$ttype='INT';
				$view='via_new_round';
			}
			}
			else
			{
			$returnxml='';
			
					$view='via_new_one';
					$js_f[]='js/oneway.js';

		
			}
			
			$req=$data['leavingfrom'].'|'.$data['goingto'].'|'.$deptime.'|'.$data['adults'].'|'.$data['children'].'|'.$data['infants'].'|'.$data['class'].'|'.$data['type'].'|'.$return.'|'.$dis_fare.'|'.$ttype;

			
			
				$data['req']=base64_encode($req);
                $data['spoint']=$_POST['leavingfrom'];
				$data['epoint']=$_POST['goingto'];
				if($data['type']=='R')
				
			
				
			
                $data['c_ratio']=0.70;
                                $data['output']=DB::table('airlines')->get(); 
                                
                                
                                
                                
				$data['bread_crumb']=array('Home'=>'/');
      		        
				$this->load_reward_region('auth','data',''); 
				
                                
				return $this->render_reward_theme_hotels('cleartrip.'.$view,$data);
			}



   }
	 public function Flight_Price()
        {
         
        $airdetails=$_POST['airdetails'];
        $xml=$_POST['xml'];
        /*Round-Trip*/
        $airdetails1=$_POST['airdetails1'];
        $xml2=$_POST['xml2'];
        /*/////*/
        $flight_prices=Yatra::Price_Data($airdetails,$airdetails1,$xml,$xml2);
        echo '<pre>';
        print_r($flight_prices);
        exit;
        }
	
	public function go_Checkout()
	{
           // echo "<pre>";print_r($_POST);exit;
        //to know flight is domestic or international
            if(isset($_POST['international']) && $_POST['international']<>'')
            {
            $data['international']='international';
            }            
        $data['book_passsenger']=$book_passsenger=unserialize(str_replace('quot','"',$_POST['post']));
        // echo "<pre>";print_r($book_passsenger['type']);exit;  
        $data['odept_date']=$book_passsenger['departure'];
             if(isset($book_passsenger['type']) && $book_passsenger['type']=='R')
             {
            $data['arr_date']=$book_passsenger['return'];
             }
        // flight and fare details from listing flights
	if(isset($_POST['fuldata']) && $_POST['fuldata']<>'')
	{
		$reprice_request=json_decode(urldecode($_POST['fuldata']));
	}
	else
	{
	Session::flash('message', "Flight you are trying to book is either full or unavailable. Please try again with some other flight");
         return Redirect::to('flight_index');
	}
         
                
        $json_data=Viaflight::reprice($book_passsenger,$reprice_request);
        
        $data['fuldata']=urlencode($json_data);
        //echo "<pre>";print_r(urldecode($data['fuldata']));exit;
        $data['booking_data']=urlencode($json_data);
        if(isset($_POST['returndata']) && $_POST['returndata']<>'' || isset($book_passsenger['type']) && $book_passsenger['type']=='R')
        {
         $querydata_temp=array
                                (
                        "origin"=> $book_passsenger['leavingfrom'],
                        "destination"=> $book_passsenger['goingto'],
                        "arrdate"=>date('Y-m-d',strtotime($book_passsenger['return'])),
                        "depdate"=> date('Y-m-d',strtotime($book_passsenger['departure'])),
                        "adults"=> $book_passsenger['adults'],
                        "infants"=> $book_passsenger['infants'],
                        "children"=> $book_passsenger['children']
                                );   
        }
        else
        {
                    $querydata_temp=array
                                (
                        "origin"=> $book_passsenger['leavingfrom'],
                        "destination"=> $book_passsenger['goingto'],
                        
                        "depdate"=> date('Y-m-d',strtotime($book_passsenger['departure'])),
                        "adults"=> $book_passsenger['adults'],
                        "infants"=> $book_passsenger['infants'],
                        "children"=> $book_passsenger['children']
                                );
        } 
       
        //check the reprice
        $check_reprice=json_decode($json_data);
        
        $querydata=$data['querydata']= json_encode($querydata_temp);
        $json_decoded=$data['json_decoded']=json_decode($json_data)->data;
        if(isset($json_decoded->Error))
        {
            Session::flash('message', "Flight you are trying to book is either full or unavailable. Please try again with some other flight");
            return Redirect::to('flight_index');
        }
        //flight checkout starts
        $onwards = $json_decoded->onwardflights['0']; 
        
         //echo "<pre>";print_r($onwards);exit;
        
      // echo "<pre>";print_r($onwards);
        $new_array = array();
        $new_array[0]['sour'] = $onwards->origin;
        $onw_return['sour'][] = $onwards->origin;
        $new_array[0]['dst_tym']  =strtoupper($onwards->arrdate);
        $new_array[0]['car_id']  = $onwards->carrierid;
        $new_array[0]['fnum']  = $onwards->flightno;
        $new_array[0]['desti']  = $onwards->destination;
        $new_array[0]['arr_tym'] =  strtoupper($onwards->depdate);
        if(isset($onwards->Group) && $onwards->Group<>'')
        $new_array[0]['Group'] = strtoupper($onwards->Group);
        if(isset($onwards->onwardflights)){
            $count = 1; 
        foreach($onwards->onwardflights as $oconnect){
      $onw_return['sourc'][] = $oconnect->origin;
      $new_array[$count]['sour'] = $oconnect->origin;
        $onw_return['sour'][] = $oconnect->origin;
        $new_array[$count]['dst_tym']  =strtoupper($oconnect->arrdate);
        $new_array[$count]['car_id']  = $oconnect->carrierid;
        $new_array[$count]['fnum']  = $oconnect->flightno;
        $new_array[$count]['desti']  = $oconnect->destination;
        $new_array[$count]['arr_tym'] =  strtoupper($oconnect->depdate);
        if(isset($oconnect->Group) && $oconnect->Group<>'')
        $new_array[$count]['Group'] = strtoupper($oconnect->Group);
        $count++; 
        
        }
        }
        
        $faretype=array(array('fare_type'=>$onwards->warnings));
        $data['faretype']=$faretype;
        
        // Return Flights 
        if(isset( $json_decoded->returnflights['0']))
        {
        $return = $json_decoded->returnflights['0']; 
        $new_array_ret = array();
        
        $new_array_ret[0]['sour'] = $return->origin;
        $onw_return['sour'][] = $return->origin;
        $new_array_ret[0]['dst_tym']  =strtoupper($return->arrdate);
        $new_array_ret[0]['car_id']  = $return->carrierid;
        $new_array_ret[0]['fnum']  = $return->flightno;
        $new_array_ret[0]['desti']  = $return->destination;
        $new_array_ret[0]['arr_tym'] =  strtoupper($return->depdate);
        if(isset($return->Group) && $return->Group<>'')
        $new_array_ret[0]['Group'] = strtoupper($return->Group);
        if(isset($return->onwardflights)){
        $count = 1; 
        foreach($return->onwardflights as $oconnect){
        $onw_return['sourc'][] = $oconnect->origin;
        $new_array_ret[$count]['sour'] = $oconnect->origin;
        $onw_return['sour'][] = $oconnect->origin;
        $new_array_ret[$count]['dst_tym']  = strtoupper($oconnect->arrdate);
        $new_array_ret[$count]['car_id']  = $oconnect->carrierid;
        $new_array_ret[$count]['fnum']  = $oconnect->flightno;
        $new_array_ret[$count]['desti']  = $oconnect->destination;
        $new_array_ret[$count]['arr_tym'] = strtoupper($oconnect->depdate);
        if(isset($return->Group) && $return->Group<>'')
        $new_array_ret[$count]['Group'] = strtoupper($oconnect->Group);
        $count++; 

        }
        }
        }
        
        $data['onw_return']=$new_array;
        
        if(isset($new_array_ret) && $new_array_ret<>'')
            {
            $data['ret_return']=$new_array_ret;    
            $faretype_return=array(array('fare_type'=>$return->warnings));
            $data['faretype_return']=$faretype_return;
            }
            
       //flight checkout ends
            //echo "<pre>";print_r($onwards->fare);exit;
            
            
       // echo "<pre>";print_r($new_array_ret);exit;
        if(isset($check_reprice->data->Error)) 
        {
         return Redirect::to('flights_not_available');    
        }
        
        $count=count($json_decoded->onwardflights);
        for($i=0;$i<$count;$i++)
        {
            $data['osourc']=$json_decoded->onwardflights[$i]->origin;
            
            if(isset($json_decoded->onwardflights['0']->onwardflights) && !empty($json_decoded->onwardflights['0']->onwardflights))
            {
                $data['odeat']=$json_decoded->onwardflights['0']->onwardflights[$i]->destination;
            }
            else
            {
                $data['odeat']=$json_decoded->onwardflights['0']->destination; 
            }
            
            $data['odept_tym']=$json_decoded->onwardflights[$i]->deptime;
            $data['oarr_tym']=$json_decoded->onwardflights[$i]->arrtime;

            $data['childrenbasefare']=0;
	    $data['infantsbasefare']=0;
            
            //adult price details
            if(isset($json_decoded->returnflights[$i]->fare->adultbasefare) && $json_decoded->returnflights[$i]->fare->adultbasefare<>'')
            {
            $data['adultbasefare']=$json_decoded->onwardflights[$i]->fare->adultbasefare+$json_decoded->returnflights[$i]->fare->adultbasefare;
            
            if(isset($json_decoded->returnflights[$i]->fare->adulttax) && $json_decoded->returnflights[$i]->fare->adulttax<>'' && isset($json_decoded->onwardflights[$i]->fare->adulttax) && $json_decoded->onwardflights[$i]->fare->adulttax<>'')
            {
		
            $data['adulttax']=$json_decoded->onwardflights[$i]->fare->adulttax+$json_decoded->returnflights[$i]->fare->adulttax;
            }
            else
            {
                $data['adulttax']=0;
            }
            
            $data['adult_final_price']=$data['adultbasefare']+ $data['adulttax'];
            }
            else 
            {
              $data['adultbasefare']=$json_decoded->onwardflights[$i]->fare->adultbasefare;
            if(isset($json_decoded->onwardflights[$i]->fare->adulttax) && $json_decoded->onwardflights[$i]->fare->adulttax<>'')
            {
            $data['adulttax']=$json_decoded->onwardflights[$i]->fare->adulttax;
            }
            else
            {
                $data['adulttax']=0;
            }
            
            $data['adult_final_price']=$data['adultbasefare']+ $data['adulttax'];
            }
            
            //children price details
            if(isset($json_decoded->returnflights[$i]->fare->childbasefare) && $json_decoded->returnflights[$i]->fare->childbasefare<>'')
            {
            $data['childrenbasefare']=$json_decoded->onwardflights[$i]->fare->childbasefare+$json_decoded->returnflights[$i]->fare->childbasefare;
            if(isset($json_decoded->returnflights[$i]->fare->childtax) && $json_decoded->returnflights[$i]->fare->childtax<>'' && isset($json_decoded->onwardflights[$i]->fare->childtax) && $json_decoded->onwardflights[$i]->fare->childtax<>'')
            {
            $data['childtax']=$json_decoded->onwardflights[$i]->fare->childtax+$json_decoded->returnflights[$i]->fare->childtax;
            }
            else
            {
                $data['childtax']=0;
            }
            
            $data['children_final_price']=$data['childrenbasefare']+ $data['childtax'];
            }
            elseif(isset($json_decoded->onwardflights[$i]->fare->childbasefare) && $json_decoded->onwardflights[$i]->fare->childbasefare<>'')
            {
              $data['childrenbasefare']=$json_decoded->onwardflights[$i]->fare->childbasefare;
            if(isset($json_decoded->onwardflights[$i]->fare->childtax) && $json_decoded->onwardflights[$i]->fare->childtax<>'')
            {
            $data['childtax']=$json_decoded->onwardflights[$i]->fare->childtax;
            }
            else
            {
                $data['childtax']=0;
            }
            
            $data['children_final_price']=$data['childrenbasefare']+ $data['childtax'];
            }
            else
            {
               $data['children_final_price']=0; 
            }
            
            //infants price details
            if(isset($json_decoded->returnflights[$i]->fare->infanttotalfare) && $json_decoded->returnflights[$i]->fare->infanttotalfare<>'')
            {
            $data['infantsbasefare']=$json_decoded->onwardflights[$i]->fare->infanttotalfare+$json_decoded->returnflights[$i]->fare->infanttotalfare;
            if(isset($json_decoded->returnflights[$i]->fare->infanttax) && $json_decoded->returnflights[$i]->fare->infanttax<>'' && isset($json_decoded->onwardflights[$i]->fare->infanttax) && $json_decoded->onwardflights[$i]->fare->infanttax<>'')
            {
            $data['infantstax']=$json_decoded->onwardflights[$i]->fare->infanttax+$json_decoded->returnflights[$i]->fare->infanttax;
            }
            else
            {
            $data['infantstax']=0;    
            }
            $data['infants_final_price']=$data['infantsbasefare']+ $data['infantstax'];
            }
            elseif((isset($json_decoded->onwardflights[$i]->fare->infanttotalfare) && $json_decoded->onwardflights[$i]->fare->infanttotalfare<>''))
            {
            $data['infantsbasefare']=$json_decoded->onwardflights[$i]->fare->infanttotalfare;
            if(isset($json_decoded->onwardflights[$i]->fare->infanttax) && $json_decoded->onwardflights[$i]->fare->infanttax<>'')
            {
            $data['infantstax']=$json_decoded->onwardflights[$i]->fare->infanttax;
            }
            else
            {
            $data['infantstax']=0;    
            }
            $data['infants_final_price']=$data['infantsbasefare']+ $data['infantstax'];
            }
            else
            {
              $data['infants_final_price']=0;  
            }
            $data['amount']=$data['adult_final_price']+$data['children_final_price']+$data['infants_final_price'];
            
            
           
            
           
        }
              $data['adults']=$book_passsenger['adults'];
              $data['children']=$book_passsenger['children'];
              $data['infants']=$book_passsenger['infants'];
              
              
              //no o tickes         
              $data['tickets']=$book_passsenger['adults']+ $book_passsenger['infants']+ $book_passsenger['infants'];
              
        //flight price details
            if(isset($return->fare->totalfare) && !empty($return->fare->totalfare))
            {
                
                $data['cash']=$onwards->fare->totalfare+$return->fare->totalfare;
                //$data['total_tax']=$data['cash']-$onwards->fare->totalbasefare-$return->fare->totalbasefare;
                $data['total_tax']=$data['cash']-$data['adultbasefare']*$data['adults']-$data['childrenbasefare']*$data['children']-$data['infantsbasefare']*$data['infants'];
            }
            else
            {
                
                $data['cash']=$onwards->fare->totalfare;
                //$data['total_tax']=$data['cash']-$onwards->fare->totalbasefare;
                $data['total_tax']=$data['cash']-$data['adultbasefare']*$data['adults']-$data['childrenbasefare']*$data['children']-$data['infantsbasefare']*$data['infants'];
            }
             
            //flight price ends
           
        //this is for only connection flights
        //echo "<pre>";print_r($json_decoded->onwardflights['0']->onwardflights);exit;
        if(isset($json_decoded->onwardflights['0']->onwardflights) && !empty($json_decoded->onwardflights['0']->onwardflights))
        {
            
            
            //echo "<pre>";print_r($connection_flights);exit;
            $data['osourc_con']=strtoupper($json_decoded->onwardflights['0']->destination);
            
            //echo "<pre>";print_r($osourc_temp);exit;
//            $data['con_destination']=$connection_flights->destination;
//            $data['con_arrtime']=$connection_flights->arrtime;
            $data['con_deptime']='';
            
        
        
        }
        if(isset($json_decoded->returnflights) && $json_decoded->returnflights<>'')
        {
        $count=count($json_decoded->returnflights);
        for($i=0;$i<$count;$i++)
        {
        $data['rsourc']=strtoupper($json_decoded->returnflights[$i]->origin);
        
        
        if(isset($json_decoded->returnflights['0']->onwardflights) && !empty($json_decoded->returnflights['0']->onwardflights))
        {
        $data['rdeat']=strtoupper($json_decoded->returnflights['0']->onwardflights[$i]->destination);
        }
        else
        {
        $data['rdeat']=strtoupper($json_decoded->returnflights['0']->destination); 
        }

        $data['rdept_tym']=$json_decoded->returnflights[$i]->deptime;
        $data['rarr_tym']=$json_decoded->returnflights[$i]->arrtime;
        
        }
        }
        //this is for only connection flights
        //echo "<pre>";print_r($json_decoded->returnflights['0']->returnflights);exit;
        if(isset($json_decoded->returnflights['0']->onwardflights) && !empty($json_decoded->returnflights['0']->onwardflights))
        {


        //echo "<pre>";print_r($connection_flights);exit;
        $data['rsourc_con']=strtoupper($json_decoded->returnflights['0']->destination);

        //echo "<pre>";print_r($rsourc_temp);exit;
        //            $data['con_destination']=$connection_flights->destination;
        //            $data['con_arrtime']=$connection_flights->arrtime;
        $data['con_deptime']='';



        }
       /*foreach(json_decode($json_data)->data as $reprice_response)
       {
           echo "<pre>";print_r($reprice_response);
       }*/
       
              
              //adult price details
             //$data['adult_price']=
              
              
              
              
              
              //$data['osourc']=$_POST['leavingfrom'];
              //$data['odeat']=$_POST['goingto'];
              //$data['oarr_tym']=$_POST['oarr_tym'];
              //$data['odept_tym']=$_POST['odept_tym'];
                $data['bread_crumb']=array('Home'=>'/');
                //echo '<pre>'; print_r($data); exit;
                $this->load_reward_region('auth','data',''); 
                    return $this->render_reward_theme('goibibo.flight_checout',$data); 
	
	
	}
        public function get_flights()
	{ 
           
//			if (Cache::has('smartbuy_goibibo_'.$_POST['req']))
//			{
//				$output = Cache::get('smartbuy_goibibo_'.$_POST['req']);
//			}
//			else
//			{
//                            
//				$minutes = Carbon::now()->addMinutes(5);
//
//				$output = Cache::remember('smartbuy_goibibo_'.$_POST['req'], $minutes, function()
//				{

					$param=explode('|',base64_decode($_POST['req']));
					if($param[6]=='A')
                                        {
                                        $param[6]='E';
                                        }
		
	$qstring='format=json&dateofdeparture='.$param[2].'&source='.$param[0].'&dateofarrival=&destination='.$param[1].'&seatingclass='.$param[6].'&adults='.$param[3].'&children='.$param[4].'&infants='.$param[5].'&counter=100&test='.rand(3,12345678).'';
        
        
					//$url=  'http://pp.goibibobusiness.com/api/search/?'.$qstring;
                                       //$url=  'www.goibibobusiness.com/api/search/?'.$qstring;
					//$url=Config::get('flights_settings.url.get_flights').$qstring;
                    //$url='http://api.staging.cleartrip.com/air/1.0/search?from='.$param[0].'&to='.$param[1].'&depart-date='.$param[2].'&adults='.$param[3].'&children='.$param[4].'&infants='.$param[5].'&sort=asc';
                    $url='https://api.cleartrip.com/air/1.0/search?from='.$param[0].'&to='.$param[1].'&depart-date='.$param[2].'&adults='.$param[3].'&children='.$param[4].'&infants='.$param[5].'&sort=asc';

                    //echo $url;exit;
					// create curl resource 
					$ch = curl_init(); 
					// set url 
					curl_setopt($ch, CURLOPT_URL, $url); 
					//return the transfer as a string 
					//curl_setopt($ch, CURLOPT_USERPWD, "sharath@reward360.co:sharath123");
					//curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY:5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY:8ab8e687cd57ebd32ce8537ff8b53ede','X-CT-SOURCETYPE:API'));
                                        //curl_setopt($ch, CURLOPT_USERPWD, "hdfcsmartbuy@reward360.co:reward-123");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
					//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
					curl_setopt($ch, CURLOPT_TIMEOUT, 60); //timeout in seconds
					// $output contains the output string 
					$value = curl_exec($ch);
					
					// close curl resource to free up system resources 
					curl_close($ch); 
//					Log::info('smartbuy|Goibibo_search_request|'.$_SERVER['REMOTE_ADDR'].'|'.$url);
//					Log::info('smartbuy|Goibibo_search_response|'.$_SERVER['REMOTE_ADDR'].'|'.$value);

		
					return $value;
//				});
//
//			      }
		
			//echo $value;

    //db connected in case of api issue    
	//$output=DB::table('goibibo')->lists('response');      
	//print_r($output[0]);
	}

       public function round_flights()
	{
           
//                if (Cache::has('smartbuy_goibibo_round'.$_POST['req']))
//			{
//                
//				$output = Cache::get('smartbuy_goibibo_round'.$_POST['req']);
//			}
//			else
//			{
//				$minutes = Carbon::now()->addMinutes(5);
//
//				$output = Cache::remember('smartbuy_goibibo_round'.$_POST['req'], $minutes, function()
//				{
		$param=explode('|',base64_decode($_POST['req']));
                
               	if($param[6]=='A')
		{
		$param[6]='E';
		}
//		
////		$qstring='format=json&dateofdeparture='.$param[2].'&source='.$param[0].'&dateofarrival='.$param[8].'&destination='.$param[1].'&seatingclass='.$param[6].'&adults='.$param[3].'&children='.$param[4].'&infants='.$param[5].'&counter=100';
////
////		if($param[10]=='INT')
////		{
////		$qstring='format=json&dateofdeparture='.$param[2].'&source='.$param[0].'&dateofarrival='.$param[8].'&destination='.$param[1].'&seatingclass='.$param[6].'&adults='.$param[3].'&children='.$param[4].'&infants='.$param[5].'&counter=0';
////		
////		}
//		
                $url='https://api.cleartrip.com/air/1.0/search?from='.$param[0].'&to='.$param[1].'&depart-date='.$param[2].'&return-date='.$param[8].'&adults='.$param[3].'&children='.$param[4].'&infants='.$param[5].'&sort=asc';
//                
//                //echo $url;exit;
//                  //$url=  'http://pp.goibibobusiness.com/api/search/?'.$qstring;
//                 //$url=  'www.goibibobusiness.com/api/search/?'.$qstring;
//		 //$url=Config::get('flights_settings.url.round_flights').$qstring;
//                     //echo $url;exit;
//		
//// create curl resource 
		$ch = curl_init(); 
		//curl_setopt($ch, CURLOPT_USERPWD, "sharath@reward360.co:sharath123");
                //curl_setopt($ch, CURLOPT_USERPWD, "hdfcsmartbuy@reward360.co:reward-123");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY:8ab8e687cd57ebd32ce8537ff8b53ede','X-CT-SOURCETYPE:API'));
		// set url 
		curl_setopt($ch, CURLOPT_URL, $url); 

		//return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt($ch, CURLOPT_TIMEOUT, 60); //timeout in seconds    
		// $output contains the output string 
		   $value = curl_exec($ch); 
              
		// close curl resource to free up system resources 
		   curl_close($ch); 
//			Log::info('smartbuy|Goibibo_search_request|'.$_SERVER['REMOTE_ADDR'].'|'.$url);
//			Log::info('smartbuy|Goibibo_search_response|'.$_SERVER['REMOTE_ADDR'].'|'.$value);
         
                    return $value;
             
//                });
//
//			      }
                 //print_r(trim($value));


			      
		
	
//	$output=DB::table('goibibo')->where('id',3)->lists('response');      
//		      print_r($output[0]);
       
		
		



	} 
public function flight_payment()
	{
		
        
         $url = 'http://pp.goibibobusiness.com/api/book/';
         
         
         
        $booking_data="[".urldecode($_POST['booking_data'])."]";
        $querydata=urldecode($_POST['query_data']);    
        
        $fare=$_POST['fare']; 
        
        $searchKey_onward=$_POST['searchKey_onward']; 
        
        //passenger json construction
        $paxinfo_temp=array('FirstName'=>$_POST['firstname3'],'eticketnumber'=>'',"LastName"=>$_POST['lastname3'],"Title"=>$_POST['title3'],"DateOfBirth"=>date("d-m-Y",strtotime($_POST['dob3'])),"Type"=>"A");
        
        $paxinfo=  "[".json_encode($paxinfo_temp)."]";
        
        $contactinfo_temp=array("pincode"=>$_POST['pincode'],"state"=>$_POST['state'],"firstname"=>$_POST['name'],"lastname"=>"","email"=>$_POST['s_email'],"landline"=>$_POST['landline'],"mobile"=>$_POST['phonenumber'],"payment"=>"AXIS","address"=>"","city"=>$_POST['city']);
        
        $contactinfo=  json_encode($contactinfo_temp);
        
//        $contactinfo='[{"pincode": "518001",     "state": "Andhra Pradesh",     "firstname": "siva",     "lastname": "shanker",     "email": "sivashanker.g@mahiti.org",     "landline": "1234567890",     "mobile": "7259662454",     "payment": "AXIS",     "address": "new_address123",     "city": "Kurnool" }]';
       
        
        $ch=curl_init($url);
        //$data_string = urlencode(json_encode($data));
        curl_setopt($ch, CURLOPT_USERPWD, "hdfcsmartbuy@reward360.co:reward-123");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("bookingdata"=>$booking_data,"querydata"=>$querydata,"fare"=>$fare,"searchKey_onward"=>$searchKey_onward,"paxinfo"=>$paxinfo,"contactinfo"=>$contactinfo ));


        $result = curl_exec($ch);
   // echo "<pre>";print_r($result);exit;
         
        
     curl_close($ch);
         
         
         
         
         
         
         
         
         
        $payment_data['ref_number']='11222333111';
        $payment_data['recharge_amount']=$_POST['amount'];
        $payment_data['email']=$_POST['s_email'];
        return Redirect::to('payment_gateway')->with('data',$payment_data); 
	}


public function price_search()
	{
		$param=explode('|',base64_decode($_POST['req']));
                
		$car_id=explode(',',$_POST['car_id']);
		
		if(isset($car_id[0]))
		$car_id=$car_id[0];
		
		
		$source=$param[0];
		$destination=$param[1];
		$depart=$param[2];

		$rest[] = substr($depart, -2);    // returns "f"
		$rest[] = substr($depart, -4,2);    // returns "f"
		$rest[] = substr($depart, -8,4);    // returns "f"
		
		$rest1=array_reverse($rest);

		$date=implode('-',$rest1);
		
		$adult=$param[3];
		$child=$param[4];
		$infant=$param[5];
		
		if($param[6]=='A')
                {
                $param[6]='E';
                }
		//$url='http://api.staging.cleartrip.com/air/1.0/search?from='.$source.'&to='.$destination.'&depart-date='.$date.'&adults='.$adult.'&children='.$child.'&infants='.$infant.'&carrier='.$car_id.'&cabin-type='.$param[6].'&sort=asc';
                //$url='https://api.cleartrip.com/air/1.0/search?from='.$source.'&to='.$destination.'&depart-date='.$date.'&adults='.$adult.'&children='.$child.'&infants='.$infant.'&carrier='.$car_id.'&sort=asc';
                $deptime_array=explode('-',$depart);
            
            $deptime=$deptime_array[0].$deptime_array[1].$deptime_array[2];

            
                $qstring='format=json&dateofdeparture='.$deptime.'&source='.$source.'&dateofarrival=&destination='.$destination.'&seatingclass='.$param[6].'&adults='.$adult.'&children='.$child.'&infants='.$infant.'&counter=100&oneway='.rand(3,12345678).'';
		
                $url=Config::get('flights_settings.url.get_flights').$qstring;
                
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY:5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
		curl_setopt($ch, CURLOPT_USERPWD, Config::get('flights_settings.url.username_password1'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		
                

		 print_r($result);
		
		//$result=DB::table('cleartrip')->where('type',1)->lists('response');
		
		//echo $result[0];
		
		
		
	}
     

	public function price_search_round()
	{
		$param=explode('|',base64_decode($_POST['req']));
                
		//$car_id=explode(',',$_POST['car_id']);
//		if(isset($car_id[0]))
//		$car_id=$car_id[0];
		$source=$param[0];
		$destination=$param[1];
		$depart=$param[2];
		$rest[] = substr($depart, -2);    // returns "f"
		$rest[] = substr($depart, -4,2);    // returns "f"
		$rest[] = substr($depart, -8,4);    // returns "f"
		$rest1=array_reverse($rest);
		$odate=implode('-',$rest1);
		$adult=$param[3];
		$child=$param[4];
		$infant=$param[5];
		$arrive=$param[8];
		$arest[] = substr($arrive, -2);    // returns "f"
		$arest[] = substr($arrive, -4,2);    // returns "f"
		$arest[] = substr($arrive, -8,4); 
		$arest1=array_reverse($arest);
		$rdate=implode('-',$arest1);
		if($param[6]=='A')
                {
                $param[6]='E';
                }
		//$url='http://api.staging.cleartrip.com/air/1.0/search?from='.$source.'&to='.$destination.'&depart-date='.$odate.'&return-date='.$rdate.'&adults='.$adult.'&children='.$child.'&infants='.$infant.'&carrier='.$car_id.'&cabin-type='.$param[6].'&sort=asc';
		$deptime_array=explode('-',$depart);
                $deptime=$deptime_array[0].$deptime_array[1].$deptime_array[2];
                
                $arrive_array=explode('-',$arrive);
                $arrivetime=$arrive_array[0].$arrive_array[1].$arrive_array[2];

            
                $qstring='format=json&dateofdeparture='.$deptime.'&source='.$source.'&dateofarrival='.$arrivetime.'&destination='.$destination.'&seatingclass='.$param[6].'&adults='.$adult.'&children='.$child.'&infants='.$infant.'&counter=100&oneway='.rand(3,12345678).'';
                
                if($param[10]=='INT')
		{
		$qstring='format=json&dateofdeparture='.$deptime.'&source='.$source.'&dateofarrival='.$arrivetime.'&destination='.$destination.'&seatingclass='.$param[6].'&adults='.$adult.'&children='.$child.'&infants='.$infant.'&counter=0';
		
		}
		
                $url=Config::get('flights_settings.url.round_flights').$qstring;
              
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY:5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
		curl_setopt($ch, CURLOPT_USERPWD, Config::get('flights_settings.url.username_password1'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		print_r($result);
		
		//$result=DB::table('cleartrip')->where('type',1)->lists('response');
		
		//echo $result[0];
		
		
		
	}


	function clear_Checkout()
	{ 
            //echo "<pre>";print_r($_POST);exit;
            //to know flight is domestic or international
            if(isset($_POST['international']) && $_POST['international']<>'')
            {
            $data['international']='international';
            }
            $customer = Session::get('customer');
            $customer_data = Session::get('customer_data');
            
            $clear_select[]=$data['clear_select'][]=json_decode(urldecode($_POST['clear_select']));
            
            //echo "<pre>";print_r(json_decode(urldecode($_POST['clear_select'])));exit;
            
            //flight display starts
            $onward= $clear_select['0'];
            
            $ret = 0; 
            $return= array();
            
            $onw_return = Xml2array::toArray( $onward->onwardfl); 
            
            $cleartrip_faretype=Xml2array::toArray($onward->cleartrip_faretype);
            
            if(isset($onward->returnfl))
            {
              $cleartrip_faretype_return=Xml2array::toArray($onward->cleartrip_faretype);  
            }

            if(isset($_POST['return_select']) && $_POST['return_select']<>'') {
            $return_select[]=json_decode(urldecode($_POST['return_select']));
            
            if($_POST['clear_select']=='' || $_POST['return_select']=='')
            {
            Session::flash('message', "Flight you are trying to book is either full or unavailable. Please try again with some other flight");
            return Redirect::to('flight_index');
            }
            $ret = 1; 
            $return = $return_select[0]; 

            $ret_return = Xml2array::toArray($return->returnfl);
            $cleartrip_faretype_return=Xml2array::toArray($return->cleartrip_faretype);
            }
            //international
            if(isset($onward->returnfl) && !empty($onward->returnfl)) {
            $return_selectint=Xml2array::toArray($onward->returnfl);
            

            $ret_return= $return_selectint;
            
            
            }
           
            $data['onw_return']=$onw_return;
            $data['faretype']=$cleartrip_faretype;

            if(isset($ret_return) && $ret_return<>'')
            {
            $data['ret_return']=$ret_return;    
            $data['faretype_return']=$cleartrip_faretype_return;
            }
            //flight display ends
            
            //flight price details
            if(isset($return->price['0']->total_tax) && !empty($return->price['0']->total_tax))
            {
                $data['cash']=$onward->price['0']->cash+$return->price['0']->cash;
                $data['total_tax']=$onward->price['0']->total_tax+$return->price['0']->total_tax;
            }
            else
            {
                $data['cash']=$onward->price['0']->cash;
                $data['total_tax']=$onward->price['0']->total_tax;
                
            }
             
            //flight price ends
            
            
            

            if(isset($_POST['return_select']) && $_POST['return_select']<>'')
            {
            $return_select[]=$data['return_select'][]=json_decode(urldecode($_POST['return_select']));
            }
           
            if(isset($_POST['clearpost']) && $_POST['clearpost']<>'')
            {
            $data['book_passsenger']=$book_passsenger=unserialize(str_replace('quot','"',$_POST['clearpost']));
            }
            
            //getting the passenger count details
            
            $passenger_count=count($clear_select['0']->passenger_onward);
            
            if($passenger_count>0)
            {
                $adulttax=0;
              for($i=0;$i<$passenger_count;$i++)
              {
                 $passsenger_details=$clear_select['0']->passenger_onward;
                 
                
                 //adult price details
                    if(isset($passsenger_details[$i]->pax_type) && $passsenger_details[$i]->pax_type=='ADT')
                    {
                        //echo "<pre>";print_r($passsenger_details[$i]->category);
                        if($passsenger_details[$i]->category=='BF')
                        {
                        $data['adultbasefare']=$adultbasefare=$passsenger_details[$i]->amount;
                        }   
                        else
                        {
                        //echo "hai"; 
                        $adulttax +=$passsenger_details[$i]->amount;
                        
                        }
                        
                        //$data['adult_final_price']=$data['adultbasefare']+ $adulttax;


                    }
                    else
                    {
                         $data['adult_final_price']=0;
                    }
                    
                   
              }
              
            }
            
            
            
            //children
            if($passenger_count>0)
            {
                $childtax=0;
              for($i=0;$i<$passenger_count;$i++)
              {
                 $passsenger_details=$clear_select['0']->passenger_onward;
//                 echo "<pre>";print_r($passsenger_details);
                
                 //adult price details
                    if(isset($passsenger_details[$i]->pax_type) && $passsenger_details[$i]->pax_type=='CHD')
                    {
                        //echo "<pre>";print_r($passsenger_details[$i]->category);
                        if($passsenger_details[$i]->category=='BF')
                        {
                        $data['childrenbasefare']=$childrenbasefare= $passsenger_details[$i]->amount;
                        }   
                        else
                        {
                        //echo "hai"; 
                        $childtax += $passsenger_details[$i]->amount;
                        
                        }

                        //$data['adult_final_price']=$data['adultbasefare']+ $adulttax;


                    }
                    else
                    {
                      //echo "hello"; 
                         $data['children_final_price']=0;
                    }
                    
                   
              }
              
            }
            
            if($passenger_count>0)
            {
                $infantstax=0;
              for($i=0;$i<$passenger_count;$i++)
              {
                 $passsenger_details=$clear_select['0']->passenger_onward;
                 
                
                 //adult price details
                    if(isset($passsenger_details[$i]->pax_type) && $passsenger_details[$i]->pax_type=='INF')
                    {
                        //echo "<pre>";print_r($passsenger_details[$i]->category);
                        if($passsenger_details[$i]->category=='BF')
                        {
                        $data['infantsbasefare']=$infantsbasefare= $passsenger_details[$i]->amount;
                        }   
                        else
                        {
                        //echo "hai"; 
                        $infantstax += $passsenger_details[$i]->amount;
                        
                        }

                        //$data['adult_final_price']=$data['adultbasefare']+ $adulttax;


                    }
                    else
                    {
                      //echo "hello"; 
                         $data['infants_final_price']=0;
                    }
                    
                   
              }
              
            }
            
            //return flights
            if(isset($_POST['return_select']) && $_POST['return_select']<>'')
            {
            $passenger_count_return=count($return_select['0']->passenger_return);
            
            if($passenger_count_return>0)
            {
                $adulttax_return=0;
              for($i=0;$i<$passenger_count_return;$i++)
              {
                 $passsenger_details_return=$return_select['0']->passenger_return;
                 //echo "<pre>";print_r($passsenger_details_return[$i]->category);
                
                 //adult price details
                    if(isset($passsenger_details_return[$i]->pax_type) && $passsenger_details_return[$i]->pax_type=='ADT')
                    {
                        //echo "<pre>";print_r($passsenger_details_return[$i]->category);
                        if($passsenger_details_return[$i]->category=='BF')
                        {
                        $data['adultbasefare_return']=$adultbasefare_return=$passsenger_details_return[$i]->amount;
                        }   
                        else
                        {
                        //echo "hai"; 
                        $adulttax_return +=$passsenger_details_return[$i]->amount;
                        
                        }

                    }
                    else
                    {
                      //echo "hello"; 
                         $data['adult_final_price_return']=0;
                    }
                    
                   
              }
              
            }
            //children
            if($passenger_count_return>0)
            {
                $childtax_return=0;
              for($i=0;$i<$passenger_count_return;$i++)
              {
                 $passsenger_details_return=$return_select['0']->passenger_return;
//                 echo "<pre>";print_r($passsenger_details_return);
                
                 //adult price details
                    if(isset($passsenger_details_return[$i]->pax_type) && $passsenger_details_return[$i]->pax_type=='CHD')
                    {
                        //echo "<pre>";print_r($passsenger_details_return[$i]->category);
                        if($passsenger_details_return[$i]->category=='BF')
                        {
                        $data['childrenbasefare_return']=$childrenbasefare_return= $passsenger_details_return[$i]->amount;
                        }   
                        else
                        {
                        //echo "hai"; 
                        $childtax_return += $passsenger_details_return[$i]->amount;
                        
                        }

                        //$data['adult_final_price_return']=$data['adultbasefare_return']+ $adulttax_return;


                    }
                    else
                    {
                      //echo "hello"; 
                         $data['children_final_price_return']=0;
                    }
                    
                   
              }
              
            }
            
            if($passenger_count_return>0)
            {
                $infantstax_return=0;
              for($i=0;$i<$passenger_count_return;$i++)
              {
                 $passsenger_details_return=$return_select['0']->passenger_return;
                 
                
                 //adult price details
                    if(isset($passsenger_details_return[$i]->pax_type) && $passsenger_details_return[$i]->pax_type=='INF')
                    {
                        //echo "<pre>";print_r($passsenger_details_return[$i]->category);
                        if($passsenger_details_return[$i]->category=='BF')
                        {
                        $data['infantsbasefare_return']=$infantsbasefare_return= $passsenger_details_return[$i]->amount;
                        }   
                        else
                        {
                        //echo "hai"; 
                        $infantstax_return += $passsenger_details_return[$i]->amount;
                        
                        }

                        //$data['adult_final_price_return']=$data['adultbasefare_return']+ $adulttax_return;


                    }
                    else
                    {
                      //echo "hello"; 
                         $data['infants_final_price_return']=0;
                    }
                    
                   
              }
              
            }
            }
            //end of the return flights
            
            if(isset($_POST['return_select']) && $_POST['return_select']<>'')
            {
            if(isset($adultbasefare) && $adultbasefare<>'')
            {
                
            $data['adult_final_price']=$adulttax+$adultbasefare+$adulttax_return+$adultbasefare_return;
            
            
            $data['adulttax']=$adulttax+$adulttax_return;
            }
            
            if(isset($childrenbasefare) && $childrenbasefare<>'')
            {
            $data['children_final_price']=$childtax+$childrenbasefare+$childtax_return+$childrenbasefare_return;
            $data['childtax']=$childtax+$childtax_return;
            
            
            }
            
            if(isset($infantsbasefare) && $infantsbasefare<>'')
            {
            $data['infants_final_price']=$infantstax+$infantsbasefare+$infantstax_return+$infantsbasefare_return;
            $data['infantstax']=$infantstax+$infantstax_return;
            }
            }
            else
            {
             if(isset($adultbasefare) && $adultbasefare<>'')
            {
                
            $data['adult_final_price']=$adulttax+$adultbasefare;
            
            
            $data['adulttax']=$adulttax;
            }
            
            if(isset($childrenbasefare) && $childrenbasefare<>'')
            {
            $data['children_final_price']=$childtax+$childrenbasefare;
            $data['childtax']=$childtax;
            }
            
            if(isset($infantsbasefare) && $infantsbasefare<>'')
            {
            $data['infants_final_price']=$infantstax+$infantsbasefare;
            $data['infantstax']=$infantstax;
            }   
            }
            
             $data['amount']=round($data['adult_final_price']+$data['children_final_price']+$data['infants_final_price']);
             
       
        
        //no o tickets         
              if(isset($book_passsenger) && $book_passsenger<>'')
              {
              $data['tickets']=$book_passsenger['adults']+ $book_passsenger['children']+ $book_passsenger['infants'];
              
              $data['adults']=$book_passsenger['adults'];
              $data['children']=$book_passsenger['children'];
              $data['infants']=$book_passsenger['infants'];
              
              }
              else
              {
                  $data['tickets']=0;
                  $data['adults']=2;
                  $data['children']=1;
                  $data['infants']=1;
              }
            
              //create itinerary
             
              //echo "<pre>";print_r($clear_select['0']);exit;
            $count1=count($clear_select['0']->booking);
            
                        
			$data['bread_crumb']=array('Home'=>'/');
			//echo '<pre>'; print_r($data); exit;
			$this->load_reward_region('auth','data',''); 
			return $this->render_reward_theme('goibibo.flight_checout',$data); 
            
            
        }
        
        function continue_checkout()
        {    
            $return_select='';
            $data = Rewards::redirect_helper('Goibibo@continue_checkout'); //Redirect Url after login

            $data['getdetails']=$_POST; 
            $_POST=$data;
                                
                                
            if(isset($_POST['fuldata']) && $_POST['fuldata']<>'')
            {
            $data['fuldata']=$_POST['fuldata'];
            }
            
            if(isset($_POST['booking_data']) && $_POST['booking_data']<>'')
            {
            $data['booking_data']=$_POST['booking_data'];
            }
            
            $data['book_passsenger']=$book_passsenger=json_decode(urldecode($_POST['clearpost']));
            $data['odept_date']=$book_passsenger->departure;
             if(isset($book_passsenger->type) && $book_passsenger->type=='R')
             {
            $data['arr_date']=$book_passsenger->return;
             }
             
            if(isset($_POST['clear_select']) && $_POST['clear_select']<>'')
            {
            $data['clear_select']=json_decode(urldecode($_POST['clear_select']));
            }
            if(isset($_POST['return_select']) && $_POST['return_select']<>'')
            {
            $data['return_select']=$_POST['return_select'];
            }
            
            //goibibo
            if(isset($_POST['booking_data']) && $_POST['booking_data']<>'')
            {
                $booking_data="[".$_POST['booking_data']. "]";
                $querydata=$data['querydata']= $_POST['query_data'];
                    
                    
                //total fare
                //$fare=$data['fare']=$_POST['fare'];

                //search key
                //$searchKey_onward=$data['searchkeyonward']=$_POST['searchKey_onward'];  
                $json_decoded=$data['json_decoded']=json_decode(urldecode($_POST['reprice_data']));
        //flight checkout starts
        $onwards = $json_decoded->onwardflights['0']; 
        
         //echo "<pre>";print_r($onwards);exit;
        
      // echo "<pre>";print_r($onwards);
        $new_array = array();
        $new_array[0]['sour'] = $onwards->origin;
        $onw_return['sour'][] = $onwards->origin;
        $new_array[0]['dst_tym']  =strtoupper($onwards->arrdate);
        $new_array[0]['car_id']  = $onwards->carrierid;
        $new_array[0]['fnum']  = $onwards->flightno;
        $new_array[0]['desti']  = $onwards->destination;
        $new_array[0]['arr_tym'] =  strtoupper($onwards->depdate);
        if(isset($onwards->Group) && $onwards->Group<>'')
        $new_array[0]['Group'] = strtoupper($onwards->Group);
        if(isset($onwards->onwardflights)){
            $count = 1; 
        foreach($onwards->onwardflights as $oconnect){
      $onw_return['sourc'][] = $oconnect->origin;
      $new_array[$count]['sour'] = $oconnect->origin;
        $onw_return['sour'][] = $oconnect->origin;
        $new_array[$count]['dst_tym']  =strtoupper($oconnect->arrdate);
        $new_array[$count]['car_id']  = $oconnect->carrierid;
        $new_array[$count]['fnum']  = $oconnect->flightno;
        $new_array[$count]['desti']  = $oconnect->destination;
        $new_array[$count]['arr_tym'] =  strtoupper($oconnect->depdate);
        if(isset($oconnect->Group) && $oconnect->Group<>'')
        $new_array[$count]['Group'] = strtoupper($oconnect->Group);
        $count++; 
        
        }
        }
        
        $faretype=array(array('fare_type'=>$onwards->warnings));
        $data['faretype']=$faretype;
        
        // Return Flights 
        if(isset( $json_decoded->returnflights['0']))
        {
        $return = $json_decoded->returnflights['0']; 
        $new_array_ret = array();
        
        $new_array_ret[0]['sour'] = $return->origin;
        $onw_return['sour'][] = $return->origin;
        $new_array_ret[0]['dst_tym']  =strtoupper($return->arrdate);
        $new_array_ret[0]['car_id']  = $return->carrierid;
        $new_array_ret[0]['fnum']  = $return->flightno;
        $new_array_ret[0]['desti']  = $return->destination;
        $new_array_ret[0]['arr_tym'] =  strtoupper($return->depdate);
        if(isset($return->Group) && $return->Group<>'')
        $new_array_ret[0]['Group'] = strtoupper($return->Group);
        if(isset($return->onwardflights)){
        $count = 1; 
        foreach($return->onwardflights as $oconnect){
        $onw_return['sourc'][] = $oconnect->origin;
        $new_array_ret[$count]['sour'] = $oconnect->origin;
        $onw_return['sour'][] = $oconnect->origin;
        $new_array_ret[$count]['dst_tym']  = strtoupper($oconnect->arrdate);
        $new_array_ret[$count]['car_id']  = $oconnect->carrierid;
        $new_array_ret[$count]['fnum']  = $oconnect->flightno;
        $new_array_ret[$count]['desti']  = $oconnect->destination;
        $new_array_ret[$count]['arr_tym'] = strtoupper($oconnect->depdate);
        if(isset($return->Group) && $return->Group<>'')
        $new_array_ret[$count]['Group'] = strtoupper($oconnect->Group);
        $count++; 

        }
        }
        }
        
        $data['onw_return']=$new_array;
        
        if(isset($new_array_ret) && $new_array_ret<>'')
            {
            $data['ret_return']=$new_array_ret;    
            $faretype_return=array(array('fare_type'=>$return->warnings));
            $data['faretype_return']=$faretype_return;
            }
            
       //flight checkout ends
                $count=count($json_decoded->onwardflights);
                for($i=0;$i<$count;$i++)
                {
                $data['osourc']=$json_decoded->onwardflights[$i]->origin;

                if(isset($json_decoded->onwardflights['0']->onwardflights) && !empty($json_decoded->onwardflights['0']->onwardflights))
                {
                $data['odeat']=$json_decoded->onwardflights['0']->onwardflights[$i]->destination;
                }
                else
                {
                $data['odeat']=$json_decoded->onwardflights['0']->destination; 
                }

                $data['odept_tym']=$json_decoded->onwardflights[$i]->deptime;
                $data['oarr_tym']=$json_decoded->onwardflights[$i]->arrtime;


                    //adult price details
                    if(isset($json_decoded->onwardflights[$i]->fare->adultbasefare) && $json_decoded->onwardflights[$i]->fare->adultbasefare<>'')
                    {
                    $data['adultbasefare']=$json_decoded->onwardflights[$i]->fare->adultbasefare;
                    if(isset($json_decoded->onwardflights[$i]->fare->adulttax) && $json_decoded->onwardflights[$i]->fare->adulttax<>'')
                    {
                    $data['adulttax']=$json_decoded->onwardflights[$i]->fare->adulttax;
                    }
                    else
                    {
                    $data['adulttax']=0;
                    }
                    $data['adult_final_price']=$data['adultbasefare']+ $data['adulttax'];
                    }
                    else
                    {
                      $data['adult_final_price']=0;  
                    }

                    //children price details
                    if(isset($json_decoded->onwardflights[$i]->fare->childbasefare) && $json_decoded->onwardflights[$i]->fare->childbasefare<>'')
                    {
                    $data['childrenbasefare']=$json_decoded->onwardflights[$i]->fare->childbasefare;
                    if(isset($json_decoded->onwardflights[$i]->fare->childtax) && $json_decoded->onwardflights[$i]->fare->childtax<>'')
                    {
                    $data['childrentax']=$json_decoded->onwardflights[$i]->fare->childtax;
                    }
                    else
                    {
                    $data['childrentax']=0;
                    }
                    $data['children_final_price']=$data['childrenbasefare']+ $data['childrentax'];
                    }
                    else
                    {
                      $data['children_final_price']=0;  
                    }

                    //infants price details
                    if(isset($json_decoded->onwardflights[$i]->fare->infantbasefare) && $json_decoded->onwardflights[$i]->fare->infantbasefare<>'')
                    {
                    $data['infantsbasefare']=$json_decoded->onwardflights[$i]->fare->infantbasefare;
                    if(isset($json_decoded->onwardflights[$i]->fare->infanttax) && $json_decoded->onwardflights[$i]->fare->infanttax<>'')
                    {
                    $data['infantstax']=$json_decoded->onwardflights[$i]->fare->infanttax;
                    }
                    else
                    {
                    $data['infantstax']=0;    
                    }
                    $data['infants_final_price']=$data['infantsbasefare']+ $data['infantstax'];
                    }
                    else
                    {
                      $data['infants_final_price']=0;  
                    }
                  
                    $data['amount']=$_POST['amount'];





                }
              $data['adults']=$book_passsenger->adults;
              $data['children']=$book_passsenger->children;
              $data['infants']=$book_passsenger->infants;
              
            //connection flights  
            if(isset($json_decoded->onwardflights['0']->onwardflights) && !empty($json_decoded->onwardflights['0']->onwardflights))
            {

            //echo "<pre>";print_r($connection_flights);exit;
            $data['osourc_con']=strtoupper($json_decoded->onwardflights['0']->destination);

            //echo "<pre>";print_r($osourc_temp);exit;
            //            $data['con_destination']=$connection_flights->destination;
            //            $data['con_arrtime']=$connection_flights->arrtime;
            $data['con_deptime']='';



            }
            if(isset($json_decoded->returnflights) && $json_decoded->returnflights<>'')
            {
            $count=count($json_decoded->returnflights);
            for($i=0;$i<$count;$i++)
            {
            $data['rsourc']=strtoupper($json_decoded->returnflights[$i]->origin);

            if(isset($json_decoded->returnflights['0']->onwardflights) && !empty($json_decoded->returnflights['0']->onwardflights))
            {
            $data['rdeat']=strtoupper($json_decoded->returnflights['0']->onwardflights[$i]->destination);
            }
            else
            {
            $data['rdeat']=strtoupper($json_decoded->returnflights['0']->destination); 
            }
            
            $data['rdept_tym']=$json_decoded->returnflights[$i]->deptime;
            $data['rarr_tym']=$json_decoded->returnflights[$i]->arrtime;
            $data['type']="R";
            }
            }
            //this is for only connection flights
            //echo "<pre>";print_r($json_decoded->returnflights['0']->returnflights);exit;
            if(isset($json_decoded->returnflights['0']->onwardflights) && !empty($json_decoded->returnflights['0']->onwardflights))
            {


            //echo "<pre>";print_r($connection_flights);exit;
            $data['rsourc_con']=strtoupper($json_decoded->returnflights['0']->destination);

            //echo "<pre>";print_r($rsourc_temp);exit;
            //            $data['con_destination']=$connection_flights->destination;
            //            $data['con_arrtime']=$connection_flights->arrtime;
            $data['con_deptime']='';



            }
            
              //no o tickets         
              $data['tickets']=$book_passsenger->adults+ $book_passsenger->children+ $book_passsenger->infants;
              $data['emi_data']=Checkouthelper::emi_logic($data['amount']);
              $data['ctype']="flights1";
	      $data['interest']=Checkouthelper::interest();
              
		$data['bread_crumb']=array('Home'=>'/');
            $this->load_reward_region('auth','data',''); 
            
           
            return $this->render_reward_theme('goibibo.continue_checkout',$data);      
                    
            }
            //cleartrip
            else
            {
            $tickets=$_POST['tickets']+3;
            
            $clear_select=json_decode(urldecode($_POST['clear_select']));
            $result_select='';
             if(isset($_POST['return_select']) && $_POST['return_select']<>'')
	     {
                 
	     $return_select=$data['return_select']=json_decode(urldecode($_POST['return_select']));
             
	     }
             
             //flight checkout starts
            $onward= $clear_select[0];
            
            $ret = 0; 
            $return= array();
            
            
            $onw_return = Xml2array::toArray( $onward->onwardfl); 
            $cleartrip_faretype=Xml2array::toArray($onward->cleartrip_faretype);
            
            if(isset($onward->returnfl))
            {
              $cleartrip_faretype_return=Xml2array::toArray($onward->cleartrip_faretype);  
            }
            
            if(isset($_POST['return_select']) && $_POST['return_select']<>'') {
            $return_select=json_decode(urldecode($_POST['return_select']));
            $ret = 1; 
            $return = $return_select[0]; 

            //$ret_return = array_merge($onward->onwardfl,$return->returnfl);	
            
            $ret_return = Xml2array::toArray($return->returnfl);
             $cleartrip_faretype_return=Xml2array::toArray($return->cleartrip_faretype);
            }
            //international
            if(isset($onward->returnfl) && !empty($onward->returnfl)) {
            $return_selectint=Xml2array::toArray($onward->returnfl);
            //$ret_return = array_merge($onward->onwardfl,$return->returnfl);	
            $ret_return= $return_selectint;
            }
           
            $data['onw_return']=$onw_return;
            $data['faretype']=$cleartrip_faretype;
            if(isset($ret_return) && $ret_return<>'')
            {
            $data['ret_return']=$ret_return;    
            $data['faretype_return']=$cleartrip_faretype_return;
            }
            //flight checkout ends
            
            
            $count=count($clear_select['0']->onwardfl);
            
            
            
            //return flights
            if(isset($_POST['return_select']) && $_POST['return_select']<>'')
	     {
             $count=count($return_select['0']->returnfl);
                $data['type']="R";
             }
            //end of return flights
             
             //return flights international
            if(isset($clear_select['0']->returnfl) && $clear_select['0']->returnfl<>'')
	     {  
                $data['type']="R";
             }
            //end of return flights international 
             
            $data['book_passsenger']=$book_passsenger=json_decode(urldecode($_POST['clearpost']));
            
            
             //no o tickets         
              if(isset($book_passsenger) && $book_passsenger<>'')
              {
              $data['tickets']=$book_passsenger->adults+ $book_passsenger->children+ $book_passsenger->infants;
              
              $data['adults']=$book_passsenger->adults;
              $data['children']=$book_passsenger->children;
              $data['infants']=$book_passsenger->infants;
              
              }
              else
              {
                  $data['tickets']=0;
                  $data['adults']=2;
                  $data['children']=1;
                  $data['infants']=1;
              }
            
            //constructing the xml
            $create_itinerary=Viaflight::createitinerary($clear_select,$return_select,$book_passsenger);
            
			//converting xml to array
            $itinerary_2_array=Xml2array::xml2array_test(trim($create_itinerary));
            
            if(isset($itinerary_2_array['itinerary']['itinerary-id']) && $itinerary_2_array['itinerary']['itinerary-id']<>'')
            {
            $data['bread_crumb']=array('Home'=>'/');
            $this->load_reward_region('auth','data',''); 
            
            $data['itinerary_id']=$itinerary_id=$itinerary_2_array['itinerary']['itinerary-id'];
            
            //fare rules
        	$data['fare_rules']=Viaflight::fare_rules($itinerary_id);
            
            $data['amount']=$itinerary_2_array['itinerary']['pricing-summary']['total-fare'];
	    $data['emi_data']=Checkouthelper::emi_logic($data['amount']);
	    $data['interest']=Checkouthelper::interest();
            $data['ctype']="flights2";
		
		
            return $this->render_reward_theme('goibibo.continue_checkout',$data);   
            }
            else
            {
                Session::flash('message', "Flight you are trying to book is either full or unavailable. Please try again with some other flight");
                return Redirect::to('flight_index');
            }
            }
            
            
            
        }
        function createitinerary()
        {
            
            $xmlRequest=urldecode($_POST['xmlrequest']);
            
            //create the createitinerary
            $authkey='5caebd280ccdf3463b025eca00fa5e78';
            $url = 'http://api.staging.cleartrip.com/air/1.0/itinerary/create?xmlRequest='.$xmlRequest;
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
            $data = curl_exec($ch); 

            if(curl_errno($ch))
            print curl_error($ch);
            else
            curl_close($ch);
            
            //$xml = simplexml_load_string($data);
            
           
             echo $data;
           
           
            
            
            
        }
        public function book()
        {
            
             $checkhash = "travelibibo|". ".$data->customReference." . '|'. ".$data->customReference.". '|' . ".$data->productinfo.". 
                       '|sivashanker|sivashanker.g@mahiti.org' . "temp"  . '|' . "true"  . '|' . ".$data->hash."  ; 
        }
        function clear_Checkout_mine()
        {
            
            $clear_select=json_decode($_POST['clear_select']);
            //echo "<pre>";print_r($clear_select['0']);exit;
            
            
            $count1=count($clear_select['0']->booking);
            
                        /*$xmlRequest="<itinerary xmlns='http://www.cleartrip.com/air/'>";
                        for($i=0;$i<$count1;$i++)
                                {
                                   //$onwardfl_temp[$i]['sour'] ;
                                    $xmlRequest.= "<cabin-type>".$clear_select['0']->booking[$i]->cabin."</cabin-type>";

                                }
                    
                        $xmlRequest.="<flights><flight-spec><fare-key>".$clear_select['0']->price[0]->farekey."  </fare-key>  "; 
                        
                        
                        $xmlRequest.="<segments>";
                        
                        $count2=count($clear_select['0']->onwardfl);
                        //echo $count1;exit;
                        for($i=0;$i<$count2;$i++)
                        {
                        $xmlRequest.="<segment-spec>";
                        $xmlRequest.="
                                         <departure-airport>".$clear_select['0']->onwardfl[$i]->sour."</departure-airport>
                                         <arrival-airport>".$clear_select['0']->onwardfl[$i]->desti."</arrival-airport>
                                         <flight-number>".$clear_select['0']->onwardfl[$i]->car_id."</flight-number>
                                         <airline>".$clear_select['0']->onwardfl[$i]->car_id."</airline>
                                         <operating-airline>".$clear_select['0']->onwardfl[$i]->fnum."</operating-airline>
                                         <departure-date>".$clear_select['0']->onwardfl[$i]->arr_tym."</departure-date>    
                                     ";
                         $xmlRequest.="</segment-spec>";
                         
                        }
                        
                        $xmlRequest.="</segments>";
                        $xmlRequest.="</flight-spec>";
                        $xmlRequest.="</flights>";
             
  		 $xmlRequest.="</itinerary>";
                 */
            
            $xmlRequest="<itinerary xmlns='http://www.cleartrip.com/air/'>
            <cabin-type>E</cabin-type>
            <flights>
            <flight-spec>
            <fare-key>
            supp_AMADEUS|si-api-261a895b-f450-4c34-9ee6-762db3155428|fk_retail_9W_7029_1406769600000_B2A60S2_true__fpr_2966
            </fare-key>
            <segments>
            <segment-spec>
            <departure-airport>BLR</departure-airport>
            <arrival-airport>MAA</arrival-airport>
            <flight-number>9W</flight-number>
            <airline>9W</airline>
            <operating-airline>7029</operating-airline>
            <departure-date>2014-07-31T06:50:00</departure-date>
            </segment-spec>
            </segments>
            </flight-spec>
            </flights>
            </itinerary>";
                 //echo "<pre>";print_r($siv);exit;
                
            $authkey='5caebd280ccdf3463b025eca00fa5e78';
           
            
            $url = 'http://api.staging.cleartrip.com/air/1.0/itinerary/create?xmlRequest='.$xmlRequest;
	
        
            //echo "<pre>";print_r($url);exit; 
// create curl resource 
       
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		
        echo "<pre>";print_r($result);
        }
        //booking for goibibo
        
        function flights_not_available()
        {
        $data['bread_crumb']=array('Home'=>'/');
        //echo '<pre>'; print_r($data); exit;
        $this->load_reward_region('auth','data',''); 
        return $this->render_reward_theme('goibibo.flights_not_available',$data);   
        }
        
        function load_infants()
        {
            
            $out='<select name="infants" id="infants" class="form-control" >';
            for($i=0;$i<=$_POST['adults_count'];$i++)
            {
                $out .='<option value='.$i.'>'.$i.'</option>';
            }
            $out .='</select>';

            echo $out;
        }
        function fare_rules()
        {
            $authkey='5caebd280ccdf3463b025eca00fa5e78';
            $itineraryid=$_POST['itinerrary_id'];
            $url="http://api.staging.cleartrip.com/air/1.0/itinerary/rules/".$itineraryid;
            //$url = 'http://api.staging.cleartrip.com/air/1.0/itinerary/create?xmlRequest='.$xmlRequest;

            $post = curl_init();
            curl_setopt($post, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
            curl_setopt($post, CURLOPT_URL, $url);
            //curl_setopt($post, CURLOPT_CUSTOMREQUEST, "Delete");
            //curl_setopt($post, CURLOPT_POST, count($data));

            curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($post);

            curl_close($post);

            //echo "<pre>";print_r(htmlspecialchars($result));
            $test=Xml2array::xml2array_test(trim(htmlspecialchars($result)));
            print_r($test);
            print_r($test['fare-rules']['sections']['section']['text']);
        }


	public function fare_rule()
	{
		$rules=Viaflight::fare_rules($_POST['req']);
		print_r($rules);
	}
        public function fare_rule_goibibo()
        {
            
        $rules=urldecode($_POST['req']);
       
        $test=json_decode($rules);
        
        $test1="<style> ul {margin-left:-46px;}</style><font size:3 style='font-weight: bold;'>Farerules </font><div class=clearfix></div><br/>";
       
        $test1 .="Cancel Chaarges : ".$test->data->cancel_charges ."<br/><br/>";
        $test1 .="resc_charges  :". $test->data->resc_charges ."<br/><div class=clearfix></div>";
        $test1 .="<span style='margin-left: -46px;'>".$test->data->tnc."</span>";
        print_r($test1);
        }

     public function test333()
     {

     } 
    }
	
    	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


