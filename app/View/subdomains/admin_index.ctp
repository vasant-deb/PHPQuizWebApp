<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Subdomains <?php //echo $title_for_layout?></h1>
  </div>
   
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Subdomains
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Subdomain",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
              <th>ID</th>
              <th>Subdomain Name</th>
			  <th>Category</th>
			  <th>Status</th>
              <th class="actions">Actions</th>
              </thead>
            <tbody>
			 	<?php foreach ($products as $product): ?>
              <tr>
				<td><?php echo h($product['Subdomain']['id']); ?></td>
				<td><?php echo h($product['Subdomain']['name']); ?></td>
				<td><?php echo $product['Category']['name']; ?></td>				
				<td><?php	
			$options = array( '1' => 'Active', '0' => 'Inactive');
			echo $this->Form->select('active', $options, array('empty'=>false, 'name'=>'data[Subdomain][active]', 'default'=>$product['Subdomain']['active'], 'class'=>'form-control ddStatus', 'data-subdomain_id'=>$product['Subdomain']['id']));
			?>
			</td>	
		
            <td class="actions">
		   <div class="action-buttons"> 		
		   <?php 
		   echo $this->Html->link("<i class=\"icon-pencil\"></i>",
		   array( 'action' => 'edit', $product['Subdomain']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
		  ?>
			 

<?php echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
array('action' => 'delete', $product['Subdomain']['id']), 
array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $product['Subdomain']['id'])); ?>

			</div>
				 </td>
              
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- end DataTables Example -->
</div>   

<script>
$('#flashMessage').addClass('alert alert-success');
</script>  

 <script type="text/javascript">     
        $(document).on('change', '.ddStatus', function(e) {
            var element = $(this); 
            currentStatus = $(this).val(); // Current Status
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller'=>'subdomains', 'action'=>'change_subdomain_status'))?>', 
                data: 'subdomain_id='+element.data('subdomain_id')+'&status='+currentStatus,
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
