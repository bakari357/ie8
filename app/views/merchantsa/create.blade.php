@extends('cpanel::layouts')
<style>
img {
    max-width:192px;
    max-height:192px;
    border:1px solid #000;
}
</style>
<style>
      #map_canvas {
        width: 500px;
        height: 400px;
        
      }
    </style>
<script src="https://maps.google.co.in/?ll=12.953997,77.63094&spn=0.835119,1.274414&t=m&z=10"></script>
<script>
  function initialize() {
    var mapCanvas = document.getElementById('map_canvas');
    var mapOptions = {
      center: new google.maps.LatLng(44.5403, -78.5463),
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(map_canvas, map_options);
  }
</script>
@section('header')
<h1>Merchants</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.merchants.index')}}">
        <i class="fa fa-user"></i>
        Merchants
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php
            
 
      $option = array(
                'route' => 'cpanel.merchants.store',
                'class' => 'form-horizontal',
                'files' =>true
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new Merchants</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                       <legend class="margin-top-10">Merchants Information</legend>
                       <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#content" data-toggle="tab">Main Description</a>
                            </li>
				 <li>
                                <a href="#ext_dec" data-toggle="tab">Extended Description</a>
                            </li>
                            
                        </ul>

                       <div class="tab-content">

                            <div class="tab-pane active" id="content">
                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Merchant Name</label>
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
                                    <label class="col-sm-2 control-label" for="title">Landline number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('line_number',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">VAT number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('vat_number',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">ST number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('st_number',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">TIN number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('tin_number',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">PAN number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pan_number',null,array('class'=>'form-control')) }}
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
                                    <label class="col-sm-2 control-label" for="active">Active</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('active', '1') }}
                                     </div>
					
                                </div>


 

                                
                            </div>


                     <div class="tab-pane" id="ext_dec">
                       
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">State</label>
                                    <div class="col-md-4">
                                         <select id="groups" name="state" class="select2 form-control">
                                       <option selected="selected" value="">State Name</option>
              <?php if(isset($states) && !empty($states)) { 
                   foreach ($states as $state) { ?>
                                            
                                            <option  value="<?php echo $state->adminName1; ?>"><?php echo $state->adminName1; ?></option>
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
                                            
                                            <option  value="<?php echo $city->city; ?>"><?php echo $city->city; ?></option>
<?php } } ?>
                                        </select>
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
                                    <label class="col-sm-2 control-label" for="title">PIN code</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pin_code',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 1 first name
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cfist_name1',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 1 last name
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('clast_name1',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person  1 mobile number
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cmobile_number1',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 1 email address
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cemail1',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 first name
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cfist_name2',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 last name
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('clast_name2',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 mobile number
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cmobile_number2',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Contact person 2 email address
</label>
                                    <div class="col-md-4">
                                        {{ Form::text('cemail2',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Maker comment
</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('maker_comm',null,array('class'=>'form-control ckeditor','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">checker comment

</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('checker_comm',null,array('class'=>'form-control ckeditor','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>
				<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Other details

</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('other_details',null,array('class'=>'form-control ckeditor','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>
                             <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
					  <a class="btn btn-primary" href="{{route('cpanel.merchants.index')}}">Cancel</a>
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

