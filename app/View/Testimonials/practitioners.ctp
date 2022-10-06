 <div class="banner">
  <div class="inner-banner">
    <div class="note">Testimonials</div>
    <div class="site-map"> You are here:<a href="<?php echo $this->webroot;?>">Home</a> &gt; 	Feedback from Medical Practitioners  </div>
    <div class="clear"></div>
  </div>
</div>
 

	<!-- Container -->
	<div class="wrapper dark">

	
	<div class="main-testimonials column9">
			
			<h3>	Feedback from Medical Practitioners </h3>
   <?php  	
        if(count($testimonials) > 0) {        
        foreach ($testimonials as $testimonial):   

		$thumbImageurl = $this->Html->url('/img/upload_images/'.$testimonial['Testimonial']['image']);
		$Imageurl = "http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image";

		$Imageurl = ($testimonial['Testimonial']['image'] != '')?$thumbImageurl:$Imageurl;	
		
        ?>
			<p class="testimonial"><?php echo $testimonial['Testimonial']['short_description'];?></p>

			<p class="user"><?php echo $testimonial['Testimonial']['name'];?></p>
 

            <?php 
		endforeach;
		}
		?>
		<!--
		<div class="pagenation clearfix">
			<ul>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#">50</a></li>
			</ul>
		</div>
		-->

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
	 