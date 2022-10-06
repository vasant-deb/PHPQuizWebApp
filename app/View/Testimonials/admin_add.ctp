<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Add Testimonial </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Testimonial Details </div>
          <div class="widget-content padded">             
			<?php
					echo $this->Form->create('Testimonial',array('enctype'=>'multipart/form-data','class' => 'form-horizontal'));
		    ?>		    
			  
		 

	<div class="form-group">
			<label class="control-label col-md-2">Name</label>
			<div class="col-md-4">				 
			<?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	
			</div>                
			</div>


			<div class="form-group">
			<label class="control-label col-md-2">Designation</label>
			<div class="col-md-4">				 
			<?php echo $this->Form->input('designation', array('class'=>'form-control col-md-3','label'=>''));?>	
			</div>                
			</div>
			
			<div class="form-group">
			<label class="control-label col-md-2">Company</label>
			<div class="col-md-4">				 
			<?php echo $this->Form->input('company', array('class'=>'form-control col-md-3','label'=>''));?>	
			</div>                
			</div>
			  
			  	<?php
				
 				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
 				?>

<div class="form-group">
 
				
                <label class="control-label col-md-2">Image</label>
                <div class="col-md-4">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $Imageurl;?>"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Testimonial][image]" id="ServiceThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
                </div>             
              
              </div> 
			   
			   
				 <div class="form-group">
                
				  <label class="control-label col-md-2">Short Description</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('short_description', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div>
			  
			   <div class="form-group">
                
				  <label class="control-label col-md-2">Description</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('description', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div>
			  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-5">
                  <button class="btn btn-primary" type="submit">Submit</button>
 				   <?php 
		   echo $this->Html->link("Cancel",
		   array( 'controller' => 'testimonials', 'action' => 'index', 'admin' => true),
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
  
  

