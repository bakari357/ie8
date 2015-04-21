<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Route::get('user/{id}', 'UserController@showProfile');
//Route::get('users', 'UserController@allUsers');

//Common::globalXssClean();
Route::get('/', array('uses' => 'HomeController@getIndex'));
Route::post('/', array('uses' => 'HomeController@getIndex'));
Route::post('get_hotels/{id}/{city}/{seg}', array('uses' => 'HomeController@gethotels'));
Route::get('get_hotels/{id}/{city}/{seg}', array('uses' => 'HomeController@gethotels'));
Route::get('get_hotels/{id}/{city}', array('uses' => 'HomeController@gethotels'));
//Route::get('foodfiesta', array('uses' => 'HomeController@foodfiesta'));
Route::post('foodfiesta', array('uses' => 'HomeController@foodfiesta'));
Route::get('foodfiesta_offer_details/{id}/{type}', 'HomeController@foodfiesta_offer_details');
Route::post('load_hotels', 'HomeController@load_hotels');
Route::post('load_deal_areas', 'dealsController@load_deal_areas');
Route::post('load_deal_category', 'dealsController@load_deal_category');
Route::post('load_sub_category', 'dealsController@load_sub_category'); 
Route::get('check', array('uses' => 'HomeController@partner_discount'));


Route::get('about', function()
{

	return View::make('pages.about');
});
Route::get('projects', function()
{
	return View::make('pages.projects');
});
Route::get('contact', function()
{
	return View::make('pages.contact');
});

//autoincrement
Route::get('increment', 'Increment@auto_increment');
//
Route::get('design', 'HomeController@design');
//cinemas  

Route::get('store_to_mongo', 'Hotels@store_to_mongo');

Route::get('cinemas', 'cinemasController@showProfile');
Route::post('listcinemas', 'cinemasController@listmovies');

Route::post('funcinemas', 'funController@getclass');
Route::post('funaudilayout', 'funController@getaudilayout');
Route::get('funaudilayout', 'funController@getaudilayout');
Route::post('funaudilayoutfinal', 'funController@getaudilayout_final');
Route::get('funaudilayoutfinal', 'funController@getaudilayout_final');
Route::post('funbooking', 'funController@getbooking');
Route::post('get_smartbyoffer', 'funController@get_smartbyoffer');
Route::post('cinepolis', 'cinepolisController@showmovie_list');
Route::post('cinepolis_select', 'cinepolisController@after_select');
Route::post('cinepolis_screen', 'cinepolisController@show_screen');
Route::post('cinepolis_showseats', 'cinepolisController@showseats');
Route::post('cinepolis_booking', 'cinepolisController@getbooking'); 
Route::post('final_checkout', 'cinepolisController@get_fun_final');
Route::get('final_checkout', 'cinepolisController@get_fun_final');
Route::post('get_smartbyoffercinepolis', 'cinepolisController@get_smartbyoffercinepolis');

 Route::post('loadfilm', 'cinemasController@loadcontents');
