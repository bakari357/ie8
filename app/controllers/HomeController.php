<?php
class HomeController extends BaseController {

    public function getIndex()
    {      
       
        
         $data['new_arrivals']	=RedisCustom::Redis_reader('hung_top_5');
        $data['artist']=RedisCustom::Redis_reader('hung_artist');
        $connection = DB::connection('mongodb');
        $data['brands']=$connection->getCollection('Brands')->find();
        
	
	//$data['flipkart_offers_sellers'] = Commonmodel::getflipkartoffers($type=1);
	//$data['flipkart_offers_new'] = Commonmodel::getflipkartoffers($type=2);
	//$data['flipkart_deals'] = Commonmodel::getflipkartdeals();
	$data['cc_offers'] = Commonmodel::get_homepage_cdoffers($type=10);
	$data['dc_offers'] = Commonmodel::get_homepage_cdoffers($type=5);
	$data['net_offers'] = Commonmodel::get_homepage_cdoffers($type=3);
	$data['top_offers'] = Commonmodel::top_offers();
	$flipkart_banners = Commonmodel::getflipkartbanners();
	$data['flipkart_banners']= array_chunk($flipkart_banners, 3);
	$data['banners']= $flipkart_banners;
	//echo '<pre>'; print_r($data['cc_offers']); exit;
         //calling geohelper
         //$ip=$_SERVER['REMOTE_ADDR'];
        $get_geo_city = Geohelper::get_cityname();
           
         $data['offers'] = Commonmodel::get_offers($get_geo_city['city']); 
         $data['city']= $get_geo_city['city'];

	   if(empty($data['offers'])){

	        $states = 'Bangalore';
	        $states_response = Commonmodel::getstatesoffers_by_cities($states);
		if(empty($states_response)){
		   $data['offers'] = Commonmodel::getstatesoffers_by_cities_random($states);
		   $data['city'] ='India';

		}else{
		   $data['offers'] = Commonmodel::getstatesoffers_by_cities($states);
		   $data['city'] =$states;  
		}

	    }
	       $data['foodfiesta_city'] = Commonmodel::get_foodfiesta_city();
	       $data['offers_city'] = Commonmodel::get_offers_deals_city(); 
	       $data['areas'] = Commonmodel::get_offers_area(); 
	       $data['fiesta_areas'] = Commonmodel::get_fiesta_area();    
	       $data['categeory'] = Commonmodel::get_offers_deals_categeory();
	       $data['cusine'] = Commonmodel::get_offers_deals_cusine(); 
		$data['redis_falbums']=Cachehelper::fetch('hung_falbums');
		//$region = geoip_record_by_name('115.109.178.168');
		//$data['present_city'] = $region['city'];
		$data['css_array'] = array('assets/css/custom-style-new.css');
		$data['bread_crumb']=array('Home'=>'/');
		$data['banners'] = Banner::get_todays_banner(1);
		$data['offer_banner'] = Banner::get_todays_banner(6);
		$segments = DB::table('offer_deals')->select('segment')->where('type_id',3)->distinct()->get();
                $segments_data=array();
                
		foreach($segments as $segments_list) {
		$segments_data[$segments_list->segment] =ucfirst(strtolower($segments_list->segment));
		}
		$data['segment'] = $segments_data;
	
	        $data['fiesta_city'] = DB::table('offer_deals')->select('city')->distinct()->where('city','!=','')->orderBy('city', 'asc')->get();
           
	        $data['foodfiesta_offers'] = Commonmodel::get_foodfiesta_offers();
	       
	         
		$this->load_reward_region('common','left',$data); 
		
		
		return $this->render_reward_theme('homepage',$data); 
		}


