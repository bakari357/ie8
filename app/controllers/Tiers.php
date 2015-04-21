<?php 
class Tiers extends AdminBaseController {
protected $wallets;

   public function index()
     {
	 $tiers = Tier::paginate( Config::get('15'));
       // $wallets=Wallet::where('role_id', '=', '3')->where('sub_user','<>',1)->get();
	return $this->load_admin_theme('tiers','index',array('tiers'=>$tiers));      
     }

    public function show($id)
    {
	$tiers =Tier::find($id);
	if(isset($partner)&&$partner<>''){
	return $this->load_admin_theme('tiers','show',array('tiers'=>$tiers)); 
	}else{
	return Redirect::route('cpanel.tiers.index')
	->with('danger', 'Requested tiers not found');
	     }
    }


    public function create(){
        $states = DB::table('states')->where('country_code', 'IN')->get();
	$cities  = DB::table('cities')->where('country_code', 'IN')->get();
        $images = array();
	return $this->load_admin_theme('tiers','create',array('images'=>$images,'states'=>$states,'cities'=>$cities)); 
    }
 

  public function edit($id)
    {
         $data['states'] = DB::table('states')->where('country_code', 'IN')->get();
           $data['cities']  = DB::table('cities')->where('country_code', 'IN')->get();
	$partner =Partner::find($id);
        $data['partner']=$partner;
         $partnerdetails = DB::table('partner_details')->where('partner_id',$id)->get();
             foreach($partnerdetails as $partners) { $data['partners']=$partners;}         
          if(isset($partner)&&$partner<>''){
	return $this->load_admin_theme('partners','edit',$data); 
	}else{
	return Redirect::route('cpanel.partners.index')
	->with('danger', 'Requested partner not found');
	}
       
    }

   public function store() 
    {  
  // echo'<pre>'; print_r($_POST); exit;
 	 $rules=array();
         $rules['tier_name'] = 'required|Alpha|max:10';
         $rules['tier_level'] =   'required|AlphaNum|max:10';
        
        
	 $validator = Validator::make(Input::all(), $rules);
          	if ($validator->fails())
		  {
			return Redirect::route('cpanel.tiers.create')
			->withInput()
			->withErrors($validator->messages());
		  }else{
			
			
			$wallet_id = DB::table('tiers')->insertGetId(array(
			'tier_name'          =>   Input::get('tier_name'),
			'tier_level'            =>   Input::get('tier_level'),
                        'currency_ratio'            =>   Input::get('pp_currency'),
			'created_on'             =>   date('Y-m-d H:i:s'),
                       'maker_comment'  =>  Input::get('maker_comment'), 
			'checker_comment'=>  Input::get('checker_comment'), 
			'other_details'  =>  Input::get('Details'), 
                        ));

			return Redirect::route('cpanel.tiers.index')
			->with('success','Tiers created');
			}
  }

    public function update($id)
    {
		$rules=array();
		$rules['name'] = 'required|min:3|max:30';
		$rules['email'] = 'required|email|unique:users,email,'.$id.'';
		$rules['landline'] = 'required|numeric';
		$rules['user_code'] = 'required';
		$rules['vat'] = 'required|max:20';
		$rules['st_number'] = 'required|max:20';
		$rules['tin_number'] = 'required|max:20';
		$rules['pan'] = 'required|max:12';
     		// if($_POST['password']<>''){
     		// $rules['password'] = 'required|min:6|confirmed'; }
     		// $messages = array('password.confirmed' => 'Password does not matches');
     		 $validator = Validator::make(Input::all(), $rules);
	         $validator = Validator::make(Input::all(), $rules);
	    if ($validator->fails())
	    {
		     return Redirect::back()
		     ->withInput()
		    ->withErrors($validator->messages());
	    }else{
			//$partner = user::find($id);

                $partner['name'] = Input::get('name');
                $partner['email'] = Input::get('email');
                $partner['landline'] = Input::get('landline');
                $partner['user_code'] = Input::get('user_code');
                $partner['vat'] = Input::get('vat');
                $partner['st_number'] = Input::get('st_number');
                $partner['tin_number'] = Input::get('tin_number');
                $partner['pan'] = Input::get('pan');
                $partner['first_name'] = Input::get('first_name');
                $partner['last_name'] = Input::get('last_name');
                $partner['approved_by'] = Input::get('approved_by');
                $partner['last_login'] = date('Y-m-d H:i:s');
                $partner['updated_at'] = date('Y-m-d H:i:s');       
                DB::table('users')->where('id',$id)->update($partner);

                $partner_details['address1']       =  Input::get('address1');
		$partner_details['address2']       =  Input::get('address2');
		$partner_details['city']           =  Input::get('city');
		$partner_details['state']         =  Input::get('state');
		$partner_details['pincode']        =  Input::get('pincode');
		$partner_details['country']        =  Input::get('country');
		$partner_details['cp1_fname']      =  Input::get('cp1_fname');
		$partner_details['cp1_lname']      =  Input::get('cp1_lname'); 
		$partner_details['cp1_mobile']     =  Input::get('cp1_mobile');
		$partner_details['cp1_landline']   =  Input::get('cp1_landline'); 
		$partner_details['cp1_email']      =  Input::get('cp1_email');
		$partner_details['cp2_fname']      =  Input::get('cp2_fname');
		$partner_details['cp2_lname']      =  Input::get('cp2_lname');
		$partner_details['cp2_mobile']     =  Input::get('cp2_mobile');
		$partner_details['cp2_landline']   =  Input::get('cp2_landline');
                $partner_details['cp2_email']      =  Input::get('cp2_email');
		$partner_details['maker_comment']  =  Input::get('maker_comment'); 
		$partner_details['checker_comment']=  Input::get('checker_comment'); 
		$partner_details['other_details']  =  Input::get('other_details'); 
                DB::table('partner_details')->where('partner_id',$id)->update($partner_details);



/* if($_POST['password']<>''){
                        $partner->password= sha1(Input::get('password'));
                         }
	                $partner->save(); */
			return Redirect::route('cpanel.partners.index')
			->with('success','users updated');
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
