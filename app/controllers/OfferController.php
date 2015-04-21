<?php use Jenssegers\Mongodb\Connection;

class OfferController extends BaseController {


    public function list_offers($id=false,$sub_id=false)
{ 
        $city='';
        $validator = Validator::make(array('id'=>$id),array('id'=>'required|integer'));

        if ($validator->fails())
        {
        return Redirect::to('oops');
        }
        if(!empty($sub_id)) { 

        $city = isset($_POST['city']) ? $_POST['city'] : (isset($_GET['city']) ? $_GET['city'] : '') ; 

        $view='offer.list_sub_offers';} 
        else {
        $city = isset($_POST['city']) ? $_POST['city'] : (isset($_GET['city']) ? $_GET['city'] : '') ; 
        $view='offer.list_offers'; 
        }

        $data['offers'] =  Offermodel::offers_list((int)$id, $city);

	//$region = geoip_record_by_name('115.109.178.168');
         $region['city']='Bangalore';  
        $data['cat_types'] = Offermodel::get_offers_list($id);
   	
	if(!empty($data['cat_types'])){
        $view='offer.list_cat_offers';
	}else{

	$data['present_city'] = $region['city'];
	$data['city'] = DB::table('cities')->select('city')->whereIn('id', array(102,706))->get();
        
	$segments = DB::table('offer_deals')->select('segment')->where('offer_type','=',$id)->distinct()->get();
	if($id == '15')
	   {
	 $segments = DB::table('offer_deals')->select('segment')->where('offer_type','=','2')->distinct()->groupBy
	('deal_name')->groupBy('city')->get();  
	 
	 $data['selected_city'] = isset($_POST['city']) ? $_POST['city'] : (isset($_GET['city']) ? $_GET['city'] : '') ; 
	 $emi_offer_city = DB::table('offer_deals')->select('city')->where('offer_type','=','2')->distinct()->groupBy('deal_name','city')->orderBy('city','asc')->get(); 
	 
	
	$city_lists=array('1'=>'---All City---');
	foreach($emi_offer_city  as $city_list) {

	$city_lists[$city_list->city] = $city_list->city;
	}

	$data['emi_offer_city'] = $city_lists;
	
	
	
	   } 
	$segments_data=array('1'=>'----All Categories---');
	foreach($segments as $segments_list) {
	$segments_data[$segments_list->segment] = $segments_list->segment;
	}

	$data['segment'] = array_filter($segments_data);
	
	
	
	
	$data['select_cardtype'] = isset($_POST['card']) ? $_POST['card'] : '';
        }
     
	$data['off_types'] = $id;
        $data['names'] = DB::table('offer_category')->select('name')->where('id','=',$id)->distinct()->first();
	$data['css_array'] = array('assets/css/custom-style-new.css','assets/css/header_footer.css');
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme($view,$data);
   
    }

  
  //offer details function

    public function offer_details($id,$offer_type=false){

	$validator = Validator::make(array('id'=>$id),array('id'=>'required|integer'));

		if ($validator->fails())
		{
			return Redirect::to('oops');
		}
	$data['offer_details']= DB::table('offer_deals')->where('id',$id)->get();
        $data['off_types'] = $offer_type;
	$login=Session::get('customer_data'); if(!$login) { 
        $user_id=0; }
        else{
	$user_id=$login->id;
	}
	$ldata=array($data['offer_details'][0]->deal_name,$id,$data['offer_details'][0]->offer_details,$user_id);
	Loghelper::logwriter('offer',$ldata);
	$data['bread_crumb']=array('Home'=>'/');
	$data['image'] ='';
	return $this->render_reward_theme('offer.offer_details',$data);
    
   }