Route::get('getcity/{id}', 'cinemasController@get_cities');
Route::get('getmovies/{id}', 'cinemasController@get_movies');
Route::get('storefilm/', 'cinemasController@storefilm');
//Indianstage
Route::get('events', 'eventsController@listevents');
Route::get('events_get/{id}', 'eventsController@getevent');
Route::post('events_booking', 'eventsController@eventbooking');
//via bus
Route::post('bus', 'busController@buslist');
Route::post('bus_seat', 'busController@bus_seat');
Route::get('bus_city', 'busController@bus_getcity');
Route::post('bus_booking', 'busController@bus_booking');
Route::post('bus_cancellation', 'busController@bus_cancellation');
Route::post('bus_ticket_details', 'busController@bus_ticket_details');
//grow trees
Route::get('grow_tree', 'growController@storetomongo');
Route::get('grow_details/{id}', 'growController@details');
//Savari
Route::get('cars', 'SavariController@get_cars');
//Hungama Partner Joseph
Route::get('allmusic', 'MusicController@allmusic');
Route::get('regional_albums', 'MusicController@allmusic');
Route::post('regional_albums/{id}', 'MusicController@get_regional');
Route::get('top_songs', 'MusicController@allmusic');
Route::post('top_songs/{id}', 'MusicController@top_songs');
Route::get('music_category/{id}', 'MusicController@music_category');
Route::get('music_category/cat_albums/{id}', 'MusicController@cat_albums');
Route::get('cat_albums/{id}', 'MusicController@cat_albums');
Route::get('artist_individual/{id}/{name}', 'MusicController@artist_individual');
Route::get('artist_see_albums/{id}/{name}/{type}', 'MusicController@artist_see_albums');
Route::post('songlist', 'MusicController@song_list');
Route::get('music_cart/{id}', 'MusicController@add_to_cart');
Route::post('preview', 'MusicController@preview');
// Hungama  
Route::get('get_albums/{id}', 'HungamaController@get_albums');
Route::get('get_hotpicks/{id}', 'HungamaController@get_hotpicks');
Route::get('new_arrivals/{id}', 'HungamaController@new_arrivals');
Route::get('featured_albums/{id}', 'HungamaController@featured_albums');
Route::get('top_songs/{id}', 'HungamaController@top_songs');
Route::get('regionalalbums/{id}', 'HungamaController@regionalalbums');
Route::get('tracklist/{id}', 'HungamaController@tracklist');
Route::get('artist_albums/{id}', 'HungamaController@artist_albums');
Route::get('artist_songs/{id}', 'HungamaController@artist_songs');
Route::get('top_artists', 'HungamaController@top_artists');
Route::get('get_category', 'HungamaController@get_category');
Route::get('user_registration', 'HungamaController@user_registration');
Route::get('generate_orderid', 'HungamaController@generate_orderid');
Route::get('download_song', 'HungamaController@download_song');
//Route::get('songlist/{id}', 'HungamaController@songlist');
Route::get('topten/{id}', 'HungamaController@topten');
Route::get('top_albums', 'HungamaController@top_albums');
Route::get('redirections/{id}', 'Login@redirections');

 Route::get('physical_products', 'PhysicalController@Physical_Products');
 Route::get('physical_categories', 'PhysicalController@Physical_Categories');
 Route::get('physical_brands', 'PhysicalController@Physical_Brands');
 /*---------------------------------------------------------------*/
  //Products
 Route::get('list_products', 'ListingProducts@list_products');
 Route::post('list_products', 'ListingProducts@list_products');
 Route::get('product_details/{id}', 'ListingProducts@product_details');
 Route::post('product_details/{id}', 'CartController@add_to_cart');
  Route::get('addwishlist/{id}', 'ListingProducts@addwishlist');
   
  //js-products
   Route::post('listing_products', 'ListingProducts@listing_products');
  
 //Wishlist
 Route::get('wishlist','CartController@view_wishlist');
 Route::get('product/{product_slug}','CartController@product');
 Route::get('remove_wishlist/{id}','CartController@remove_wishlist');
 Route::post('product/{product_slug}','CartController@add_to_cart');
 
 Route::get('remove_item/{id}','CartController@remove_item');
 Route::get('view_cart','CartController@view_cart');
// Route::get('add_to_cart','CartController@added_cart');
 Route::post('physical_checkout','CartController@checkout');
// Route::post('add_to_cart','CartController@update_cart');
 Route::post('dynamic_esclator','Myoxigen@dynamic_esclator');
 Route::post('product_checkout','Checkout@product_checkout');
  //checkout

  Route::post('save_customer','Checkout@save_customer');
   Route::get('checkout','Checkout@index');
    Route::post('place_order','Checkout@place_order');
   Route::post('save_additional','Checkout@save_additional_details');
    Route::post('customer_details','Checkout@customer_details');
     Route::post('customer_form','Checkout@customer_form');
   Route::post('order_summary','Checkout@order_summary');
      Route::post('get_zone_menu','LocationController@get_zone_menu');
  
