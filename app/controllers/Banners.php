<?php 

class Banners extends AdminBaseController {

  protected $pages;

   public function index(){
       // $pages = Page::all(); 
        $pages = Page::paginate( Config::get('app.pagination_limit'));
        return $this->load_admin_theme('pages','index',array('pages'=>$pages));      
	}

    public function show($id)
    {
	$page =Page::find($id);
	if(isset($page)&&$page<>''){
	return $this->load_admin_theme('pages','show',array('page'=>$page)); 
	}else{
	  return Redirect::route('cpanel.pages.index')
                ->with('danger', 'Requested page not found');
	}
    }


    public function create(){
        return $this->load_admin_theme('pages','create'); 
    }
 

  public function edit($id)
    {
      
      $page =Page::find($id);
	if(isset($page)&&$page<>''){
	return $this->load_admin_theme('pages','edit',array('page'=>$page)); 
	}else{
	  return Redirect::route('cpanel.pages.index')
                ->with('danger', 'Requested page not found');
	}
       
    }

     public function store() {
	$rules =array('title' => 'required|min:5','short_description' => 'required|min:5');
	$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	     return Redirect::back()
             ->withInput()
            ->withErrors($validator->messages());
	    }else{

             Page::create(array(
                        'title'=> Input::get('title'),
                        'short_description'=>     Input::get('short_description'),
                        'description'=>     Input::get('description'),
                        'created_at'=>     date('Y-m-d H:i:s'),
                        'active'=>    Input::get('active'),
                       
                ));
            return Redirect::route('cpanel.pages.index')
                ->with('success','Page created');
            }
 
    }
    public function update($id)
    {
    	$rules =array('title' => 'required|min:5');
	$validator = Validator::make(Input::all(), $rules);
	    if ($validator->fails())
	    {
	     return Redirect::back()
             ->withInput()
            ->withErrors($validator->messages());
	    }else{
	     $page = Page::find($id);
             $page->title=Input::get('title');
             $page->short_description=    Input::get('short_description');
             $page->description= Input::get('description');
             $page->updated_at=     date('Y-m-d H:i:s');
             $page->active= Input::get('active');
             $page->save();
             return Redirect::route('cpanel.pages.index')
                ->with('success','Page updated');
            }

          
    }
    public function destroy($id)
    {
           $page = Page::find($id);
           if(isset($page)&&$page<>''){
           $page->delete();
            return Redirect::route('cpanel.pages.index')
                ->with('success','Page deleted');
           }else{
	  return Redirect::route('cpanel.pages.index')
                ->with('danger', 'Requested page not found');
	 }
    }


    public function putDeactivate($id)
    {
           $page = Page::find($id);
            if(isset($page)&&$page<>''){
           $page->active=   0;
           $page->save();
            return Redirect::route('cpanel.pages.index')
             ->with('success','Page deactivated');
          }else{
	  return Redirect::route('cpanel.pages.index')
                ->with('danger', 'Requested page not found');
	 }
    }


    public function putActivate($id)
    {
 
           $page = Page::find($id);
             if(isset($page)&&$page<>''){
           $page->active=   1;
           $page->save();
                return Redirect::route('cpanel.pages.index')
                    ->with('success','Page activated');
          }else{
	  return Redirect::route('cpanel.pages.index')
                ->with('danger', 'Requested page not found');
	 } 
    
    }

}
