<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Update User </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>User Details </div>
          <div class="widget-content padded">
             
			<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
			<?php echo $this->Form->input('id'); ?>
		    			  
			<div class="form-group">
			<label class="control-label col-md-2">First Name</label>
			<div class="col-md-5">				 
			<?php echo $this->Form->input('first_name', array('class'=>'form-control col-md-3','label'=>''));?>	
			</div>
			</div> 

			<div class="form-group">
			<label class="control-label col-md-2">Last Name</label>
			<div class="col-md-5">				 
			<?php echo $this->Form->input('last_name', array('class'=>'form-control col-md-3','label'=>''));?>	
			</div>
			</div>

			<div class="form-group">
			<label class="control-label col-md-2">Email</label>
			<div class="col-md-5">				  
			<?php echo $this->Form->input('email', array('class'=>'form-control col-md-3','label'=>''));?>			
			</div>
			</div>

			<div class="form-group">
			<label class="control-label col-md-2">Phone</label>
			<div class="col-md-5">
			<?php echo $this->Form->input('phone', array('class'=>'form-control col-md-3','label'=>''));?>	
			</div>
			</div>

			<div class="form-group">
			<label class="control-label col-md-2">Status</label>
			<div class="col-md-7">
			<label class="radio">
			<input type="radio" name="data[User][active]" value="1" <?php if($this->data['User']['active'] == 1) { echo 'checked'; } ?>>
			<span>Active</span></label>
			<label class="radio">
			<input type="radio" name="data[User][active]" value="0" <?php if($this->data['User']['active'] == 0) { echo 'checked'; } ?>>
			<span>Inactive</span></label>
			<label class="radio">
			</div>
			</div>
			  
			<div class="form-group">
			<label class="control-label col-md-2"></label>
			<div class="col-md-5">
			<button class="btn btn-primary" type="submit">Submit</button>
			<?php 
			echo $this->Html->link("Cancel",
			array( 'controller' => 'users', 'action' => 'index', 'admin' => true),
			array('escape' => FALSE,'class' => 'btn btn-default-outline')); 
			?>
			</div>
			</div>
			
           <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
    </div>
	  </div>
   