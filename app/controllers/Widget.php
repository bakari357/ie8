<?php 

class Widget extends AdminBaseController {

  protected $pages;

   public function index(){
        $widget = Widgets::paginate( Config::get('app.pagination_limit'));
        return $this->load_admin_theme('widget','index',array('widget'=>$widget));      
	}

    public function show($id)
    {
	$page =Widgets::find($id);
	if(isset($page)&&$page<>''){
	return $this->load_admin_theme('widget','show',array('page'=>$page)); 
	}else{
	  return Redirect::route('cpanel.pages.index')
                ->with('danger', 'Requested page not found');
	}
    }


    public function create(){
                 $template = DB::table('template')->get();
                $images = array();
        return $this->load_admin_theme('widget','create',array('images'=>$images,'template'=>$template));       
    }
 

  public function edit($id)
    {
      
      $page =Widgets::find($id);
	if(isset($page)&&$page<>''){
             $template = DB::table('template')->get();
                $images = array();
	return $this->load_admin_theme('widget','edit',array('page'=>$page,'images'=>$images,'template'=>$template)); 
	}else{
	  return Redirect::route('cpanel.pages.index')
                ->with('danger', 'Requested page not found');
	}
       
    }

     public function store() {
	$rules =array('name' => 'required|min:5','description' => 'required|min:5','position'=>'required','template'=>'required','images'=>'required','region'=>'required','position'=>'required');
	$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	     return Redirect::back()
             ->withInput()
            ->withErrors($validator->messages());
	    }else{

             $widgetid=DB::table('widget')->insertGetId(array(
                        'name'=> Input::get('name'),
                        'description'=>     Input::get('description'),
		        'image'=>     json_encode($_POST['images']),
			'region'=>     Input::get('region'),
			'position'=>     Input::get('position'),
                        'created_at'=>     date('Y-m-d H:i:s'),
                        'active'=>    Input::get('active'),
                       
                ));
               $id=DB::table('widget_relation')->insertGetId(array(
                        'temp_id'=> Input::get('template'),
                        'widget_id'=>    $widgetid
                       
                ));
            return Redirect::route('cpanel.widget.index')
                ->with('success','Page created');
            }
 
    }
    public function update($id)
    {
    	$rules =array('name' => 'required|min:5');
	$validator = Validator::make(Input::all(), $rules);
	    if ($validator->fails())
	    {
	     return Redirect::back()
             ->withInput()
            ->withErrors($validator->messages());
	    }else{

	     $page = Widgets::find($id);
             $page->name=Input::get('name');
             $page->description= Input::get('description');
		$page->region= Input::get('region');
		$page->position= Input::get('position');
             $page->updated_at=     date('Y-m-d H:i:s');
             $page->active= Input::get('active');
             $page->save();
                DB::table('widget_relation')
            ->where('widget_id', '=',$id)
            ->update(array('temp_id' => Input::get('template')));
             return Redirect::route('cpanel.widget.index')
                ->with('success','Page updated');
            }

          
    }
    public function destroy($id)
    {
           $page = Widgets::find($id);
           if(isset($page)&&$page<>''){
           $page->delete();
            return Redirect::route('cpanel.widget.index')
                ->with('success','Page deleted');
           }else{
	  return Redirect::route('cpanel.widget.index')
                ->with('danger', 'Requested page not found');
	 }
    }


    public function putDeactivate($id)
    {
           $page = Widgets::find($id);
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
 
           $page = Widgets::find($id);
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
	 public  function image_form()
	{
		
		$data['file_name'] = false;
		$data['error']	= false;
		return View::make("iframe.product_image_uploader")->with($data);
	}

	public function image_upload()
	{
		
		$data['file_name'] = false;
		$data['error']	= false;
		
		
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['max_size']	= $this->config->item('size_limit');
		$config['upload_path'] = base_path().'/public/uploads/images/widget/';
		$config['encrypt_name'] = true;
		$config['remove_spaces'] = true;
		
			$upload = new Upload();
			
			
		$upload->constructs($config);
		
		if ( $upload->do_upload())
		{
			$upload_data	= $upload->data();
			
			$image_lib = new Limage();

			//this is the larger image
			$config['image_library'] = 'gd2';
			$config['source_image'] = base_path().'/public/uploads/images/widget/'.$upload_data['file_name'];
			//echo $config['source_image']; exit;
			$config['new_image']	= base_path().'/public/uploads/images/widget/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 600;
			$config['height'] = 500;
			$image_lib->initialize($config);
			$image_lib->resize();
			$image_lib->clear();

			//small image
			$config['image_library'] = 'gd2';
			$config['source_image'] = base_path().'/public/uploads/images/widget/'.$upload_data['file_name'];
			$config['new_image']	= base_path().'/public/uploads/images/widget/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 235;
			$config['height'] = 235;
			$image_lib->initialize($config);
			$image_lib->resize();
			$image_lib->clear();

			//cropped thumbnail
			$config['image_library'] = 'gd2';
			$config['source_image'] = base_path().'/public/uploads/images/small/'.$upload_data['file_name'];
			$config['new_image']	= base_path().'/public/uploads/images/thumbnails/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 150;
			$config['height'] = 150;
			$image_lib->initialize($config);
			$image_lib->resize();
			$image_lib->clear();

			$data['file_name']	= $upload_data['file_name'];
		}

		if($upload->display_errors() != '')
		{
			$data['error'] = $upload->display_errors();
		}
		
		//$file = Input::file('userfile');
		
		 //$data['file_name']= $file->getClientOriginalName();
		 
		 //$uploadSuccess = Input::file('userfile')->move($destinationPath, $data['file_name']);
		return View::make("iframe.product_image_uploader")->with($data);
	}
	
}
