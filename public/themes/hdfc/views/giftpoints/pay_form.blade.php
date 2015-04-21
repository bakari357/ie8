

<?php

?>
        <div class="accountoutbx">
        <div class="page-header">
        <h3>Beneficiary Information</h3>
        </div>
        </div>
        <div class="accountinbx"> 
        {{ Form::open(array('id'=>'check_benificery'))}}
        
        <div class="signnambx">
        <br/>
        <label for="account_email">Email </label>
        <?php echo $customer['email'];?>
        </div>
        <div class="signnambx">
        <label for="account_phone">Phone</label>
        <?php echo $customer['phone'];?>
        </div>
        <div class="signnambx">
        <label for="account_name">Name </label>
        <?php echo  $customer['firstname'];?>
        </div>
        <div class="signnambx">
       
        
          <div class="frm-left">Points: <input type="text" name="points" value="" id="points" class="txt_signup" placeholder="* points" autocomplete="off"  /></div>
            
        </div>

    <br/> <br/>
        <div class="signbuttonbx">
        <input type="submit" class="btn btn-primary" name="submit" value="Transfer">
        </div>
        </form>
        </div>
       <script> 
       $(document).ready(function(){
        
	$.validator.addMethod('lessThan', function(value, element, param) {
        if (this.optional(element)) return true;
        var i = parseInt(value);
        var j = <?php echo $customer_details['customer_points']?>;
       
       return i < j;
       }, "The Points field must contain a number less than <?php echo $customer_details['customer_points']?>  ");
	
		
		$("#check_benificery").validate({
		 rules: {                        
                        points : {
                              required: true,
                               number: "Points must contain only numbers",
                              lessThan: true
                            },
			
                  }
		  

		});
	});
	</script>
        
