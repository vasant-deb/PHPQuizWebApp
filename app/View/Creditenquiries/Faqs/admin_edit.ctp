   
<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Edit Faq</h1>
    </div>
		
	
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Faq Details </div>
          <div class="widget-content padded">
             <?php echo $this->Form->create('Faq',array('enctype'=>'multipart/form-data','class' => 'form-horizontal'));
		echo $this->Form->input('id');

          ?>
		  
		  
 
              <div class="form-group">
                <label class="control-label col-md-2">Name</label>
                <div class="col-md-7">
 				  <input name="data[Faq][name]" maxlength="255" type="text" value="<?php echo $this->data['Faq']['name'];?>" class="form-control" id="BannerName">
 				  	
                </div>
              </div>
			  
			    
		  
			  
 					
				 
			      
 
 		 
				

			  
			    

			  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-7">
                  <button class="btn btn-primary" type="submit">Submit</button>
                  <?php 
		   echo $this->Html->link("Cancel",
		   array( 'controller' => 'faqs', 'action' => 'index', 'admin' => true),
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
	  
	     