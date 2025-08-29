<div class="row col-md-3 bottom-200">
		<div class="latest_board_news">
			<div class="inner-news">	
			<h1><div class="board_title"> Online Notice Board</div></h1>
			<div class="list-wrpaaer" style="position: relative; overflow: hidden;">
				<ul class="demo2">
					<?php if( isset($events) && !empty($events) && count($events)>0): 
						foreach($events as $event):
					?>
					<li class="news-item">
					    <?php 
					   $url = ((isset($event->url) && !empty($event->url)) ? $event->url : '');
								if( !empty($url)){
									echo '<a href="'.$url.'" target="_blank">'.$event->title.'</a>';
								}else{
									echo $event->title; 
								}
					    ?></li>
					<?php endforeach; endif; ?>
					<!--<li class="news-item">Our 172 Children have appeared for IAIS.</li>
					<li class="news-item">Our Students Participated in Kamarajar - Kalvi Valarchi Nal competitions 2018.</li>
					<li class="news-item">Our Students achieved many prices in Koviloor Inter School Competitions.</li>
					<li class="news-item">Our Student won Tamilnadu State Sub - Junior & Senior Silambam.</li>
					<li class="news-item">Our Alagappa Academy student won district level CM Trophy.</li>-->

				</ul>
				</div>
			</div>
		</div>
		
		
		<div class="campus-infra-right">	
			<h1><div class="board_title"> Our Campus Infra</div></h1>
			<!--<iframe src="<?php echo trim($video->content); ?>" width="100%" height="255px" allowfullscreen frameborder="0"></iframe> -->
			
				<iframe width="100%" height="255px" src="https://www.youtube.com/embed/Nn9MP8_ZmKI" title="Teachers' Day Celebration " frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
	
	
</div>