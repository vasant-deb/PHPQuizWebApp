<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Site Social Icons <?php //echo $title_for_layout?></h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Social Icons
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Social Icon",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
			  <th width="5%">ID</th>
               <th width="50%">Name</th>
			   <th>Order</th>
			   <th>Status</th>
               <th class="actions">Actions</th>
              </thead>
            <tbody>
			<?php foreach ($socialicons as $page): ?>
              <tr>
				<td><?php echo h($page['Socialicon']['id']); ?></td>
				<td><?php echo h($page['Socialicon']['name']); ?></td>		
				<td class="col-md-2">
				<?php				
 				 
				echo $this->Form->input('socialicon_order', array( 'style' => 'width:50px;', 'label' => '', 'empty'=>false, 'name'=>'data[Socialicon][socialicon_order]', 'default'=>$page['Socialicon']['socialicon_order'], 'class'=>'form-control col-md-2 socialicon_order', 'data-socialicon_id'=>$page['Socialicon']['id']));
				 
 				?>
				</td>
				<td>
				<?php				
 				
				$options = array( '1' => 'Active', '0' => 'Inactive');
				echo $this->Form->select('active', $options, array('empty'=>false, 'name'=>'data[Socialicon][active]', 'default'=>$page['Socialicon']['active'], 'class'=>'form-control ddStatus', 'data-socialicon_id'=>$page['Socialicon']['id']));
				 
 				?>
				</td>
                <td class="actions">
				<div class="action-buttons"> 			 		
 				 
				<?php  
				
				echo $this->Html->link("<i class=\"icon-pencil\"></i>",
				array( 'action' => 'edit', $page['Socialicon']['id']),
				array('escape' => FALSE,'class' => 'table-actions')); 
				
				?>

				<?php /*echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
				array('action' => 'delete', $page['Socialicon']['id']), 
				array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $page['Category']['id'])); */ ?>

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
        $(document).on('change', '.socialicon_order', function(e) {
            var element = $(this); 
            currentSocialicon_order = $(this).val(); // Current Status
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller'=>'socialicons', 'action'=>'change_socialicon_order'))?>', // change_category_order is a Function in controller
                data: 'socialicon_id='+element.data('socialicon_id')+'&socialicon_order='+currentSocialicon_order,
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
                url: '<?php echo Router::url(array('controller'=>'socialicons', 'action'=>'change_socialicon_status'))?>', // change_socialicon_status is a Function in controller
                data: 'socialicon_id='+element.data('socialicon_id')+'&status='+currentStatus,
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
 