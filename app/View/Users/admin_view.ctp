<div class="container-fluid main-content">
    <div class="page-title">
      <h1> User Details </h1>
	   
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
 		  
		  <div class="heading"> <i class="icon-table"></i>User Details
          <?php 
		   echo $this->Html->link("<i class=\"icon-envelope\"></i>Manage Users",
		   array( 'action' => 'index', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-large btn-success pull-right')); 
			?>
        </div> 
          <div class="widget-content padded">            
			  
			  	<div class="form-group clearfix">
                <label class="control-label col-md-2">User ID </label>
                <div class="col-md-9">
				 <?php echo h($user['User']['id']); ?>					 	
                </div>
              </div> 
			    
			
				 <div class="form-group clearfix">
                <label class="control-label col-md-2">User Name </label>
                <div class="col-md-9">
				 <?php echo $user['User']['first_name']. ' '.$user['User']['last_name']; ?>					 	
                </div>
              </div> 
			    
			 <div class="form-group clearfix">
                <label class="control-label col-md-2">Email Address </label>
                <div class="col-md-9">
				 <?php echo h($user['User']['email']); ?>					 	
                </div>
              </div> 	
				
                <div class="form-group clearfix">
                <label class="control-label col-md-2">Company Name</label>
                <div class="col-md-9">
				 <?php echo h($user['User']['name']); ?>					 	
                </div>
              </div>  
			  
			     <div class="form-group clearfix">
                <label class="control-label col-md-2">Phone </label>
                <div class="col-md-9">
				 <?php echo h($user['User']['phone']); ?>					 	
                </div>
              </div> 
			  
			 
			  
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Address </label>
                <div class="col-md-9">
				 <?php echo h($user['User']['address']); ?>					 	
                </div>
              </div> 
			  
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Address 2</label>
                <div class="col-md-9">
				 <?php echo h($user['User']['address2']); ?>					 	
                </div>
              </div> 
			  
  <div class="form-group clearfix">
                <label class="control-label col-md-2"> Town / City </label>
                <div class="col-md-9">
				 <?php echo h($user['User']['city']); ?>					 	
                </div>
              </div> 
			    
			      <div class="form-group clearfix">
                <label class="control-label col-md-2">State / County</label>
                <div class="col-md-9">
				 <?php echo h($user['User']['state']); ?>					 	
                </div>
              </div> 
			  
			   
			   

			      <div class="form-group clearfix">
                <label class="control-label col-md-2">Postcode / Zip </label>
                <div class="col-md-9">
				 <?php echo h($user['User']['zipcode']); ?>					 	
                </div>
              </div> 
			  
			   

			    
			     <div class="form-group clearfix">
                <label class="control-label col-md-2">Country </label>
                <div class="col-md-9">
				 <?php echo h($user['User']['country']); ?>					 	
                </div>
              </div> 
           </div>
        </div>
      </div>
    </div>
	  </div>