     public function gethotels($id=false,$city=false,$segment=false)
      {    
      $hotel_name =   base64_decode($id);
      $hotel_city =   base64_decode($city); 
      $base_seg = base64_decode($segment);
      $hotel_seg =  htmlspecialchars($base_seg, ENT_IGNORE, 'UTF-8'); 

         $get_geo_city = Geohelper::get_cityname();
         $data['offers'] = Commonmodel::get_offers('Bombay'); 
         $data['city']= 'Bombay';

	   if(empty($data['offers'])){

	        $states = $get_geo_city['state'];;
	        $states_response = Commonmodel::getstatesoffers_by_cities($states);
		if(empty($states_response)){
		   $data['offers'] = Commonmodel::getstatesoffers_by_cities_random($states);
		   $data['city'] ='India';

		}else{
		   $data['offers'] = Commonmodel::getstatesoffers_by_cities($states);
		   $data['city'] =$states;  
		}

	    }

	       $data['offers_city'] = Commonmodel::get_offers_deals_city(); 
	       $data['areas'] = Commonmodel::get_offers_area();    
	       $data['categeory'] = Commonmodel::get_offers_deals_categeory();
	       $data['cusine'] = Commonmodel::get_offers_deals_cusine(); 
		$data['redis_falbums']=Cachehelper::fetch('hung_falbums');
		$data['css_array'] = array('assets/css/custom-style-new.css','assets/css/header_footer.css');
		$data['bread_crumb']=array('Home'=>'/');
		$data['banners'] = Banner::get_todays_banner(1);
		$segments = DB::table('food_fiesta')->select('segment')->distinct()->get();
                $segments_data=array();
                
		foreach($segments as $segments_list) {
		$segments_data[str_replace('?','',$segments_list->segment)] =ucfirst(strtolower(str_replace('?','',$segments_list->segment)));
		}
		$data['segment'] = $segments_data;
	
	        $data['fiesta_city'] = DB::table('offer_deals')->select('city')->where('type_id',3)->where('city','!=','')->distinct()->orderBy('city', 'asc')->get();
                $hotels=array();
            
                if(isset($hotel_city) && !empty($hotel_city))
                {  
                 
                  $segment =  $hotel_seg;
                 
                  $all_hotels  = Commonmodel::get_offer_hotels_name($hotel_city);

                  $hotels['']='Select Hotel';
                  $hotels['1']='----All Hotels----';
                  foreach($all_hotels as $offers_hotel) {
		  $hotels[$offers_hotel->proper_me_name] = ucfirst(strtolower($offers_hotel->proper_me_name));
		  }   
		       // $data['selected_hotel'] =  isset($_POST['hotel_filter']) ? $_POST['hotel_filter'] : '';
			$data['hotels'] = $hotels;
                                    

                    // food list based on name
                     $data['hotel_name'] = $hotel_name;
                     $data['foodfiesta_offers'] = Commonmodel::get_foodfiesta_by_name($hotel_name,$hotel_city,$hotel_seg);
	             $data['foodfiesta_offers_top'] = Commonmodel::get_offers_deals_ram($city='other');

		     $view='home.food_home';
             
                      
                      $this->load_reward_region('common','left',$data);

                     return $this->render_reward_theme($view,$data); 
			
                 }else{
	        $data['foodfiesta_offers'] = Commonmodel::get_foodfiesta_offers();
	       
	        }
	         
		$this->load_reward_region('common','left',$data); 
		return $this->render_reward_theme('homepage',$data); 
		}



	public function pages($id=false){
	
		$data['content'] = DB::table('pages')->where('slug', $id)->get();
		$bread_crumb=array('Home'=>'/');
		$js = array('js/jquery.carouFredSel-6.2.1-packed.js','js/jquery.fancybox-1.3.1.pack.js');
		$css = array('css/gui.css','css/jquery.fancybox-1.3.1.css');
		$this->load_reward_theme('HDFC Superia-Credit Card','home.index','common',$bread_crumb,'','',$css,$js);
		$this->load_reward_region('common','left',$data); 
       return $this->render_reward_theme('home.pages','common',$data); 
		
	
	}
	
	function partner_discount($point=false,$partner_id=false){
		$points = 500;
		$partner_id = 12; 
		echo $points.'  - '; echo $partner_id; 
		exit;
		
	
		
	
	}
	
	
	//food fiesta offers details page
	
	public function foodfiesta_offer_details($id,$type){
	
	
      $data['offer_details']= DB::table('offer_deals')->where('type_id','!=',1)->where('id',$id)->get();
      
     
	$login=Session::get('customer_data'); if(!$login){
			$user_id=0;
			}else{
			$user_id=$login->id;
			}
     $ldata=array($data['offer_details'][0]->proper_me_name,$id,$data['offer_details'][0]->discount_offer,$user_id);
       Loghelper::logwriter('offer',$ldata);
      $data['bread_crumb']=array('Home'=>'/');
       $data['image'] ='';
       	
       return $this->render_reward_theme('home.foodfiesta_details',$data);
    
   }
   
   
  
   
   
   //loading hotels based on the city 
  
