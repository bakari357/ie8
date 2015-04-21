@extends('cpanel::layouts')

@section('header')
<h1>Entity</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.enterprise.index')}}">
        <i class="fa fa-page"></i>
        Entity
    </a>
</li>
<li class="active">Edit</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <?php
        $option = array(
            'route' => array('cpanel.entity.update',$entity->id),
            'method' => 'put',
            'class' => 'form-horizontal'
        );
        ?>
        {{ Form::model($entity,$option) }}
       
       
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Entity  &quot;{{ $entity->name }}&quot;</h3>
                             </div>
            <div class="panel-body">
                <div class="tabbable">

                  
                    <div class="tab-content">
                        <div class="tab-pane active" id="credentials">
                            <div class="margin-top-20">

                                <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#content" data-toggle="tab">Main Description</a>
                            </li>
                            <li>
                                <a href="#images" data-toggle="tab">Extended Description</a>
                            </li>
                        </ul>

                       <div class="tab-content">

                            <div class="tab-pane active" id="content">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Entity Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('entity_name',@$entity->name,array('class'=>'form-control' ,'disabled')) }}   
                                        {{ Form::hidden('entity_name',@$entity->name,array('class'=>'form-control' )) }}   
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Email</label>
                                    <div class="col-md-4">
                                        {{ Form::text('email',@$entity->email,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Password</label>
                                    <div class="col-md-4">
                                        {{ Form::password('password',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Confirm Password</label>
                                    <div class="col-md-4">
                                        {{ Form::password('password_confirmation',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                         
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Phone</label>
                                    <div class="col-md-4">
                                    
                                        {{ Form::text('landline',@$entity->landline,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Entity Code</label>
                                    <div class="col-md-4">
                                        {{ Form::text('entity_code',@$entity->user_code,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  
                                  
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Status</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('entity_status', '1',@$entity->status) }}
                                    </div>
                                </div>
                                  
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a class="btn btn-primary" href="{{route('cpanel.enterprise.index')}}">Cancel</a>
                                    </div>
                                </div>
                            


                                
                            </div>

                     <div class="tab-pane" id="images">
                        
                            
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Address 1</label>
                                    <div class="col-md-4">
                                        {{ Form::text('address1',@$entity_details->address1,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Address 2</label>
                                    <div class="col-md-4">
                                        {{ Form::text('address2',@$entity_details->address2,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                
                             
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">State</label>
                                    <div class="col-md-4">
                                         <select id="groups" name="state" class="select2 form-control">
                                       <option selected="selected" value="">State Name</option>
              <?php if(isset($states) && !empty($states)) { 
                   foreach ($states as $state) { 
                  
                    if( $state->adminCode1==@$entity_details->state) {
                           
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
                        
                          if(@$entity_details->city ==$city->id) {
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
                                 <label class="col-sm-2 control-label" for="title">Pincode</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pincode',@$entity_details->pincode,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Country</label>
                                    <div class="col-md-4">
                                      
                                        <?php $country = array(''=>'Select','99' => 'India');?>
                               <?php echo Form::select('country',$country,@$entity_details->country,array( "class"=>"form-control")); ?>
                                    </div>
                                </div>
              
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  First Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact_firstname',@$entity_details->cp_fname,array('class'=>'form-control')) }}
                                    </div>
                                </div>    
                                
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  Last Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact_lastname',@$entity_details->cp_lname,array('class'=>'form-control')) }}
                                    </div>
                                </div>   
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  Mobile Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact_mobile_no',@$entity_details->cp_mobile,array('class'=>'form-control')) }}
                                    </div>
                                </div>   
                                   
                                
                                <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  Landline Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact_landline_no',@$entity_details->cp_landline,array('class'=>'form-control')) }}
                                    </div>
                                </div>   
                                   
                                   <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  Email</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact_email',@$entity_details->cp_email,array('class'=>'form-control')) }}
                                    </div>
                                </div> 
                                 
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Maker Comment</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('maker_comment',@$entity_details->maker_comment,array('class'=>'form-control ckeditor','placeholder'=>'Maker Comment')) }}
                                    </div>
                                      </div>
                                 
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Checker Comment</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('checker_comment',@$entity_details->checker_comment,array('class'=>'form-control ckeditor','placeholder'=>'Maker Comment')) }}
                                    </div>
                                   </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Other Details</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('other_details',@$entity_details->other_details,array('class'=>'form-control ckeditor','placeholder'=>'Maker Comment')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a class="btn btn-primary" href="{{route('cpanel.enterprise.index')}}">Cancel</a>
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
<script type="text/javascript">
    $(function() { 
                //Date range picker
                $('#data_incorp').datepicker({dateFormat: 'yy-mm-dd'}); });
</script>
@stop
