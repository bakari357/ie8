<script>

$(document).ready(function(){
$(function() {
  $('#datepicker').datepicker({ minDate: new Date() });
$('#datepicker2').datepicker({ minDate: new Date() });
});
$('#hotelform').validate({
                focusInvalid: false, 
                ignore: "",
                rules: {
                       cityname: {
                        required: true
                    },
			 check_in: {
                        required: true
                    },
			 check_out: {
                        required: true
                    },
                    form1CardHolderName: {
			minlength: 2,
                        required: true
                    },
                    form1CardNumber: {
                        required: true,
                        creditcard: true
                    }
                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (label, element) { // render error placement for each input type   
					$('<span class="error"></span>').insertAfter(element).append(label)
                    var parent = $(element).parent('.input-with-icon');
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					var parent = $(element).parent();
                    parent.removeClass('success-control').addClass('error-control'); 
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
					var parent = $(element).parent('.input-with-icon');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
                submit();
                }
            });	
	
	$('#cityname').keypress(function () { 
	this.value = this.value;
	});	
		
	});


$(function() {
    
               $("#cityname").autocomplete({
                    source: "cityautocomplete",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#city_id').val(ui.item.id);
                      
                    },
                      position: {
       				  my: "left top",
			          at: "left bottom",
				      collision: "flip"
    					}
                    
                    
                });
                
                $("#num_rooms").change(function () {
                var count = $("select#num_rooms option:selected").attr('value');
                $.post("loadadult/"+count, function(data){
                $("#adultdiv").html(data);
               //jQuery(".seloption").select_skin();
				
});  

            
               $.post("loadchild/"+count, function(data1){  
               $("#childdiv").html(data1);
               //jQuery(".seloption").select_skin();
               });
               $.post("num_row_child/"+count, function(data1){
              
               $("#child_age").html(data1);
                
               });
                
                });
               
               
              
             
                
	   	$( "#datepicker" ).datepicker({
			dateFormat : 'dd/mm/yy',
			changeMonth : true,
			changeYear : true, 
			minDate: '+1d',
			showButtonPanel: true,
			onSelect: function( selectedDate ) {
			
			
				var minDate = $(this).datepicker('getDate');
				if (minDate) {
				minDate.setDate(minDate.getDate() + 1);
				
				}
                                var dateMin = $('#datepicker').datepicker("getDate");
                                var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 1); 
                                var rMax = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 1); 
                                $('#datepicker2').val($.datepicker.formatDate('dd/mm/yy', new Date(rMax)));     
                        
				$( "#datepicker2" ).datepicker( "option",{ minDate:minDate,"setDate":'+1d' }, selectedDate  );

			}

		});
		
		
		$( "#datepicker2" ).datepicker({
		dateFormat : 'dd/mm/yy',
		changeMonth : true,
		changeYear : true, 
		minDate: '+1d',
		showButtonPanel: true,
		onSelect: function( selectedDate ) { //alert($('#startPicker').val());
			var minDate = $(this).datepicker('getDate');
			if (minDate) {
			minDate.setDate(minDate.getDate());
			}
			$( "#datepicker" ).datepicker( "option",{ maxDate:minDate}, selectedDate );
		}
		});
	});
	
	function loadage(id)
              { 
            
               var count = $("select#numberOfChildren"+id+" option:selected").attr('value');
              $.ajax({
                      type: "POST",
                      url: "<?=URL::to('loadage')?>",
                      data: {
               "id":id,"count": count
              },             
                        success: function(data1) {
                        
                          $("#childage"+id).html(data1);
                      }
                  });
            
          }
	function date_validation()
{
var start=$('#datepicker').val();
var end= $('#datepicker2').val();
if(start==end)
{
alert("Check-in date and check-out date not be same.");
return false;
}else
{
return true;

}

}

    </script> 
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script>

<style> .error{ color:red;} </style>

