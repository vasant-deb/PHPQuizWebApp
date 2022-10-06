<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Credit Application Details </h1>
	   
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
 		  
		  <div class="heading"> <i class="icon-table"></i>Credit Application Details
          <?php 
		   echo $this->Html->link("<i class=\"icon-envelope\"></i>Manage  Credit Applications",
		   array( 'action' => 'index', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-large btn-success pull-right')); 
			?>
			
			<?php /*
			<?php 
		   echo $this->Html->link("<i class=\"icon-envelope\"></i>Print Credit Application",
		   array( 'action' => 'print', $enquiry['Creditenquiry']['id'], 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-large btn-danger pull-right')); 
			?>
			
			<?php $print_url = $this->webroot. 'pdf/'.'fmf-application-for-credit-form-'.$enquiry['Creditenquiry']['id'].'.pdf';?>
			<a class = "btn btn-large btn-danger pull-right" href="<?php echo $print_url;?>" target="_blank">​​​​​​​​​​​​​​​​​Print</a>
			*/ ?>
			
        </div> 
          <div class="widget-content padded">            
			  
			  	<div class="form-group clearfix">
                <label class="control-label col-md-2">Credit Application ID </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['id']); ?>					 	
                </div>
              </div> 
			    
			 
			    
			 <div class="form-group clearfix">
                <label class="control-label col-md-2">Date of Application</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['date_of_application']); ?>					 	
                </div>
              </div> 	
				
                <div class="form-group clearfix">
                <label class="control-label col-md-2">Name</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['business_name']); ?>					 	
                </div>
              </div>  
			 
 			     <div class="form-group clearfix">
                <label class="control-label col-md-2">Mobile </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['telephone_number']); ?>					 	
                </div>
              </div> 
			  
 			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Email </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['email']); ?>					 	
                </div>
              </div> 
			   
 			  
			   <div class="form-group clearfix">
                <label class="control-label col-md-2">Address1</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['address1']); ?>					 	
                </div>
              </div> 
 		 		 
 			  
			   <div class="form-group clearfix">
                <label class="control-label col-md-2">Address2</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['address2']); ?>					 	
                </div>
              </div> 
 			 
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">How Long Has Business Been in Operation?</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['business_since']); ?>					 	
                </div>
              </div> 
			  
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">	Will Company Accept Back Orders?</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['accept_back_orders']); ?>					 	
                </div>
              </div> 
			
		
			
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-12"><strong>Name of Owner (or Officers if corporated)</strong></label>
                
              </div> 
			  
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Owner 1</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['name_of_owner1']); ?>					 	
                </div>
              </div> 
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Owner 2</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['name_of_owner2']); ?>					 	
                </div>
              </div> 
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Owner 3</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['name_of_owner3']); ?>					 	
                </div>
              </div> 
			  
			
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Organization Type</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['organization_type']); ?>					 	
                </div>
              </div> 
			  
			
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Bank Name</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['bank_name']); ?>					 	
                </div>
              </div> 
			
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Bank Address</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['bank_address']); ?>					 	
                </div>
              </div> 
			
			
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Bank Phone No</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['bank_phone_no']); ?>					 	
                </div>
              </div> 
			
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Bank Account No</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['bank_account_no']); ?>					 	
                </div>
              </div> 
			  
			   <div class="form-group clearfix">
                <label class="control-label col-md-12"><strong>Name and Account Numbers of Current Suppliers</strong></label>
                
              </div> 
			  
			    <div class="form-group clearfix">
                <label class="control-label col-md-2">1. Name of Supplier</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['name_of_supplier1']); ?>	<br>
				 Account # <?php echo h($enquiry['Creditenquiry']['supplier_account1']); ?><br>
				 Telephone <?php echo h($enquiry['Creditenquiry']['supplier_telephone1']); ?> 
                </div>
              </div> 
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">2. Name of Supplier</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['name_of_supplier2']); ?>	<br>
				 Account # <?php echo h($enquiry['Creditenquiry']['supplier_account2']); ?><br>
				 Telephone <?php echo h($enquiry['Creditenquiry']['supplier_telephone2']); ?> 
                </div>
              </div> 
			 
		 
			
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Form Completed By</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['form_completed_by_name']); ?>					 	
                </div>
              </div> 
			  
			   <div class="form-group clearfix">
                <label class="control-label col-md-2">Title</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['form_completed_by_title']); ?>					 	
                </div>
              </div>
			  
			  <div class="form-group clearfix">
                <label class="control-label col-md-2">Telephone</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['form_completed_by_telephone']); ?>					 	
                </div>
              </div>
			  
			    <div class="form-group clearfix">
                <label class="control-label col-md-2">Email</label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['form_completed_by_email']); ?>					 	
                </div>
              </div>
			  
			   <!--<div class="form-group clearfix">
                <label class="control-label col-md-2">IP Address </label>
                <div class="col-md-9">
				 <?php echo h($enquiry['Creditenquiry']['ip_address']); ?>					 	
                </div>
              </div> -->	  
			  			  
           </div>
        </div>
      </div>
    </div>
	  </div>