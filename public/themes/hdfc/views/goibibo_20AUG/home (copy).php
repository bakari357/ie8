 <style>
.search {
background: none repeat scroll 0 0 #E10210;
float: right;
font-family: 'HelveticaNeueRegular',Arial,Helvetica,sans-serif;
font-size: 14px;
height: 30px;
line-height: 30px;
margin-top: 0px;
font-size: larger;
text-align: center;
color: rgb(240, 235, 234);
border: 0pt ridge;
text-decoration: none;
text-transform: none;
width: 100%;
font-weight: bold;
margin-right: 5px;
}
.pass-select {height:32px;}
.pass-select select { margin-top: 2px;}	
</style>
<style>
.ui-front {
display: block;
top: 364px;
left: 128.5px;
width: 155px;
border: 1px solid #aaa;
overflow: hidden;
border-top: none;
box-shadow: 0px 3px 5px rgba(0,0,0,0.2);
margin-top: 6px;
}

</style>
<script type="text/javascript" >
$(document).ready(function() {
$("#leavingfrom").focus();

});
    </script>
    <div id="closeit">
<form name="complaintdetails" method="post" id="complaintregisterpage">
 <section class="banner_flight_oneway"><!--Content Starts here-->
     
  <input type="hidden" name="leavingfrom"  id="leavingfrom1" onClick="Clear();"  value="<?php if(isset($_POST['leavingfrom'])) echo $_POST['leavingfrom'] ; ?>"  />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="goingto"  id="goingto1" onClick="Clear();"   value="<?php if(isset($_POST['goingto'])) echo $_POST['goingto'];?>" />
    
     
        <input type="hidden" name="city_type"  value="cities_suggestions" />
      
      <input type="hidden" name="plantype" value="DomFlight"  />
      
    	<div class="row">
            <div class="tab_content_box_new"><!-- Tab content starts here-->
                <ul id="countrytabs" class="shadetabs_new">
                    <li class="tab"><a>Flights</a></li>
                    
                </ul>
                <div class="clear"></div>
                <div class="tab_content_center_new">
                    
                        <div class="tabcontent_box">	
                         	<section class="box_row">
                                <section class="box_col"><input type="radio" name="flight"  value="O"  onclick="return yousendit();" checked/> <span>Domestic Flights</span></section>
                                <section class="box_col"><input type="radio" name="flight" id="flight" value="1"  onclick="return yousendit();"/> <span>International Flights</span></section>
                            </section>
                            <section class="bdr_box">&nbsp;</section>
                            <section class="box_row">
                                <section class="box_col"> <input type="radio" name="type"   <?php if(isset($_POST['type']) && $_POST['type']=='O') echo 'checked'; else echo 'checked'; ?>  value="O"  onclick="changetype()"/><span>One-way</span></section>
                            <section class="box_col"><input type="radio" name="type" <?php if(isset($_POST['type']) && $_POST['type']=='R') echo 'checked';  ?>  value="R" onclick="changetype()"  /> <span> Round trip</span></section>
                        </section>
                            
                            <section class="box_row">
                             	<section class="box_col">
                                   From<br>
                                    <section class="dfrom_pad_box">
                                             <input type="text"   class="flight_txt" name="leavingfrom1"  id="leavingfrom"  value="<?php if(isset($_POST['leavingfrom1'])) echo $_POST['leavingfrom1'] ; ?>"/>
                                            
                                        </section>
                  
                                </section>
                                <section class="box_col">
                                   To<br>
                                    <section class="dfrom_pad_box">
                                            <input type="text"  class="flight_txt" name="goingto1"  id="goingto"  value="<?php if(isset($_POST['goingto1'])) echo $_POST['goingto1'] ; ?>"/>
                                        </section>
 
                                </section>   
                            </section>  
                            <section class="box_row">
                            	<section class="box_col">
                                    <section class="date_sec">
                                        Depart<br>
                                        <?php $tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y")); ?>
                                        <section class="date_pad_box">
                                            <input type="text" class="date_txt" name="departure" value="<?php if(isset($_POST['departure'])) echo $_POST['departure'] ; else if(isset($departure)) echo $departure; else echo date('d-m-Y',$tomorrow); ?>" readonly autocomplete="off" id="departure"  />
                                        </section>
                                    </section>
                                </section>
                                <section class="box_col">
                                    <section class="date_sec pad1" style="margin-left: -6px;">
                                        Return<br>
                                        <?php $dtomorrow = mktime(0, 0, 0, date("m"), date("d")+2, date("y")); ?>
                                        <section class="date_pad_box">
                                            <input type="text" class="date_txt" name="return" style="margin-top:0px;" value="<?php if(isset($_POST['return'])) echo $_POST['return'] ; else if(isset($_POST['departure'])) echo $_POST['departure']; else if(isset($return)) echo $return; else echo date('d-m-Y',$dtomorrow); ?>" readonly autocomplete="off" id="return"   />
                                        </section>
                                    </section>
                                </section>   
                            </section>
                            <section class="box_row">
                            	<section class="box_col3" style="width: 105px; font-size: 11px;">
                                    Adults (12+ yrs)<br>
                                    <div class="brandbx">
                                    	<select name="adults" id="adults" class="seloption" >
