<?php ?>
<!--Page Info-->
  <section class="page-info">
    <!--Image Layer-->
    <div class="image-layer"></div>
    <div class="auto-container">
      <h2><?php echo $product['Product']['product_alt']; ?></h2>
      <ul class="bread-crumb clearfix">
        <li><a href="<?php echo $this->webroot; ?>">Home</a></li>
        <li><a href="<?php echo $this->webroot; ?>">
		<?php 	
		foreach ($category as $category_item):  	
		?>
		<?php echo h($category_item['Category']['name']); ?><?php 
		endforeach;
		?></a></li>
       <li class="active"><?php echo $product['Product']['product_alt']; ?></li>
      </ul>
    </div>
  </section>
  <!--Shop Single-->
  <div class="shop-single shop-page shop-fullwidth">
    <div class="auto-container shop-container">
      <!--Prod Info Section-->
      <section class="prod-info-section">
        <div class="row clearfix">
          <div class="carousel-column col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <div class="carousel-outer wow fadeInLeft">
              <ul class="image-carousel">
                
                <li><a class="lightbox-image" href="images/products/<?php echo $product['Product']['image']; ?>" title="<?php echo $product['Product']['name']; ?>"><img alt="" src="images/products/<?php echo $product['Product']['image']; ?>" /></a></li>
				<li><a class="lightbox-image" href="images/products/<?php echo $product['Product']['back_image']; ?>" title="<?php echo $product['Product']['name']; ?>"><img alt="" src="images/products/<?php echo $product['Product']['back_image']; ?>" /></a></li>
				
				
				   <?php 
				 
				 $galleries = $product['Productphoto'];
				 
		  if(count($galleries) > 0) { 
		  foreach ($galleries as $gallery):
		  $thumbImageurl = "";
		  $gthumbImageurl = $this->Html->url('/images/productphotos/'.$gallery['image']);

		  ?>	
		    	<li><a class="lightbox-image" href="<?php echo $gthumbImageurl; ?>" title="<?php echo $gallery['name']; ?>"><img alt="" src="<?php echo $gthumbImageurl; ?>" /></a></li>
				
             <?php     endforeach; } ?>
		  
		  
              </ul>
              <ul class="thumbs-carousel">
                 <li><img alt="<?php echo $product['Product']['name']; ?>" src="images/products/<?php echo $product['Product']['back_image']; ?>" /></li>
				  <li><img alt="<?php echo $product['Product']['name']; ?>" src="images/products/<?php echo $product['Product']['image']; ?>" /></li>
               
			   
			   
			   
			     <?php 
				 
				 $galleries = $product['Productphoto'];
				 
		  if(count($galleries) > 0) { 
		  foreach ($galleries as $gallery):
		  $thumbImageurl = "";
		  $gthumbImageurl = $this->Html->url('/images/productphotos/'.$gallery['image']);

		  ?>	
		    <li><img alt="<?php echo $gallery['name']; ?>" src="<?php echo $gthumbImageurl;?>" /></li>
             <?php     endforeach; } ?>
		  
              </ul>
            </div>
          </div>
          <!--Content Column-->
          <div class="content-column col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="outer wow fadeInRight">
              <div class="title-box">
                <h2><?php echo $product['Product']['name']; ?></h2>
                <!-- <div class="rating">&ensp; <span class="txt">6 customer reviews</span></div> -->
                <div class="availability"><strong>In stock:</strong> <?php echo $product['Product']['product_stock']; ?></div>
              </div>
              <div class="desc-text">
                <p><strong>Description:</strong><?php echo $product['Product']['description']; ?></p>
                <div class="title-box">
                  <div class="price">Product Info:</div>
                </div>
                <div class="share-options"><strong>Fabric :</strong><?php echo $product['Product']['fabric']; ?></div>				 
                <?php
                if(count($colors) > 0) {
                ?>
			    <div class="share-options"><strong>Colour Available :</strong>
				<?php 	
                foreach ($colors as $color_item):  	
                ?>
				<?php echo h($color_item['Color']['name']); ?>
				<?php 
                endforeach;
                ?>
				</div>
				<?php 
                }
                ?>
                <div class="share-options"><strong>Length :</strong> <?php echo $product['Product']['length']; ?></div>
                <div class="share-options"><strong>Fit :</strong> <?php echo $product['Product']['fit']; ?></div>
                <div class="share-options"><strong>Style :</strong><?php echo $product['Product']['style']; ?></div>
				<?php
				if(count($sizes) > 0) {
				?>
			 
				 <div class="share-options form-inline"><strong>Sizes Available :</strong>
				 <select  class="form-control form-inline"  role="button" name="data[Product][product_size]" required>
                <option value="">Select Size</option>
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
				<br>
				
			  </div> 
 								
<script src="js/addtocart.js"></script>
<?php  echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'add'))); ?>
<?php  echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>

