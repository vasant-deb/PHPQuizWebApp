<?php ?>
            <!--start-single-heading-->
            <div class="signle-heading">
                <div class="container">
                    <div class="row">
                        <!--start-shop-head -->
                        <div class="col-lg-12">
                            <div class="shop-head-menu">
                                <ul>
                                    <li><i class="fa fa-home"></i><a class="shop-home" href="index.html"><span>Home</span></a><span><i class="fa fa-angle-right"></i></span></li>
                                    <li class="shop-pro">My Account</li>
                                </ul>
                            </div>
                        </div>
                        <!--end-shop-head-->
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!--start-my-account-area -->
            <div class="my-account-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="my-account-title">
                                <h2>Login or Create an Account</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="new-customers customer banner-r-b">
                                <div class="customer-inner">
                                    <div class="user-title">
                                        <h2><i class="fa fa-file"></i>New Customers</h2>
                                    </div>
                                    <div class="user-content">
                                        <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                                    </div>
                                </div>
                                <div class="user-bottom fix">
                                    <button class="btn" type="button" onclick="window.location.href='customer/register'">Create an Account</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="resestered-customers customer">
                                <div class="customer-inner">
                                    <div class="user-title">
                                        <h2><i class="fa fa-file-text"></i>Forgot Your Password?</h2>
                                    </div>
                                    <div class="user-content">
                                        <p>Enter the e-mail address associated with your account. Click submit to have your password e-mailed to you.

</p>
                                    </div>
									 
									

                                    <div class="account-form">
								
                              <h2>Your E-Mail Address</h2>

                                        <form class="form-horizontal product-form" action="" method="post">
                                            <div class="form-goroup">
                                                <label>Email Address <sup>*</sup></label>
                                                <input type="text" name="email" required="required" class="form-control">
                                            </div>
                                           
                                      
                                    </div>
									 
								  <?php 
									$msg = $this->Session->flash(); 
									echo $msg; 							
									?> 
                                 </div>
                                <div class="user-bottom fix">
                                    <a href="customer/login">Login to your Account</a>
									<input type="hidden" name="mode" value="forgot">
                                    <button class="btn" type="submit">Reset Your Password</button>
                                </div>
                            </div>
							  </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-my-account-area -->
			
			<?php ?>
<section class="page-info">
    <div class="image-layer" style="background-image:url(images/background/page-title-1.png);"></div>
   <div class="auto-container">
      <h2>Login/Register</h2>
      <ul class="bread-crumb clearfix">
         <li><a href="index.html">Home</a></li>
         <li class="active">Login/Register</li>
      </ul>
   </div>
</section>
<div class="checkout-page">
   <div class="auto-container">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="checkout_details_area checkout-1 mt-50 clearfix">
               <div class="row">
                  <div class="col-md-6">
                     <h5>Create An Account</h5>
                      <h5>Register and save time!</h5>
                     <p>Register with us for future convenience:</p>
                     <p><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Fast and easy check out <br>
                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i> Easy access to your order history and status
                     </p>
                     <a href="register.html" class="theme-btn btn-style-two proceed-btn">Register</a>
                  </div>
                   <div class="col-md-6">
                     <h5>Login</h5>
                     <p>Already registered? Please log in below:</p>
                     <form>
                        <div class="form-group">
                           <label for="email">Email address</label>
                           <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                           <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                           <label for="password">Password</label>
                           <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-check">
                           <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck1">
                              <label class="custom-control-label" for="customCheck1">Remember Me</label>
                           </div>
                        </div>
                        <button type="submit" class="theme-btn btn-style-two proceed-btn">Login</button>
                        <a class="forget_password" href="customer/forgot-password">Forget Password?</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>
                   
      </div>
   </div>
</div>
          