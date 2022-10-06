<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php $this->Html->addCrumb('Shopping Cart'); ?>
    <?php echo $this->App->js(); ?>

<?php echo $this->Html->script(['cart.js'], ['inline' => false]); ?>
    <?php echo $this->fetch('script'); ?>

<section class="page-info">
    	
        <!--Image Layer-->
        <div class="image-layer" style="background-image:url(images/background/page-title-1.png);"></div>
        
    	<div class="auto-container">
        	<h2>Shop Cart</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li class="active">Shop</li>
            </ul>
        </div>
    </section>
<div class="shopping-cart-page">
        <div class="auto-container">
<?php echo $this->Form->create(NULL, ['url' => ['controller' => 'shop', 'action' => 'cartupdate']]); ?>
<?php if(empty($shop['OrderItem'])) : ?>

Shopping Cart is empty.

<?php else: ?>
            <!--Shopping Cart-->
            <section class="shopping-cart cart-section">
                <div class="group-title"><h2>Your cart item(s)</h2></div>	
                
                <!--Cart Column-->
                <div class="cart-column">
                    <!--Cart Outer-->
                    <div class="cart-outer">
                        <div class="table-outer">
                            <table class="cart-table">
                                <thead class="cart-header">
                                    <tr>                                        
                                        <th class="prod-column">Product</th>
                                        <th></th>
                                        <th class="price">unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>&ensp;</th>
                                    </tr>
                                </thead>                                
                                <tbody>
		
<?php $tabindex = 1; ?>
<?php foreach ($shop['OrderItem'] as $key => $item): ?>
								
                                    <tr id="row-<?php echo $key; ?>">
                                        <td class="prod-column" colspan="2">
                                        	<figure class="prod-thumb">
											<!--<a href="#"><img src="images/resource/products/cart-thumb-1.jpg" alt=""></a>-->
											<?php echo $this->Html->image('/images/products/' . $item['Product']['image'], ['class' => 'px60']); ?>
											</figure>
                                            <div class="prod-info">
                                            	<h3 class="prod-title"><a href="#"><?php echo $item['Product']['name'];?></a></h3>
                                                 <?php
            $mods = 0;
            if(isset($item['Product']['productmod_name'])) :
            $mods = $item['Product']['productmod_id'];
            ?>
            <br />
            <small><?php echo $item['Product']['productmod_name']; ?></small>
            <?php endif; ?>
												<div class="info">Color: <span class="theme_color">Green / Dark Blue</span>
												</div>
                                            </div>
                                        </td>
                                        <td class="price" id="price-<?php echo $key; ?>"><span class="fa fa-inr"></span><?php echo $item['Product']['price']; ?></td>
                                        <td class="qty">
										 
										<?php echo $this->Form->input('quantity-' . $key, ['div' => false, 'type' => 'tel', 'class' => 'numeric form-control input-small', 'label' => false, 'size' => 2, 'maxlength' => 2, 'tabindex' => $tabindex++, 'data-id' => $item['Product']['id'], 'data-mods' => $mods, 'value' => $item['quantity']]); ?>
										<!--  <i class="fa fa-refresh fa-2x text-info updatecart" role="button" aria-hidden="true"></i>
										<button class="updatecart btn  btn-primary-outline" type="submit"><i class="fa fa-refresh" aria-hidden="false"></i></button> -->
										 
										<!-- <button class="updatecart" type="submit"><i class="fa fa-refresh"></i></button>-->
										<!-- <div class="quantity-spinner"><button type="button" class="minus"><span class="fa fa-caret-down"></span></button><input type="text" name="product" value="2" class="prod_qty"><button type="button" class="plus"><span class="fa fa-caret-up"></span></button></div> -->
										</td>
                                        <td class="sub-total" id="subtotal_<?php echo $key; ?>"><span class="fa fa-inr"></span><?php echo $item['subtotal']; ?></td>
                                        <td class="remove" id="<?php echo $key; ?>">
										<!--<a href="#" class="remove-btn"><span class="flaticon-cross-1"></span></a>-->
										</td>
                                    </tr>
<?php endforeach; ?>
     
                                    
                                </tbody>
								
                            </table>
                        </div>
                        
                        
                    </div>
                    
                    <!--Other Options-->
                    
                    <div class="other-options">
                    	<div class="clearfix">
                        	<!--Coupon Column
                        	<div class="coupon-column pull-left clearfix">
                            	<div class="title-box">
                                	<h4>Do you have a coupon?</h4>
                                    <a class="info-link">Apply coupon here</a>
                                </div>
                                <div class="form-group">
                                	<input type="text" name="coupon" value="" placeholder="Enter your coupon...">
                                    <button type="button" class="theme-btn btn-style-four">Apply</button>
                                </div>
                            </div>
                            -->
                            <!--Continue Column
                        	<div class="continue-column pull-right clearfix">
                            	<a href="#" class="theme-btn btn-style-four">Continue shopping</a>
                            </div>-->
                        </div>
                    </div>
                    
                </div><!--End Cart Column-->
                
	        <?php echo $this->Form->end(); ?>
			
				
				
				
                <div class="row clearfix">
                	
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<?php /*<!--shipping-calculator-->
                        <div class="shipping-calculator">
                        	<div class="group-title"><h2>Calculate shipping</h2></div>
                            
                        	<div class="estimate-form shop-form">
                                
                                <form method="post" action="index.html">
                                	<div class="row clearfix">
                                    	<!--Form Group-->
                                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        	<select name="country">
                                            	<option>United Kingdom (UK)</option>
                                                <option>Pakistan</option>
                                                <option>USA</option>
                                                <option>CANADA</option>
                                                <option>INDIA</option>
                                            </select>
                                        </div>
                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        	<select name="state">
                                            	<option>State / Country</option>
                                                <option>Maharshtra</option>
                                                <option>NY</option>
                                                <option>ALabama</option>
                                                <option>Mexico</option>
                                            </select>
                                        </div>
                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        	<input type="text" name="code" value="" placeholder="Zip / Postal Code">
                                        </div>
                                        <!--Form Group-->
                                        <div class="form-group text-right col-md-12 col-sm-12 col-xs-12">
                                        	<button type="submit" class="theme-btn btn-style-four">Calculate</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
						*/ ?>
							<div class="continue-column pull-left clearfix">
                            	<a href="<?php echo $this->webroot;?>" class="theme-btn btn-style-two proceed-btn">Continue shopping</a>
                            </div>
							<div class="continue-column pull-right clearfix">
                            	<a href="shop/checkout" class="theme-btn btn-style-two proceed-btn">Proceed to Checkout</a>
                            </div>
                    </div>
                    
					<?php /*
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    	<div class="clearfix">
                            <!--Totals Box-->
                            <div class="totals-box">
                                <ul class="amounts-list">
                                	<li class="clearfix"><span class="title">Sub total</span><span class="amount" id="subtotal"><span class="fa fa-inr"></span><?php echo $shop['Order']['subtotal']; ?></span></li>
                                    <li class="clearfix"><span class="title">Grand Total</span><span class="amount grand-total"  id="total"><span class="fa fa-inr"></span><?php echo $shop['Order']['total']; ?></span></li>
                                </ul>
                                <a href="#" class="theme-btn btn-style-two proceed-btn">Proceed to Checkout</a>
                                <div class="multiple-account-option"><a href="#">Check out with multiple address</a></div>
                            </div>
                            
                        </div>
                    </div>
                   */ ?> 
                    
                </div>
                
            </section><!--End Shopping Cart-->
            <?php endif; ?>

        </div>
    </div>