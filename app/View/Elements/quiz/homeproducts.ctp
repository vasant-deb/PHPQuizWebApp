<?php ?>

	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
		
			<!-- /PRODUCT SHOWCASE -->
			<!-- PRODUCT SHOWCASE -->
			<div class="product-showcase">
				<!-- HEADLINE -->
				<div class="headline primary">
					<h4>Hot Products</h4>
				</div>
				<!-- /HEADLINE -->

				<!-- PRODUCT LIST -->
				<div class="product-list grid column4-wrap">
				
				<?php foreach($product as $products):
 $frontImageurl1 = $this->Html->url('/images/products/'.$products['Product']['image']);

                 $ddthumbImageurl = "images/no-image.jpg";
				?>
					<!-- PRODUCT ITEM -->
					<div class="product-item column">
						<!-- PRODUCT PREVIEW ACTIONS -->
						<div class="product-preview-actions">
							<!-- PRODUCT PREVIEW IMAGE -->
							<figure class="product-preview-image">
								<img src="<?=$frontImageurl1;?>" alt="product-image">
							</figure>
							<!-- /PRODUCT PREVIEW IMAGE -->

							<!-- PREVIEW ACTIONS -->
							<div class="preview-actions">
								<!-- PREVIEW ACTION -->
								<div class="preview-action">
									<a href="<?php echo $products['Product']['slug']; ?>.html">
										<div class="circle tiny primary">
											<span class="icon-tag"></span>
										</div>
									</a>
									<a href="<?php echo $products['Product']['slug']; ?>.html">
										<p>Go to Item</p>
									</a>
								</div>
								<!-- /PREVIEW ACTION -->

								<!-- PREVIEW ACTION -->
								<div class="preview-action">
									<a href="#">
										<div class="circle tiny secondary">
											<span class="icon-heart"></span>
										</div>
									</a>
									<a href="#">
										<p>Favourites +</p>
									</a>
								</div>
								<!-- /PREVIEW ACTION -->
							</div>
							<!-- /PREVIEW ACTIONS -->
						</div>
						<!-- /PRODUCT PREVIEW ACTIONS -->

						<!-- PRODUCT INFO -->
						<div class="product-info">
							<a href="<?php echo $products['Product']['slug']; ?>.html">
								<p class="text-header"><?php echo $products['Product']['name']; ?></p>
							</a>
							<p class="product-description"><?php echo $products['Product']['files_included']; ?></p>
							<a href="shop-gridview-v1.html">
								<p class="category primary"><?php echo $products['Category']['name']; ?></p>
							</a>
							<p class="price"><span><i class="fa fa-inr"></i></span><?php echo $products['Product']['discounted_price']; ?></p>
						</div>
						<!-- /PRODUCT INFO -->
						<hr class="line-separator">

						<!-- USER RATING -->
						<div class="user-rating">
							<a href="author-profile.html">
								<figure class="user-avatar small">
									<img src="images/avatars/avatar_01.jpg" alt="user-avatar">
								</figure>
							</a>
							<a href="author-profile.html">
								<p class="text-header tiny"><?php echo $products['Product']['framework']; ?></p>
							</a>
							<ul class="rating tooltip" title="Author's Reputation">
								<li class="rating-item">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item empty">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
							</ul>
						</div>
						<!-- /USER RATING -->
					</div>
					<!-- /PRODUCT ITEM -->
