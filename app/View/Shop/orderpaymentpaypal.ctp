<?php
/*

<?php
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id  =  'gaurav.kr0894-facilitator@gmail.com'; // Business email ID
?>
   
   <?php
    
    $order_total = $shop['Order']['total'];
 
    $item_number = $shop['Order']['quantity'];
    $order_id    = $this->Session->read('Shop.Order.order_id'); 
   
    $item_name   = $company_name." Online Shop Order - ".$order_id;
	$currency_code = 'INR';

   ?>		
		
 
<h3>Please wait we are redirecting you to PayPal to complete payment ..... if not redirected please click on Pay Now Button Below.</h3>

<form action="<?php echo $paypal_url; ?>" method="post" id="paypalpayment"> 
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
<input type="hidden" name="item_name" value="<?php echo $item_name;?>">
<input type="hidden" name="item_number" value="<?php echo $item_number;?>">
<input type="hidden" name="amount" value="<?php echo $order_total;?>">
 <input type="hidden" name="no_shipping" value="0">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="<?php echo $currency_code;?>">
<input type="hidden" name="custom" value="<?php echo $order_id;?>">
<input type="hidden" name="cancel_return" value="<?php echo Router::url('/', true);?>shop/cart">
<input type="hidden" name="return" value="<?php echo Router::url('/', true);?>shop/success">
<input type="hidden" name="rm" value="2">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1"> 
</form>
 
 

<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>

<script type="text/javascript"> 

 // $("#paypalpayment").submit();

</script>
*/
?>

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
    
	<input type="hidden" name="custom" value="<?php echo $order_id;?>">
    <input type="hidden" name="amount" value="<?php echo $order_total;?>">
	<input type="hidden" name="rm" value="2">
   
    <input type="hidden" name="currency_code" value="USD">
  
    <input type="hidden" name="cancel_return" value="<?php echo Router::url('/', true);?>shop/cart">
    <input type="hidden" name="return" value="<?php echo Router::url('/', true);?>shop/success">
    <!--<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">-->
    </form> 
    </div>
</div>
 
<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>

<script type="text/javascript"> 

  $("#paypalpayment").submit();

</script>