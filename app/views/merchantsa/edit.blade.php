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
                                        {{ Form::text('name',null,array('class'=>'form-control','placeholder'=>'Merchant Name')) }}
 
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
                                     <div class="form-group"> <?php
								  				 
                                				foreach($states   as $tier){
                                					$ti[$tier->adminName1] = $tier->adminName1;
                                				}                      	 ?>
                                    <label class="col-sm-2 control-label" for="title">States</label>
                                    <div class="col-md-4">
                                        {{ Form::select('state',$ti,$merchant->state,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  <div class="form-group"> <?php
								  				 
                                				foreach($cities   as $tiers){
                                					$ti[$tiers->city] = $tiers->city;
                                				}                      	 ?>
                                    <label class="col-sm-2 control-label" for="title">Cities</label>
                                    <div class="col-md-4">
                                        {{ Form::select('city',$ti,$merchant->city,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Area</label>
                                    <div class="col-md-4">
                                        {{ Form::text('area',null,array('class'=>'form-control','placeholder'=>'Area')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Address</label>
                                    <div class="col-md-4">
                                        {{ Form::text('address',null,array('class'=>'form-control','placeholder'=>'Address')) }}
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">URL</label>
                                    <div class="col-md-4">
                                        {{ Form::text('url',null,array('class'=>'form-control','placeholder'=>'URL')) }}
                                    </div>
                                </div>
                                 
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Description</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('description',null,array('class'=>'form-control ckeditor','placeholder'=>' Description')) }}
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
                                    <label class="col-sm-2 control-label" for="active">Active</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('activated', '1') }}
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
        </div>

        {{Form::close()}}

    </div>
</div>
@stop
