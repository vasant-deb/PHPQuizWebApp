<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>

<?php $this->Html->addCrumb('Shopping Cart'); ?>

<?php echo $this->Html->script(['cart.js'], ['inline' => false]); ?>

<?php
 

?>

 <!--start-single-heading-banner-->
            <div class="single-banner-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <div class="single-ban-top-content">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-single-heading-banner-->
            <!--start-single-heading-->
            <div class="signle-heading">
                <div class="container">
                    <div class="row">
                        <!--start-shop-head -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="shop-head-menu">
                                <ul>
                                    <li><i class="fa fa-home"></i><a class="shop-home" href="index.html"><span>Home</span></a><span><i class="fa fa-angle-right"></i></span></li>
                                    <li class="shop-pro">Shopping Cart</li>
                                </ul>
                            </div>
                        </div>
                        <!--end-shop-head-->
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!-- cart-main-area start-->
            <div class="cart-main-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						<?php if(empty($shop['OrderItem'])) : ?>
						Shopping Cart is empty

						<?php else: ?>

<?php echo $this->Form->create(NULL, ['url' => ['controller' => 'shop', 'action' => 'cartupdate']]); ?>

						  			
                                <div class="table-content table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Image</th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                                <th class="product-remove">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										
<?php $tabindex = 1; ?>
<?php foreach ($shop['OrderItem'] as $key => $item): ?>
<?php

$frontImageurl  = $this->Html->url('/images/products/'.$item['Product']['image']);
  
$mods = 0;
if(isset($item['Product']['productmod_name'])) :
$mods = $item['Product']['productmod_id'];
?>
<?php endif; ?>

<!-- products/sliding-systems/s-series-sliding-door-system-with-4-rollers -->

                                            <tr id="row-<?php echo $key; ?>">
                                                <td class="product-thumbnail">
												<a href="products/category/<?php echo $item['Product']['slug'];?>">
												<img src="<?php echo $frontImageurl;?>" alt="<?php echo $item['Product']['name'];?>" />
												</a>
												</td>
                                                <td class="product-name">
												<a href="products/category/<?php echo $item['Product']['slug'];?>"><?php echo $item['Product']['name'];?>
												</a>
												<?php if($item['size']) { ?>
												<br>Size : <?php echo $item['size'];?> 
												<?php } ?>
												<?php if($item['color']) { ?>
												<br>Color : <?php echo $item['color'];?> 
												<?php } ?>
												</td>
                                                <td class="product-price"><span class="amount" id="price-<?php echo $key; ?>">&pound<?php echo $item['Product']['price']; ?></span></td>
                                                <td class="product-quantity">
												<!-- <input type="number" value="1" /> -->
												<?php echo $this->Form->input('quantity-' . $key, ['div' => false, 'type' => 'tel', 'class' => 'numeric form-control input-small', 'label' => false, 'size' => 2, 'maxlength' => 2, 'tabindex' => $tabindex++, 'data-id' => $item['Product']['id'], 'data-mods' => $mods, 'value' => $item['quantity']]); ?>
												</td>
                                                <td class="product-subtotal" id="subtotal_<?php echo $key; ?>">&pound<?php echo $item['subtotal']; ?></td>
                                                <td class="product-remove">
												<!--<a href="#"><i class="fa fa-times"></i></a>-->
												<span class="remove" id="<?php echo $key; ?>"></span>
												</td>
                                            </tr>
                                             
<?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                                        <div class="buttons-cart">
                                            <input class="banner-r-b" type="submit" value="Update Cart" />
                                            <a href="products">Continue Shopping</a>
                                        </div>
                                        <div class="coupon">
                                            <h3>Coupon</h3>
                                            <p>Enter your coupon code if you have one.</p>
                                            <input type="text" placeholder="Coupon code" />
                                            <input type="submit" value="Apply Coupon" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                                        <div class="cart_totals">
                                            <h2>Cart Totals</h2>
                                            <table>
                                                <tbody>
                                                    <tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        <td><span class="amount"  id="subtotal">&pound<?php echo $shop['Order']['subtotal']; ?></span></td>
                                                    </tr>
                                                    <tr class="shipping">
                                                        <th>Shipping</th>
                                                        <td>
                                                            <ul id="shipping_method">
                                                                <li>
                                                                    <input type="radio" /> 
                                                                    <label>
                                                                        Flat Rate: <span class="amount">&pound7.00</span>
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <input type="radio" /> 
                                                                    <label>
                                                                        Free Shipping
                                                                    </label>
                                                                </li>
                                                                <li></li>
                                                            </ul>
                                                            <p><a class="shipping-calculator-button" href="#">Calculate Shipping</a></p>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td>
                                                            <strong><span class="amount" id="total">&pound<?php echo $shop['Order']['total']; ?></span></strong>
                                                        </td>
                                                    </tr>											
                                                </tbody>
                                            </table>
                                            <div class="wc-proceed-to-checkout">
                                                <a href="shop/address">Proceed to Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>	
							
							
<?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- cart-main-area end -->
            <!--Start-brand-area-->    
            <div class="brands-area brand-cart">
                <div class="container">
                    <!--barand-heading-->
                    <div class="brand-heading text-center">
                        <h2>Popular brands</h2>
                    </div>
                    <!--brand-heading-end-->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="brands-carousel">
                                <!--start-single-brand-->
                                <div class="single-brand">
                                    <a href="#"><img src="fmf/images/brands/1.png" alt=""></a>
                                </div>
                                <!--end-single-brand-->
                                <!--start-single-brand-->
                                <div class="single-brand">
                                    <a href="#"><img src="fmf/images/brands/2.png" alt=""></a>
                                </div>
                                <!--end-single-brand-->
                                <!--start-single-brand-->
                                <div class="single-brand">
                                    <a href="#"><img src="fmf/images/brands/3.png" alt=""></a>
                                </div>
                                <!--end-single-brand-->
                                <!--start-single-brand-->
                                <div class="single-brand">
                                    <a href="#"><img src="fmf/images/brands/4.png" alt=""></a>
                                </div>
                                <!--end-single-brand-->
                                <!--start-single-brand-->
                                <div class="single-brand">
                                    <a href="#"><img src="fmf/images/brands/1.png" alt=""></a>
                                </div>
                                <!--end-single-brand-->
                                <!--start-single-brand-->
                                <div class="single-brand">
                                    <a href="#"><img src="fmf/images/brands/2.png" alt=""></a>
                                </div>
                                <!--end-single-brand-->
                                <!--start-single-brand-->
                                <div class="single-brand">
                                    <a href="#"><img src="fmf/images/brands/3.png" alt=""></a>
                                </div>
                                <!--end-single-brand-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End-brand-area-->	