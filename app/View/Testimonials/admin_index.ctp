<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Testimonials  </h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Testimonials
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Testimonial",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
            <th>ID</th>
              <th>Name</th> 
			  <th>Designation</th>
			  <th>Status</th>	
              <th class="actions">Actions</th>
              </thead>
            <tbody>
              <?php foreach ($testimonials as $item): ?>
              <tr>
                <td><?php echo h($item['Testimonial']['id']); ?></td>
                <td><?php echo h($item['Testimonial']['name']); ?></td> 
				 <td><?php echo h($item['Testimonial']['designation']); ?></td> 
				  <td>
				<?php				
 				
				$options = array( '1' => 'Active', '0' => 'Inactive');
				echo $this->Form->select('active', $options, array('empty'=>false, 'name'=>'data[Testimonial][active]', 'default'=>$item['Testimonial']['active'], 'class'=>'form-control ddStatus', 'data-testimonial_id'=>$item['Testimonial']['id']));
				 
 				?>
				</td>
                <td class="actions">
				<div class="action-buttons"> 
				 
				   <?php 
		   echo $this->Html->link("<i class=\"icon-pencil\"></i>",
		   array( 'action' => 'edit', $item['Testimonial']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
		 

<?php echo $this->Form->postLink("<i class=\"icon-trash\"></i>", array('action' => 'delete', $item['Testimonial']['id']), array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $item['Testimonial']['id'])); ?>

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
                url: '<?php echo Router::url(array('controller'=>'testimonials', 'action'=>'change_testimonial_status'))?>', // change_testimonial_status is a Function in controller
                data: 'testimonial_id='+element.data('testimonial_id')+'&status='+currentStatus,
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
   