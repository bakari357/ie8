<?php 

class DealsController extends BaseController {

    //starting deals and foodfiesta function
    
    public function dealsandfoodfiesta()
    {
       $data['citys'] ='';
      if(isset($_GET['city'])) {
     
       $get_city = $_GET['city'];
       $city = ( $get_city=='other') ? '' : $get_city;
       $data['offers'] = Commonmodel::get_offers_deals($city);
       $data['citys']= $city;
       $areas = Commonmodel::get_offers_area($city);
       $categeory = Commonmodel::get_offers_deals_categeory($city);
       }
       if(isset($_POST['offer_city']) || isset($_POST['cityss']) || isset($_GET['category']) ){
      
        $data['citys'] =  isset($_POST['offer_city']) ? $_POST['offer_city'] : (isset($_POST['cityss']) ? $_POST['cityss'] : (isset($_GET['city']) ? $_GET['city'] : ''));
	$post_city =   $data['citys'];
        $area =  isset($_POST['area']) ? $_POST['area'] : $_GET['area'] ;
	$categeory_name =  isset($_POST['categeory']) ? $_POST['categeory'] :  $_GET['category'] ;
	
        $data['offers'] = Commonmodel::get_offers_deals($post_city,$area,$categeory_name);
     
	$areas = Commonmodel::get_offers_areabypost($post_city);
	$categeory = Commonmodel::get_offers_deals_categeorybypost($post_city,$area); 
       }
       $data['selected_city'] =  $data['citys'] ;
       $data['selected_area'] =  isset($_POST['area']) ? $_POST['area'] : (isset($_GET['area']) ? $_GET['area'] : '') ;
       $data['selected_categeory'] =  isset($_POST['categeory']) ? $_POST['categeory'] : (isset ($_GET['category']) ? $_GET['category'] : '') ;
        $offers_city = Commonmodel::get_offers_deals_city(); 
	$data['area'] = '';
	$offer_cities = array(''=>'All');
	foreach($offers_city as $cities){
	$offer_cities[$cities->city]    = $cities->city;
	}
	$data['offers_city'] =  $offer_cities;
        
        //this is for vapt purpose
        if($data['citys']=='' && empty($_POST) && empty($_GET)  ){
	$data['offers'] = Commonmodel::get_offers_deals(1);
	$areas = Commonmodel::get_offers_area(1);
        $categeory = Commonmodel::get_offers_deals_categeory(1);
	$datacitys = ($data['citys'] !='') ? $data['citys'] : '1';
	$data['citys'] = $datacitys ;
	$data['selected_city'] ='1';
	} //end
         
         
	$offer_area = array(''=>'--All Area--');
	if(isset($areas) && !empty($areas)){
	foreach($areas as $areass){
	$offer_area[str_replace('?','',$areass->area)]    =str_replace('?','',$areass->area);
	}}
	$data['areas'] =  $offer_area;
	$offer_category = array(''=>'--All Category--','food'=>'Foodfiesta');
	if(isset($categeory) && !empty($categeory)){
	foreach($categeory as $cat){
	$offer_category[str_replace('?','',$cat->segment)]    =str_replace('?','',$cat->segment);
	}}
	
	if(isset($_POST['categeory']) && $_POST['categeory']=='food'){
            
        $post_city =  isset($_POST['offer_city']) ? $_POST['offer_city'] : $_POST['cityss'] ;
	$foodsub_categeory  = Commonmodel::get_food_subcategeory($post_city);
	$food_sub_catgory = array('all'=>'--All--');
	foreach($foodsub_categeory as $sub_cat){
	 $food_sub_catgory[str_replace('?','',$sub_cat->segment)] = str_replace('?','',$sub_cat->segment);
	}
	$data['food_sub_catgory'] = $food_sub_catgory; 
	}
	
	
       $data['selected_sub_category'] = isset($_POST['food_sub_catgory']) ? $_POST['food_sub_catgory'] : '' ; 
       $data['categeory'] =  $offer_category;
       $data['categeory_name']='';
       $data['bread_crumb']=array('Home'=>'/');
       return $this->render_reward_theme('deals.dealsandfoodlisting',$data);   
    }   //ending deals and foodfiesta function
    
    
    
