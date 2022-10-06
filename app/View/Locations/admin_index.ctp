<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Locations <?php //echo $title_for_layout?></h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Locations
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Location",
		   array( 'action' => 'add', $parent_id, 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
			   <?php 
			   if($parent_id > 0) {
		   echo $this->Html->link("<i class=\"icon-table\"></i>Parent Location",
		   array( 'action' => 'index', @$category_details['Location']['parent_id'], 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			}
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
            <th>ID</th>
              <th>Location Name</th>
			  <th>Location</th>
			  <th class="col-md-2">Order</th>
			  <th>Status</th>
              <th class="actions">Actions</th>
              </thead>
            <tbody>
			  <?php foreach ($locations as $location): ?>
              <tr>
				<td><?php echo h($location['Location']['id']); ?></td>
				<td><?php echo h($location['Location']['name']); ?></td>
				<td>
				<?php // echo $this->Html->link($location['ParentLocation']['name'], array('controller' => 'categories', 'action' => 'view', $location['ParentLocation']['id'])); ?>
				</td>
				
				<td class="col-md-2">
				<?php				
 				 
				echo $this->Form->input('location_order', array( 'style' => 'width:50px;', 'label' => '', 'empty'=>false, 'name'=>'data[Location][location_order]', 'default'=>$location['Location']['location_order'], 'class'=>'form-control col-md-2 location_order', 'data-location_id'=>$location['Location']['id']));
				 
 				?>
				</td>
				<td>
				<?php				
 				
				$options = array( '1' => 'Active', '0' => 'Inactive');
				echo $this->Form->select('active', $options, array('empty'=>false, 'name'=>'data[location][active]', 'default'=>$location['Location']['active'], 'class'=>'form-control ddStatus', 'data-location_id'=>$location['Location']['id']));
				 
 				?>
				</td>
                <td class="actions">
				<div class="action-buttons"> 
			 
				
				  <?php 
		   echo $this->Html->link("<i class=\"icon-sitemap\"></i>",
		   array( 'action' => 'index', $location['Location']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
				 
				   <?php 
		   echo $this->Html->link("<i class=\"icon-pencil\"></i>",
		   array( 'action' => 'edit', $location['Location']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
			 

<?php echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
array('action' => 'delete', $location['Location']['id']), 
array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $location['Location']['id'])); ?>

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
   

<?php //echo $this->Tree->generate($categoriestree, array('element' => 'categories/tree_item', 'class' => 'categorytree', 'id' => 'categorytree')); ?>
<script>
$('#flashMessage').addClass('alert alert-success');
</script>
 
 
 
 <script type="text/javascript">     
        $(document).on('change', '.location_order', function(e) {
            var element = $(this); 
            currentLocation_order = $(this).val(); // Current Status
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller'=>'locations', 'action'=>'change_location_order'))?>', // change_location_order is a Function in controller
                data: 'location_id='+element.data('location_id')+'&location_order='+currentLocation_order,
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
 
 
 <script type="text/javascript">     
        $(document).on('change', '.ddStatus', function(e) {
            var element = $(this); 
            currentStatus = $(this).val(); // Current Status
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller'=>'locations', 'action'=>'change_location_status'))?>', // change_location_status is a Function in controller
                data: 'location_id='+element.data('location_id')+'&status='+currentStatus,
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
