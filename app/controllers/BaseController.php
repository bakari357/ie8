<?php

class BaseController extends Controller {


	 public function __construct()
		{	
				
			$url = Request::url();
			Rewards::login_redirect($url);
                        
		}

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
	}
	
	
	protected function load_reward_theme($title,$page_view,$layout,$bread_crumb='',$meta_keywords='Points Pool',$meta_description='Points Pool',$css_array='',$js_array='',$musicmenu='',$magazinemenu='')
	{
	$defalut_theme = Config::get('app.themeDefault');
	$theme = Theme::uses($defalut_theme)->layout($layout);
	$theme->setTitle($title);
	
        if($meta_keywords <> '' )
	$theme->setKeywords($meta_keywords);
	else
	$theme->setKeywords(Config::get('app.site_meta_keywords'));

	if($meta_description <> '' )
	$theme->setDescription($meta_description);
	else
	$theme->setDescription(Config::get('app.site_meta_description'));	

$theme->asset()->usePath()->add('core-style-1', 'dist/css/bootstrap.css');
	$theme->asset()->usePath()->add('core-style-2', 'assets/css/custom.css');
$theme->asset()->usePath()->add('core-style-13', 'assets/css/header_footer.css');
        $theme->asset()->usePath()->add('core-style-3', 'examples/carousel/carousel.css');
         $theme->asset()->usePath()->add('core-style-4', 'assets/css/font-awesome.css');
$theme->asset()->usePath()->add('core-style-10', 'css/fullwidth.css');
$theme->asset()->usePath()->add('core-style-5', 'css/fullscreen.css');
$theme->asset()->usePath()->add('core-style-11', 'rs-plugin/css/settings2.css');
	$theme->asset()->usePath()->add('core-style-7', 'assets/css/jquery-ui.css');
 $theme->asset()->usePath()->add('core-style-15', 'assets/css/font.css');

$theme->asset()->usePath()->add('core-js-28', 'assets/js/js-index.js');

$theme->asset()->usePath()->add('core-js-15', 'assets/js/functions.js');
$theme->asset()->usePath()->add('core-js-29', 'assets/js/jquery-ui.js');

$theme->asset()->usePath()->add('core-js-27', 'assets/js/jquery.easing.js');
$theme->asset()->usePath()->add('core-js-6', 'rs-plugin/js/jquery.themepunch.revolution.min.js');
$theme->asset()->usePath()->add('core-js-26', 'assets/js/jquery.nicescroll.min.js');
$theme->asset()->usePath()->add('core-js-9', 'assets/js/jquery.carouFredSel-6.2.1-packed.js');
$theme->asset()->usePath()->add('core-js-8', 'assets/js/helper-plugins/jquery.touchSwipe.min.js');
$theme->asset()->usePath()->add('core-js-10', 'assets/js/helper-plugins/jquery.mousewheel.min.js');
$theme->asset()->usePath()->add('core-js-11', 'assets/js/helper-plugins/jquery.transit.min.js');
$theme->asset()->usePath()->add('core-js-12', 'assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js');
$theme->asset()->usePath()->add('core-js-13', 'assets/js/jquery.customSelect.js');
$theme->asset()->usePath()->add('core-js-30', 'assets/js/js-index7.js');
$theme->asset()->usePath()->add('core-js-14', 'dist/js/bootstrap.js');
//$theme->asset()->usePath()->add('core-js-99', 'assets/js/respond.src.js');

//$theme->asset()->usePath()->add('core-js-14', 'dist/js/bootstrap.min.js');
	if($css_array<>''){
	foreach($css_array as $key=>$css)
   $theme->asset()->usePath()->add('ex-style-'.$key, $css);
    }
   
    if($js_array<>''){
    foreach($js_array as $key=>$js)
    $theme->asset()->usePath()->add('ex-script-'.$key, $js);
    }
	       
    //$theme->asset()->compress();
  
  if($bread_crumb<>''){
    $fianl_breadcrumb=array();
    foreach($bread_crumb as $breadcrum_name=>$breadcrumb_url){
    $bread_crumbs['label']=$breadcrum_name;
    $bread_crumbs['url']=$breadcrumb_url;
    $fianl_breadcrumb[]= $bread_crumbs;
    }
    $theme->breadcrumb()->add($fianl_breadcrumb);
    }   
		$pages = Page::get();
//	echo '<pre>'; print_r($pages[0]['slug']); exit;
  	$theme->set('pages', $pages);
  
    }



		protected function load_reward_theme_hotels($title,$page_view,$layout,$bread_crumb='',$meta_keywords='Points Pool',$meta_description='Points Pool',$css_array='',$js_array='',$musicmenu='',$magazinemenu='')
	{
	$defalut_theme = Config::get('app.themeDefault');
	$theme = Theme::uses($defalut_theme)->layout($layout);
	$theme->setTitle($title);
        if($meta_keywords <> '' )
	$theme->setKeywords($meta_keywords);
	else
	$theme->setKeywords(Config::get('app.site_meta_keywords'));

	if($meta_description <> '' )
	$theme->setDescription($meta_description);
	else
	$theme->setDescription(Config::get('app.site_meta_description'));	

$theme->asset()->usePath()->add('core-style-1', 'dist/css/bootstrap.css');
	$theme->asset()->usePath()->add('core-style-2', 'assets/css/custom.css');
$theme->asset()->usePath()->add('core-style-13', 'assets/css/header_footer.css');
        $theme->asset()->usePath()->add('core-style-3', 'examples/carousel/carousel.css');
         $theme->asset()->usePath()->add('core-style-4', 'assets/css/font-awesome.css');
$theme->asset()->usePath()->add('core-style-10', 'css/fullwidth.css');
$theme->asset()->usePath()->add('core-style-5', 'css/fullscreen.css');
$theme->asset()->usePath()->add('core-style-11', 'rs-plugin/css/settings2.css');
	$theme->asset()->usePath()->add('core-style-7', 'assets/css/jquery-ui.css');
 $theme->asset()->usePath()->add('core-style-15', 'assets/css/font.css');


$theme->asset()->usePath()->add('core-js-28', 'assets/js/js-index.js');
$theme->asset()->usePath()->add('core-js-30', 'assets/js/js-index7.js');
$theme->asset()->usePath()->add('core-js-15', 'assets/js/functions.js');


$theme->asset()->usePath()->add('core-js-27', 'assets/js/jquery.easing.js');
$theme->asset()->usePath()->add('core-js-6', 'rs-plugin/js/jquery.themepunch.revolution.min.js');
$theme->asset()->usePath()->add('core-js-26', 'assets/js/jquery.nicescroll.min.js');
$theme->asset()->usePath()->add('core-js-9', 'assets/js/jquery.carouFredSel-6.2.1-packed.js');
$theme->asset()->usePath()->add('core-js-8', 'assets/js/helper-plugins/jquery.touchSwipe.min.js');
$theme->asset()->usePath()->add('core-js-10', 'assets/js/helper-plugins/jquery.mousewheel.min.js');
$theme->asset()->usePath()->add('core-js-11', 'assets/js/helper-plugins/jquery.transit.min.js');
$theme->asset()->usePath()->add('core-js-12', 'assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js');
$theme->asset()->usePath()->add('core-js-13', 'assets/js/jquery.customSelect.js');
//$theme->asset()->usePath()->add('core-js-99', 'assets/js/respond.src.js');





	if($css_array<>''){
	foreach($css_array as $key=>$css)
   $theme->asset()->usePath()->add('ex-style-'.$key, $css);
    }
   
    if($js_array<>''){
    foreach($js_array as $key=>$js)
    $theme->asset()->usePath()->add('ex-script-'.$key, $js);
    }
	       
    //$theme->asset()->compress();
  
  if($bread_crumb<>''){
    $fianl_breadcrumb=array();
    foreach($bread_crumb as $breadcrum_name=>$breadcrumb_url){
    $bread_crumbs['label']=$breadcrum_name;
    $bread_crumbs['url']=$breadcrumb_url;
    $fianl_breadcrumb[]= $bread_crumbs;
    }
    $theme->breadcrumb()->add($fianl_breadcrumb);
    }   
		$pages = Page::get();
//	echo '<pre>'; print_r($pages[0]['slug']); exit;
  	$theme->set('pages', $pages);
  
    }

