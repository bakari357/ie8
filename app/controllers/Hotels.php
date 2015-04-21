<?php
use Carbon\Carbon;
class Hotels extends BaseController {
 
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
	
	
	public function home(){
           $data['type']=0;
			 $data['bread_crumb']=array('Home'=>'/');

 		 $this->load_reward_region('common','left',$data); 
       		$data['banners'] = Banner::get_todays_banner(2);
		
		$this->load_reward_region('hungama','home',1);
       		return $this->render_reward_theme('hotels.home',$data);

	}

	public function static_hotel(){
           $data['type']=0;
			 $data['bread_crumb']=array('Home'=>'/');
       		return $this->render_reward_theme('hotels.hotel_checkout',$data);

	}





	public function home_old(){
	       
		$menus=array('one','two');    		
		$bread_crumb=array('Home'=>'/');
		$data['page'] ='testest';
      		$bread_crumb=array('Home'=>'/');
      		$css_array = array('css/jquery-ui.css','css/style1.css','css/stream.css','css/tabcontent.css','css/jquery-ui-1.10.3.custom.css');
      		//$js_array = array('js/jquery.min.js');
      		$js_array = array('js/jquery.select_skin.js','js/html5.js','js/chck_box.js','js/ddaccordion.js','js/jquery-ui-1.10.3.custom.js','js/jquery.lazyload.js');
	        $this->load_reward_theme('HDFC Superia-Credit Card','hotels.home','auth',$bread_crumb,'','',$css_array,$js_array); 
        	$this->load_reward_region('auth','data',''); 
       		return $this->render_reward_theme('hotels.home','auth',$data); 

	}
	
	//Listing the hotels
	public function Hotel_listing()
	{  
	    if(Input::get()){   

     
	        $rules =array('cityname' => 'required|min:2|max:70','check_in' => 'required|max:10','check_out' => 'required|max:10','num_rooms' => 'required|numeric','city_id' => 'required|numeric');
        $validation = Validator::make(Input::all(), $rules);
	if($validation->fails()) {  
	return Redirect::back()->withInput()->withErrors($validation->messages());
	}
		if((isset($_POST) && !empty($_POST))){
			$data=$_POST;
			$data['post']=$_POST;
			}
			else{
			$data=$posted;
			$data['post']=$posted;
			}
			if(isset($data['check_in']) && $data['check_in']<>'')
			$deptime=date('m/d/Y',strtotime(str_replace('/','-',$data['check_in'])));
			if($deptime=='01/01/1970'){
				$deptime=date('m/d/Y',strtotime($_POST['check_in']));
			}
 
			if(isset($data['check_out']) && $data['check_out']<>''){

			$return=date('m/d/Y',strtotime(str_replace('/','-',$_POST['check_out'])));
			if($return=='01/01/1970'){
				$return=date('m/d/Y',strtotime($_POST['check_out']));
			}
			//$reqtype=$data['type'];
			}
			//else
			//{
			//$reqtype="";
			//$tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y"));
			//$return=date('Y-m-d',$tomorrow);

			//}

			
		         
			$req=$data['cityname'].'|'.$data['search_name'].'|'.$deptime.'|'.$return.'|'.$data['num_rooms'].'|';
			for($i=1;$i<=$_POST['num_rooms'];$i++) {
			
			$req .=$data['numberOfAdults'.$i].'|'.$data['numberOfChildren'.$i].'|';
			
			for($j=1;$j<=$_POST['numberOfChildren'.$i];$j++)
			{
			
			if(!empty($_POST['room'.$i.'Child'.$j]))
			$req .=$data['room'.$i.'Child'.$j].'|';
			}			
			
			}
                
	
		$data['req']=base64_encode($req);
		$redis_menu =$data['req'];
		$menus=array('one','two');
		$bread_crumb=array('Home'=>'/');
		$data['page'] ='testest';
		$data['bread_crumb']=array('Home'=>'/');		
		
		 
		$this->load_reward_region('common','hotels',$redis_menu); 
		return $this->render_reward_theme_hotels('hotels.list_static',$data); 
		 
		}
		    
	  }
	  
