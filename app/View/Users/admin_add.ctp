<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Add User </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>User Details </div>
          <div class="widget-content padded">
             
			<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
			<!--
			<div class="form-group">
                <label class="control-label col-md-2">Select User Role</label>
                <div class="col-md-5">
				 
					        <?php // echo $this->Form->input('role', array('class' => 'form-control col-md-3', 'label'=>'', 'options' => array('admin' => 'Admin', 'customer' => 'Customer'))); ?>

                </div>
              </div>
			  -->
			  
			   <?php echo $this->Form->input('role', array('type' => 'hidden', 'value' => 'customer'));?>
			    
			  	<div class="form-group">
                <label class="control-label col-md-2">Name</label>
                <div class="col-md-5">
				 
					 <?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div> 
			    <div class="form-group">
                <label class="control-label col-md-2">Email</label>
                <div class="col-md-5">
				 
					
<?php echo $this->Form->input('email', array('class'=>'form-control col-md-3','label'=>''));?>			
                </div>
              </div>
			  <!--
				<div class="form-group">
                <label class="control-label col-md-2"> User Name</label>
                <div class="col-md-5">
				 
					 <?php //echo $this->Form->input('username', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div> 
			  -->
			  
				<div class="form-group">
                <label class="control-label col-md-2">Password</label>
                <div class="col-md-5">
				 
					 <?php echo $this->Form->input('password', array('class'=>'form-control col-md-3','label'=>''));?>		
                </div>
              </div>
			  
			  
			  <div class="form-group">
                <label class="control-label col-md-2">Phone</label>
                <div class="col-md-5">
				 
								  
<?php echo $this->Form->input('phone', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div>


<div class="form-group">
                <label class="control-label col-md-2">Mobile</label>
                <div class="col-md-5">
				 
							  
<?php echo $this->Form->input('mobile', array('class'=>'form-control col-md-3','label'=>''));?>	
			  		
                </div>
              </div>
			  
	
			  
			  
			  			<div class="form-group">
			<label class="control-label col-md-2">Status</label>
			<div class="col-md-7">
			<label class="radio">
			<input type="radio" name="data[User][active]" value="1">
			<span>Active</span></label>
			<label class="radio">
			<input type="radio" name="data[User][active]" value="0">
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
 