//bharath for hotels details page
protected function load_reward_theme_hotels_details($title,$page_view,$layout,$bread_crumb='',$meta_keywords='Points Pool',$meta_description='Points Pool',$css_array='',$js_array='',$musicmenu='',$magazinemenu='')
	{
	$defalut_theme = Config::get('app.themeDefault');
	$theme = Theme::uses($defalut_theme)->layout($layout);
	$theme->setTitle($title);
        if($meta_keywords <> '' )
	$theme->setKeywords($meta_keywords);
	else
	$theme->setKeywords(Config::get('app.site_meta_keywords'));

	if($meta_description <> '' )
	$theme->setDescription($meta_description);
	else
	$theme->setDescription(Config::get('app.site_meta_description'));
 $theme->asset()->usePath()->add('core-style-15', 'assets/css/font.css');	
$theme->asset()->usePath()->add('core-style-1', 'dist/css/bootstrap.css');
	$theme->asset()->usePath()->add('core-style-2', 'assets/css/custom.css');
$theme->asset()->usePath()->add('core-style-13', 'assets/css/header_footer.css');
        $theme->asset()->usePath()->add('core-style-3', 'examples/carousel/carousel.css');
         $theme->asset()->usePath()->add('core-style-4', 'assets/css/font-awesome.css');
	$theme->asset()->usePath()->add('core-style-5', 'css/fullscreen.css');
	$theme->asset()->usePath()->add('core-style-6', 'rs-plugin/css/settings.css');
	$theme->asset()->usePath()->add('core-style-7', 'assets/css/jquery-ui.css');
 $theme->asset()->usePath()->add('core-style-8', 'plugins/jslider/css/jslider.css');
	$theme->asset()->usePath()->add('core-style-9', 'plugins/jslider/css/jslider.round.css');
$theme->asset()->usePath()->add('core-style-12', 'plugins/jslider/css/jslider.round-blue.css');
$theme->asset()->usePath()->add('core-style-10', 'css/fullwidth.css');
$theme->asset()->usePath()->add('core-style-11', 'rs-plugin/css/settings2.css');
$theme->asset()->usePath()->add('core-js-28', 'assets/js/js-index2.js');
$theme->asset()->usePath()->add('core-js-13', 'assets/js/jquery.customSelect.js');
$theme->asset()->usePath()->add('core-js-15', 'assets/js/functions.js');
$theme->asset()->usePath()->add('core-js-29', 'jquery-ui.js');
$theme->asset()->usePath()->add('core-js-26', 'assets/js/jquery.nicescroll.min.js');
$theme->asset()->usePath()->add('core-js-23', 'js/jquery.js');
$theme->asset()->usePath()->add('core-js-6', 'rs-plugin/js/jquery.themepunch.revolution.min.js');
$theme->asset()->usePath()->add('core-js-9', 'assets/js/jquery.carouFredSel-6.2.1-packed.js');
$theme->asset()->usePath()->add('core-js-8', 'assets/js/helper-plugins/jquery.touchSwipe.min.js');
$theme->asset()->usePath()->add('core-js-10', 'assets/js/helper-plugins/jquery.mousewheel.min.js');
$theme->asset()->usePath()->add('core-js-11', 'assets/js/helper-plugins/jquery.transit.min.js');
$theme->asset()->usePath()->add('core-js-12', 'assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js');
$theme->asset()->usePath()->add('core-js-25', 'assets/js/counter.js');
$theme->asset()->usePath()->add('core-js-18', 'assets/js/initialize-carousel-detailspage.js');
$theme->asset()->usePath()->add('core-js-27', 'assets/js/jquery.easing.js');
$theme->asset()->usePath()->add('core-js-14', 'dist/js/bootstrap.min.js');
$theme->asset()->usePath()->add('core-js-24', 'js/lightbox.js');
$theme->asset()->usePath()->add('core-js-30', 'assets/js/js-index7.js');
//$theme->asset()->usePath()->add('core-js-99', 'assets/js/respond.src.js');




	if($css_array<>''){
	foreach($css_array as $key=>$css)
   $theme->asset()->usePath()->add('ex-style-'.$key, $css);
    }
   
    if($js_array<>''){
    foreach($js_array as $key=>$js)
    $theme->asset()->usePath()->add('ex-script-'.$key, $js);
    }
	       
    //$theme->asset()->compress();
  
  if($bread_crumb<>''){
    $fianl_breadcrumb=array();
    foreach($bread_crumb as $breadcrum_name=>$breadcrumb_url){
    $bread_crumbs['label']=$breadcrum_name;
    $bread_crumbs['url']=$breadcrumb_url;
    $fianl_breadcrumb[]= $bread_crumbs;
    }
    $theme->breadcrumb()->add($fianl_breadcrumb);
    }   
		$pages = Page::get();
//	echo '<pre>'; print_r($pages[0]['slug']); exit;
  	$theme->set('pages', $pages);
  
    }
    protected function load_hdfc_theme($title,$page_view,$layout,$bread_crumb='',$meta_keywords='Points Pool',$meta_description='Points Pool',$css_array='',$js_array='',$musicmenu='',$magazinemenu='')
	{
	$defalut_theme = Config::get('app.themeDefault');
	$theme = Theme::uses($defalut_theme)->layout($layout);
	$theme->setTitle($title);
        if($meta_keywords <> '' )
	$theme->setKeywords($meta_keywords);
	else
	$theme->setKeywords(Config::get('app.site_meta_keywords'));

	if($meta_description <> '' )
	$theme->setDescription($meta_description);
	else
	$theme->setDescription(Config::get('app.site_meta_description'));	

	$theme->asset()->usePath()->add('core-style', 'assetshdfc/css/style.css');
	$theme->asset()->usePath()->add('core-style-2', 'assetshdfc/css/ddsmoothmenu.css');
	
	$theme->asset()->usePath()->add('core-js', 'assetshdfc/js/jquery_common.js');
	$theme->asset()->usePath()->add('core-js-1', 'assetshdfc/js/html5.js');
	$theme->asset()->usePath()->add('core-js-2', 'assetshdfc/js/jquery-1.8.2.min.js');
	$theme->asset()->usePath()->add('core-js-3', 'assetshdfc/js/ddsmoothmenu.js');
	$theme->asset()->usePath()->add('core-js-4', 'assetshdfc/js/jquery.select_skin.js');

	if($css_array<>''){
	foreach($css_array as $key=>$css)
   $theme->asset()->usePath()->add('ex-style-'.$key, $css);
    }
   
    if($js_array<>''){
    foreach($js_array as $key=>$js)
    $theme->asset()->usePath()->add('ex-script-'.$key, $js);
    }
	       
    //$theme->asset()->compress();
  
  if($bread_crumb<>''){
    $fianl_breadcrumb=array();
    foreach($bread_crumb as $breadcrum_name=>$breadcrumb_url){
    $bread_crumbs['label']=$breadcrum_name;
    $bread_crumbs['url']=$breadcrumb_url;
    $fianl_breadcrumb[]= $bread_crumbs;
    }
    $theme->breadcrumb()->add($fianl_breadcrumb);
    }   
		$pages = Page::get();
//	echo '<pre>'; print_r($pages[0]['slug']); exit;
  	$theme->set('pages', $pages);
  
    }
    

     protected function load_reward_withoutheader_theme($title,$page_view,$layout,$bread_crumb='',$meta_keywords='Points Pool',$meta_description='Points Pool',$css_array='',$js_array='',$musicmenu='',$magazinemenu='')
	{
	$defalut_theme = Config::get('app.themeDefault');
	$theme = Theme::uses($defalut_theme)->layout($layout);
	$theme->setTitle($title);
        if($meta_keywords <> '' )
	$theme->setKeywords($meta_keywords);
	else
	$theme->setKeywords(Config::get('app.site_meta_keywords'));

	if($meta_description <> '' )
	$theme->setDescription($meta_description);
	else
	$theme->setDescription(Config::get('app.site_meta_description'));	

	$theme->asset()->usePath()->add('core-style', 'dist/css/bootstrap.css');
	$theme->asset()->usePath()->add('core-style-2', 'assets/css/custom.css');
        $theme->asset()->usePath()->add('core-style-3', 'examples/carousel/carousel.css');
         $theme->asset()->usePath()->add('core-style-4', 'assets/css/font-awesome.css');
	$theme->asset()->usePath()->add('core-style-9', 'plugins/animo/animate+animo.css');
$theme->asset()->usePath()->add('core-js-17', 'plugins/animo/animo.js');
$theme->asset()->usePath()->add('core-js-18', 'assets/js/jquery.easing.js');
$theme->asset()->usePath()->add('core-js-19', 'assets/js/initialize-loginpage.js');
$theme->asset()->usePath()->add('core-js-20', 'assets/js/jquery-1.11.1.min.js');
//$theme->asset()->usePath()->add('core-js-99', 'assets/js/respond.src.js');
	if($css_array<>''){
	foreach($css_array as $key=>$css)
   $theme->asset()->usePath()->add('ex-style-'.$key, $css);
    }
   
    if($js_array<>''){
    foreach($js_array as $key=>$js)
    $theme->asset()->usePath()->add('ex-script-'.$key, $js);
    }
	       
    //$theme->asset()->compress();
  
  if($bread_crumb<>''){
    $fianl_breadcrumb=array();
    foreach($bread_crumb as $breadcrum_name=>$breadcrumb_url){
    $bread_crumbs['label']=$breadcrum_name;
    $bread_crumbs['url']=$breadcrumb_url;
    $fianl_breadcrumb[]= $bread_crumbs;
    }
    $theme->breadcrumb()->add($fianl_breadcrumb);
    }   

    }
    function load_reward_region($layout,$region,$data){
	$defalut_theme = Config::get('app.themeDefault');
	$theme = Theme::uses($defalut_theme)->layout($layout);	
	$theme->set($region, $data);

    }
     protected static function load_checkout_theme($title,$page_view,$layout,$bread_crumb='',$meta_keywords='Points Pool',$meta_description='Points Pool',$css_array='',$js_array='',$musicmenu='',$magazinemenu='')
	{
	$defalut_theme = Config::get('app.themeDefault');
	$theme = Theme::uses($defalut_theme)->layout($layout);
	$theme->setTitle($title);
        if($meta_keywords <> '' )
	$theme->setKeywords($meta_keywords);
	else
	$theme->setKeywords(Config::get('app.site_meta_keywords'));

	if($meta_description <> '' )
	$theme->setDescription($meta_description);
	else
	$theme->setDescription(Config::get('app.site_meta_description'));	

	$theme->asset()->usePath()->add('core-style-1', 'global/plugins/font-awesome/css/font-awesome.min.css');
	$theme->asset()->usePath()->add('core-style-2', 'global/plugins/bootstrap/css/bootstrap.css');
	$theme->asset()->usePath()->add('core-style-3', 'global/plugins/fancybox/source/jquery.fancybox.css');
	$theme->asset()->usePath()->add('core-style-4', 'global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css');
	$theme->asset()->usePath()->add('core-style-5', 'global/plugins/uniform/css/uniform.default.css');
	$theme->asset()->usePath()->add('core-style-6', 'global/css/components.css');
	
	$theme->asset()->usePath()->add('core-js', 'global/plugins/jquery-1.11.0.min.js');
	$theme->asset()->usePath()->add('core-js-1', 'global/plugins/jquery-migrate-1.2.1.min.js');
	$theme->asset()->usePath()->add('core-js-2', 'global/plugins/bootstrap/js/bootstrap.min.js');
	$theme->asset()->usePath()->add('core-js-3', 'global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');
	$theme->asset()->usePath()->add('core-js-4', 'global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js');
	$theme->asset()->usePath()->add('core-js-5', 'global/plugins/bootstrap-touchspin/bootstrap.touchspin.js');
	$theme->asset()->usePath()->add('core-js-6', 'global/plugins/uniform/jquery.uniform.min.js');
	//$theme->asset()->usePath()->add('core-js-99', 'assets/js/respond.src.js');

	if($css_array<>''){
	foreach($css_array as $key=>$css)
   $theme->asset()->usePath()->add('ex-style-'.$key, $css);
    }
   
    if($js_array<>''){
    foreach($js_array as $key=>$js)
    $theme->asset()->usePath()->add('ex-script-'.$key, $js);
    }
	       
    //$theme->asset()->compress();
  
  if($bread_crumb<>''){
    $fianl_breadcrumb=array();
    foreach($bread_crumb as $breadcrum_name=>$breadcrumb_url){
    $bread_crumbs['label']=$breadcrum_name;
    $bread_crumbs['url']=$breadcrumb_url;
    $fianl_breadcrumb[]= $bread_crumbs;
    }
    $theme->breadcrumb()->add($fianl_breadcrumb);
    }   
		$pages = Page::get();
//	echo '<pre>'; print_r($pages[0]['slug']); exit;
  	$theme->set('pages', $pages);
  
    }
    
    function render_reward_theme_hotels($page,$data=array()){
    
     	$data['page'] ='testest';
        $templ=DB::table('template')->where('active','1')->get();
         if($templ[0]->templ_name=='common')
	{
          $data['widget1']=Widgetmodel::getwidget('middle','1');
           $data['widget2']=Widgetmodel::getwidget('middle','2');
           if($page=='homepage')$page='home.index1';
           
           $load='load_reward_theme_hotels';
           
	}elseif($templ[0]->templ_name=='common1'){
         if($page=='homepage') $page='home.index2';
         
          $load='load_reward_theme_hotels';
	}else
         {
	  if($page=='homepage') $page='home.index';
	  
	    $load='load_hdfc_theme_hotels';
	}
      
      $this->$load('SmartBuy',$page,$templ[0]->templ_name,$data['bread_crumb'],'','',@$data['css_array'],@$data['js_array']); 
     
       $defalut_theme = Config::get('app.themeDefault');

	$theme = Theme::uses($defalut_theme)->layout($templ[0]->templ_name);
       return $theme->scope($page, $data)->render();
    }
 function render_reward_theme_hotels_details($page,$data=array()){
    
     	$data['page'] ='testest';
        $templ=DB::table('template')->where('active','1')->get();
         if($templ[0]->templ_name=='common')
	{
          $data['widget1']=Widgetmodel::getwidget('middle','1');
           $data['widget2']=Widgetmodel::getwidget('middle','2');
           if($page=='homepage')$page='home.index1';
           
           $load='load_reward_theme_hotels_details';
           
	}elseif($templ[0]->templ_name=='common1'){
         if($page=='homepage') $page='home.index2';
         
          $load='load_reward_theme_hotels_details';
	}else
         {
	  if($page=='homepage') $page='home.index';
	  
	    $load='load_hdfc_theme_hotels_details';
	}
      
      $this->$load('SmartBuy',$page,$templ[0]->templ_name,$data['bread_crumb'],'','',@$data['css_array'],@$data['js_array']); 
     
       $defalut_theme = Config::get('app.themeDefault');

	$theme = Theme::uses($defalut_theme)->layout($templ[0]->templ_name);
       return $theme->scope($page, $data)->render();
    }
     function render_reward_theme($page,$data=array()){
    
     	$data['page'] ='testest';
        $templ=DB::table('template')->where('active','1')->get();
        if($templ[0]->templ_name=='common')
	{
            $data['widget1']=Widgetmodel::getwidget('middle','1');
           $data['widget2']=Widgetmodel::getwidget('middle','2');
           if($page=='homepage')$page='home.index1';
           
           $load='load_reward_theme';
           
	}elseif($templ[0]->templ_name=='common1'){
         if($page=='homepage') $page='home.index2';
         
          $load='load_reward_theme';
	}else
         { 
	  if($page=='homepage') $page='home.index';
	  
	    $load='load_hdfc_theme';
	 }
    
      $this->$load('SmartBuy',$page,$templ[0]->templ_name,$data['bread_crumb'],'','',@$data['css_array'],@$data['js_array']); 
     
       $defalut_theme = Config::get('app.themeDefault');
		
	$theme = Theme::uses($defalut_theme)->layout($templ[0]->templ_name);
       return $theme->scope($page, $data)->render();
    }
    
    
    function render_login_theme($page,$layout,$data=array()){
    
     
       $defalut_theme = Config::get('app.themeDefault');

	$theme = Theme::uses($defalut_theme)->layout($layout);
       return $theme->scope($page, $data)->render();
    }
       
	 function render_ajax_theme($page_view,$layout,$data=array()){
	 	
       $defalut_theme = Config::get('app.themeDefault');
	$theme = Theme::uses($defalut_theme)->layout($layout);
       return $theme->scope($page_view, $data)->render();
    }
    
}
