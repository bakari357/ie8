<style>
body {
font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
font-size: 14px;
line-height: 1.428571429;
color: #333333;
background-color: #FFFFFF;
font-weight: 400;
}


 .error
 { color: red;
    }
</style>

<body id="top" class="thebg" >
   
	 <div class="container breadcrub" style="margin-top: 13px !important;">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
                                   <li>/</li>
					<li><a href="myaccount" class="active">My Account</a></li>
					<li>/</li>
					<li><a href="#" class="active">Manage Orders</a></li>					
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
			
			<!-- CONTENT -->
			<div class="col-md-12 pagecontainer2 offset-0">
				
			
					
				<!-- RIGHT CPNTENT -->
				<div class="col-md-12 offset-0">
					<!-- Tab panes from left menu -->
					<div class="tab-content5">
					
					  <!-- TAB 1 -->
					   <div class="tab-pane padding40 active" id="profile">
<?php echo Form::open(array("id"=>"search","role"=>"form"));?>			
                <div class="right">
                 <input type="text" tabindex="0"  id="order_num" autocomplete="off" name="order_num" style="height:34px;width:219px;" placeholder="Search by order number" > 
              
                <input type="submit"  class="btn-search4" value="Search"  style="margin:4px;" >
	</div>
           {{Form::close()}}
						
						  
						  
						<div class="clearfix"></div>
						
						<div class="relative margtop10">
							
						
						</div>
						  
						
				
						<span class="size16 bold">Manage Orders</span> <br>
			<div class="line2"></div>
						  
						<!-- COL 1 -->
 <div class="col-md-12 offset-0">

                 <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Order Number</th>
                           <th>Type</th>
                             <th>Ordered Date</th>
                             <th>status</th>
                             <th>cash paid</th>
                       </tr>
                        </thead>

<?php if(isset($error)) echo $error ;?>
                   
                        <?php foreach ($order_list as $list) { 
                          
                               $type_value = json_decode($list->input) ;
                               $type = $type_value->Posted; ?>
                                  
                        
                          <tr> 
                            <td><u><a href="order_details/<?php echo $list->order_id ; ?>"> <?php echo $list->order_number ; ?></a></u></td>
             <?php  $cdata['partner']=Config::get('partner_settings.alias.'.$type->ctype); ?>
                           <td><?php if(isset($type->ctype)) echo $cdata['partner'] ;?></td>
                          <!--   <td><?php if(isset($type->ctype)) echo $type->ctype ;?></td>-->
                              <td><?php echo $list->created_date ;?></td>
                             <td><?php echo $list->status;?></td>
                             <td >Rs.<?php echo $list->cashpaid ;?></td>
                         </tr>
                        <?php } ?>
                         
                    </table>
                







						
						</div>
						<!-- END OF COL 1 -->
						
						<div class="clearfix"></div><br/><br/><br/>
						
						
						
						
						
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

		                
		$("#search").validate({
		 rules: {
                         order_num: {
			         required: true
			}
                },
		      messages: {
                         order_num: { 
                            required: "<font color='red' style='margin-top: -17px;margin-left: -218px;position: absolute;'>Order Number is required.</font>"
                        }
			 
          	}

		});
	});


   
</script>