<option value="1" selected="selected">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
</select>                    
                                    </div>
                                </section>
                                <section class="box_col3" style="width: 103px; font-size: 11px;">
                                    Children (2-11 yrs)<br>
                                    <div class="brandbx">
                                    	
                                    	<select name="children" id="children" class="seloption" >
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
</select>                                    
                                    </div>
                                </section>
                                <section class="box_col3" style="font-size: 11px;">
                                    Infants (0-2 yrs)<br>
                                    <div class="brandbx" style="margin-left: 3px;">
                                    	<select name="infants" id="infants" class="seloption" >
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>                                
                                    </div>
                                </section>   
                            </section>     


			<div class="discount_search"><input type="checkbox" name="discouted" ><label class="discount_label">Discounted Fare</label></div>                                
                            <section class="box_row">
                                <section class="box_col">
                                    <section class="date_sec">
                            Class<br>
                            <div class="brandbx" >
                                
                              
                            
                                 <select id="cabinClass" class ="seloption" name="class">
		    <option value="A" <?php if($class=='A') echo 'selected'; ?>>All </option>
		    <option value="E" <?php if($class=='E') echo 'selected'; ?> >Economy</option>
	           <option value="B" <?php if($class=='B') echo 'selected'; ?>>Business </option>	
					</select>
                                  
                                
                                </div>
                            </section>
                                </section>
                                <section class="button_pad">
  <input type="submit" name="go" class="search" value="Search Flights" onclick="compare()"   style="margin-top:5px !important;float:right; cursor: pointer;"/>
                      
                            </section>
                            </section>
                    	</div>
                    </div>
                    </section>
                    </div>
                    <div id="showit">
                    <section class="search_div min_height">
               <section class="retrive_password">
                    <h3>Searching for available Flights</h3>
                    <div class="retrive_password_content">
                    <img style="padding-right: 57px; font-weight: bold;" src=""> </div>
                 </section>
</form>
             </section>
                        </div>
                        <script>
function yousendit(){
    if(document.getElementById('flight').checked){
        window.location='airline_int';
        return false;
    }
    return true;

}

</script>
                    
    <script type="text/javascript">
   // var countries=new ddtabcontent("countrytabs")
   // countries.setpersist(true)
  //  countries.setselectedClassTarget("link") //"link" or "linkparent"
   // countries.init()
</script>
<script>
	$(function() {
	
		 $( "#departure" ).datepicker({
		
			dateFormat : 'dd-mm-yy',
			changeMonth : true,
			changeYear : true, 
			minDate: '+1d',
			numberOfMonths: 2, 
			showButtonPanel: true,
			onSelect: function( selectedDate ) {
				var minDate = $(this).datepicker('getDate');
				if (minDate) {
				minDate.setDate(minDate.getDate() );
				}
				$( "#return" ).datepicker( "option",{ minDate:minDate}, selectedDate );

			}

		});
		
		$( "#return" ).datepicker({
		dateFormat : 'dd-mm-yy',
		changeMonth : true,
		changeYear : true, 
		minDate: '+1d',
		numberOfMonths: 2, 
		showButtonPanel: true,
		onSelect: function( selectedDate ) { //alert($('#startPicker').val());
			var minDate = $(this).datepicker('getDate');
			if (minDate) {
			minDate.setDate(minDate.getDate());
			}
			$( "#departure" ).datepicker( "option",{ maxDate:minDate}, selectedDate );
		}
		});
	 var v=$('[name="type"]:checked').val();
	
	 if(v=='R')
	 $("#return").removeAttr('disabled');
	 else
	   $("#return").attr('disabled','true');
	   
	   if(v=='R'){
	 $("#rbox").show();
	  $(".pad1").show();
	  }
	 else{
	   $("#rbox").hide();
	   $(".pad1").hide();
	   }
	   
	});
	
	function changetype()
	{
	 
	 var v=$('[name="type"]:checked').val();
	 if(v=='R'){
	 $("#return").removeAttr('disabled');
	  $("#rbox").show();
	   $("#discount").removeAttr('disabled');
	   $("#dbox").show();
	   $(".pad1").show();
	 }
	 else{
	   $("#return").attr('disabled','true');
	    $("#rbox").hide();
	       $("#discount").attr('disabled','true');
	          $("#dbox").hide();
	          $(".pad1").hide();
	   }
	   
	}
</script>


 <script type="text/javascript">
(function($){
 $("img").lazyload({
     effect       : "fadeIn"
 });
})(jQuery);
</script>





<script type="text/javascript">
var fly='cities_suggestions';

$(document).ready(function() {



$(function() {	
		$("#leavingfrom").autocomplete({
		
			  source: "flightcityautocomplete",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#leavingfrom1').val(ui.item.id);
                      
                    }
		});
		
		//Going to suggesstion
		
		$("#goingto").autocomplete({
				  source: "flightcityautocomplete",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#goingto1').val(ui.item.id);
                      
                    }
		});
		

	});

});


function submitform()
{
  
$('#complaintregisterpage').submit();
}
</script>
<script>
function showImg()
 {
       
 if(document.getElementById) { 
 $("#closeit").hide(); 
$("#showit").show();
 return document.getElementById("flight-im").style.visibility = "hidden";
 }
 document.onstop = function() {
 (document.getElementById("progress_img")).style.visibility = "hidden";
}
}
</script>