<div class="shop-options clearfix">
<div class="form-group">
<div class="quantity-spinner"><button type="button" class="minus"><span class="fa fa-caret-down"></span></button><input type="text" name="data[Product][quantity]" value="1" class="prod_qty qty"><button type="button" class="plus"><span class="fa fa-caret-up"></span></button></div>
</div>

<div class="form-group"> 
<?php echo $this->Form->button('Add to Cart', array('class' => 'theme-btn btn-style-two add-cart-btn', 'id' => 'addtocart', 'id' => $product['Product']['id']));?>
</div>
</div>
 
<?php echo $this->Form->end(); ?>
			
<div class="col-lg-12">
<p>
<?php 
$msg = $this->Session->flash(); 
echo $msg; 							
?>
</p>

			</div>			
            </div>
          </div>
        </div>		
						
      </section>
	  <?php /*
      <!--Product Info Tabs-->
      <div class="product-info-tabs">
        <!--Product Tabs-->
        <section class="prod-tabs" id="product-tabs">
          <!--Tabs Container-->
          <div class="tabs-container">
            <div class="row">
              <div class="col-lg-6">
                <!--Tab / Active Tab-->
                <div class="tab active-tab" id="prod-description">
                  <div class="content">
                    <h3>How to care?</h3>
                    <?php echo $product['Product']['short_description']; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="billing-details" id="product-contact-form">
                  <div class="group-title">
                    <h2>Enquiry Now</h2>
                  </div>
                  <div class="shop-form" >
                    <div id="successmsg"></div>
                    <form action="enquiries/add" id="xform" method="post">
                      <input id="enquiry_for" name="enquiry_for" type="hidden" value="" />
                      <input id="page_url" name="page_url" type="hidden" value="" />
                      <div class="row clearfix">
                        <!--Form Group-->
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                          <div class="field-label">First name <sup>*</sup></div>
                          <input name="name" placeholder="" required="" type="text" value="" />
                        </div>
                        <!--Form Group-->
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                          <div class="field-label">Last name <sup>*</sup></div>
                          <input name="lname" placeholder="" type="text" value="" />
                        </div>
                        <!--Form Group-->
                        <!--Form Group-->
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                          <div class="field-label">Email Address</div>
                          <input name="email" placeholder="" required="" type="email" value="" />
                        </div>
                        <!--Form Group-->
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                          <div class="field-label">Phone <sup>*</sup></div>
                          <input name="phone" placeholder="" required="" type="text" value="" />
                        </div>
                        <!--Form Group-->
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                          <div class="field-label">Address <sup>*</sup></div>
                          <input name="address" placeholder="" required="" type="text" value="" />
                        </div>
                        <!--Form Group-->
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                          <div class="field-label">Zip / Postal Code</div>
                          <input name="zipcode" placeholder="Zip / Postal Code" type="text" value="" />
                        </div>
                        <!--Form Group-->
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                          <div class="field-label">Country <sup>*</sup></div>
                          <select name="country">
                            <option value="">Select</option>							
							<?php 
							if(count($countries) > 0) { 
							foreach ($countries as $country_item):
							?>
							<option value="<?php echo $country_item['Country']['name'];?>"><?php echo $country_item['Country']['name'];?></option>
							<?php 
							endforeach;
							}
							?>                 
                           </select>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="field-label">Order note</div>
                          <textarea name="message" placeholder=""></textarea>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="theme-btn btn-style-two" type="submit" name="submit-form">SEND US</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
	  */ ?>
    </div>
  </div>
  

 