<div class="col-md-4">
						<div class="margtop15"><span class="dark">Contact Name:</span><span class="red">*</span></div>
					</div>
					
					<div class="col-md-3">
						<span class="size12">First Name</span>
						<input type="text" name="first_name" id="first_name"class="form-control " placeholder=""></div>
					<div class="col-md-3">
						<span class="size12">Last Name</span>
						<input type="text" name="last_name" id="last_name" class="form-control " placeholder="">
					</div>
					<div class="clearfix"></div>
					
					
					
					
					
					<div>
					<div class="col-md-4">
						<div class="margtop15"><span class="dark">Email Address:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-6">
						<input type="text" name="s_email" id="s_email " class="form-control margtop10" placeholder="" ><br>
					</div>
<div class="clearfix"></div>
					
					
<div class="col-md-4">
						<div class="margtop15"><span class="dark">Preferred Phone Number:</span><span class="red">*</span></div>
					</div>
				<div class="col-md-6 ">
						<div class="col-md-2 col-xs-2 col-lg-2 nopad">
						<input type="text" readonly value="+91" class="form-control"/>
						</div>
						<div class="col-md-10 col-xs-10 col-lg-10 nopad">
						<input type="text" name = "mobile" id="mobile" class="form-control" placeholder="">
						</div>
					</div>
           
</div>
					
					<div class="clearfix"></div><br><br>
( All email notifications will be sent to the above address).<br/> <br/>
<?php if(isset($display_term) && $display_term==1){ ?>
					<span class='size16px bold dark left'>Review and proceed for payment</span><div class="roundstep  right">2</div>
				<div class="clearfix"></div> 
			
					
					<div class="line4"></div> 
					
	<?php } ?>				
					<?php if(!empty($msg)) { ?>
                                         <?php if(isset($form_option)){ ?>
					<div class="alert alert-info">
					<?php } ?> 
					<?php echo $msg; ?>
					</div>
					<?php } ?>
					  

              <?php if(isset($display_term) && $display_term==1){ echo $terms ="By clicking on continue booking I acknowledge that I have read and accept the rules & restrictions, ".HTML::link('content/Terms & Conditions', 'Terms & conditions ',array('target'=>'_blank')) ."and". HTML::link('content/Privacy Policy', ' Privacy Policy',array('target'=>'_blank')).".<br/>'"; } ?>
              
<div class="col-xs-12 clearfix nopad pbottom15">

		<div class="col-xs-12 col-md-4 col-lg-4 pull-right">
		<input type="submit" name="go" id="submit" onclick="save_customer();" class="btn-search"" value="Continue Booking"/>		
</div>
</div>					
				