//sharath redis
Route::get('music/{id}', 'RedisController@load_music');
Route::get('featured/{id}', 'RedisController@featured_albums');
Route::get('albums/{id}', 'RedisController@albums');
Route::get('hot/{id}', 'RedisController@hot_picks');
Route::get('top/{id}', 'RedisController@top_songs');
Route::get('artist/{id}', 'RedisController@top_artist');
Route::get('artist_alb/{id}', 'RedisController@artist_albums');
Route::get('artist_trk/{id}', 'RedisController@artist_tracks');
Route::get('regional', 'RedisController@regional');
Route::get('arrivals/{id}', 'RedisController@new_arr');
Route::get('f_albums/{id}', 'RedisController@f_albums');
Route::get('category', 'RedisController@category');
Route::get('city', 'RedisController@citylist');
Route::get('category_name', 'RedisController@category_name');
Route::get('movie_list', 'RedisController@movie_list');
Route::get('flight_citylist', 'RedisController@flight_citylist');
Route::get('flight_icitylist', 'RedisController@flight_icitylist');
Route::get('store_category', 'RedisController@store_category');


 /*RECHARGE*/

 
 Route::post('mobile_rec/recharge_dth', 'Recharge@dth_operators');
 Route::get('recharge_mobile/{id}', 'Recharge@get_mobile_info');
 Route::post('mobile_rec/recharge_mob', 'Recharge@do_recharge');
 Route::get('mobile_rec/recharge_mob', 'Recharge@mobile_rec');
 Route::get('mobile_rec/recharge_dth', 'Recharge@dth_rec');
 Route::post('mobile_rec/get_mobile_info/{id}', 'Recharge@get_mobile_info');
 
 //charity
 
Route::get('charity_payment', 'CharityPayment@home');
  Route::post('load_biller', 'CharityPayment@load_biller');
  Route::post('charity_payment', 'CharityPayment@biller_details'); 
  Route::get('charity_payment_final', 'CharityPayment@charity_payment_final'); 
  Route::post('charity_payment_final', 'CharityPayment@charity_payment_final'); 
   Route::post('load_chartitybiller', 'CharityPayment@load_charitybiller');
  
  //charity
 
