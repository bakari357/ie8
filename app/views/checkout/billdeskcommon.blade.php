<div class="col-md-4"  style="margin-top: 10px;">
						<div class="margtop15"><span class="dark">Contact Name:</span><span class="red">*</span></div>
					</div>
					
					<div class="col-md-3">
						<span class="size12"style="margin-top: 10px;" >First Name</span>
						<input type="text" name="first_name" id="first_name"class="form-control " placeholder=""></div>
					<div class="col-md-3">
						<span class="size12" style="margin-top: 10px;">Last Name</span>
						<input type="text" name="last_name" id="last_name" class="form-control " placeholder="">
					</div>
					<div class="clearfix"></div>
					
					
					
					
					
					<div>
					<div class="col-md-4" style="margin-top: 13px;">
						<div class="margtop15"><span class="dark">Email Address:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-6" style="margin-top: 10px;">
					<div class="col-md-2 col-xs-2 col-lg-2 nopad">
						
						</div>
						<input type="text" name="s_email" id="s_email " class="form-control margtop10" placeholder="" ><br>
					</div>
<div class="clearfix"></div>
					
					
<div class="col-md-4" style="margin-top: -18px;">
						<div class="margtop15"><span class="dark">Preferred Phone Number:</span><span class="red">*</span></div>
					</div>
				<div class="col-md-6 " style="margin-top: 10px;">
						<div class="col-md-2 col-xs-2 col-lg-2 nopad"  style="margin-top: -7px;">
						<input type="text" readonly value="+91" class="form-control"/>
						</div>
						<div class="col-md-10 col-xs-10 col-lg-10 nopad" style="margin-top: -7px;">
						<input type="text" name = "b_mobile" id="mobile" class="form-control" maxlength="10" placeholder="">
						</div>
					</div>
           
</div>
					
					<div class="clearfix"></div><br>
<span style="font-size:13.8px;">( All email notifications will be sent to the above address ) </span><br/> <br/>
<?php if(isset($display_term) && $display_term==1){ ?>
					<span class='size16px bold dark left'>Review and proceed for payment</span><div class="roundstep  right">2</div>
				<div class="clearfix"></div> 
			
					
					<div class="line4"></div> 
					
	<?php } ?>				
					<?php if(!empty($msg)) {?>
                                         <?php if(isset($form_option)){ ?>
					<div class="alert alert-info">
					<?php } ?> 
					<?php echo $msg; ?>
					</div>
					<?php } ?>
					  

              <?php if(isset($display_term) && $display_term==1){ echo $terms ="By clicking on continue booking I acknowledge that I have read and accept the rules & restrictions, ".HTML::link('content/Terms & Conditions', 'Terms & conditions ',array('target'=>'_blank',"style"=>"color:#3a87ad !important;")) ."and". HTML::link('content/Privacy Policy', ' Privacy Policy',array('target'=>'_blank',"style"=>"color:#3a87ad !important;")).".<br/>"; } ?>
              
<div class="col-xs-12 clearfix nopad pbottom15">
</br>
		<div class="col-xs-12 col-md-4 col-lg-4 pull-right">
		<input type="submit" name="go" id="submit" onclick="save_customer();" class="btn-search"" value="Continue Booking"/>		
</div>
</div>					
				
