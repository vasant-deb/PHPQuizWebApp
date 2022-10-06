 <?php ?>
 <?php echo $this->Html->script(['cart.js'], ['inline' => false]); ?>
<?php if($this->Session->read('Shop')) : ?>

 <!-- Start Minicart -->
                                <div class="mini-cart">
                                    <div id="minicart-trigger" class="minicart-trigger mini-cart-button" data-count="3">
                                        <button><i class="fas fa-shopping-bag"></i></button>
                                    </div>
                                    <div class="shopping-cart cart-box">
                                        <div class="shop-inner">
                                            <div class="header">
                                                <ul class="product-list">
 <?php $tabindex = 1; ?>
                           <?php foreach ($shop['OrderItem'] as $key => $item): ?>
                           <?php
                              $frontImageurl  = $this->Html->url('/images/products/'.$item['Product']['image']);
                                
                              $mods = 0;
                              if(isset($item['Product']['productmod_name'])) :
                              $mods = $item['Product']['productmod_id'];
                              
                             // $productmod_image = $item['Product']['productmod_image'];
                             // $frontImageurl  = $this->Html->url('/images/products/'.$productmod_image);
                              
                              ?>
                           <?php endif; ?>
                                                    <!-- Start Single Product -->
                                                    <li>
                                                        <div class="thumb">
                                                            <a href="<?php echo $item['Product']['slug'];?>.html">
                                                                <img src="<?=$frontImageurl;?>" alt="Multipurpose template">
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <div class="inner">
                                                                <h4><a href="<?php echo $item['Product']['slug'];?>.html"><?php echo $item['Product']['name'];?></a></h4>
                                                                <div class="quatity">
                                                                    <span>1 ×</span>
                                                                    <span><?php echo $item['Product']['discounted_price'];?></span>
                                                                </div>
                                                            </div>
                                                            <button class="delete-btn"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </li>
<?php endforeach; ?>
                                                    <!-- Start Single Product -->
                                                    <li>
                                                        <div class="thumb">
                                                            <a href="single-product.html">
                                                                <img src="asterisk/img/product/sm-image/sm-cat1-02.jpg" alt="Multipurpose template">
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <div class="inner">
                                                                <h4><a href="single-product.html">Crystal Glass Globe
                                                                        Desk Lamp</a></h4>
                                                                <div class="quatity">
                                                                    <span>1 ×</span>
                                                                    <span>39.00</span>
                                                                </div>
                                                            </div>
                                                            <button class="delete-btn"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </li>

                                                    <!-- Start Single Product -->
                                                    <li>
                                                        <div class="thumb">
                                                            <a href="single-product.html">
                                                                <img src="asterisk/img/product/sm-image/sm-cat1-03.jpg" alt="Multipurpose template">
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <div class="inner">
                                                                <h4><a href="single-product.html">Gold Plated Desk
                                                                        Lantern Lamp</a></h4>
                                                                <div class="quatity">
                                                                    <span>1 ×</span>
                                                                    <span>39.00</span>
                                                                </div>
                                                            </div>
                                                            <button class="delete-btn brook-transition"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </li>
                                                </ul>
												
                                            </div>
                                            <div class="footer">
                                                <div class="total">Total: <span><?php echo $shop['Order']['total']; ?></span></div>
                                                <a class="cart-btn brook-transition" href="<?php echo $this->webroot;?>shop/cart">Check out</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Minicart -->
			
			
			
			
				<?php endif; ?>
			
			
			
			
			
			
			
						
								