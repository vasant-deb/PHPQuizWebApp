<div class="signle-heading">
  <div class="container">
    <div class="row">
      <!--start-shop-head -->
      <div class="col-lg-12">
        <div class="shop-head-menu">
          <ul>
            <li><i class="fa fa-home"></i><a class="shop-home" href="<?php echo $this->webroot;?>"><span>Home</span></a><span><i class="fa fa-angle-right"></i></span></li>
            <li class="shop-pro">PRODUCTS</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="shop-product-area">
  <div class="container">
    <div class="row"> <?php echo $this->element('fmf/categories/leftmenu'); ?>
      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
        <div class="shop-product-view">
          <?php echo $this->element('fmf/categories/search_bar'); ?>
          <div class="tab-content">
            <div id="shop-product" class="tab-pane active">
              <div class="row">
                <?php if($categories_products > 0) { ?>
                <?php 
				
				foreach ($categories_products as $product_item):
		       
			    $frontImageurl = $this->Html->url('/images/products/'.$product_item['Product']['image']);
		        $backImageurl  = $this->Html->url('/images/products/'.$product_item['Product']['back_image']);

				?>
                <div class="col-lg-4">
                  <div class="single-product shop-mar-bottom">
                    <div class="product-img-wrap">
                      <div id="f1_container">
                        <div id="f1_card" class="shadow">
                          <div class="front face"> <img src="<?php echo $frontImageurl;?>" class="img-responsive"> </div>
                          <div class="back face center"> <img src="<?php echo $backImageurl;?>" class="img-responsive"> </div>
                        </div>
                        <div class="add-to-cart"> <a  href="products/<?php echo $product_item['Category']['slug'];?>/<?php echo $product_item['Product']['slug'];?>" title="add to cart">
                          <div><i class="fa fa-shopping-cart"></i><span>Add to cart</span></div>
                          </a> </div>
                      </div>
                    </div>
                    <div class="product-info text-center">
                      <div class="product-content"> <a  href="products/<?php echo $product_item['Category']['slug'];?>/<?php echo $product_item['Product']['slug'];?>">
                        <h3 class="pro-name"><?php echo $product_item['Product']['name'];?></h3>
                        </a>
                        <div class="pro-price">
						<?php if($product_item['Product']['model_no']) { ?>
						<span class="price-text">Model No:</span> <span class="normal-price"><?php echo $product_item['Product']['model_no'];?></span>
						<?php } ?>
						</div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>