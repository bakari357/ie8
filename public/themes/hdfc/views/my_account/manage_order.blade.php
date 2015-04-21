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
					<li><a href="#" class="active">Manage Orders</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container ">

		
		<div class="container mt8 offset-0">
			
			
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
						  
	
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">					
						<span class="size16 bold">Manage Orders <?php if(isset($result)) echo $result; ?></span> 
						<div class="line2"></div>
						  
						<!-- COL 1 -->
 <div class="col-md-12 offset-0">  
<form id="signup" method="POST" action="guest_order_details">

<br/>

Order ID *:
<input type="text" name="order_id" value=""  rel="popover" id="order_id" class="form-control"    data-content="This field is mandatory" autocomplete="off" />
<br/>	

Email ID (Provided at the time of Booking) *:<font size="2px;" color="gray">  eg."bbXXX@gmail.com"</font>
<input type="text" name="email" value=""  rel="popover" id="email" class="form-control"  data-content="This field is mandatory" autocomplete="off" />

<br/>		
<div id="error_email" > </div>	


<br/>			   
<input type="submit" name="Save" class="bluebtn margtop20" value="Submit">


</form>
						
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
	
<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

		                
		$("#signup").validate({
		 rules: {
                        
                        order_id: {
                              required: true
			       },
			
			email: {
			required: true,
			email: true
			
			}

                  },
		      messages: {
                                                
			order_id: {
				required: "Order Id Required.",
				},
			 email: {
                              required: "Email field Required.",
                              email: "Email  field must contain a valid email address."
				
                              }
                        
          	}

		});
	});


   
</script>

