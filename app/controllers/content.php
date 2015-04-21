<?php 

class Content extends BaseController {

  /*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
        public function home($id)
        {
    
$data['content']=DB::table('pages')->where('title' , $id)->first();

$data['bread_crumb']=array('Home'=>'/');
       		return $this->render_reward_theme('content.show',$data); 
         }
    }
