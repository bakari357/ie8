<?php 
//use Illuminate\Redis\Database as Redis;
use Carbon\Carbon;
class RedisController extends BaseController {

    /**
     * Show the profile for the given user.
     */
/**
	 * The Redis database connection.
	 *
	 * @var \Illuminate\Redis\Database
	 */
         public function __construct( ) {
               $red = new RedisL4();
               $this->redis = $red::connection();
               
             
                  }
     public function citylist()
    {
	$citylist =DB::table('parentregionlist')->where('SubClass','')->where('RegionType','City')->orWhere('RegionType','Multi-City (Vicinity)')->skip(20000)->take(5000)->get();
echo '<pre>'; print_r($citylist); 
	$auto = new RedisAutocomplete(json_encode($this->redis),"citylist");
	foreach($citylist as $city)
	{	
	$auto->Store($city->RegionID, $city->RegionNameLong);
	}
	$redis_read=RedisCustom::Redis_reader('exp_citylist');
	echo count($redis_read);
	 
    }
    public function flight_citylist()
    {
	$citylist =DB::table('airport_list')->where('is_domestic','Y')->get();
        $auto = new RedisAutocomplete(json_encode($this->redis),"flight_citylist");
	foreach($citylist as $city)
	{
        $auto->Store($city->airport_code, $city->airport_name);
	}
	 
	$redis_read=RedisCustom::Redis_reader('flight_citylist');

	
    }
 	  public function flight_icitylist()
    {
	$citylist =DB::table('airport_list')->where('is_domestic','N')->get();
        $auto = new RedisAutocomplete(json_encode($this->redis),"flight_icitylist");
	foreach($citylist as $city)
	{	
		$auto->Store($city->airport_code, $city->airport_name.','.$city->city);
	}
	$redis_read=RedisCustom::Redis_reader('flight_icitylist');
	 print_r($redis_read);
	 
    }


    public function load_music($id)
    {

	$redis=RedisL4::connection();
        $redis_write=RedisCustom::Redis_reader("hung_featured_".$id);
        $data= $this->redis->HGETALL("hung_featured_".$id);	
        $date = new DateTime();
	$hun_cat =DB::table('hungama_category')->get();
	
	foreach($hun_cat as $albms)
	{

		$url='http://api.hungama.com/reward360/v2/index.php/musicalbums/featured?cat_id='.$albms->cid;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($ch); 
		curl_close($ch);     
		$fea_album=json_decode($output);
	        $redis = RedisL4::connection();
                if(isset($fea_album->albums) && !empty($fea_album->albums))
		{

		$track=array();
		foreach($fea_album->albums as $row)
		{
			
			$track[$row->album_id]=json_encode($row);					

			
		}

			
			$expiresAt = Carbon::now()->addMinutes(2880);
			Cachehelper::store('hung_featured_'.$albms->cid,$track,$expiresAt);
			$data=Cachehelper::fetch('hung_featured_'.$albms->cid);


			
		
			
	

		}
	}
	
	
	    
    }


