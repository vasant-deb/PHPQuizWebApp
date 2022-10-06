<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='gaurav.kr0894-facilitator@gmail.com'; // Business email ID
?>
   
   <?php
    
    $order_total = $shop['Order']['total'];
 
    $item_number = $shop['Order']['quantity'];
    $order_id    = $this->Session->read('Shop.Order.order_id'); 
   
    $item_name   = $company_name." Online Shop Order - ".$order_id;
	 
   ?>		
			
   Please wait. You will now be redirected to Paypal to complete the Payment. 
   
    <div class="btn">
    <form id="paypalpayment" action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="<?php echo $item_name;?>">
    <input type="hidden" name="item_number" value="<?php echo $item_number;?>">   
    <!--<input type="hidden" name="userid" value="1">-->
	<input type="hidden" name="custom" value="<?php echo $order_id;?>">
    <input type="hidden" name="amount" value="<?php echo $order_total;?>">
    <!--<input type="hidden" name="cpp_header_image" value="<?php echo Router::url('/', true);?>samatra/images/logo.png">-->
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="INR">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo Router::url('/', true);?>shop/cart">
    <input type="hidden" name="return" value="<?php echo Router::url('/', true);?>shop/success">
    <!--<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">-->
    </form> 
    </div>
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript"> 

 // $("#paypalpayment").submit();

</script>