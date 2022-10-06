<?php ?>


                        



<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>Login and Register</h2>
			<p>Home<span class="separator">/</span><span class="current-section">Login</span></p>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->

	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section demo">
			<!-- FORM POPUP -->
			<div class="form-popup">
				
				<div class="form-popup-content">
					<h4 class="popup-title">Login to your Account</h4>
					<!-- LINE SEPARATOR -->
					<hr class="line-separator">
					<!-- /LINE SEPARATOR -->
					<form class="form-horizontal product-form" action="customer/login" method="post">
						<label for="username" class="rl-label">Email</label>
						<input type="text" id="username" name="email" placeholder="Enter your email here...">
						<label for="password" class="rl-label">Password</label>
						<input type="password" id="password" name="password" placeholder="Enter your password here...">
						<!-- CHECKBOX -->
						<input type="checkbox" id="remember" name="remember" checked>
						<label for="remember" class="label-check">
							<span class="checkbox primary primary"><span></span></span>
							Remember username and password
						</label>
						<p>
							<?php 
							$msg = $this->Session->flash(); 
							echo $msg; 							
							?> 
							</p>
						   </small>		
						<input type="hidden" name="mode" value="login">
						<!-- /CHECKBOX -->
						<p>Forgot your password? <a href="customer/forgot-password" class="primary">Click here!</a></p>
						<button class="button mid dark" type="submit">Login <span class="primary">Now!</span></button>
					</form>
					<!-- LINE SEPARATOR -->
					
				</div>
				<!-- /FORM POPUP CONTENT -->
			</div>
			<!-- /FORM POPUP -->

			<!-- FORM POPUP -->
			<div class="form-popup">
				<!-- CLOSE BTN -->
				<!-- /CLOSE BTN -->

				<!-- FORM POPUP CONTENT -->
				<div class="form-popup-content">
					<h4 class="popup-title">Restore your Password</h4>
					<!-- LINE SEPARATOR -->
					<hr class="line-separator short">
					<!-- /LINE SEPARATOR -->
					<p class="spaced">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
					<form id="restore-pwd-form">
						<label for="email_address" class="rl-label">Email Address</label>
						<input type="email" id="email_address" name="email_address" placeholder="Enter your email address...">
						<!-- CHECKBOX -->
						<input type="checkbox" id="generate_pwd" name="generate_pwd" checked>
						<label for="generate_pwd" class="label-check">
							<span class="checkbox primary primary"><span></span></span>
							Generate new password
						</label>
						<!-- /CHECKBOX -->
						<button class="button mid dark no-space">Restore your <span class="primary">Password</span></button>
					</form>
				</div>
				<!-- /FORM POPUP CONTENT -->
			</div>
			<div class="clearfix"></div>
			<!-- /FORM POPUP --></div>
				<!-- /FORM POPUP CONTENT -->
			</div>