	function featured_albums($id)
	{
		
	   $hun_cat =DB::table('hungama_category')->get();
	
		
	foreach($hun_cat as $albms)
	{
          $url='http://api.hungama.com/reward360/v2/index.php/musicalbums/featured?cat_id='.$albms->cid;

		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);

		
               if(isset($fea_album->albums) && !empty($fea_album->albums))
		{
                 $ftrack = array();
		 echo '<pre>';
		foreach($fea_album->albums as $row)
		{
	         $ftrack[$row->album_id]=json_encode($row);					
	
		}

                        $expiresAt = Carbon::now()->addMinutes(2880);
			Cachehelper::store('hung_featured_albums_'.$albms->cid,$ftrack,$expiresAt);
			$data=Cachehelper::fetch('hung_featured_albums_'.$albms->cid);

			print_r($data);

              }
	     // $redis_read=RedisCustom::Redis_reader('hung_featured_albums_'.$albms->cid);
	    
	}

	

	 
}

	function albums($id)
	{
	   $hun_cat =DB::table('hungama_category')->get();
	 //For individual
	   $url='http://api.hungama.com/reward360/v2/index.php/musicalbums/albumlist?cat_id='.$id;
	   $c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);
		if(isset($fea_album->albums) && !empty($fea_album->albums))
		{  
		$ftrack = array();
		foreach($fea_album->albums as $row)
		{
		// RedisCustom::Redis_writer('hung_regional'.$id,$row->album_id,json_encode($row));
		$ftrack[$row->album_id]=json_encode($row);		
		}
		$expiresAt = Carbon::now()->addMinutes(2880);
		Cachehelper::store('hung_regional'.$id,$ftrack,$expiresAt);
		$data=Cachehelper::fetch('hung_regional'.$id);

		}
		//   $redis_read=RedisCustom::Redis_reader('hung_regional'.$id);	     
		echo '<pre>';  print_r($data);

	     
	     
	   foreach($hun_cat as $albms)
	{

		$url='http://api.hungama.com/reward360/v2/index.php/musicalbums/albumlist?cat_id='.$albms->cid;
	          $c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);
               if(isset($fea_album->albums) && !empty($fea_album->albums))
		{  
                  $ftrack = array();
		foreach($fea_album->albums as $row)
		{
		//RedisCustom::Redis_writer('hung_albums_'.$albms->cid,$row->album_id,json_encode($row));
		$ftrack[$row->album_id]=json_encode($row);		
		}
		        $expiresAt = Carbon::now()->addMinutes(2880);
			Cachehelper::store('hung_albums_'.$albms->cid,$ftrack,$expiresAt);
			$data=Cachehelper::fetch('hung_albums_'.$albms->cid);
		
	        }
	     // $redis_read=RedisCustom::Redis_reader('hung_albums_'.$albms->cid);
	    
	}


}
	function hot_picks($id)
	{
	   $hun_cat =DB::table('hungama_category')->get();
	
		
	foreach($hun_cat as $albms)
	{

		$url='http://api.hungama.com/reward360/v2/index.php/musicalbums/hotpicks?cat_id='.$albms->cid;
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);
                if(isset($fea_album->albums) && !empty($fea_album->albums))
		{
                 $ftrack = array();
		foreach($fea_album->albums as $row)
		{
		//RedisCustom::Redis_writer('hung_hot_'.$albms->cid,$row->album_id,json_encode($row));
		$ftrack[$row->album_id]=json_encode($row);	
		}
		
                $expiresAt = Carbon::now()->addMinutes(2880);
		Cachehelper::store('hung_hot_'.$albms->cid,$ftrack,$expiresAt);
		$data=Cachehelper::fetch('hung_hot_'.$albms->cid);
		
	        }
	     // $redis_read=RedisCustom::Redis_reader('hung_hot_'.$albms->cid);
	    
	}

	

	 
}



	function new_arr($id)
	{
	   $hun_cat =DB::table('hungama_category')->get();
	
		
	foreach($hun_cat as $albms)
	{

		$url='http://api.hungama.com/reward360/v2/index.php/musicalbums/newarivals?cat_id='.$albms->cid;
	         $c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);
                if(isset($fea_album->albums) && !empty($fea_album->albums))
		{
                  $ftrack = array();
		foreach($fea_album->albums as $row)
		{
		//  RedisCustom::Redis_writer('hung_arrive_'.$albms->cid,$row->album_id,json_encode($row));
		    $ftrack[$row->album_id]=json_encode($row);		
		}
		  $expiresAt = Carbon::now()->addMinutes(2880);
		               Cachehelper::store('hung_arrive_'.$albms->cid,$ftrack,$expiresAt);
		  $data      = Cachehelper::fetch('hung_arrive_'.$albms->cid);
		
	        }
	      //  $redis_read=RedisCustom::Redis_reader('hung_arrive_'.$albms->cid);
	    
	}

	

	 
}

        function top_songs($id)
	{
	   $hun_cat =DB::table('hungama_category')->where('active',1)->get();
	
		
	foreach($hun_cat as $albms)
	{

		$url='http://api.hungama.com/reward360/v2/index.php/songs/topsongs?cat_id='.$albms->cid;
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);
		if(isset($fea_album->tracks) && !empty($fea_album->tracks))
		{
                $track= array();
		foreach($fea_album->tracks as $row)
		{
		  $track[$row->track_id]=json_encode($row);		
			
		}  
                        $expiresAt = Carbon::now()->addMinutes(2880);
			Cachehelper::store('hung_top_'.$albms->cid,$track,$expiresAt);
			$data=Cachehelper::fetch('hung_top_'.$albms->cid);
                }
	        

			
				    
	}

	

	 
}


	function top_artist($id)
	{
					
		$url='http://api.hungama.com/reward360/v2/index.php/artists/spotlight';
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);
		if(isset($fea_album->artists) && !empty($fea_album->artists))
		{
                    $track = array();
		foreach($fea_album->artists as $row)
		{
		       //RedisCustom::Redis_writer('hung_artist',$row->artist_id,json_encode($row));

		 	$track[$row->artist_id]=json_encode($row);			
		}
		        $expiresAt = Carbon::now()->addMinutes(2880);
			Cachehelper::store('hung_artist',$track,$expiresAt);
			$data=Cachehelper::fetch('hung_artist');
		
	        }
	      //$redis_read=RedisCustom::Redis_reader('hung_artist');
	    
		       


			echo '<pre>';
			print_r($data);
			exit;

	

	 
	}

	function f_albums($id)
	{
	
		
		$url='http://api.hungama.com/reward360/v2/musicalbums/albums';
	        $c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);
		if(isset($fea_album->albums) && !empty($fea_album->albums))
		{

			$track=array();
			foreach($fea_album->albums as $row)
			{
			//RedisCustom::Redis_writer('hung_falbums',$row->album_id,json_encode($row));
			$track[$row->album_id]=json_encode($row);					
			}


			$expiresAt = Carbon::now()->addMinutes(2880);
			Cachehelper::store('hung_falbums',$track,$expiresAt);
			$data=Cachehelper::fetch('hung_falbums');
			echo '<pre>';
		print_r($data);
		exit;
		
		}
		
	      //$redis_read=RedisCustom::Redis_reader('hung_falbums');
	    
	}



	function category()
	{
	

		$url='http://api.hungama.com/reward360/v2/category';
	        $c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);
                if(isset($fea_album->categories) && !empty($fea_album->categories))
		{
		  $track = array();	
                   foreach($fea_album->categories as $row)
			{
			    //RedisCustom::Redis_writer('hung_category',$row->cat_id,json_encode($row));
			    $track[$row->cat_id]=json_encode($row);	
			//	DB::table('hungama_category')->insert(array(
								   //  'cid'=>$row->cat_id,
								   //  'category'=>$row->cat_name
								   // ));		
			}

			
		
		         $expiresAt = Carbon::now()->addMinutes(2880);
			Cachehelper::store('hung_category',$track,$expiresAt);
			$data=Cachehelper::fetch('hung_category');
	        }
	                //$redis_read=RedisCustom::Redis_reader('hung_category');
	    
		        
			echo '<pre>';
			print_r($data);
			exit;
		
	 
	}
	function artist_albums($id)
	{
		 $redis_read=Cachehelper::fetch('hung_artist');
		 foreach($redis_read as $key=>$val)
		 {

			$url='http://api.hungama.com/reward360/v2/index.php/musicalbums/artist_albums?artist_id='.$key;
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $url);  
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
			curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
			$output = curl_exec($c); 
			curl_close($c);     
			$fea_album=json_decode($output);
		        if(isset($fea_album->albums) && !empty($fea_album->albums))
			{
		$ftrack=array();
		foreach($fea_album->albums as $row)
		{
	      //  RedisCustom::Redis_writer('hung_art_albs_'.$key,$row->album_id,json_encode($row));
		       $ftrack[$row->album_id]=json_encode($row);					
	
		}

                        $expiresAt = Carbon::now()->addMinutes(2880);
			Cachehelper::store('hung_art_albs_'.$key,$ftrack,$expiresAt);
			$data=Cachehelper::fetch('hung_art_albs_'.$key);

              }
                      //$redis_read=RedisCustom::Redis_reader('hung_art_albs_'.$key);
			echo '<pre>';

			print_r($data);
			
			
		 } 

			

	}




	function artist_tracks($id)
	{
		 $redis_read=Cachehelper::fetch('hung_artist');
		 foreach($redis_read as $key=>$val)
		 {

			$url='http://api.hungama.com/reward360/v2/index.php/songs/artist_songs?artist_id='.$key;
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $url);  
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
			curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
			$output = curl_exec($c); 
			curl_close($c);     
			$fea_album=json_decode($output);
			if(isset($fea_album->tracks) && !empty($fea_album->tracks))
			{
                               $ftrack=array();
				foreach($fea_album->tracks as $row)
				{
                               // RedisCustom::Redis_writer('hung_art_trcks_'.$key,$row->song_id,json_encode($row));
                                   $ftrack[$row->song_id]=json_encode($row);	
				}
                                    $expiresAt = Carbon::now()->addMinutes(2880);
			            Cachehelper::store('hung_art_trcks_'.$key,$ftrack,$expiresAt);
			            $data=Cachehelper::fetch('hung_art_trcks_'.$key);


			}
			//$redis_read=RedisCustom::Redis_reader('hung_art_trcks_'.$key);
			echo '<pre>';
                        print_r($data);
			
			
		 } 

			

	}


	function regional()
	{

		$redis_read=RedisCustom::Redis_reader('hung_category',8);
		$array=json_decode($redis_read);
		//print_r();
		foreach($array->subcategories as $key)
		{

		  $url='http://api.hungama.com/reward360/v2/regionalalbums/albumlist?category='.$key->subcat_name;
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		$fea_album=json_decode($output);
		if(isset($fea_album->albums) && !empty($fea_album->albums))
		{ 
                 $ftrack = array();
		foreach($fea_album->albums as $row)
		{
		// RedisCustom::Redis_writer('hung_regional'.$key->subcat_id,$row->album_id,json_encode($row));
		   $ftrack[$row->album_id]=json_encode($row);		
		}
		    $expiresAt = Carbon::now()->addMinutes(2880);
		                 Cachehelper::store('hung_regional'.$key->subcat_id,$ftrack,$expiresAt);
		    $data      = Cachehelper::fetch('hung_regional'.$key->subcat_id);
		
	        }
		// $redis_read=RedisCustom::Redis_reader('hung_regional'.$key->subcat_id);
			echo '<pre>';
			print_r($redis_read);
			
		}	

	}

	function category_name(){

		      $redis_read=RedisCustom::Redis_reader('hung_category');
			
			foreach($redis_read as $cat){ $cat = json_decode($cat); 
				if(isset($cat->cat_id) && $cat->cat_id<>''){
				
				if(!empty($cat->subcategories)){
				
				foreach($cat->subcategories as $sub_name)
                               {
					
					
					//RedisCustom::Redis_writer('hung_category_name_'.$sub_name->subcat_id,$sub_name->subcat_id,$sub_name->subcat_name);
                                  $ftrack[$row->subcat_id]=json_encode($row);
					}
                                $expiresAt = Carbon::now()->addMinutes(2880);
		                 Cachehelper::store('hung_category_name_'.$sub_name->subcat_id,$ftrack,$expiresAt);
		    $data      = Cachehelper::fetch('hung_category_name_'.$sub_name->subcat_id);
					
				}
				
				//RedisCustom::Redis_writer('hung_category_name_'.$cat->cat_id,$cat->cat_id,$cat->cat_name);
				}
			}    
			 
		}


		function store_category()
		{
			





		}

                function movie_list()
		{
			

                        $citys=Cinemas::doMessage();

	
			foreach($citys as $rcities)
			{
			
			$refined_city[]=$rcities['city'];
			}
			
			$f_cities=array_unique($refined_city);

			

			foreach($f_cities as $city)
			{
				
				$count=1;
				$movieslist=Cinemas::getmovies($city);

				
				$data=array();
				foreach($movieslist as $movie)
				{
					$data[$count]=json_encode($movie);
					$count++;
					
					
				}
				$expiresAt = Carbon::now()->addMinutes(2880);
				Cachehelper::store('movie_list_'.$city,$data,$expiresAt);
				$movie_list=Cachehelper::fetch('movie_list_'.$city);


				print_r($movie_list);
				

				
			  }  	

		}
}
