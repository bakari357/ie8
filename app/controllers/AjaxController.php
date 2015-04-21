<?php

class AjaxController extends BaseController  {



/* hotel city lists */
  public function hotel_cities()
        {
		$return_array=array();
		$input= Str::lower(Input::get('term')); 
		$value = $value = Cache::rememberForever('exp_citie'.$input,function()
		{
		$term = Str::lower(Input::get('term'));    
		$return_array =DB::select(DB::raw("Select RegionNameLong,RegionID from pp_parentregionlist where (RegionType='City') AND SubClass ='' AND RegionNameLong LIKE '".$term."%' Order BY RegionNameLong ASC LIMIT 20"));

		return $return_array;

		});

		foreach ($value as $k => $v) {

		$result_array[] = array('value' => $v->RegionNameLong, 'id' =>$v->RegionID);

		}
    
   
                 return Response::json( $result_array);
		
	}

/* domestic flight city lists */

	 public function domestic_cities()
        {
		$term = Str::lower(Input::get('term'));   
		$result_array=array();

		$return_array =DB::table('goibibo_citylist')->where('is_domestic','Y')->where('city', 'LIKE',$term.'%')
		->orderby('airport_name','ASC')->take(10)->remember(60)->get();

		foreach ($return_array as $k => $v) {
                $result_array[] = array('value' => $v->city.', '.$v->airport_name, 'id' =>$v->airport_code);
		}
       
   		return Response::json( $result_array);


	}


/* international flight city lists */
	 public function international_cities()
        {
		$term = Str::lower(Input::get('term'));   
		$results=array();
		$results = DB::table('goibibo_citylist')
                        
                ->where('is_domestic','N')->where('city', 'LIKE', $term.'%')
		
		->get();
		foreach ($results as $k => $v) {
		$result_array[] = array('value' => $v->city.', '.$v->airport_name, 'id' =>$v->airport_code);
      		}
    
  		return Response::json( $result_array);
	}



}
