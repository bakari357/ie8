<?php
use Jenssegers\Mongodb\Connection;
class FunController extends BaseController {

    /**
     * Show the profile for the given user.
     */
   
	public function getclass()
	{
    
	$data['centercode']=$_POST['CenterCode'];                  //'0013';
	$data['Film_strCode']=$_POST['Film_strCode'];             //'Fun1944';
	$data['ShowCode']=$_POST['ShowCode'];                    //'35911';
        $cinemas=Funcinemas::getmoviedetails($data);
        $data['seat_details'] = array(); 
	
       if(isset($cinemas['MovieDetails']['MovieDetail']['SeatDetails_attr']) && $cinemas['MovieDetails']['MovieDetail']['SeatDetails_attr']<>'')
{

       $data['seat_details']= $cinemas['MovieDetails']['MovieDetail']['SeatDetails_attr'];

      
}
 if(isset($cinemas['MovieDetails']['MovieDetail']['SeatDetails']) && $cinemas['MovieDetails']['MovieDetail']['SeatDetails']<>'')
{
//echo 'hi';
//exit;
         $data['seat_details']=$cinemas['MovieDetails']['MovieDetail']['SeatDetails'];
         
}
if(isset($cinemas[0]['times']['ShowDetail_attr']) && $cinemas[0]['times']['ShowDetail_attr']<>'')
{
//echo 'hi';
//exit;
         $data['seat_details']=$cinemas[0]['times']['ShowDetail_attr'];
         
}	

	$data['movie_details']=$cinemas['MovieDetails']['MovieDetail_attr'];
	 
	$data['bread_crumb']=array('Home'=>'/');
$data['js_array'] = array('assetshdfc/js/jquery.carouFredSel-6.2.1-packed.js','assetshdfc/js/jquery.fancybox-1.3.1.pack.js');
		$data['css_array'] = array('assetshdfc/css/gui.css','assetshdfc/css/jquery.fancybox-1.3.1.css','assetshdfc/css/musicmenu.css');
			return $this->render_login_theme('funcinema.class','ajax',$data);
	}
	public function getseat()
	{

	$data['net']=$_POST['net'];                               //'264.94';
	$data['ServiceFee']=$_POST['ServiceFee'];                   //'22.47';
	$data['ShowCode']=$_POST['ShowCode'];                         //'35911';
	$data['ClassCode']=$_POST['ClassCode'];                      //'0001';
	$data['Class']=$_POST['Class'];                             //'GOLD';
	$data['QTY']=$_POST['QTY'];                                 //'2';
	$data['Price']=$_POST['Price'];                             //'110.0000';
        $data['CenterCode']=$_POST['CenterCode'];                 //'0013';
	$cinemas=Funcinemas::generateorderid($data);

	}
          
        public function getaudilayout()
	{

			$s_data=Session::get('data');

			if(!empty($s_data))
			$_POST=$s_data;
			


			
		$validator = Validator::make(	
						array(
							'ClassCode' => $_POST['ClassCode']
						      ),

						
						array(
							'ClassCode' => 'required|min:1',
							
						     )
					    );	
			
			if ($validator->fails())
			{
			   $messages = $validator->messages();
			   return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
                                     			
			}
			
			
			$show_data=$_POST['ClassCode'];
			$cl_det=explode('_',$show_data);
			$_POST['ClassCode']= $cl_det[0];
			$_POST['Class']=$cl_det[1];
			

			//echo '<pre>';print_r($_POST);exit;
			$data['centercode']=$_POST['CenterCode'];                  //'0013';
			$data['Film_strCode']=$_POST['Film_strCode'];             //'Fun1944';
			$data['ShowCode']=$_POST['ShowCode'];  
			$data['OClassCode']=$show_data;
			$cinemas=Funcinemas::getmoviedetails($data);
			$data['seat_details']=$cinemas['MovieDetails']['MovieDetail']['SeatDetails'];
			$data['movie_details']=$cinemas['MovieDetails']['MovieDetail_attr'];
			foreach($data['seat_details'] as $seats){
			if(isset($seats['Class'])){
			if($seats['Class']==$_POST['Class']){
			$_POST['Price']=$seats['Price'];
			$data['AreaCode']=$seats['AreaCode'];
			
			}
			}
			}
			//echo '<pre>';print_r($cinemas);exit;

			$net=($_POST['ServiceFee'] + $_POST['Price']) * $_POST['QTY'];
			$data['net']=$net;                               //'264.94';
			$data['ServiceFee']=$_POST['ServiceFee'];                   //'22.47';
			$data['ShowCode']=$_POST['ShowCode'];                         //'35911';
			$data['ClassCode']=$cl_det[0];                      //'0001';
			$data['Class']=$_POST['Class'];                             //'GOLD';
			$data['QTY']=$_POST['QTY'];                                 //'2';
			$data['Price']=$_POST['Price'];                             //'110.0000';
			$data['CenterCode']=$_POST['CenterCode'];  
			

			               //'0013';
			$cinemas=Funcinemas::generateorderid($data);
			// print_r($cinemas);exit;
			//$data['GenrateOrderIDResult']=$cinemas['GenrateOrderIDResult'];         //'3190381';
			$audidetails=Funcinemas::GetAudiLayout($cinemas);
			//echo '<pre>';print_r($audidetails);exit;
			if(isset($audidetails['objArea'])){		
			$data['objArea']=$audidetails['objArea'];
			$data['audidetails']=$audidetails;
			$data['order_id']=$cinemas;
			$data['post']=$_POST;
			$data['bread_crumb']=array('Home'=>'/');


			
			return $this->render_reward_theme('funcinema.get_seat',$data);
			}
			else{
			Session::flash('message', "Sorry! There are no bookings available for show and date you have chosen. Please change the show/date and try again! ");
			return Redirect::to('cinemas'); 
			}
	}

	public function getaudilayout_final()
	{
		
		//do the validation here


		$validator = Validator::make(	
						array(
							'first_name' => Input::get('first_name'),
							'last_name'  => Input::get('last_name'),
							's_email'    => Input::get('s_email'),
							'mobile'     => Input::get('mobile'),
							'seats'	     => Input::get('seats')
						      ),

						
						array(
							'first_name' => 'required|min:3|max:20',
							'last_name'  => 'required|min:3|max:20',
							's_email'    => 'required|email',
							'mobile'     => 'required|numeric',
							'seats'	     => 'required|min:1'
						      )
					    );



			if ($validator->fails())
			{
			   $messages = $validator->messages();
			   return Redirect::back()->withInput($_POST)->with('data',$_POST)->withErrors($validator->messages());
                                     			
			}

			

		$data = Rewards::redirect_helper('funController@getaudilayout_final'); 
		$data['post']=$data;
		$data['emi_data']=Checkouthelper::emi_logic($data['post']['amount']);
		$data['interest']=Checkouthelper::interest();


		$data['bread_crumb']=array('Home'=>'/');

		return $this->render_reward_theme('funcinema.get_seat_final',$data);

		}
		public function getbooking()
		{
		$data=$_POST['bookingid'];                                               //'3190381';
		$response=Funcinemas::GenrateBookingID($data);
		$check= Funcinemas::checksuccess($response);
		print_r($check);exit;
	}
	
	
	 public function  get_smartbyoffer(){
	 
	 $offer = Offerhelper::offer_calculate($_POST['partner'],$_POST['total_amount']);
	 echo json_encode($offer);
	 
	 }

}
 
