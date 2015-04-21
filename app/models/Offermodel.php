<?php use Jenssegers\Mongodb\Connection;

class Offermodel extends Eloquent {
  
  //Offers list
  public static function offers_list($id=false,$city=false)
     {  


        if($city!='') {

        if($city!='1'){

        $data['offers'] = DB::table('offer_deals')->select ('offer_deals.id','offer_deals.deal_name','offer_deals.start_date','offer_deals.end_date','offer_deals.discount_offer','offer_deals.offer_type','offer_deals.offer_details','offer_deals.address','offer_deals.address2','offer_deals.address3','offer_deals.segment',
        'offer_deals.image','short_description','city')->where('offer_type','=','2')->where('city','=',$city)->distinct()->groupBy('deal_name','city')->where('end_date', '>=',date("Y-m-d"))->where('end_date','<>','1970-01-01')->paginate(20); 
        }

        else {

        $data['offers'] = DB::table('offer_deals')->select ('offer_deals.id','offer_deals.deal_name','offer_deals.start_date','offer_deals.end_date','offer_deals.discount_offer','offer_deals.offer_type','offer_deals.offer_details','offer_deals.address','offer_deals.address2','offer_deals.address3','offer_deals.segment',
        'offer_deals.image','short_description','city')->where('offer_type','=','2')->distinct()->groupBy('deal_name','city')->where('end_date', '>=',date("Y-m-d"))->where('end_date','<>','1970-01-01')->paginate(20); 

        }


    }

            else  {  
       	//$region = geoip_record_by_name('115.109.178.168');
       
		$region['city']='Bangalore';
		$data['offers'] = DB::table('offer_deals')->select('offer_deals.id','offer_deals.deal_name','offer_deals.start_date','offer_deals.end_date','offer_deals.discount_offer','offer_deals.offer_type','offer_deals.offer_details','offer_deals.address','offer_deals.address2','offer_deals.address3','offer_deals.segment','offer_deals.image','offer_deals.region','offer_deals.city','short_description')->where('category_id','=',$id)->groupBy('deal_name','city')->orderBy('featured', 'desc')->where('end_date','<>','1970-01-01')->where('end_date', '>=',date("Y-m-d"))->where('type_id','=','1')->paginate(20);
		} 
            
 //echo '<pre>'; print_r( $data['offers']); exit;
		return $data['offers'];
     }
  
 
 
  //get offers by dealname and city
      
      public static function getoffersby_namecity($name,$city)
{ 
    
	$offers = DB::table('offer_deals')->select('offer_deals.id','offer_deals.deal_name','offer_deals.start_date','offer_deals.end_date','offer_deals.discount_offer','offer_deals.offer_type','offer_deals.offer_details','offer_deals.address','offer_deals.address2','offer_deals.address3'
	,'offer_deals.segment','offer_deals.image','offer_deals.region','offer_deals.city','short_description')
	->where('deal_name','=',$name)->where('city','=',$city)->groupBy('deal_name','address')->get();
 
 return $offers;
}




  
       public static function  get_offer_segmentby_ajx($card){
	
	if(isset($card) && $card == '5'){
	$offers_segment = DB::table('offer_deals')->distinct()->select('segment')->where('discount_cashback','EasyEMI')->orderBy('featured', 'desc')->get();}
         else {
         $offers_segment = DB::table('offer_deals')->distinct()->select('segment')->where('offer_type',$card)->orderBy('featured', 'desc')->get(); 
          }
	return  $offers_segment;
	}

        public static function get_offers_list($id) {
           $offers_type = DB::table('offer_category')->select('id','name')->where('parent_id','=',$id)->get();
            return $offers_type;
          }
	public static function get_offers_list_sub($id) {
           $offers_type = DB::table('offer_deals')->select('id','deal_name','segment','short_description','image')->where('category_id','=',$id)->where('end_date','<>','1970-01-01')->where('end_date', '>=',date("Y-m-d"))->take(5)->orderBy('featured', 'desc')->get();
		if(empty($offers_type) && $id==17){
                   $type_id = DB::table('offer_category')->select('id')->where('parent_id','=',$id)->get();
		foreach($type_id as $ids){
			if(!empty($type_id) && empty($offers_type)){
   
			$offers_type = DB::table('offer_deals')->select('id','deal_name','segment','short_description','image')->where('category_id','=',$ids->id)->where('end_date','<>','1970-01-01')->where('end_date', '>=',date("Y-m-d"))->take(5)->orderBy('featured', 'desc')->get();
			}
			}
		}
	
            return $offers_type;
          }
	
}
