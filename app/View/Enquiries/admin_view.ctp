<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Enquiry Details </h1>
	   
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
 		  
		  <div class="heading"> <i class="icon-table"></i>Enquiry Details
          <?php 
		   echo $this->Html->link("<i class=\"icon-envelope\"></i>Manage Enquiries",
		   array( 'action' => 'index', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-large btn-success pull-right')); 
			?>
        </div> 
          <div class="widget-content padded">            
			  
			  	<div class="form-group clearfix">
                <label class="control-label col-md-2">Enquiry ID </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['id']); ?>					 	
                </div>
              </div> 
			    
			
				 <div class="form-group clearfix">
                <label class="control-label col-md-2">Enquiry From </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['enquiry_for']); ?>					 	
                </div>
              </div> 
			    
			 <div class="form-group clearfix">
                <label class="control-label col-md-2">Enquiry Date </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['created']); ?>					 	
                </div>
              </div> 	
				
                <div class="form-group clearfix">
                <label class="control-label col-md-2">Name</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['name']); ?>					 	
                </div>
              </div>  
			 
			 <?php if($enquiry['Enquiry']['mobile'] != '') { ?>
			     <div class="form-group clearfix">
                <label class="control-label col-md-2">Mobile </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['mobile']); ?>					 	
                </div>
              </div> 
			  
			  <?php } ?>
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Email </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['email']); ?>					 	
                </div>
              </div> 
			  
			   	 <?php if($enquiry['Enquiry']['subject'] != '') { ?>
			     <div class="form-group clearfix">
                <label class="control-label col-md-2">Subject </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['subject']); ?>					 	
                </div>
              </div> 
			  
			  <?php } ?>
			  <?php if($enquiry['Enquiry']['address'] != '') { ?>
			  
			   <div class="form-group clearfix">
                <label class="control-label col-md-2">Address</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['address']); ?>					 	
                </div>
              </div> 
			  <?php } ?>
		 		 
			   
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Message </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['message']); ?>					 	
                </div>
              </div> 
			  
			   <div class="form-group clearfix">
                <label class="control-label col-md-2">Page URL </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['page_url']); ?>					 	
                </div>
              </div> 
			  
			   <div class="form-group clearfix">
                <label class="control-label col-md-2">IP Address </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Enquiry']['ip_address']); ?>					 	
                </div>
              </div> 	  
			  			  
           </div>
        </div>
      </div>
    </div>
	  </div>