<!-- /Top wrapper -->


	<!--
	#################################
		- THEMEPUNCH BANNER -
	#################################
	-->
	<div id="dajy" class="fullscreen-container mtslide sliderbg fixed" >
			<div class="fullscreenbanner">
				<ul>

					<!-- papercut fade turnoff flyin slideright slideleft slideup slidedown-->
				
				
					<!-- FADE -->
					<li class="banner_height" data-transition="fade" data-slotamount="1" data-masterspeed="300"> 										
						
						<img src="<?php echo Theme::asset()->url('images/Hotels Slide-a.jpeg');?>" alt=""/>
						<div class="tp-caption scrolleffect sft"
							 data-x="center"
							 data-y="150"
							 data-speed="1000"
							 data-start="800"
							 data-easing="easeOutExpo"  >
							 <div class="sboxpurple textcenter">
								
							 </div>
						</div>	
					</li>	
					
					<!-- FADE -->
					<li class="banner_height" data-transition="fade" data-slotamount="1" data-masterspeed="300"> 										
						<img src="<?php echo Theme::asset()->url('images/Hotels Slide-b.jpeg');?>" alt=""/>
						<div class="tp-caption scrolleffect sft"
							 data-x="center"
							 data-y="120"
							 data-speed="1000"
							 data-start="800"
							 data-easing="easeOutExpo">
							 <div class="sboxpurple textcenter">
								
							 </div>
						</div>	
					</li>	
				
					<!-- FADE -->
					


				</ul>
				<div class="tp-bannertimer none"></div>
			</div>
		</div>

		<!--
		##############################
		 - ACTIVATE THE BANNER HERE -
		##############################
		-->
		<script type="text/javascript">

			var tpj=jQuery;
			tpj.noConflict();

			tpj(document).ready(function() {

			if (tpj.fn.cssOriginal!=undefined)
				tpj.fn.css = tpj.fn.cssOriginal;

				tpj('.fullscreenbanner').revolution(
					{
						delay:9000,
						startwidth:1170,
						startheight:200,

						onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off

						thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
						thumbHeight:50,
						thumbAmount:3,

						hideThumbs:0,
						navigationType:"bullet",				// bullet, thumb, none
						navigationArrows:"solo",				// nexttobullets, solo (old name verticalcentered), none

						navigationStyle:false,				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


						navigationHAlign:"left",				// Vertical Align top,center,bottom
						navigationVAlign:"bottom",					// Horizontal Align left,center,right
						navigationHOffset:30,
						navigationVOffset:30,

						soloArrowLeftHalign:"left",
						soloArrowLeftValign:"center",
						soloArrowLeftHOffset:20,
						soloArrowLeftVOffset:0,

						soloArrowRightHalign:"right",
						soloArrowRightValign:"center",
						soloArrowRightHOffset:20,
						soloArrowRightVOffset:0,

						touchenabled:"on",						// Enable Swipe Function : on/off


						stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
						stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

						hideCaptionAtLimit:0,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
						hideAllCaptionAtLilmit:0,				// Hide all The Captions if Width of Browser is less then this value
						hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value


						fullWidth:"on",							// Same time only Enable FullScreen of FullWidth !!
						
						fullScreen:"on",						// Same time only Enable FullScreen of FullWidth !!


						shadow:0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

					});


		});
		</script>
		

		



	<!-- WRAP -->
	<div class="wrap cstyle03">
		
		<div class="container mt_h-130 z-index100">		
		  <div class="row">
			<div class="col-md-12" >
				<div class="bs-example bs-example-tabs cstyle04" >
				
					<ul class="nav nav-tabs" style="background:none;display: none;" id="myTab" >
						<li onclick="mySelectUpdate()" style="position: absolute;margin-top: 30px;" class="active"><a data-toggle="tab" href="#hotel2"><span class="hotel"></span><span class="hidetext">Hotel</span>&nbsp;</a></li>
						
					</ul>
					{{ Form::open(array("id"=>"hotelform","onclick"=>"return date_validation();","accept-charset"=>"UTF-8")) }}
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<div class="tab-content2" id="myTabContent" style="height:auto !important;margin-top: 30px;">
							<div id="hotel2"  class="tab-pane fade active in" style="height:auto">
<div class="hpadding50c_hot">
					<p class="lato size30 slim">Hotels</p>
				</div>
				<div class="line3"></div><br>
							<div class="pbottom15 col-xs-12 col-md-6 col-lg-6 pt-6">
								<span class="opensans size16" ><b>Where do you want to go?</b></span>
		<?php $inputName = "cityname"; ?>	
		<!--[if lte IE 8]>
<label for="cityname">City, State, Country</label>

<![endif]-->
	
 <?php echo Form::text($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"form-control","placeholder"=>"City, State, Country")); ?>
  
<?php $inputName = "city_id"; ?>
    <?php echo Form::hidden($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"citbox_hot")); ?>                    

							</div>
<div class="pbottom15 col-xs-12 col-md-6 col-lg-6 pt-6">
								<span class="opensans size16" ><b>Hotel Name</b></span>
