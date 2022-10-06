<!-- Container -->
           <div class="banner">
  <div class="inner-banner">
    <div class="note">Testimonials</div>
    <div class="site-map"> You are here:<a href="<?php echo $this->webroot;?>">Home</a> &gt; Testimonials </div>
    <div class="clear"></div>
  </div>
</div>
	
    
    <!-- 2 cols -->
    <div class="col-md-12 about-new product">
    	<div class="container">
        	<div class="row">
            	<div id="ourHolder" class="carousel">
              
      <div class="col-md-9">
	<!-- testimonials -->
    <div class="quote">
    	<img src="medical/images/block-quote.png" class="img-responsive">
    </div>
	
	<div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
				  <!-- Carousel indicators -->
                  <ol class="carousel-indicators">
				  			   <?php  	
        if(count($testimonials) > 0) {       
$bn = 0;		
        foreach ($testimonials as $testimonial):   
$bn++;
		$thumbImageurl = $this->Html->url('/img/upload_images/'.$testimonial['Testimonial']['image']);
		$Imageurl = "http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image";

		$Imageurl = ($testimonial['Testimonial']['image'] != '')?$thumbImageurl:$Imageurl;	
		
		$active_banner = "";
		if($bn == 1) {
		$active_banner = "active";
		}

        ?>
		<li data-target="#fade-quote-carousel" data-slide-to="<?php echo ($bn-1);?>" class="<?php echo $active_banner;?>"></li>
		<?php 
		endforeach;
		}
		?>      
				  </ol>
				  <!-- Carousel items -->
				  <div class="carousel-inner">
				   		    
				   <?php  	
        if(count($testimonials) > 0) {     
	 	$bn = 0;
        foreach ($testimonials as $testimonial):   
	    $bn++;
		$thumbImageurl = $this->Html->url('/img/upload_images/'.$testimonial['Testimonial']['image']);
		$Imageurl = "http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image";

		$Imageurl = ($testimonial['Testimonial']['image'] != '')?$thumbImageurl:$Imageurl;	
		
		$active_banner = "";
		if($bn == 1) {
		$active_banner = "active";
		}

        ?> 
				    <div class="<?php echo $active_banner;?> item">
                        <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
				    	<blockquote>
				    		<p>
						<h2><?php echo $testimonial['Testimonial']['name'];?> </h2>
						<?php echo $testimonial['Testimonial']['short_description'];?></p>
				    	</blockquote>
						  </div>
				    <?php 
		endforeach;
		}
		?>    	    </div>
                    
				  </div>
	<!-- testimonials -->				
		</div>
		
				 
            
            

      
     <div class="col-md-3">
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
      
      
      
            
            
            
          </div>
            </div>
        </div>
    </div>
    <!-- 2 cols -->
	 