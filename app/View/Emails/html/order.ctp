  
 <link href="http://nutritionhouse.co/nutra/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
 <link href="http://nutritionhouse.co/nutra/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" /> 
  
  <!-- End Navigation -->
  <div class="container-fluid main-content">
    <div class="page-title">
      <h1> Invoice </h1>
    </div>
    <div class="invoice">
      <div class="row">
        <div class="col-lg-12">
          <div class="row invoice-header">
            <div class="col-md-6"> <img width="183" src="/nutra/img/upload_images/logo.png" /> </div>
            <div class="col-md-6 text-right">
              <h2> #NH-<?php echo date('Y');?>-<?php echo $order_id;?> </h2>
              <p> <?php echo date('d-M-Y');?> </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="well"> <strong>TO</strong>
            <h3> <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?> </h3>
			<p> 
			<?php echo $shop['Order']['billing_address'];?><br>
			<?php echo $shop['Order']['billing_address2'];?><br>
			<?php echo $shop['Order']['billing_city'];?><br>
			<?php echo $shop['Order']['billing_state'];?><br>
			<?php echo $shop['Order']['billing_zip'];?><br>
			<?php echo $shop['Order']['phone'];?><br>
			<?php echo $shop['Order']['email'];?>
			</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="well"> <strong>FROM</strong>
            <h3> <?php echo $company_name;?> </h3>
            <p> 
			  <?php echo $company_address;?><br>
              <?php echo $company_phone;?><br>
              <?php echo $company_email;?>
		   </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="widget-container fluid-height">
            <div class="widget-content padded clearfix">
              <table class="table table-striped invoice-table">
                <thead>
                <th width="50"></th>
                  <th> Product </th>
                  <th width="70"> Qty </th>
                  <th width="100"> Unit Price </th>
                  <th width="100"> Total </th>
                  </thead>
                <tbody>
				
				<?php 
				$pd = 0;
				foreach ($shop['OrderItem'] as $orderitem): 
				$pd++;
				?>

                  <tr>
                    <td> #<?php echo $pd;?>. </td>
                    <td> <?php echo $orderitem['Product']['name']; ?></td>
                    <td><?php echo $orderitem['quantity']; ?></td>
                    <td><?php echo $orderitem['Product']['price']; ?></td>
                    <td><?php echo $orderitem['subtotal']; ?></td>
                  </tr>
				  <?php endforeach; ?>
                 </tbody>
                <tfoot>
                  <tr>
                    <td class="text-right" colspan="4"><strong>Subtotal</strong> </td>
                    <td> <?php echo $shop['Order']['total'];?> </td>
                  </tr>
                  <tr>
                    <td class="text-right" colspan="4"><strong>Tax</strong> </td>
                    <td> 0.00 </td>
                  </tr>
                  <tr>
                    <td class="text-right" colspan="4"><strong>Shipping</strong> </td>
                    <td> 0.00 </td>
                  </tr>
                  <tr>
                    <td class="text-right" colspan="4"><h4 class="text-primary"> Total </h4></td>
                    <td><h4 class="text-primary"> <?php echo $shop['Order']['total'];?></h4></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="well"> <strong>NOTES</strong>
            <p> Thank you for your Order.You Order will be shipped soon. </p>
          </div>
        </div>
      </div> 
    </div>
  </div>
</div> 
