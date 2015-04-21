<?php 
class Enterprise extends AdminBaseController {
protected $clients;

   public function index()
    {
	 //$enterprise = Enterprises::paginate( Config::get('15'));
	$enterprise =Enterprises::where('role_id', '=', 2)->get();
	return $this->load_admin_theme('enterprise','index',array('enterprise'=>$enterprise));      
    }

    public function show($id)
    {
	$enterprise =Enterprises::find($id);
	if(isset($enterprise)&& $enterprise<>''){
	return $this->load_admin_theme('enterprise','show',array('enterprise'=>$enterprise)); 
	}else{
	return Redirect::route('cpanel.enterprise.index')
	->with('danger', 'Requested Enterprise not found');
	     }
    }

   
    public function create(){
    $images = array();
    $states = DB::table('states')->where('country_code', 'IN')->get();
    $cities  = DB::table('cities')->where('country_code', 'IN')->get();
    return $this->load_admin_theme('enterprise','create',array('images'=>$images,'states'=>$states,'cities'=>$cities));
    }
 
   public function edit($id)
    {
      
	$enterprise =Enterprises::find($id);
	$enterprisedetails  = DB::table('enterprise_details')->where('enterprise_id',$id)->get();
	foreach(@$enterprisedetails  as $enterprisedetail){
	$enterprise_details = $enterprisedetail;
	}
	$states = DB::table('states')->where('country_code', 'IN')->get();
        $cities  = DB::table('cities')->where('country_code', 'IN')->get();
	if(isset($enterprise)&& $enterprise <>''){
	return $this->load_admin_theme('enterprise','edit',array('enterprise'=>$enterprise,'enterprise_details'=>@$enterprise_details,'states'=>$states,'cities'=>$cities)); 
	}else{
	return Redirect::route('cpanel.enterprise.index')
	->with('danger', 'Requested Enterprise not found');
	      }
       
    }

   public function store() 
    {     
	$input = Input::all();
         
       	 $rules=array();
         $rules['enterprise_name'] = 'required|min:3|max:30|alpha_num|alpha';
         $rules['email'] = 'required|email|unique:users,email';
         $rules['password'] = 'required|confirmed';
         $rules['phone'] = 'required|numeric';
         $rules['enterprise_code'] = 'required|min:3|max:30';
         $rules['vat_number'] = 'required|AlphaNum|max:20';
         $rules['st_number'] = 'required|AlphaNum|max:20';
         $rules['tin_number'] = 'required|AlphaNum|max:20';
         $rules['pan_number'] = 'required|AlphaNum|max:12';
         $rules['etp_creation'] = 'required|numeric|between:1,3';
         $rules['active_number_of_time'] = 'required|numeric|between:1,3';
         $rules['status'] = 'required';
       
         $messages = array('password.confirmed' => 'Password does not matches');
          if(!empty($_POST['address1'])){
          $rules['address1'] = 'max:100';
          }
          if(!empty($_POST['address2'])){
          $rules['address2'] = 'max:100';
          } 
           if(!empty($_POST['pincode'])){
            $rules['pincode'] = 'min:6';
          } 
           if(!empty($_POST['contact1_firstname'])){
          $rules['contact1_firstname'] = 'min:2|max:15';
          }
           if(!empty($_POST['contact1_lasttname'])){
          $rules['contact1_lasttname'] = 'min:1|max:15';
          } 
           if(!empty($_POST['contact1_mobile_no'])){
          $rules['contact1_mobile_no'] = 'numeric';
        
          } 
          if(!empty($_POST['contact1_landline_no'])){
          $rules['contact1_landline_no'] = 'numeric';
          } 
           if(!empty($_POST['contact1_email'])){
          $rules['contact1_email'] = 'email';
          }  
           if(!empty($_POST['contact2_firstname'])){
          $rules['contact2_firstname'] = 'min:2|max:15';
          }
           if(!empty($_POST['contact2_lasttname'])){
          $rules['contact2_lasttname'] = 'min:1|max:15';
          } 
           if(!empty($_POST['contact2_mobile_no'])){
          $rules['contact2_mobile_no'] = 'numeric';
          } 
          if(!empty($_POST['contact2_landline_no'])){
          $rules['contact2_landline_no'] = 'numeric';
          } 
           if(!empty($_POST['contact2_email'])){
          $rules['contact2_email'] = 'email';
          }
          if(!empty($_POST['maker_comment'])){
          $rules['maker_comment'] = 'max:100';
          } 
          if(!empty($_POST['checker_comment'])){
          $rules['checker_comment'] = 'max:100';
          } 
          if(!empty($_POST['other_details'])){
          $rules['other_details'] = 'max:100';
          }  
	 $validator = Validator::make(Input::all(), $rules,$messages);

	    if ($validator->fails())
	      {
	         return Redirect::route('cpanel.enterprise.create')
                 ->withInput()
                 ->withErrors($validator->messages());
	      }else
                  {      
                  $user['email'] = Input::get('email');
                  $user['username'] = Input::get('enterprise_name');
               
                    $password = sha1(Input::get('password'));
                        $active =0;
			if(Input::get('status') == 1){$active = 1;}
			            
			$id = DB::table('users')->insertGetId(array(
                        'name'=> Input::get('enterprise_name'),
			'email'=> Input::get('email'),
			'password'=>$password,
			'landline'=>     Input::get('phone'),
			'user_code'=>     Input::get('enterprise_code'),
			'vat'=> Input::get('vat_number'),
			'role_id'=> 2,
                        'st_number'=>    Input::get('st_number'),
                        'tin_number'=>    Input::get('tin_number'),
                        'PAN'=>    Input::get('pan_number'),
                        'program_limit'=>    Input::get('etp_creation'),
                        'active_limit'=>    Input::get('active_number_of_time'),
                        'status'=>    $active,
                        'activated_at'=> $active,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => '',
                        'approved_by' => '',
                        
                         ));
                       $enterprise_details_id = DB::table('enterprise_details')->insertGetId(array(
                       'enterprise_id'=>  $id,
                        'incorporated_date'=>    Input::get('data_incorp'),
                        'address1'=>    Input::get('address1'),
                        'address2'=>    Input::get('address2'),
                        'city'=>    Input::get('city'),
                        'state'=>    Input::get('state'),
                        'country'=>    Input::get('country'),
                        'pincode'=>    Input::get('pincode'),
                        'cp1_fname'=>    Input::get('contact1_firstname'),
                        'cp1_lname'=>    Input::get('contact1_lastname'),
                        'cp1_mobile'=>    Input::get('contact1_mobile_no'),
                        'cp1_landline'=>    Input::get('contact1_landline_no'),
                        'cp1_email'=>    Input::get('contact1_email'),
                        'cp2_fname'=>    Input::get('contact2_firstname'),
                        'cp2_lname'=>    Input::get('contact2_lastname'),
                        'cp2_mobile'=>    Input::get('contact2_mobile_no'),
                        'cp2_landline'=>    Input::get('contact2_landline_no'),
                        'cp2_email'=>    Input::get('contact2_email'),
                        'maker_comment'=>    Input::get('maker_comment'),
                        'checker_comment'=>    Input::get('checker_comment'),
                        'other_details'=>    Input::get('other_details'),));
                         
                     if (Config::get("auth.emailActivation")) {
                        $data["user"] = $user;
                        $count = Mail::send(Config::get("auth.emailViewPath").".activate", $data, function($message) use ($user,  $user) {
                        $message->to( $user['email'], $user['username'])->subject("Activate your new account");
                       });
                     }        
                            
			return Redirect::route('cpanel.enterprise.index')
			->with('success','Enterprise created');
               }
 
    }

