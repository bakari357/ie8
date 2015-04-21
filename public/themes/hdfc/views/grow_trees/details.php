 
<section class="row">
<section class="content_pad">
                    <section class="table_div" >
     <table>
         <?php foreach($details as $tree){ ?>
<tr> 
				<td>Image: </td>
                                <td><?php	$img = HTML::image('themes/hdfc/assets/img//nopicture.gif',"",array('border'=>'0')); echo $img; ?></td>
			</tr>               
<tr>
		<?php	$img = HTML::image('themes/hdfc/assets/img//nopicture.gif',"",array('border'=>'0'));
                         $title = '<span>'.$tree['name'].'</span>'; ?>
			<td>	Name: 	</td>
<td>	<?php echo $title; ?>	</td></tr>
                            <tr>
                               <td>Description: </td>
                                <td><?php echo $tree['description']; ?></td>
			</tr>
<tr> 
				<td>slug: </td>
                                <td><?php echo $tree['slug']; ?></td>
			</tr>
<tr>
				<td>price: </td>
                                <td>Rs <?php echo $tree['price']; ?> </td>
			</tr>

<?php }  ?>
</table>
                            </section>
                     </section>
                    </section>
      
    
