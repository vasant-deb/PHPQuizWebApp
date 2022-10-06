 <div class="banner">
  <div class="inner-banner">
    <div class="note">News & Events</div>
    <div class="site-map"> You are here:<a href="<?php echo $this->webroot;?>">Home</a> &gt; News & Events </div>
    <div class="clear"></div>
  </div>
</div>
 

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-blog column9">
			
              <?php  	
        if(count($news_list) > 0) {        
        foreach ($news_list as $news):   

		$thumbImageurl = $this->Html->url('/img/upload_images/'.$news['News']['image']);
		$Imageurl = "http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image";

		$Imageurl = ($news['News']['image'] != '')?$thumbImageurl:$Imageurl;	
		
        ?>
      
             
			<div class="blog-box">
				<a href="news-events/<?php echo $news['News']['slug']; ?>"><img src="<?php echo $Imageurl;?>" height="200" alt="<?php echo $news['News']['name']; ?>"></a>
				<div class="blog-text">
					<h4><?php echo $news['News']['name']; ?></h4>
					<div class="border"></div>
					<div class="post-meta">					 
						<div class="post-date"><?php echo date('d M, Y', strtotime($news['News']['created']));?></div>
						<div class="clear"></div>
					</div>
					<div class="post-text"><?php echo $news['News']['short_description']; ?></div>
					<a href="news-events/<?php echo $news['News']['slug']; ?>">Read More</a>
				</div>
			</div>
            
            
            
            
            <?php 
		endforeach;
		}
		?>
            
            
			<div class="clear"></div>
		</div>
		<!-- Aside Blog -->
		<div class="side-blog column3">
			 

			<div class="widget-services">
				<h3>Our Facilities</h3>
				<!-- Accordion -->
				<div class="accordion">
					<div id="accordion-container"> 
					
					
					<?php  	
								
							if(count($facilities) > 0) {
							?>
							
							<?php	
							$homefacilities = 0;								
							foreach ($facilities as $facility): 
							$homefacilities++;
							if($homefacilities > 8) { break; }
							  
							?>
							 
					     <h2 class="accordion-header"><?php echo $facility['Facility']['name']; ?></h2> 
					     <div class="accordion-content"> 
					          <p><?php echo $facility['Facility']['short_description'];?></p> 
					     </div> 
					    <?php 
							endforeach;
							?>
							
							<?php
							}
							?> 
					</div>
				</div>
			</div>

			 
		</div>
		<div class="clear"></div>	
	</div>
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	 