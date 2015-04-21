<style>
 .error
 { color: red;
    }
</style>


<body id="top" class="thebg" >
   
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#" class="active">Register</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
			
			<!-- CONTENT -->
			<div class="col-md-12 pagecontainer2 offset-0">
				
			
					
				<!-- RIGHT CPNTENT -->
				<div class="col-md-11 offset-0">
					<!-- Tab panes from left menu -->
					<div class="tab-content5">
					
					  <!-- TAB 1 -->
					  <div class="tab-pane padding40 active" id="profile">

						
						  
						  
						<div class="clearfix"></div>
						
						<div class="relative margtop10">
							
						
						</div>
						  
						
						<span class="size16 bold">Registration</span> 
						<div class="line2"></div>
						  
						<!-- COL 1 -->
 <div class="col-md-12 offset-0">

<?php echo Form::open(array("id"=>"signup","role"=>"form"));?>


<br/>

First Name *:
<font color='red' style='margin-top:-1px;margin-left:25px;position:absolute;'>{{ $errors->first('firstname') }} </font>
<input type="text" name="firstname" value=""  rel="popover" id="bill_firstname" class="form-control"    data-content="This field is mandatory" autocomplete="off" />
<br/>	


Last Name *:
<input type="text" name="lastname" value="" rel="popover" id="lastname" class="form-control"  autocomplete="off" />
<br/>

 
Mobile Number *:  <font size="2px;" color="gray">  eg."9900XXXXXX"</font>
<font color='red' style='margin-top:-1px;margin-left:25px;position:absolute;'>{{ $errors->first('mobile') }} </font>
<input type="text" name="mobile" value="" id="bill_mobile" class="form-control"   data-content="This field is mandatory" autocomplete="off"/>
<br/>


Birth date *:
<input type="text" name="dob" value="" id="datepicker" class="form-control mySelectCalendar"  data-content="This field is mandatory" autocomplete="off" style="width:224px;" />
<br/>

Gender *:
<?php $gender = array(''=>'','male' => 'Male', 'female' => 'Female','others'=>'Others');?>
  <?php  $gender_selected = isset($cust_info->gender) ? $cust_info->gender : '';?>
   <?php echo Form::select('gender',$gender,$gender_selected,array( "class"=>"form-control", "style"=>"margin-top:1px;" )); ?> 

<br/>
E-mail *: <font size="2px;" color="gray">  eg."bbXXX@gmail.com"</font>
<font color='red' style='margin-top:-1px;margin-left:25px;position:absolute;'>{{ $errors->first('email') }} </font>
<input type="text" name="email" value=""  rel="popover" id="email" class="form-control"  data-content="This field is mandatory" autocomplete="off" />

<br/>		
<div id="error_email" > </div>	

Password *: 
<font color='red' style='margin-top:-1px;margin-left:25px;position:absolute;'>{{ $errors->first('password') }} </font>
<input type="password" name="password" value="" id="password" class="form-control" data-content="This field is mandatory"/>
<br/>

Confirm Password *:
<font color='red' style='margin-top:-1px;margin-left:25px;position:absolute;'>{{ $errors->first('confirm_password') }} </font>
<input type="password" name="confirm_password" value="" id="confirm_password" class="form-control"  data-content="This field is mandatory" />
<br/>	
<br/>			   
<input type="submit" name="Save" class="bluebtn margtop20" value="Register">
<div style="margin-left:114px;margin-top:-30px;"><?php echo HTML::link("securelogin", "cancel",array("class"=>"bluebtn margtop20")); ?></div>

{{Form::close()}}

						
						</div>
						<!-- END OF COL 1 -->
						
						
						
						
						
						
						
					  </div>
				
					  
					

					  
					</div>
					<!-- End of Tab panes from left menu -->	
					
				</div>
				<!-- END OF RIGHT CPNTENT -->
			
			<div class="clearfix"></div><br/><br/>
			</div>
			<!-- END CONTENT -->			
			

			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	



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
        	return this.optional(element) || /^[a-z A-Z\ ]+$/i.test(value);
    		}, "First Name must contain only alphabets.");
		$.validator.addMethod("loginRegex1", function(value, element) {
        	return this.optional(element) || /^[a-z A-Z\ ]+$/i.test(value);
    		}, "Last Name must contain only alphabets.");
		
                 $.validator.addMethod("loginRegex3", function(value, element) {
        	return this.optional(element) || /^([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})?$/i.test(value);
    		}, "Mobile must contain only Numbers.");
                $.validator.addMethod("loginRegex4", function(value, element) {
        	return this.optional(element) || /^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/i.test(value);
    		}, "[Password Must be contain at least 8 characters, including at least 1 number and includes both lower and uppercase letters and special characters (e.g., #, ?, !) ].");
                 
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
                        },
                       
			email: {
			required: true,
			email: true,
			remote: {
			url: "<?=URL::to('check_email')?>",
			type: "post",
			data: {
			remote: function() {
			return;
			}
			}
			}
			},

                    password:{
			      required: true,
                               minlength:8,
                               loginRegex4:true
			    },

                    confirm_password:{
			      required: true,
                               equalTo: "#password"
			      
                             
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
			},
			 email: {
                              required: "Email field Required.",
                              email: "Email  field must contain a valid email address.",
				remote:"Already Exists"
                              },
                         password: {
                              required: "Password field Required."
                             
                              },
                         confirm_password: {
                              required: "Confirm Password field Required."
                             
                              }
          	}

		});
	});


   
</script>