	  public function show_hotel()
	  { 

	     Rewards::globalXssClean();


	     $param =explode('|',base64_decode($_POST['req']));

	     $d=4;
	     $xmlurl='<HotelListRequest>
			<arrivalDate>'.$param[2].'</arrivalDate>
			<departureDate>'.$param[3].'</departureDate>
			<RoomGroup>';
			for($i=1;$i<=$param[4];$i++) {
			$ages='';$c='';
			$a=$d+1;
			$b=$a+1;
			$xmlurl .='<Room>
			<numberOfAdults>'.$param[$a].'</numberOfAdults>
			<numberOfChildren>'.$param[$b].'</numberOfChildren>';
			for($j=1;$j<=$param[$b];$j++)
			{ $c=$b+$j;
			if(!empty($param[$c]) && $param[$b]<>0)
			$ages[]=$param[$c];
			}
			if(!empty($ages))
			$xmlurl .='<childAges>'.implode(",",$ages).'</childAges>';
			 $xmlurl .='</Room>';
			if(!empty($c)) $d=$c;else $d=$b; }
			 $xmlurl .='</RoomGroup>';
			 if($param[1]<>''){
			 $xmlurl .='<propertyName>'.$param[1].'</propertyName>';
			 }
			$xmlurl .='<numberOfResults>200</numberOfResults>
			<city>'.$param[0].'</city>
			<countryCode>IN</countryCode>
			<sort>QUALITY</sort>
			</HotelListRequest>';			
	$url='http://api.eancdn.com/ean-services/rs/hotel/v3/list?cid=467181&minorRev=26&apiKey=cbrzfta369qwyrm9t5b8y8kf&locale=en_US&currencyCode=INR&customerIpAddress='.$_SERVER['REMOTE_ADDR'].'&customerUserAgent=Mozilla/5.0+%28X11;+Linux+i686;+rv:17.0%29+Gecko/17.0+Firefox/17.0&customerSessionId=&_type=xml&xml='.urlencode($xmlurl);
			//print_r($url);exit;
			//here calling curl library 
			 $curl = New Curl;
			 $hotel= $curl->simple_get($url);
			Log::info('smartbuy|Expedia_search_request|'.$_SERVER['REMOTE_ADDR'].'|'.$url);
			Log::info('smartbuy|Expedia_search_response|'.$_SERVER['REMOTE_ADDR'].'|'.$hotel);
		    	 $otels= Xml2array::xml2array_test($hotel);
		    	//print_r($otels);exit;
			 if(isset($otels['ns2:HotelListResponse']['EanWsError']))
			 { 
				$hotel ='';$count1=0;$ages='';
				$a=4+$i+$count1;
				$b=5+$i+$count1;
				if(isset($otels['ns2:HotelListResponse']['LocationInfos']['LocationInfo'][1]['city']))
				{    
				$dest_str=$otels['ns2:HotelListResponse']['LocationInfos']['LocationInfo'][1]['city'];

				$xmlurl='<HotelListRequest>
				<countryCode>'.$otels['ns2:HotelListResponse']['LocationInfos']['LocationInfo'][1]['countryCode'].'</countryCode>
				<city>'.$dest_str.'</city> 
				<arrivalDate>'.$param[2].'</arrivalDate>
				<departureDate>'.$param[3].'</departureDate>
				<RoomGroup>';
				$d=4; for($i=1;$i<=$param[4];$i++) {
				$ages='';$c='';
				$a=$d+1;
				$b=$a+1;
				$xmlurl .='<Room>
				<numberOfAdults>'.$param[$a].'</numberOfAdults>
				<numberOfChildren>'.$param[$b].'</numberOfChildren>';
				for($j=1;$j<=$param[$b];$j++)
				{ $c=$b+$j;
				if(!empty($param[$c]) && $param[$b]<>0)
				$ages[]=$param[$c];
				}
				if(!empty($ages))
				$xmlurl .='<childAges>'.implode(",",$ages).'</childAges>';
				$xmlurl .='</Room>';
				if(!empty($c)) $d=$c;else $d=$b; }
				$xmlurl .='</RoomGroup>';
				if($param[1]<>''){
				$xmlurl .='<propertyName>'.$param[1].'</propertyName>';
				}
				$xmlurl .='<numberOfResults>200</numberOfResults>
				</HotelListRequest>';


				$url='http://api.eancdn.com/ean-services/rs/hotel/v3/list?cid=467181&minorRev=26&apiKey=cbrzfta369qwyrm9t5b8y8kf&locale=en_US&currencyCode=INR&customerIpAddress='.$_SERVER['REMOTE_ADDR'].'&customerUserAgent=Mozilla/5.0+%28X11;+Linux+i686;+rv:17.0%29+Gecko/17.0+Firefox/17.0&customerSessionId=&_type=xml&xml='.urlencode($xmlurl);

				

				$hotel= $curl->simple_get($url);
		 
		
		 } 
		}
		//Redis Writing and Reading based on the city id
		$city_id = $param[5];
		$redis_city_check=RedisCustom::Redis_reader('hotel_list',$city_id);
		if(empty($redis_city_check) && (!empty($hotel))){	
		RedisCustom::Redis_writer('hotel_list',$city_id, $hotel);
		}
		$hotel_list=RedisCustom::Redis_reader('hotel_list',$city_id); 
		print_r($hotel);
	  }
	
