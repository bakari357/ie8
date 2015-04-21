<?php
class HungamaController extends BaseController {

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

	function get_albums($id)
	{

		$albums='http://apistaging.hungama.com/reward360/v2/index.php/musicalbums/albumlist?cat_id='.$id;
		return Hungama::doMessage($albums); 
              

	}


	function get_hotpicks($id)
	{
		$hot_pick ='http://apistaging.hungama.com/reward360/v2/index.php/musicalbums/hotpicks?cat_id='.$id;
		return Hungama::doMessage($hot_pick); 
		

	}


	function new_arrivals($id)
	{

		$new_arrivals='http://apistaging.hungama.com/reward360/v2/index.php/musicalbums/newarivals?cat_id='.$id;
                return Hungama::doMessage($new_arrivals); 
		

	}
	
	function featured_albums($id)
	{

		$featured_albums='http://apistaging.hungama.com/reward360/v2/index.php/musicalbums/featured?cat_id='.$id;
		return Hungama::doMessage($featured_albums); 
	}


	function top_songs($id)
	{
		$top_songs='http://api.hungama.com/reward360/v2/index.php/songs/topsongs?cat_id='.$id;
		return Hungama::doMessage($top_songs); 
		
	}



	function regionalalbums($id)
	{

		$reg_albms='http://api.hungama.com/reward360/v2/regionalalbums/albumlist?category='.$id;
		return Hungama::doMessage($reg_albms); 
		

	}


	function tracklist($id)
	{

		$songlist='http://api.hungama.com/reward360/v2/index.php/musicalbums/album_details?album_id='.$id;
		return Hungama::doMessage($songlist); 

	}

	function artist_albums($id)
	{

		$artist_albs = 'http://api.hungama.com/reward360/v2/index.php/musicalbums/artist_albums?artist_id='.$id;
		return Hungama::doMessage($artist_albs); 

	}


	function artist_songs($id)
	{

		$artist_sngs='http://api.hungama.com/reward360/v2/index.php/songs/artist_songs?artist_id='.$id;
		return Hungama::doMessage($artist_sngs); 

	}


	function top_artists()
	{

		$top_artists='http://apistaging.hungama.com/reward360/v2/index.php/artists/spotlight';
		return Hungama::doMessage($top_artists); 
		
	}


	function get_category()
	{


		        $get_category='http://api.hungama.com/reward360/v2/category';
			return Hungama::doMessage($get_category); 
	}




	function user_registration()
	{
		
		$response='https://secure.hungama.com/redeem/reward360/v2/user.php?auth_key=83d2ce302681f281fa54272d3574164f&action=register&email='.$_POST['email'].'&mobile='.$_POST['phone'].'&first_name='.$_POST['fname'].'&last_name='.$_POST['lname'].'';
		return Hungama::doMessage($response); 
	}


	function generate_orderid()
	{
		
		$genordern = 'https://secure.hungama.com/redeem/reward360/v2/redeem.php		auth_key=83d2ce302681f281fa54272d3574164f&email='.$_POST['email'].'&content_id='.$_POST['content_id'].'&plan_id=3';
		return Hungama::doMessage($genordern); 
	}



	function download_song()
	{
		$songurl = 'https://secure.hungama.com/redeem/reward360/v2/content_delivery.php?auth_key=83d2ce302681f281fa54272d3574164f&order_id='.$_POST['order_id'].'&content_id='.$_POST['content_id'];
		return Hungama::doMessage($songurl); 
		
	}


	function songlist($id)
	{

		$songs='http://apistaging.hungama.com/reward360/v2/index.php/songs/songlist?cat_id='.$id;
		return Hungama::doMessage($songs); 
		
        }


	function topten($id)
	{
		$topten='http://api.hungama.com/reward360/v2/songs/topten_songs?cat_id='.$id;
		return Hungama::doMessage($topten); 
	}

	function top_albums()
	{
	        $topten= 'http://api.hungama.com/reward360/v2/index.php/musicalbums/spotlight';
		return Hungama::doMessage($topten); 

	}


} 
		
		
