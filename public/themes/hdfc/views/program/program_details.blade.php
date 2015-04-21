
 
	
	
	
	<div class="container breadcrub">
	    <div>
			
			
				<ul class="bcrumbs">
					<a class="homebtn left" href="<?php echo url::to('list_program');?>"></a>
					<li><a href="#">Program Details</a></li>
					<li>/</li>
									
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	
    <?php  foreach ($program_details as $programs){
     $program = $programs;
     }       
	 ?>
	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- SLIDER -->
			<div class="col-md-8 details-slider">
			
				<div class="wh80percent center">
					<img src="<?php print_r(Config::get('app.url').'uploads/program_images/'.$program->image);?>" class="fwimg" alt=""/>
				</div>
				
				<script>
				//Popover tooltips
				  $(function (){
					 $("#infottip2").popover({placement:'top', trigger:'hover'});
				  });
				</script>
		
				
			
			</div>
			
			<!-- END OF SLIDER -->			
			
			<!-- RIGHT INFO -->
			<div class="col-md-4 detailsright offset-0">
				<div class="padding20">
				<div class="cposalert">
					<a href="#" class="lblue" rel="popover" id="infottip2" data-content="><?php echo $program->pgm_desc;?>">What is this?</a>
					
				</div>
					<div class="wh70percent left">
						<span class="opensans size18 dark bold"><?php echo $program->pgm_name; ?></span><br/>
						
					</div>
					
					<div class="clearfix"></div>
				</div>
				
				<div class="line3"></div>
				
				<div class="padding20">
				
					<script>
					//Popover tooltips
					  $(function (){
						 $("#infottip").popover({placement:'top', trigger:'hover'});
					  });
					</script>
					
					<span class="opensans size14 bold dark">Extras</span> <span class="glyphicon glyphicon-info-sign lblue cpointer" rel="popover" id="infottip" data-content="This field is mandatory" data-original-title="Here you can add additional information about the car"></span>
					
					<div class="rchkbox size13 grey2">
						
						
						
						
						
					</div>
					
				
				</div>
				
				<div class="line3"></div>
				
				<div class="padding20">
					
				</div>
				
				

			
				
				
				
				<div class="line3"></div>
				
				<div class="clearfix"></div>
				
				<div class="hpadding20">
				
				</div>
			</div>
			<!-- END OF RIGHT INFO -->

		</div>
		<!-- END OF container-->
		
		<div class="container mt25 offset-0">
			
			<!-- CONTENT -->	
			<div class="col-md-8 pagecontainer2 offset-0">
				
				<br/>
				
				<p class="padding20">
					<span class="bold dark">Program details</span><br/><br/>
					<span class="icn-air"></span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="icn-gas"></span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="icn-gear"></span><br/>
				</p>
				<div class="line4"></div>
				
				
				
				<!-- Collapse 6 -->	
				<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse6">
				 Program Url <span class="collapsearrow"></span>
				</button>
				
				<br/><br/>
				
				<div id="collapse6" class="collapse in">
					<div class="hpadding20">
						<p><?php echo $program->pgm_url;?> </p>	
					</div>
					<div class="clearfix"></div>
				</div>
				
				<!-- End of collapse 6 -->		
				
				<br/><br/>
				<div class="line4"></div>	

				
				<!-- Collapse 1 -->	
				<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse1">
				 Program Description <span class="collapsearrow"></span>
				</button>
				
				<br/><br/>
				
				<div id="collapse1" class="collapse in">
					<div class="hpadding20">
					<span>	<?php echo $program->pgm_desc;?></span>
						<br/><br/>
						

					</div>
					<div class="clearfix"></div>
				</div>
				
				
				<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse1">
				 About  Us <span class="collapsearrow"></span>
				</button>
				
				<br/><br/>
				
				<div id="collapse1" class="collapse in">
					<div class="hpadding20">
					<span>	<?php echo $program->about_us;?></span>
						<br/><br/>
						

					</div>
					<div class="clearfix"></div>
				</div>
				<!-- End of collapse 1 -->	
				
				<br/><br/>
				<br/><br/>
				<br/>



			</div>
			<!-- END OF CONTENT -->	
			
			<div class="col-md-4" >
				
				<div class="pagecontainer2 testimonialbox">
					<div class="cpadding0 mt-10">
						<span class="icon-quote"></span>
						<p class="opensans size16 grey2">Future<br/>
						
					</div>
				</div>
				
				<div class="pagecontainer2 mt20 needassistancebox">
					<div class="cpadding1">
						<span class="icon-help"></span>
						<h3 class="opensans">Future</h3>
						
					</div>
				</div><br/>
				
				<div class="pagecontainer2 mt20 alsolikebox">
					<div class="cpadding1">
						<span class="icon-location"></span>
						<h3 class="opensans">Future</h3>
						<div class="clearfix"></div>
					</div>
					<div class="cpadding1 ">
						
					<br/>
				
					
				</div>				
			
			</div>
		</div>
		
		
		
	</div>
	<!-- END OF CONTENT -->
	
	
	


	
	
	<!-- FOOTER -->

	<div class="footerbgblack">
		<div class="container">		
			
			<div class="col-md-3">
				<span class="ftitleblack">Let's socialize</span>
				<div class="scont">
					<a href="#" class="social1b"><img src="images/icon-facebook.png" alt=""/></a>
					<a href="#" class="social2b"><img src="images/icon-twitter.png" alt=""/></a>
					<a href="#" class="social3b"><img src="images/icon-gplus.png" alt=""/></a>
					<a href="#" class="social4b"><img src="images/icon-youtube.png" alt=""/></a>
					<br/><br/><br/>
					<a href="#"><img src="images/logosmal2.png" alt="" /></a><br/>
					<span class="grey2">&copy; 2013  |  <a href="#">Privacy Policy</a><br/>
					All Rights Reserved </span>
					<br/><br/>
					
				</div>
			</div>
			<!-- End of column 1-->
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Golf Vacations</a></li>
					<li><a href="#">Ski & Snowboarding</a></li>
					<li><a href="#">Disney Parks Vacations</a></li>
					<li><a href="#">Disneyland Vacations</a></li>
					<li><a href="#">Disney World Vacations</a></li>
					<li><a href="#">Vacations As Advertised</a></li>
				</ul>
			</div>
			<!-- End of column 2-->		
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Weddings</a></li>
					<li><a href="#">Accessible Travel</a></li>
					<li><a href="#">Disney Parks</a></li>
					<li><a href="#">Cruises</a></li>
					<li><a href="#">Round the World</a></li>
					<li><a href="#">First Class Flights</a></li>
				</ul>				
			</div>
			<!-- End of column 3-->		
			
			<div class="col-md-3 grey">
				<span class="ftitleblack">Newsletter</span>
				<div class="relative">
					<input type="email" class="form-control fccustom2black" id="exampleInputEmail1" placeholder="Enter email">
					<button type="submit" class="btn btn-default btncustom">Submit<img src="images/arrow.png" alt=""/></button>
				</div>
				<br/><br/>
				<span class="ftitleblack">Customer support</span><br/>
				<span class="pnr">1-866-599-6674</span><br/>
				<span class="grey2">office@travel.com</span>
			</div>			
			<!-- End of column 4-->			
		
			
		</div>	
	</div>
	
	<div class="footerbg3black">
		<div class="container center grey"> 
		<a href="#">Home</a> | 
		<a href="#">About</a> | 
		<a href="#">Last minute</a> | 
		<a href="#">Early booking</a> | 
		<a href="#">Special offers</a> | 
		<a href="#">Blog</a> | 
		<a href="#">Contact</a>
		<a href="#top" class="gotop scroll"><img src="images/spacer.png" alt=""/></a>
		</div>
	</div>
	
	
	
  </body>
</html>