	//displaying hotel details  
	public function hotel_details()
	{ 
			$data['getdetails']=(array)json_decode(urldecode($_POST['postvalue'])); 
			$value=array_merge($data['getdetails'],$_POST);
			
			$hotel_detail=Hotel::Hotel_Details($value);

			//echo '<pre>';print_r($hotel_detail); exit;
			$data['rateKey']=$_POST['rateKey'];
			$hotel_details = Viaflight::toArray($hotel_detail);
			$data['hotel_details']=$hotel_details;
			$menus=array('one','two');
			$bread_crumb=array('Home'=>'/');
			$data['postedvalue'] =$_POST['postvalue'];
			$data['data'] = $_POST;
			if(isset($_POST['search_name']) && $_POST['search_name'])
			$snam='_'.trim($_POST['search_name']);
			else
			$snam='';
			if(!empty($_POST['num_rooms']))
			$ag=$_POST['num_rooms'];
			else
			$ag='';
			if(!empty($_POST['numberOfAdults']))
			$ad=$_POST['numberOfAdults'];
			else
			$ad='';

			if(!empty($_POST['numberOfChildren']))
			$ch=implode("_",$_POST['numberOfChildren']);
			else
			$ch='';

			$enco= base64_encode($_POST['check_in'].'_'.$_POST['check_in'].'_'.$_POST['num_rooms'].'_'.$ag.'_'.$ad.'_'.$snam.'_'.$ch.'_'.$_POST['hotelid']);
			$data['enco'] = $enco;
			$data['bread_crumb']=array('Home'=>'/');		


			$this->load_reward_region('auth','hotels_details',$hotel_details); 
			return $this->render_reward_theme_hotels_details('hotels.hotels_details',$data);
                  
       }
	  
       public function Hotel_Booking()
       {     $book_hotel=array();


$postvale=(array)json_decode(urldecode($_POST['postvalue']));
//echo '<pre>';print_r($postvale);print_r($_POST); exit;
				$book_hotel['check_in']=$postvale['check_in'];
				$book_hotel['check_out']=$postvale['check_out'];
				$book_hotel['hotelid'] =$_POST['hotelid'];
				$book_hotel['supplierType'] ='E';
				$book_hotel['rateKey'] =$_POST['rateKey'];
				$book_hotel['roomTypeCode'] =$_POST['roomTypeCode'];
				$book_hotel['rateCode'] =$_POST['rateCode'];
				$book_hotel['chargeableRate'] =$_POST['average_rate'];
				$book_hotel['numberOfAdults'] =$postvale['numberOfAdults1'];
				$book_hotel['numberOfChildren'] =$postvale['numberOfChildren1'];
				$book_hotel['firstName'] ='pankaj';
				$book_hotel['lastName'] ='sharma';
				$book_hotel['bedTypeId'] ='14';
				$book_hotel['smokingPreference'] ='S';
				$book_hotel['num_rooms']=$postvale['num_rooms'];
				$book_hotel['email'] ='bharath.c@mahiti.org';
				$book_hotels=Hotel::Hotel_Checkout($book_hotel);
$mail['user'] = 'bharath.c@mahiti.org';
$mail['post']=$_POST;
$mail['rm_details']=(array)json_decode($book_hotels['success']);
echo '<pre>';print_r($mail);print_r($_POST); 
	          $view = 'cpanel::email.hotels_mail';$message="nijknkj";
	 $code = $mail;
	 Mail::queue($view, compact('code'), function($message) use ($mail)
	 {
	  $message->to($mail['user'])->subject('hotels booked ');
	 });
	       }
	  
