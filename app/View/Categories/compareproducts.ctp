  <!--end-single-heading-banner-->
  <!--start-single-heading-->
  <div class="signle-heading">
    <div class="container">
      <div class="row">
        <!--start-shop-head -->
        <div class="col-lg-12">
          <div class="shop-head-menu">
            <ul>
              <li><i class="fa fa-home"></i><a class="shop-home" href="<?php echo $this->webroot;?>"><span>Home</span></a><span><i class="fa fa-angle-right"></i></span></li>
              <li class="shop-pro">Product Comparison</li>
            </ul>
          </div>
        </div>
        <!--end-shop-head-->
      </div>
    </div>
  </div>
  <!--end-single-heading-->
  <!--start-shop-product-area-->
  <div class="shop-product-area">
    <div class="container">
      <div class="row">
   
   		  <?php echo $this->element('fmf/categories/leftmenu'); ?>	

		   
			
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
          <!-- Shop-Product-View-start -->
          <div class="shop-product-view">
            <!-- Shop Product Tab Area -->

              <!-- End-Tab-Bar -->
			  
			<div class="tab-content">
              <!-- Shop Product-->
              <div id="shop-product" class="tab-pane active">
                <div class="row">
                  <!-- Start-single-product -->
                  <!--  second product -->
				 	
					
				<?php if($compare_products > 0) { ?>	
				<?php 
				
				foreach ($compare_products as $product_item):
		       
			    $frontImageurl = $this->Html->url('/images/products/'.$product_item['Product']['image']);
		        $backImageurl  = $this->Html->url('/images/products/'.$product_item['Product']['back_image']);

				$availability = "";
				$product_stock  = $product_item['Product']['product_stock'];

				if($product_stock == 0) { $availability = "Out of Stock"; }
				else { $availability = "In Stock"; }
   
				?> 
					
					<div class="col-lg-4">
                    <div class="single-product shop-mar-bottom">
                     
                      <div class="product-img-wrap"> 
                         <div id="f1_container">
                          <div id="f1_card" class="shadow">
                            <div class="front face"> <img src="<?php echo $frontImageurl;?>">  </div>
                            <div class="back face center"> <img src="<?php echo $backImageurl;?>"> </div>
                          </div>
                          
                        </div>                        
                      </div>
                      <div class="product-info text-center">
                          <div class="product-content"> <a href="products/<?php echo $product_item['Category']['slug'];?>/<?php echo $product_item['Product']['slug'];?>">
                            <h3 class="pro-name"><?php echo $product_item['Product']['name'];?></h3>
                            </a>
                            <div class="pro-price"> <span class="price-text">Model No:</span> <span class="normal-price"><?php echo $product_item['Product']['model_no'];?></span></div>
							 
							  <div class="pro-price"> <span class="price-text">Availability:</span> <span class="normal-price"><?php echo $availability;?></span></div>
							  
							  <a href="compare/compareremove/<?php echo $product_item['Product']['id'];?>">
		  <span class="compare-icon"><i class="fa fa-trash"></i> Remove</span>
		  </a>
		<div class="add-to-cartx"> <a  href="products/<?php echo $product_item['Category']['slug'];?>/<?php echo $product_item['Product']['slug'];?>" title="add to cart">
                            <div><i class="fa fa-shopping-cart"></i><span> Add to cart</span></div>
                            </a> </div> 
		  
                          </div>
                        </div>                      
                    </div>                     
                    
                  </div>
				          
				 
				<?php endforeach; ?>
				<?php } else { ?>  
				<br>
						<h2>You have not chosen any products to compare.</h2>
				<?php } ?> 
                </div>
                <!-- End-Shop-Product-->
              </div>
              <!-- End Tab Content -->
              
              <!-- End Shop Product Tab Area -->
            </div>
			
			   <!-- End Shop Product View -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--shop-product-area-end-->