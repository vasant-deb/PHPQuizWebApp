<?php

  $product_name   = $product['Product']['name'];
  $product_model  = $product['Product']['model_no'];

  $product_price    = $product['Product']['price'];
  $discounted_price = $product['Product']['discounted_price'];

  $product_stock  = $product['Product']['product_stock'];
  $product_description = $product['Product']['description'];
  $frontImageurl  = $this->Html->url('/images/products/'.$product['Product']['image']);
  $backImageurl   = $this->Html->url('/images/products/'.$product['Product']['back_image']);
  
  $availability = "";
  
   if($product_stock == 0) { $availability = "Out of Stock"; }
   else { $availability = "In Stock"; }
   
?>

<div class="signle-heading">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="shop-head-menu">
          <ul>
            <li><i class="fa fa-home"></i><a class="shop-home" href="<?php echo $this->webroot;?>"><span>Home</span></a><span><i class="fa fa-angle-right"></i></span></li>
            <li class="shop-pro"><?php echo $product_name;?></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="single-page-area padding-t">
  <div class="single-product-details-area">
    <div class="single-product-view-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
            <div class="single-procuct-view">
              <div class="simpleLens-gallery-container" id="p-view">
                <div class="simpleLens-container tab-content">
                  <div class="tab-pane active" id="p-view-1">
                    <div class="simpleLens-big-image-container"> <a class="simpleLens-lens-image" data-lens-image="<?php echo $frontImageurl;?>"> <img src="<?php echo $frontImageurl;?>" class="simpleLens-big-image" alt="<?php echo $product_name;?>"> </a> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 single-product-details">
            <div class="single-pro">
              <div class="product-name">
                <h3><?php echo $product_name;?></h3>
                <?php 
					$msg = $this->Session->flash(); 
					echo $msg; 							
					?>
              </div>
            </div>
            <script src="js/addtocart.js"></script>
            <?php  echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'add'))); ?>
            <?php  echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
            <div class="product-details">
              <div class="product-content">              
                <div class="pro-price single-p"> <span class="price-text"><strong>Model No :</strong></span> <span class="price-text"><?php echo $product_model;?></span> </div>
              </div>
             
              <div class="pro-price single-p"> <span class="price-text"><strong>Availability: </strong><span class="price-text"><?php echo $availability;?></span> </div>
              </div>
			  
			   
			<?php if($discounted_price > 0) { ?>
			  <div class="pro-price single-p"> <span class="price-text-1">Price :</span> <span class="normal-price-1">GBP <?php echo $product_price;?></span> <span class="price-text-1">(regular)</span> </div>
			    <div class="pro-price single-p"> <span class="price-text"><strong>Price:</strong></span> <span class="normal-price">GBP <?php echo $discounted_price;?></span>  </div>
				

			  
			  <?php 
						$offer_save = number_format(($product_price - $discounted_price),2);
						
						$percent = (($offer_save)*100) / $product['Product']['price'];

			  ?>
			 <div class="pro-price"> 
			 <h3> <?php echo $percent;?>% off </h3>
			 </div>
			  
			<?php } else { ?>
			
			   <div class="pro-price single-p"> <span class="price-text"><strong>Price:</strong></span> <span class="normal-price">GBP <?php echo $discounted_price;?></span>  </div>
			<?php } ?>
			
              <div class="product-reveiw"> </div>
              <p class="clear"></p>
              <?php
				if(count($sizes) > 0) {
				?>
              <div class="skill-checklist">
                <label for="skillc"><span class="price-text"><strong>Size:</strong></span> </label>
              
                <select id="skillc"  name="data[Product][product_size]" required>
                  <option value="">Please Select</option>
                  <?php 	
					foreach ($sizes as $size_item):  	
					?>
                  <option value="<?php echo h($size_item['Size']['name']); ?>"><?php echo h($size_item['Size']['name']); ?></option>
                  <?php 
					endforeach;
					?>
                </select>
              </div>
              <?php 
					}
					?>
              <div class="">
                <div class="quick-add-to-cart">
                  <div class="clearfix"></div>
                  <div class="clearfix"></div>
                  <div class="color-instock">
                    <p class="clear"></p>
<?php
if(count($colors) > 0) {
?>
                    <div>
                      <h3>Available Options</h3>
                      <div class="form-group required">
                        <label class="control-label">Finishes</label>
                        <div>
<?php 	
foreach ($colors as $color_item):  	

$colorImageurl  = $this->Html->url('/images/colors/'.$color_item['Color']['image']);

?>
                          <div class="radio">
                            <label>
                            <input type="radio" name="data[Product][product_color]" value="<?php echo h($color_item['Color']['name']); ?>" required>
                            <?php if($color_item['Color']['image'] != '') { ?>
                            <img src="<?php echo $colorImageurl;?>" alt="<?php echo h($color_item['Color']['name']); ?>" class="img-thumbnail">
                            <?php } ?>
                            <?php echo h($color_item['Color']['name']); ?> </label>
                          </div>
<?php 
endforeach;
?>
                        </div>
                      </div>
                    </div>
<?php 
}
?>
                  </div>
				  
				   <?php if($product_stock > 0) { ?>
                  <div class="qty-button">
                    <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                    <div class="box-icon button-plus">
                      <input type="button" class="qty-increase " onClick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;" value="+">
                    </div>
                    <div class="box-icon button-minus">
                      <input type="button" class="qty-decrease" onClick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) qty_el.value--;return false;" value="-">
                    </div>
                  </div>
                  <div class="add-to-cartbest single-add">
                    <button type="submit" title="add to cart">
                    <div> <span>Add to cart</span> </div>
                    </button>
                  </div>
				   <?php } ?>
				  
				<p class="clear"></p>
			    <div class="form-group">
                            <label class="control-label" for="input-option657">Enter PO#</label>
                            <input type="text" name="data[Product][order_po]" value="" placeholder="Enter PO#" class="form-control">
                        </div>
						
                  <div class="clear"></div>
                  </form>
                </div>
              </div>
              <div class="social-icon-img">			  
						
                <div class="sharethis-inline-share-buttons"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="single-product-description">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-description-tab custom-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#product-des" data-toggle="tab">Product Description</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="product-des">
              <p><?php echo $product_description;?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
