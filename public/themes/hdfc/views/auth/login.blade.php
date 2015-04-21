	<div class="login-fullwidith">
	<?php 
 echo Form::open(array("id"=>"form-login","role"=>"form",'onsubmit' => 'return validateForm();'));?>	
		<!-- Login Wrap  -->
		<div class="login-wrap">

<a href="<?php print_r(Config::get('app.url'));?>" class="navbar-brand">   <img src="<?php echo Theme::asset()->url('images/logo.jpg');?>" style="margin-top: -30px;margin-left: 96px;" alt="logo"/>   </a>


			<br/> <?php echo Session::get('success'); ?>

			<div class="login-c1"> 
				<div class="cpadding50"> 


 <div id="error_email">
 <?php if(isset($validation)){ 
 
 echo $out = "<font color='red' style='margin-top: 112px;margin-left: 2px;position: absolute;'>".$validation."</font>"; } ?></div>

 <?php $inputName = "email"; ?>
    <?php echo Form::text($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"form-control logpadding", "placeholder"=>"Email ID",
     "onblur"=>"fnremove(this,'Email ID');","onFocus"=>"fnshow(this,'Email ID');","onchange"=>"enable();")); ?>
   <br/>

 <?php $inputName = "password"; ?>
    <?php echo Form::password($inputName,  array("id"=>"password", "class"=>"form-control logpadding", "placeholder"=>"Password",
     "onblur"=>"fnremove(this,'Password');","onFocus"=>"fnshow(this,'Password');","onchange"=>"enable();")); ?>
				</div>
				
			</div>
			<div class="login-c2">
				<div class="logmargfix">
					<div class="chpadding50">
							<div class="alignbottom">
							
<button class="btn-search4"  type="submit" onclick="errorMessage()">Sign In</button>
<button class="btn-search4"  type="button" onclick="redirect1();">Cancel</button>	
							</div>
							<div class="alignbottom2">
							  
							</div>
					</div>
				</div>
			</div>
			<div class="login-c3">
<div class="left">
<?php echo HTML::link("signup", "Sign up",array("class"=>"whitelink")); ?>
</div>
<div class="right"> 

     
        
      <input type="hidden" value="" name="redirect"/>
      <input type="hidden" value="submitted" name="submitted"/> &nbsp;
      <?php echo HTML::link("forgot_password", "Lost password?",array("class"=>"whitelink")); ?>
</div>
             

				
			</div>			
		</div>
		<!-- End of Login Wrap  -->
		<?php echo Form::close(); ?>
	
	</div>

       
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
		$("#error_email").html("<font color='red' size='2px' style='margin-top: 39px;margin-left: 2px;position: absolute;'>Email Field is required</font>"); 
		//document.getElemenyById("email").style.background-color:red;
		return false;
         } else if(!emailReg.test(email)){
                                count=1;
                                $("#error_email").show();
        		      document.getElementById("email").focus();
        		      $("#error_email").html("<font color='red' size='2px' style='margin-top: 39px;margin-left: 2px;position: absolute;'>Please enter valid email.</font>");
        		    $('#email').focus();
        		    return false;
        	    
       	    }
       	     if($.trim($('#password').val()) =='')
	{
		count=1;
		$("#error_password").show();
		document.getElementById("password").focus();
		$("#error_password").html("<font color='red' style='margin-top: 48px;margin-left: -31px;position: absolute;'>Please enter your password to proceed.</font>"); 
		//document.getElemenyById("email").style.background-color:red;
		return false;
         }
         
         
         if(count==0)
    {
    $("#chk").val(1);
    $("#error_password").hide();
    $("#error_email").hide();
    
    return true;
    
    }
}
function redirect1(){

 window.location.assign("<?php print_r(Config::get('app.url'));?>");
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
var search_phone=document.getElementById('password').value;
if(search_phone!='')
$("#error_password").hide();
}

</script>
    
<script type="text/javascript">
$(document).ready(function() {
    $('#password').bind('copy paste cut',function(e) { 
        e.preventDefault(); //this line will help us to disable cut,copy,paste        
    });
});
</script>
