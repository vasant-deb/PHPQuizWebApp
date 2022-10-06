<?php ?>

<div class="container-fluid upload-details">
               <div class="row">
                  <div class="col-lg-12">
      
            <div class="checkout_details_area checkout-1 mt-50 clearfix">
               <div class="row">
                 
                   <div class="col-md-12">
                     <h2>Forgot Your Password?</h2>
					 <hr>
                     <p>Enter the e-mail address associated with your account. Click Reset Your Password to have your password e-mailed to you.</p>
                        <form class="form-horizontal product-form" action="" method="post">
                        <div class="form-group">
                           <label for="email">Email address</label>
                           <input type="email" class="form-control" id="email"  name="email" required="required" aria-describedby="emailHelp" placeholder="Enter email">
                              
                           <small id="emailHelp" class="form-text text-muted">
							<p>
							<?php 
							$msg = $this->Session->flash(); 
							echo $msg; 							
							?> 
							</p>
						   </small>						  
                        </div>
                       
                        <input type="hidden" name="mode" value="forgot">
						<button  type="submit" class="cart-button text-uppercase mt-20">Reset Your Password</button>
                        
                        <a class="forget_password" href="customer/login">Login to Your Account</a>
                     </form>
					 </br>
                  </div>
               </div>
            </div>
         </div>
                   
      </div>
   </div>

          