<?php endforeach;?>
				
				</div>
				<!-- /PRODUCT LIST -->

				<div class="clearfix"></div>
			</div>
			<!-- /PRODUCT SHOWCASE -->

			<!-- PRODUCT SHOWCASE -->
			<div class="product-showcase">
				<!-- HEADLINE -->
				<div class="headline primary">
					<h4>New Arrivals</h4>
				</div>
				<!-- /HEADLINE -->

				<!-- PRODUCT LIST -->
				<div class="product-list grid v2 column4-wrap">
				<?php foreach($newproduct as $products):
 $frontImageurl1 = $this->Html->url('/images/products/'.$products['Product']['image']);

                 $ddthumbImageurl = "images/no-image.jpg";
				?>
					<!-- PRODUCT ITEM -->
					<div class="product-item column">
						<!-- PRODUCT PREVIEW ACTIONS -->
						<div class="product-preview-actions">
							<!-- PRODUCT PREVIEW IMAGE -->
							<figure class="product-preview-image">
								<img src="<?=$frontImageurl1;?>" alt="product-image">
							</figure>
							<!-- /PRODUCT PREVIEW IMAGE -->

							<!-- PREVIEW ACTIONS -->
							<div class="preview-actions">
								<!-- PREVIEW ACTION -->
								<div class="preview-action">
									<a href="<?php echo $products['Product']['slug']; ?>.html">
										<div class="circle tiny primary">
											<span class="icon-tag"></span>
										</div>
									</a>
									<a href="<?php echo $products['Product']['slug']; ?>.html">
										<p>Go to Item</p>
									</a>
								</div>
								<!-- /PREVIEW ACTION -->

								<!-- PREVIEW ACTION -->
								<div class="preview-action">
									<a href="#">
										<div class="circle tiny secondary">
											<span class="icon-heart"></span>
										</div>
									</a>
									<a href="#">
										<p>Favourites +</p>
									</a>
								</div>
								<!-- /PREVIEW ACTION -->
							</div>
							<!-- /PREVIEW ACTIONS -->
						</div>
						<!-- /PRODUCT PREVIEW ACTIONS -->

						<!-- PRODUCT INFO -->
						<div class="product-info">
							<a href="<?php echo $products['Product']['slug']; ?>.html">
								<p class="text-header"><?php echo $products['Product']['name']; ?></p>
							</a>
							<hr class="line-separator">
							<a href="shop-gridview-v1.html">
								<p class="category primary"><?php echo $products['Category']['name']; ?></p>
							</a>
							<p class="price"><span><i class="fa fa-inr"></i></span><?php echo $products['Product']['discounted_price']; ?></p>
						</div>
						<!-- /PRODUCT INFO -->
						<hr class="line-separator">

						<!-- USER RATING -->
						<div class="user-rating">
							<a href="author-profile.html">
								<figure class="user-avatar small">
									<img src="images/avatars/avatar_01.jpg" alt="user-avatar">
								</figure>
							</a>
							<a href="author-profile.html">
								<p class="text-header tiny"><?php echo $products['Product']['framework']; ?></p>
							</a>
						</div>
						<!-- /USER RATING -->
					</div>
					<!-- /PRODUCT ITEM -->