    public function update($id)
    {  
	 $rules =array();
	 
         $rules['enterprise_name'] = 'required|min:3|max:30|alpha_num';
         $rules['email'] = 'required|email|unique:users,email,'.$id.'';
         $rules['phone'] = 'required|numeric';
         $rules['enterprise_code'] = 'required|min:3|max:30';
         $rules['vat_number'] = 'required|AlphaNum|max:20';
         $rules['st_number'] = 'required|AlphaNum|max:20';
         $rules['tin_number'] = 'required|AlphaNum|max:20';
         $rules['pan_number'] = 'required|AlphaNum|max:12';
         $rules['etp_creation'] = 'required|numeric|between:1,3';
         $rules['active_number_of_time'] = 'required|numeric|between:1,3';
         $rules['status'] = 'required';
         
         $messages = array('password.confirmed' => 'Password does not matches');
          if(!empty($_POST['address1'])){
          $rules['address1'] = 'max:100';
          }
          if(!empty($_POST['address2'])){
          $rules['address2'] = 'max:100';
          } 
           if(!empty($_POST['pincode'])){
            $rules['pincode'] = 'min:6';
          } 
           if(!empty($_POST['contact1_firstname'])){
          $rules['contact1_firstname'] = 'min:2|max:15';
          }
           if(!empty($_POST['contact1_lasttname'])){
          $rules['contact1_lasttname'] = 'min:1|max:15';
          } 
           if(!empty($_POST['contact1_mobile_no'])){
          $rules['contact1_mobile_no'] = 'numeric';
        
          } 
          if(!empty($_POST['contact1_landline_no'])){
          $rules['contact1_landline_no'] = 'numeric';
          } 
           if(!empty($_POST['contact1_email'])){
          $rules['contact1_email'] = 'email';
          }  
           if(!empty($_POST['contact2_firstname'])){
          $rules['contact2_firstname'] = 'min:2|max:15';
          }
           if(!empty($_POST['contact2_lasttname'])){
          $rules['contact2_lasttname'] = 'min:1|max:15';
          } 
           if(!empty($_POST['contact2_mobile_no'])){
          $rules['contact2_mobile_no'] = 'numeric';
          } 
          if(!empty($_POST['contact2_landline_no'])){
          $rules['contact2_landline_no'] = 'numeric';
          } 
           if(!empty($_POST['contact2_email'])){
          $rules['contact2_email'] = 'email';
          }
          if(!empty($_POST['maker_comment'])){
          $rules['maker_comment'] = 'max:100';
          } 
          if(!empty($_POST['checker_comment'])){
          $rules['checker_comment'] = 'max:100';
          } 
          if(!empty($_POST['other_details'])){
          $rules['other_details'] = 'max:100';
          }  
         $validator = Validator::make(Input::all(), $rules);
	
	if ($validator->fails())
	{
	return Redirect::back()
	->withInput()
	->withErrors($validator->errors());
	}else{
	            //echo '<pre>'; print_r($_POST); exit;
	                 $active =0;
	                 $password = sha1(Input::get('password'));
			if(Input::get('status') == 1){$active = 1;}
			
			 $enterprise = array();
			 $enterprise_details = array();
			 $password = sha1(Input::get('password'));
                         $enterprise['name'] = Input::get('enterprise_name');
			 $enterprise['email']        = Input::get('email');
			 if(!empty($password)){
			 $enterprise['password']     = $password;
			 }
			 $enterprise['landline']        = Input::get('phone');
			 $enterprise['user_code']            = Input::get('enterprise_code');
			 $enterprise['vat']             = Input::get('vat_number');
                         $enterprise['st_number']	= Input::get('st_number');
                         $enterprise['tin_number']	= Input::get('tin_number');
                         $enterprise['pan']		= Input::get('pan_number');
                         $enterprise['program_limit']	= Input::get('etp_creation');
                         $enterprise['active_limit']	= Input::get('active_number_of_time');
                         $enterprise[ 'status'] =   $active;
                         $enterprise['updated_at'] 	= date('Y-m-d H:i:s');
                         $enterprise['created_by'] 	= '';
                         $enterprise['approved_by'] 	= '';
                        
                         DB::table('users')->where('id', $id)->update($enterprise);
                          
                        $enterprise_details['incorporated_date'] = Input::get('data_incorp');
                        $enterprise_details['address1'] 	=   Input::get('address1');
                        $enterprise_details['address2']	        =   Input::get('address2');
                        $enterprise_details['city']		=   Input::get('city');
                        $enterprise_details['state']	        =   Input::get('state');
                        $enterprise_details['country']	        =   Input::get('country');
                        $enterprise_details['pincode']		=   Input::get('pincode');
                        $enterprise_details['cp1_fname']	=   Input::get('contact1_firstname');
                        $enterprise_details['cp1_lname']	=   Input::get('contact1_lastname');
                        $enterprise_details['cp1_mobile']	=   Input::get('contact1_mobile_no');
                        $enterprise_details['cp1_landline']	=   Input::get('contact1_landline_no');
                        $enterprise_details['cp1_email']	=   Input::get('contact1_email');
                        $enterprise_details['cp2_fname']	=   Input::get('contact2_firstname');
                        $enterprise_details['cp2_lname']	=   Input::get('contact2_lastname');
                        $enterprise_details['cp2_mobile']	=   Input::get('contact2_mobile_no');
                        $enterprise_details['cp2_landline']	=   Input::get('contact2_landline_no');
                        $enterprise_details['cp2_email']	=   Input::get('contact2_email');
                        $enterprise_details['maker_comment']	=   Input::get('maker_comment');
                        $enterprise_details['checker_comment']	=   Input::get('checker_comment');
                        $enterprise_details['other_details']	=   Input::get('other_details'); 
                         
	                DB::table('enterprise_details')->where('enterprise_id', $id)->update($enterprise_details);
	return Redirect::route('cpanel.enterprise.index')
	->with('success','Enterprise updated');
	}

          
    }

   
    //deactivating the eneterprise
    public function putDeactivate($id)
    {   
	if(isset($id)&&$id<>''){
	$update = array('activated'=>0,'status'=>0);
	DB::table('users')->where('id', $id)->update( $update);
	return Redirect::route('cpanel.enterprise.index')
	->with('success','Enterprise Deactivated');
	}else{
	return Redirect::route('cpanel.enterprise.index')
	->with('danger', 'Requested Enterprise Not Found');
	}
    }

     public function putActivate($id)
    {
	if(isset($id)&&$id<>''){
	$update = array('activated'=>1,'status'=>1);
	DB::table('users')->where('id', $id)->update( $update);
	return Redirect::route('cpanel.enterprise.index')->with('success','Enterprise Activated');
	}else{
	return Redirect::route('cpanel.clients.index')
	->with('danger', 'Requested Enterprise not found');
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
