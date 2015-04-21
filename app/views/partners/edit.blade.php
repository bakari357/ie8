@extends('cpanel::layouts')

@section('header')
<h1>Partner</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.partners.index')}}">
        <i class="fa fa-page"></i>
        Partner
    </a>
</li>
<li class="active">Edit</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <?php
        $option = array(
            'route' => array('cpanel.partners.update',$partner->id),
            'method' => 'put',
            'class' => 'form-horizontal'
        );
        ?>
        {{ Form::model($partner,$option) }}
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Partner &quot;{{ $partner->partner_name }}&quot;</h3>
            </div>
            <div class="panel-body">
                    <div class="tabbable">  <legend class="margin-top-10">Partners Information</legend>
                          <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                               <a href="#content" data-toggle="tab">Main Description</a>
                            </li>
                            <li>
                                 <a href="#extdesc" data-toggle="tab">Extended Description</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="content">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Partner Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('name',null,array('class'=>'form-control','placeholder'=>'Partner Name')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">First Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('first_name',null,array('class'=>'form-control','placeholder'=>'Email')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Last Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('last_name',null,array('class'=>'form-control','placeholder'=>'Email')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Email Id</label>
                                    <div class="col-md-4">
                                        {{ Form::text('email',null,array('class'=>'form-control','placeholder'=>'Email')) }}
                                    </div>
                                </div>
                                              
                               
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Landline Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('landline',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Partner code </label>
                                    <div class="col-md-4">
                                        {{ Form::text('user_code',null,array('class'=>'form-control')) }}
                                    </div>
                                    </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title"> VAT </label>
                                    <div class="col-md-4">
                                        {{ Form::text('vat',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                 
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">ST Number </label>
                                    <div class="col-md-4">
                                        {{ Form::text('st_number',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">TIN Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('tin_number',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">PAN</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pan',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Created by</label>
                                    <div class="col-md-4">
                                        {{ Form::text('created_by',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Approved by</label>
                                    <div class="col-md-4">
                                        {{ Form::text('approved_by',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

                                   

                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="active">status</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('activated', '1')}}
                                     </div>
					
                                </div> 
                                
                            </div>

                         <div class="tab-pane" id="extdesc">
         
                                
                      
<div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description"> Address 1 </label>
                                    <div class="col-md-4">
                                        {{ Form::textarea('address1',@$partners->address1,array('class'=>'form-control ','placeholder'=>'Partner address line 1')) }}
                                    </div>
                                </div>


                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Address 2 </label>
                                    <div class="col-md-4">
                                        {{ Form::textarea('address2',@$partners->address2,array('class'=>'form-control ','placeholder'=>'Partner address line 2')) }}
                                    </div>
                                </div>
 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">City</label>
                                    <div class="col-md-4">
                                          <select id="groups" name="city" class="select2 form-control">
                                            <option selected="selected" value="fixed">City Name</option>
                      <?php if(isset($cities)) { 
                        foreach ($cities as $city) { ?>
                                            
                                            <option  value="<?php echo $city->city; ?>"><?php echo $city->city; ?></option>
<?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                 

 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">State</label>
                                    <div class="col-md-4">
                                         <select id="groups" name="state" class="select2 form-control">
                                       <option selected="selected" value="fixed">State Name</option>
              <?php if(isset($states)) { 
                   foreach ($states as $state) { ?>
                                            
                                            <option  value="<?php echo $state->adminName1; ?>"><?php echo $state->adminName1; ?></option>
<?php } }?>
                                        </select>
                                    </div>
                                </div>
<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Pin Code </label>
                                    <div class="col-md-4">
                                        {{ Form::text('pincode',@$partners->pincode,array('class'=>'form-control')) }}
                                    </div>
                                </div>



<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Country</label>
                                    <div class="col-md-4">
                                         <select id="groups" name="country" class="select2 form-control">
                                       <option selected="selected" value="fixed">Country Name</option>
              <?php if(isset($states)) { 
                   foreach ($states as $state) { ?>
                                            
                                            <option  value="<?php echo $state->adminName1; ?>"><?php echo $state->adminName1; ?></option>
<?php } }?>
                                        </select>
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 1 first name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp1_fname',@$partners->cp1_fname,array('class'=>'form-control')) }}
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">last name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp1_lname',@$partners->cp1_lname,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title"> mobile number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp1_mobile',@$partners->cp1_mobile,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">landline number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp1_landline',@$partners->cp1_landline,array('class'=>'form-control')) }}
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">email address</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp1_email',@$partners->cp1_email,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 first name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_fname',@$partners->cp2_fname,array('class'=>'form-control')) }}
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">last name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_lname',@$partners->cp2_lname,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">mobile number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_mobile',@$partners->cp2_mobile,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">landline number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_landline',@$partners->cp2_landline,array('class'=>'form-control')) }}
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">email address</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_email',@$partners->cp2_email,array('class'=>'form-control')) }}
                                    </div>
                                </div>




<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Maker Comment</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('maker_comment',@$partners->maker_comment,array('class'=>'form-control ckeditor','placeholder'=>'marker comment')) }}
                                    </div>
                                </div>








<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description"> Checker Comment</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('checker_comment',@$partners->checker_comment,array('class'=>'form-control ckeditor','placeholder'=>'checker comment')) }}
                                    </div>
                                </div>






<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Other Details</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('other_details',@$partners->other_details,array('class'=>'form-control ckeditor','placeholder'=>'other details')) }}
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
					  <a class="btn btn-primary" href="{{route('cpanel.partners.index')}}">Cancel</a>
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