   public static function load_hotels(){
   $selected ='';
      $city = $_POST['city'];
                  $result =  Commonmodel::get_offer_hotelsby_ajx($city);
                  $hotels['']='Select Hotel';
                  $hotels['1']='----All Hotels----';
                  foreach($result as $offers_hotel) {
		  $hotels[$offers_hotel->proper_me_name] = $offers_hotel->proper_me_name;
		  }   
		     
			$hotelss= array_filter($hotels);
			
   
      
   echo Form::select('hotel',$hotelss,$selected,array( "class"=>"form-control hotel","id"=>"hotel_val"));
		  
	
   }
   
   
   //food fiesta separate function for pagination 
    public function foodfiesta(){
      
                $data['css_array'] = array('assets/css/custom-style-new.css','assets/css/header_footer.css');
		$data['bread_crumb']=array('Home'=>'/');
		$data['banners'] = Banner::get_todays_banner(1);
		$segments = DB::table('food_fiesta')->select('segment')->distinct()->get();
                $segments_data=array();
              //   $segments_data[''] ='';
		foreach($segments as $segments_list) {
		$segments_data[$segments_list->segment] =ucfirst(strtolower($segments_list->segment));
		}
		$data['segment'] = $segments_data;
	
	        $data['fiesta_city'] = DB::table('food_fiesta')->select('city')->distinct()->orderBy('city', 'asc')->get();
                $hotels=array();
                if(isset($_POST) && !empty($_POST['city']))
                { 
               
                  $segment =  $_POST['segment'];
                
                  $all_hotels  = Commonmodel::get_offer_hotels($_POST);
                  $hotels['']='Select Hotel';
                  $hotels['1']='----All Hotels----';
                  foreach($all_hotels as $offers_hotel) {
		  $hotels[$offers_hotel->me_name] = ucfirst(strtolower($offers_hotel->me_name));
		  }   
		        $data['selected_hotel'] =  isset($_POST['hotel_filter']) ? $_POST['hotel_filter'] : '';
		     
			$data['hotels'] = $hotels;
		        $data['foodfiesta_offers'] = Commonmodel::get_foodfiesta_offers_pagination($_POST);
		       
		        
			$this->load_reward_region('common','left',$data); 
			return $this->render_reward_theme('home.fiesta_home',$data); 
                 }else{
                       $hotels['']='Select Hotel';
                       $data['hotels'] = $hotels;
                       $this->load_reward_region('common','left',$data); 
		       return $this->render_reward_theme('home.fiesta',$data); 
                 }
   
   }
   public function design(){
      
                
		$data['bread_crumb']=array('Home'=>'/');
		
		       return $this->render_reward_theme('ex',$data); 
                
   
   }


 
	
	
   public function foodfiesta_area_fiesta(){
	
      $fiesta_areas = Commonmodel::get_fiesta_area($_POST['area']); 
	$cusine = Commonmodel::get_offers_deals_cusine($_POST['area']); 
	$out='<table>
	<tr><td>
	<div class="col-md-2"  id="foodfieasta_area_load">
<select name="area" class="form-control select_height " onchange="cusion();" id="food_area" style="width:145px;">           
            <option value="1">--All--</option>';
 foreach($fiesta_areas as $citys) { 
$out .='<option value="'.$citys->area.'" >'. $citys->area.'</option>';
  }
              
	$out .='</select>
            </div></div>
            <div id="segment_error"> </div> 
                </td><td> 
         <div id="col-md-2">
	<select name="segment" class="form-control select_height" id="load_foodfiesta_cusine" style="width:145px;">
	
	<option value="1">--All--</option>';
		foreach($cusine as $citys) { 
	$out .='<option value="'.$citys->segment.'" >'.$citys->segment.'</option>';
	 } 
	$out .='</select></div></td></tr></table>
	';
	echo $out;
                
   
   }

public function foodfiesta_area()
        {
	if($_POST['area']==1){
	$fiesta_areas =Commonmodel::get_fiesta_area();

	$cusine = Commonmodel::get_offers_deals_cusine(); 

	}else{
	$fiesta_areas = Commonmodel::get_fiesta_area($_POST['area']); 
	$cusine = Commonmodel::get_offers_deals_cusine($_POST['area']); 
	}
	
	
	$area_array='';
	$area_array.='<option value="1">--All Area--</option>';
 foreach($fiesta_areas as $citys) { 
$area_array .='<option value="'.$citys->area.'" >'. $citys->area.'</option>';
  }
        $seg_array='';      
	$seg_array .='<option value="1">--All Cusine--</option>';
		foreach($cusine as $citys) { 
	$seg_array .='<option value="'.$citys->segment.'" >'.$citys->segment.'</option>';
	 } 
	
                $data = array("area"     =>$area_array,"segmemt"=>$seg_array );
                echo json_encode($data);	
                
   
   }
	public function foodfiesta_cusine(){
	
	
		if($_POST['area']==1){

		$cusine = Commonmodel::get_offers_deals_cusine(); 
		}else{
		$cusine = Commonmodel::get_offers_deals_cusine($_POST['city'],$_POST['area']); 
		}
	$out='';
	$out='<option value="1">--All Cusine--</option>';
		foreach($cusine as $citys) { 
	$out .='<option value="'.$citys->segment.'" >'.$citys->segment.'</option>';
	 } 
	
                $data = array("cusine"     =>$out );
                echo json_encode($data);	
                
   
   }
  

   public static function oops()
   {
	return Redirect::to('error_pages');

   }
}
