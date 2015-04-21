<div class="login-fullwidith">
         <!-- Login Wrap  -->
      <div class="login-wrap">
                  <a href="<?php print_r(Config::get('app.url'));?>" class="navbar-brand">   <img src="<?php echo Theme::asset()->url('images/logo.jpg');?>" style="margin-top: -30px; margin-left: 96px;" alt="logo"/>   </a><br/>
              <div class="login-c1">
                    <div class="cpadding50">
                      <?php echo Form::open(array("id"=>"form-login","role"=>"form",'onsubmit' => 'return validateForm();'));?>
                            <p style="font-size:12px;"> Please enter your Email ID so we can send you an email to reset your password.</p>

                             <input type="text" class="form-control logpadding" placeholder="Email Id" id="email" name="email"><br/><br/><div id="error_email">

 </div>   <?php if(!empty($validation)){ echo $validation; } ?>



                     </div>

              </div>

              <div class="login-c2">
                   <div class="alignbottom">

                             <button class="btn-search4" style="z-index:1000;" type="submit" onclick="errorMessage()">Reset My Password
                              </button>							
                    </div>
              </div>

             <div class="login-c3">
                   <div class="left">
                        <?php echo HTML::link("", "Website",array("class"=>"whitelink")); ?><span></span>
                   </div>
                   <div class="right">
                         <?php echo HTML::link("securelogin", "Click here to Login",array("class"=>"whitelink","style"=>"font-size:12px; margin-top:13px;")); ?>
                   </div>
            </div>			
       </div>
</div>	
<style>
.cpadding50 {
padding: 31px !important;
}
.login-c1 {
height:178px !important;
}
.login-c2 {
height:205px !important;
}
.login-c3 {
margin-top:250px !important;
}
</style>
 <script>
 function validateForm()
{ 
var email=document.getElementById('email').value;
 var count=0;
 
 var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
   if($.trim($('#email').val()) == '')
	{
		count=1;
		$("#error_email").show();
		document.getElementById("email").focus();
		$("#error_email").html("<font color='red' style='margin-top: -37px;margin-left: 2px;position: absolute;'>Email ID Field is required</font>"); 
		//document.getElemenyById("email").style.background-color:red;
		return false;
         } else if(!emailReg.test(email)){
                                count=1;
                                $("#error_email").show();
        		      document.getElementById("email").focus();
        		      $("#error_email").html("<font color='red' style='margin-top: -37px;margin-left: 2px;position: absolute;'>Please enter valid email ID.</font>");
        		    $('#email').focus();
        		    return false;
        	    
       	    }
     
         
         if(count==0)
    {
    $("#chk").val(1);
     $("#error_email").hide();
    
    return true;
    
    }
}

function fnremove(arg,val)	{
	if (arg.value == '') {arg.value = val}
        if (arg.placeholder == '') {arg.placeholder = val}
}	
function fnshow(arg,val)	{
	if (arg.value == val) {arg.value = ''}
	if (arg.placeholder == val) {arg.placeholder = ''}
}
function enable()
{

var search_email=document.getElementById('email').value;
if(search_email!='')
$("#error_email").hide();

}
 
</script>
   
