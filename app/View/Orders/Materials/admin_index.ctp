<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Materials  </h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Materials
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Material",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
            <th>ID</th>
              <th>Name</th> 
			  <th class="col-md-2">Status</th>	
              <th class="actions">Actions</th>
              </thead>
            <tbody>
              <?php foreach ($sizes as $item): ?>
              <tr>
                <td><?php echo h($item['Material']['id']); ?></td>
                <td><?php echo h($item['Material']['name']); ?></td> 
				 <td>
				<?php				
 				
				$options = array( '1' => 'Active', '0' => 'Inactive');
				echo $this->Form->select('active', $options, array('empty'=>false, 'name'=>'data[Material][active]', 'default'=>$item['Material']['active'], 'class'=>'form-control ddStatus', 'data-size_id'=>$item['Material']['id']));
				 
 				?>
				</td>
                <td class="actions">
				<div class="action-buttons"> 
				 
				   <?php 
		   echo $this->Html->link("<i class=\"icon-pencil\"></i>",
		   array( 'action' => 'edit', $item['Material']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
		 

<?php echo $this->Form->postLink("<i class=\"icon-trash\"></i>", array('action' => 'delete', $item['Material']['id']), array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $item['Material']['id'])); ?>

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
  
   
    <script type="text/javascript">     
        $(document).on('change', '.ddStatus', function(e) {
            var element = $(this); 
            currentStatus = $(this).val(); // Current Status
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller'=>'materials', 'action'=>'change_size_status'))?>', // change_size_status is a Function in controller
                data: 'size_id='+element.data('size_id')+'&status='+currentStatus,
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

  