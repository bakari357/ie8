<?php
use Jenssegers\Mongodb\Connection;
class CinemasController extends BaseController {


    public function showProfile()
    {
          $data['citys']=Cinemas::doMessage();

           $data['type']=0;
			$data['bread_crumb']=array('Home'=>'/');
			
			return $this->render_reward_theme('cinemas.home',$data);
    }

     function loadcontents()
	{
	$type=$_POST['type'];
	$city_id=$_POST['city'];
	$out='';
		$movieslist=Cachehelper::fetch('movie_list_'.$city_id);
		//echo '<pre>';
		//print_r($movieslist);
		//exit;
                  $count=count($movieslist);
              $req=''; for($i=1;$i<=$count;$i++)
			{
                      if(isset($movieslist[$i]) ){
                       $film=json_decode($movieslist[$i]); 
 
                       if($req==$film->movie){
				continue;
				}else{   
                      $out .=' <option class="econsel" class="field1menu" value="'.$film->movie.'">'.$film->movie.'</option>'; }
$req=$film->movie;
			}
                      }
              
                echo $out;
	}


    public function listmovies()
    {

      
       
       $post = $_POST; 
    
	$rules=array();
	$rules['city_id'] = "required|alpha";
	$validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
	{
	$errors = $validator->messages();
	 return Redirect::to('oops');
	}
		
       $cinepolis=array();
       $funcinemas=array();
       $wherecity=array('city'=>array('$in'=>array((string)trim($post['city_id']))));
          
		
         $citydetalis=DB::connection('mongodb')->getCollection('cinemas_cities')->find($wherecity);

	  
                     $cnt=1;   foreach($citydetalis as $cityss)
                        {
				
				$movieslist=Cachehelper::fetch('movie_list_'.$cityss['city']);
//echo '<pre>'; print_r($cityss); exit;
				$count=count($movieslist);
				for($i=1;$i<=$count;$i++)
				{
				if(isset($movieslist[$i])){
				$film=json_decode($movieslist[$i]);  

     
                           if($post['movie']==$film->movie && $cnt!=$cityss['funcinema'])
                              {
				/*if(isset($cityss['cinepolis']) && isset($film->cinepolis)){
                                        $cinepoli['cinecty']=$cityss['cinepolis'];
					$cinepoli['cinemovie']=$film->cinepolis;
					$data['name']=$_POST['movie'];
                        $cinepoli['times']= Cinemas::get_cinepolis_timings($post,$cityss['cinepolis'],$film->cinepolis);
                        foreach($cinepoli['times'] as $cine_row)
			{
                            $cinepo_tym='';
                            $cinep_tym=array();
                            if(!empty($cine_row['CityDate_Out']))
                               {
                               if(array_key_exists(0,$cine_row['CityDate_Out']))
                                {
                                $cinep_tym=array();
				foreach($cine_row['CityDate_Out'] as $cine_irow)
				{		

                                     if($cine_irow['ErrId'] !=1)
                                          {
					if(!in_array($cine_irow['ShowTime'],$cinep_tym))
					{
					   $cinep_tym[]=$cine_irow['ShowTime'];
					   $cinepo_tym[]=$cine_irow;
					}}}}else{
                                          
                                           if($cine_row['CityDate_Out']['ErrId'] !=1){
                                           $cinep_tym[]=$cine_row['CityDate_Out']['ShowTime'];
					   $cinepo_tym[]=$cine_row;
                                               } }}
				} 
                                $cinepoli['times']['FnSchedule_CityMovieDateResult']['CityDate_Out']=$cinepo_tym;
 
				$cinepolis[]=$cinepoli;
}*/

				if(isset($cityss['funcinema']) && isset($film->funcinemas)){
				$funcinema['centercode']=$cityss['funcinema'];
				$funcinema['filmcode']=$film->funcinemas;
				$funcinema['times']= Cinemas::get_funcinema_timings($_POST,$cityss['funcinema'],$film->funcinemas);
				
				$funcinemas[]=$funcinema;$cnt=$cityss['funcinema'];
                                         }
				}
			}
                      }
                       
                      }
           //echo '<pre>'; print_r($funcinemas);exit;
		$data['city'] = '';
		$data['cities']=Cinemas::doMessage();
		if(isset($cityss['city'])){
		$data['city']=	$cityss['city'];
		}

		$data['movies']=Cachehelper::fetch('movie_list_'.$post['city_id']);
		
                 if(isset($data['movies']))
                 {
                 foreach($data['movies'] as $movie)
                 {
                     $moviename=json_decode($movie);
                     $movi_name=$moviename->movie;}
                }

		$data['cinepolis']=$cinepolis;
		$data['cityid'] = $_POST['city_id'];
		if(isset($_POST['movie']))
		{
		$data['movie']=$_POST['movie'];
        }
                
		$data['funcinemas']=$funcinemas;
                $data['daterange']=isset($post['daterange'])?$post['daterange']:"";
		$data['type']=0;
		$data['bread_crumb']=array('Home'=>'/');
		$data['js_array'] = array('assetshdfc/js/jquery.carouFredSel-6.2.1-packed.js','assetshdfc/js/jquery.fancybox-1.3.1.pack.js');
		$data['css_array'] = array('assetshdfc/css/gui.css','assetshdfc/css/jquery.fancybox-1.3.1.css','assetshdfc/css/musicmenu.css');
			
			return $this->render_reward_theme('cinemas.filmlist',$data);
    }

