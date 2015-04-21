<link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css"> 
<script type="text/javascript" src="themes/hdfc/assets/assetshdfc/js/script.js"></script>
<script type="text/javascript" src="themes/hdfc/assets/assetshdfc/js/moment.min.js"></script>
<script>

$(document).ready(function() {

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
var _token =  $("#_token").val();
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
    } 
if($.trim($('#movie').val()) == '')
	{
	$("#error_city").hide();
		count=1;
		document.getElementById("movie").focus();
		$("#error_movie").html("<font color='red' style='margin-top: 32px;margin-left: -318px;position: absolute;'>Movie are not found in this city</font>"); 
		return false;
    } 
    
    if(count==0)
    {
    $("#error_city").hide();
    $("#error_movie").hide();
  $('#complaintregisterpage').submit();
  }
}
</script>

<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
                                       <li>/</li>
                                        <li><?php echo HTML::link('cinemas', 'Movies'); ?></li>
					<li>/</li>
					<li><a href="#" class="active">Movie List</a></li>					
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
		<form name="complaintdetails" method="post" id="complaintregisterpage" >
		<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">	
			<!-- CONTENT -->
			<div class="col-md-12 pagecontainer3 offset-0">
				<div class="hpadding50c">
					<p class="lato size30 slim" style="color: #e20613;">Movies</p>
					<input type="hidden" id="name"  class="type" name="name" value="<?php if(isset($name)) echo $name; ?>" >
                                 <input type="hidden" id="city"  class="type" name="city" value="<?php echo $city; ?>" >
    <input type="hidden" id="moviename"  class="type" name="moviename" value="<?php if(isset($movie))echo $movie; ?>" >
				</div>
				<div class="line3"></div>
			</br>
					<div class="container col-md-12">

						<div class="pbottom15 col-xs-12 col-md-4 col-lg-4">
								<div>
									<span class="opensans size13"><b>City </b></span>
										<select name="city_id" id="city_id" class="form-control wh100percent">
                           		
                           		<?php $rep=''; foreach($cities as $cityname) {
		 if($rep==$cityname['city']){
				continue;
				}?>
		<option value="<?php echo $cityname['city']; ?>" <?php if(isset($_POST['city_id']) && $_POST['city_id']==$cityname['city']) echo 'selected' ; ?>><?php echo $cityname['city']; ?></option>
<?php $rep=$cityname['city']; } ?>
		
		</select>
									</div>
								</div>
			<div class="pbottom15 col-xs-12 col-md-4 col-lg-4">
					<div>
						<span class="opensans size13"><b>Movies </b></span>
							<select  name="movie" id="movie" class="form-control wh100percent">
                               <?php  
                     $count=count($movies);
                     if(isset($movies) && !empty($movies))  
                     {
                   $req=''; for($i=1;$i<=$count;$i++)
			{
                      if(isset($movies[$i])){
                       $film=json_decode($movies[$i]);  if($req==$film->movie){
				continue;
				}else{  ?>    
                     <option class="econsel" class="field1menu" value="<?php echo $film->movie; ?>" <?php if(isset($_POST['movie']) && $_POST['movie']==$film->movie) echo 'selected' ; ?>><?php echo $film->movie; ?></option>
			<?php }
$req=$film->movie; }
                      }}
                      else { 
                      if(isset($movie) && !empty($movie))
                      {?>
                      <option class="econsel" class="field1menu" value="<?php echo $movie; ?>" <?php if(isset($_POST['movie']) && $_POST['movie']==$movie) echo 'selected' ; ?>><?php echo $movie; ?></option>
                      
                      <?php }}  ?>
                               </select>
					</div>
			</div>

			<div class="col-xs-12 col-md-2 col-lg-2">
				<div>
					<span class="pbottom15 opensans size13"><b>Date</b></span>
							<select name="daterange" id="daterange" class="date-cinemas wh100percent">
                                <option value="<?php echo date('Y-m-d'); ?>" <?php if(isset($daterange) && $daterange==date('Y-m-d')) echo 'selected' ; else echo ''; ?>>Today <?php echo date('M d, Y'); ?></option>
		<option value="<?php echo date('Y-m-d',mktime(0, 0, 0, date('m'), date('d')+1, date('y'))); ?>" <?php if(isset($daterange) && $daterange==date('Y-m-d',mktime(0, 0, 0, date('m'), date('d')+1, date('y')))) echo 'selected' ;else echo ''; ?>>Tomorrow <?php echo date('M d',mktime(0, 0, 0, date('m'), date('d')+1, date('y'))); ?> </option>

		 <?php for($i=2;$i<3;$i++) { ?>
   <option value="<?php echo date('Y-m-d',mktime(0, 0, 0, date('m'), date('d')+$i, date('y'))); ?>" <?php if(isset($daterange) && $daterange==date('Y-m-d',mktime(0, 0, 0, date('m'), date('d')+$i, date('y')))) echo 'selected' ;else echo ''; ?> ><?php echo date('l',mktime(0, 0, 0, date('m'), date('d')+$i, date('y'))); ?> <?php echo date('M d',mktime(0, 0, 0, date('m'), date('d')+$i, date('y'))); ?></option>
    <?php }?>
                                </select>
				</div>
			</div>
			<div class="pbottom15 col-xs-12 col-md-2 col-lg-2">
				<div class="center">
					<button type="submit" class="movie_button">Search</button>
				
			</div></div>
	

	<div class="clearfix"></div>