<?php endforeach;?>
				</div>
				<!-- /PRODUCT LIST -->

				<div class="clearfix"></div>
			</div>
			<!-- /PRODUCT SHOWCASE -->

			<!-- PRODUCT SHOWCASE -->
			<div class="product-showcase">
				<!-- HEADLINE -->
				<div class="headline primary">
					<h4>Free Products</h4>
				</div>
				<!-- /HEADLINE -->

				<!-- PRODUCT LIST -->
				<div class="product-list grid v3 column4-wrap">
				<?php foreach($freeproducts as $products):
 $frontImageurl1 = $this->Html->url('/images/products/'.$products['Product']['image']);

                 $ddthumbImageurl = "images/no-image.jpg";
				?>
					<!-- PRODUCT ITEM -->
					<div class="product-item column">
						<!-- PRODUCT PREVIEW ACTIONS -->
						<div class="product-preview-actions">
							<!-- PRODUCT PREVIEW IMAGE -->
							<figure class="product-preview-image">
								<img src="<?=$frontImageurl1;?>" alt="product-image">
							</figure>
							<!-- /PRODUCT PREVIEW IMAGE -->

							<!-- PREVIEW ACTIONS -->
							<div class="preview-actions">
								<!-- PREVIEW ACTION -->
								<div class="preview-action">
									<a href="<?php echo $products['Product']['slug']; ?>.html">
										<div class="circle tiny primary">
											<span class="icon-tag"></span>
										</div>
									</a>
									<a href="<?php echo $products['Product']['slug']; ?>.html">
										<p>Go to Item</p>
									</a>
								</div>
								<!-- /PREVIEW ACTION -->

								<!-- PREVIEW ACTION -->
								<div class="preview-action">
									<a href="#">
										<div class="circle tiny secondary">
											<span class="icon-heart"></span>
										</div>
									</a>
									<a href="#">
										<p>Favourites +</p>
									</a>
								</div>
								<!-- /PREVIEW ACTION -->
							</div>
							<!-- /PREVIEW ACTIONS -->
						</div>
						<!-- /PRODUCT PREVIEW ACTIONS -->

						<!-- PRODUCT INFO -->
						<div class="product-info">
							<a href="<?php echo $products['Product']['slug']; ?>.html">
								<p class="text-header"><?php echo $products['Product']['name']; ?></p>
							</a>
							<a href="shop-gridview-v1.html">
								<p class="category tiny primary"><?php echo $products['Category']['name']; ?></p>
							</a>
							<p class="price">Free</p>
						</div>
						<!-- /PRODUCT INFO -->
						<hr class="line-separator">

						<!-- USER RATING -->
						<div class="user-rating">
							<a href="author-profile.html">
								<figure class="user-avatar small">
									<img src="images/avatars/avatar_01.jpg" alt="user-avatar">
								</figure>
							</a>
							<a href="author-profile.html">
								<p class="text-header tiny"><?php echo $products['Product']['framework']; ?></p>
							</a>
						</div>
						<!-- /USER RATING -->
					</div>
					<?php endforeach;?>
					
				</div>
				<!-- /PRODUCT LIST -->

				<div class="clearfix"></div>
			</div>
			<!-- /PRODUCT SHOWCASE -->

			<!-- PRODUCT SHOWCASE -->
			<div class="product-showcase">
				<!-- HEADLINE -->
				<div class="headline primary">
					<h4>Special Discounted Products</h4>
				</div>
				<!-- /HEADLINE -->

				<!-- PRODUCT LIST -->
				<div class="product-list grid v4 column3-wrap">
					<!-- PRODUCT ITEM -->
					<?php foreach($specialproducts as $products):
 $frontImageurl1 = $this->Html->url('/images/products/'.$products['Product']['full_image']);

                 $ddthumbImageurl = "images/no-image.jpg";
				?>
					<div class="product-item column">
						<!-- PRODUCT PREVIEW ACTIONS -->
						<div class="product-preview-actions">
							<!-- PRODUCT PREVIEW IMAGE -->
							<figure class="product-preview-image big">
								<img src="<?=$frontImageurl1;?>" alt="product-image">
							</figure>
							<!-- /PRODUCT PREVIEW IMAGE -->

							<!-- PREVIEW ACTIONS -->
							<div class="preview-actions">
								<!-- PREVIEW ACTION -->
								<div class="preview-action">
									<a href="<?php echo $products['Product']['slug']; ?>.html">
										<div class="circle tiny primary">
											<span class="icon-tag"></span>
										</div>
									</a>
									<a href="<?php echo $products['Product']['slug']; ?>.html">
										<p>Go to Item</p>
									</a>
								</div>
								<!-- /PREVIEW ACTION -->

								<!-- PREVIEW ACTION -->
								<div class="preview-action">
									<a href="#">
										<div class="circle tiny secondary">
											<span class="icon-heart"></span>
										</div>
									</a>
									<a href="#">
										<p>Favourites +</p>
									</a>
								</div>
								<!-- /PREVIEW ACTION -->
							</div>
							<!-- /PREVIEW ACTIONS -->
						</div>
						<!-- /PRODUCT PREVIEW ACTIONS -->

						<!-- PRODUCT INFO -->
						<div class="product-info">
							<a href="item-v1.html">
								<p class="text-header"><?php echo $products['Product']['name']; ?></p>
							</a>
							<a href="shop-gridview-v1.html">
								<p class="category tiny primary"><?php echo $products['Category']['name']; ?></p>
							</a>
							<p class="price big"><span><i class="fa fa-inr"></i><?php echo $products['Product']['discounted_price']; ?></span></p>
						</div>
						<!-- /PRODUCT INFO -->
						<hr class="line-separator">

						<!-- USER RATING -->
						<div class="user-rating">
							<a href="author-profile.html">
								<figure class="user-avatar small">
									<img src="images/avatars/avatar_01.jpg" alt="user-avatar">
								</figure>
							</a>
							<a href="author-profile.html">
								<p class="text-header tiny"><?php echo $products['Product']['framework']; ?></p>
							</a>
							<ul class="rating tooltip" title="Author's Reputation">
								<li class="rating-item">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item empty">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
							</ul>
						</div>
						<!-- /USER RATING -->
					</div>
					<!-- /PRODUCT ITEM -->

				<?php endforeach ;?>
				</div>
				<!-- /PRODUCT LIST -->

				<div class="clearfix"></div>
			</div>
			<!-- /PRODUCT SHOWCASE -->
		
	<!-- /SECTION -->
	



            
			
        