    //starting fooddiesta function
    
     public function search_fiesta($city=false)
    {        

                if(empty($_POST) )
                {
                $data['foodfiesta_offers_list'] = Commonmodel::foodfiesta_by_city(1,1,1);
                }
    		if(isset($city) && $city <>''){
    		$_POST['city'] = $city;
    		}else if(isset($_POST['city'])){
			$city=$_POST['city'];
				
			}
			else{ /* $city = Session::get('fiesta_city');*/ }
			$data['area_set'] = '';
			if(isset($_POST['area'])){
			
			$data['area_set'] = $_POST['area']; 
			}
			if(isset($_POST['segment'])){
			$category=$_POST['segment'];
			//Session::put('fiesta_segment',$category);
			} 
			
			//$category=Session::get('fiesta_segment');
			$data['category_set'] = !empty($category) ? $category : 1 ;
			$data['city_set'] = !empty($city) ? $city : 1 ;
			$fiesta_city = DB::table('offer_deals')->select('city')->where('type_id',3)->where('city','!=','')->distinct()->orderBy('city', 'asc')->get();
			$city_list=array('1'=>'--All City--');
			foreach($fiesta_city as $list) {
			
			$city_list[$list->city] =ucfirst(strtolower($list->city));
			}
			$data['fiesta_city'] = $city_list;
			$data['fiesta_areas'] = Commonmodel::get_fiesta_area();  
			if(!empty($city)){
			
			$data['foodfiesta_offers_list'] = Commonmodel::foodfiesta_by_city($city,$category,$data['area_set']);
			}
			if(isset($_POST['city']) &&  $_POST['city'] <> '1'){
			$fiesta_areas = Commonmodel::get_fiesta_area( $_POST['city']); 
			
			if( $data['area_set']!='1' && $data['area_set']!='' ){
			$segments = DB::table('offer_deals')->select('segment')->where('type_id',3)->where('city', 'LIKE', '%'.$_POST['city'].'%')->where('area', $data['area_set'])->where('activated',1)->distinct()->get();
			
			}else{
			$segments = DB::table('offer_deals')->select('segment')->where('type_id',3)->where('city', 'LIKE', '%'.$_POST['city'].'%')->where('activated',1)->distinct()->get();
			}
			$merchants = DB::table('offer_deals')->select('proper_me_name')->where('type_id',3)->where('city','!=','')->where('city', 'LIKE', '%'.$_POST['city'].'%')->where('activated',1)->distinct()->get();
			}else{
			
			$data['area_set'] = isset($_POST['area']) ? $_POST['area'] : 1;
			$segments = DB::table('offer_deals')->select('segment')->where('type_id',3)->where('activated',1)->distinct()->get();
			$merchants = DB::table('offer_deals')->select('proper_me_name')->where('activated',1)->where('type_id',3)->distinct()->get();
			$fiesta_areas = Commonmodel::get_fiesta_area(); 
			}
			
			
			$areas=array('1'=>'--All Area--');
			foreach($fiesta_areas as $list) {
			
			$areas[str_replace('?','',$list->area)] =str_replace('?','',$list->area);
			}
			$data['areas'] = $areas;
			
			
			$segments_data=array('1'=>'--All Cusine--');
			foreach($segments as $segments_list) {
			$segments_data[str_replace('?','',$segments_list->segment)] =ucfirst(strtolower(str_replace('?','',$segments_list->segment)));
			}
			$data['segment'] = $segments_data;
		$merchants_data = array(''=>'--All--');
			foreach($merchants as $list) {
			$merchants_data[$list->proper_me_name] =ucfirst(strtolower($list->proper_me_name));
			}
			$data['hotels'] = $merchants_data;  
			
			
			$view='home.fiesta_list';
			$data['bread_crumb']=array('Home'=>'/');    
			$this->load_reward_region('common','left',$data);
                      
			return $this->render_reward_theme($view,$data);   
    } //ending fooddiesta function
    
    
      //loading deals areas based on city
    
