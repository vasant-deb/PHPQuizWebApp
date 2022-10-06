<?php ?>

<div class="container-fluid pb-0">
                  <div class="video-block section-padding">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title">
                        
                           <h6><?php echo $category['Category']['name']; ?></h6>
                        </div>
                     </div>
                     
                   <?php if($categories_products > 0) { ?>	
								<?php 
								foreach ($categories_products as $product_item):

								$frontImageurl = $this->Html->url('/images/blogs/'.$product_item['Blog']['image']);
								 
								$ddthumbImageurl = "images/no-image.jpg";
								
								$product = $product_item;
								
								?>
                     <div class="col-xl-4 col-sm-6 mb-3">
                        <div class="channels-card">
                           <div class="channels-card-image">
                              <a href="tutorials/<?php echo $product['Blog']['slug']; ?>">
                                  
                                  <?php 
				if($product['Blog']['image'] != '') {
				?>
				<img alt="" title="" class="img-fluid" src="<?php echo $frontImageurl; ?>"> 
				<?php } else { ?>
				<img alt=""  title="" class="img-fluid" src="<?php echo $ddthumbImageurl; ?>">
				<?php } ?></a>
                              
                           </div>
                           <div class="channels-card-body">
                              <div class="channels-title">
                                 <a href="tutorials/<?php echo $product['Blog']['slug']; ?>"><?php echo $product['Blog']['name']; ?></a>
                                 
                                 <p style="text-align:left;"><?php echo substr($product['Blog']['short_description'],0,150); ?>....</p>
                              </div>
                              <a href="tutorials/<?php echo $product['Blog']['slug']; ?>.html">
                              <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Read More</button></div></a>
                           </div>
                        </div>
                     </div>
                    	<?php endforeach; } ?>
                     
                     </div>
                  </div>   
 </div>