</div></form>       <table class="table"><tr>
<?php include('funcinema_time.php'); 
/*foreach($cinepolis as $cin_tim)
{
$cine_filter=array_filter($cin_tim['times']['FnSchedule_CityMovieDateResult']);
}
foreach($funcinemas as $fun_tim)
{
  $fn_filter=array_filter($fun_tim['times']);
}
 if(empty($funcinemas) && empty($cinepolis))
{ ?>
<br/><br/></br>
	<?php echo '<span style="margin-left: 28px;font-weight: bold;"><td style="padding: 31px;"> No booking shows are available for this movie.</span></td></tr>';
} elseif(isset($fn_filter) && empty($fn_filter)  && isset($cine_filter) && empty($cine_filter)){ ?>
<br/><br/></br>
	<?php echo '<span style="margin-left: 28px;font-weight: bold;"><td style="padding: 31px;"> No booking shows are available for this movie.</span></td></tr>';
}
elseif(isset($fn_filter) && empty($fn_filter)  && isset($cinepolis) && empty($cinepolis)){ ?>
<br/><br/></br>
	<?php echo '<span style="margin-left: 28px;font-weight: bold;"><td style="padding: 31px;"> No booking shows are available for this movie.</span></td></tr>';
}elseif(empty($fn_filter) && isset($cine_filter) && empty($cine_filter)){ ?>
<br/><br/></br>
	<?php echo '<span style="margin-left: 28px;font-weight: bold;"><td style="padding: 31px;"> No booking shows are available for this movie.</span></td></tr>';
}else {

if(isset($funcinemas) &&  !empty($funcinemas)) {   ?>

<?php if(!empty($funcinemas)){ 
foreach($funcinemas as $funtime)
{
        $fun['time']=$funtime['times'];
        if(!empty($fun['time']))
	{  ?>
	<div class="line3"></div></br>
	<div class="table-responsive col-xs-12">
	<table class="table"> <tr>
	<?php 
	} }?><?php 
include('funcinema_time.php');
$pre=0;
?> </tr></table>
<?php }}  if(isset($cinepolis) && !empty($cinepolis)) {  ?>	
<?php foreach($cinepolis as $cine)
{
$pre=0;
if(!empty($cine['times'])){ 
$cine_filter=array_filter($cine['times']['FnSchedule_CityMovieDateResult']);
 if(!empty($cine_filter)){ ?>

<br><br><div class="line3"></div><br><br><br><br><br>

<div class="table-responsive col-xs-12">
		<table class="table">
                            <tr>
<?php $pre=$pre+1; ?>

<?php //include('cinetime.php');
}}}?>
<?php } elseif(isset($funcinemas) && !empty($funcinemas))
{
 foreach($funcinemas as $fun_time)
{ 
if(isset($fun_time['times']['ShowDetail']) && !empty($fun_time['times']['ShowDetail']) )
{
 $fun_filter=array_filter($fun_time['times']['ShowDetail']);
}elseif(empty($fun_time['times']))
{
$fun_filter='nothing';
 }
 elseif(isset($fun_time['times']['ShowDetail_attr']) && !empty($fun_time['times']['ShowDetail_attr']))
{
$fun_filter=array_filter($fun_time['times']['ShowDetail_attr']);
}
 if(empty($fun_filter))
{ 
?>
<br/><br/>
<?php echo '<span style="margin-left: 28px;font-weight: bold;"><td style="padding: 31px;"> No booking shows are available for this movie.</span></td></tr>';
 }}  }}
 
 */ ?>
 </tr>       </table>
</div>
</form>

					<!-- END OF IMG RIGHT TEXT -->
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- END CONTENT -->			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
