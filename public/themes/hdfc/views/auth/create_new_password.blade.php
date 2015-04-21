<div class="login-fullwidith">
         <!-- Login Wrap  -->
      <div class="login-wrap">
                   <img src="<?php echo Theme::asset()->url('images/logo.png');?>" class="login-img" alt="logo"/><br/>
              <div class="login-c1">
                    <div class="cpadding50">

                      <?php echo Form::open(array("id"=>"password_change","role"=>"form"));?>

             
  <input type="password" class="form-control logpadding" placeholder="Enter New Password" name="password" value="" id="password"   autocomplete="off"  />  <br/>

<input type="password" class="form-control logpadding" placeholder="Confirm your new password" name="confirm_password" value="" id="confirm_password" autocomplete="off"  />


 
 



                     </div>

              </div>

              <div class="login-c2">
                   <div class="alignbottom">



      <button class="btn-search4" type="submit" >Save your new passsword
                              </button>	   







                             						
                    </div>
              </div>

             <div class="login-c3">
                   <div class="left">
                        <?php echo HTML::link("", "Website",array("class"=>"whitelink")); ?><span></span>
                   </div>
                   <div class="right">
                         <?php echo HTML::link("securelogin", "Already have a membership ?",array("class"=>"whitelink")); ?>
                   </div>
            </div>			
       </div>
</div>	
<style>
.cpadding50 {
padding: 50px !important;
}
</style>

<style>
 .error
 { color: red; }
</style>
<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
 <script>

$(document).ready(function(){
              $.validator.addMethod("loginRegex4", function(value, element) {
        	return this.optional(element) || /^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/i.test(value);
    		}, "[Minimum 8 characters,including number,lower & uppercase letters and special characters (e.g., #, ?, !) ].");
		
		$("#password_change").validate({
		 rules: {
                        
                       	password: {
			required: true,
			  minlength:8,
                        loginRegex4: true
			},
			confirm_password: {
			required: true,
			equalTo: "#password"
			}
			

                  }
		  

		});
	});



	
 
</script>
   