Route::get('charity_payment', 'CharityPayment@home');
  Route::post('load_biller', 'CharityPayment@load_biller');
  Route::post('charity_payments', 'CharityPayment@biller_details'); 
  Route::get('charity_payments', 'CharityPayment@biller_details'); 
 // Route::get('charity_payment_final', 'CharityPayment@charity_payment_final'); 
  Route::post('charity_payment_final', 'CharityPayment@charity_payment_final'); 
   Route::post('load_chartitybiller', 'CharityPayment@load_charitybiller');
  
  //mobile payment
    Route::get('billpayment', 'MobilePayment@payments');
  
   Route::get('mobile_payments', 'MobilePayment@mobile_payment');
   Route::post('mobilepayments', 'MobilePayment@do_payment'); 
   Route::get('mobilepayments', 'MobilePayment@do_payment');
     Route::get('prepaid_payment_final', 'MobilePayment@prepaid_payment_final'); 
   Route::post('prepaid_payment_final', 'MobilePayment@prepaid_payment_final');
   // Route::get('postpaid_payment_final', 'MobilePayment@postpaid_payment_final');  
   Route::post('postpaid_payment_final', 'MobilePayment@postpaid_payment_final'); 
 Route::post('get_mobile_info', 'MobilePayment@get_mobile_info');
   Route::post('loadpayee_presence', 'MobilePayment@loadpayee_presence');
   Route::post('loadpayee_circle', 'MobilePayment@loadpayee_circle');
   
 
   //Insurance Payment 
   Route::get('insurance_payment', 'InsurancePayment@insurance_payment');
   Route::post('insurance_payments', 'InsurancePayment@do_payment');
   Route::get('insurance_payments', 'InsurancePayment@do_payment');
   //Route::get('insurance_payment_final', 'InsurancePayment@insurance_payment_final'); 
    Route::post('insurance_payment_final', 'InsurancePayment@insurance_payment_final'); 
 
 
	//Electricity Payment 
	Route::get('electricity_payment', 'ElectricityPayment@electricity_payment');
	Route::post('electricity_payments', 'ElectricityPayment@do_payment');
	Route::get('electricity_payments', 'ElectricityPayment@do_payment');
	//Route::get('eb_payment_final', 'ElectricityPayment@eb_payment_final'); 
	Route::post('eb_payment_final', 'ElectricityPayment@eb_payment_final'); 
	Route::post('check_consumerno', 'ElectricityPayment@check_consumerno'); 
   
    //telephone Payment 
   Route::get('telephone_payment', 'TelephonePayment@telephone_payment');
   Route::post('telephone_payment', 'TelephonePayment@do_payment');
   
   
    //GAS Payment 
   Route::get('gas_payment', 'GasPayment@gas_payment'); 
   Route::post('gas_payments', 'GasPayment@do_payment');
    Route::get('gas_payments', 'GasPayment@do_payment');
    // Route::get('gas_payment_final', 'GasPayment@gas_payment_final'); 
    Route::post('gas_payment_final', 'GasPayment@gas_payment_final'); 
   
   
   //Subscription
    Route::get('subscription', 'Subscription@home'); 
    Route::post('load_subscription', 'Subscription@load_subscription'); 
    Route::post('subscription', 'Subscription@do_subscription'); 
    Route::post('load_subscriptionbiller', 'Subscription@load_subscriptionbiller');
   
   //Creditcard  payment
    Route::get('creditcard_payment', 'Creditcard@home'); 
    Route::post('load_creditcardprefix', 'Creditcard@load_creditcardprefix');
    Route::post('creditcard_payment', 'Creditcard@do_payment');
    Route::get('crditcard_payment_final', 'Creditcard@crditcard_payment_final');
     Route::post('crditcard_payment_final', 'Creditcard@crditcard_payment_final');
    Route::post('load_creditcardbiller', 'Creditcard@load_creditcardbiller'); 
     
     //Dth Payment
     Route::get('dth_payments', 'DthPayment@home'); 
     Route::post('dthpayments', 'DthPayment@do_payment'); 
     Route::get('dthpayments', 'DthPayment@do_payment'); 
     Route::get('do_payment_final', 'DthPayment@do_payment_final'); 
     Route::post('do_payment_final', 'DthPayment@do_payment_final'); 
     Route::post('load_dthid', 'DthPayment@load_dth_biller_id');
   
     
      
 //Route::post('mobile_rec/{id}', 'Recharge@mobile_rec');
 /*HOTELS  */
 Route::get('Hotels', 'Hotels@home');
 Route::post('Hotels', 'Hotels@Hotel_listing');
 Route::post('loadadult/{id}', 'Hotels@loadadult');
  Route::post('loadadults/{id}', 'Hotels@loadadults');
 Route::post('loadchild/{id}', 'Hotels@loadchild');
 Route::post('loadchilds/{id}', 'Hotels@loadchilds');
 Route::post('num_row_child/{id}', 'Hotels@num_row_child');
 Route::post('loadage', 'Hotels@loadage');
  Route::post('loadages', 'Hotels@loadages');
  Route::post('hotels_search', 'Hotels@hotels_search');
 Route::post('hotels_cleartrp', 'Hotels@hotel_cleartrp');
 Route::get('hotels_cancel', 'Hotels@cancel_exp');
 /*---------*/
 /*New Magazine API*/
 Route::get('magazine_list', 'Magzter@get_magazine');
 Route::get('magazine_id/{id}', 'Magzter@get_magazine_by_id');
 Route::get('magazine_category/{id}', 'Magzter@magazine_category');
 Route::get('buy_magazine/{id}', 'Magzter@buy_magazine');
  Route::post('magazine_id/{id}', 'Magzter@buy_magazine');

