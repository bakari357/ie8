@extends('cpanel::layouts')
<style>
img {
    max-width:192px;
    max-height:192px;
    border:1px solid #000;
}
</style>
@section('header')
<h1>Enterprises</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.enterprise.index')}}">
        <i class="fa fa-user"></i>
        Clients
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php
            
 
      $option = array(
                'route' => 'cpanel.enterprise.store',
                'class' => 'form-horizontal',
                'files' =>true
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new enterprise</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                       <legend class="margin-top-10">Enterprise Information</legend>
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
                                    <label class="col-sm-2 control-label" for="title">Enterprise Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('enterprise_name',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Email</label>
                                    <div class="col-md-4">
                                        {{ Form::text('email',null,array('class'=>'form-control')) }}
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
                                    
                                        {{ Form::text('phone',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Enterprise Code</label>
                                    <div class="col-md-4">
                                        {{ Form::text('enterprise_code',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  
                                  
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">VAT Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('vat_number',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                               
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">ST Number</label>
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
                                    <label class="col-sm-2 control-label" for="title">PAN Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pan_number',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">No of Enterprise Creation</label>
                                    <div class="col-md-4">
                                        {{ Form::text('etp_creation',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Active No of Times</label>
                                    <div class="col-md-4">
                                        {{ Form::text('active_number_of_time',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Status</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('status', '1') }}
                                    </div>
                                </div>
                                  
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
					  <a class="btn btn-primary" href="{{route('cpanel.enterprise.index')}}">Cancel</a>
                                    </div>
                                </div>
                            


                                
                            </div>

                     <div class="tab-pane" id="images">
                        <?php
            
 
      $option = array(
                'route' => 'cpanel.enterprise.store',
                'class' => 'form-horizontal',
                'files' =>true
            );
            ?> {{ Form::open($option) }}
                               <div class="form-group">
                                   <label class="col-sm-2 control-label" for="title">Date of Incorporation</label>
                                    <div class="col-md-4">
                                        {{ Form::text('data_incorp',null,array('id'=>'data_incorp','class'=>'form-control')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Address 1</label>
                                    <div class="col-md-4">
                                        {{ Form::text('address1',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Address 2</label>
                                    <div class="col-md-4">
                                        {{ Form::text('address2',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                
                                
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">State</label>
                                    <div class="col-md-4">
                                         <select id="groups" name="state" class="select2 form-control">
                                       <option selected="selected" value="">State Name</option>
              <?php if(isset($states) && !empty($states)) { 
                   foreach ($states as $state) { ?>
                                            
                                            <option  value="<?php echo $state->adminCode1; ?>"><?php echo $state->adminName1; ?></option>
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
                        foreach ($cities as $city) { ?>
                                            
                                            <option  value="<?php echo $city->id; ?>"><?php echo $city->city; ?></option>
<?php } } ?>
                                        </select>
                                    </div>
                                </div>


                                
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Pincode</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pincode',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Country</label>
                                    <div class="col-md-4">
                                      
                                        <?php $country = array(''=>'Select','99' => 'India');?>
                               <?php echo Form::select('country',$country,null,array( "class"=>"form-control")); ?>
                                    </div>
                                </div>
              
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person 1 First Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact1_firstname',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>    
                                
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person 1 Last Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact1_lastname',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>   
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  1 Mobile Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact1_mobile_no',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>   
                                   
                                
                                <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  1 Landline Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact1_landline_no',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>   
                                   
                                   <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  1 Email</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact1_email',null,array('class'=>'form-control')) }}
                                    </div>
                                </div> 
                                 
                                 
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person 2 First Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact2_firstname',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>    
                                
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person 2 Last Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact2_lastname',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>   
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  2 Mobile Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact2_mobile_no',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>   
                                   
                                
                                <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person  2 Landline Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact2_landline_no',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>   
                                   
                                   <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Contact Person 2 Email</label>
                                    <div class="col-md-4">
                                        {{ Form::text('contact2_email',null,array('class'=>'form-control')) }}
                                    </div>
                                </div> 
                                 
                                  
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Maker Comment</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('maker_comment',null,array('class'=>'form-control ckeditor','placeholder'=>'Maker Comment')) }}
                                    </div>
                                      </div>
                                 
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Checker Comment</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('checker_comment',null,array('class'=>'form-control ckeditor','placeholder'=>'Maker Comment')) }}
                                    </div>
                                   </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Other Details</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('other_details',null,array('class'=>'form-control ckeditor','placeholder'=>'Maker Comment')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
					  <a class="btn btn-primary" href="{{route('cpanel.enterprise.index')}}">Cancel</a>
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

