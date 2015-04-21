<?php 

class Program extends AdminBaseController {
protected $clients;

   public function index()
    {    
	 //$enterprise = Enterprises::paginate( Config::get('15'));
	//$enterprise =Enterprises::where('role_id', '=', 3)->get();
	 $programs = DB::table('program')->get();
	return $this->load_admin_theme('program','index',array('program'=>$programs));      
    }

    public function show($id)
    {
	$programs = DB::table('program')->where('id',$id)->get();
	foreach(@$programs  as $prog_info){
	$program = $prog_info;
	}
	if(isset($program)&& $program<>''){
	return $this->load_admin_theme('program','show',array('program'=>$program)); 
	}else{
	return Redirect::route('cpanel.program.index')
	->with('danger', 'Requested Program not found');
	     }
    }

   
    public function create(){
    $images = array();
    return $this->load_admin_theme('program','create',array('images'=>$images));
    }
 
   public function edit($id)
    {
      
	$programs =DB::table('program')->where('id',$id)->get();
	foreach(@$programs  as $prog_info){
	$program = $prog_info;
	}
	$programsdetails  = DB::table('program_details')->where('program_id',$id)->get();
	foreach(@$programsdetails  as $programssdetails){
	$program_details = $programssdetails;
	}
	
	if(isset($program)&& $program <>''){
	return $this->load_admin_theme('program','edit',array('program'=>$program,'program_details'=>@$program_details)); 
	}else{
	return Redirect::route('cpanel.program.index')
	->with('danger', 'Requested Enterprise not found');
	      }
       
    }