/*deals */
/*Route::get('deals_list/{id}', 'dealsController@index');
Route::get('deals_list', 'dealsController@index');
Route::post('deals_list', 'dealsController@search_deals');*/
Route::post('fiesta_list', 'dealsController@search_fiesta');
Route::get('fiesta_list', 'dealsController@search_fiesta');
Route::get('fiesta_list/{id}', 'dealsController@search_fiesta');
Route::post('fiesta_list/{id}', 'dealsController@search_fiesta');

//deals and food fiesta


Route::get('dealsandfiesta', 'dealsController@dealsandfoodfiesta');
Route::post('dealsandfiesta', 'dealsController@dealsandfoodfiesta');

 /*---*/
 //showing the hotel list calling from hotel.js
 Route::get('detailsss', 'Hotels@static_hotel');
 Route::post('showhotel', 'Hotels@show_hotel');
 //hotel details
 Route::post('hotel_details', 'Hotels@hotel_details');
 //Booking hotels
  Route::get('hotel_booking', 'Hotels@Hotel_Booking');
 // Route::get('Hotels/{id}', 'Hotels@Hotel_Booking');
 Route::post('Hotelscheckout', 'Hotels@Hotel_Checkout');
 Route::get('Hotelscheckout', 'Hotels@Hotel_Checkout');
 Route::post('Hotelscheckoutfinal', 'Hotels@Hotel_Checkout_final');
 Route::get('Hotelscheckoutfinal', 'Hotels@Hotel_Checkout_final');
 Route::post('Hotels_clr_trp', 'Hotels@Hotel_clrn_Checkout');
 Route::get('Hotels_clr_trp', 'Hotels@Hotel_clrn_Checkout');
Route::post('Hotels_clr_trp_final', 'Hotels@Hotel_clrn_Checkout_final');
 Route::get('Hotels_clr_trp_final', 'Hotels@Hotel_clrn_Checkout_final');
Route::post('Hotelspayment', 'Hotels@Hotel_payment');
Route::post('Hotelsclrpayment', 'Hotels@Hotel_book_clr');
 Route::get('magazines', 'Magazine@magazine_list');


 //Route::get('payment_gateway', 'Hdfcpayment@hdfc_do');
 Route::post('payment_gateway', 'Hdfcpayment@hdfc_do');
 Route::post('sendRequest', 'Hdfcpayment@send_request');
// Program list
Route::get('list_program', 'ProgramController@list_programs');
Route::get('program_details/{id}', 'ProgramController@program_details');
Route::get('program_validation/{id}','ProgramController@program_validation');
Route::get('gridview', 'ProgramController@gridview');
Route::get('listview', 'ProgramController@listview');
Route::post('program_validation/{id}', 'ProgramController@post_programs'); 
Route::post('search_program', 'ProgramController@search_program');


// Offer list

Route::get('list_offer/{id}', 'OfferController@list_offers');
Route::post('list_offer/{id}', 'OfferController@list_offers');  
Route::get('offer_details/{id}', 'OfferController@offer_details');
Route::get('offer_validation/{id}','OfferController@offer_validation');
Route::get('gridview', 'OfferController@gridview');
Route::post('gridview', 'OfferController@gridview');
Route::get('listview', 'OfferController@listview');
Route::post('listview', 'OfferController@listview');
Route::post('offer_validation/{id}', 'OfferController@post_offers'); 
Route::get('redriect/{id}', 'OfferController@redriect'); 
Route::get('merchant', 'OfferController@merchant');

Route::post('load_segment', 'OfferController@load_segment');
//flipkart offers

Route::get('flipkart_offers', 'OfferController@flipkart_offers');

//payment 

 Route::get('payment_gateway', 'Hdfcpayment@hdfc_do');

 Route::post('sendRequest', 'Hdfcpayment@send_request');
 Route::post('pgResponse','Hdfcpayment@gethandleresponse');
 Route::get('capture_errors','Hdfcpayment@capture_errors');
 Route::get('paymentinfo','Hdfcpayment@paymentinfo');


//Login 
 Route::get('securelogin', 'Login@securelogin');
 Route::post('securelogin', 'Login@securelogin');
  Route::get('poplogin', 'Login@poplogin');
 Route::post('poplogin', 'Login@poplogin');
 Route::get('registration', 'Login@registration');
