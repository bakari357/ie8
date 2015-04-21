
<style>
.cpadding50 {
padding: 31px !important;
}
</style>
<style>
 .error
 { color: red; }
</style>


<div class="login-fullwidith">
         <!-- Login Wrap  -->
      <div class="login-wrap">
                   <img src="<?php echo Theme::asset()->url('images/logo.jpg');?>" class="login-img" alt="logo"/><br/>
              <div class="login-c1">
                    <div class="cpadding50">
<form  method="post" id="otp" >

                      
                            <p> Please enter the OTP sent to your email id used for registration.</p>


<?php 
    
$user_id = base64_decode($id['id']);

$url = Request::url();
$needed = explode('/',$url);
 ?>

<input type="hidden" id="user_id" name="user_id" value="<?php echo $needed[6]; ?>">
                             <input type="password" class="form-control logpadding" placeholder="One Time Password" id="otp_num" name="otp_num"><br/><br/>

 <div id="opt_validation"> </div> 

 <?php if(!empty($valid_otp)){ echo $valid_otp; } ?>
    </div>

              </div>

              <div class="login-c2">
                   <div class="alignbottom">

                             <button class="btn-search4" type="button" onclick="return validate_otp()" >Submit
                              </button>							
                    </div>
              </div>
</form>
             <div class="login-c3">
                   <div class="left">
                        <?php echo HTML::link("", "Home",array("class"=>"whitelink")); ?><span></span>
                   </div>
                   <div class="right">
                         <?php echo HTML::link("securelogin", "Already have a membership ?",array("class"=>"whitelink")); ?>
                   </div>
            </div>			
       </div>
</div>	



<script>


function validate_otp(){

if($("#otp_num").val() == ''){
$("#opt_validation").html("<font color='red' style='margin-top: -21px;margin-left: 1px;position: absolute;'>Please enter your otp number! </font>");
return false;
}

var user_id = $("#user_id").val();
var otp_num = $("#otp_num").val(); 
$.ajax({
    url : "<?=URL::to('check_otp')?>",
    type: "POST",
    data : {user_id:user_id,otp_num:otp_num},
    async:false,
    success: function(response, textStatus, jqXHR)
    {  
      if(response == 0 ) {
 $("#opt_validation").html("<font color='red' style='margin-top: -47px;margin-left: 1px;position: absolute;'>Your current OTP is already used or not matching our records..!<br> Enter OTP which is sent your registered Id.</font>");
	}

     else{
window.location.replace("<?=URL::to(Config::get('app.url'))?>");

}
    }
})

}


            //});
		
	
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#otp_num').bind('copy paste cut',function(e) { 
        e.preventDefault(); //this line will help us to disable cut,copy,paste        
    });
});
</script>
   
