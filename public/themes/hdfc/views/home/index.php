<script type="text/javascript" language="javascript">
	$(function() {
		/*
		$("#foo3 img").each(function() {
			this.title = this.alt;
		});
		*/
						
		$("#foo1").carouFredSel({
			auto: false,
			prev: '#prev2',
			next: '#next2',
			pagination: "#pager2",
			//mousewheel: true,
			swipe: {
			onMouse: true,
			onTouch: true
			}
		});
		
		$("#foo1 a").fancybox({
			cyclic	: true,
			onStart	: function() {
				$("#foo1").trigger("pause");
			},
			onClosed: function() {
				$("#foo1").trigger("play");
			}
		});
		

		$("#foo3").carouFredSel({
			auto: false,
			prev: '#prev3',
			next: '#next3',
			pagination: "#pager3",
			//mousewheel: true,
			swipe: {
			onMouse: true,
			onTouch: true
			}
		});

		$("#foo3 a").fancybox({
			cyclic	: true,
			onStart	: function() {
				$("#foo3").trigger("pause");
			},
			onClosed: function() {
				$("#foo3").trigger("play");
			}
		});
		
		$("#foo4").carouFredSel({
			auto: false,
			prev: '#prev4',
			next: '#next4',
			pagination: "#pager4",
			//mousewheel: true,
			swipe: {
			onMouse: true,
			onTouch: true
			}
		});

		$("#foo4 a").fancybox({
			cyclic	: true,
			onStart	: function() {
		        $("#foo4").trigger("pause");
			},
			onClosed: function() {
			$("#foo4").trigger("play");
			}
		});
		
		$(".bolly-alb-list a").fancybox({
			cyclic	: true,
			onStart	: function() {
			$(".bolly-alb-list").trigger("pause");
			},
			onClosed: function() {
			$(".bolly-alb-list").trigger("play");
			}
		});
	});	
	
</script>
<?php function json_helper($json){
$featured =array();
	foreach($json as $key => $falbums){

 	$featured[$key] = json_decode($falbums);

}  $featured = array_filter($featured); 
return $featured; 
} 

	$featured1 = json_helper($new_arrivals);
	$artist = json_helper($artist);
?>

<section class="table_div">
            	<section class="music-contentpad">
                    <div class="cat-alb">
						<div class="alb-cont">
							<div class="alb-wrap">
                    <?php echo Theme::widget('home', array('featured' => $featured1, 'brand'=>$brands))->render();  ?>
                    		</div>
						</div>
                    <?php echo Theme::widget('advertisement', array('featured' => $featured1))->render();  ?>
					</div>
					<?php echo Theme::widget('specials', array('artists' => $artist))->render();  ?>
<?php echo Theme::widget('friends', array('artists' => $artist))->render();  ?>

                </section>
        </section>
