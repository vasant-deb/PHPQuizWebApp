
 <?php /*  
if(count($homeproduct1) > 0) { 
?>
 <div class="featured-product-area section-padding" id="feature">
      <div class="container">
        <div class="row rp-style">
          <div class="col-md-12">
            <div class="section-title text-center mb-35">
              <h2 class="text-uppercase"><strong>FEATURED PRODUCTS</strong></h2>
			  <div class="col-md-12 text-right">
			<a href="featured-products.html" class="product-name view">View all</a>
			</div>
              <p class="text-defualt">Best Collection for you</p>
              <img alt="" src="unknown/images/section-border.png"> </div>
          </div>
        </div>
        <div class="row rp-style">
          <div class="featured-carousel indicator-style">
         
            
			<?php foreach($homeproduct1 as $product): 
			 $frontImageurl = $this->Html->url('/images/products/'.$product['Product']['image']);
$backImageurl  = $this->Html->url('/images/products/'.$product['Product']['back_image']);
                 $ddthumbImageurl = "images/no-image.jpg";
			?>
            <div class="product-container cp-style-2">
              <div class="product-inner"> <a href="<?php echo $product['Product']['slug']; ?>.html">
                <div class="product-img b-img"> 
				 <?php 
				if($product['Product']['image'] != '') {
				?>
				<img alt="" src="<?php echo $frontImageurl; ?>"> 
				<?php } else { ?>
				<img alt="" src="<?php echo $ddthumbImageurl; ?>">
				<?php } ?>
				</div>
				
                </a>
 <?php 
				if($product['Product']['product_alt'] != '') {
				?>				<span class="product-tag text-uppercase theme-bg"><?php echo $product['Product']['product_alt']; ?></span>
				<?php } ?>
                
                <div class="product-text pt-15">                 
                  <ul class="pricing list-inline text-center">            
					<p class="prdo">
					 <a href="<?php echo $product['Product']['slug']; ?>.html">
					<?php echo $product['Product']['name']; ?>
					</a>
					</p>
					<p class="product-desc"><?php echo $product['Product']['tagline']; ?></p>
					<p class="price-sec">
					<?php if($product['Product']['discounted_price'] > 0) { ?>
					
						
					<i class="fa fa-rupee"></i><?php echo $product['Product']['discounted_price']; ?> 
					<span>
					<i class="fa fa-rupee"></i>  <?php echo $product['Product']['price']; ?>
					</span> 
					<span class="off">(55% off)</span>
					 <?php } else { ?>
					 <i class="fa fa-rupee"></i><?php echo $product['Product']['price']; ?> 
					 <?php } ?>
					</p>				 
                  </ul>
                  <div class="clear"></div>               
                </div>
				
			
              </div>
            </div>
			<?php endforeach; ?>
           	
			
			
			
            
            
           
          </div>
        </div>
		
		
			
            
      </div>
    </div>
	
<?php } */ ?>




<div class="featured-product-area section-padding">
      <div class="container">
        <div class="row rp-style">
          <div class="col-md-12">
            <div class="section-title text-center mb-35">
              <h2 class="text-uppercase"><strong>FEATURED PRODUCTS</strong></h2>
              <p class="text-defualt">Best Collection for you</p>
              <img alt="" src="images/section-border.png"> </div>
          </div>
        </div>
        <div class="row rp-style">
          <div class="featured-carousel2 indicator-style">
            
			<?php foreach($homeproduct1 as $product): 
			 $frontImageurl = $this->Html->url('/images/products/'.$product['Product']['image']);
$backImageurl  = $this->Html->url('/images/products/'.$product['Product']['back_image']);
                 $ddthumbImageurl = "images/no-image.jpg";
			?>
            <div class="product-container cp-style-2 text-center">
			 <?php 
				if($product['Product']['image'] != '') {
				?>
              <img src="<?php echo $frontImageurl; ?>" class="img-responsive" />
				<?php } else { ?>	
<img src="<?php echo $ddthumbImageurl; ?>" class="img-responsive" />
				<?php } ?>				<a href="<?php echo $product['Product']['slug']; ?>.html" class="btn-shop">VIEW COLLECTION</a>
            </div>
			<?php endforeach; ?>
            
          </div>
        </div>
      </div>
    </div>