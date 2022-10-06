<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Users <?php //echo $title_for_layout?></h1>
  </div>
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Users
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New User",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>			
            <th>ID</th>
			  <th>Name</th>
			  <th>Email</th>
			  <th>Password</th>
              <th>Active</th>
              <th class="actions">Actions</th>
              </thead>
            <tbody>
			   <?php foreach ($users as $user): ?>
			    <tr>
				<td><?php echo h($user['User']['id']); ?></td>
				<td> <?php echo $user['User']['first_name']. ' '.$user['User']['last_name']; ?>	</td>
				<td><?php echo h($user['User']['email']); ?></td>
				<td><?php echo h($user['User']['user_password']); ?></td>
				<td> 
				<?php if($user['User']['active'] == 1) { echo 'Active'; } else { echo 'Inactive'; } ?>
				</td>
				<td class="actions">
				<div class="action-buttons">
				<?php 
				echo $this->Html->link("<i class=\"icon-eye-open\"></i>",
				array( 'action' => 'view', $user['User']['id']),
				array('escape' => FALSE,'class' => 'table-actions')); 
				?>				 
				<?php 
				echo $this->Html->link("<i class=\"icon-pencil\"></i>",
				array( 'action' => 'edit', $user['User']['id']),
				array('escape' => FALSE,'class' => 'table-actions')); 
				?>
				<?php 
				echo $this->Html->link("<i class=\"icon-key\"></i>",
				array( 'action' => 'password', $user['User']['id']),
				array('escape' => FALSE,'class' => 'table-actions', 'title' => 'Change Password')); 
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
 