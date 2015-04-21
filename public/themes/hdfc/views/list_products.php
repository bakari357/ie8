<script src="themes/hdfc/assets/jsfillter/jquery-1.8.2.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.min.js"></script>
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script> 
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script>
<script src="themes/hdfc/assets/jsfillter/mustache.js"></script>
<script src="themes/hdfc/assets/jsfillter/product.js"></script>
<script src="themes/hdfc/assets/jsfillter/filter.js"></script> 
<script src="themes/hdfc/assets/jsfillter/chck_box.js"></script> 
<script type="text/javascript">
(function($){
 $("img").lazyload({
     effect       : "fadeIn"
 });
})(jQuery);
function loadage(id)
{
//numberof children
}
</script>
	<!-- end -->
  </head>
  <body id="top" class="thebg" >
    <form action="list_products"  id="sort_form">
	<span style="float:right; padding-top:20px;margin-right: 5%;">
	                    
                              <span class="price">  Sort By</span>
                              
                                 <?php $option = array('select'=>'Select','1' => 'A-Z', '2' => 'Z-A','3'=>' Low->High','4'=>'High->Low');
                                ?>
                               <?php echo Form::select("sorted_by",$option,$selected,array("id"=>"sorted_by","class"=>"seloption")); ?>
                             
              </span>           
	</form>
	<!-- Breadcrumbs -->
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
	<!-- / Breadcrumbs -->

	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- FILTERS -->
			<div class="col-md-3 filters offset-0" style="height:1244px;"><!-- TOP TIP -->
				<div class="filtertip">
					
				</div><div class="bookfilters hpadding20"></div>
				<!-- END OF BOOK FILTERS -->	
				
				<div class="line2"></div>
				
				<div class="padding20title"><h3 class="opensans dark">Filter by</h3></div>
				<div class="line2"></div>
				
				<!-- Star ratings -->	
			<!--	<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse1">
				  Star rating <span class="collapsearrow"></span>
				</button>

				<div id="collapse1" class="collapse in">
					<div class="hpadding20">
						<div class="checkbox">
							<label>
							  <input type="checkbox"><img src="images/filter-rating-5.png" class="imgpos1" alt=""/> 5 Stars
							</label>
						</div>
						<div class="checkbox">
							<label>
							  <input type="checkbox"><img src="images/filter-rating-4.png" class="imgpos1" alt=""/> 4 Stars
							</label>
						</div>
						<div class="checkbox">
							<label>
							  <input type="checkbox"><img src="images/filter-rating-3.png" class="imgpos1" alt=""/> 3 Stars
							</label>
						</div>
						<div class="checkbox">
							<label>
							  <input type="checkbox"><img src="images/filter-rating-2.png" class="imgpos1" alt=""/> 2 Stars
							</label>
						</div>
						<div class="checkbox">
							<label>
							  <input type="checkbox"><img src="images/filter-rating-1.png" class="imgpos1" alt=""/> 1 Star
							</label>
						</div>	
					</div>
					<div class="clearfix"></div>
				</div>-->
				<!-- End of Star ratings -->	
				
				<div class="line2"></div>
				
				<!-- Price range -->					
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse2">
				  Price range <span class="collapsearrow"></span>
				</button>
					
				 <div class="price_pad">
                        	
                            	 <div id="price_criteria">
				  <span id="price_label1" class="slider-label"></span>
					  <span id="price_label2" class="slider-label"></span>

				  <div id="price_slider" class="slider"></div>
				  <input type="hidden" id="price_filter" value="">
                                   <input type="hidden" id="price_filter_hidden" value="">
                            </div>
                        </div>
				<!-- End of Price range -->	
				
				
				
				
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
					<div class="topsortby">
						<div class="col-md-4 offset-0">
								
							
							<div class="w50percentlast">
								<div class="wh90percent">
									<select class="form-control mySelectBoxClass ">
									  <option selected>Price</option>
									  <option>Ascending</option>
									  <option>Descending</option>
									</select>
								</div>
							</div>					
						</div>
						<div class="col-md-4 offset-0">
							
							<div class="right">
								<button class="gridbtn active">&nbsp;</button>
								<button class="listbtn" onClick="window.open('list4.html','_self');">&nbsp;</button>
								<button class="grid2btn" onClick="window.open('list3.html','_self');">&nbsp;</button>
							</div>
						</div>
					</div>
					<!-- End of topfilters-->
				</div>
				<!-- End of padding -->
			
				<br/><br/>
				<div class="clearfix"></div>
				<div class="clearfix"></div>
				<script id="template" type="text/html">
			
					{{#hotel_data }}
					<div class="offset-1">
					<div class="col-md-4">
						<div class="listitem">
							<a title="Add to wishlist" href="product_details/{{hotel_id }}"><img src="{{image}}" alt=""/>
							</a><div class="liover"></div>
							
							
						</div>
						<div class="itemlabel" style="height:65px;">
												
							<a title="Add to wishlist" href="product_details/{{hotel_id }}"><b>{{hotel_name}}</b></a><br/>
							<p class="lightgrey"><span class="green size14">&#8377 <b>{{product_price}}</b></span></p>
							<!--{{product_description}} -->
						</div>
					</div>
					
</div>
			{{/hotel_data}}</a>
</script> 	
<div id="movies">
<div id="resultss"></div>
<div id="result" align="center"><div style="padding-top:120px;">  
               	<section class="retrive_password">
                    <h3>Searching for available Products</h3>
                    <div class="retrive_password_content">
                    <img style="padding-right: 57px;" src="<?php echo Theme::asset()->url('assetshdfc/img/ajax-loader.gif'); ?>"> </div>
                 
             </section></div></div> 		
				</div>	</div>	
				<!-- End of offset1-->		

				<div class="hpadding20">
				
					<ul class="pagination right paddingbtm20">
					  <li class="disabled"><a href="#">&laquo;</a></li>
					  <li><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
					  <li><a href="#">4</a></li>
					  <li><a href="#">5</a></li>
					  <li><a href="#">&raquo;</a></li>
					</ul>

				</div>

			</div>
			<!-- END OF LIST CONTENT-->
			
		

		</div>
		<!-- END OF container-->
		
	</div>
	<!-- END OF CONTENT -->
	<script id="car_name_template" type="text/html">
     <div class="">
							<label>
							<input type="checkbox" value="{{car_name}}" ><img src="themes/hdfc/assets/images/filter-rating-{{car_name}}.png" class="imgpos1" alt=""/>{{car_name}} Stars
							</label>
						</div>
	
</script>

<script id="stops_template" type="text/html">
	<li>
	<input type="checkbox" value="{{nos}}" class="f_all"><span class="ccr_lab"> {{nos}}</span>
	</li>
</script>


<script>	
 $("#sorted_by").on('change',function(){
     $("#sort_form").submit();
     });
     </script>
  