<?php $inputName = "search_name"; ?>
    <?php echo Form::text($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"form-control")); ?>
</div>
							<div class="nopad col-xs-12 col-md-12 col-lg-12 clearfix">
								<div class="pbottom15 col-xs-12 col-md-6 col-lg-6">
									<div class="wh100percent textleft">
										<span class="opensans size14" style="color:black;"><b>Check in date</b></span>
 <?php $inputName = "check_in"; ?>
<?php $tomorrow = date("d/m/Y",mktime(0, 0, 0,date("m"), date("d")+1, date("y")));
                                       
                                        ?>
<?php echo Form::text($inputName,$tomorrow , array("id"=>"datepicker", "class"=>"form-control mySelectCalendar", "readonly autocomplete"=>"off", "style"=>"background-color: #ffffff;")); ?>
									</div>
								</div>

								<div class="pbottom15 col-xs-12 col-md-6 col-lg-6">
									<div class=" wh100percent textleft">
										<span class="opensans size14" style="color:black;font-size: 14px"><b>Check out date</b></span>
 <?php $dtomorrow = date("d/m/Y", mktime(0, 0, 0,date("m"),date("d")+2, date("y"))); ?> 
										 <?php $inputName = "check_out"; ?>
    <?php echo Form::text($inputName, $dtomorrow, array("id"=>"datepicker2", "class"=>"form-control mySelectCalendar", "readonly autocomplete"=>"off", "style"=>"background-color: #ffffff;")); ?>

									</div>
								</div>
							</div>
							
							<div class="nopad col-xs-12 col-md-12 col-lg-12 clearfix">
								<div class="clearfix room1" >
									<div class="pbottom15 col-xs-12 col-md-3 col-lg-3">
										<div class="textleft">
									
                            	
                                 	<span class="opensans size14" style="color:black;">  <b>Rooms</b></span>
                               
                                <!--,'style'=>'opacity: 0; position: relative; z-index: 100;' !-->
                                <?php $rooms = array('1' => '1', '2' => '2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8');?>
                               <?php echo Form::select("num_rooms",$rooms,'',array("id"=>"num_rooms", "class"=>"form-control")); ?>
                             
										</div>

									</div>


								<div class="nopad col-xs-12 col-md-9 col-lg-9" id="adultdiv">
								<span class="room col-xs-12 col-md-2 col-lg-2" ><b style="display:block; padding-top:24px"> Room 1</b></span>
								<div class="nopad pbottom15	 col-xs-12 col-md-10 col-lg-10">
								<div class="col-xs-12 col-md-6 col-lg-6">

				<div>
				 <span class="opensans size14"><b>Adults </b></span>
				<?php $adults = array('1' => '1', '2' => '2','3'=>'3','4'=>'4');?>
						<?php echo Form::select('numberOfAdults1',$adults,null,array( "class"=>"form-control")); ?>
					
						</div>
						</div>							
						<div class="col-xs-12 col-md-6 col-lg-6">
						
						<div>
						<span class="opensans size14"><b>Child</b></span>
						<?php if(Input::get('num_rooms')){
                              $num_rooms = Input::get('num_rooms');
                             }else{
                             $num_rooms = 1;
                             }?>
                            
                                 <?php  for($b=1;$b<=$num_rooms;$b++) {    ?>  
	<?php $children = array('0' => '0','1' => '1', '2' => '2','3'=>'3');?>
                               <?php echo Form::select('numberOfChildren'.$b,$children,null,array( "id"=>"numberOfChildren".$b,"class"=>"form-control","onchange"=>"loadage($b);")); ?>
                               <?php } ?> 
                               
						</div>
						</div>
						
						</div>
						
						<div id="childage1" class="pbottom15 nopad col-xs-12 col-md-5 col-lg-5 pull-right"></div>
						</div></div>
						
						 
								
							</div>

						
						</div>
							
						<!--End of Flight + Hotel + Car -->
						
						<div id="adultdiv" class="col-xs-12 col-md-9 col-lg-9"> </div>
					</div>
					
				
					<div class="searchbg4">
					<div class="col-xs-4 pull-right pbottom15" style = "top:auto">
						<!--<form action="list4.html">!-->
							<button type="submit"   class="btn-search mt10">Search</button>
						<!--</form>!-->		
						
					</div> 
						<div class="clearfix"></div>
				</div>
						
				</div>
			</div>
			
		  </div>
	
</form>
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script>			
<script src="themes/hdfc/assets/assets/js/jquery.validate.js"></script>				
