<?php
class Airlines extends BaseController  {
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
      		
	        
        	$this->load_reward_region('auth','data',''); 
       		return $this->render_reward_theme('flightraja.home',$flight); 
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
      		
        	$this->load_reward_region('auth','data',''); 
       		return $this->render_reward_theme('flightraja.inthome',$data); 
	}

	public function Listing_Flights()
	{  
	if((isset($_POST) && !empty($_POST)) )
		{
                  // echo '<pre>'; print_r($_POST); exit;
			$return="";
			$dis_fare='Y';
			if((isset($_POST) && !empty($_POST))){
			$data=$_POST;
			$data['post']=$_POST;
			}
			
			if(isset($data['departure']) && $data['departure']<>'')
			$deptime=date('Y-m-d',strtotime($data['departure']));
			else
			$deptime=date('Y-m-d');

			if(isset($data['return']) && $data['return']<>''){

			$return=date('Y-m-d',strtotime($data['return']));
			$reqtype=$data['type'];
			}
			else
			{
			$reqtype="";
			$tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y"));
			$return=date('Y-m-d',$tomorrow);

			}

			if($data['type']=='R')
			{
			$returnxml="<DateOfArrival>".$return."</DateOfArrival>";
			$view='via_new_round';
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
			}
			else
			{
			$returnxml='';
			}
			$req=$data['leavingfrom'].'|'.$data['goingto'].'|'.$deptime.'|'.$data['adults'].'|'.$data['children'].'|'.$data['infants'].'|'.$data['class'].'|'.$data['type'].'|'.$return.'|'.$dis_fare;
				$data['req']=base64_encode($req);
                                $data['spoint']=$_POST['leavingfrom'];
				$data['epoint']=$_POST['goingto'];
				if($data['type']=='R')
				{
			if(isset($_POST['discouted']) && $_POST['discouted']=='on'){
					$view='via_new_round';
					$js_f[]='js/roundway.js';
			}
			else
			{
					$view='round_trip';
					$js_f=array('js/radioselect.js','js/filter_criti.js','js/round_criti.js');
				
			}
			
				
			}else{
					$view='via_new_one';
					$js_f[]='js/oneway.js';

				}
$data['c_ratio']=0.70;
				$data['bread_crumb']=array('Home'=>'/');
      		
                                
				$this->load_reward_region('auth','data',''); 
				return $this->render_reward_theme_hotels('flightraja.'.$view,$data);
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
	
	public function Yatra_Checkout()
	{
//echo '<pre>';
       // print_r($_POST);
       // exit;
	$fbo=str_replace('[CDATA[','',urldecode($_POST['ofare_base']));
		$fbno=str_replace(']]','',$fbo);
		$fbr=str_replace('[CDATA[','',urldecode($_POST['rfare_base']));
		$fbnr=str_replace(']]','',$fbr);

		$fli['carid']=$_POST['ocarid'].''.$_POST['rcarid'];
		$fli['carrier']=$_POST['ocarname'].''.$_POST['rcarname'];
		$fli['fno']=$_POST['ofnum'].''.$_POST['rfnum'];
		$fli['source']=$_POST['osourc'].''.$_POST['rsourc'];	
		$fli['dest']=$_POST['odeat'].''.$_POST['rdeat'];
		$fli['arr']=$_POST['oarr_tym'].''.$_POST['rarr_tym'];
		$fli['destym']=$_POST['odept_tym'].''.$_POST['rdept_tym'];
		$fli['class']=$_POST['oclass'].''.$_POST['rclass'];
		$fli['fare']=$fbno.''.$fbnr;
		if(isset($_POST['startpoint']))
		$start=$_POST['startpoint'];

		if(isset($_POST['destination']))
		$dest=$_POST['destination'];

		

		
		if($_POST)
		{   
			$constrt=array();
		
		$constrct['flights']['car_id']=array_filter(explode(',',$fli['carid']));
		$constrct['flights']['carrier']=array_filter(explode(',',$fli['carrier']));
		$constrct['flights']['fno']=array_filter(explode(',',$fli['fno']));
		$constrct['flights']['source']=array_filter(explode(',',$fli['source']));
		$constrct['flights']['dest']=array_filter(explode(',',$fli['dest']));
		$constrct['flights']['arr']=array_filter(explode(',',$fli['arr']));
		$constrct['flights']['destym']=array_filter(explode(',',$fli['destym']));
		$constrct['flights']['class']=array_filter(explode(',',$fli['class']));
		$constrct['flights']['fare']=array_filter(explode(',',$fli['fare']));

//pricing data
		$constrct['flights']['SingleAdultBaseFare']=$_POST['price1'];
		$constrct['flights']['SingleAdultSurcharge']=$_POST['price2'];
		$constrct['flights']['SingleAdultTotalTaxes']=$_POST['price3'];
		$constrct['flights']['SingleAdultAgentSurcharge']=$_POST['price4'];
		$constrct['flights']['SingleAdultTotalAmount']=$_POST['price5'];
		$constrct['flights']['SingleAdultCreditCardCharges']=$_POST['price6'];
		$constrct['flights']['SingleAdultCommission']=$_POST['price7'];
		$constrct['flights']['SingleAdultServiceTax']=$_POST['price8'];
		$constrct['flights']['SingleChildTotalAmount']=$_POST['price10'];
		$constrct['flights']['SingleInfantTotalAmount']=$_POST['price11'];

		
		$count=count($constrct['flights']['source']);
		for($i=0;$i<$count;$i++)
		{
			
			$fly['Flights']['Flight'][]=array("Carrier"=>$constrct['flights']['carrier'][$i],"Carrier_attr"=>array("id"=>$constrct['flights']['car_id'][$i]),"FlightNumber"=>$constrct['flights']['fno'][$i],"Source"=>$constrct['flights']['source'][$i],"Destination"=>$constrct['flights']['dest'][$i],"ArrivalTimeStamp"=>$constrct['flights']['arr'][$i],"DepartureTimeStamp"=>$constrct['flights']['destym'][$i],"Class"=>$constrct['flights']['class'][$i],"FareBasis"=>$constrct['flights']['fare'][$i]);

		}
		
		$fly['Pricing']=array("SingleAdultBaseFare"=>$constrct['flights']['SingleAdultBaseFare'],"SingleAdultSurcharge"=>$constrct['flights']['SingleAdultSurcharge'],"SingleAdultTotalTaxes"=>$constrct['flights']['SingleAdultTotalTaxes'],"SingleAdultAgentSurcharge"=>$constrct['flights']['SingleAdultAgentSurcharge'],"SingleAdultTotalAmount"=>$constrct['flights']['SingleAdultTotalAmount'],
"SingleAdultCreditCardCharges"=>$constrct['flights']['SingleAdultCreditCardCharges'],"SingleAdultCommission"=>$constrct['flights']['SingleAdultCommission'],"SingleAdultServiceTax"=>$constrct['flights']['SingleAdultServiceTax'],'SingleChildTotalAmount'=>$constrct['flights']['SingleChildTotalAmount'],'SingleInfantTotalAmount'=>$constrct['flights']['SingleInfantTotalAmount']);
		
		
		$airdetails=str_replace('"','quot',serialize($fly));
		$_POST['re_airdetails']=str_replace('"','quot',serialize($fly));
		//print_r$_POST['post']); exit;
		$checkariprice=Viaflight::airprice_details($airdetails,'',$_POST['post'],$start,$dest);
                 
		
		if(isset($checkariprice['AirPriceResponse']['PricedItinerary']) && !empty($checkariprice['AirPriceResponse']['PricedItinerary'])){
//print_r($checkariprice['AirPriceResponse']['PricedItinerary']);exit;
		$airfare=$checkariprice['AirPriceResponse']['PricedItinerary'];
		$airpricing=round($airfare['Pricing']['TotalAmount']);

		$_POST['amount']=$airpricing;
		}
		//$validate=validate_price($checkariprice,$_POST['amount'],$airdetails);
		$_POST['airdetails']=$airdetails;
		$flit=$_POST;
                $data=$flit;
		//$data['checkairprice']=str_replace('"','quot',serialize($c_price));	
		
		
		$json_flit=json_encode($data);
		$ctrack['postvalues']=$json_flit;
		$c_price=$checkariprice;
              }
$data['bread_crumb']=array('Home'=>'/');
  //echo '<pre>'; print_r($data); exit;
	  $this->load_reward_region('auth','data',''); 
       		return $this->render_reward_theme('flightraja.flight_checout',$data); 
	
	
	}
        public function get_flights()
	{

			
         	$param=explode('|',base64_decode($_POST['req']));
		
		
		

		$action='AirFareSearchRequest';
		//$authkey = '&source=REWARDS360&auth=36REWARDS0';
		$authkey = '&source=REWARDS360&auth=29360RE0WARDS';
		$xmlRequest="<AirFareSearchRequest>
			<Route>
			<Source>".$param[0]."</Source>
			<Destination>".$param[1]."</Destination>
			<DateOfDeparture>".$param[2]."</DateOfDeparture>";
			if($param[7]=='R'){
		$xmlRequest.="<DateOfArrival>".$param[8]."</DateOfArrival>	
		<DiscountedReturnFareSearch>".$param[9]."</DiscountedReturnFareSearch>";		
		}		
		$xmlRequest.="</Route>
			<PassengerCount>
			<Adults>".(int)$param[3]."</Adults>
			<Children>".(int)$param[4]."</Children>
			<Infants>".(int)$param[5]."</Infants>
			</PassengerCount>
			<CabinPreference>
			<SeatingClass>".$param[6]."</SeatingClass>
			</CabinPreference>
			</AirFareSearchRequest>";
//<CarrierPreference><Carrier id='G8'></Carrier></CarrierPreference>
		

			
          $url = 'http://api.viaworld.in/webserviceAPI?actionId='.$action.'&xmlRequest='.urlencode($xmlRequest).'&'.$authkey;
	
        
// create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 60); //timeout in seconds
        // $output contains the output string 
   	$output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch);     
    //db connected in case of api issue    
	/*$this->db->where('id',1);
	$output=$this->db->get('via_xml')->row_array();*/
        
	// $xml =simplexml_load_string($output);
	 echo str_replace('Source','pick_point',$output);
	}

       public function round_flights()
	{

		$param=explode('|',base64_decode($_POST['req']));

		

		$action='AirFareSearchRequest';
		//$authkey = '&source=REWARDS360&auth=36REWARDS0';
		$authkey = '&source=REWARDS360&auth=29360RE0WARDS';
		$xmlRequest="<AirFareSearchRequest>
			<Route>
			<Source>".$param[0]."</Source>
			<Destination>".$param[1]."</Destination>
			<DateOfDeparture>".$param[2]."</DateOfDeparture>";
			if($param[7]=='R'){
		$xmlRequest.="<DateOfArrival>".$param[8]."</DateOfArrival>	
		<DiscountedReturnFareSearch>".$param[9]."</DiscountedReturnFareSearch>";		
		}		
		$xmlRequest.="</Route>
			<PassengerCount>
			<Adults>".(int)$param[3]."</Adults>
			<Children>".(int)$param[4]."</Children>
			<Infants>".(int)$param[5]."</Infants>
			</PassengerCount>
			<CabinPreference>
			<SeatingClass>".$param[6]."</SeatingClass>
			</CabinPreference>
			
			</AirFareSearchRequest>";
//<CarrierPreference><Carrier id='BA'></Carrier></CarrierPreference>
		//echo htmlspecialchars($xmlRequest);
		//exit;

			
          $url = 'http://api.viaworld.in/webserviceAPI?actionId='.$action.'&xmlRequest='.urlencode($xmlRequest).'&'.$authkey;
	// print_r($url);
//exit;

// create curl resource 
       $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        //curl_close($ch);    
	/*$this->db->where('id',2);
	$output=$this->db->get('via_xml')->row_array();*/
	
        echo str_replace('Source','pick_point',$output);
	
		



	} 
public function flight_payment()
	{
		//echo '<pre>';print_r($_POST); exit;
		$payment_data['ref_number']='11222333111';
			$payment_data['recharge_amount']=$_POST['amount'];
			$payment_data['email']=$_POST['s_email'];
			return Redirect::to('payment_gateway')->with('data',$payment_data); 
	}
        
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