	  public function Hotel_Checkout()
	       { 
			
				
				$data = Rewards::redirect_helper('Hotels@Hotel_Checkout'); //Redirect Url after login
				
				$data['getdetails']=(array)json_decode(urldecode($data['postvalue'])); 
				$data['post']=$data;
				$value=array_merge($data['getdetails'],$data['post']);
				$value['thumbnail']='';
				//echo '<pre>';print_r($value); exit;
				$hotel_detail=Hotel::Hotel_Details($value);
				$hotel_details = Viaflight::toArray($hotel_detail);
 //echo '<pre>';print_r($hotel_details); exit;
				if(array_key_exists(0,$hotel_details['rem_det']['HotelRoomResponse'])){
				foreach($hotel_details['rem_det']['HotelRoomResponse'] as $rm_dt) { 

				if($value['rm_cd']==$rm_dt['roomTypeCode'])
				$data['room_info'][]=$rm_dt;
                               
				}
				}else{

				$data['room_info'][]=$rm_dt;
				}
				if(isset($data['room_info']['0']['RateInfos']['RateInfo']['cancellationPolicy']))
		{
		$data['cancellationPolicy']=$data['room_info']['0']['RateInfos']['RateInfo']['cancellationPolicy'];
		}
		else{
		$data['cancellationPolicy']='';
		}
			$check_in=date('m/d/Y',strtotime(str_replace('/','-',$data['getdetails']['check_in'])));
	$check_out=date('m/d/Y',strtotime(str_replace('/','-',$data['getdetails']['check_out'])));
		$data['getdetails']['check_in']=date('m/d/Y',strtotime(str_replace('-','/',$check_in)));
		$data['getdetails']['check_out']=date('m/d/Y',strtotime(str_replace('-','/',$check_out)));
   
				$data['bread_crumb']=array('Home'=>'/'); 

				return $this->render_reward_theme('hotels.hotel_checkout',$data);
	       }
	  public function Hotel_Checkout_final()
	       { 
			$rules =array('first_name' => 'required|max:30','last_name' => 'required|max:30','s_email' => 'required|max:70|email','mobile' => 'required|max:10');
        $validation = Validator::make(Input::all(), $rules);
	if($validation->fails()) {  
	return Redirect::back()->withInput()->withErrors($validation->messages());
	}
$counts=(array)json_decode(urldecode($_POST['postvalue']));
$count=$counts['num_rooms'];
         for($i=1;$i<=$count;$i++){

	$rules =array('firstName'.$i.'' => 'required|max:30','lastName'.$i.'' => 'required|max:30');
        $validation = Validator::make(Input::all(), $rules);
	if($validation->fails()) {  
	return Redirect::back()->withInput()->withErrors($validation->messages());
	}
}
				
				$data = Rewards::redirect_helper('Hotels@Hotel_Checkout_final'); //Redirect Url after login
				
				$data['getdetails']=(array)json_decode(urldecode($data['postvalue'])); 
				$data['post']=$data;
				$value=array_merge($data['getdetails'],$data['post']);
				$value['thumbnail']='';
				//echo '<pre>';print_r($value); exit;
				$hotel_detail=Hotel::Hotel_Details($value);
				$hotel_details = Viaflight::toArray($hotel_detail);
//echo '<pre>';print_r($hotel_details); exit;
				if(array_key_exists(0,$hotel_details['rem_det']['HotelRoomResponse'])){
				foreach($hotel_details['rem_det']['HotelRoomResponse'] as $rm_dt) { 

				if($value['roomTypeCode']==$rm_dt['roomTypeCode'])
				$data['room_info'][]=$rm_dt;

				}
				}else{

				$data['room_info'][]=$rm_dt;
				}
				if(isset($data['room_info']['0']['RateInfos']['RateInfo']['cancellationPolicy']))
		{
		$data['cancellationPolicy']=$data['room_info']['0']['RateInfos']['RateInfo']['cancellationPolicy'];
		}
		else{
		$data['cancellationPolicy']='';
		}
		$check_in=date('m/d/Y',strtotime(str_replace('/','-',$data['getdetails']['check_in'])));
	$check_out=date('m/d/Y',strtotime(str_replace('/','-',$data['getdetails']['check_out'])));
		$data['getdetails']['check_in']=date('m/d/Y',strtotime(str_replace('-','/',$check_in)));
		$data['getdetails']['check_out']=date('m/d/Y',strtotime(str_replace('-','/',$check_out)));
				$data['bread_crumb']=array('Home'=>'/'); 
				$data['values']=$value;
				 $data['emi_data']=Checkouthelper::emi_logic($data['post']['amount']);
	    $data['interest']=Checkouthelper::interest();
				return $this->render_reward_theme('hotels.hotel_checkout_final',$data);
	       }
	  
	      
	 // starting ajax function from view     
	 public function loadadult($rooms_count)
	  {
	
		$out='';
		for($i=1;$i<=$rooms_count;$i++)
		{ 
		 
		        $out .='<div class="row"><span class="room col-xs-12 col-md-2 col-lg-2"><b style="display:block; padding-top:24px">  Room '.$i.'</b></span><div class="nopad pbottom15 col-xs-12 col-md-10 col-lg-10"><div class="col-xs-12 col-md-6 col-lg-6"> <div>';
			       
			   $out .=' <span class="opensans size13"><b>Adults</b></span>';
			   $out .='<select class="form-control" name="numberOfAdults'.$i.'">';		  
		        $out .=$this->load_select_option(1,4,1);
		        $out .='</select></div></div>';
		
							
	  $out .='<div class="col-xs-12 col-md-6 col-lg-6">
		<div>
		<span class="opensans size13"><b>Child </b></span>';
			 $out .='<select class="form-control" name="numberOfChildren'.$i.'" id="numberOfChildren'.$i.'" onchange="loadage('.$i.');" >';		  
		        $out .=$this->load_select_option(0,3,0);
		        $out .='</select></div>	</div></div>
';   $out .='<br><br><div id="childage'.$i.'" class="pbottom15 nopad col-xs-12 col-md-5 col-lg-5 pull-right"></div></div></div>'; 
		

	
		  }     
                     
		
		echo $out;
	}
	
	
	
	
	       
