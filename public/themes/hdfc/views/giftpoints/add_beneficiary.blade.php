
<div class="alert allert-error">
	<a class="close" data-dismiss="alert">×</a>
	
</div>


        <div class="accountoutbx">
        <div class="page-header">
        <h2>Beneficiary Information</h2>
        
        </div>
        </div>
        <div class="accountinbx"> 
        {{ Form::open(array('id'=>'add_benificery'))}}
<div id="error_email"> </div>
<div id="error_ownemail"> </div>
        <div class="signnambx">
    
       <div class="frm-left">Email : <input type="text" name="email" value="" id="email" class="txt_signup" placeholder="* email" autocomplete="off"  /></div>
	
        </div>

        <div class="signnambx">
        
        <div class="frm-left">Phone: <input type="text" name="phone" value="" id="phone" class="txt_signup" placeholder="* Phone" autocomplete="off"  /></div>
	
        
        </div>

        <div class="signbuttonbx">
        {{ Form::submit('Search')}}
        
        </div>
       {{ Form::close() }}
        </div>
        
        <script>

$("#email").on('change',function(){
var email = $(this).val();
              $.ajax({
                      type: "POST",
                      url: "<?=URL::to('check_email')?>",
                      data: {
               "email":email
              },             
                        success: function(data) {
                          $("#error_email").html(data);
                          return false;
                              
                      }
                  });
            

});
$("#email").on('change',function(){
var email = $(this).val();
              $.ajax({
                      type: "POST",
                      url: "<?=URL::to('check_ownemail')?>",
                      data: {
               "email":email
              },             
                        success: function(data) {
                          $("#error_ownemail").html(data);
                            return false;
                              
                      }
                  });
            

});


	
	$(document).ready(function(){
		
		$("#add_benificery").validate({
		 rules: {
                        
                        email: {
                              required: true,
                              email: true
                            },
			phone:{
			      required: true,
			      number: true,
			      minlength:10,
              maxlength: 12
              }
			
			

                  }
		  

		});
	});
</script>

        
