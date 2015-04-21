
<section class="row"><!--Content Starts here-->
    	<section class="content_pad">
            <section class="table_div pad27">

 <div class="retrive_password_content" style="float: right;margin-right: 54px;margin-top: -31px;">
   <!-- <img style="float: left;" src="<?php echo Theme::asset()->url('img/album-img-2.jpg'); ?>">-->
<h2><font color="blue">Industry Certified Course</font></h2>
             <?php foreach($coursename as $name) { 
                echo $name['ename'];
		} ?>
</div>

<div  style="float: right;margin-right: 57px;margin-top: -17px;">
Quantity :<select name="qunt" id="qunt" onchange="total_fee();" >
                  <option value="1">1</option>
                   <option value="2">2</option>
                   <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
          </select> 
<div id="total" style="margin-right: 57px;margin-top: 8px;">Total Fee: Rs. <?php echo $fee; ?></div>
</div> 

     <?php foreach($ind_details as $details){   ?>
         <h4>Brief</h4>
        <div><p><?php echo $details['Brief']; ?></p>
              </div>
     <h4>About The Course</h4>
        <div><p><?php echo $details['About_the_Course']; ?></p>
              </div>

<h4>Features</h4>
        <div><p><?php echo $details['Features']; ?></p>
              </div>
<h4>Benefits</h4>
        <div><p><?php echo $details['Benefits']; ?></p>
              </div>
<h4>Structure</h4>
        <div><p><?php echo $details['Structure']; ?></p>
              </div>
<h4>Examination</h4>
        <div><p><?php echo $details['Examination']; ?></p>
              </div>
<h4>Career Graph</h4>
        <div><p><?php echo $details['Career_Graph']; ?></p>
              </div>
<h4>Fee</h4>
        <div><p><?php echo $details['Fee']; ?></p>
              </div>

 <?php } ?>
</section>
</section>
</section>
<script>
function total_fee()
{
var total=<?php echo $fee; ?>;
var qunt=$("select#qunt option:selected").attr('value'); 

var totalfee=total * qunt;

document.getElementById('total').innerHTML ='Total Fee :'+ totalfee;
}


</script>