	function get_cities($type=false)
	{
        if($type=='cinepo')
        {
         	//$this->mongo->db->cinemas_cities->remove();
		DB::connection('mongodb')->collection('cinemas_cities')->delete();
		$city=Cinemas::getcity(0);
	          // echo '<pre>';
	           print_r($city);
	           //exit;
	            $city_list=$city['FnSchedule_CityResult']['City_Out'];
	            
			      foreach($city_list as $city_row)
			      {
                                        $save['cinepolis']= $city_row['CityId'];
                                        $save['city']=trim($city_row['CityName']);
                                        $exist=array('cinepolis'=>array('$in'=>array(trim($city_row['CityId']))));
                                        $condrestwo=DB::connection('mongodb')->getCollection('cinemas_cities')->findOne($exist);
                                        if(count($condrestwo['city'])==0)
                                        {
                                                $lastidtwo=DB::connection('mongodb')->Collection('cinemas_cities')->insert($save);
	                                        unset($save);
			                                 
                                        }
                                        else
                                        {
                                        
                                                $wheretwo = array('city' =>trim($city_row['CityName']));
                                                DB::connection('mongodb')->getCollection('cinemas_cities')->update($wheretwo, array('$set' => $save));

                                        }
				
			        }    
                }
                
                if($type=='funcinema')
                {
                echo '<pre>';
                 DB::connection('mongodb')->collection('cinemas_cities')->delete();
                  $dCenterDetails=DB::table('funcinemas_center')->where('active',1)->get();
	           print_r($dCenterDetails);//exit;
	           //echo $type;
	           // exit;
			      foreach($dCenterDetails as $city_row)
			      {
			            
			             
			               $save['CenterName']= $city_row->CenterName;
                                        $save['funcinema']= $city_row->CenterCode;
                                      $cname=  explode(",",$city_row->CenterName);
                                        
                                        $save['city']=trim($cname[0]);
                                        $exist=array('CenterCode'=>array('$in'=>array(trim($save['funcinema']))));
                                        $condrestwo=DB::connection('mongodb')->getCollection('cinemas_cities')->findOne($exist);
                                        
                                        if(count($condrestwo['city'])==0)
                                        {
                                                $lastidtwo=DB::connection('mongodb')->Collection('cinemas_cities')->insert($save);
	                                        unset($save);
			                                 
                                        }
                                        else
                                        {
                                        
                                                $wheretwo = array('CenterCode' =>trim($save['funcinema']));
                                                DB::connection('mongodb')->getCollection('cinemas_cities')->update($wheretwo, array('$set' => $save));

                                        }
				
			        }  
                }
	             
	           	
	
	}
	function get_movies($type=false)
                {
                //cinepolis

			
                        if($type=='cinepo')
                        {  
		
                           //clear all the data and insert to get current movies only
                          DB::connection('mongodb')->collection('movies_index')->delete();
                           
                                $city=Cinemas::getcity(0);
                                $daterange=date("Y-m-d",strtotime('+0 days'));
                                 //echo '<pre>';
                                     

                                $city_list=$city['FnSchedule_CityResult']['City_Out'];
                              // echo '<pre>';print_r($city_list);exit;
                                foreach($city_list as $city_row=>$city_value)
                                {
                                        echo '<pre>';
                                      

                                        $movies=Cinemas::show_moviebydate($cty_id=$city_value['CityId'],$daterange);
					
					print_r($movies);
                                        foreach($movies['FnSchedule_CityDateResult']['CityDate_Out'] as $row=>$value)
                                        {
                                       
                                                $mov_id[]=$value['MovieId'];

                                           $film=DB::table('cinepolis_films')->where('FilmId',$value['MovieId'])->get();

						if(!empty($film))
                                                {
                                                $film_name=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',trim(str_replace(array('(U)','(U/A)','(A)'),array('','',''),$film[0]->FilmName)));
                                                if(!empty($film_name))
                                                {
                                                $cine_city=explode(',',$city_value['CityName']);
                                                $store['cinepolis']= $value['MovieId'];
                                                $store['city']=trim($cine_city[0]);
                                                $store['movie']=trim($film_name);
//preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $film_name);
                                                $exist=array('movie'=>trim($film_name),"city"=>trim($cine_city[0]));
               			$condrestwo=DB::connection('mongodb')->getcollection('movies_index')->find($exist);

	
                                                  
                                                if($condrestwo->count()==0)
                                                {
							
                                                unset($store['_id']);
                                                DB::connection('mongodb')->collection('movies_index')->insert($store);
                                                }
                                                else
                                                {
						
		$save['cinepolis']=$value['MovieId'];
		$wheretwo = array('movie' =>trim($film_name));
		DB::connection('mongodb')->collection('movies_index')->update($wheretwo, array('$set' => $save));
                                                }
                                                //
                                                }
                                           } }	
                                }     
                        }            

                        if($type=='funcinema')
                        {
				DB::connection('mongodb')->collection('movies_index')->delete();
				$f_city=DB::table('funcinemas_center')->select('CenterCode','CenterName')->get();
                              foreach ($f_city as $key=>$fvalue)
                              {
                             // print_r($fvalue->CenterCode);
                             // exit;
                                $funcinemas=Cinemas::get_movies($fvalue->CenterCode);
                               
                              if(!empty($funcinemas))
                              {
                                foreach($funcinemas as $row=>$value)
                                {
                               
                                $current=array('(U)','(U/A)','(A)','(ENGLISH)','(HINGLISH)','(HINDI)','(PAID PREVIEW)','(3D)','(PUNJABI)');
                                $replace=array('','','','','','','','3D','');
                                $fun_film=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', trim(str_replace( $current,$replace,$value['Film_strTitle'])));                    
                                 if(!empty( $fun_film))
                                                {
                                                $fun_city=explode(',',$fvalue->CenterName);
                                                $store['funcinemas']= $value['Film_strCode'];
                                                $store['movie']=trim($fun_film);
                                                $store['city']=trim($fun_city[0]);
                                                $exist=array('movie'=>(string)trim($fun_film),"city"=>(string)trim($fun_city[0]));
                                                $condrestwo=DB::connection('mongodb')->collection('movies_index')->find($exist);
                                                echo '<pre>';
                                               print_r($store);
                                                if(count($condrestwo)==0)
                                                {
                                                        unset($store['_id']);
                                                        DB::connection('mongodb')->collection('movies_index')->insert($store);
                                                }
                                                else
                                                {
                                                         $save['funcinemas']=$value['Film_strCode'];
                                                        $wheretwo = array('movie' =>trim($fun_film));
                                                        DB::connection('mongodb')->collection('movies_index')->update($wheretwo, array('$set' => $save));
                                                }
                                }
                        

                        }
                        }
                        }
                        echo "success"; 
                }
                }
		function storefilm()
	{
	        $result=Cinemas::strore_city();	
	        print_r($result);
	}

}
