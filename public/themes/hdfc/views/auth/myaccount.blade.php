   <div class="container breadcrub" style="margin-top: 13px !important;">
	    <div>
		<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
				<li>/</li>
				<li><a href="#" class="active">My Account</a></li></ul>				
			</div>
		   </div>	
	</div>	
	<div class="container">
         <div class="container mt25 offset-0">
	<div class="col-md-12 pagecontainer2 offset-0">
	<div class="col-md-1 offset-0">
	<ul class="nav profile-tabs">
	 <li class="active">
		<a href="#profile" data-toggle="tab">
						<span class="profile-icon"></span>
						Your profile
						</a></li>
	 <li>
                <?php echo HTML::link('list_orders','Manage Orders',array("class"=>"history-icon")); ?>
          </li>
	  <li>
		 <a href="#password" data-toggle="tab" onclick="mySelectUpdate()">
		 <span class="password-icon"></span>	Change password </a></li>
	</ul>
		<div class="clearfix"></div>
		</div>
		<div class="col-md-11 offset-0">
		<div class="tab-content5">
		<div class="tab-pane padding40 active" id="profile">
<span class="size16 bold">Personal details   <?php if(isset($update)) {  echo $update; }?>
 </span>  
 	<div class="line2"></div>
	<div class="col-md-12 offset-0">
<?php foreach($customer as $cust_info) {  ?>
    <?php echo Form::open(array("id"=>"signup","role"=>"form"));?>
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<br/>


First Name * :
<input type="text" name="firstname" value="<?php echo $cust_info->first_name;?>" id="firstname" class="form-control"  autocomplete="off" rel="popover" data-content="This field is mandatory" data-original-title="Here you can edit your name" />
<br/>
Last Name *:
<input type="text" name="lastname" value="<?php echo $cust_info->last_name;?>" rel="popover" id="lastname" class="form-control" autocomplete="off"  data-content="This field is mandatory" data-original-title="Here you can edit your username"/>
<br/>

Mobile *:
<input type="text" name="mobile" value="<?php echo $cust_info->mobile;?>" id="mobile" class="form-control"   autocomplete="off"  />
<br/>


E-mail *:
<input type="text" name="email" value="<?php echo $cust_info->email;?>" id="email" class="form-control"  autocomplete="off" data-content="This field is mandatory" data-original-title="Edit your email address" readonly="true" />
<br/>
<div id="error_email" > </div>


Date of Birth *:
<?php $st_date = str_replace('/', '-', $cust_info->dob);
$birth_date = date("d-m-Y",strtotime($st_date)); ?>
<input type="text" name="dob" value="<?if($cust_info->dob == '0000-00-00') echo ''; else echo $birth_date; ?>" id="datepicker" class="form-control mySelectCalendar"  data-content="This field is mandatory" autocomplete="off" style="width:224px;" />
<br/>

Gender *:
<?php $gender = array(''=>'','male' => 'Male', 'female' => 'Female','others'=>'Others');?>
  <?php  $gender_selected = isset($cust_info->gender) ? $cust_info->gender : '';?>
   <?php echo Form::select('gender',$gender,$gender_selected,array( "class"=>"form-control", "style"=>"margin-top:1px;" )); ?> 

<br/>
<!--
 
<?php }?>
-->

<br/>
<div style="margin-right:1px;margin-top:-30px;" >
<a href="<?php echo Config::get('app.url');?>" class="bluebtn margtop20"> Cancel</a>
<input type="submit" name="Save" class="bluebtn margtop20" value="Update" style="margin-right:5px;margin-top:-30px;" >
</div>
{{Form::close()}}	
	</div><div class="row">  </div>
	  </div>					  
                	  <div class="tab-pane" id="bookings">  </div>
								  
					  <div class="tab-pane" id="wishlist">
						<div class="padding40">  </div>
					  </div>
					 					  
					  <div class="tab-pane" id="settings">
						<div class="padding40 dark"></div>
					  </div>
					 					  
					 <div class="tab-pane" id="guest_orders">
						<div class="padding40"></div>
					  </div>
					 					  
					  <div class="tab-pane" id="password">
						<div class="padding40">
						
							<span class="dark size18">Change password</span>
							<div class="line4"></div>
							