Route::post('registration', 'Login@registration');
 Route::get('myaccount','Login@myaccount');
 Route::post('myaccount','Login@myaccount');
Route::get('change_password','Login@change_password');
 Route::post('change_password','Login@change_password');
 Route::get('signup','Login@signup');
 Route::post('signup','Login@signup');
 Route::get('create_new_password/{id}','Login@create_new_password');
 Route::post('create_new_password/{id}','Login@create_new_password');
 Route::get('forgot_password','Login@forgot_password');
 Route::post('forgot_password','Login@forgot_password');
 Route::post('check_password','Login@check_password');
 Route::post('check_otp','Login@check_otp');
 Route::post('check_email','Login@check_email'); 
Route::get('otp_number/{id}','Login@otp_number'); 
Route::post('otp_number','Login@otp_number'); 
Route::post('checkout_login', 'Login@checkout_login');


//My Order
 Route::get('my_order','Login@my_order');
 Route::get('view/{id}', 'Login@order_view');
 Route::get('logout', 'Login@logout');







Route::post('getCity_basedonState', function(){


       $state_id =  $_POST['state_id'];
      
    $cities  = DB::table('cities')->where('country_code', 'IN')->where('adminCode1',$state_id)->get(); 
       
     $out = '';
	 
			$out="<lable style='font-size: 14px;font-weight: normal;line-height: 20px;'>Select City</label><br/>
			<select id='city' name='city' class='form-control'>
			<option selected='selected' value=''>City Name </option>";

			 if(isset($cities) && !empty($cities)) { 
			foreach ($cities as $city) { 
                       
			$out .= '<option  value="'.$city->id.'">'. $city->city.'</option>';
			} }    
			
			                $out .='</select>';
			                echo $out;
});


// goibibo
Route::get('flight_index', 'Goibibo@index');
Route::get('flight_int', 'Goibibo@indexint');
Route::post('flight_int', 'Goibibo@Listing_Flights');
Route::post('flight_index', 'Goibibo@Listing_Flights');
Route::post('flight_price/{id}', 'Goibibo@Flight_Price');
Route::post('flight_payment', 'Goibibo@flight_payment');



Route::get('clear_checkout', 'Goibibo@clear_Checkout');
Route::post('continue_checkout', 'Goibibo@continue_checkout');
Route::get('continue_checkout', 'Goibibo@continue_checkout');


Route::get('airline_create_itinerary', 'Goibibo@create_itinerary');

Route::post('price_search', 'Goibibo@price_search');
Route::post('price_search_round', 'Goibibo@price_search_round');
//oneway.js fillter 
Route::post('get_flights', 'Goibibo@get_flights');
//round.js fillter 
Route::post('round_flights', 'Goibibo@round_flights');
Route::post('clear_checkout', 'Goibibo@clear_Checkout');
Route::post('go_checkout', 'Goibibo@go_Checkout');
Route::post('load_infants', 'Goibibo@load_infants');
Route::get('flights_not_available', 'Goibibo@flights_not_available');
Route::post('fare_rules', 'Goibibo@fare_rules');
Route::post('fare_rule_goibibo', 'Goibibo@fare_rule_goibibo');
/*
Route::get('clear_index', 'Cleartrip@index');
Route::get('clear_int', 'Cleartrip@indexint');
Route::post('clear_int', 'Cleartrip@Listing_Flights');
Route::post('clear_index', 'Cleartrip@Listing_Flights');
Route::post('clear_price/{id}', 'Cleartrip@Flight_Price');
Route::post('clear_payment', 'Cleartrip@flight_payment');



Route::get('clear_checkout', 'Cleartrip@clear_Checkout');
Route::post('continue_checkout', 'Cleartrip@continue_checkout');



Route::get('airline_create_itinerary', 'Cleartrip@create_itinerary');

Route::post('price_search', 'Cleartrip@price_search');
Route::post('price_search_round', 'Cleartrip@price_search_round');
//oneway.js fillter 
Route::post('get_flights', 'Cleartrip@get_flights');
//round.js fillter 
Route::post('round_flights', 'Cleartrip@round_flights');
Route::post('clear_checkout', 'Cleartrip@clear_Checkout');
Route::post('go_checkout', 'Cleartrip@go_Checkout');*/


