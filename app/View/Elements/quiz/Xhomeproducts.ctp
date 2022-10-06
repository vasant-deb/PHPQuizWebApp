<?php ?>
<?php   
if(count($homeproduct) > 0) { 
?>

<div class="featured-product-area section-padding" id="arrival">
      <div class="container">
        <div class="row rp-style">
          <div class="col-md-12">
            <div class="section-title text-center mb-35">
              <h2 class="text-uppercase"><strong>FRESH NEW ARRIVAL</strong></h2>
              <p class="text-defualt">ALL NEW ITEAMS</p>
			  <div class="col-md-12 text-right">
			<a href="new-arrival.html" class="product-name view">View all</a>
			</div>
              <img alt="" src="unknown/images/section-border.png">  </div>
          </div>
        </div>
        <div class="row rp-style">
          <div class="featured-carousel indicator-style">
            
			<?php foreach($homeproduct as $products):
 $frontImageurl1 = $this->Html->url('/images/products/'.$products['Product']['image']);
$backImageurl1  = $this->Html->url('/images/products/'.$products['Product']['back_image']);
                 $ddthumbImageurl = "images/no-image.jpg";
				?>
            <div class="product-container cp-style-2">
              <div class="product-inner"> <a href="<?php echo $products['Product']['slug']; ?>.html">
                <div class="product-img b-img">
 <?php 
				if($products['Product']['image'] != '') {
				?>
				<img alt="" src="<?php echo $frontImageurl1; ?>"> 
				<?php } else { ?>
				<img alt="" src="<?php echo $ddthumbImageurl; ?>"> 
				<?php } ?>
				</div>
                </a> <?php 
				if($products['Product']['product_alt'] != '') {
				?>		 <span class="product-tag text-uppercase theme-bg"><?php echo $products['Product']['product_alt']; ?></span>
				<?php } ?>
                <!--<ul class="quick-veiw text-center">
                  <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                  <li><a href="#"><i class="fa fa-heart"></i></a></li>
                </ul>-->
				
                <div class="product-text pt-15">
                 <!-- <ul class="pull-left list-inline ratings">
                    <li><i class="rated fa fa-star"></i></li>
                    <li><i class="rated fa fa-star"></i></li>
                    <li><i class="rated fa fa-star"></i></li>
                    <li><i class="rated fa fa-star"></i></li>
                    <li><i class="rated fa fa-star"></i></li>
                  </ul>-->
                  <ul class="pricing list-inline text-center">
                    <?php 
				if($products['Product']['discounted_price'] != '') {
				?>
				
			     	
					
                    <!--<li class="text-right c-price">$<?php echo $products['Product']['discounted_price']; ?></li>-->
					<?php } ?>
					<p class="prdo">Product name</p>
					<p class="product-desc">Product Description</p>
					<p class="price-sec"><i class="fa fa-rupee"></i>300 <span><i class="fa fa-rupee"></i>  1069</span><span class="off">(55% off)</span></p>
				 <!--<?php 
				if($products['Product']['price'] != '') {
				?>
                    <li class="text-right p-price">$<?php echo $products['Product']['price']; ?></li>-->
				<?php } ?>
                  </ul>
                  <div class="clear"></div>
                 <!-- <h6 class="product-name m-0"> <a title="<?php echo $products['Product']['name']; ?>" href="<?php echo $products['Product']['slug']; ?>.html"><?php echo $products['Product']['name']; ?></a> </h6>-->
                </div>
              </div>
            </div>
			<?php endforeach; ?>
           
           
            
           
            </div>
          </div>
        </div>
      </div>
    </div>
<?php } ?>