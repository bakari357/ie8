<?php
require_once(app_path().'/lib/nusoap.php');
class Cinemas {


    public static function doMessage() {
        return DB::connection('mongodb')->getCollection('cinemas_cities')->find()->sort(array('city'=>1 ) );
    }

    public static function getmovies($city) {
       
	        $where=array('city'=>array('$in'=>array(trim($city))));
	        return DB::connection('mongodb')->getCollection('movies_index')->find($where)->sort(array('movie'=>1 ) );
    }

public static function get_cinepolis_timings($data,$cityid,$movieid)
        {
                if(!$movieid)
                return array();
                if(!$cityid)
                return array();
                $proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
		$client = new nusoap_client('http://www.cinepolisindia.com:5000/Schedule/Schedule_Service.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
		$citydateaction='http://tempuri.org/FnSchedule_CityMovieDate';
		$citydatexml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<FnSchedule_CityMovieDate xmlns="http://tempuri.org/">
		<CityId>'.$cityid.'</CityId>
		<MovieId>'.$movieid.'</MovieId>
		<ShowDate>'.$data['daterange'].'</ShowDate>
		</FnSchedule_CityMovieDate>
		</soap:Body>
		</soap:Envelope>';
			$clitydatelist = $client->send($citydatexml,$citydateaction,'');
		return $clitydatelist;
                
        }
        
       public static function get_funcinema_timings($data,$cityid,$movieid)
        {
                if(!$movieid)
                return array();
                if(!$cityid)
                return array();
               $proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
                $client = new nusoap_client('http://202.46.201.9:8888/FunBookingSystem.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
                $showaction="http://tempuri.org/GetShowTime";
 $showxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                <soap:Body>
                <GetShowTime xmlns="http://tempuri.org/">
                <CenterCode>'.$cityid.'</CenterCode>
                <MovieCode>'.$movieid.'</MovieCode>
                <DateCode>'.$data['daterange'].'</DateCode>
                </GetShowTime>
                </soap:Body>
                </soap:Envelope>';
                $showlist = $client->send($showxml,$showaction,'');
               $shows= Xml2array::xml2array_test($showlist['GetShowTimeResult']);
                        if(!empty($shows['ShowDetails']))
		        $all_shows= array_filter($shows['ShowDetails']);
		        else
		        $all_shows=array();
		        return $all_shows;
                
        }
        
	public static function getcity($id)
	{
		$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
		$client = new nusoap_client('http://www.cinepolisindia.com:5000/Schedule/Schedule_Service.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);

		$cityxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<FnSchedule_City xmlns="http://tempuri.org/">
		<CityId>'.$id.'</CityId>
		</FnSchedule_City>
		</soap:Body>
		</soap:Envelope>';

		$cityaction="http://tempuri.org/FnSchedule_City";
		$citylist = $client->send($cityxml,$cityaction,'');
			if ($client->fault) {
			$data['error']=$citylist;
			} else {
			// Check for errors
			$err = $client->getError();
			if ($err) {
			// Display the error
			$data['error']=$err;
			} else {
			$data['citylist']=$citylist;
			}
			}

		return $citylist;
	}
	public static function show_moviebydate($city,$date)
	{
		$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
		$client = new nusoap_client('http://www.cinepolisindia.com:5000/Schedule/Schedule_Service.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
		$citydateaction='http://tempuri.org/FnSchedule_CityDate';
		$citydatexml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<FnSchedule_CityDate xmlns="http://tempuri.org/">
		<CityId>'.$city.'</CityId>
		<ShowDate>'. $date. '</ShowDate>
		</FnSchedule_CityDate>
		</soap:Body>
		</soap:Envelope>';
			$clitydatelist = $client->send($citydatexml,$citydateaction,'');
			if ($client->fault) {
			$data['clitydatelist']=$clitydatelist;
			} else {
			// Check for errors
			$err = $client->getError();
			if ($err) {
			// Display the error
			$data['clitydatelist']=$err;
			} else {
			$data['clitydatelist']=$clitydatelist;
			}
			}
		return $clitydatelist;

	}
	public static function strore_city()
	{
		$proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
		$client = new nusoap_client('http://www.cinepolisindia.com:5000/Schedule/Schedule_Service.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
		$filmaction="http://tempuri.org/FnSchedule_Film";
		$filmxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<FnSchedule_Film xmlns="http://tempuri.org/">
		<FilmId>0</FilmId>
		</FnSchedule_Film>
		</soap:Body>
		</soap:Envelope>';


		$filmlist = $client->send($filmxml,$filmaction,'');
		
                        echo '<pre>';print_r($filmlist);
		if(isset($filmlist) && !empty($filmlist['FnSchedule_FilmResult']['Film_Out'])){

			foreach($filmlist['FnSchedule_FilmResult']['Film_Out'] as $filmlist)
			{
			
                                 
				
				$res=DB::table('cinepolis_city')->select('cinepolis_city.id as cnt')->where('FilmId' , $filmlist['FilmId'])->get();
				if(isset($res->cnt) && $res->cnt>0)
				{
				
				DB::table('cinepolis_city')
            ->where('FilmId', $filmlist['FilmId'])
            ->update($filmlist);
				}
				else
				{
				DB::table('cinepolis_city')->insert($filmlist);
				}
			}
		return 'Successfully Added';

		}

	}
	public static function get_movies($centercode)
	        {
	           $proxyhost=Config::get('app.proxyhost');
		$proxyport=Config::get('app.proxyport');
		$proxyusername=Config::get('app.proxyusername');
		$proxypassword=Config::get('app.proxypassword');
		        $client = new nusoap_client('http://m.funcinemas.com/FunBookingSystem.asmx','false',$proxyhost, $proxyport, $proxyusername, $proxypassword);
		        $filmaction="http://tempuri.org/GetMoviesFrmCenterCode";
		        $filmxml='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                          <soap:Body>
                            <GetMoviesFrmCenterCode xmlns="http://tempuri.org/">
                              <CenterCode>'.$centercode.'</CenterCode>
                            </GetMoviesFrmCenterCode>
                          </soap:Body>
                        </soap:Envelope>';
		        $movielist = $client->send($filmxml,$filmaction,'');
		       // echo '<pre>'; print_r($movielist); exit;
		       // $movies=Xml2array::xml2array_test($movielist['MovieDetails']);
		        $movies= Xml2array::xml2array_test($movielist['GetMoviesFrmCenterCodeResult']);
		        
		        
		         if(!empty($movies['MovieDetails']['Movies']))
		         $all_movies= array_filter($movies['MovieDetails']['Movies']);
		         else
		         $all_movies="";
		        return $all_movies;
		 }

}



