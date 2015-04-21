<?php
//this is for the flights
//$a='staging';
$a='staging';

$c='cleartrip';
$d='goibibo';


//$url=  'http://pp.goibibobusiness.com/api/search/?'.$qstring;
        if($a=='staging')
        {
        return array(
        'url'=>array(
                        //goibibo staging
		        'get_flights' => 'www.goibibobusiness.com/api/search/?',
           		'username_password1'=>'hdfcsmartbuy@reward360.co:HDFC@reward360',
			'username_password'=>'hdfcsmartbuy@reward360.co:reward-123',
			'round_flights' => 'www.goibibobusiness.com/api/search/?',

			'reprice'=>'http://pp.goibibobusiness.com/api/reprice/',
			'goibibo_booking'=>'http://pp.goibibobusiness.com/api/book/',
			'goibibo_confirm_booking'=>'http://pp.goibibobusiness.com/api/confirm/'
           		
          ),
	         
        );
        }
        else
        {
        return array(
        'url'=>array(
                       //goibibo production
		        'get_flights' => 'www.goibibobusiness.com/api/search/?',
           		'username_password1'=>'hdfcsmartbuy@reward360.co:HDFC@reward360',
			'username_password'=>'hdfcsmartbuy@reward360.co:HDFC@reward360',
			'round_flights' => 'www.goibibobusiness.com/api/search/?',

			'reprice'=>'www.goibibobusiness.com/api/reprice/',
			'goibibo_booking'=>'www.goibibobusiness.com/api/book/',
			'goibibo_confirm_booking'=>'www.goibibobusiness.com/api/confirm/'
          ),
	         
        );
        }
?>
