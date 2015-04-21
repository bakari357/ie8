<div class="login-fullwidith">
         <!-- Login Wrap  -->
      <div class="login-wrap">
                  <a href="<?php print_r(Config::get('app.url'));?>" class="navbar-brand">   <img src="<?php echo Theme::asset()->url('images/logo.jpg');?>" style="margin-top: -11px;
margin-left: 96px;" alt="logo"/>    </a><br/>
              <div class="login-c1 login-c1c">
                    <div class="cpadding50">

                      <?php echo Form::open(array("id"=>"sign_up","role"=>"form"));?>

 <input type="text" class="form-control logpadding" placeholder="Email address" name="email" value="" id="email"   autocomplete="off"  />  <br/>   
   <div  id="error_email"> </div>
   <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
 <div class="clear"></div>
            
  <input type="password" class="form-control logpadding" placeholder="Password" name="password" value="" id="password"   autocomplete="off"  />  <br/>

<input type="password" class="form-control logpadding" placeholder="Retype Password" name="password_confirmation" value="" id="password_confirmation" autocomplete="off"  />
                     </div>
             </div>

       <div class="login-c2 login-c2c">
            <div class="alignbottom">
      <button class="btn-search4" type="submit" >Sign Up</button>	   
      <button class="btn-search4"  type="button" onclick="redirect1();">Cancel</button>
             </div>
       </div>

             <div class="login-c3 login-c3c">
                   <div class="left">
                        <?php echo HTML::link("securelogin", "Sign in",array("class"=>"whitelink")); ?>
                   </div>
                   <div class="right">
                        <?php echo HTML::link("forgot_password", "Lost password?",array("class"=>"whitelink")); ?>
                   </div>
            </div>			
       </div>
</div>	
<style>
.cpadding50 {
padding: 30px !important;
}

</style>


<!--<script>
$("#current_password").on('change',function(){  
var password = $(this).val(); 
              $.ajax({
                      type: "POST",
                      url: "<?=URL::to('check_password')?>",
                      data: {
               "password":password
              },             
                        success: function(data) {
                          $("#error_email").html(data);
                      }
                  });
            });
	
	$(document).ready(function(){
            $("#sign_up").validate({
		 rules: {
                        email: {
			required: true
			
			},
			password: {
			required: true,
			minlength:6
			},
			password_confirmation: {
			required: true,
			equalTo: "#password"
			}
	            }
	});
});
</script>-->
   <script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

		
                $.validator.addMethod("loginRegex4", function(value, element) {
        	return this.optional(element) || /^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/i.test(value);
    		}, "Must contain 1 number,special character,upper & lowercase letters.");
                   var _token = $("#_token").val(); 
		$("#sign_up").validate({
		 rules: {
                        
                              
			email: {
			required: true,
			email: true,
			remote: {
			url: "<?=URL::to('check_email')?>",
			
			type: "post",
			data: {
			"_token":_token,
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

                    password_confirmation:{
			      required: true,
                               equalTo: "#password"
			      
                             
			}

                  },
		      messages: {
                                                
			 email: {
                              required: "Email ID field Required.",
                              email: "Enter valid email ID.",
				remote:"Already Exists"
                              },
                         password: {
                              required: "Password field Required."
                             
                              },
                         password_confirmation: {
                              required: "Confirm Password field Required."
                             
                              }
          	}

		});
	});

function redirect1(){

 window.location.assign("<?php print_r(Config::get('app.url'));?>");
 }
   
</script>
<style>
.error {
    color: red;
    font-size: 9px;
    font-weight: 400 !important;
}
</style>
