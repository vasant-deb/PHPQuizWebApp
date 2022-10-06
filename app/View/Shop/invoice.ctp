<?php echo $this->render('order');  ?>
<title><?php echo $company_name;?> - Invoice : <?php echo '#Samatra/'.date('Y');?>/<?php echo $order['Order']['id'];?></title>
<table class='table table-bordered'>
<thead>
</thead>
<tbody>
<?php $invoice_number =$order['Order']['id']; ?>
<tr>
<td style='width: 50%;'><address>
<strong><?php echo $company_name;?></strong><br />
<?php echo $company_address;?>
</address>
<b>Phone:</b> <?php echo $company_phone;?><br />
<b>Email:</b> <?php echo $company_email;?><br />
<b>Website:</b> <a href='<?php echo Router::url('/', true);?>' target="_blank"><?php echo $company_name;?></a></td>
<td style='width: 50%;'>
<strong><?php echo $order['Order']['first_name'];?> <?php echo $order['Order']['last_name'];?></strong><br />
<b>Phone:</b><?php echo $order['Order']['phone'];?><br>
<b>Email:</b> <?php echo $order['Order']['email'];?><br /><br />
<b>Order ID : <?php echo '#Samatra/'.date('Y');?>/<?php echo $invoice_number;?></b><br />
<b>Date : <?php echo date('F d Y', strtotime($order['Order']['created']));?></b><br />

</td>
</tr>
</tbody>
</table>
<table class='table table-bordered'>
<thead>
<tr>
<td style='width: 50%;'><b>Billing Address</b></td>
<td style='width: 50%;'><b>Shipping Address</b></td>
</tr>
</thead>
<tbody>
<tr>
<td>
<address>
<?php echo $order['Order']['first_name'];?> <?php echo $order['Order']['last_name'];?><br />
<?php echo $order['Order']['billing_address'];?><br />
<?php echo $order['Order']['billing_address2'];?><br />
<?php echo $order['Order']['billing_city'];?>, <?php echo $order['Order']['billing_state'];?> <?php echo $order['Order']['billing_zip'];?><br />
</address>
</td>
<td>
<address>
<?php echo $order['Order']['first_name'];?> <?php echo $order['Order']['last_name'];?><br />
<?php echo $order['Order']['billing_address'];?><br />
<?php echo $order['Order']['billing_address2'];?><br />
<?php echo $order['Order']['billing_city'];?>, <?php echo $order['Order']['billing_state'];?> <?php echo $order['Order']['billing_zip'];?><br />
</address>
</td>
</tr>
</tbody>
</table>
<table class='table table-bordered'>
<thead>
<tr>
<td><b>S.No.</b></td>
<td><b>Product</b></td>
<td><b>Size</b></td>
<td><b>Color</b></td>
<td class='text-right'><b>Quantity</b></td>
<td class='text-right'><b>Unit Price</b></td>
<td class='text-right'><b>Total</b></td>
</tr>
</thead>
<tbody>

<?php if(count($order['OrderItem']) > 0) { $i = 0; foreach ($order['OrderItem'] as $item): $i++; ?>

<tr>
<td><?php echo $i;?>.</td>
<td><?php echo $item['name']; ?>   
</td>
<td>	 
  
<?php if($item['size']) { ?>

<?php echo $item['size'];?>
<?php } ?>
</td>
<td>
<?php if($item['color']) { ?>

<?php echo $item['color'];?>
<?php } ?>
</td>
<td class='text-right'><?php echo $item['quantity']; ?></td>
<td class='text-right'>INR. <?php echo $item['price']; ?></td>
<td class='text-right'>INR. <?php echo $item['subtotal']; ?></td>
</tr>

<?php endforeach; } ?>
<!--
<tr>
<td class='text-right' colspan='5'><b>Sub-Total</b></td>
<td class='text-right'>$100.00</td>
</tr>-->
<tr>
<td class='text-right' colspan='6'><b>Total</b></td>
<td class='text-right'>INR. <?php echo $order['Order']['total']; ?></td>
</tr>
</tbody>
</table>
<table class='table table-bordered'>
<thead>
<tr>
<td><b>Customer Comment</b></td>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo $order['Order']['order_notes'];?>&nbsp;</td>
</tr>
</tbody>
</table>