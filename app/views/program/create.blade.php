@extends('cpanel::layouts')
<style>
img {
    max-width:192px;
    max-height:192px;
    border:1px solid #000;
}
</style>
@section('header')
<h1>Program</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.program.index')}}">
        <i class="fa fa-user"></i>
        Program
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php
            
 
      $option = array(
                'route' => 'cpanel.program.store',
                'class' => 'form-horizontal',
                'files' =>true,
                 'method' => 'post'
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new program</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                       <legend class="margin-top-10">Program Information</legend>
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
                                    <label class="col-sm-2 control-label" for="title">Program Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pgm_name',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                	
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Program URL</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pgm_url',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                            
                               
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Program Description</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('pgm_desc',null,array('class'=>'form-control ckeditor','placeholder'=>'Program Description')) }}
                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">FAQs</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('pgm_faqs',null,array('class'=>'form-control ckeditor','placeholder'=>' FAQs')) }}
                                    </div>
                                </div>
                            
                            
                             <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">About US</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('about_us',null,array('class'=>'form-control ckeditor','placeholder'=>'About US')) }}
                                    </div>
                                </div>
                               
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Checkout  Mode</label>
                                    <div class="col-md-4">
                                      
                                        <?php $checkout_mode = array(''=>'Select','1' => 'Points','2'=>'Points + Cash');?>
                               <?php echo Form::select('checkout_mode',$checkout_mode,null,array( "class"=>"form-control")); ?>
                                    </div>
                                </div>
                               
                                   <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Logo/Picture</label>
                                    <div class="col-md-4">
                                      {{ Form::file('image') }}
                                   
                                    </div>
                                </div>

                                 
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Program Code/Id</label>
                                    <div class="col-md-4">
                                    
                                        {{ Form::text('pgm_code',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">User Code</label>
                                    <div class="col-md-4">
                                        {{ Form::text('user_code',null,array('class'=>'form-control')) }}
                                    </div>
                                </div>
                                  
                                 <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Progrm Status</label>
                                    <div class="col-md-4">
                                      
                                        <?php $program_status = array(''=>'Select','1' => 'Yes','0'=>'No');?>
                               <?php echo Form::select('pgm_status',$program_status,null,array( "class"=>"form-control")); ?>
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                 <label class="col-sm-2 control-label" for="title">Time Bound</label>
                                    <div class="col-md-4">
                                      
                                        <?php $time_bound = array(''=>'Select','1' => 'Yes','0'=>'No');?>
                               <?php echo Form::select('time_bound',$time_bound,null,array( "class"=>"form-control")); ?>
                                    </div>
                                </div>
                               <div class="form-group">
                                   <label class="col-sm-2 control-label" for="title">Start Date</label>
                                    <div class="col-md-4">
                                        {{ Form::text('start_date',null,array('id'=>'start_date','class'=>'form-control')) }}
                                    </div>
                                </div>
                               
                               
                               <div class="form-group">
                                   <label class="col-sm-2 control-label" for="title">To Date</label>
                                    <div class="col-md-4">
                                        {{ Form::text('to_date',null,array('id'=>'to_date','class'=>'form-control')) }}
                                    </div>
                                </div>
                               
                               
                               
                               
                                  
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
					  <a class="btn btn-primary" href="{{route('cpanel.program.index')}}">Cancel</a>
                                    </div>
                                </div>
                            


                                
                            </div>

                     <div class="tab-pane" id="images">
                        <?php
            
 
      $option = array(
                'route' => 'cpanel.program.store',
                'class' => 'form-horizontal',
                'files' =>true
            );
            ?> {{ Form::open($option) }}
                               
                               <h3>  <li class="active">Customer Attributes</li></h3>
                               
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">First Name</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('first_name', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Last Name</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('last_name', '1') }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Date of Birth</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('dob', '1') }}
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Email</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('email', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Mobile</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('mobile', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Member Tier</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('member_tier', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Points value Converted to Cash</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('point_to_cash', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Member Id/Account Number</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('member_or_account', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Mother Maiden Name</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('mother_madien_name', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Father Name</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('father_name', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Gender</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('gender', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Anniversary Date</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('anniversary_date', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Member Status</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('status', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Id Proof Type</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('id_proof_type', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Id Proof Number</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('id_proof_number', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Address Proof Type</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('add_proof_type', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Address Proof Number</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('add_proof_number', '1') }}
                                    </div>
                                </div>
                               
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Address 1</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('address1', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Address 2</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('address2', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">City</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('city', '1') }}
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">State</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('state', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Pincode</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('pincode', '1') }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Country</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('country', '1') }}
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
                                        {{ Form::textarea('checker_comment',null,array('class'=>'form-control ckeditor','placeholder'=>'Checker Comment')) }}
                                    </div>
                                   </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Other Details</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('other_details',null,array('class'=>'form-control ckeditor','placeholder'=>'other details')) }}
                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
					  <a class="btn btn-primary" href="{{route('cpanel.program.index')}}">Cancel</a>
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
               // $('#data_incorp').datepicker({dateFormat: 'yy-mm-dd'});
               
		$( "#start_date" ).datepicker({
			dateFormat : 'dd-mm-yy',
			changeMonth : true,
			changeYear : true, 
			minDate: '+0d',
			numberOfMonths: 2, 
			showButtonPanel: true,
			onSelect: function( selectedDate ) {
				var minDate = $(this).datepicker('getDate');
				if (minDate) {
				minDate.setDate(minDate.getDate() );
				}
				 var dateMin = $('#start_date').datepicker("getDate");
                                var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 1); 
                                var rMax = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 1); 
                                $('#to_date').val($.datepicker.formatDate('dd-mm-yy', new Date(rMax)));     
				$( "#to_date" ).datepicker( "option",{ minDate:minDate,"setDate":'+1d' }, selectedDate  );

			}

		});
		
		
		$( "#to_date" ).datepicker({
		dateFormat : 'dd-mm-yy',
		changeMonth : true,
		changeYear : true, 
		minDate: '+0d',
		numberOfMonths: 2, 
		showButtonPanel: true,
		onSelect: function( selectedDate ) { //alert($('#startPicker').val());
			var minDate = $(this).datepicker('getDate');
			if (minDate) {
			minDate.setDate(minDate.getDate());
			}
			$( "#start_date" ).datepicker( "option",{ maxDate:minDate}, selectedDate );
		}
		});
		
		});
                   
</script>
@stop



