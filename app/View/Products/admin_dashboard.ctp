<div class="container-fluid main-content">
<!-- Statistics -->
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container stats-container">
      <div class="col-md-3">
        <div class="number">
          <a href="admin/products"><div class="icon-th-large text-danger"></div></a>
          <?php echo $total_products;?></div>
        <div class="text">
          <h3>Products</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="number">
         <a href="admin/users/"><div class="icon-group"></div></a>
           <?php echo $total_users;?></div>
        <div class="text">
          <h3>Members</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="number">
           <a href="admin/"><div class="icon-shopping-cart text-success"></div></a>
          <small></small> <?php echo $total_orders;?></div>
        <div class="text">
          <h3> Sales</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="number">
          <a href="admin/enquiries"><div class="icon-envelope text-warning"></div></a>
          <?php echo $total_enquiries;?></div>
        <div class="text">
          <h3> Enquiries</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Statistics -->
<div class="row">
<div class="col-lg-12">
<div class="container-fluid main-content">
<div class="page-title">
  <h1> Orders
    <?php //echo $title_for_layout?>
  </h1>
</div>
<!-- DataTables Example -->
<div class="row">
<div class="col-lg-12">
  <div class="widget-container fluid-height clearfix">
    <div class="heading"> <i class="icon-table"></i>Manage Orders </div>
    <div class="widget-content padded clearfix">
      <table class="table table-bordered table-striped" id="dataTable1">
        <thead>
        <th width="75px;">S. No.</th>
          <th>Customer Info</th> 
          <th width="100px;"> Items</th>
		   <th> Total</th>
          <th>Status </th>
		   <th>Order Type </th>
          <th>Order Date</th>
          <th class="actions">Actions</th>
          </thead>
        <tbody>
     <?php 	 
	  
	 /*
	 Pending 0
	 Confirmed 4
	 Cancelled 3
	 Shipped 2
	 Completed 1
	 */	
			
	$order_no = 0;
	
	 foreach ($orders as $order): 
	 $order_no++;
	 
	  $order_status = $order['Order']['status'];
	  $txt_status = "";
	  
	  if($order_status == 1) {
	  
	  $txt_status = "Completed";
	  }
	  else {
	  $txt_status = "Pending";
	  }
	  
	?>
          <tr>
            <td><?php echo $order_no; ?></td>
            <td>
			<p>Name : <?php echo h($order['Order']['first_name']); ?> <?php echo h($order['Order']['last_name']); ?></p>
			<p> Email : <?php echo h($order['Order']['email']); ?></p>
			<p> Phone : <?php echo h($order['Order']['phone']); ?></p>
			</td>
            <td><?php echo h($order['Order']['order_item_count']); ?></td>
            <td><span class="icon icon-inr"></span><?php echo h($order['Order']['total']); ?></td>
            <td>
            <?php				
 				
				/*
				$options = array( '0' => 'Pending','2' => 'Shipped','1' => 'Completed', '3' => 'Cancelled');
				echo $this->Form->select('active', $options, array('empty'=>false, 'name'=>'data[Order][status]', 'default'=>$order['Order']['status'], 'class'=>'form-control ddStatus', 'data-order_id'=>$order['Order']['id']));
				*/
				
				echo $txt_status;
				 
				 
				 
				$order_date = date('m/d/Y h:i:s', strtotime($order['Order']['created']));
 				?>
            </td>
			
			 <td><?php echo strtoupper($order['Order']['order_type']);?> </td>
            <td><?php echo $order_date; ?></td>
            <td class="actions">   
			 
			  <?php  //echo $this->Html->link('View', array('controller' => 'orders', 'action' => 'view', $order['Order']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			  <div class="action-buttons"> 		
			  
			    <?php 
		   echo $this->Html->link("<i class=\"icon-eye-open\"></i>",
		   array( 'controller' => 'orders', 'action' => 'view', $order['Order']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
			  	  <?php 
		   echo $this->Html->link("<i class=\"icon-print text-danger\"></i>",
		   array( 'controller' => 'orders','action' => 'invoice', $order['Order']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
			</div>
			
              <?php //echo $this->Html->link('Edit', array('action' => 'edit', $order['Order']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <script type="text/javascript">     
        $(document).on('change', '.ddStatus', function(e) {
            var element = $(this); 
            currentStatus = $(this).val(); 
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller'=>'orders', 'action'=>'change_order_status'))?>', 
                data: 'order_id='+element.data('order_id')+'&status='+currentStatus,
                success: function(jsonResponse) {
                    var response = $.parseJSON(jsonResponse);
                    if(response.status != 'success')
                    {
                        element.val(!currentStatus);
                    }
                    
                    alert(response.message);
                    }
                });
            });            
  </script>
      <script>
$('#flashMessage').addClass('alert alert-success');
</script>
    </div>
  </div>
</div>
