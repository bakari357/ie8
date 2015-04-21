
	
	
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Hotels</a></li>
					<li>/</li>
					<li><a href="#">U.S.A.</a></li>
					<li>/</li>					
					<li><a href="#" class="active">New York</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- FILTERS -->
			<div class="col-md-3 filters offset-0">
			
				
				<!-- TOP TIP -->
				
				
	

	
	
				
				<!-- END OF BOOK FILTERS -->	
				
				
				<!-- End of Star ratings -->	
				
				
				
				<!-- Acomodations -->		
				
				<!-- End of Acomodations -->
				
				<div class="line2"></div>
				
				<!-- Hotel Preferences -->
				<button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#collapse4">
				 Search <span class="collapsearrow"></span>
				</button>
<br/>
				<br/>
				<br/>	
				<div id="collapse4" class="collapse in">
					
						 <input type="text" name="program_name" >
        <button type="submit" id="submit" onclick="search_program();" class="btn-search3">Search</button>
						

					
					<div class="clearfix"></div>						
				</div>	
				<!-- End of Hotel Preferences -->
				
				<div class="line2"></div>
				<div class="clearfix"></div>
				<br/>
				<br/>
				<br/>
				
				
			</div>
			<!-- END OF FILTERS -->
			
			<!-- LIST CONTENT-->
			<div class="rightcontent col-md-9 offset-0">
			
				<div class="hpadding20">
					<!-- Top filters -->
					
					<!-- End of topfilters-->
				</div>
				<!-- End of padding -->
				
				<br/><br/>
				<div class="clearfix"></div>
				

				<div class="itemscontainer offset-1">
			
	 <?php if(isset($result) && $result <>'') 
				 {
				 if(count($result)>0)
				 {
				 foreach($result as $program)
				 {
				
				 ?>
					<div class="offset-2">
						<div class="col-md-4 offset-0">
							<div class="listitem2">
								<a href="<?php print_r(Config::get('app.url').'uploads/program_images/'.$program->image);?>" data-footer="A custom footer text" data-title="A random title" data-gallery="multiimages" data-toggle="lightbox"><img src="<?php print_r(Config::get('app.url').'uploads/program_images/'.$program->image);?>" alt=""/></a>
								<div class="liover"></div>
								<a class="fav-icon" href="#"></a>
								<a class="book-icon" href="details.html"></a>
							</div>
						</div>
						<div class="col-md-8 offset-0">
							<div class="itemlabel3">
								<div class="labelright">
									
									<?php echo HTML::decode(HTML::link('program_validation/'.$program->id, ''.'Tag', array('class' => 'bookbtn mt1')));?>		
								</div>
								<div class="labelleft2">			
									<b><?php echo $program->pgm_name; ?></b><br/><br/><br/>
									<p class="grey">
									<?php echo HTML::decode(HTML::link('program_validation/'.$program->id, ''.'Tag', array('class' => 'bookbtn mt1')));?> eleifend. Suspendisse volutpat egestas rhoncus.</p><br/>
									<ul class="hotelpreferences">
										<li class="icohp-internet"></li>
										<li class="icohp-air"></li>
										<li class="icohp-pool"></li>
										<li class="icohp-childcare"></li>
										<li class="icohp-fitness"></li>
										<li class="icohp-breakfast"></li>
										<li class="icohp-parking"></li>
										<li class="icohp-pets"></li>
										<li class="icohp-spa"></li>
									</ul>
									
								</div>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
					<?php }}
					  else { ?>
    <span class="detail">No Programs found</span>
    <?php }} else {?>
	<?php
		 if(count($program) >0) { ?>

<?php 
		 foreach ($program as $program){   ?>
					<div class="offset-2">
						<div class="col-md-4 offset-0">
							<div class="listitem2">
								<a href="<?php print_r(Config::get('app.url').'uploads/program_images/'.$program->image);?>" data-footer="A custom footer text" data-title="A random title" data-gallery="multiimages" data-toggle="lightbox"><img src="<?php print_r(Config::get('app.url').'uploads/program_images/'.$program->image);?>" alt=""/></a>
								<div class="liover"></div>
								<a class="fav-icon" href="#"></a>
								<a class="book-icon" href="details.html"></a>
							</div>
						</div>
						<div class="col-md-8 offset-0">
							<div class="itemlabel3">
								<div class="labelright">
									<?php if(isset($customer))
								{?>
								<span class="detail"><a><?php echo HTML::decode(HTML::link('program_validation/'.$program->id, ''.'Tag', array('class' => 'bookbtn mt1')));?></a></span>	
							<?php } ?>		
								</div>
								<div class="labelleft2">			
									<b><?php echo $program->pgm_name; ?></b><br/><br/><br/>
									<p class="grey">
									<?php echo HTML::decode(HTML::link('program_details/'.$program->id, ''.'Details', array('class' => 'bookbtn mt1')));?></p><br/>
									<ul class="hotelpreferences">
										<li class="icohp-hairdryer"></li>
										<li class="icohp-garden"></li>
										<li class="icohp-grill"></li>
										<li class="icohp-kitchen"></li>
										<li class="icohp-bar"></li>
										<li class="icohp-living"></li>
										<li class="icohp-tv"></li>
									</ul>
									
								</div>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
					<?php }} else { ?>
    <span class="detail">No Programs found</span>
    <?php }}?>
					

			</div>
			<!-- END OF LIST CONTENT-->
			
		

		</div>
		<!-- END OF container-->
		
	</div>
	<!-- END OF CONTENT -->
	
	
	
