<!--<section class="content_pad"> --->

  <section class="banner_home1">
                <div class="log_twrap" >
            	<section class="ban_rgt_white">
                      <h1>Sign in</h1><h2>with HDFC SUPERIA Account</h2>
                	
<?php echo Form::open(array("id"=>"form-login","role"=>"form"));?>

     <div class="ban_rgt_white_border">   
        <?php $inputName = "email"; ?>
    <?php echo Form::text($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"txtbox4", "placeholder"=>"Email ID","style"=>"width: 283px;")); ?>
     
        <div id="error_email">{{ $errors->first('email') }}</div>
                   </div>
                   
                    
    <div class="ban_rgt_white_border2">
     <?php $inputName = "password"; ?>
    <?php echo Form::password($inputName,  array("id"=>$inputName, "class"=>"txtbox4", "placeholder"=>"Password",
     "style"=>"width: 283px;")); ?>

     <div id="error_password">{{ $errors->first('password') }}</div>
                    </div>
                    <div class="left"><input type="submit" class="login-btn" value="Sign in">
                    <input type="hidden" value="" name="redirect"/>
        <input type="hidden" value="submitted" name="submitted"/> &nbsp;<?php echo HTML::link("user/forgot", "Forgot Password"); ?></div>
                	<div class="account-line">Don't have a HDFC SUPERIA account? </div>
                	{{ Form::close() }}
                    <div class="signup-line"><?php echo HTML::link("user/register", "Register"); ?> &nbsp; <font color="#004386" font-size="14px"> Or</font> &nbsp;  <a href="https://staging.hdfcbanksuperia.com/"  >Continue as a Guest</a></div>
                </section>
               </div>
            </section>  
       
   