	public static function load_select_option($start,$end,$select)
        {
       
                $out='';
                for($i=$start;$i<=$end;$i++)
                {
                 
                if($select==$i)
                $selected='selected';
                else
                $selected='';
                $out .='<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                }
         return $out;
        } 
        
        
         public function loadage()
	  {
	          $id = $_POST['id'];
                 $count = $_POST['count'];
                 $value = $count;
                 $out ='';
		$out .='<div>';
		   $s=1;
               //                 
                               
		for($i=1;$i<=$count;$i++)
		{     
		    
		 $out .='<div class="col-xs-12 col-md-4 col-lg-4"> <div>';
			       
			$out .=' <span style="font-size:12px;"> <b>Child  '.$i.' age </b> </span>';
			$out .='<select id="room'.$id.'Child'.$i.'" name="room'.$id.'Child'.$i.'" class="form-control" >';		  
		        $out .=$this->load_select_option(1,17,1);
		        $out .='</select></div></div>';   
		        $out .=''; 
		      
 
	
		  }     
               $out .='</div> <br><br>';        
		
		echo $out;
	}
	
	
	
        
            
	
	/*public function loadage()
        {     
        
               $id = $_POST['id'];
               $count = $_POST['count'];
               $value = $count;
                

                $out='<table align="right"><tr>';
                $s=1;
                for($i=1;$i<=$count;$i++)
                {
                if($s==3)
{
$s=1;
$out.='</tr></table><table align="right"><tr>';
}
		 
                $out .='<td><span style="font-size:12px;"> <b>Child  '.$i.' age </b> </span>';
		        
                $out .='<select style="width:60px;" id="room'.$id.'Child'.$i.'" name="room'.$id.'Child'.$i.'" class="form-control" >';
                $out .=$this->load_select_option(1,17,1);
                $out .='</select></td> &nbsp;&nbsp;&nbsp;';
                $s++; 
                }
                 $out .='</tr></table>';
                
                return $out;
        }*/
        
	public function loadchild($count)
	{
		$out='';
		for($i=1;$i<=$count;$i++)
		{
		       
		}
		echo $out;
	}
	
	public function num_row_child($count)
	{
		$out='';
		for($i=1;$i<=$count;$i++)
		{
		        
		}
		echo $out; 
	}
	
	//ending ajax function from view
	public function Hotel_payment()
	{ 
		
		        $payment_data['ref_number']='11222333111';
			$payment_data['recharge_amount']=$_POST['amount'];
			$payment_data['email']=$_POST['s_email'];
			return Redirect::to('payment_gateway')->with('data',$payment_data); 
	}
	
	
	
	  public function loadadults($rooms_count)
	  {   
	    /* $child_div='';
	      for($j=2;$j<=$rooms_count;$j++) {
	      $child_div .='<div id="childage'.$j.'"></div>'; 
	      }*/
	    //<div><span class="opensans size13"><b> Room '.$i.'</b></span></div>
	     // style="display: inline-block;margin-left: -10px;margin: -130px;margin-top: 26px;"
	      $s=1;$out ='';
	      for($i=1;$i<=$rooms_count;$i++) {

	$out .='<span class="col-xs-12 col-md-3 col-lg-3 nopad"><b style="display:block; padding-top:24px"> Room '.$i.'</b></span> ';
		
		 $out .='<div class="col-lg-9 col-md-9 col-xs-12 nopad pbottom15">	
										<div class="col-xs-12 col-lg-6 col-md-6 npright">';
			       
			   $out .=' <span class="opensans size13"><b>Adults</b></span> <br>';
			   $out .='<select class="form-control" name="numberOfAdults'.$i.'">';		  
		        $out .=$this->load_select_option(1,4,1);
		        $out .='</select></div>';
		
							
	  $out .='<div class="col-xs-12 col-lg-6 col-md-6 npright">
		<span class="opensans size13"><b>&nbsp;&nbsp;Child </b></span> <br>';
			 $out .='<select class="form-control" name="numberOfChildren'.$i.'" id="numberOfChildren'.$i.'" onchange="loadage('.$i.');" >';		  
		        $out .=$this->load_select_option(0,3,0);
		        $out .='</select></div>
';   $out .='</div><div id="childage'.$i.'" class="pbottom15 nopad col-xs-12 col-md-12 col-lg-12 pull-right" ></div>'; 
											
		$s++;
                 }               
                               
		
		 $out .= '';
		//echo $child_div;
		
		echo $out;
	}
	
	
	public function loadages()
        {     
        
               $id = $_POST['id'];
                 $count = $_POST['count'];
                 $value = $count;
                 $out ='';
		   $s=1;
               //                 
                               
		for($i=1;$i<=$count;$i++)
			{     
		   
			$out .='<div class="col-xs-12 col-md-4 col-lg-4 npright">
		<span style="font-size:11px;">Child '.$i.'</span><br>';
			$out .='<select style="font-size: 12px;" id="room'.$id.'Child'.$i.'" name="room'.$id.'Child'.$i.'" class="form-control" >';
			 		  
		        $out .=$this->load_select_option(1,17,1);
			$out .='<option value="1" selected="" selected>Age</option>';	
		        $out .='</select></div>';
			
		  } 
          
		
		echo $out;
        }
	
		
	public function hotels_search()
	{     


        //  echo '<pre>'; print_r($_POST); exit;
		$param =explode('|',base64_decode($_POST['req']));
                 $hname =explode(' ',$_POST['hotel_name']);
//send the name to search in mongodb
		    if(empty($_POST['hotel_postalCode']) && $_POST['hotel_countryCode']=='IN'){
			$pos=in_array($_POST['hotel_city'], $hname);
				$val=2.5;
				if(!$pos){
				$hname=$_POST['hotel_name'].' '.$_POST['hotel_city'];
				}else{
				$hname=$_POST['hotel_name'];
				}
			}elseif($_POST['hotel_countryCode']=='IN'){
				$val=1.5;
				$hname=$_POST['hotel_name'].' '.$_POST['hotel_postalCode'];
			}


if(empty($_POST['hotel_postalCode']) && $_POST['hotel_countryCode']!='IN' && $_POST['hotel_postalCode']==0){
				$pos=in_array($_POST['hotel_city'], $hname);
				$val=2.5;
				if(!$pos){
                  $hname=$_POST['hotel_name'].' '.$_POST['hotel_city'].' '.$_POST['hotel_countryCode'];
					}else{
					$hname=$_POST['hotel_name'].' '.$_POST['hotel_countryCode'];
					}
			}elseif($_POST['hotel_countryCode']!='IN'){
			$val=2.5;
			$hname=$_POST['hotel_name'].' '.$_POST['hotel_city'].' '.$_POST['hotel_postalCode'].' '.$_POST['hotel_countryCode'];
			}
			if($_POST['hotel_countryCode']=='IN'){
			$tablename='clr_hotels';
			}else{
			$tablename='clr_hotels_int';
			}
		$name=str_replace('&apos;s','',str_replace('-',' ',$hname));
		 //print_r($name); print_r($val);
		$connection = DB::connection('mongodb');
             $citydetalis=$connection->getCollection($tablename)->find(array('$text'=>array('$search'=>$name)),array('score'=>array('$meta'=>"textScore")))->sort(array('score'=>array('$meta'=>"textScore")))->limit(1);

		foreach($citydetalis as $hoitelid)
		{
 
			if($hoitelid['score']>=$val){
				if(isset($hoitelid['hotel_Id'])){
				$clrid=$hoitelid['hotel_Id'];
				}else{
				$clrid=$hoitelid['hotelid'];
				}
				$city=$hoitelid['city'];
				if(isset($hoitelid['code'])){
				$country=$hoitelid['code'];
				}else{
				$country=$hoitelid['country_code'];
				}
				}else{
				exit;
				}
		}

		if(!empty($clrid)){
		$check_in=date('Y-m-d',strtotime($param[2]));  
		$check_out=date('Y-m-d',strtotime($param[3])); 

		$url='http://api.staging.cleartrip.com/hotels/1.0/search?check-in='.$check_in.'&check-out='.$check_out.'&no-of-rooms='.$param[4].'&adults-per-room='.$param[5].'';
		//loading adults
		$a=5;
		for($i=1;$i<$param[4];$i++) {
		$b=$a+1;
		$c=$param[$b];
		if($c!=0){
		$d=$b+$param[$b]+1;
		}else
		{
		$d=$b+1;
		}
		$url.=','.$param[$d].'';
		$a=$d;
		}
		//loading children
		$a=6;
		$x=1;
		$url.='&children-per-room='.$param[6].'';
		for($i=1;$i<$param[4];$i++) {
		$b=$a;
		if(isset($param[$b])){
		$c=$param[$b];
		if($x==1)
		$d=$b+$param[$b]+2;
		else
		$d=$a;
		if(isset($param[$d])){
		$url.=','.$param[$d].'';
		$a=$d+$param[$d]+2;
		$x++;
		}
		}
		}

		//loaging chield age
		$a=6;
		for($i=1;$i<=$param[4];$i++) {
		if(isset($param[$a])){
		$c=$param[$a];
		for($j=1;$j<=$param[$a];$j++) {
		     $b=$a+$j;
		 if(isset($param[$b])){
		       $url .='&ca'.$i.'='.$param[$b].'';
			} }

		$a=$a+$c+2;

		}
		}

		$url.='&city='.$city.'&country='.$country.'&hotel-id='.$clrid.'';
		//print_r($url);exit;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
		curl_setopt($ch, CURLOPT_TIMEOUT, 90); //timeout in seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		Log::info('smartbuy|Cleartrip_hotels_search_request|'.$_SERVER['REMOTE_ADDR'].'|'.$url);
		Log::info('smartbuy|Cleartrip_hotels_search_response|'.$_SERVER['REMOTE_ADDR'].'|'.$result);
		if(strlen($result)>=700){
			print_r($result);
		}else{
		print_r(strlen($result));
		}
		
		 }else{

		exit;
		}

	}

		public function hotel_cleartrp()
        {     
  
		$clear_trp=json_decode($_POST['clear_select']);
		$param =explode('|',base64_decode($_POST['req']));
             
$check_in=date('Y-m-d',strtotime($param[2]));  
$check_out=date('Y-m-d',strtotime($param[3])); 
     
		$url='http://api.staging.cleartrip.com/hotels/1.0/search?check-in='.$check_in.'&check-out='.$check_out.'&no-of-rooms='.$param[4].'&adults-per-room='.$param[5].'';
//loading adults
		$a=5;
		for($i=1;$i<$param[4];$i++) {
		$b=$a+1;
		$c=$param[$b];
		if($c!=0){
		$d=$b+$param[$b]+1;
		}else
		{
		$d=$b+1;
		}
		$url.=','.$param[$d].'';
		$a=$d;
		}
//loading children
		$a=6;
		$x=1;
		$url.='&children-per-room='.$param[6].'';
		for($i=1;$i<$param[4];$i++) {
		$b=$a;
		if(isset($param[$b])){
		$c=$param[$b];
		if($x==1)
		$d=$b+$param[$b]+2;
		else
		$d=$a;
		if(isset($param[$d])){
		$url.=','.$param[$d].'';
		$a=$d+$param[$d]+2;
		$x++;
		}
		}
		}

//loaging chield age
		$a=6;
		for($i=1;$i<=$param[4];$i++) {
		if(isset($param[$a])){
		$c=$param[$a];
				for($j=1;$j<=$param[$a];$j++) {
				     $b=$a+$j;
				 if(isset($param[$b])){
				       $url .='&ca'.$i.'='.$param[$b].'';
					} }

		$a=$a+$c+2;

		}
		}

$url.='&city='.$clear_trp[0]->city.'&country='.$clear_trp[0]->country_code.'&hotel-id='.$clear_trp[0]->id.'';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$url1='http://www.cleartrip.com/places/hotels/info/'.$clear_trp[0]->id.'';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url1); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result1 = curl_exec($ch);
 
		$data['room_dect']=Xml2array::xml2array_test($result);
		$data['room_image']=Xml2array::xml2array_test($result1);
		$data['hotelid']=$clear_trp[0]->id;
		$data['city']=$clear_trp[0]->city;
		$data['country_code']=$clear_trp[0]->country_code;
		$data['req']=$_POST['req'];
		$data['postvalue']=$_POST['postvalue'];
		$data['bread_crumb']=array('Home'=>'/'); 
//echo '<pre>';print_r($data['room_dect']);; exit;
				return $this->render_reward_theme_hotels_details('hotels.hotels_clear_deatils',$data);
		
        }
		 public function Hotel_clrn_Checkout()
	       { 
				$data = Rewards::redirect_helper('Hotels@Hotel_clrn_Checkout'); //Redirect Url after login
                                 $param =explode('|',base64_decode($data['req']));
             
$check_in=date('Y-m-d',strtotime($param[2]));  
$check_out=date('Y-m-d',strtotime($param[3])); 
     
		$url='http://api.staging.cleartrip.com/hotels/1.0/search?check-in='.$check_in.'&check-out='.$check_out.'&no-of-rooms='.$param[4].'&adults-per-room='.$param[5].'';
//loading adults
		$a=5;
		for($i=1;$i<$param[4];$i++) {
		$b=$a+1;
		$c=$param[$b];
		if($c!=0){
		$d=$b+$param[$b]+1;
		}else
		{
		$d=$b+1;
		}
		$url.=','.$param[$d].'';
		$a=$d;
		}
//loading children
		$a=6;
		$x=1;
		$url.='&children-per-room='.$param[6].'';
		for($i=1;$i<$param[4];$i++) {
		$b=$a;
		if(isset($param[$b])){
		$c=$param[$b];
		if($x==1)
		$d=$b+$param[$b]+2;
		else
		$d=$a;
		if(isset($param[$d])){
		$url.=','.$param[$d].'';
		$a=$d+$param[$d]+2;
		$x++;
		}
		}
		}

//loaging chield age
		$a=6;
		for($i=1;$i<=$param[4];$i++) {
		if(isset($param[$a])){
		$c=$param[$a];
				for($j=1;$j<=$param[$a];$j++) {
				     $b=$a+$j;
				 if(isset($param[$b])){
				       $url .='&ca'.$i.'='.$param[$b].'';
					} }

		$a=$a+$c+2;

		}
		}

$url.='&city='.$data['city'].'&country='.$data['country_code'].'&hotel-id='.$data['hotelid'].'';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); 
				$data['hotel_dect']=Xml2array::xml2array_test($result);
				//$data['polic']=Hotel::clr_polic($data);
//echo '<pre>';print_r($data['polic']); exit;
				$data['postvalue']=$data['postvalue'];
				$data['bread_crumb']=array('Home'=>'/'); 
				$data['post']=$data;
				return $this->render_reward_theme('hotels.hotel_checkout_clr',$data);
	       }

		 public function Hotel_clrn_Checkout_final()
	       { 
//echo '<pre>'; print_r($_POST); exit;
$rules =array('first_name' => 'required|max:30','last_name' => 'required|max:30','s_email' => 'required|max:70|email','mobile' => 'required|min:10|numeric','firstname' => 'required|max:30','lastname' => 'required|max:30','address' => 'required|max:100','email' => 'required|max:70|email','cmobile' => 'required|min:10|numeric');
        $validation = Validator::make(Input::all(), $rules);
	if($validation->fails()) {  
	return Redirect::back()->withInput()->withErrors($validation->messages());
	}
				$data = Rewards::redirect_helper('Hotels@Hotel_clrn_Checkout_final'); //Redirect Url after login
                                 $param =explode('|',base64_decode($data['req']));
             
$check_in=date('Y-m-d',strtotime($param[2]));  
$check_out=date('Y-m-d',strtotime($param[3])); 
     
		$url='http://api.staging.cleartrip.com/hotels/1.0/search?check-in='.$check_in.'&check-out='.$check_out.'&no-of-rooms='.$param[4].'&adults-per-room='.$param[5].'';
//loading adults
		$a=5;
		for($i=1;$i<$param[4];$i++) {
		$b=$a+1;
		$c=$param[$b];
		if($c!=0){
		$d=$b+$param[$b]+1;
		}else
		{
		$d=$b+1;
		}
		$url.=','.$param[$d].'';
		$a=$d;
		}
//loading children
		$a=6;
		$x=1;
		$url.='&children-per-room='.$param[6].'';
		for($i=1;$i<$param[4];$i++) {
		$b=$a;
		if(isset($param[$b])){
		$c=$param[$b];
		if($x==1)
		$d=$b+$param[$b]+2;
		else
		$d=$a;
		if(isset($param[$d])){
		$url.=','.$param[$d].'';
		$a=$d+$param[$d]+2;
		$x++;
		}
		}
		}

//loaging chield age
		$a=6;
		for($i=1;$i<=$param[4];$i++) {
		if(isset($param[$a])){
		$c=$param[$a];
				for($j=1;$j<=$param[$a];$j++) {
				     $b=$a+$j;
				 if(isset($param[$b])){
				       $url .='&ca'.$i.'='.$param[$b].'';
					} }

		$a=$a+$c+2;

		}
		}

$url.='&city='.$data['city'].'&country='.$data['country'].'&hotel-id='.$data['hotel_id'].'';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); 
				$data['hotel_dect']=Xml2array::xml2array_test($result);
