@extends('cpanel::layouts')

@section('header')
<h1>Partners</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.partners.index')}}">
        <i class="fa fa-user"></i>
        Partners
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php


            $option = array(
                'route' => 'cpanel.partners.store',
                'class' => 'form-horizontal',
                 'files' =>true
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new Partner</h3>
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
                                        {{ Form::text('name',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">First Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('first_name',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Last Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('last_name',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Email Id</label>
                                    <div class="col-md-4">
                                        {{ Form::text('email',null,array('class'=>'form-control')) }}
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
                                        {{ Form::textarea('address1',null,array('class'=>'form-control ','placeholder'=>'Partner address line 1')) }}
                                    </div>
                                </div>


                              <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Address 2 </label>
                                    <div class="col-md-4">
                                        {{ Form::textarea('address2',null,array('class'=>'form-control ','placeholder'=>'Partner address line 2')) }}
                                    </div>
                                </div>
 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">City</label>
                                    <div class="col-md-4">
                                          <select id="groups" name="city" class="select2 form-control">
                                            <option selected="1" value="fixed">City Name</option>
                      <?php if(isset($cities)) { 
                        foreach ($cities as $city) { ?>
                                            
                                            <option  value="<?php echo $city->id; ?>"><?php echo $city->city; ?></option>
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
                                            
                                            <option  value="<?php echo $state->adminCode1; ?>"><?php echo $state->adminName1; ?></option>
<?php } }?>
                                        </select>
                                    </div>
                                </div>
<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Pin Code </label>
                                    <div class="col-md-4">
                                        {{ Form::text('pincode',null,array('class'=>'form-control')) }}
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
                                        {{ Form::text('cp1_fname',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">last name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp1_lname',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title"> mobile number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp1_mobile',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">landline number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp1_landline',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">email address</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp1_email',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 first name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_fname',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">last name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_lname',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">mobile number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_mobile',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">landline number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_landline',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">email address</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cp2_email',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>




<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Maker Comment</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('maker_comment',null,array('class'=>'form-control ckeditor','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>








<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description"> Checker Comment</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('checker_comment',null,array('class'=>'form-control ckeditor','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>






<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Other Details</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('other_details',null,array('class'=>'form-control ckeditor','placeholder'=>'Short Description')) }}
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
<script>
        $(document).ready(function(){  
	$("#url").hide();
});


 function mod_type(){
       var clientapi=document.getElementById("client_api").checked="true";
           
        if ($(this).is(':checked'))
    $(this).next('client_url').show();
else
    $(this).next('client_url').hide(); }   
</script>
@stop
