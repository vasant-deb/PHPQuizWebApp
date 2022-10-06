<?php echo $this->Html->script(array('shop_address.js'), array('inline' => false)); ?><?php echo $this->Form->create('Order'); ?>
<?php $order_data = $shop;?> 
<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php $this->Html->addCrumb('Shopping Cart'); ?>
<?php echo $this->App->js(); ?>
<?php echo $this->fetch('script'); ?>

<div class="shopping-cart-page">
   <div class="container">
   
   
      <?php echo $this->Form->create(NULL, ['url' => ['controller' => 'shop', 'action' => 'cartupdate']]); ?>
      <?php if(empty($shop['OrderItem'])) : ?>
      Shopping Cart is empty.
      <?php else: ?>
					<h5> <?php 
                         $msg = $this->Session->flash(); 
                         echo $msg; 
                         ?> 
						 </h5>
							  
							  	<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>Review</h2>
			<p>Home<span class="separator">/</span><span class="current-section">Review</span></p>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->

	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
				<!-- FORM BOX ITEMS -->
			<div class="form-box-items">			  
				<div class="form-box-item">
					<h4>Payment &amp; Confirmation</h4>
					<hr class="line-separator">
					<label class="rl-label">Choose your Payment Method</label>
					<!-- RADIO -->
					<input type="radio" form="checkout-form" id="credit_card" name="payment_method" value="cc">
					<label for="credit_card" class="linked-radio">
						<span class="radio primary"><span></span></span>
						Credit Card
					</label>
					<!-- /RADIO -->
					
					<!-- RADIO -->
					<input type="radio" form="checkout-form" id="ed_credits" name="payment_method" value="edc" checked>
					<label for="ed_credits" class="linked-radio">
						<span class="radio primary"><span></span></span>
						Emerald Dragon Credits
					</label>
					<!-- /RADIO -->
					
					<!-- RADIO -->
					<input type="radio" form="checkout-form" id="paypal" name="payment_method" value="pp">
					<label for="paypal" class="linked-radio">
						<span class="radio primary"><span></span></span>
						Paypal
					</label>
					<!-- /RADIO -->
		
					<hr class="line-separator top">
					<a href="shop/orderpayment"><button form="checkout-form" class="button big dark">Confirm Order <span class="primary">Now!</span></button>
				</div>
				<!-- /FORM BOX ITEM -->		  
      <!--Shopping Cart-->
   
                  
		   <?php echo $this->Form->end(); ?>
	
      <?php endif; ?>
               </div>
            </div>
      
           
		</div>
         <!--Cart Column-->
        

 