//echo '<pre>';print_r($data); exit;
				$data['postvalue']=$data['postvalue'];
				$data['bread_crumb']=array('Home'=>'/'); 
				$data['post']=$data;
				$data['emi_data']=Checkouthelper::emi_logic($data['post']['amount']);
	    $data['interest']=Checkouthelper::interest();
				return $this->render_reward_theme('hotels.hotel_checkout_clr_final',$data);
	       }
		public function Hotel_book_clr()
	{ 
		//echo '<pre>';print_r($_POST); 
		$data['check_in_date']=$_POST['check_in_date']; 
		$data['amount']=$_POST['amount']; 
		$data['check_out_date']=$_POST['check_out_date'];
		$data['number_rooms']=$_POST['number_rooms'];
		$data['room_code']=$_POST['room_code'];
		$data['booking_code']=$_POST['booking_code'];
		$data['hotel_id']=$_POST['hotel_id'];
		$data['adults']=1;
		$data['children']=0;
		$data['title']='Mr';
		$data['firstname']='bharath';	
              	$data['lastname']='sdfsdfsdf';

		$data['address']='Main Road';
		$data['city']=$_POST['city'];
		$data['country']='India';
		$data['postal']='560001';
		$data['mobile']='9591888077';
		$data['email']='bharath.c@mahiti.org';
		$book_hotels=Hotel::Hotel_clr_provisional($data);
print_r($book_hotels);
	}	


/// test
public function store_to_mongo(){

			$cityname['country_code']='AU';
			

			$citylist =DB::table('expedia_hotels')->Join('cleartrip_hotels', 'cleartrip_hotels.hotel_name', '=', 'expedia_hotels.Name')->select('cleartrip_hotels.hotel_Id as clearid','cleartrip_hotels.hotel_name','cleartrip_hotels.country_code','cleartrip_hotels.city','expedia_hotels.HotelID as expid')->where('expedia_hotels.Country',$cityname['country_code'])->get();
			$citylists=Xml2array::toArray($citylist);
echo '<pre>'; print_r($citylists);
			foreach($citylists as $store_expedia){
			DB::connection('mongodb')->collection('hotels_index')->insert($store_expedia);	

			

			}
	}

			public  function cancel_exp()
	{ 


					$book_hotels=Hotel::cancel_exp();
print_r($book_hotels);

	}
	
	}
