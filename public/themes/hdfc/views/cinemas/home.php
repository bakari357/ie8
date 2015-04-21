<script>
$(document).ready(function() {
$("#city_id").val('Select');
var type=<?php echo $type; ?>;
if(type==0)
{
$("#movie_div").show();
$("#theatre_div").hide();
}
else
{
$("#movie_div").hide();
$("#theatre_div").show();
}


$(".type").click(function(){

var type=$(this).val();
if(type==0)
{
$("#movie_div").show();
$("#theatre_div").hide();
}
else
{
$("#movie_div").hide();
$("#theatre_div").show();
}
});
$("#city_id").change(function(){

var city=$("select#city_id option:selected").val();
var _token =$("#_token").val();

  $.ajax({
                      type: "POST",
                      url: "<?=URL::to('loadfilm')?>",
                      data: {
               "type":type,"city": city,
               "_token":_token
              },             
                        success: function(data1) {
                          $("#movie").html(data1);
                                  
                      }
                  });


});


		});
</script>
			
<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#" class="active">Movies</a></li>					
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
			
			<!-- CONTENT -->
			<div class="col-md-12 pagecontainer2 offset-0">
				<div class="hpadding50c">
					<p class="lato size30 slim" style="color: #e20613;">Movies</p>
					
				</div>
				 <?php if(Session::has('message')) {
                                        $fail = Session::get('message');
                                        ?>
            <div class="alert alert-info"> <?php echo $fail; ?> </div>
            <?php } ?>
				<div class="line3"></div>
				<br>
 <form name="complaintdetails" method="post" id="complaintregisterpage" action="listcinemas">
 <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" id="type"  class="type" name="type" value="0" >
				<div class="container col-md-12">

						<div class="pbottom15 col-xs-12 col-md-4 col-lg-4">
								<div>
									
										<span class="opensans size13"><b>City </b></span>
										
<select name="city_id" class="form-control wh100percent"  id="city_id" onChange="enable();" >
                           		
                           		<?php $rep=''; foreach($citys as $city) {
                       if($rep==$city['city']){
				continue;
				}

		?>
		<option value="<?php echo $city['city']; ?>"><?php echo $city['city']; ?></option>

		<?php $rep=$city['city']; } ?>
		</select>
									</div>
						</div>
						<div class="pbottom15 col-xs-12 col-md-4 col-lg-4">
								<div>
				<span class="opensans size13"><b>Movies </b></span>
										<select  name="movie" class="form-control wh100percent" id="movie">
                               <option value="">Select</option>
                               
                               </select>
									</div>
						</div>

						<div class="pbottom15 col-xs-12 col-md-2 col-lg-2">
								<div>
<span class="opensans size13"><b>Date</b></span>
										<select name="daterange" class="date-cinemas wh100percent" id="daterange" >
                                <option value="<?php echo date('Y-m-d'); ?>" <?php if(isset($daterange) && $daterange==date('Y-m-d')) echo 'selected' ; else echo ''; ?>>Today <?php echo date('M d, Y'); ?></option>
		<option value="<?php echo date('Y-m-d',mktime(0, 0, 0, date('m'), date('d')+1, date('y'))); ?>" <?php if(isset($daterange) && $daterange==date('Y-m-d',mktime(0, 0, 0, date('m'), date('d')+1, date('y')))) echo 'selected' ;else echo ''; ?>>Tomorrow <?php echo date('M d, Y',mktime(0, 0, 0, date('m'), date('d')+1, date('y'))); ?> </option>

		 <?php for($i=2;$i<3;$i++) { ?>
   <option value="<?php echo date('Y-m-d',mktime(0, 0, 0, date('m'), date('d')+$i, date('y'))); ?>" <?php if(isset($daterange) && $daterange==date('Y-m-d',mktime(0, 0, 0, date('m'), date('d')+$i, date('y')))) echo 'selected' ;else echo ''; ?> ><?php echo date('l',mktime(0, 0, 0, date('m'), date('d')+$i, date('y'))); ?> <?php echo date('M d, Y',mktime(0, 0, 0, date('m'), date('d')+$i, date('y'))); ?></option>
    <?php }?>
                                </select>
									</div>
						</div>
						<div class="pbottom15 col-xs-12 col-md-2 col-lg-2">
								<div class="center">
										<button type="button" onclick="submitform();" class="movie_button" >Search</button>
								</div>
						</div>
		</div>
		</form>
	<!--<div class="col-xs-12 col-md-12 col-lg-12">
	<div class="col-xs-6 col-md-6 col-lg-6" style="background-color:red">Hello </div> <div class="col-xs-6 col-md-6 col-lg-6"  style="background-color:blue"> World </div> 
	</div> -->
					<!-- END OF IMG RIGHT TEXT -->
					<div class="clearfix"></div>
					<br/><br/>
			</div>
		</div>

			<!-- END CONTENT -->			
			

			
		
		
	

<script>
        function submitform()
{

var search_name=document.getElementById('movie').value;

var search_name=document.getElementById('city_id').value;
 var count=0;
 if($.trim($('#city_id').val()) == '')
	{
		count=1;
		document.getElementById("city_id").focus();
		$("#error_city").html("<font color='red'>Select the city</font>"); 
		return false;
    }else 
if($.trim($('#movie').val()) == '')
	{
	$("#error_city").hide();
		count=1;
		document.getElementById("movie").focus();
		$("#error_movie").html("<font color='red' style='margin-top: 52px;margin-left: -164px;position: absolute;'>Movie are not found in this city</font>"); 
		return false;
    } 
    
    if(count==0)
    {
    $("#error_city").hide();
    $("#error_movie").hide();
  $('#complaintregisterpage').submit();
  }
}
function enable()
{
$("#error_city").hide();
}
</script>
