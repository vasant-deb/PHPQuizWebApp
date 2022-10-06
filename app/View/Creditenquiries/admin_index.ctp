<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Credit Applications</h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Enquiries
          <?php 
		  /* echo $this->Html->link("<i class=\"icon-plus\"></i>New Enquiry",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); */
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
            <th>ID</th>
              <th>Name</th>
               <th>Email</th>
			   <th>Contact</th>
               <th>Date of Application</th>
              <th class="actions">Actions</th>
              </thead>
            <tbody>
	<?php foreach ($creditenquiries as $enquiry): ?>
              <tr>
				<td><?php echo h($enquiry['Creditenquiry']['id']); ?></td>
				<td><?php echo h($enquiry['Creditenquiry']['business_name']); ?></td>				 
 				<td><?php echo h($enquiry['Creditenquiry']['email']); ?></td>
				<td><?php echo h($enquiry['Creditenquiry']['telephone_number']); ?></td>
				<td><?php echo h($enquiry['Creditenquiry']['date_of_application']); ?></td>
                 <td class="actions">
				
				  <?php 
		   echo $this->Html->link("<i class=\"icon-eye-open\"></i>",
		   array( 'action' => 'view', $enquiry['Creditenquiry']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
			
		<div class="action-buttons"> 			 
		<?php 
		/* 
		echo $this->Html->link("<i class=\"icon-envelope\"></i>",
		array( 'action' => 'send', $enquiry['Creditenquiry']['id']),
		array('escape' => FALSE,'class' => 'table-actions')); 

		echo $this->Html->link("<i class=\"icon-pencil\"></i>",
		array( 'action' => 'edit', $enquiry['Creditenquiry']['id']),
		array('escape' => FALSE,'class' => 'table-actions')); 

		echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
		array('action' => 'delete', $enquiry['Creditenquiry']['id']), 
		array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $enquiry['Creditenquiry']['id'])); 

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
   
 
<script>
$('#flashMessage').addClass('alert alert-success');
</script>
 