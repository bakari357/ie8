<?php
use Carbon\Carbon;
class MusicController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Hungama Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HungamaController@showProfile');
	|
	*/
	 

	function allmusic()
	{
			
		$data['redis_menu']=Cachehelper::fetch('hung_category');
		$redis_menu['ban']='s';
		$data['redis_falbums']=Cachehelper::fetch('hung_falbums');
		$data['redis_artist']=Cachehelper::fetch('hung_artist');	
		$data['regional']=Cachehelper::fetch('hung_category',8);
		$js = array('js/jquery.carouFredSel-6.2.1-packed.js','js/jquery.fancybox-1.3.1.pack.js');
		$css = array('css/gui.css','css/jquery.fancybox-1.3.1.css','css/musicmenu.css');
		$bread_crumb=array('Home'=>'/');
		$data['page'] ='testest';
      		$data['bread_crumb']=array('Home'=>'/');

		
       		return $this->render_reward_theme('hungama.index',$data); 

	}


	function get_regional($id)
	{
			$data['regional']=Cachehelper::fetch('hung_regional'.$id);
			return $this->render_ajax_theme('hungama.regional','ajax',$data); 
		
	}

	function top_songs($id)
	{
			
			$data['top_songs']=Cachehelper::fetch('hung_top_'.$id);
			return $this->render_ajax_theme('hungama.top_songs','ajax',$data); 
	}

		function music_category($id)
	{
		$data['redis_menu']     =Cachehelper::fetch('hung_category');	
		$data['new_arrivals']	=Cachehelper::fetch('hung_arrive_'.$id);
		$data['feat_albums']	=Cachehelper::fetch('hung_top_'.$id);
		$data['hot_picks']	=Cachehelper::fetch('hung_hot_'.$id);
		$data['albums']		=Cachehelper::fetch('hung_albums_'.$id);
		$data['catid'] = $id;
		//echo '<pre>'; print_r($data['albums']); exit;
		
		$data['bread_crumb']=array('Home'=>'/');
		$data['page'] ='testest';
      		$bread_crumb=array('Home'=>'/');
	        // echo'<pre>'; print_r($data); exit;
       		return $this->render_reward_theme('hungama.category',$data); 

	}
	
		function cat_albums($id)
	{
		$redis_menu=Cachehelper::fetch('hung_category');	
		
		$data['albums']	=Cachehelper::fetch('hung_albums_'.$id);
		$redis_name = RedisCustom::Redis_reader('hung_category_name_'.$id);
		$data['name'] = $redis_name[$id]; 
		$data['catid'] = $id;
		//echo '<pre>'; print_r($data['feat_albums']); exit;
		$js = array('js/jquery.carouFredSel-6.2.1-packed.js','js/jquery.fancybox-1.3.1.pack.js');
		$css = array('css/gui.css','css/jquery.fancybox-1.3.1.css','css/musicmenu.css');
		$bread_crumb=array('Home'=>'/');
		$data['page'] ='testest';
      		$bread_crumb=array('Home'=>'/');
	        $this->load_reward_theme('HDFC Superia-Credit Card','home.index','hungama',$bread_crumb,'','',$css,$js); 
        	$this->load_reward_region('hungama','menus',$redis_menu); 
       		return $this->render_reward_theme('hungama.cat_albums','hungama',$data); 

	}




                      public function checkout_final_process()
			{
    				
				$data = Rewards::redirect_helper('MusicController@checkout_final_process');
			
				if(!isset($data['music_details']))
				return Redirect::to('oops');

				$data['post']=$data;	
				$data['bread_crumb']=array('Home'=>'/');
				$data['emi_data']=Checkouthelper::emi_logic($data['amount']);
				$data['interest']=Checkouthelper::interest();
				
				return $this->render_reward_theme('hungama.cart_form_final',$data);
			}
	
	
		function artist_individual($id,$name=false)
	{
		
		$data['redis_menu']=Cachehelper::fetch('hung_category');	
		
		$data['albums']	=Cachehelper::fetch('hung_art_albs_'.$id);
		$data['tracks'] =Cachehelper::fetch('hung_art_trcks_'.$id);
		$data['artist_id'] = $id;
		$data['name'] = $name;
		
		$data['page'] ='testest';
      		$data['bread_crumb']=array('Home'=>'/');
	       
       		return $this->render_reward_theme('hungama.artist_albums',$data); 

	}
	
		function artist_see_albums($id,$name=false,$type,$page=1)
	{
		$redis_menu=Cachehelper::fetch('hung_category');	
		if($type=='albums') $data['albums']	=Cachehelper::fetch('hung_art_albs_'.$id);
		else { $tracks = Cachehelper::fetch('hung_art_trcks_'.$id);
				if(isset($_GET['page']) && $_GET['page'] <> ''){
			$page = $_GET['page'];
		}	
  		$config['total_rows'] = count($tracks);
		  
		$pagedNames = $this->get_names($page,$tracks);
		
                $data['tracks']= $pagedNames;
		$data['paginator'] = Paginator::make($tracks, count($tracks), '36');}
		
		$data['artist_id'] = $id;
		$data['name'] = $name;
		$js = array('js/jquery.carouFredSel-6.2.1-packed.js','js/jquery.fancybox-1.3.1.pack.js');
		$css = array('css/gui.css','css/jquery.fancybox-1.3.1.css','css/musicmenu.css');
		$bread_crumb=array('Home'=>'/');
	
		
	
		$data['page'] ='testest';
      		$bread_crumb=array('Home'=>'/');
	        $this->load_reward_theme('HDFC Superia-Credit Card','home.index','hungama',$bread_crumb,'','',$css,$js); 
        	$this->load_reward_region('hungama','menus',$redis_menu); 
       		return $this->render_reward_theme('hungama.artist_see_'.$type,'hungama',$data); 

	}
          
		function song_list()
	{
		
		$validator = Validator::make(array('id'=>Input::get('id')),array('id'=>'required|integer'));

		if ($validator->fails())
		{
			return  $validator->messages();
		}
	        $id=(int)Input::get('id');
		$data['songlist']=Cachehelper::fetch('hung_songlist_'. $id);
		if(empty($data['songlist'])){
		$url='http://api.hungama.com/reward360/v2/index.php/musicalbums/album_details?album_id='.$id;
		
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);     
		
		$song_list=json_decode($output);
                
                $redis = RedisL4::connection();
		// RedisCustom::Redis_writer('hung_songlist_'.$_POST['id'],$_POST['id'],json_encode($song_list));
		//$data['songlist']=RedisCustom::Redis_reader('hung_songlist_'.$_POST['id']);
                  
          if(isset($song_list->tracks) && !empty($song_list->tracks))
		{
               
		 
                        $expiresAt = Carbon::now()->addMinutes(2880);
			Cachehelper::store('hung_songlist_'.$_POST['id'],array($_POST['id']=>json_encode($song_list)),$expiresAt);
			$data['songlist']=Cachehelper::fetch('hung_songlist_'.$_POST['id']);
                }

		}
	    	
		$data['alb_id'] = $_POST['id'];
       		return $this->render_login_theme('hungama.songlist','ajax',$data); 

	}
	
	function get_names($offset,$hungamamusic)
          {
          	unset($hungamamusic['timestamp']); 
             $mus=array_filter($hungamamusic);
		$music=array();		
		foreach($mus as $key => $value){
			$music[] = $value;	
		}      
		$total_records = count($music); 
		
             $record=36;
             if($offset !=1){
              $start=(($offset-1) * $record)+1;
		
               $end=(($offset-1) * $record)+$record;}
              else{
              $start=$offset;
              $end=$record;
       
              }
		//echo $start.'st';
             	//echo $end;
              	//exit;
             
		 $data=array_slice($music,$start,$end);
		
             /* Clear the return variable */
            $return = "";
             /* Ensure we don't retrieve more data from the array than the number that is available
               when accounting for the $offset passed. */
            $count = count($music)-$offset;
        /* Collect the users in the $return variable after surrounding with <li> tags */
		//echo '<pre>'; print_r($offset); exit;
		
            for ($i=0; $i<$count ; $i++) 
            {
            	
              $return []= $music[$i+$offset];
             
            }
              /* Return the array values */
            return $data;
          }
		
		 function add_to_cart($id)
		 {

			
			$str=base64_decode($id);
			$s_details=explode('|',$str);
			if(! is_numeric($s_details[0])){
			return Redirect::to('allmusic');
			}
			$data['track_id']=$s_details[0];
			$data['track_name']=$s_details[1];
			
				if(isset($s_details[2]))
				{
				$data['alb_name']=$s_details[2];
				$data['image']=	$s_details[3];
				$data['type']= $s_details[4];
				}else{
				$data['alb_name']='';
				$data['image']='';
				$data['type']='';
				}
				$data['str'] = $id; 
			$data['amount'] = 10; 
			$data['ses']=$id;
			$json_store=json_encode($data);
			$ctrack['postvalues']=$json_store;
			$data['page'] ='testest';
			$data['bread_crumb']=array('Home'=>'/');

			$data['css_array'] = array('knobs/assets/css/styles.css','knobs/assets/knobKnob/knobKnob.css');
			$data['js_array'] = array('knobs/assets/knobKnob/transform.js','knobs/assets/js/script.js'); 
			// $redis_menu=RedisCustom::Redis_reader('hung_category');	
			//$this->load_reward_region('common','menus',$redis_menu); 
			return $this->render_reward_theme('hungama.cart_form',$data); 
	              
		 
		 }
		function preview(){

		
$track_post = $_POST['track'];
$track = str_replace("'","",$track_post).'|reward360';
$auth = md5($track);

   $url ='http://api.hungama.com/reward360/v2/songs/download?track_id='.str_replace("'","",$track_post).'&user_id=1&media_type=preview&auth_key='.$auth.'';

		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($c, CURLOPT_TIMEOUT, 60); //timeout in seconds
		$output = curl_exec($c); 
		curl_close($c);		


		$result=json_decode($output);
   $preview=$result->content->streaming_url;
   
$jsauto=array( 'previ'=>$preview
	                );
	
	
	echo json_encode($jsauto);
}
			

} 
		
		
