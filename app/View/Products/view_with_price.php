<?php

  $product_name   = $product['Product']['name'];
  $product_price  = $product['Product']['price'];
  $product_stock  = $product['Product']['product_stock'];
  $product_description = $product['Product']['description'];
  $frontImageurl  = $this->Html->url('/images/products/'.$product['Product']['image']);
  $backImageurl   = $this->Html->url('/images/products/'.$product['Product']['back_image']);
  
  $availability = "";
  
   if($product['Product']['availability'] == 0) { $availability = "Out of Stock"; }
   if($product['Product']['availability'] == 1) { $availability = "In Stock"; }
   
?>

<!--start-single-heading-banner-->

<div class="single-banner-top">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        <div class="single-ban-top-content"> </div>
      </div>
    </div>
  </div>
</div>
<!--end-single-heading-banner-->
<!--start-single-heading-->
<div class="signle-heading">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!--start-shop-head -->
        <div class="shop-head-menu">
          <ul>
            <li><i class="fa fa-home"></i><a class="shop-home" href="<?php echo $this->webroot;?>"><span>Home</span></a><span><i class="fa fa-angle-right"></i></span></li>
            <li class="shop-pro"><?php echo $product_name;?></li>
          </ul>
        </div>
        <!--end-shop-head-->
      </div>
    </div>
  </div>
</div>
<!--end-single-heading-->
<!--start-signle-page-->
<div class="single-page-area padding-t">
  <!-- Single Product details Area -->
  <div class="single-product-details-area">
    <!-- Single Product View Area -->
    <div class="single-product-view-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
            <!-- Single Product View -->
            <div class="single-procuct-view">
              <!-- Simple Lence Gallery Container -->
              <div class="simpleLens-gallery-container" id="p-view">
                <div class="simpleLens-container tab-content">
                  <div class="tab-pane active" id="p-view-1">
                    <div class="simpleLens-big-image-container"> <a class="simpleLens-lens-image" data-lens-image="<?php echo $frontImageurl;?>"> <img src="<?php echo $frontImageurl;?>" class="simpleLens-big-image" alt="<?php echo $product_name;?>"> </a> </div>
                  </div>
                  
                </div>
                
                <!-- End Simple Lence Thumbnail -->
              </div>
              <!-- End Simple Lence Gallery Container -->
            </div>
            <!-- End Single Product View -->
          </div>
          <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 single-product-details">
            <div class="single-pro">
              <div class="product-name">
                <h3><?php echo $product_name;?></h3>
              </div>
			  <?php //echo $this->Session->flash();?>
            </div>
				
				<script src="js/addtocart.js"></script>

			  <?php  echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'add'))); ?>
			  <?php  echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
 

            <div class="product-details">
              <div class="product-content">
                <div class="pro-rating single-p">
              
                </div>
                <br>
               <!--  -->
			   <div class="pro-price single-p"> <span class="price-text">Price:</span> <span class="normal-price">£<?php echo $product_price;?></span> </div>
			  
              </div>
              <p>Availability: <span class="signle-stock"><?php echo $availability;?></span></p>
              <div class="product-reveiw">
               
              </div>
              <div class="clear"></div>
              <!--start-size-area-->
            
			<?php
			if(count($sizes) > 0) {
			?>
			<div class="skill-checklist">
			<label for="skillc"><span class="size-cho">Size:</span> </label>
            <br> 				
			<select id="skillc" name="data[Product][product_size]" required>
			<option value="">Select</option>
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
             
			 
              <!--start-size-area-->
            
			<?php
			if(count($colors) > 0) {
			?>
			  <div class="clear"></div>
			<div class="skill-checklist">
			<label for="skillc"><span class="size-cho">Color:</span> </label>
            <br> 				
			<select id="skillc" name="data[Product][product_color]" required>
			<option value="">Select</option>
			<?php 	
			foreach ($colors as $color_item):  	
			?>  
			<option value="<?php echo h($color_item['Color']['name']); ?>"><?php echo h($color_item['Color']['name']); ?></option>
			<?php 
			endforeach;
			?>
			</select>
			 </div>
			<?php 
			}
			?>
              <!--end-size-area-->
              <div class="">
                <div class="quick-add-to-cart">
                  
                    <div class="qty-button">
                      <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="data[Product][quantity]">
                      <div class="box-icon button-plus">
                        <input type="button" class="qty-increase " onClick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;" value="+">
                      </div>
                      <div class="box-icon button-minus">
                        <input type="button" class="qty-decrease" onClick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) qty_el.value--;return false;" value="-">
                      </div>
                    </div>
                    <div class="add-to-cartbest single-add"> <button type="submit" title="add to cart">
                      <div><span>Add to cart</span></div>
                      </button> </div>
 		 
                  </form>
                </div>
              </div>
              <!-- social-markting end -->
              <div class="clear"></div>
        
              <div class="clear"></div>
              <div class="social-icon-img">
                <div class="sharethis-inline-share-buttons"></div>
              </div>
            </div>
			
			
          </div>
        </div>
      </div>
    </div>
    <!-- End Single Product View Area -->
  </div>
  <!-- End Single details Area -->
