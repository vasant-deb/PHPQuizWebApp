<?php ?>

<div class="checkout-page">
   <div class="container">
      <div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		 <div class="col-md-9">
                     <div class="billing-details contactinformation">
                        <div class="shop-form">
						
									
                           
								<?php 
								$msg = $this->Session->flash(); 
								echo $msg; 							
								?>
							 <?php echo $this->Form->create('User'); ?>
							 <input type="hidden" name="mode" value="register">
                              <div class="row clearfix">
							  <div class="col-lg-6">
							  <p class="heading">Details Billing Address</p>
                              <div class="form-group">
                                    <label for="email">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $customer_data['User']['first_name'];?>"  placeholder="" required>
                              </div>

                              <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email"  value="<?php echo $customer_data['User']['email'];?>"   placeholder="" required>
                              </div>                              
							  </div>
							 <div class="col-lg-6">
							  <p class="heading">Change Password</p>
                              <div class="form-group">
                                    <label for="email">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $customer_data['User']['first_name'];?>"  placeholder="" required>
                              </div>

                              <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email"  value="<?php echo $customer_data['User']['email'];?>"   placeholder="" required>
                              </div>                              
							  </div>							  
                                 

                                
                                 
                                 
                              </div>
                              <div class="form-group row col-md-12 col-sm-12 col-xs-12">
							   <button value="register" type="submit" class="cart-button text-uppercase mt-20">Update</button>
                                
                              </div>
                           </form>
                        </div>
                     </div>
					 </div>
            <!--<div class="checkout_details_area checkout-1 mt-50 clearfix">
               <div class="row">
                  <div class="col-md-9">
                    
                     <hr>
                     <div class="billing-details">
                        <div class="shop-form">
                           <?php 
                              $msg = $this->Session->flash(); 
                              echo $msg; 							
                              ?>
                           <form action="" method="post">
                              <input type="hidden" name="mode" value="register">
                              <div class="row clearfix">
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12"> 
                                    <label for="email">New Password</label>						
									<?php echo $this->Form->input('password', array('class' => 'form-control', 'required' => 'required', 'label' => '')); ?> 
                                 </div>
                              </div>
                              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                 <button type="submit" class="cart-button text-uppercase mt-20">Change Password</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>-->
                  <div class="col-md-3">
                     <?php echo $this->element('unknown/myaccount_menu'); ?>				  
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>