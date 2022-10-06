<?php ?>
<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Banners <?php //echo $title_for_layout?></h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Banners
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Banner",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
			  <th width="5%">ID</th>
               <th width="35%">Name</th>
			   <th width="40%">Image</th>
				<th>Status</th>              
               <th class="actions">Actions</th>
              </thead>
            <tbody>
			<?php foreach ($banners as $banner): ?>
              <tr>
				<td><?php echo h($banner['Banner']['id']); ?></td>
				<td><?php echo h($banner['Banner']['name']); ?></td>	
 
				<td  align="center">
				<?php
				
				$thumbImageurl = '/images/banners/'.$banner['Banner']['image'];
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($banner['Banner']['image'] != '')?$thumbImageurl:$Imageurl;
				?>

				<?php echo $this->Html->image($Imageurl, array('alt' => $banner['Banner']['name'], 'class' => 'img-responsive', 'width' => '250'));?>
				</td>
 				 <td>
				<?php				
 				
				$options = array( '1' => 'Active', '0' => 'Inactive');
				echo $this->Form->select('active', $options, array('empty'=>false, 'name'=>'data[Banner][active]', 'default'=>$banner['Banner']['active'], 'class'=>'form-control ddStatus', 'data-banner_id'=>$banner['Banner']['id']));
				 
 				?>
				</td>
                <td class="actions">
				<div class="action-buttons"> 
			 

				<?php 
				echo $this->Html->link("<i class=\"icon-pencil\"></i>",
				array( 'action' => 'edit', $banner['Banner']['id']),
				array('escape' => FALSE,'class' => 'table-actions')); 
				?>


				<?php echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
				array('action' => 'delete', $banner['Banner']['id']), 
				array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $banner['Banner']['id'])); ?>

 
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
                url: '<?php echo Router::url(array('controller'=>'banners', 'action'=>'change_banner_status'))?>', // change_category_status is a Function in controller
                data: 'banner_id='+element.data('banner_id')+'&status='+currentStatus,
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

 