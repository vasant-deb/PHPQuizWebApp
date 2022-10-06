<?php
 
$order_total = $shop['Order']['total'];


$order_id    = $this->Session->read('Shop.Order.order_id'); 

$item_name   = $company_name." Online Shop Order - ".$order_id;
	
$billing_name     =	 $shop['Order']['first_name'].' '.$shop['Order']['last_name'];

$billing_country  =	 $shop['Order']['billing_country'];
$billing_tel      =	 $shop['Order']['phone'];
$billing_email    =	 $shop['Order']['email'];


?>		
			
   Please wait. You will now be redirected to CCAvennue Gateway to complete the Payment. 
	
	<form id="paypalpayment" method="post" name="customerData" action="<?php echo Router::url('/', true);?>shop/payment">

	<input type="hidden" id="billName" name="billing_name" value="<?php echo $billing_name;?>">    


	<input type="hidden" id="billCountry" name="billing_country" value="<?php echo $billing_country;?>">

	<input type="hidden" id="billTel" name="billing_tel" value="<?php echo $billing_tel;?>">

	<input type="hidden" id="billEmail" name="billing_email" value="<?php echo $billing_email;?>">	
		

	<input type="hidden" id="merchant_param1" name="merchant_param1" value="<?php echo $item_name;?>">

	<input type="hidden" id="amount" name="amount" readonly value="<?php echo $order_total;?>">

	<input type="hidden" name="tid" id="tid" readonly />
	<input type="hidden" name="merchant_id" value="188746"/>
	<input type="hidden" name="order_id" value="<?php echo $order_id;?>"/>

	<input type="hidden" name="currency" id="currency" value="INR"/>
	<input type="hidden" name="redirect_url" value="<?php echo Router::url('/', true);?>shop/payment"/>
	<input type="hidden" name="cancel_url" value="<?php echo Router::url('/', true);?>shop/success"/>
	<input type="hidden" name="language" value="EN"/>
				
   
    </form> 
    </div>
</div>
 
<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>

<script type="text/javascript"> 

  $("#paypalpayment").submit();

</script>