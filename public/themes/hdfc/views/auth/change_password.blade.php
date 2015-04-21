<div class="login-fullwidith">
         <!-- Login Wrap  -->
      <div class="login-wrap">
                   <img src="<?php echo Theme::asset()->url('images/edge.jpg');?>" class="login-img" alt="logo"/><br/>
              <div class="login-c1">
                    <div class="cpadding50">

                      <?php echo Form::open(array("id"=>"password_change","role"=>"form"));?>

 <input type="password" class="form-control logpadding" placeholder="Enter Current Password" name="current_password" value="" id="current_password"   autocomplete="off"  />  <br/>   
   <div  id="error_email"> </div>
   
 <div class="clear"></div>
            
  <input type="password" class="form-control logpadding" placeholder="Enter New Password" name="password" value="" id="password"   autocomplete="off"  />  <br/>

<input type="password" class="form-control logpadding" placeholder="Confirm your new password" name="confirm_password" value="" id="confirm_password" autocomplete="off"  />
                     </div>
             </div>

       <div class="login-c2">
            <div class="alignbottom">
      <button class="btn-search4" type="submit" >Submit</button>&nbsp;&nbsp;&nbsp;	   
       <?php echo HTML::link("myaccount", "Cancel",array("class"=>"btn-search4")); ?>
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
padding: 13px !important;
}

</style>
<style>
 .error
 { color: red; }
</style>

<script>
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
            $("#password_change").validate({
		 rules: {
                        current_password: {
			required: true
			
			},
			password: {
			required: true,
			minlength:6
			},
			confirm_password: {
			required: true,
			equalTo: "#password"
			}
	            }
	});
});
</script>
   