<form action="<?php echo $url = URL::action('Login@change_password'); ?>"  method="post" id="password_change" >
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							Current Password<br/>
<input type="hidden" value="<?php echo $cust_info->email;?>" >
							 <input type="password" class="form-control logpadding"  name="current_password" value="" id="current_password"   autocomplete="off"  />  <br/>   
   <div  id="error_password"> </div>
							New Password<br/>
							 <input type="password" class="form-control logpadding"  name="password1" value="" id="password1"   autocomplete="off"  />  <br/>
							Confirm Password<br/>
							<input type="password" class="form-control logpadding"  name="confirm_password" value="" id="confirm_password" autocomplete="off"  /><br/>                                              
				
			<button type="submit" class="btn-search4">Save changes</button>
						</form><br/><br/><br/></div>
					  </div>
										  
					  <div class="tab-pane" id="newsletter">
						<div class="padding40">

							<span class="dark size18">Newsletter</span>
							<div class="line4"></div>
						
							<div class="checkbox dark">
							  <label>
								<input type="checkbox" checked> Check this box to receive a monthly newsletter
							  </label>
							</div>
							
							<br/>
							<button type="submit" class="btn-search5">Save changes</button>							
						
						</div>
					  </div>
					 </div>
					
				</div>
				
			<div class="clearfix"></div><br/><br/>
			</div></div></div>
	
	<!-- Javascript  -->
	<script src="assets/js/js-profile.js"></script>
	
    <!-- Nicescroll  -->	
	<script src="assets/js/jquery.nicescroll.min.js"></script>
	
    <!-- Custom functions -->
    <script src="assets/js/functions.js"></script>
	
    <!-- Custom Select -->
	<script type='text/javascript' src='assets/js/jquery.customSelect.js'></script>
	
	<!-- Load Animo -->
	<script src="plugins/animo/animo.js"></script>

    <!-- Picker -->	
	<script src="assets/js/jquery-ui.js"></script>	

    <!-- Picker -->	
    <script src="assets/js/jquery.easing.js"></script>	
	<script src="assets/js/respond.src.js"></script>	
	
	
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>
<style>
 .error
 { color: red; }
</style>
<script>
$(function() {
$( "#accordion" ).accordion();
});
$(function() {
  $( "#datepicker" ).datepicker({
      dateFormat: 'dd-mm-yy',	
      changeMonth: true,
      changeYear: true,
      maxDate: '-0Y',
      yearRange: "-75:+0"	
      
    });

});
</script>
<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){ 
		$.validator.addMethod("loginRegex", function(value, element) {
        	return this.optional(element) || /^[A-Za-z\s'\-]+$/i.test(value);
    		}, "First Name must contain only alphabets and space and single quote.");
		$.validator.addMethod("loginRegex1", function(value, element) {
        	return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
    		}, "Last Name must contain only alphabets without space and no special charecter.");
		
                 $.validator.addMethod("loginRegex3", function(value, element) {
        	return this.optional(element) || /^([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})?$/i.test(value);
    		}, "Mobile must contain only Numbers.");
                
                 
		$("#signup").validate({
		 rules: {
                        firstname: {
                              required: true,
			      minlength: 3,
                              maxlength: 30 ,
                              loginRegex: true
                              },
			lastname: {
                              required: true,
                              maxlength: 30,
                              loginRegex1: true
                              },
			mobile:{
			      required: true,
			      number: true,
			      minlength:10,
                              maxlength: 12,
                              loginRegex3: true
			},
                      
                         
                       dob:{
			         required: true
                                  
			},
                    
                      
                       gender: {
                        required: true
                        }
                 },
		    


                messages: {
			firstname: {
				required: "First Name Required.",
				minlength: "Must be at least 3 characters in length.",
				maxlength: "Can not exceed 30 characters in length."

			},
			lastname: {
				required: "Last Name Required.",
				maxlength: "Can not exceed 30 characters in length.",
				//digits:"The Last Name field may only contain alphabetical characters."
			},
			
			
			mobile:{
			      required:"Mobile number Required.",
			      number: "Mobile number must contain only numbers.",
			      minlength:"Must be at least 10 Numbers in length.",
                              maxlength: "Can not exceed 12 Numbers in length."
			},
			
                       dob:{
			     required: "Date of Birth required"
                             
			   },
			
			
                        
                         gender:{
			         required: "Gender field required."
			}
          	}

		});
	





	 var _token = $("#_token").val();
             $.validator.addMethod("loginRegex4", function(value, element) {
        	return this.optional(element) || /^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/i.test(value);
    		}, "Must contain at least 8 characters,1 number,special characters,both upper & lowercase letters.");
           
              $("#password_change").validate({
		 rules: {

                        current_password: { 
			required: true,
			remote: {

			url: "<?=URL::to('check_password')?>",
			type: "post",
			data: {
				_token:_token,

			remote: function() {
			return;
			}
			}
			}
			},

			password1: {
			required: true,
			loginRegex4: true
			},
			confirm_password: {
                          required: true,
			 equalTo:"#password1"
			}
	            },
          messages: {
			
			 current_password: {
                              required: "current password field Required.",
                              remote:"Your Current password not matching our records.!"
                              }
}
	});

               	
		



     
             


    $('#current_password').bind('copy paste cut',function(e) { 
        e.preventDefault(); //this line will help us to disable cut,copy,paste        
    });
});
</script>
