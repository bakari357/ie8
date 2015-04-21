<?php
use Jenssegers\Mongodb\Connection;
class CinepolisController extends BaseController {

    /**
     * Show the profile for the given user.
     */
   
	public function showmovie_list()
	{

	$data['cityid']=$_POST['cityid'];                       //'37'; 
        $data['city']=$_POST['city'];      
	$data['theatreid']=$_POST['TheatreId'];                //'5';
	$data['filmid']=$_POST['filmid'];                     //'11952';
        $data['daterange']=$_POST['ShowDate'];              //'2014-03-19';
        $data['Seatavailablity']=Cinepolis::showmovie_list($data);
        $data['Showtime']=$_POST['Showtime'];
        $data['movie']=$_POST['movie'];
         $data['bread_crumb']=array('Home'=>'/');
			//echo '<pre>'; print_r($data['Seatavailablity']); exit;
			return $this->render_login_theme('cinepolis.selecttype','ajax',$data);
	}
        public function after_select()
         {   

         if(isset($_POST))
         {
           $data=$_POST;
           $data['Showtime']=$_POST['showtime'];
           $data['seat_available']=Cinepolis::showseats($data);
echo '<pre>';
print_r($data['seat_available']);
exit;
     
           if($data['seat_available']['seatlist']['ShowSeatsResult']['ErrMessage']!='Available' &&    $data['seat_available']['seatlist']['ShowSeatsResult']['StatusId']!=1)
		{
		$data['msg']= '<b>'.$data['seat_available']['seatlist']['ShowSeatsResult']['ErrMessage'].'</b>';
		
            $data['bread_crumb']=array('Home'=>'/');
          return $this->render_reward_theme('cinepolis.control_seat',$data);
         }}
           }
	public function show_screen()
	{

	$data['cityid']=$_POST['cityid'];                        //'37';
	$data['theatreid']=$_POST['theatreid'];                 //'5';
	$data['screennid']=$_POST['ScreenId'];                //'16';
	$cinemas=Cinepolis::show_screen($data);
        // $th=Cinepolis::show_theatre($data);
	//echo '<pre>';print_r($cinemas);exit;
	}
          
        public function showseats()
	{


         $data['seat']=$_POST['seat']; 
        $data['ClassId']=$_POST['ClassId'];                   //'NL';
	$data['theatreid']=$_POST['theatreid'];              //'5';
	$data['BookingId']=$_POST['BookingId'];             //'43658';
        $data['Seatavailablity']=Cinepolis::showseats($data);
        $data['MovieName']=$_POST['MovieName'];
        $data['ScreenId']=$_POST['ScreenId'];
        $data['BookingId']=$_POST['BookingId'];
        $data['filmid']=$_POST['filmid'];
        $data['theatreid']=$_POST['theatreid'];
        $data['showtime']=$_POST['showtime'];
        $data['showdate']=$_POST['daterange'];
        $data['city']=$_POST['city'];
        $data['bread_crumb']=array('Home'=>'/');
			
			return $this->render_reward_theme('cinepolis.seat',$data);
	}
       public function getbooking()
	{
        $data['selectedclass']=$_POST['selectedclass'];         //'NL';
	$data['theatreid']=$_POST['theatreid'];                //'5';
	$data['bookid']=$_POST['bookid'];                     //'43658';
	$data['seatcount']=$_POST['seatcount'];              //'1';
	$data['seat']=$_POST['seat'];                       //'H:15';
	$data['order_number']=$_POST['order_number'];      //'43658';
	$data['phn_num']=$_POST['phn_num'];               //'9591888077';

	$cinemas=Cinepolis::cinepolis_booking($data);
	print_r($check);exit;
	}

        public function get_fun_final()
	{


$data = Rewards::redirect_helper('cinepolisController@get_fun_final'); 

$data['post']=$data;
//echo '<pre>'; print_r($data['post']); exit;
$data['ptype']=3;
 $data['emi_data']=Checkouthelper::emi_logic($data['post']['amount']);
	    $data['interest']=Checkouthelper::interest();

			
$data['bread_crumb']=array('Home'=>'/');
			
			return $this->render_reward_theme('cinepolis.seat_final',$data);
	
	}

	public function  get_smartbyoffercinepolis(){
	 
	 $offer = Offerhelper::offer_calculate($_POST['partner'],$_POST['total_amount']);
	 echo json_encode($offer);
	 
	 }

}
 
