<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Productphoto</h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Productphoto
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Productphoto",
		   array( 'action' => 'add', $product_id, 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
			  <th width="5%">ID</th>
               <th width="35%">Name</th>
			   <th width="40%">Image</th>              
               <th class="actions">Actions</th>
              </thead>
            <tbody>
	<?php foreach ($galleries as $gallery): ?>
              <tr>
				<td><?php echo h($gallery['Productphoto']['id']); ?></td>
				<td><?php echo h($gallery['Productphoto']['name']); ?></td>	
 
				<td  align="center">
				<?php
				
				$thumbImageurl = '/images/productphotos/'.$gallery['Productphoto']['image'];
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($gallery['Productphoto']['image'] != '')?$thumbImageurl:$Imageurl;
				?>

				<?php echo $this->Html->image($Imageurl, array('alt' => $gallery['Productphoto']['name'], 'width' => 100,'class' => 'img-responsive'));?>
				</td>
 				 
                <td class="actions">
				<div class="action-buttons"> 
			 

				<?php 
				echo $this->Html->link("<i class=\"icon-pencil\"></i>",
				array( 'action' => 'edit', $gallery['Productphoto']['id']),
				array('escape' => FALSE,'class' => 'table-actions')); 
				?>


				<?php echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
				array('action' => 'delete', $gallery['Productphoto']['id']), 
				array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $gallery['Productphoto']['id'])); ?>

 
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
 
  