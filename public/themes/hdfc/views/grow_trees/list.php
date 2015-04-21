 
<section class="row">
<section class="content_pad">
                    <section class="table_div" >
     <table>
         <?php echo '<pre>'; foreach($trees as $tree){ ?>
               <tr>
		<?php	$img = HTML::image('themes/hdfc/assets/img//nopicture.gif',"",array('border'=>'0'));
                         $title = '<span>'.$tree['name'].'</span>'; ?>
			<td><?php echo HTML::decode(HTML::link('grow_details/'.$tree['id'], $img.' </td><td>'.$title, array('rel' => 'fancybox'))); ?>			</td>
<?php }  ?>
</table>
                            </section>
                     </section>
                    </section>
      
    
