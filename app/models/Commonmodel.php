<?php

class Commonmodel extends Eloquent {
  
  
  public static function get_autoid($table){

	
	$response=DB::select(DB::raw("SHOW TABLE STATUS LIKE"."'$table'"));
	$a_id=$response->Auto_increment;
   
   
   }
   
   //get flipkart products
   
   
   public static function getflipkartoffers($type){
     
       $products = DB::table('flipkart_products')->where('activated',1)->where('created_at','>=',date("Y-m-d"))->where('product_type',$type)->get();
      if(count($products) > 0)
      {
       return  $products;
      }
      else
      {
      $products = DB::table('flipkart_products')->where('activated',1)->where('product_type',$type)->take(5)->get();
      return  $products;
      }
      
     }
   
  
   //get offers based on the city 

      public static function get_offers($city){

       $offers = DB::table('offer_deals')->select('proper_me_name','offer_details','address','image','state','city','discount_offer')->where('type_id',3)->where('city',strtoupper($city))->where('activated',1)->take(1)->get();

      return $offers;

      }
      
      
     public static function top_offers(){

       $offers = DB::table('offer_deals')->select('id','deal_name','short_description','image')
					 //->where('category_id','7')->take(2)->get();
					 
					 ->whereIn('id', array(29087,29102))->get();
					 
					 
					 
					 
       return $offers;

      }  
       public static function get_offers_deals($city=false,$area=false,$categeory=false){
	
   
	 if($city==1 && $area=='1' && $categeory=='1' || $city=='' && $area=='' && $categeory=='' )
	 { 
	 $offers = DB::table('offer_deals')->select(DB::RAW('DISTINCT(proper_me_name)'), 'image','type_id','address','city','discount_offer','offer_details','segment','deal_name','state','id')->where('type_id','!=','1')->groupBy('proper_me_name')->groupBy('city')->where('activated',1)->paginate(20);
	 return $offers;
	 }
	 
	 else if( $city !='' && $city !=1 && $area !='1' && $area !='' && $categeory!='' && $categeory!='1' && $categeory!='food')
	 { 
	   
	 $offers = DB::table('offer_deals')->select(DB::RAW('DISTINCT(proper_me_name)'), 'image','type_id','address','city','discount_offer','offer_details','segment','deal_name','state','id')->where('city',strtoupper($city))->where('segment',$categeory)->where('area',$area)->where('type_id','!=',1)->where('activated',1)->groupBy('proper_me_name')->groupBy('city')->paginate(20);
	 return $offers;
	 }
	   
        else{
   
	 $offers = DB::table('offer_deals')->select(DB::RAW('DISTINCT(proper_me_name)'), 'image','type_id','address','city','discount_offer','offer_details','segment','deal_name','state','id')->where('type_id','!=','1')->where('activated',1)
	         
			->where(function($query)use ($city,$area,$categeory)
			{
				if($city <> '1' &&  $city <>''){
				
				$query->where('city',  'LIKE', '%'.$city.'%');
				}
				if($area<> '1' && $area<> ''){
				$query->where('area', $area);
				
				}
				if($categeory<> '1' && $categeory<> ''  ){
				    if($categeory<>'food')
				    {
				      $query->where('segment', $categeory)->where('type_id','!=',1);
				    } else{
				    if(isset($_POST['food_sub_catgory']) && $_POST['food_sub_catgory'] !='all' ){
				   $query->where('segment', $_POST['food_sub_catgory'])->where('type_id', 3);
				    }else{
				      $query->where('type_id', 3);
				    }
				   
				   } 
				
				}
				
				
		    	}
			)->groupBy('proper_me_name')->groupBy('city')->paginate(20);
		return $offers;
	}    
     

      }
	   public static function get_offers_deals_city(){

       $offers = DB::table('offer_deals')->select('city')->distinct()->where('city','!=','')->where('type_id','!=',1)->where('activated',1)->orderBy('city','asc')->get();

      return $offers;

      }
     public static function get_foodfiesta_city(){

       $offers = DB::table('offer_deals')->select('city')->where('city','!=','')->where('type_id',3)->where('activated',1)->distinct()->orderBy('city','asc')->get();

      return $offers;

      } 
         public static function get_offers_area($city=false){

        if($city!='' && $city!='1'){
      
       $offers = DB::table('offer_deals')->select('area')->where('type_id','!=',1)->where('area','!=','')->where('city','LIKE', '%'.$city.'%')->where('activated',1)->orderBy('area','asc')->distinct()->get();
       }
       else{
          $offers = DB::table('offer_deals')->select('area')->where('type_id','!=',1)->where('area','!=','')->where('activated',1)->orderBy('area','asc')->distinct()->get();
       
       }
       //->where('city','LIKE', '%'.$city.'%')

      return $offers;

      }
       public static function get_offers_areabypost($city){
       
        if($city!='1' && $city!=''){ 
       $offers = DB::table('offer_deals')->select('area')->where('area','!=','')->where('city','LIKE', '%'.$city.'%')->where('activated',1)->orderBy('area','asc')->distinct()->get();
       }else{
       
       $offers = DB::table('offer_deals')->select('area')->where('area','!=','')->where('activated',1)->orderBy('area','asc')->distinct()->get();
       }

      return $offers;

      }
      	  public static function get_fiesta_area($id=false) {
      	  
     if(!empty($id) && $id!='1' ){
     
	$offers = DB::table('offer_deals')->select('area')->where('area','!=','')->where('type_id',3)->where('city','=',$id)->where('activated',1)->distinct()->orderBy('area','asc')->get();
	}else{
	
       $offers = DB::table('offer_deals')->select('area')->where('area','!=','')->where('type_id',3)->where('activated',1)->distinct()->orderBy('area','asc')->get();
	}
      return $offers;

      }


