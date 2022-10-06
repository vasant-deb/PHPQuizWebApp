<?php /* foreach($categories_products as $product_item): ?>  			  
            <div class="col-md-4 product-box">
              <div class="product-item">
                <div class="pi-img-wrapper"> <img src="images/products/<?php echo $product_item['Product']['image'];?>" class="img-responsive" />
                  <div> <a href="<?php echo $product_item['Product']['slug'];?>.html" class="btn">Product Details</a></div>
                </div>
                <h3><a href="<?php echo $product_item['Product']['slug'];?>.html"><?php echo $product_item['Product']['name'];?></a></h3>
                <div class="pi-price">$<?php echo $product_item['Product']['price'];?></div>
                <a href="<?php echo $product_item['Product']['slug'];?>.html" class="btn add2cart">Quick buy</a>
                <div class="sticker sticker-new"></div>
              </div>
            </div>			
<?php endforeach; */ ?>  

  <div class="shop-left-side-area rp-style-2" id="productdata">
                    
                   
					<?php if($categories_products > 0) { ?>	
								<?php 
								foreach ($categories_products as $product_item):

								$frontImageurl = $this->Html->url('/images/products/'.$product_item['Product']['image']);
								 
								$ddthumbImageurl = "images/no-image.jpg";
								
								$product = $product_item;
								
								?>
                    <div class="product-inner cp-style-2 mt-30"> <a href="<?php echo $product['Product']['slug']; ?>.html">
                      <div class="product-img b-img">  <?php 
				if($product['Product']['image'] != '') {
				?>
				<img alt="" src="<?php echo $frontImageurl; ?>"> 
				<?php } else { ?>
				<img alt="" src="<?php echo $ddthumbImageurl; ?>">
				<?php } ?></div>
                      </a> <span class="product-tag text-uppercase black-bg">new</span>
                      <ul class="quick-veiw text-center">
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
						
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                      </ul>
                      <div class="product-text pt-10">
                        <ul class="pull-left list-inline ratings">
                          <li><i class="rated fa fa-star"></i></li>
                          <li><i class="rated fa fa-star"></i></li>
                          <li><i class="rated fa fa-star"></i></li>
                          <li><i class="rated fa fa-star"></i></li>
                          <li><i class="rated fa fa-star"></i></li>
                        </ul>
                        <ul class="pricing list-inline pull-right">
                          <li class="text-right c-price text-defualt">$<?php echo $product['Product']['discounted_price']; ?></li>
                          <li class="text-right p-price">$<?php echo $product['Product']['price']; ?></li>
                        </ul>
                        <div class="clear"></div>
                        <h6 class="product-name m-0"> <a title="Celletria ostma" href="<?php echo $product['Product']['slug']; ?>.html"><?php echo $product['Product']['name']; ?></a> </h6>
                      </div>
                    </div>
					<?php endforeach; } ?>
                    
                    
                    
                    
                   
                    
                    
                    
                   
                  </div>