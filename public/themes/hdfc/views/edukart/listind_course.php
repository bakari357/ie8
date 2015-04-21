<section class="row"><!--Content Starts here-->
<section class="content_pad">
            <section class="table_div pad27">
    	<div class="row">
            <div class="tab_content_box_new"><!-- Tab content starts here-->
<form name="ind_course" method="post" id="ind_course" action="industry_course" >
<div class="brandbx2" style="width: 150px;">
                 Select Industry certified Course:
       <select name="course_id" class="seloption" id="course_id" onChange="submitform();" style="margin-left:200px;width:329px;">
                             <option value="">Select</option>
                             <?php $ci=''; foreach($courses as $cours) {
                                            if($cours==$ci)
						{
						continue;
						} ?>
		            <option value="<?php echo $cours['id']; ?>" <?php if(isset($_POST['ename']) && $_POST['ename']==$cours['ename']) echo 'selected' ; else if($cours==$cours['ename']) echo 'selected';?>><?php echo $cours['ename']; ?></option>

		<?php $ci=$cours['ename']; } ?>
		</select>

<div class="hdg-pg" id="course" style="width: 250px;">  </div>
</div> 
		    
                    </form>
</div></div></section></section></section>

<script>
        function submitform()
{

  $('#ind_course').submit();
  
}
</script>

