<?php ?>
<section class="page-info">
   <div class="image-layer" style="background-image:url(images/background/page-title-1.png);"></div>
   <div class="auto-container">
      <h2>Order Confirmation</h2>
      <ul class="bread-crumb clearfix">
         <li><a href="<?php echo $this->webroot;?>">Home</a></li>
		  <li><a href="<?php echo $this->webroot;?>customer/myaccount">My Account</a></li>
         <li class="active">Order Confirmation</li>
      </ul>
   </div>
</section> 
<div class="shopping-cart-page">
   <div class="auto-container">
          <div class="row clearfix">
                                <div class="col-12">
                    <div class="order_complated_area clearfix">
                        <h5><?php 
                              $msg = $this->Session->flash(); 
                              echo $msg; 							
                              ?> </h5>
                        <p>You will receive an email with your order details.</p>
                        <p class="orderid">Your PayPal Transaction ID : <?php echo $order_data['Order']['transaction'];?></p>
                    </div>
                </div>
 
                              </div> 
      <section class="shopping-cart cart-section">
         <div class="group-title">
            <h2>Your Order</h2>
         </div>
          <div class="row">
            <div class="col col-sm-4">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Customer Info</h3>
                  </div>
                  <div class="panel-body"> <?php echo $order_data['Order']['first_name'];?> <?php echo $order_data['Order']['last_name'];?><br />
                     Email: <?php echo $order_data['Order']['email'];?><br />
                     Phone: <?php echo $order_data['Order']['phone'];?><br>
                     &nbsp; 
                  </div>
               </div>
            </div>
            <div class="col col-sm-4">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Billing Address</h3>
                  </div>
                  <div class="panel-body"> <?php echo $order_data['Order']['first_name'];?> <?php echo $order_data['Order']['last_name'];?><br />
                     <?php echo $order_data['Order']['billing_address'];?><br />
                     <?php echo $order_data['Order']['billing_address2'];?><br />
                     <?php echo $order_data['Order']['billing_city'];?>, <?php echo $order_data['Order']['billing_state'];?> <?php echo $order_data['Order']['billing_zip'];?><br />
                  </div>
               </div>
            </div>
            <div class="col col-sm-4">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Shipping Address</h3>
                  </div>
                  <div class="panel-body"> <?php echo $order_data['Order']['first_name'];?> <?php echo $order_data['Order']['last_name'];?><br />
                     <?php echo $order_data['Order']['shipping_address'];?><br />
                     <?php echo $order_data['Order']['shipping_address2'];?><br />
                     <?php echo $order_data['Order']['shipping_city'];?>, <?php echo $order_data['Order']['shipping_state'];?> <?php echo $order_data['Order']['shipping_zip'];?><br />
                  </div>
               </div>
            </div>
         </div>
         <!--Cart Column-->
         <div class="cart-column">
            <!--Cart Outer-->
            <div class="cart-outer">
               <div class="table-outer">
                  <table class="cart-table">
                     <thead class="cart-header">
                        <tr>
                           <th class="prod-column">Product</th>
                           <th></th>
                           <th class="price">Unit Price</th>
                           <th>Quantity</th>
                           <th>Total</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        <?php 

foreach ($order_data['OrderItem'] as $item): 
 
$frontImageurl  = $this->Html->url('/images/products/'.$item['Product']['image']);
   $key = $item['Product']['id'];
?>
                        <tr id="row-<?php echo $key; ?>">
                           <td class="prod-column" colspan="2">
                              <figure class="prod-thumb">   
								<a href="<?php echo $item['Product']['slug']; ?>.html">                              
                                 <?php echo $this->Html->image('/images/products/' . $item['Product']['image'], ['class' => 'px60']); ?>
								 </a>
                              </figure>
                              <div class="prod-info">
                                 <h3 class="prod-title"><a href="<?php echo $item['Product']['slug']; ?>.html"><?php echo $item['Product']['name'];?></a></h3>
                                 <?php
                                    $mods = 0;
                                    if(isset($item['Product']['productmod_name'])) :
                                    $mods = $item['Product']['productmod_id'];
                                    ?>
                                 <br />
                                 <small><?php echo $item['Product']['productmod_name']; ?></small>
                                 <?php endif; ?>
                                 <div class="info">Color: <span class="theme_color"><?php echo $item['color']; ?></span>
                                 </div>
								  <div class="info">Size: <span class="theme_color"><?php echo $item['size']; ?></span>
                                 </div>
                              </div>
                           </td>
                           <td class="price" id="price-<?php echo $key; ?>"><span class="fa fa-inr"></span><?php echo $item['price']; ?></td>
                           <td class="qty">										 
                             <?php echo $item['quantity'];?> 									 
                           </td>
                           <td class="sub-total" id="subtotal_<?php echo $key; ?>"><span class="fa fa-inr"></span><?php echo $item['subtotal']; ?></td>
                           
                        </tr>
                        <?php endforeach; ?>
						
						 <tr>
            <td class="text-right" colspan="4"><strong>Order Total:</strong></td>
            <td class="sub-total"><span class="fa fa-inr"></span><?php echo $order_data['Order']['total']; ?></td>
          </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <!--End Cart Column-->
       
         <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="continue-column pull-left clearfix">
                  <a href="<?php echo $this->webroot;?>customer/orderhistory" class="theme-btn btn-style-two proceed-btn">Back to Order History</a>
 
               </div>
                
            </div>
         </div>
		   
      </section>
	   
   </div>
</div>