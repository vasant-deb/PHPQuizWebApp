<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Site Pages <?php //echo $title_for_layout?></h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Sitepages
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Sitepage",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
			  <th width="5%">ID</th>
               <th width="70%">Name</th>
               <th class="actions">Actions</th>
              </thead>
            <tbody>
			<?php foreach ($pages as $page): ?>
              <tr>
				<td><?php echo h($page['Sitepage']['id']); ?></td>
				<td><?php echo h($page['Sitepage']['name']); ?></td>		
                <td class="actions">
				<div class="action-buttons"> 			 		
 				
				<!--
				<a href="<?php echo $this->webroot;?><?php echo $page['Sitepage']['slug'];?>" target="_blank" class="table-actions"><i class="icon-eye-open"></i></a>	
				-->
				
				<?php  
				
				echo $this->Html->link("<i class=\"icon-pencil\"></i>",
				array( 'action' => 'edit', $page['Sitepage']['id']),
				array('escape' => FALSE,'class' => 'table-actions')); 
				
				?>

				<?php /*echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
				array('action' => 'delete', $page['Sitepage']['id']), 
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
 
 