</div>
<!--End-signle-page-->
<!-- Single Description Tab -->
<div class="single-product-description">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-description-tab custom-tab">
          <!-- tab bar -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#product-des" data-toggle="tab">Product Description</a></li>
            <li><a href="#product-rev" data-toggle="tab">Reviews</a></li>
          </ul>
          <!-- Tab Content -->
          <div class="tab-content">
            <div class="tab-pane active" id="product-des">
              <p><?php echo $product_description;?></p>
            </div>
            <div class="tab-pane" id="product-rev">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                  <div class="product-rev-left">
                    <p class="product-action"> <a href="http://infinitelayout.com/">OurStore</a> <b>Review by</b> <span>OurStore</span> </p>
                    <div class="product-ratting">
                      <table class="">
                        <tbody>
                          <tr>
                            <td>Quality</td>
                            <td class="quality-single-p"><ul>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li class="r-grey"><i class="fa fa-star"></i></li>
                                <li class="r-grey"><i class="fa fa-star-half-o"></i></li>
                              </ul></td>
                          </tr>
                          <tr>
                            <td>Price</td>
                            <td class="quality-single-p"><ul>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li class="r-grey"><i class="fa fa-star"></i></li>
                                <li class="r-grey"><i class="fa fa-star"></i></li>
                                <li class="r-grey"><i class="fa fa-star-half-o"></i></li>
                              </ul></td>
                          </tr>
                          <tr>
                            <td>Value</td>
                            <td class="quality-single-p"><ul>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li class="r-grey"><i class="fa fa-star-half-o"></i></li>
                              </ul></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <p>OurStore<span class="posted">(Posted on 20/07/2017)</span></p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                  <div class="product-rev-right">
                    <h3>You're reviewing: Proin lectus ipsum</h3>
                    <h3><b>How do you rate this product? <span>*</span></b></h3>
                    <div class="product-rev-right-table table-responsive">
                      <table>
                        <thead>
                          <tr class="first last">
                            <th>&nbsp;</th>
                            <th><span class="nobr">1 star</span></th>
                            <th><span class="nobr">2 stars</span></th>
                            <th><span class="nobr">3 stars</span></th>
                            <th><span class="nobr">4 stars</span></th>
                            <th><span class="nobr">5 stars</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>Quality</th>
                            <th><input type="radio" class="radio" name="ratings[1]"></th>
                            <th><input type="radio" class="radio" name="ratings[1]"></th>
                            <th><input type="radio" class="radio" name="ratings[1]"></th>
                            <th><input type="radio" class="radio" name="ratings[1]"></th>
                            <th><input type="radio" class="radio" name="ratings[1]"></th>
                          </tr>
                          <tr>
                            <th>Price</th>
                            <th><input type="radio" class="radio" name="ratings[2]"></th>
                            <th><input type="radio" class="radio" name="ratings[2]"></th>
                            <th><input type="radio" class="radio" name="ratings[2]"></th>
                            <th><input type="radio" class="radio" name="ratings[2]"></th>
                            <th><input type="radio" class="radio" name="ratings[2]"></th>
                          </tr>
                          <tr>
                            <th>Value</th>
                            <th><input type="radio" class="radio" name="ratings[3]"></th>
                            <th><input type="radio" class="radio" name="ratings[3]"></th>
                            <th><input type="radio" class="radio" name="ratings[3]"></th>
                            <th><input type="radio" class="radio" name="ratings[3]"></th>
                            <th><input type="radio" class="radio" name="ratings[3]"></th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="porduct-rev-right-form">
                      <form action="#" class="form-horizontal product-form">
                        <div class="form-goroup">
                          <label>Nickname <sup>*</sup></label>
                          <input type="text" class="form-control" required="required">
                        </div>
                        <div class="form-goroup">
                          <label>Summary of Your Review <sup>*</sup></label>
                          <input type="text" class="form-control" required="required">
                        </div>
                        <div class="form-goroup">
                          <label>Review <sup>*</sup></label>
                          <textarea class="form-control" rows="5" required="required"></textarea>
                        </div>
                        <div class="form-goroup form-group-button">
                          <button class="btn custom-button" value="submit">Submit Review</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