      public static function load_deal_areas()
      { 
		$selected ='';
		$city = $_POST['city'];
		if($_POST['city']==1){
		$result =  Commonmodel::get_offer_areas();
		}else{

		$result =  Commonmodel::get_offer_areas($city); 
		}
		$hotels['1']='--All Area--';
		foreach($result as $offers_hotel) {
		$hotels[str_replace('?','',$offers_hotel->area)] = str_replace('?','',$offers_hotel->area);
		}   
		$selected_area='';
		$hotelss= array_filter($hotels);
   $area =  Form::select('area',$hotelss,$selected_area,array( "class"=>"form_control_deals select_height right form-control","id"=>"area","onchange"=>"change_category();"));
		if($_POST['city']==1){
         
		$result =  Commonmodel::get_offers_deals_categeory();
		}else{
		$result =  Commonmodel::get_offers_deals_categeory($city);
		}
		$segment['1']='--All Category--';
	        $segment['food']='Foodfiesta';
	        $category='';
	        $category.="<option value='1'>--All Category--</option>";
	        $category.="<option value='food'>--Food Fiesta--</option>";
		foreach($result as $offers) {
		$category .=   "<option value='".str_replace('?','',$offers->segment)."'>".ucfirst(strtolower(str_replace('?','',$offers->segment)))."</option>";
		}  
		
                $selected_categeory ='';
                $data = array("area"     => $area, "category"  => $category,);
                echo json_encode($data);				
    }
   
   
   //loading foodfiesta subcategory
   public static function load_sub_category(){

        $foodsub_categeory  = Commonmodel::get_food_subcategeory($_POST['city'],$_POST['area']);
        $count_subcategory  =  count($foodsub_categeory);
        $food_sub_catgory = array('all'=>'--All--');
        foreach($foodsub_categeory as $sub_cat){

        $food_sub_catgory[str_replace('?','',$sub_cat->segment)] = str_replace('?','',$sub_cat->segment);
        }
        $selected_sub_category = '';
        $data['food_sub_catgory'] = $food_sub_catgory; 

        $sub_category = Form::select('food_sub_catgory',$food_sub_catgory,$selected_sub_category,array( "class"=>"form-control")); 
        $data = array( "sub_category"  => $sub_category,"count_subcategory"=> $count_subcategory,);
        echo json_encode($data);	 
   }
   
   
    //loding deal category
      public static function load_deal_category()
      {
        $selected_categeory='';
        $city = $_POST['city'];
        $area = $_POST['area'];
        $result =  Commonmodel::get_offers_deals_categeory($city,$area);
        $load_deal_category = '';
        $load_deal_category .= "<option value='1'>--All Category--</option>";
        $load_deal_category .= "<option value='food'>--Food Fiesta--</option>";

        foreach($result as $offers_hotel) {

        $load_deal_category .=   "<option value='".str_replace('?','',$offers_hotel->segment)."'>".ucfirst(strtolower(str_replace('?','',$offers_hotel->segment)))."</option>";
        }   

        $data = array("load_deal_category"  => $load_deal_category, );
        echo json_encode($data);
   } 
   
   //fiesta area and cusine
     public function foodfiesta_area_fiesta(){
	
        $fiesta_areas = Commonmodel::get_fiesta_area($_POST['area']); 
	$cusine = Commonmodel::get_offers_deals_cusine($_POST['area']); 
	
	$area_array='';
	$area_array.='<option value="1">--All Area--</option>';
 foreach($fiesta_areas as $citys) { 
$area_array .='<option value="'.$citys->area.'" >'. ucfirst(strtolower($citys->area)).'</option>';
  }
        $seg_array='';      
	$seg_array .='<option value="1">--All Cusine--</option>';
		foreach($cusine as $citys) { 
	$seg_array .='<option value="'.$citys->segment.'" >'.ucfirst(strtolower($citys->segment)).'</option>';
	 } 
	
                $data = array("area"     =>$area_array,"segment"=>$seg_array );
                echo json_encode($data);	
                
   
   }
   
   
   

}