	public static function get_offers_deals_categeory($city=false, $area=false,$categeory_name=false){
	
        
	if(!empty($city) && $city!='1'   && !empty($area) && $area!='1' )
	{
	$offers = DB::table('offer_deals')->distinct()->select('segment')->where('city','=',$city)->where('area','=',$area)->where('segment','!=','')->where('activated',1)->orderBy('segment','asc')->where('type_id',2)->where('activated',1)->get();
	}
	
	else{
	
	$offers = DB::table('offer_deals')->distinct()->select('segment')->where('segment','!=','')->where('activated',1)->where('type_id',2)->orderBy('segment','asc')
			->where(function($query)use ($city, $area)
			{
				if($city=='1' && $area!='1' && $area!='0'){
				
				$query->where('area','=',$area);
				}
				if( $area=='1' || $city!='1' && $city!='0'  && $city!='' ){
				
				$query->where('city','LIKE', '%'.$city.'%');
				
				}
				if($city=='' && $area!='0'){
				$query->where('area','=',$area);
				}
				
		    	}
			)->get();
			
			}
	
	 return $offers;

	}
      
       public static function get_offers_deals_categeorybypost($city,$area)
       { 
        if($city!='' && $city!='1' && $area!='' && $area!='1'){
       $offers = DB::table('offer_deals')->select('segment')->distinct()->where('city','LIKE', '%'.$city.'%')->where('area','=',$area)->where('activated',1)->where('segment','!=','')->where('type_id',2)->orderBy('segment','asc')->get();
       }else{
       
        $offers = DB::table('offer_deals')->select('segment')->distinct()->where('activated',1)->where('segment','!=','')->where('type_id',2)->orderBy('segment','asc')
        
        ->where(function($query)use ($city, $area)
			{
				if($area!='' && $area!='1'){
				
				$query->where('area','=',$area);
				}
				if( $city!='' && $city!='1'){
				
				$query->where('city','LIKE', '%'.$city.'%');
				
				}
				
		    	}
			)->get();
        
       
       }
      return $offers;

      }
      
       public static function get_offers_deals_cusine($city=false,$area=false)
       {
	
        if(!empty($city) && !empty($area) && $city!='1')
        {
       $offers = DB::table('offer_deals')->select('segment')->distinct()->where('city','=',$city)->where('type_id',3)->where('area','=',$area)->where('activated',1)->get();
	}
	elseif(!empty($city) && $city!='1' )
	{ 
	$offers = DB::table('offer_deals')->select('segment')->where('city','=',$city)->where('type_id',3)->where('activated',1)->distinct()->get();
	}
	elseif($area!='' && $area!='1'){
	$offers = DB::table('offer_deals')->select('segment')->where('area','=',$area)->where('type_id',3)->where('activated',1)->distinct()->get();
	}
	else{
	$offers = DB::table('offer_deals')->select('segment')->where('type_id',3)->where('activated',1)->distinct()->get();
	}
      return $offers;

      }
      
      
	public static function get_offers_deals_ram($cit){

	if($cit != 'other' && $cit != '1' ){

	$offers = DB::table('offer_deals')->select(DB::RAW('DISTINCT(proper_me_name)'), 'image','type_id','address','city','discount_offer','offer_details','segment','deal_name','state','id')->where('city','=',$cit)->where('type_id','!=',1)->where('activated',1)->take(15)->orderBy(DB::raw('RAND()'))->paginate(20);
	return  $offers;
	}
	else{

	$offers = DB::table('offer_deals')->select(DB::RAW('DISTINCT(proper_me_name)'), 'image','type_id','address','city','discount_offer','offer_details','segment','deal_name','state','id')->where('type_id','!=',1)->where('activated',1)->take(15)->orderBy(DB::raw('RAND()'))->paginate(20);
	return  $offers;
	}


	}
	
	
   //get states based on the region id
   public static function get_states($id){
   
    $states_result = DB::table('states')->select('adminName1')->where('adminCode1',$id)->first();
   
    
    if(empty($states_result)) {
    
     $states_result = DB::table('states')->select('adminName1')->where('adminCode1','IN')->first();
        return $states_result;
    }
    else{
    return $states_result;
    }
   }
   
  
   
