<?php 

class DashboardController extends AdminBaseController {

    /**
     * @var \Stevemo\Cpanel\User\Repo\CpanelUserInterface
     */
    private $users;

    /**
     * @var \Stevemo\Cpanel\User\Form\UserFormInterface
     */
    private $userForm;

    /**
     * @param CpanelUserInterface                         $users
     * @param \Stevemo\Cpanel\User\Form\UserFormInterface $userForm
     */
    public function __construct()
    {
       
    }


    /**
     * Show the dashboard
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	if(Sentry::getUser()->role=='Client') {
    	//day  DATE_FORMAT(created_date, '%Y-%m-%d')
    	$day = DB::table('customers')->select(DB::raw('count(*) as day_count'))->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"),date("Y-m-d"))->get();

	//week
	       if (1 == date('N')){
			$monday = time();
			}else{
	    		$monday = strtotime('last Monday');
			}
			$datas=array('1'=>'Mon','2'=>'Tue','3'=>'Wed','4'=>'Thu','5'=>'Fri','6'=>'Sat','7'=>'Sun');
			for ($j = 1; $j <= 7; $j++){
			$week =DB::table('customers')->select(DB::raw('count(*) as week_count'))->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"),date('Y-m-d',$monday))->get(); 
                         
			$week_count[]=$week[0]->week_count;
			$monday = strtotime('tomorrow', $monday);
	    		}
	//month
		$days=cal_days_in_month(CAL_GREGORIAN,date('m'), date('Y'));
		$date_start = date('Y-m-d' ,strtotime ( '-1 day' , strtotime(date("d-m-Y", strtotime(date('m').'/01/'.date('Y').' 00:00:00')))));
		$date_end  = date("d-m-Y", strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))));
		$cond=array('0'=>'Orders');
		for($j=1;$j<=$days;$j++){
		$date_start=date('d-m-Y' ,strtotime ('+1 day' , strtotime($date_start)));
			if($date_start<=$date_end){
			$month =DB::table('customers')->select(DB::raw('count(*) as month_count'))->where(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"),$date_start)->get(); 
			
    			
			$month_count[]=$month[0]->month_count;
		}
		}
// year

              $months=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul',
		'8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
		$cyear=date('Y');
		for($j=1;$j<=12;$j++){

             $year =DB::table('customers')->select(DB::raw('count(*) as year_count'))->where(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"),str_pad($j, 2, '0', STR_PAD_LEFT).'-'.$cyear)->get();
		
		$year_count[]=$year[0]->year_count;
		}
       
        return View::make('cpanel::dashboard.index',array('day'=>$day,'week'=>$week_count,'month'=>$month_count,'year'=>$year_count));
	}else
		return View::make('cpanel::dashboard.index');



    }

   
    
}
