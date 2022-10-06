<?php ?>

<div class="checkout-page">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="checkout_details_area checkout-1 mt-50 clearfix">
               <div class="row">
                  <div class="col-md-9">

                     <h2>Update Profile</h2>
                     <hr> 
					<div class="contactinformation">
					<div class="row">
					<div class="col-lg-6">
					<p class="heading">Contact Information</p>
					
					<p><a href="#">Change Password</a></p>
					</div>
					<div class="col-lg-6">
					
					</div>
					<div class="clearfix"></div>
					<div class="col-lg-6">
					<p class="heading">Details Billing Address</p>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					</div>
					<div class="col-lg-6">
					<p class="heading">Details Billing Address</p>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					</div>
					</div>
					</div><!--contactinformation-->



					 
                     <div class="billing-details contactinformation">
                        <div class="shop-form">
						
									<p class="heading">Details Billing Address</p>
                           
								<?php 
								$msg = $this->Session->flash(); 
								echo $msg; 							
								?>
							 <?php echo $this->Form->create('User'); ?>
							 <input type="hidden" name="mode" value="register">
                              <div class="row clearfix">
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
									<div class="row">
									<div class="col-lg-3">
                                    <label for="email">First Name</label>
									</div>
									<div class="col-lg-9">
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $customer_data['User']['first_name'];?>"  placeholder="" required>
									</div>
									</div>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
								 <div class="row">
								 <div class="col-lg-3">
                                    <label for="email">Last Name</label>
									</div>
									<div class="col-lg-9">
                                    <input type="text" name="last_name" class="form-control"  value="<?php echo $customer_data['User']['last_name'];?>"    placeholder="">
									</div>
								</div>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email"  value="<?php echo $customer_data['User']['email'];?>"   placeholder="" required>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="email">Phone</label>
                                    <input type="text" name="phone" class="form-control"  value="<?php echo $customer_data['User']['phone'];?>"   placeholder="" required>
                                 </div>
                                 
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="email">Address Line 1</label>
                                    <input type="text" name="address" class="form-control"   value="<?php echo $customer_data['User']['address'];?>"   placeholder="">
                                 </div>
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="email">Address Line 2</label>
                                    <input type="text" name="address2" class="form-control"   value="<?php echo $customer_data['User']['address2'];?>"   placeholder="">
                                 </div>
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="email">City</label>
                                    <input type="text" name="city" class="form-control"   value="<?php echo $customer_data['User']['city'];?>"   placeholder="">
                                 </div>
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="email">State</label>
                                    <input type="text" name="state" class="form-control"  value="<?php echo $customer_data['User']['state'];?>" placeholder="">
                                 </div>
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="Country">Country</label>
                                    <select  name="country" class="form-control">
                                       <option value="">Select Country</option>
                                       <?php foreach ($countries as $item): ?>
                                       <option value="<?php echo $item['Country']['name'];?>" <?php if($item['Country']['name'] == $customer_data['User']['country']) { echo "selected"; } ?>><?php echo $item['Country']['name'];?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="Zip">Zip / Postal Code</label>
                                    <input type="text" name="zipcode"  value="<?php echo $customer_data['User']['zipcode'];?>"   placeholder="">
                                 </div>
                              </div>
                              <div class="form-group col-md-12 col-sm-12 col-xs-12">
							   <button value="register" type="submit" class="cart-button text-uppercase mt-20">Update</button>
                                
                              </div>
                           </form>
                        </div>
                     </div>
					  
                  </div>
                  <div class="col-md-3">
				  <?php echo $this->element('unknown/myaccount_menu'); ?>				  
                    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
 