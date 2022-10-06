<?php echo $this->render('order');  ?>
<title><?php echo $company_name;?> - Invoice : <?php echo '#digidiya/'.date('Y');?>/<?php echo $order['Order']['id'];?></title>
<table >
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
<b>Order ID : <?php echo '#digidiya/'.date('Y');?>/<?php echo $invoice_number;?></b><br />
<b>Date : <?php echo date('F d Y', strtotime($order['Order']['created']));?></b><br />

</td>
</tr>
</tbody>
</table>
<style>
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
}
</style>
<table>
<thead>
<tr>
<td><b>S.No.</b></td>
<td><b>Product Name</b></td>

<td ><b>Unit Price</b></td>
<td ><b>Total</b></td>
</tr>
</thead>
<tbody>
<tr>
<td><b>1</b></td>
<td ><?php echo $order['Product']['name']; ?></td>
<td ><b>INR. <?php echo $order['Order']['total']; ?></b></td>
<td >INR. <?php echo $order['Order']['subtotal']; ?></td>
</tr>
<!--
<tr>
<td class='text-right' colspan='5'><b>Sub-Total</b></td>
<td class='text-right'>$100.00</td>
</tr>-->

</tbody>
</table>