    //offer details function
    public function offer_validation($id)
      {
      $data['offer_details']= DB::table('offers')->where('activated','!=',3)->where('id',$id)->get();
      $templ=DB::table('template')->where('active','1')->get();
      $data['bread_crumb']=array('Home'=>'/');	
      return $this->render_reward_theme('offer.validate',$data);
     }
     
   
    public function gridview()
       {
	$templ=DB::table('template')->where('active','1')->get();
	if(isset($_POST) && !empty($_POST)) { 
	$data['offer'] = DB::table('offers')
	               ->leftJoin('campaign_to_geotargeting', 'offers.id', '=', 'campaign_to_geotargeting.campaign_id')->where('campaign_to_geotargeting.state','=',$_POST['state'])->where('campaign_to_geotargeting.city','=',$_POST['city'])->get();
	}
        else {
	$data['offer']    = DB::table('offers')->where('activated','!=',3)->get(); 
          }
	$data['states']   = DB::table('states')->where('country_code', 'IN')->get();
	$data['cities']   = DB::table('cities')->where('country_code', 'IN')->get();
	$data['category'] = DB::table('categories')->select('name','id')->get(); 
	$user_result      = Session::get('customer_data'); 
	if(!empty($user_result)) { 
	$customer_id = $user_result->id;	
	$data['offers'] = DB::table('customers_points')->where('user_id','=',$customer_id)
	                ->leftJoin('offers', 'customers_points.program_id', '=', 'offers.id')
	                ->get();   
	}
	$data['bread_crumb']=array('Home'=>'/');	
	return $this->render_reward_theme('offer.gridview',$data);
   
   }
   
    public function listview(){
	$templ=DB::table('template')->where('active','1')->get();
	if(isset($_POST) &&!empty($_POST)) { 
	$data['offer'] = DB::table('offers')
	               ->leftJoin('campaign_to_geotargeting', 'offers.id', '=', 'campaign_to_geotargeting.campaign_id')->where('campaign_to_geotargeting.state','=',$_POST['state'])->where('campaign_to_geotargeting.city','=',$_POST['city'])->get();
	} 
	else{  
	$data['offer'] = DB::table('offers')->where('activated','!=',3)->get(); }
	$data['states'] = DB::table('states')->where('country_code', 'IN')->get();
	$data['cities']  = DB::table('cities')->where('country_code', 'IN')->get();
	$data['category'] = DB::table('categories')->select('name','id')->get(); 
	$user_result = Session::get('customer_data'); 
	if(!empty($user_result)) { 
	$customer_id = $user_result->id;
	$data['offers'] = DB::table('customers_points')->where('user_id','=',$customer_id)
	                ->leftJoin('offers', 'customers_points.program_id', '=', 'offers.id')
	                ->get();   
	}

	$data['bread_crumb']=array('Home'=>'/');	
	return $this->render_reward_theme('offer.listview',$data);
   
   }
 
    public function redriect($id)
     {
	$login=Session::get('customer_data'); if(!$login){
	$user_id=0;
	}
        else{
	$user_id=$login->id;
	}	
	$ip=$_SERVER['REMOTE_ADDR'];
	DB::table('offers_clicls clicks')->insertGetId(array(
	'offer_id'      => $id,
	'user_id'       => $user_id,
	'ip_address'    => $ip,
	'created_at'    => date( 'Y-m-d H:i:s' )));
	return Redirect::action('OfferController@merchant');	

    
   }
    public function merchant()
       {
	$data['bread_crumb']=array('Home'=>'/');	
	$bread_crumb =array('Home'=>'/');
	$this->load_reward_withoutheader_theme('HDFC Superia-Credit Card','auth.login','auth',$bread_crumb,'','',''); 	
	return $this->render_login_theme('offer.merchant','auth',$data);
	}
	
 //loading hotels based on the city 

   public static function load_segment()
     {
	$card = $_POST['card']; 
	$result =  Offermodel::get_offer_segmentby_ajx($card);
	$out ='';
	$out.='<select class="form-control" style="margin-left: -264px;margin-top: 12px; width:228px;" name="segment">';

	foreach($result as $offers_segment) { 
	$out.='<option value="'.$offers_segment->segment.'">'.ucfirst(strtolower($offers_segment->segment)).'</option>';
	}   
	$out.='</select>';

	print_r($out);
   }
   
   
        public function getoffers($id=false,$name=false,$city=false,$card_selected=false)
        {  
        $deal_name =   base64_decode($name);
        $city =   base64_decode($city); 
        $data['offers'] = Offermodel::getoffersby_namecity($deal_name,$city);
        $view='offer.offers_home';
        $data['bread_crumb']=array('Home'=>'/');
        $data['off_types'] = $card_selected;
        $data['offer_name'] =  $deal_name;
        $this->load_reward_region('common','left',$data);
        return $this->render_reward_theme($view,$data); 


        }

	
	
}
