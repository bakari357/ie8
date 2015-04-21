
    <script src="{{Theme::asset()->url('assets/js/jquery-1.11.1.min.js')}}"></script>

<!-- Top wrapper -->	
	<div class="navbar-wrapper2 navbar-fixed-top">
      <div class="container">
		<div class="navbar mtnav">

			<div class="container offset-3">
			  <!-- Navigation-->
			  <div class="navbar-header">
				<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a href="<?php print_r(Config::get('app.url'));?>" class="navbar-brand"><img style=" width:170px !important;"src="{{Theme::asset()->url('images/pointspool-logo-a.jpg')}}" alt="Travel Agency Logo" class="logo"/></a>
			  </div>
			  <div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
				  <li class="dropdown active">
					<a data-toggle="dropdown" class="dropdown-toggle" href="index.html">Home <span class="badge indent0">1</span><b class="lightcaret mt-2"></b></a>
					<ul class="dropdown-menu posright-0">
					  <li>
							<div class="row dropwidth01">
								<ul class="droplist col-md-4">
								  <li class="dropdown-header">Homepages</li>	
								  <li><a href="index.html">Home 1 minimal</a></li>
								  
								  <li><a href="z-new-homepage.html">New Homepage</a> <span class="green">new</span></li>									  
								</ul>
								<ul class="droplist col-md-4">
								  <li class="dropdown-header">Intro pages</li>
								  
								  <li><a href="intro3.html">Intro 3 - slides2</a> <span class="glyphicon glyphicon-star lblue"></span></li>
								</ul>
								
							</div>
					  </li>
					</ul>
				  </li>
				  <li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Burn points <span class="badge indent0">1</span><b class="lightcaret mt-2"></b></a>
					<ul class="dropdown-menu posright-0">
					  <li>
		       <div class="row dropwidth01">
			  <ul class="droplist col-md-4">
			      <li class="dropdown-header">Inner pages</li>	
				    <li><?php echo HTML::link('list_program', 'Program'); ?></li>
				     <li><?php echo HTML::link('list_offer', 'Offers'); ?></li>				 
<li>
			<?php echo HTML::link('mobile_rec/recharge_mob', 'Mobile Recharge'); ?>
			</li>
			<li>
			<?php echo HTML::link('mobile_rec/recharge_dth', 'DTH Recharge'); ?>
			</li>	
			<li>
			<?php echo HTML::link('cinemas', 'Movies'); ?>
			</li>	
			<li>
			<?php echo HTML::link('allmusic', 'Music'); ?>
			</li>		 
						  
								</ul>	
								
							</div>
					  </li>
					</ul>
				  </li>
				    <li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Products <span class="badge indent0">1</span><b class="lightcaret mt-2"></b></a>
					<ul class="dropdown-menu posright-0">
					  <li>
							<div class="row dropwidth01">
								<ul class="droplist col-md-4">
		                                                <li><?php echo HTML::link('list_products', 'Physical Products'); ?></li>
								  
								 
						  
								</ul>	
								
							</div>
					  </li>
					</ul>
				  </li>
				  <!-- <li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Wishlist <span class="badge indent0">1</span><b class="lightcaret mt-2"></b></a>
					<ul class="dropdown-menu posright-0">
					  <li>
							<div class="row dropwidth01">
								<ul class="droplist col-md-4">
							
								      <li><?php echo HTML::link('wishlist', 'Your Wishlist'); ?></li>
								  
								 
						  
								</ul>	
								
							</div>
					  </li>
					</ul>
				  </li>-->
				  <li><?php echo HTML::link('Hotels', 'Hotels'); ?></li>
				  <li><?php echo HTML::link('airline_index', 'Goibibo'); ?></li>
				  <li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Flight <b class="lightcaret mt-2"></b></a>
					<ul class="dropdown-menu posright-0">
					  <li>
							<div class="row dropwidth01">
								<ul class="droplist col-md-4">
		                                                <li><?php echo HTML::link('airline_index', 'Domestic Flight'); ?></li>
<li><?php echo HTML::link('airline_int', 'International Flight'); ?></li>
								  
								 
						  
								</ul>	
								
							</div>
					  </li>
					</ul>
				  </li>			  
				 			  
				  	
                                  <?php $login=Session::get('customer_data'); if(!$login){ ?> 		  
				  <li><?php echo HTML::link('registration', 'Register'); ?></li>
                                  <li><?php echo HTML::link('securelogin', 'Login'); ?></li>
					<?php }else{ ?>
                                      
					<li><?php echo HTML::link('registration', 'My Account'); ?></li>
                                  <li><?php echo HTML::link('logout', 'Logout'); ?></li>
                                  <?php } ?>		
				</ul>
			  </div>
			  <!-- /Navigation-->			  
			</div>
		
        </div>
      </div>
    </div>

		

		





