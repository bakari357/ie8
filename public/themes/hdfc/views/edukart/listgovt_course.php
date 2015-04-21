<section class="row"><!--Content Starts here-->
<section class="content_pad">
            <section class="table_div pad27">	
<div class="row">
            <div class="tab_content_box_new"><!-- Tab content starts here-->
<form name="complaintdetails" method="post" id="complaintregisterpage" action="course_details" >
<div class="brandbx2" style="width: 150px;">
                  Select Course Group:    
       <select name="group_id" class="seloption" id="group_id" onChange="government_course();" style="margin-left:200px;width:329px;">
                             <option value="">Select</option>
                             <?php $ci=''; foreach($group as $cour) {
                                            if($cour==$ci)
						{
						continue;
						} ?>
		             <option value="<?php echo $cour['id']; ?>" <?php if(isset($_POST['Group']) && $_POST['Group']==$cour['Group']) echo 'selected' ; else if($cour==$cour['Group']) echo 'selected';?>><?php echo $cour['Group']; ?></option>

		<?php $ci=$cour['Group']; } ?>
		</select>
 <div class="hdg-pg" id="course" style="width: 250px;">  </div>

  
                                  <div style="margin-left:100px;margin-top:-4px;"> 
                                      <!--<td class="td_no_border"><a  href="#"><input type="submit"  style="margin-left:-100px;width:132px;" value="Submit"/></a></td> -->
                                      </div> 



    </form>
  </div>
                 </div>   </section>
                  </section></section>
                  

<script>
  function government_course()
              { 
           
               var count = $("select#group_id option:selected").attr('value'); 
                           $.ajax({
                      type: "POST",
                      url: "<?=URL::to('government_course')?>",
                      data: {
            "count": count
              },             
                        success: function(data1) {
                          $("#course").html(data1);
                                  
                      }
                  });
            
          }
</script>
<script>
        function submitform()
{

  $('#complaintregisterpage').submit();
  
}
</script>
             
 
