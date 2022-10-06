<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Update Service </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Service Details </div>
          <div class="widget-content padded">
             
			<?php
			echo $this->Form->create('Service',array('enctype'=>'multipart/form-data','class' => 'form-horizontal'));
			 echo $this->Form->input('id'); ?>
		    
			
			 <div class="form-group">
            <label for="site_name" class="col-sm-2 control-label">Select Service Type</label>
            <div class="col-sm-4">  <select name="data[Service][servicetype]" class="form-control col-md-3">
					 <option value="">Select Service Type</option>
					 <option value="1" <?php if($this->data['Service']['servicetype'] == '1') { echo "selected"; } ?>>Service</option>
					 <option value="2" <?php if($this->data['Service']['servicetype'] == '2') { echo "selected"; } ?>>Product</option>
					 </select>	</div>
            <label for="site_name" class="col-sm-2 control-label">Select Company</label>
            <div class="col-sm-4">
             					 <?php echo $this->Form->input('company_id', array('class'=>'form-control col-md-3','label'=>'','empty' => true));?>	

            </div>
          </div>
		   
			   
			  
			  	<div class="form-group">
                <label class="control-label col-md-2">Service Name</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
               
                <label class="control-label col-md-2">Service Slug</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('slug', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div>
			  
			  	<?php
				
				$thumbImageurl = $this->Html->url('/img/upload_images/'.$this->data['Service']['image']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($this->data['Service']['image'] != '')?$thumbImageurl:$Imageurl;
				?>

<div class="form-group">

<label class="control-label col-md-2">Price</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('price', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
				
                <label class="control-label col-md-2">Image</label>
                <div class="col-md-4">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $Imageurl;?>"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Service][image]" id="ServiceThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
                </div>             
              
              </div>
			  
			  
			 	  
          <div class="form-group">
            <label for="site_name" class="col-sm-2 control-label">Meta Title</label>
            <div class="col-sm-4">
              <?php	echo $this->Form->input('meta_title', array('class'=>'form-control col-md-3','label'=>''));?>
              <?php 	echo $this->Form->input('id');?>
            </div>
            <label for="site_name" class="col-sm-2 control-label">Meta Desc</label>
            <div class="col-sm-4">
              <?php	echo $this->Form->input('meta_desc', array('class'=>'form-control col-md-3','label'=>''));?>
            </div>
          </div>
          <div class="form-group">
            <label for="site_name" class="col-sm-2 control-label">Meta Keyword</label>
            <div class="col-sm-4">
              <?php	echo $this->Form->input('meta_keyword', array('class'=>'form-control col-md-3','label'=>''));?>
              <?php 	echo $this->Form->input('id');?>
            </div>
            <label for="site_name" class="col-sm-2 control-label">External URL</label>
            <div class="col-sm-4">
              <?php	echo $this->Form->input('page_url', array('class'=>'form-control col-md-3','label'=>''));?>
            </div>
          </div>
		  
			  	
			   <div class="form-group">
                
				  <label class="control-label col-md-2">Description</label>
                <div class="col-md-10">
				 
					 <?php echo $this->Form->input('description', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div>
			  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-5">
                  <button class="btn btn-primary" type="submit">Submit</button>
 				   <?php 
		   echo $this->Html->link("Cancel",
		   array( 'controller' => 'companies', 'action' => 'index', 'admin' => true),
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
  
 