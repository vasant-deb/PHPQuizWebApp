<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Update Category </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Category Details </div>
          <div class="widget-content padded">
             
			<?php echo $this->Form->create('Category',array('enctype'=>'multipart/form-data','class' => 'form-horizontal')); ?>
			<?php echo $this->Form->input('id'); ?>
		    
			   <div class="form-group">
              <label class="control-label col-md-2">Select Parent Category</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('parent_id', array('class'=>'form-control col-md-3','label'=>'','empty' => true));?>	
                </div>
				 
               
                <label class="control-label col-md-2">Category Name</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div> 
			  
			 
			  	<?php
				
				$thumbImageurl = $this->Html->url('/images/categories/'.$this->data['Category']['image']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($this->data['Category']['image'] != '')?$thumbImageurl:$Imageurl;
				
				$cat_thumbImageurl = $this->Html->url('/images/categories/'.$this->data['Category']['cat_image']);
				$cat_Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$cat_Imageurl = ($this->data['Category']['cat_image'] != '')?$cat_thumbImageurl:$cat_Imageurl;
				?>

				<div class="form-group">
                <label class="control-label col-md-2">Category  Image</label>
                <div class="col-md-4">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $Imageurl;?>"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Category][image]" id="BannerThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
                </div>
             <label class="control-label col-md-2">Home Image</label>
                <div class="col-md-4">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $cat_Imageurl;?>"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Category][cat_image]" id="BannerThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
                </div>
              </div>
			  
			<div class="form-group">
			<label class="control-label col-md-2">Status</label>
			<div class="col-md-4">
			<label class="radio-inline">
			<input type="radio" name="data[Category][active]" value="1" <?php if($this->data['Category']['active'] == 1) { echo 'checked'; } ?>>
			<span>Active</span></label>
			<label class="radio-inline">
			<input type="radio" name="data[Category][active]" value="0" <?php if($this->data['Category']['active'] == 0) { echo 'checked'; } ?>>
			<span>Inactive</span></label>			 
			</div>	
			<label class="control-label col-md-2">Coming Soon </label>
			<div class="col-md-4">
			<label class="radio-inline">
			<input type="radio" name="data[Category][coming]" value="1" <?php if($this->data['Category']['coming'] == 1) { echo 'checked'; } ?>>
			<span>Yes</span></label>
			<label class="radio-inline">
			<input type="radio" name="data[Category][coming]" value="0" <?php if($this->data['Category']['coming'] == 0) { echo 'checked'; } ?>>
			<span>No</span></label>			 
			</div>	
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
 
<!--
<h2>Admin Edit Category</h2>

<div class="row">

<div class="col col-lg-3">

<?php echo $this->Form->create('Category'); ?>
<?php echo $this->Form->input('id'); ?>
<br />
<?php echo $this->Form->input('parent_id', array('class' => 'form-control', 'empty' => true)); ?>
<br />
<?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
<br />
<?php echo $this->Form->input('slug', array('class' => 'form-control')); ?>
<br />
<?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
<br />
<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>

</div>

</div>

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $this->Form->value('Category.id')), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Category.id'))); ?>

<br />
<br />

-->
