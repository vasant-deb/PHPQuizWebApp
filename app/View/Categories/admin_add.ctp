<?php ?>
<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Add Category </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Category Details </div>
          <div class="widget-content padded">
             
			<?php echo $this->Form->create('Category',array('enctype'=>'multipart/form-data','class' => 'form-horizontal')); ?>
								 <?php // echo $this->Form->input('parent_id', array('type' => 'hidden', 'value' => '0'));?>	
								 <?php echo $this->Form->input('active', array('type' => 'hidden', 'value' => '1'));?>	 

			  <div class="form-group">
             
			  <label class="control-label col-md-2">Select Parent Category</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('parent_id', array('class'=>'form-control col-md-3','label'=>'','empty' => true));?>	
                </div>
              
			  </div>
			  
			    <div class="form-group">
                <label class="control-label col-md-2">Category Name</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div> 
			  
			  
			  
			     
<?php

$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";

?>

<div class="form-group">

<label class="control-label col-md-2">Category Image</label>
<div class="col-md-4">
<div class="fileupload fileupload-new" data-provides="fileupload">
<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $Imageurl;?>"> </div>
<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
<div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
<input type="file" name="data[Category][image]" id="BannerThumb">
</span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
</div>
</div>   
  
            <!-- <label class="control-label col-md-2">Category Slug</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('slug', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div> -->
              </div>
			  
		 
			
			 
			 
               
			<div class="form-group">
                <label class="control-label col-md-2">Short Description</label>
                <div class="col-md-7">
				 
					 <?php echo $this->Form->input('short_description', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div>
			  
			  	<div class="form-group">
                <label class="control-label col-md-2">Description</label>
                <div class="col-md-7">
				 
					 <?php echo $this->Form->input('description', array('class'=>'ckeditor form-control col-md-3','label'=>''));?>	
                </div>
              </div>
			  
			   <div class="form-group">
                <label class="control-label col-md-2">Meta Title</label>
                <div class="col-md-7">
 				   
				<?php echo $this->Form->input('meta_title', array('class'=>'form-control col-md-3','label'=>''));?>	

                </div>
              </div>
			  
			    
			    <div class="form-group">
			       <label class="control-label col-md-2">Meta Description</label>
                <div class="col-md-7">
 				  
				  
				  				<?php echo $this->Form->input('meta_desc', array('class'=>'form-control col-md-3','label'=>''));?>	

                </div>
              </div>
			  
			     <div class="form-group">
                <label class="control-label col-md-2">Meta Keyword</label>
                <div class="col-md-7">
 				 
				<?php echo $this->Form->input('meta_keyword', array('class'=>'form-control col-md-3','label'=>''));?>	

                </div>
              </div>
			
			  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-5">
                  <button class="btn btn-primary" type="submit">Submit</button>
				<?php 
				   echo $this->Html->link("Cancel",
				   array( 'controller' => 'categories', 'action' => 'index',  'admin' => true),
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
 