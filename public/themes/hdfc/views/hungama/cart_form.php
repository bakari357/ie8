
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Music</a></li>
					<li>/</li>
					<li><a href="#">Checkout</a></li>
					<li>/</li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">
<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>" >		
		<input type="hidden" name="ctype" value="music" />
		<input type="hidden" name="music_details" value="<?php echo $str; ?>" /> 
		<input type="hidden" name="amount" value="<?php echo 10; ?>" /> 
		<div class="container mt25 offset-0">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					
					<span class="size16px bold dark left">
</span>
					
					<div class="clearfix"></div>
					<?php 
						$check_data['amount'] = 10;
						$check_data['book'] = 'song';
						$check_data['cash'] = 0;
						$check_data['ctype'] = 'music';
						$check_data['form_option'] = 1;
					
					$view = View::make('payment_form',$check_data);
					echo $view;	?>
					</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<img src="<?php echo $image;?>" style="width: 69px;" class="left margright20" alt=""/>
						<span class="opensans size18 dark bold"><?php echo $alb_name;?></span><br/><span class="opensans size13 grey"><?php echo $track_name;?></span><br/>
						
						
					</div>
					<div class="line3"></div>
					
					
					<div class="padding30">					
						<span class="left size14 dark">Total:</span>
						<span class="right lred2 bold size18">&#8377 <?php echo $amount; ?></span>
						<div class="clearfix"></div>
					</div>


				</div><br/>
				
				
				
				<div class="pagecontainer2 loginbox">
					<div class="cpadding1">
						<span class="icon-lockk"></span>
						<h3 class="opensans">Log in</h3>
						<input type="text" class="form-control logpadding" placeholder="Username">
						<br/>
						<input type="text" class="form-control logpadding" placeholder="Password">
						<div class="margtop20">
							<div class="left">
								<div class="checkbox padding0">
									<label>
									  <input type="checkbox">Remember
									</label>
								</div>
								<a href="#" class="greylink">Lost password?</a><br/>
							</div>
							<div class="right">
								<button class="btn-search5" type="submit" onclick="errorMessage()">Login</button>	
							</div>
						</div>
						<div class="clearfix"></div><br/>
					</div>
				</div><br/>
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
<script>
$(document).ready(function() {
$('.emi_details').hide();
})

</script>	

	
	
	
	
