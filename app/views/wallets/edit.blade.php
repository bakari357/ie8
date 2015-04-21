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
<li class="active">Edit</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <?php
        $option = array(
            'route' => array('cpanel.users.update',$user->id),
            'method' => 'put',
            'class' => 'form-horizontal'
        );
        ?>
        {{ Form::model($user,$option) }}
      
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit User &quot;{{ $user->first_name }} {{ $user->last_name }}&quot;</h3>
            </div>
            <div class="panel-body">
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
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="First Name">First Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('first_name',null,array('class'=>'form-control','placeholder'=>'First Name')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Last Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('last_name',null,array('class'=>'form-control','placeholder'=>'Last Name')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="email">Email</label>
                                    <div class="col-md-4">
                                        {{ Form::email('email',null,array('class'=>'form-control','placeholder'=>'Email')) }}
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="mnumber">Mobile Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('mobile',@$user->mobile,array('class'=>'form-control','placeholder'=>'Mobile Number')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Landline Number">Landline Number</label>
                                    <div class="col-md-4">
                                        {{ Form::text('landline',@$user_details->landline,array('class'=>'form-control','placeholder'=>'Landline Number')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Date Of Birth">Date Of Birth</label>
                                    <div class="col-md-4">
                                        {{ Form::text('dob',@$user_details->dob,array('class'=>'form-control','id'=>'dob','placeholder'=>'Date Of Birth')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Gender</label>
                                    <div class="col-md-4">
                                   
                                   
                                   <?php $gender = array('Male' => 'Male', 'Female' => 'Female');?>
                               <?php echo Form::select('gender',$gender,@$user_details->gender,array( "class"=>"select2 form-control","style"=>"width: 300px;")); ?>


                                                       </div>
                                </div>
                                          <div class="form-group">
                                    <label class="col-sm-2 control-label" for="first_name">Address Line1</label>
                                    <div class="col-md-4">
                                        {{ Form::text('address1',@$user_details->address1,array('class'=>'form-control','placeholder'=>'Address1')) }}
                                    </div>
                                </div>
    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="first_name">Address Line2</label>
                                    <div class="col-md-4">
                                        {{ Form::text('address2',@$user_details->address2,array('class'=>'form-control','placeholder'=>'Address2')) }}
                                    </div>
                                </div>
                                   <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">City</label>
                                    <div class="col-md-4">
                                          <select id="groups" name="city" class="select2 form-control">
                                            <option selected="1" value="fixed">City Name</option>
                      <?php if(isset($cities)) { 
                        foreach ($cities as $city) { 
                           if($city->id == @$user_details->city){
                              $selected = 'SELECTED';
                            }else{
                            $selected = '';
                             }
                ?>
                                            
                                            <option  value="<?php echo $city->id; ?>" <?php echo $selected; ?>><?php echo $city->city; ?></option>
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
                   foreach ($states as $state) {
                       if($state->id == @$user_details->state){
                          $selected = 'SELECTED';
                       }else{
                            $selected = '';
                             } ?>
                                            
                                            <option  value="<?php echo $state->adminCode1; ?>"<?php echo $selected; ?>><?php echo $state->adminName1; ?></option>
<?php } }?>
                                        </select>
                                    </div>
                                </div>
           
                                <div class="form-group">
                                 <label class="col-sm-2 control-label" for="last_name">Pincode</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pincode',@$user_details->pincode,array('class'=>'form-control','placeholder'=>'Pincode')) }}
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Maker Comments</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('maker_comment',@$user_details->maker_comment,array('class'=>'form-control ')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Checker Comments</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('checker_comment',@$user_details->checker_comment,array('class'=>'form-control ')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Other Details</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('other_details',@$user_details->other_details,array('class'=>'form-control ')) }}
                                    </div>
                                </div>
<div class="form-group">
                                   
          
 <legend>User Link</legend>
                               <div class="form-group">
                                    <label for="groups[]" class="col-sm-2 control-label">Groups</label>
                                    <div class="col-md-4">
                                        <select id="groups" name="groups[]" class="select2 form-control" multiple="true">
                                            @foreach($groups as $group)
                                            @if( in_array( $group->id, Input::old('groups', array())) or in_array($group->id, $userGroupsId) )
                                            <option selected="selected" value="{{ $group->id }}">{{ $group->name }}</option>
                                            @else
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



<div class="form-group" id="Entity">
                                    <label class="col-sm-2 control-label" for="Last Name">Entity Linked to</label>
                                    <div class="col-md-4">
                                        {{ Form::text('entity_link',null,array('class'=>'form-control','placeholder'=>'Entity Linked to')) }}
                                    </div>
                              </div>


                                <legend>Options</legend>
                                <div class="form-group">
                                    <label for="activate" name="activate" class="col-sm-2 control-label">Activate</label>
                                    <div class="col-md-2">
                                        {{
                                        Form::select(
                                        'permissions[superuser]',
                                        array('0' => 'No','1' => 'Yes'),
                                        null,
                                        array('class'=>'select2 form-control'))
                                        }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                </div>
            </div>



            {{Form::close()}}
        </div>
    </div>
<script type="text/javascript">
    $(function() { 
                //Date range picker
                $('#dob').datepicker({dateFormat: 'yy-mm-dd'}); });
</script>
  <script>
        $(document).ready(function(){  
               $("#Entity").hide();
        });
$(function(){
   $('#link').on('change',function() {
    var value = $(this).val();
 if(value=='Enterprise')
                  {
                         $("#Entity").show();
                  }
                  else
                   {
                         $("#Entity").hide();
                  }
   });
});
      
       </script>
@stop
