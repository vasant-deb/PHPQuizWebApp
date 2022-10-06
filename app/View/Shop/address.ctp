<?php echo $this->App->js(); ?>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<?php echo $this->Html->script(array('shop_address.js'), array('inline' => false)); ?>
    <?php echo $this->fetch('script'); ?>

<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>Checkout</h2>
			<p>Home<span class="separator">/</span><span class="current-section">Checkout</span></p>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->
 
	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
			<!-- FORM BOX ITEMS -->
			<div class="form-box-items">
			 <?php 
            $msg = $this->Session->flash(); 
            echo $msg; 							
            ?>
				<!-- FORM BOX ITEM -->
				<div class="form-box-item">
					<h4>Billing Information</h4>
					<hr class="line-separator">
					 <?php echo $this->Form->create('Order'); ?>
						<!-- INPUT CONTAINER -->
						
						<!-- /INPUT CONTAINER -->
						
						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="first_name" class="rl-label required">First Name</label>
						   <?php echo $this->Form->input('first_name', array('class' => 'form-control', 'value' => $customer_data['User']['first_name'])); ?>
                 
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="last_name" class="rl-label required">Last Name</label>
						   <?php echo $this->Form->input('email', array('class' => 'form-control', 'label' => 'Email address', 'value' => $customer_data['User']['email'])); ?>
                 
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="company_name" class="rl-label">Mobile No.</label>
							
						<?php echo $this->Form->input('phone', array('class' => 'form-control','value' => $customer_data['User']['phone'])); ?>
                 
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="email_address" class="rl-label required">Email Address</label>
						<?php echo $this->Form->input('email', array('class' => 'form-control','value' => $customer_data['User']['email'])); ?>
                 
						</div>
						

						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="state_city1" class="rl-label required">COUNTRY</label>
							<label for="state_city1" class="select-block">
								   <select name="data[Order][billing_country]" id="OrderBillingCountry" class="form-control">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $item): ?>
                        <option value="<?php echo $item['Country']['name'];?>" <?php if($item['Country']['name'] == $customer_data['User']['country']) { echo "selected"; } ?>><?php echo $item['Country']['name'];?></option>
                        <?php endforeach; ?>
                     </select>
								<!-- SVG ARROW -->
								<svg class="svg-arrow">
									<use xlink:href="#svg-arrow"></use>
								</svg>
								<!-- /SVG ARROW -->
							</label>
						</div>
						<!-- /INPUT CONTAINER -->
						 <button value="register" type="submit" class="button big dark">Continue</button>	

				</div>

	
					
					


         <?php echo $this->Form->end(); ?>
      </div>
   </div>
</div>