   public static function  getstatesoffers_by_cities($states)
   {
   
    $default_state_offers = DB::table('offer_deals')->select(DB::RAW('DISTINCT(proper_me_name)'), 'image','type_id','address','city','discount_offer','offer_details','segment','state','id')->where('state',$states)->where('type_id',3)->where('activated',1)->take(1)->get();
 
    return  $default_state_offers;
   
	}
	
	public static function getstatesoffers_by_cities_random($states){
	
	 $default_state_offers = DB::table('offer_deals')->select('proper_me_name','offer_details','address','image','state','city','id')->
 where('state',$states)->where('activated',1)->take(1)->orderBy(DB::raw('RAND()'))->get();
 
 if(count($default_state_offers) > 0) {
  return  $default_state_offers;
 } else {
 
 $default_state_offers = DB::table('offer_deals')->select('proper_me_name','offer_details','address','image','state','city')->where('activated',1)->take(1)->orderBy(DB::raw('RAND()'))->get();
  return  $default_state_offers;
 }
 
	
	}
	
	
	//getting food fiesta offers
	
	public static function get_foodfiesta_offers(){
	
	 $foodfiesta_offers = DB::table('offer_deals')->select('offer_deals.*')->where('activated',1)->whereIn('id', array(1318, 1341,1326,1425,1429,1433,17596,29109,29110,29113,18408))->get();
       return $foodfiesta_offers;
       
	
       /*$foodfiesta_offers = DB::table('offer_deals')->select('offer_deals.*')->where('type_id',3)->where('activated',1)->orderBy(DB::raw('RAND()'))->take(5)->get();
       
          $offers = DB::table('offer_deals')->select('offer_deals.*')->where('type_id',1 )->where('activated',1)->orderBy(DB::raw('RAND()'))->take(5)->get();
       
       $result = array_merge($foodfiesta_offers, $offers);*/
     
     
	}
	
	
	

public static function get_foodfiesta_by_name($name,$city,$seg)
{ 
    
	$foodfiesta_offers = DB::table('offer_deals')->select('proper_me_name', 'image','type_id','address','city','discount_offer','offer_details','segment','state','id')
                    ->where('proper_me_name',$name)->where('city',$city)->where('segment',str_replace('amp;','',$seg))->where('activated',1)->where('type_id','!=',1)->groupBy('area')->get();
 
 return $foodfiesta_offers;
}


	public static function foodfiesta_by_city($city,$segment,$area=false)
	{ 
		
		
		  $data['segment'] = $segment;
		
		  $data['city'] = $city;
		 
		  $data['area'] = $area;

		if (($city ==1 && $segment==1 ) && ( $area==1 || $area=='Select Area')  ){
	
		$foodfiesta_offers = DB::table('offer_deals')->select(DB::RAW('DISTINCT(proper_me_name)'), 'image','type_id','address','city','discount_offer','offer_details','segment','deal_name','state','id')->where('type_id',3)->where('activated',1)->groupBy('proper_me_name')->groupBy('city')->paginate(20);
		}
		
		
		else{
			$foodfiesta_offers =DB::table('offer_deals')->select(DB::RAW('DISTINCT(proper_me_name)'), 'image','type_id','address','city','discount_offer','offer_details','segment','deal_name','state','id')->where('type_id',3)->where('activated',1)
			->where(function($query)use ($data)
			{
				if($data['segment'] <> '1' && $data['segment'] <> '' ){
				
				$query->where('segment', 'LIKE', '%'.$data['segment'].'%');
				}
				if($data['area']<> '' && $data['area']<>'1' && $data['area']<>'Select Area'){
				
				$query->where('area', 'LIKE', '%'. $data['area'].'%');
				
				}
				if($data['city']<> '' && $data['city']<>'1' ){
				$query->where('city', 'LIKE', '%'.$data['city'].'%');
				}
				
		    	}
			)->groupBy('proper_me_name')->groupBy('city')->paginate(20);
			
			}
	   return $foodfiesta_offers;
	
	
	}

	
	
