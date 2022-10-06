<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Services <?php //echo $title_for_layout?></h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Services
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Service",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
			  <th width="5%">ID</th>
               <th width="20%">Name</th>
			   <th width="20%">Company Name</th>
			   <th width="25%">Image</th>               
               <th class="actions">Actions</th>
              </thead>
            <tbody>
	<?php foreach ($services as $service): ?>
              <tr>
				<td><?php echo h($service['Service']['id']); ?></td>
				<td><?php echo h($service['Service']['name']); ?></td>	
<td>
			<?php echo $this->Html->link($service['Company']['name'], array('controller' => 'companies', 'action' => 'view', $service['Company']['id'])); ?>
		</td>				
				<td  align="center">
				<?php
				
				$thumbImageurl = 'upload_images/'.$service['Service']['image'];
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($service['Service']['image'] != '')?$thumbImageurl:$Imageurl;
				?>

				<?php echo $this->Html->image($Imageurl, array('alt' => $service['Service']['name'], 'width' => 100, 'height' => 75));?>
				</td>
 			    <td class="actions">
				<div class="action-buttons"> 
			 
				
				  <?php 
		   echo $this->Html->link("<i class=\"icon-eye-open\"></i>",
		   array( 'action' => 'view', $service['Service']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
				 
				   <?php 
		   echo $this->Html->link("<i class=\"icon-pencil\"></i>",
		   array( 'action' => 'edit', $service['Service']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
			 
			
<?php echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
array('action' => 'delete', $service['Service']['id']), 
array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $service['Service']['id'])); ?>

 
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
 
 
  