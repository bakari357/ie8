@extends('cpanel::layouts')

@section('header')
<h1>Users</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.users.index')}}">
        <i class="fa fa-user"></i>
        Users
    </a>
</li>
@stop

@section('content')
<div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">User</a> </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3>Create - <span class="semi-bold">New user</span></h3>
      </div>
 <?php
            $option = array(
                'route' => 'cpanel.users.store',
                'class' => 'form-no-horizontal-spacing',
		'id'=>'form-condensed'
            );
            ?>
            {{ Form::open($option) }}

    <div class="row">
        <div class="col-md-12">
          <div class="tabbable">

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#credentials" data-toggle="tab">User Credentials</a>
                            </li>
                            <li>
                                <a href="#permissions" data-toggle="tab">User Permissions</a>
                            </li>
                        </ul>
     <div class="tab-content">

                            <div class="tab-pane active" id="credentials">
          <div class="grid simple">
            <div class="grid-title no-border">
              <div class="tools"> </div>
            </div>
            <div class="grid-body no-border">
     
              <div class="row column-seperation">
                <div class="col-md-6">
                  <h4>Basic Information</h4>            
                    <div class="row form-row">
                      <div class="col-md-5">
 {{ Form::text('First_Name',null,array('class'=>'form-control','placeholder'=>'First Name','id'=>'First_Name')) }} 
                        
                      </div>
                      <div class="col-md-7">
                        {{ Form::text('Last_Name',null,array('class'=>'form-control','placeholder'=>'Last Name','id'=>'Last_Name')) }}
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-5">
                        {{ Form::text('LandlineNumber',null,array('class'=>'form-control','placeholder'=>'Landline Number','id'=>'LandlineNumber')) }}
                      </div>
                      <div class="col-md-7">
                       <div class="input-append success date col-md-10 col-lg-6 no-padding">
                    <input type="text" class="form-control">
                    <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> </div>
                  <br>
                  <br>
                  <div class="clearfix"></div>
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-8">
                        <div class="radio">
                          <input id="male" type="radio" name="gender" value="male" checked="checked">
                          <label for="male">Male</label>
                          <input id="female" type="radio" name="gender" value="female">
                          <label for="female">Female</label>
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        {{ Form::email('email',null,array('class'=>'form-control','placeholder'=>'Email','id'=>'email')) }}
                      </div>
                    </div>
			<div class="row form-row">
                      <div class="col-md-6">
                        <select id="source" name="city" style="width:100%">
                    <optgroup label="City Name">
                                          
                      <?php if(isset($cities)) { 
                        foreach ($cities as $city) {
                      

               ?>
                                            
                                            <option  value="<?php echo $city->id; ?>" ><?php echo $city->city; ?></option>
<?php } } ?>
                                        </select>
                      </div>
                      <div class="col-md-6">
                        <select id="source" name="state" style="width:100%">
                    <optgroup label="State Name">
              <?php if(isset($states)) { 
                   foreach ($states as $state) { ?>
                                            
                                            <option  value="<?php echo $state->adminCode1; ?>"><?php echo $state->adminName1; ?></option>
<?php } }?>
                                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-8">
                        <?php $country = array(''=>'Select country','99' => 'India');?>
                               <?php echo Form::select('country',$country,null,array( "style"=>"width:100%","id"=>"source","id"=>"country")); ?>
                      </div>
                      <div class="col-md-4">
                       {{ Form::text('Pincode',null,array('class'=>'form-control','placeholder'=>'Pincode','id'=>'Pincode')) }}
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <input name="form3TeleCode" id="form3TeleCode" type="text"  class="form-control" placeholder="+91">
                      </div>
                      <div class="col-md-8">
                        {{ Form::text('MobileNumber',null,array('class'=>'form-control','placeholder'=>'Mobile Number','id'=>'MobileNumber')) }}
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
				
                  <h4>Extended Information</h4>
                  
                    <div class="row form-row">
                      <div class="col-md-12">
                         {{ Form::text('AddressLine1',null,array('class'=>'form-control','placeholder'=>'Address1','id'=>'AddressLine1')) }}
                      </div>
                    </div>
			<div class="row form-row">
                      <div class="col-md-12">
                        {{ Form::text('AddressLine2',null,array('class'=>'form-control','placeholder'=>'Address2','id'=>'AddressLine2')) }}
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                       {{ Form::text('Mcomments',null,array('class'=>'form-control ','placeholder'=>'Maker comment')) }}
                      </div>
                    </div>
			<div class="row form-row">
                      <div class="col-md-12">
                         {{ Form::text('Comments',null,array('class'=>'form-control ','placeholder'=>'Checker comment')) }}
                      </div>
                    </div>
			<div class="row form-row">
                      <div class="col-md-12">
                         {{ Form::text('Details',null,array('class'=>'form-control ','placeholder'=>'other Details')) }}
                      </div>
                    </div>
                    <div class="row small-text">
					
					</div>
             
                </div>
              </div><br><br><br>
          
					
					<div class="pull-right">
                                              
					  <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
					  <button class="btn btn-white btn-cons" type="button">Cancel</button>
					</div>
				
			
            </div>
          </div>
        </div>

<div class="tab-pane" id="permissions">
                                <p class="lead margin-top-10">Permissions set here will override groups permissions</p>
                                @include('cpanel::users.permissions_form')
</div>
      </div>
                            </div>

      </div></div>
{{Form::close()}}
@stop
