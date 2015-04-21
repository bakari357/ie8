<?php

class AdminBaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
		$cpanel = Config::get('cpanel::site_config',array());
		$cpanel['prefix'] = Config::get('cpanel::prefix','');
		View::share('cpanel', $cpanel);
	}
        protected function load_admin_theme($page_name,$function_name,$array_values=array()){

        if(count($array_values)>0){
         return View::make("$page_name.$function_name")->with($array_values);
        }else{
        return View::make("$page_name.$function_name");
        }
  
        }
}
