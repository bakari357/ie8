<section class="row"><!--Content Starts here-->
    	<section class="content_pad">
            <section class="table_div pad27">

<div >
<h1><font color="blue">Online Courses:</font></h1>
		<select name="course" id="course" onchange="submit();">
		<option value="sel">Select</option>
		<option value="govt">Government Certified</option>
		<option value="ind">Industry certified</option>
		</select>
</div></section></section></section>


<script>

function submit()
{ 
var qunt=$("select#course option:selected").attr('value'); 
if(qunt=='sel') {
window.location.href = "online_course";
}
else if(qunt=='govt')  {
window.location.href = "government"; }
else { 
window.location.href = "industry";
}
}
</script>





