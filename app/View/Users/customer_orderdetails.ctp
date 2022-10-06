<?php /* ?>
            <div class="signle-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="shop-head-menu">
                                <ul>
                                    <li><i class="fa fa-home"></i><a class="shop-home" href="<?php echo $this->webroot;?>"><span>Home</span></a><span><i class="fa fa-angle-right"></i></span></li>
                                    <li class="shop-pro">Order Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

 
  <div class="container">
  
  <div class="row">
<div class="buttons-cart pull-left"><h1>Order Details</h1></div>
<div class="buttons-cart pull-right"> 											 
<a href="customer/orderhistory" class="btn-round btn-light">Back to Order History</a>	
</div>
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
        &nbsp; </div>
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
  </div>
  
 
</div>
 
  <div class="container">
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    Order Notes : <?php echo $order_data['Order']['order_notes'];?>  
   </div>
	</div>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-content table-responsive">
          <table>
            <thead>
              <tr>
                <th class="product-thumbnail">Image</th>
                <th class="product-name">Item</th>
                <th class="product-price">Price</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-subtotal">Total</th>
              </tr>
            </thead>
            <tbody>
<?php 

foreach ($order_data['OrderItem'] as $item): 
 
$frontImageurl  = $this->Html->url('/images/products/'.$item['Product']['image']);
   
?>
              <tr>
                <td class="product-name">
                <a href="products/category/<?php echo $item['Product']['slug'];?>">
                 <img src="<?php echo $frontImageurl;?>" alt="<?php echo $item['name'];?>" />
                 </a>
                 </td>
                <td class="product-name"><?php echo $item['name'];?>
                  <?php if($item['size']) { ?>
                  <br>
                  Size : <?php echo $item['size'];?>
                  <?php } ?>
                  <?php if($item['color']) { ?>
                  <br>
                  Color : <?php echo $item['color'];?>
                  <?php } ?>
                </td>
                <td class="product-price"><span class="amount"><?php echo $item['price'];?> </span></td>
                <td class="product-quantity"><?php echo $item['quantity']; ?> </td>
                <td class="product-subtotal"><?php echo $item['subtotal'];?> </td>
              </tr>
              <?php endforeach; ?>              
              <tr>
                <td class="product-name"></td>
                <td class="product-name"></td>
                <td class="product-price"><span class="amount"></span></td>
                <td class="product-quantity">Order Total :</td>
                <td class="product-subtotal">&pound<?php echo $order_data['Order']['total']; ?> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
 
<?php 
*/ 
?>
 

<div class="shopping-cart-page">
   <div class="auto-container">
     
      <section class="shopping-cart cart-section">
         <div class="group-title">
            <h2>Your Order</h2>
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
                           
                           <th>Total</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        <?php 


 
$frontImageurl  = $this->Html->url('/images/products/'.$order_data['Product']['image']);
   $key = $order_data['Product']['id'];
?>
                        <tr id="row-<?php echo $key; ?>">
                           <td class="prod-column" colspan="2">
                              <figure class="prod-thumb">   
								<a href="product/<?php echo $order_data['Product']['slug']; ?>.html">                              
                                 <?php echo $this->Html->image('/images/products/' . $order_data['Product']['image'], ['class' => 'px60']); ?>
								 </a>
                              </figure>
                              <div class="prod-info">
                                 <h3 class="prod-title"><a href="product/<?php echo $order_data['Product']['slug']; ?>.html"><?php echo $order_data['Product']['name'];?></a></h3>
                                
                                
                              </div>
                           </td>
                           <td class="price" id="price-<?php echo $key; ?>"><span class="fa fa-inr"></span><?php echo $order_data['Order']['total']; ?></td>
                           <td class="qty">										 
                          								 
                           </td>
                           <td class="sub-total" id="subtotal_<?php echo $key; ?>"><span class="fa fa-inr"></span><?php echo $order_data['Order']['subtotal']; ?></td>
                           
                        </tr>
                       
						
						 <tr>
            <td class="text-right" colspan="4"><strong>Order Total:</strong></td>
            <td class="sub-total"><span class="fa fa-inr"></span><?php echo $order_data['Order']['subtotal']; ?></td>
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