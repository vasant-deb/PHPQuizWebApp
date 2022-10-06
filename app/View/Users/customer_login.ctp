<?php ?>
<div class="container-fluid pb-0">
            <div class="row no-gutters">
               <div class="col-md-5 bg-white full-height">
                  <div class="login-main-left">
                     <div class="text-center mb-5 login-main-left-header pt-4">
                       
                        <h5 class="mt-3 mb-3">Welcome to online Quiz</h5>
                        <p>It is a long established fact that a reader <br> will be distracted by the readable.</p>
                     </div>
                    <form class="form-horizontal product-form" action="" method="post">
						<input type="hidden" name="mode" value="login">
                        <div class="form-group">
                           <label>Email Address</label>
                        <input type="email" name="email" required="required" class="form-control mystyle" placeholder="Email Address" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                           <label>Password</label>
                           <input type="password" name="password" required="required"  class="form-control mystyle" id="password" placeholder="Password">
                       <p>
							<?php 
							$msg = $this->Session->flash(); 
							echo $msg; 							
							?> 
							</p>
					   </div>
                        <div class="mt-4">
                           <div class="row">
                              <div class="col-12">
                                 <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Sign In</button>
                              </div>
                           </div>
                        </div>
                     </form>
                     <div class="text-center mt-5">
                         <a href="/customer/forgot-password">Forgot Password</a>
                        <p class="light-gray">Don’t have an account? <a href="customer/register">Sign Up</a></p>
                     </div>
                  </div>
               </div>
              <div class="col-md-7">
                  <div class="login-main-right bg-white mt-5 mb-5">
                     <div class="owl-carousel owl-carousel-login">
                        <div class="item">
                           <div class="carousel-login-card text-center">
                              <img src="img/login.png" class="img-fluid" alt="LOGO">
                              <h5 class="mt-5 mb-3">Verify Your Email Address</h5>
                              <p class="mb-4">you will receive an email with otp<br> make sure to verify your account using that otp</p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="carousel-login-card text-center">
                              <img src="img/login.png" class="img-fluid" alt="LOGO">
                              <h5 class="mt-5 mb-3">Unlimited Quizzes</h5>
                              <p class="mb-4">If you want to participate in quiz you need to register first</p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="carousel-login-card text-center">
                              <img src="img/login.png" class="img-fluid" alt="LOGO">
                              <h5 class="mt-5 mb-3">Test Your Skills</h5>
                              <p class="mb-4">these quizzes are meant to test your skills and strengths for yourself <br>"not to judge you".</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 
		 
		 
    