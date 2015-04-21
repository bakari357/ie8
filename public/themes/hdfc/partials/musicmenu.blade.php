<?php $music_menu=array(); ?>
	@foreach(Theme::get('menus') as $key => $menu)
                            
				<?php $music_menu[$key] = json_decode($menu); 
					
				?>
				
				@endforeach

<?php 
		$ban = $music_menu; 
	$music_menu = array_filter($music_menu);?>
		
   <section class="table_div">
            	<section id="smoothmenu2" class="musicmenu1">
                    <ul>
	
<?php 
			foreach($music_menu as $id => $music){
				
				$musics = (array)$music; ?>
		 <li><?php echo HTML::link("music_category/".$musics['cat_id'], $musics['cat_name']); ?> 

			<?php if(!empty($musics['subcategories'])) {?>
        	                <ul><div class="menu-active"></div>
        		                <?php foreach($musics['subcategories'] as $cats){ ?>
        	                <li><?php echo HTML::link("music_category/".$cats->subcat_id, $cats->subcat_name); ?></li>
                        <?php } echo '</ul> '; } ?>
					<?php } ?>
				</li> 
				</ul>
		</section>
     <section>
     	<?php if(isset($ban['ban'])){ ?>
	 <section class="banner_in"><img src="{{Theme::asset()->url('img/music.jpg')}}"></section> <?php } ?>

