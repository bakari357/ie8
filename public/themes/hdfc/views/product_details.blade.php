<style>

.search {
background: none repeat scroll 0 0 #E10210;

float: left;
font-family: 'HelveticaNeueRegular',Arial,Helvetica,sans-serif;
font-size: 14px;
height: 30px;
line-height: 30px;
margin: 0;
padding: 0;
padding: 0px 0px 0px 0px;
margin: 0px 0px 0px 0px;
font-size: inherit;
text-align: center;
color: rgb(240, 235, 234);
border: 0pt ridge;
font-weight: bold;
text-decoration: none;
text-transform: none;
width: 20%;
cursor: pointer;
margin-left: 277px;
}

</style>

   {{ Form::open() }}	
 
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
 <?php  foreach ($product_details as $product){
 
            //echo '<pre>';
// print_r($imeg);
 //exit;  
              $imasg=str_replace('|1','',$product['product_images']);
              $images = explode(',', $imasg); 
              $imeg=explode('|',$product['product_images']);
              
              ?>
             
           
	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- SLIDER -->
			<div class="col-md-8 details-slider">
			
				<div id="c-carousel">
				<div id="wrapper">
				<div id="inner">
					<div id="caroufredsel_wrapper2">
						<div id="carousel">
						
						<?php if($images<>'') foreach($images as $imag) { ?>
							<img src="<?php echo $imag;?>"  alt=""/>
							<?php } ?>
						</div>
					</div>
					
					<div id="pager-wrapper">
						<div id="pager">
						<?php foreach($images as $image) { ?>
							<img src="<?php echo $image; ?>" width="120" height="68" alt=""/>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="images/spacer.png" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="images/spacer.png" alt=""/></button>		
					
		</div>
		</div> <!-- /c-carousel -->
			
		
			
			
			
			</div>
			
			<!-- END OF SLIDER -->			
			
			<!-- RIGHT INFO -->
			<div class="col-md-4 detailsright offset-0">
				<div class="padding20">
					<h4 class="lh1" style="width: 364px;"><?php echo $product['product_name'];?></h4>
					<img src="<?php echo $imeg[0] ;?>" width="40" height="40"  alt=""/>
				</div>
				
				
				
				
				
				<div class="line3 margtop20"></div>
				
				<div class="col-md-6 bordertype1 padding20">
					<span class="opensans size30 bold grey2">&#8377 <?php echo $product['mrp'];?></span><br/>
					
				</div>
				<div class="col-md-6 bordertype2 padding20">
					
				</div>
				
				<div class="col-md-6 bordertype3">
				<div class="w50percent">
                                <div class="wh90percent textleft left">
                                <span class="opensans size13"><b>Qty</b></span>
                                <select class="form-control mySelectBoxClass" name="quantity" id="quantity" >
                                 <?php for($i=1;$i<=10;$i++){?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php }?>
                                </select>
                                </div>
                                </div></div>
                              	<?php Session::put('Product_Details',$product); ?>		
				
				<div class="col-md-6 bordertype3">
					
				</div>
				<div class="clearfix"></div><br/>
				
				  <input type="submit" name="go" class="search" value="Buy Now" />
				
			</div>
			<!-- END OF RIGHT INFO -->

		</div>
		<!-- END OF container-->
		
		<div class="container mt25 offset-0">

			<div class="col-md-8 pagecontainer2 offset-0">
				<div class="cstyle10"></div>
		
				<ul class="nav nav-tabs" id="myTab">
					<li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext">Description</span>&nbsp;</a></li>
					<li onclick="mySelectUpdate()" class="active"><a data-toggle="tab" href="#roomrates"><span class="rates"></span><span class="hidetext">Specifications</span>&nbsp;</a></li>
					

				</ul>			
				<div class="tab-content4" >
					<!-- TAB 1 -->				
					<div id="summary" class="tab-pane fade ">
					<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="">
						  Product Name:<span class="collapsearrow"></span>
						</button>
						<p class="hpadding20"><?php echo $product['product_name'];?>
						</p>
						<div class="line4"></div>
						
						<!-- Collapse 1 -->	
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse1">
						  Description:<span class="collapsearrow"></span>
						</button>
						
						<div id="collapse1" class="collapse in">
							<div class="hpadding20">
								<?php echo $product['short_desc']; ?>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 1 -->	
						
						<div class="line4"></div>						
						
						
					</div>
					<!-- TAB 2 -->
					<div id="roomrates" class="tab-pane fade active in">
					    <div class="hpadding20">
							<p class="dark"></p>
							<div class="col-md-4 offset-0">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b style="margin-left:-6px;">Short Description:</b></span>
						<p style="width:700px;"<?php echo substr($product['short_desc'], 0, 330); ?> >
									</div>
								</div>

								
							</div>
							
							
							</div>
							<div class="clearfix"></div>
						</div>
						<br/>
						
						<p class="hpadding20 dark">Product Specifictaions</p>
						
						<div class="line2"></div>
						
						<div class="padding20">
							
							<div class="col-md-8 offset-0">
								<div class="col-md-8 mediafix1">
							<h4 class="opensans dark bold margtop1 lh1" style="width:391px;"><?php echo $product['product_name'];?></h4>
							
						</div>
						<div class="line2"></div>		
				<p><?php echo $product['short_desc'];?></p>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="line2"></div>							
						
					</div>
					
					
				
					
				</div>				
			
		
			<div class="col-md-4" >
				
				
				<div class="pagecontainer2 testimonialbox">
					<div class="cpadding0 mt-10">
						<span class="icon-location"></span>
						<h3 class="opensans">You May Also Like</h3>
						<div class="clearfix"></div>
					</div>
					<div class="cpadding1 ">
						<a href="#"><img src="images/smallthumb-1.jpg" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br/>
						<span class="opensans green bold size14">$36-$160</span> <span class="grey">avg/night</span><br/>
						<img src="images/filter-rating-5.png" alt=""/>
					</div>
					<div class="line5"></div>
					<div class="cpadding1 ">
						<a href="#"><img src="images/smallthumb-2.jpg" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br/>
						<span class="opensans green bold size14">$36-$160</span> <span class="grey">avg/night</span><br/>
						<img src="images/filter-rating-5.png" alt=""/>
					</div>
					<div class="line5"></div>			
					<div class="cpadding1 ">
						<a href="#"><img src="images/smallthumb-3.jpg" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br/>
						<span class="opensans green bold size14">$36-$160</span> <span class="grey">avg/night</span><br/>
						<img src="images/filter-rating-5.png" alt=""/>
					</div>
					<br/>
				
					
				</div>				
			
			</div>
		</div>
		
		
		<?php }?>
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
	
	
	