	public static function  get_offer_hotels($filter){
	
	
	$foodfiesta_offers = DB::table('offer_deals')->select('proper_me_name')->where('type_id',3)->where('city',$filter['city'])->where('activated',1)->get();
	return  $foodfiesta_offers;
	}
	
	public static function  get_offer_hotels_name($filter){
	
	
	$foodfiesta_offers = DB::table('offer_deals')->select('proper_me_name')->where('type_id',3)->where('city',$filter)->where('activated',1)->get();
	return  $foodfiesta_offers;
	}
	
	public static function  get_offer_hotelsby_ajx($city){
	
	
	$foodfiesta_offers = DB::table('offer_deals')->distinct()->select('proper_me_name')->where('type_id',3)->where('city',$city)->where('activated',1)->get();
	return  $foodfiesta_offers;
	}
	
	
	
       public static function  get_offer_areas($city=false)
       {
	if(!empty($city))
        {	
	$foodfiesta_offers = DB::table('offer_deals')->distinct()->select('area')->where('city',$city)->where('area','!=','')->where('type_id','!=',1)->where('activated',1)->orderBy('area','asc')->get();
        }
        else
        {
	$foodfiesta_offers = DB::table('offer_deals')->distinct()->select('area')->where('type_id','!=',1)->where('area','!=','')->where('activated',1)->orderBy('area','asc')->get();
        }	

        return  $foodfiesta_offers;
	}

	
	
	//get flipkart deals
	
	 public static function getflipkartdeals(){
	 
	      $deals = DB::table('flipkart_deals')->where('activated',1)->where('created_at','>=',date("Y-m-d"))->get();       
	      if(count($deals) >0)
	      {
	      return $deals;
	      }
	      else
	      {
	      $deals = DB::table('flipkart_deals')->where('activated',1)->take(5)->get();    
	      return $deals;
	         
	      }
	 
	 }
	 
	 ////get flipkart banners
	  public static function  getflipkartbanners(){
	  
	   $deals = DB::table('flipkart_banners')->get();
	   return $deals;
	 
	 }
	
	 //get offers by partner
	 public static function  getoffersby_partner($partner_id)
	 {
	  
	   $offers =  DB::Select(DB::RAW("select offer_type,CONCAT(end_date , ' ' ,end_time) as dates , TIMESTAMP(end_date,end_time) as new_date from pp_partner_offers where partner_id = '".$partner_id."' and activated = 1 and TIMESTAMP(end_date,end_time) >= '".date('Y-m-d H:i:s')."'  "));
	  return $offers;
	
	
	 }

	 public static function  getoffersby_partnercoupon($partner_id,$code,$type=false)
	 {
		$t = ''; 
	  if($type <> ''){
		$t = "and local_inter = '".$type."'";
		}
	   $offers =  DB::Select(DB::RAW("select offer_type,CONCAT(end_date , ' ' ,end_time) as dates , TIMESTAMP(end_date,end_time) as new_date from pp_partner_offers where partner_id = '".$partner_id."' and coupon_code = '".$code."' ".$t." and activated = 1 and TIMESTAMP(end_date,end_time) >= '".date('Y-m-d H:i:s')."'  "));
	  return $offers;
	
	
	 }		

	 public static function  getPartnerId($partnername){
	  
	   $partner = DB::table('partners')->select('id')->where('name', 'LIKE', '%'.$partnername.'%')->first();
	   return $partner;
	 
	 }
	
	
	 public static function get_food_subcategeory($city=false,$area=false){
	 
	
	 if($city!='1' && $area!='' && $area!='1'){
	  $foodsub_category = DB::table('offer_deals')->select('segment')->where('type_id',3)->where('city', 'LIKE', '%'.$city.'%')->where('area','=',$area)->where('activated',1)->distinct()->orderBy('segment','asc')->get();
	 
	 }
	 elseif($city!='1'){
	  $foodsub_category = DB::table('offer_deals')->select('segment')->where('type_id',3)->where('city', 'LIKE', '%'.$city.'%')->where('activated',1)->distinct()->orderBy('segment','asc')->get();
	 
	 }
	 else{
	 
	 $foodsub_category = DB::table('offer_deals')->select('segment')->where('type_id',3)->where('activated',1)->distinct()->orderBy('segment','asc')->get();
	 }
	 return $foodsub_category;
	 
	 }

	public static function get_homepage_cdoffers($type){
	
	$offers = DB::table('offer_deals')->select('id','deal_name','short_description','image')
					 ->where('category_id',$type)->take(6)->get();
       return $offers;

	}
	
      
      
     

      
      
      
      
      
      
      
}
