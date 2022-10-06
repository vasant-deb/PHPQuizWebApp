<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Enquiry Details </h1>
	   
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
 		  
		  <div class="heading"> <i class="icon-table"></i>Enquiry Details
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>Manage Enquiries",
		   array( 'action' => 'index', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div> 
          <div class="widget-content padded">            
			  
			   
			    
				 <div class="form-group clearfix">
                <label class="control-label col-md-2">Enquiry For </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['enquiry_for']); ?>					 	
                </div>
              </div> 
			    
                <div class="form-group clearfix">
                <label class="control-label col-md-2">Name</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['name']); ?>					 	
                </div>
              </div> 
			  
			   <div class="form-group clearfix">
                <label class="control-label col-md-2">Email </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['email']); ?>					 	
                </div>
              </div> 
			  
			   
			<?php echo $this->Form->create('Enquiry', array('class' => 'form-horizontal')); ?>
			<?php echo $this->Form->input('id'); ?>
		     
			  
			  	<div class="form-group">
                <label class="control-label col-md-2">Description</label>
                <div class="col-md-5">
				 
					 <?php echo $this->Form->input('description', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div>
			  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-5">
                  <button class="btn btn-primary" type="submit">Submit</button>
 				   <?php 
		   echo $this->Html->link("Cancel",
		   array( 'controller' => 'categories', 'action' => 'index', 'admin' => true),
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