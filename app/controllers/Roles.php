<?php 
class Roles extends AdminBaseController {
protected $roles;

   public function index()
     {
	// $roles = Role::paginate( Config::get('15'));
        $roles=DB::table('roles')->get();
	return $this->load_admin_theme('roles','index',array('roles'=>$roles));      
     }

    public function show($id)
    {
	$role =Role::find($id);
	if(isset($role)&&$role<>''){
	return $this->load_admin_theme('roles','show',array('role'=>$role)); 
	}else{
	return Redirect::route('cpanel.roles.index')
	->with('danger', 'Requested role not found');
	     }
    }


    public function create(){
        $images = array();
	return $this->load_admin_theme('roles','create',array('images'=>$images)); 
    }
 

  public function edit($id)
    {
	$role =Role::find($id);
	$data['role']=$role;
                 
        if(isset($role)&&$role<>''){
	return $this->load_admin_theme('roles','edit',$data); 
	}else{
	return Redirect::route('cpanel.roles.index')
	->with('danger', 'Requested role not found');
	}
       
    }

   public function store() 
    {  
         $rules=array();
         $rules['name'] = 'required|min:3|max:30|unique:roles,name';

         $validator = Validator::make(Input::all(), $rules);
          	if ($validator->fails())
		  {
			return Redirect::route('cpanel.roles.create')
			->withInput()
			->withErrors($validator->messages());
		  }else{
         $id = DB::table('roles')->insertGetId(array(
	'name'          =>   Input::get('name'),
        'created_at'    =>   date('Y-m-d H:i:s'),
          ));

	return Redirect::route('cpanel.roles.index')
	->with('success','Roles created');
	}		
  }

    public function update($id)
    {
	
	$rules=array();
	$rules['name'] = 'required|min:3|max:30,'.$id.'';
	$validator = Validator::make(Input::all(), $rules);
               if ($validator->fails())
	         {
			return Redirect::back()
			->withInput()
			->withErrors($validator->messages());
	        }else{
	$role['name'] = Input::get('name');
	$role['updated_at'] = date('Y-m-d H:i:s');
	DB::table('roles')->where('id',$id)->update($role);
	return Redirect::route('cpanel.roles.index')
	->with('success','role updated');
	}
	}

          
   

    public function destroy($id)
    {
	$client = Partner::find($id);
	if(isset($client)&&$client<>''){
	$client->delete();
	return Redirect::route('cpanel.partners.index')
	->with('success','Partners deleted');
	}else{
	return Redirect::route('cpanel.partners.index')
	->with('danger', 'Requested client not found');
	}
    }


    public function putDeactivate($id)
    {
	$client = Partner::find($id);
	if(isset($client)&&$client<>''){
	$client->active=   0;
	$client->save();
	return Redirect::route('cpanel.partners.index')
	->with('success','Partners deactive');
	}else{
	return Redirect::route('cpanel.partners.index')
	->with('danger', 'Requested client not found');
	}
    }


    public function putActivate($id)
    {
	$client = Partner::find($id);
	if(isset($client)&&$client<>''){
	$client->active=   1;
	$client->save();
	return Redirect::route('cpanel.partners.index')
	->with('success','Partners active');
	}else{
	return Redirect::route('cpanel.partners.index')
	->with('danger', 'Requested client not found');
	} 

    }

}
