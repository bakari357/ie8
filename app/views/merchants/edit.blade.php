@extends('cpanel::layouts')

@section('header')
<h1>Merchants</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.merchants.index')}}">
        <i class="fa fa-page"></i>
        Merchants
    </a>
</li>
<li class="active">Edit</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <?php
        $option = array(
            'route' => array('cpanel.merchants.update',$merchant->id),
            'method' => 'put',
            'class' => 'form-horizontal'
        );
        ?>
        {{ Form::model($merchant,$option) }}
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Merchant &quot;{{ $merchant->name }}&quot;</h3>
            </div>
            <div class="panel-body">
                <div class="tabbable">
           
               
                    <div class="tab-content">
                        <div class="tab-pane active" id="credentials">
                            <div class="margin-top-20">

                      <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Merchant Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('name',null,array('class'=>'form-control','placeholder'=>'merchant Name')) }}
 
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">First Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('first_name',null,array('class'=>'form-control','placeholder'=>'first Name')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Last Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('last_name',null,array('class'=>'form-control','placeholder'=>'last Name')) }}
                                    </div>
                                </div> 
                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Landline number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('line_number',$merchant->landline,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Merchants Code</label>
                                    <div class="col-md-4">
                                        {{ Form::text('merchant_code',@$merchant->user_code,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">VAT number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('vat_number',@$merchant->vat,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">ST number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('st_number',@$merchant->st_number,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">TIN number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('tin_number',@$merchant->tin_number,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">PAN number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pan_number',@$merchant->pan,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  
				
                                     <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">State</label>
                                    <div class="col-md-4">
                                         <select id="groups" name="state" class="select2 form-control">
                                       <option selected="selected" value="">State Name</option>
              <?php if(isset($states) && !empty($states)) { 
                   foreach ($states as $state) { 
                  
                    if( $state->adminCode1==@$merchants_details->state) {
                           
                           $selected = "SELECTED";
                          }else {
                          $selected = "";
                          }
                   ?>
                                            
                                            <option  value="<?php echo $state->adminCode1; ?>" <?php echo $selected; ?>><?php echo $state->adminName1; ?></option>
<?php } }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">City</label>
                                    <div class="col-md-4">
                                          <select id="groups" name="city" class="select2 form-control">
                                            <option selected="1" value="">City Name</option>
                                          
                      <?php if(isset($cities)) { 
                        foreach ($cities as $city) { 
                        
                          if(@$merchants_details->city ==$city->id) {
                           $selected = "SELECTED";
                          }else {
                          $selected = " ";
                          }
                        ?>
                        
                                            
                                            <option  value="<?php echo $city->id;  ?> " <?php echo $selected; ?>><?php echo $city->city; ?></option>
<?php } } ?>
                                        </select>
                                        
                                        
                                    </div>
                                </div>
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Country</label>
                                    <div class="col-md-4">
                                      
                                        <?php $country = array(''=>'Select','99' => 'India');?>
                               <?php echo Form::select('country',$country,@$merchants_details->country,array( "class"=>"form-control")); ?>
                                    </div>
                                </div>
                               
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Address1</label>
                                    <div class="col-md-4">
                                        {{ Form::text('address1',@$merchants_details->address1,array('class'=>'form-control','placeholder'=>'Address 1')) }}
                                    </div>
                                </div>
    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Address2</label>
                                    <div class="col-md-4">
                                        {{ Form::text('address2',@$merchants_details->address2,array('class'=>'form-control','placeholder'=>'Address 2')) }}
                                    </div>
                                </div>
                                 
                                 
                               
                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Email</label>
                                    <div class="col-md-4">
                                        {{ Form::text('email',null,array('class'=>'form-control','placeholder'=>'Email')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Password</label>
                                    <div class="col-md-4">
                                        {{ Form::password('password',null,array('class'=>'form-control','placeholder'=>'Password')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Confirm Password</label>
                                    <div class="col-md-4">
                                        {{ Form::password('password_confirmation',null,array('class'=>'form-control','placeholder'=>'Confirm password Name')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">PIN code</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pin_code',@$merchants_details->address1,array('class'=>'form-control','placeholder'=>'pin code')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 1 first name
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cfist_name1',@$merchants_details->cp1_fname,array('class'=>'form-control','placeholder'=>'cantact person 1 first name')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 1 last name
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('clast_name1',@$merchants_details->cp1_lname,array('class'=>'form-control','placeholder'=>'contact person 1 last name')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person  1 mobile number
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cmobile_number1',@$merchants_details->cp1_mobile,array('class'=>'form-control','placeholder'=>'cantact person 1 mobile number')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 1 email address
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cemail1',@$merchants_details->cp1_email,array('class'=>'form-control','placeholder'=>'email')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 first name
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cfist_name2',@$merchants_details->cp2_fname,array('class'=>'form-control','placeholder'=>'first name')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 last name
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('clast_name2',@$merchants_details->cp2_lname,array('class'=>'form-control','placeholder'=>'last name')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 mobile number
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cmobile_number2',@$merchants_details->cp2_mobile,array('class'=>'form-control','placeholder'=>'mobile')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 email address
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cemail2',@$merchants_details->cp2_email,array('class'=>'form-control','placeholder'=>'email')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Maker comment
</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('maker_comm',@$merchants_details->maker_commnet,array('class'=>'form-control ckeditor','placeholder'=>'maker comment')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">checker comment

</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('checker_comm',@$merchants_details->checker_comment,array('class'=>'form-control ckeditor','placeholder'=>'checker comment')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Other details

</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('other_details',@$merchants_details->other_details,array('class'=>'form-control ckeditor','placeholder'=>'Short details')) }}
                                    </div>
                                </div>
                              
                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="active">Active</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('activated', 1,@$merchant->status) }}
                                     </div>
					
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a class="btn btn-primary" href="{{route('cpanel.merchants.index')}}">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                       
                    </div>

                </div>
            </div>
        </div>

        {{Form::close()}}

    </div>
</div>
@stop
