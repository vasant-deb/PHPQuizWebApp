<?php ?>



<div class="container-fluid pb-0">
   
   
   <div class="video-block section-padding">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title">
                          
                            <h6><?php echo $category['Category']['name']; ?> Categories</h6>
                        </div>
                     </div>
                      	<?php if($category > 0) { ?>	
					<?php 
				
				foreach ($category['ChildCategory'] as $product_item):
		       
			    $frontImageurl = $this->Html->url('/images/categories/'.$product_item['image']);
		       
                 $ddthumbImageurl = "images/no-image.jpg";
				?> 
                     <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="video-card">
                           <div class="video-card-image">
                              
                              <a href="category/<?php echo $category['Category']['slug']; ?>/<?php echo $product_item['slug']; ?>.html">
                                   <?php 
				if($product_item['image'] != '') {
				?>
                <img alt=""  class="img-fluid" src="<?php echo $frontImageurl; ?>">
				<?php } else { ?>
				 <img alt=""  class="img-fluid" src="<?php echo $ddthumbImageurl; ?>">
				<?php } ?>
                                  
                                  
                              </a>
                              <div class="time">1</div>
                           </div>
                           <div class="video-card-body">
                              <div class="video-title">
                                 <a href="category/<?php echo $category['Category']['slug']; ?>/<?php echo $product_item['slug']; ?>.html"><?php echo $product_item['name']; ?></a>
                              </div>
                              
                           </div>
                        </div>
                     </div>
        <?php endforeach; }?>
            
                  </div>
               </div>  
      
   
   
   
              <div class="video-block section-padding">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title">
                        
                           <h6><?php echo $category['Category']['name']; ?></h6>
                        </div>
                     </div>
                     
                     <?php foreach($blogs as $blog): ?>
                     <div class="col-xl-4 col-sm-6 mb-3">
                        <div class="channels-card">
                           <div class="channels-card-image">
                              <a href="tutorials/<?php echo $blog['Blog']['slug']; ?>"><img class="img-fluid" src="images/blogs/<?php echo $blog['Blog']['image'] ; ?>" title="<?php echo $blog['Blog']['name']; ?>" alt="<?php echo $blog['Blog']['name']; ?>"></a>
                              
                           </div>
                           <div class="channels-card-body">
                              <div class="channels-title">
                                 <a href="tutorials/<?php echo $blog['Blog']['slug']; ?>"><?php echo $blog['Blog']['name']; ?></a>
                                 
                                 <p style="text-align:left;"><?php echo substr($blog['Blog']['short_description'],0,150); ?>....</p>
                              </div>
                              <a href="tutorials/<?php echo $blog['Blog']['slug']; ?>">
                              <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Read More</button></div></a>
                           </div>
                        </div>
                     </div>
                     <?php endforeach;?>
                     
                     </div>
                  </div>  
      
                                  
      
                  
     

                  
            </div>











