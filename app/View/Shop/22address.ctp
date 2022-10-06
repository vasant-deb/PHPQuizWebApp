<?php echo $this->Html->script(array('shop_address.js'), array('inline' => false)); ?><?php echo $this->Form->create('Order'); ?>

<div class="signle-heading">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="shop-head-menu">
          <ul>
            <li><i class="fa fa-home"></i><a class="shop-home" href="<?php echo $this->webroot;?>"><span>Home</span></a><span><i class="fa fa-angle-right"></i></span></li>
            <li class="shop-pro">Checkout</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="checkout-area">
  <div class="container">
    <div class="col-md-12">
      <div class="container">
        <div class="col-md-6">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="checkbox-form">
              <h3>Billing Details</h3>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="country-select">
                    <label>Country <span class="required">*</span></label>
                    <select  name="data[Order][billing_country]" required="">
                      <option value="">Select Country</option>
                      <?php foreach ($countries as $item): ?>
                      <option value="<?php echo $item['Country']['name'];?>" <?php if($item['Country']['name'] == 'United Kingdom') { echo "selected"; } ?>><?php echo $item['Country']['name'];?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="checkout-form-list">
                    <label>First Name <span class="required">*</span></label>
                    <?php echo $this->Form->input('first_name', array('value' => $customer_data['User']['first_name'],'class' => 'form-control', 'label' => '')); ?></div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="checkout-form-list">
                  <label>Last Name <span class="required">*</span></label>
                  <?php echo $this->Form->input('last_name', array('value' => $customer_data['User']['last_name'],'class' => 'form-control', 'label' => '')); ?></div>
              </div>
             
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="checkout-form-list">
                <label>Company Name</label>
                <?php echo $this->Form->input('company', array('value' => $customer_data['User']['company'], 'class' => 'form-control', 'label' => '')); ?></div>
            </div>
           
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="checkout-form-list">
              <label>Address <span class="required">*</span></label>
              <?php echo $this->Form->input('billing_address', array('value' => $customer_data['User']['address'],'class' => 'form-control', 'placeholder' => 'Street address', 'label' => '')); ?> </div>
          </div>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="checkout-form-list">
            <div class="input text"><?php echo $this->Form->input('billing_address2', array('value' => $customer_data['User']['address2'],'class' => 'form-control' , 'placeholder' => 'Apartment, suite, unit etc. (optional)', 'label' => '')); ?> </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="checkout-form-list">
            <label>Town / City <span class="required">*</span></label>
            <?php echo $this->Form->input('billing_city', array('value' => $customer_data['User']['city'],'class' => 'form-control', 'label' => '')); ?> </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="checkout-form-list">
            <label>State / County <span class="required">*</span></label>
            <?php echo $this->Form->input('billing_state', array('value' => $customer_data['User']['state'],'class' => 'form-control', 'label' => '')); ?> </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="checkout-form-list">
            <label>Postcode / Zip <span class="required">*</span></label>
            <?php echo $this->Form->input('billing_zip', array('value' => $customer_data['User']['zipcode'],'class' => 'form-control', 'label' => '')); ?> </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="checkout-form-list">
            <label>Email Address <span class="required">*</span></label>
            <?php echo $this->Form->input('email', array('value' => $customer_data['User']['email'], 'class' => 'form-control', 'label' => '')); ?> </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="checkout-form-list">
            <label>Phone <span class="required">*</span></label>
            <?php echo $this->Form->input('phone', array('type' => 'text', 'value' => $customer_data['User']['phone'],'class' => 'form-control', 'label' => '')); ?> </div>
        </div>
      
      <div class="ship-different-title">
        <h3>
          <label>Copy Billing Address to Shipping <?php echo $this->Form->input('sameaddress', array('type' => 'checkbox', 'label' => '')); ?> </label>
        </h3>
      </div>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="different-address">
    <div id="xship-box-info" class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="country-select">
          <label>Country <span class="required">*</span></label>
          <select name="data[Order][shipping_country]" required="">
            <option value="">Select Country</option>
            <?php foreach ($countries as $item): ?>
            <option value="<?php echo $item['Country']['name'];?>" <?php if($item['Country']['name'] == 'United Kingdom') { echo "selected"; } ?>><?php echo $item['Country']['name'];?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="checkout-form-list">
          <label>First Name <span class="required">*</span></label>
          <?php echo $this->Form->input('shipping_first_name', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="checkout-form-list">
          <label>Last Name <span class="required">*</span></label>
          <?php echo $this->Form->input('shipping_last_name', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="checkout-form-list">
          <label>Company Name</label>
          <?php echo $this->Form->input('shipping_company', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="checkout-form-list">
          <label>Address <span class="required">*</span></label>
          <?php echo $this->Form->input('shipping_address', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="checkout-form-list"> <?php echo $this->Form->input('shipping_address2', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="checkout-form-list">
          <label>Town / City <span class="required">*</span></label>
          <?php echo $this->Form->input('shipping_city', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="checkout-form-list">
          <label>State / County <span class="required">*</span></label>
          <?php echo $this->Form->input('shipping_state', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="checkout-form-list">
          <label>Postcode / Zip <span class="required">*</span></label>
          <?php echo $this->Form->input('shipping_zip', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="checkout-form-list">
          <label>Email Address <span class="required">*</span></label>
          <?php echo $this->Form->input('shipping_email', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="checkout-form-list">
          <label>Phone <span class="required">*</span></label>
          <?php echo $this->Form->input('shipping_phone', array('class' => 'form-control', 'label' => '')); ?> </div>
      </div>
    </div>
    <div class="order-notes">
      <div class="checkout-form-list">
        <label>Order Notes</label>
        <textarea id="checkout-mess" name="data[Order][order_notes]" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="your-order">
    <h3>Your order</h3>
    <div class="table-content table-responsive">
      <table>
        <thead>
          <tr>
            <th class="product-thumbnail">Image</th>
            <th class="product-name">Product</th>
            <th class="product-price">Price</th>
            <th class="product-quantity">Quantity</th>
            <th class="product-subtotal">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
				foreach ($shop['OrderItem'] as $key => $item):
				$frontImageurl  = $this->Html->url('/images/products/'.$item['Product']['image']);

				?>
          <tr id="row-<?php echo $key; ?>">
            <td class="product-thumbnail"><a href="products/category/<?php echo $item['Product']['slug'];?>"> <img src="<?php echo $frontImageurl;?>" alt="<?php echo $item['Product']['name'];?>" /> </a> </td>
            <td class="product-name"><a href="products/category/<?php echo $item['Product']['slug'];?>"><?php echo $item['Product']['name'];?> </a>
              <?php if($item['size']) { ?>
              <br>
              <small> Size : <?php echo $item['size'];?></small>
              <?php } ?>
              <?php if($item['color']) { ?>
              <br>
              <small>Finishes : <?php echo $item['color'];?></small>
              <?php } ?>
            </td>
            <td class="product-price"><span class="amount" id="price-18_0">$ <?php echo $item['price'];?> </span></td>
            <td class="product-quantity"><?php echo $item['quantity'];?> </td>
            <td class="product-subtotal" id="subtotal_18_0">$ <?php echo $item['subtotal'];?></td>
          </tr>
          <?php endforeach; ?>
          <tr>
            <td class="text-right" colspan="4"><strong>Order Total:</strong></td>
            <td class="text-right">$ <?php echo $shop['Order']['total']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="payment-method">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="text-center">
          <input type="submit" value="Place order" id="btn-confirm" class="order-btn">
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirm</h4>
      </div>
      <div class="modal-body">
        <p class="text-modal"> This is not the final price, we will contact you regarding delivery charges and once you approve it, we will send you the final bill. Thanks </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="modal-btn-si">Yes</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
      </div>
    </div>
  </div>
</div>
<script>
	var modalConfirm = function(callback){
  
  $("#btn-confirm").on("click", function(){	  
    $("#mi-modal").modal('show');
  });

  $("#modal-btn-si").on("click", function(){
    callback(true);
    $("#mi-modal").modal('hide');
  });
  
  $("#modal-btn-no").on("click", function(){
    callback(false);
    $("#mi-modal").modal('hide');
  });
};

modalConfirm(function(confirm){
  if(confirm){    
	$('#OrderAddressForm').submit();
   // $("#result").html("Yes confirm");
  }else{
  
  //  $("#result").html("No confirm");
  }
});
</script>
<div class="alert" role="alert" id="result"></div>
