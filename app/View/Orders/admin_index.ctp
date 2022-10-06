<?php ?>
<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Orders <?php //echo $title_for_layout?></h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Orders
           </div>
        <div class="widget-content padded clearfix">
		
          <table class="table table-bordered table-striped" id="dataxTable1">
    <tr>
        <th><?php echo $this->Paginator->sort('first_name'); ?></th>
        <th><?php echo $this->Paginator->sort('last_name'); ?></th>
        <th><?php echo $this->Paginator->sort('email'); ?></th>
        <th><?php echo $this->Paginator->sort('phone'); ?></th>
 
        <th><?php echo $this->Paginator->sort('order_item_count'); ?></th> 
        <th><?php echo $this->Paginator->sort('total'); ?></th>
        <th><?php echo $this->Paginator->sort('status'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th>Actions</th>
    </tr>
    <?php 
	 
	 /*
	 Pending 0
	 Confirmed 4
	 Cancelled 3
	 Shipped 2
	 Completed 1
	 */
	 
				
				
	 foreach ($orders as $order): 
	 
	  $order_status = $order['Order']['status'];
	  $txt_status = "";
	  
	  if($order_status == 1) {
	  
	  $txt_status = "Processed";
	  }
	  else {
	  $txt_status = "Pending";
	  }
	  
	?>
    <tr>
        <td><?php echo h($order['Order']['first_name']); ?></td>
        <td><?php echo h($order['Order']['last_name']); ?></td>
        <td><?php echo h($order['Order']['email']); ?></td>
        <td><?php echo h($order['Order']['phone']); ?></td>
         <td><?php echo h($order['Order']['order_item_count']); ?></td>
         <td><?php echo h($order['Order']['total']); ?></td>
        <td>
		
		
	 <?php				
 				
				$options = array( '0' => 'Pending','2' => 'Shipped','1' => 'Completed', '3' => 'Cancelled');
				echo $this->Form->select('active', $options, array('empty'=>false, 'name'=>'data[Order][status]', 'default'=>$order['Order']['status'], 'class'=>'form-control ddStatus', 'data-order_id'=>$order['Order']['id']));
				//(user_status) This is a field in database
 
 				?>
		</td>
        <td><?php echo h($order['Order']['created']); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('View', array('action' => 'view', $order['Order']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php //echo $this->Html->link('Edit', array('action' => 'edit', $order['Order']['id']), array('class' => 'btn btn-default btn-xs')); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

 </div>
      </div>
    </div>
  </div>
  <!-- end DataTables Example -->
</div>
   
 
 
 
 <script type="text/javascript">     
        $(document).on('change', '.ddStatus', function(e) {
            var element = $(this); 
            currentStatus = $(this).val(); //User Current Status
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller'=>'orders', 'action'=>'change_order_status'))?>', //change_order_status is a Function in controller
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
 
 
 