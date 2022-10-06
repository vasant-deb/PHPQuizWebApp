<?php ?>
<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php $this->Html->addCrumb('Shopping Cart'); ?>
<?php echo $this->App->js(); ?>
<?php echo $this->Html->script(['cart.js'], ['inline' => false]); ?>
<?php echo $this->fetch('script'); ?>

	                                       


<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>Shopping Cart</h2>
			<p>Home<span class="separator">/</span><span class="current-section">Shopping Cart</span></p>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->

	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
			<!-- SIDEBAR -->
			<div class="sidebar left">
				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item">
					<h4>Redeem Code</h4>
					<hr class="line-separator">
					<form id="coupon-code-form">
						<input type="text" name="coupon_code" placeholder="Enter your coupon code...">
						<button class="button mid dark-light">Apply Coupon Code</button>
					</form>
				</div>
				<!-- /SIDEBAR ITEM -->

				
			</div>
			<!-- /SIDEBAR -->

			<!-- CONTENT -->
			<div class="content right">
			<?php echo $this->Form->create(NULL, ['url' => ['controller' => 'shop', 'action' => 'cartupdate']]); ?>
				<!-- CART -->
				<div class="cart">
				  
                                    <?php if(empty($shop['OrderItem'])) : ?>
                                    Shopping Cart is empty.
                                    <?php else: ?>
					<!-- CART HEADER -->
					<div class="cart-header">
						<div class="cart-header-product">
							<p class="text-header small">Product Details</p>
						</div>
						<div class="cart-header-category">
							<p class="text-header small">Category</p>
						</div>
						<div class="cart-header-price">
							<p class="text-header small">Price</p>
						</div>
						<div class="cart-header-actions">
							<p class="text-header small">Remove</p>
						</div>
					</div>
					<!-- /CART HEADER -->

									  <?php $tabindex = 1; ?>
                                          <?php foreach ($shop['OrderItem'] as $key => $item): ?>
					<!-- CART ITEM -->
					<div class="cart-item">
						<!-- CART ITEM PRODUCT -->
						<div class="cart-item-product">
							<!-- ITEM PREVIEW -->
							<div class="item-preview">
								<a href="item-v1.html">
									<figure class="product-preview-image small liquid">
									<?php echo $this->Html->image('/images/products/' . $item['Product']['image']); ?>
									</figure>
								</a>
								<a href="<?php echo $item['Product']['slug'];?>.html"><p class="text-header small"><?php echo $item['Product']['name'];?></p></a>
								<p class="description"><?php echo $item['Product']['files_included'];?></p>
							</div>
							<!-- /ITEM PREVIEW -->
						</div>
						<!-- /CART ITEM PRODUCT -->

						<!-- CART ITEM CATEGORY -->
						<div class="cart-item-category">
							<a href="shop-gridview-v1.html" class="category primary"><?php echo $item['Product']['framework'];?></a>
						</div>
						<!-- /CART ITEM CATEGORY -->

						<!-- CART ITEM PRICE -->
						<div class="cart-item-price">
							<p class="price"><span>$</span><?php echo $item['Product']['discounted_price'];?></p>
						</div>
						<!-- /CART ITEM PRICE -->

						<!-- CART ITEM ACTIONS -->
						<div class="cart-item-actions">
							
								<!-- SVG PLUS -->
							

<a id="<?php echo $key;?>" href="/shop/remove/<?php echo $key;?>" title="Remove item"><i class="fa fa-trash" aria-hidden="true"></i></a>		
																			
								<!-- /SVG PLUS -->
							
						</div>
						<!-- /CART ITEM ACTIONS -->
					</div>
					<?php echo $this->Form->end(); ?>
					<!-- /CART ITEM -->
<?php endforeach;?>
			

					<!-- CART TOTAL -->
					<!-- CART TOTAL -->
					<div class="cart-total">
						<p class="price medium"><span>$</span><?php echo $item['Product']['discounted_price'];?></p>
						<p class="text-header total">Cart Total</p>
					</div>
					<!-- /CART TOTAL -->

					<!-- CART ACTIONS -->
					<div class="cart-actions">
						<a href="shop/checkout" class="button mid primary">Proceed to Checkout</a>
						<a href="shop-gridview-v1.html" class="button mid dark-light spaced">Continue Browsing</a>
					</div>
					<!-- /CART ACTIONS -->
				</div>
				<?php endif; ?>
				<!-- /CART -->
			</div>
			<!-- CONTENT -->
		</div>
	</div>
	<!-- /SECTION -->