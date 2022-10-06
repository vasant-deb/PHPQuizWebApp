<?php ?>
<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Categories <?php //echo $title_for_layout?></h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Categories
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Category",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>			
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
            <th>ID</th>
              <th>Name</th>
			  <th>Category</th>
			  <th class="col-md-2">Order</th>
			  <th>Status</th>
              <th class="actions">Actions</th>
              </thead>
            <tbody>
			  <?php foreach ($categories as $category): ?>
              <tr>
				<td><?php echo h($category['Category']['id']); ?></td>
				<td><?php echo h($category['Category']['name']); ?></td>
				<td><?php echo $category['ParentCategory']['name'];?></td>				
				<td class="col-md-2">
				<?php				
 				 
				echo $this->Form->input('category_order', array( 'style' => 'width:50px;', 'label' => '', 'empty'=>false, 'name'=>'data[Category][category_order]', 'default'=>$category['Category']['category_order'], 'class'=>'form-control col-md-2 category_order', 'data-category_id'=>$category['Category']['id']));
				 
 				?>
				</td>
				<td>
				<?php				
 				
				$options = array( '1' => 'Active', '0' => 'Inactive');
				echo $this->Form->select('active', $options, array('empty'=>false, 'name'=>'data[Category][active]', 'default'=>$category['Category']['active'], 'class'=>'form-control ddStatus', 'data-category_id'=>$category['Category']['id']));
				 
 				?>
				</td>
                <td class="actions">
				<div class="action-buttons"> 

				 
				   <?php 
		   echo $this->Html->link("<i class=\"icon-pencil\"></i>",
		   array( 'action' => 'edit', $category['Category']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
			 

<?php 
 /*
echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
array('action' => 'delete', $category['Category']['id']), 
array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $category['Category']['id'])); 
 */
?>

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
        $(document).on('change', '.category_order', function(e) {
            var element = $(this); 
            currentCategory_order = $(this).val(); // Current Status
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller'=>'categories', 'action'=>'change_category_order'))?>', // change_category_order is a Function in controller
                data: 'category_id='+element.data('category_id')+'&category_order='+currentCategory_order,
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
                url: '<?php echo Router::url(array('controller'=>'categories', 'action'=>'change_category_status'))?>', // change_category_status is a Function in controller
                data: 'category_id='+element.data('category_id')+'&status='+currentStatus,
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