// Manage Orders
Route::get('list_orders','Manageorder@list_orders');
Route::post('list_orders','Manageorder@list_orders');
Route::get('order_details/{id}','Manageorder@order_details');
//Route::post('order_details','Manageorder@order_details');
Route::get('guest_order','Manageorder@guest_order');
Route::post('guest_order','Manageorder@guest_order');
Route::get('guest_order_details','Manageorder@guest_order_details');
Route::post('guest_order_details','Manageorder@guest_order_details');





Route::post('checkout_process', 'Checkout@checkout_process');
Route::get('checkout_before_process', 'MusicController@checkout_final_process');
Route::post('checkout_before_process', 'MusicController@checkout_final_process');
Route::post('place_order','Checkout@place_order');
Route::get('place_order','Checkout@place_order');
Route::get('payment_checkout', 'Hdfcpayment@payment_checkout');

//billdesk recrom mail

Route::get('billdesk_recon','PartnerUpdates@billdesk_recon');
Route::get('flights_pnr_status','PartnerUpdates@flights_pnr_status');
Route::get('cleartrip_pnr_status','PartnerUpdates@cleartrip_pnr_status');



Route::get('error_pages', 'Error@index');
Route::get('log_check', 'Error@log_check');



//Rest controller
Route::post('rest_test', 'RestController@test');
Route::get('profile', array('before' => 'auth','uses' => 'UserController@showProfile'));

Route::get('view_billers/{id}','Billers@home');

//content
Route::get('content/{id}','content@home');


//netbanking
Route::get('netbanking','Netbanking@online_banking');
Route::post('getResponse','Netbanking@payment_data');

Route::get('cart_expired','CartController@cart_expired');


// partner updates
Route::get('music_update','PartnerUpdates@music');
Route::get('movies_update','PartnerUpdates@movies');



/*please load all ajax request here -->sharath*/
Route::get('cityautocomplete','AjaxController@hotel_cities');
Route::get('flightcityautocomplete','AjaxController@domestic_cities');
Route::get('flighticityautocomplete', 'AjaxController@international_cities');
Route::post('fare_rule', 'Goibibo@fare_rule');



//billdesk pending transaction re-process

Route::get('billdesk_pending_reprocess','PartnerUpdates@billdesk_pending_reprocess');

// Offer list 
 Route::get('offer_details/{id}/{offer_type}', 'OfferController@offer_details');

Route::post('foodfiesta_area_fiesta', 'dealsController@foodfiesta_area_fiesta');
Route::post('load_foodfiesta', 'HomeController@foodfiesta_area');
Route::post('load_foodfiesta_cusine', 'HomeController@foodfiesta_cusine');
Route::get('list_offer/{id}/{ids}', 'OfferController@list_offers');
Route::get('oops', 'HomeController@oops');


//cleartrip comes here
Route::get('clear_index', 'Cleartrip@index');
Route::get('clear_int', 'Cleartrip@indexint');
Route::post('clear_int', 'Cleartrip@Listing_Flights');
Route::post('clear_index', 'Cleartrip@Listing_Flights');
Route::post('get_flights_cleartrip', 'Cleartrip@get_flights');
Route::post('round_flights_cleartrip', 'Cleartrip@round_flights');
Route::post('price_search_cleartrip', 'Cleartrip@price_search');
Route::post('price_search_cleartrip_round', 'Cleartrip@price_search_round');
Route::get('test333', 'Cleartrip@test333');
Route::get('flightcityauto_cleartrip','Ajaxcleartrip@domestic_cities');
Route::post('checkout_cleartrip', 'Cleartrip@clear_Checkout');
Route::post('checkout_goibibo', 'Cleartrip@go_Checkout');