   //inserting program details
   public function store() 
    {    
    
       	 $rules=array();
         $rules['pgm_name'] = 'required|alpha_num|alpha';
         $rules['pgm_url'] = 'required';
         $rules['image'] = 'required';
         $rules['pgm_desc'] = 'required|max:500';
         $rules['pgm_faqs'] = 'required';
         $rules['about_us'] = 'required|max:500';
         $rules['checkout_mode'] = 'required';
         $rules['pgm_code'] = 'required';
         $rules['pgm_status'] = 'required';
         $rules['time_bound'] = 'required';
         $rules['start_date'] = 'required';
         $time_bouund = Input::get('time_bound');
         if($time_bouund == 1){
          $rules['to_date'] = 'required';
         }
          
	 $validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	      {
	         return Redirect::route('cpanel.program.create')
                 ->withInput()
                 ->withErrors($validator->messages());
	      }else
                  {      
                    $file = Input::file('image');
                    $destinationPath    = base_path().'/public/uploads/program_images/'; // The destination were you store the image.
                    $filename    = $file->getClientOriginalName(); // Original file name that the end user used for it.
                    $mime_type = $file->getMimeType(); // Gets this example image/png
                    $extension = $file->getClientOriginalExtension(); // The original extension that the user used example .jpg or .png.
                    $upload_success =  $file->move($destinationPath, $filename);
                  
			$id = DB::table('program')->insertGetId(array(
                        'pgm_name'=> Input::get('pgm_name'),
			'pgm_url'=> Input::get('pgm_url'),
			'pgm_desc'=>     Input::get('pgm_desc'),
			'image'=>     $filename,
			'pgm_faqs'=> Input::get('pgm_faqs'),
                        'about_us'=>    Input::get('about_us'),
                        'checkout_mode'=>    Input::get('checkout_mode'),
                        'pgm_code'=>    Input::get('pgm_code'),
                        'user_code'=>    Input::get('user_code'),
                        'pgm_status'=>    Input::get('pgm_status'),
                        'time_bound'=>    Input::get('time_bound'),
                        'start_date'=> Input::get('time_bound'),
                        'to_date'=> Input::get('to_date'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => '',
                        'approved_by' => '',
                        
                         ));
                       $enterprise_details_id = DB::table('program_details')->insertGetId(array(
                       'program_id'=>  $id,
                        'first_name'    =>     !empty(Input::get('first_name')) ? Input::get('first_name') : 0 ,
			'last_name'     =>    !empty(Input::get('last_name')) ? Input::get('last_name') : 0, 
			'dob'		=>    !empty(Input::get('dob')) ? Input::get('dob') : 0, 
			'email'		=>    !empty(Input::get('email')) ? Input::get('email') : 0, 
			'mobile'	=>    !empty(Input::get('mobile')) ? Input::get('mobile') : 0, 
			'member_tier'	=>    !empty(Input::get('member_tier')) ? Input::get('member_tier') : 0, 
			'point_to_cash'	=>    !empty(Input::get('point_to_cash')) ? Input::get('point_to_cash') : 0, 
			'member_or_account'=>    !empty(Input::get('member_or_account')) ? Input::get('member_or_account') : 0, 
			'mother_madien_name'=>   !empty( Input::get(' mother_madien_name')) ? Input::get('mother_madien_name') : 0,
			'father_name'=>    !empty(Input::get('father_name')) ? Input::get('father_name') : 0, 
			'gender'=>   !empty(Input::get('gender')) ? Input::get('status') : 0, 
			'anniversary_date'=>    !empty(Input::get('anniversary_date')) ? Input::get('first_name') : 0, 
			'status'=>    !empty(Input::get('status')) ? Input::get('first_name') : 0, 
			'id_proof_type'=>    !empty(Input::get('id_proof_type')) ? Input::get('id_proof_type') : 0, 
			'id_proof_number'=>    !empty(Input::get('id_proof_number')) ? Input::get('id_proof_number') : 0, 
			'add_proof_type'=>    !empty(Input::get('add_proof_type')) ? Input::get('add_proof_type') : 0, 
			'add_proof_number'=>    !empty(Input::get('add_proof_number')) ? Input::get('add_proof_number') : 0, 
                        'address1'=>    !empty(Input::get('address1')) ? Input::get('address1') : 0,
                        'address2'=>    !empty(Input::get('address2')) ? Input::get('address2') : 0,
                        'city'=>    !empty(Input::get('city')) ? Input::get('city') : 0,
                        'state'=>    !empty(Input::get('state')) ? Input::get('state') : 0,
                        'pincode'=>    !empty(Input::get('pincode')) ? Input::get('pincode') : 0,
                        'maker_comment'=>     Input::get('maker_comment') ,
                        'checker_comment'=>    Input::get('checker_comment') ,
                        'other_details'=>     Input::get('other_details') 
                        ,));
			return Redirect::route('cpanel.program.index')
			->with('success','Program created');
               }
 
    }


   //updating the program details
    public function update($id)
    {
	 
	 
         $rules=array();
         $rules['pgm_name'] = 'required|alpha_num|alpha';
         $rules['pgm_url'] = 'required';
          $file = Input::file('image');
          if(!empty($file)){  
          $rules['image'] = 'required';
          }
         $rules['pgm_desc'] = 'required|max:500';
         $rules['pgm_faqs'] = 'required';
         $rules['about_us'] = 'required|max:500';
         $rules['checkout_mode'] = 'required';
         $rules['pgm_code'] = 'required';
         $rules['pgm_status'] = 'required';
         $rules['time_bound'] = 'required';
         $rules['start_date'] = 'required';
         $time_bouund = Input::get('time_bound');
         if($time_bouund == 1){
          $rules['to_date'] = 'required';
         }
         
         
         $validator = Validator::make(Input::all(), $rules);
	
	if ($validator->fails())
	{
	return Redirect::back()
	->withInput()
	->withErrors($validator->errors());
	}else{     $file = Input::file('image');
	           
	           $program= array();
	           $program_details = array();
	            if(!empty($file)){  
	             $file = Input::file('image');
	             $destinationPath    = base_path().'/public/uploads/program_images/'; 
                     $filename    = $file->getClientOriginalName(); 
                     $mime_type = $file->getMimeType(); 
                     $extension = $file->getClientOriginalExtension(); 
                     $upload_success =  $file->move($destinationPath, $filename);
	             $old_images =DB::table('program')->select('image')->where('id',$id)->get();
	            foreach($old_images as $image){
	            $old_image = $image->image;
	            }
	            if (file_exists( base_path().'/public/uploads/program_images/'. $old_image)) {
	             $file = base_path().'/public/uploads/program_images/'. $old_image;
                     unlink($file);
                     }
                     
                     }
                       
	                $program['pgm_name']	= Input::get('pgm_name');
			$program['pgm_url']	= Input::get('pgm_url');
			$program['pgm_desc']	=     Input::get('pgm_desc');
			 if(!empty($filename)){
			  $program['image']	=    $filename;
                         }
			$program['pgm_faqs']	= Input::get('pgm_faqs');
                        $program['about_us']	=    Input::get('about_us');
                        $program['checkout_mode']=    Input::get('checkout_mode');
                        $program['pgm_code']	=    Input::get('pgm_code');
                        $program['user_code']	=    Input::get('user_code');
                        $program['pgm_status']	=    Input::get('pgm_status');
                        $program['time_bound']	=    Input::get('time_bound');
                        $program['start_date']	= Input::get('time_bound');
                        $program['to_date']	=Input::get('to_date');
                        $program['updated_at'] 	= date('Y-m-d H:i:s');
                        $program['created_by'] 	= '';
                        $program['approved_by'] 	= '';
                        
                         DB::table('program')->where('id', $id)->update($program);
                          
                        $program_details['first_name']   = !empty(Input::get('first_name')) ? Input::get('first_name') : 0;
			$program_details['last_name']    = !empty(Input::get('last_name')) ? Input::get('last_name') : 0; 
			$program_details['dob']		 = !empty(Input::get('dob')) ? Input::get('dob') : 0; 
			$program_details['email']	 = !empty(Input::get('email')) ? Input::get('email') : 0; 
			$program_details['mobile']	 = !empty(Input::get('mobile')) ? Input::get('mobile') : 0; 
			$program_details['member_tier']	 = !empty(Input::get('member_tier')) ? Input::get('member_tier') : 0; 
			$program_details['point_to_cash']= !empty(Input::get('point_to_cash')) ? Input::get('point_to_cash') : 0; 
			$program_details['member_or_account'] = !empty(Input::get('member_or_account')) ? Input::get('member_or_account') : 0; 
			$program_details['mother_madien_name']= !empty( Input::get(' mother_madien_name')) ? Input::get('mother_madien_name') : 0;
			$program_details['father_name']	      = !empty(Input::get('father_name')) ? Input::get('father_name') : 0; 
			$program_details['gender']            = !empty(Input::get('gender')) ? Input::get('status') : 0; 
			$program_details['anniversary_date']  = !empty(Input::get('anniversary_date')) ? Input::get('first_name') : 0; 
			$program_details['status']            = !empty(Input::get('status')) ? Input::get('first_name') : 0;
			$program_details['id_proof_type']     = !empty(Input::get('id_proof_type')) ? Input::get('id_proof_type') : 0; 
			$program_details['id_proof_number']   = !empty(Input::get('id_proof_number')) ? Input::get('id_proof_number') : 0; 
			$program_details['add_proof_type']    = !empty(Input::get('add_proof_type')) ? Input::get('add_proof_type') : 0; 
			$program_details['add_proof_number']  = !empty(Input::get('add_proof_number')) ? Input::get('add_proof_number') : 0; 
                        $program_details['address1']          = !empty(Input::get('address1')) ? Input::get('address1') : 0;
                        $program_details['address2']          = !empty(Input::get('address2')) ? Input::get('address2') : 0;
                        $program_details['city']              = !empty(Input::get('city')) ? Input::get('city') : 0;
                        $program_details['state']             = !empty(Input::get('state')) ? Input::get('state') : 0;
                        $program_details['pincode']           = !empty(Input::get('pincode')) ? Input::get('pincode') : 0;
                        $program_details['maker_comment']     =  Input::get('maker_comment');
                        $program_details['checker_comment']   =  Input::get('checker_comment');
                        $program_details['other_details']     =  Input::get('other_details');
                         
	                DB::table('program_details')->where('program_id', $id)->update($program_details);
	return Redirect::route('cpanel.program.index')
	->with('success','Program updated');
	}

          
    }

   
    //deactivating the program
    public function putDeactivate($id)
    {   
	if(isset($id)&&$id<>''){
	$update = array('pgm_status'=>0);
	DB::table('program')->where('id', $id)->update( $update);
	return Redirect::route('cpanel.program.index')
	->with('success','Program Deactivated');
	}else{
	return Redirect::route('cpanel.program.index')
	->with('danger', 'Requested Program Not Found');
	}
    }
  
    //Activating the program
     public function putActivate($id)
    {  
	if(isset($id)&&$id<>''){
	$update = array('pgm_status'=>1);
	DB::table('program')->where('id', $id)->update( $update);
	return Redirect::route('cpanel.program.index')->with('success','Program Activated');
	}else{
	return Redirect::route('cpanel.clients.index')
	->with('danger', 'Requested Program not found');
	} 
    }
    
    /*
    
     public function destroy($id)
    {
	$client = Client::find($id);
	if(isset($client)&&$client<>''){
	$client->delete();
	return Redirect::route('cpanel.clients.index')
	->with('success','Client deleted');
	}else{
	return Redirect::route('cpanel.clients.index')
	->with('danger', 'Requested client not found');
	}
    }

    
   */

}
