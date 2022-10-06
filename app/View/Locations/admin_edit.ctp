<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Update Location </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Location Details </div>
          <div class="widget-content padded">
             
			<?php echo $this->Form->create('Location',array('enctype'=>'multipart/form-data','class' => 'form-horizontal')); ?>
			<?php echo $this->Form->input('id'); ?>
		    
			    <div class="form-group">
             
                <label class="control-label col-md-2">Location Name</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
				
				  <label class="control-label col-md-2">Location Order</label>
                <div class="col-md-1">
				 
					 <?php echo $this->Form->input('location_order', array('class'=>'form-control col-md-3','label'=>'', 'min' => '0'));?>	
                </div>
				
              </div> 
			  
			  
			  	<?php
				
				$thumbImageurl = $this->Html->url('/images/locations/'.$this->data['Location']['image']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($this->data['Location']['image'] != '')?$thumbImageurl:$Imageurl;
				?>

<div class="form-group">
              <label class="control-label col-md-2">Location Image</label>
                <div class="col-md-4">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 300px; height: 200px;"> <img src="<?php echo $Imageurl;?>"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 300px; max-height: 200px;"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Location][image]" id="ServiceThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
                </div>             
              
             
              </div>
			  
			<div class="form-group">
			<label class="control-label col-md-2">Status</label>
			<div class="col-md-4">
			<label class="radio-inline">
			<input type="radio" name="data[Location][active]" value="1" <?php if($this->data['Location']['active'] == 1) { echo 'checked'; } ?>>
			<span>Active</span></label>
			<label class="radio-inline">
			<input type="radio" name="data[Location][active]" value="0" <?php if($this->data['Location']['active'] == 0) { echo 'checked'; } ?>>
			<span>Inactive</span></label>
			 
			</div>
			  
			</div>		
			 
           
			    
			  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-5">
                  <button class="btn btn-primary" type="submit">Submit</button>
 				   <?php 
		   echo $this->Html->link("Cancel",
		   array( 'controller' => 'locations', 'action' => 'index', 'admin' => true),
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