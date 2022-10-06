<?php ?>
<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Update Product </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Product Details </div>
          <div class="widget-content padded">
            <?php
			echo $this->Form->create('Product',array('enctype'=>'multipart/form-data','class' => 'form-horizontal'));
			 echo $this->Form->input('id');
		  ?>
		    
			
			 
		    
<div class="form-group">
<label for="site_name" class="col-sm-2 control-label">Select Category</label>
<div class="col-sm-4">
<?php echo $this->Form->input('category_id', array('class'=>'form-control col-md-3','label'=>'','empty' => true));?>	
</div> 
<label class="control-label col-md-2">Product Name</label>
<div class="col-md-4">
<?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	
</div>


</div>

<div class="form-group">
<label class="control-label col-md-2">Price</label>
<div class="col-md-4">
<?php echo $this->Form->input('price', array('class'=>'form-control col-md-3','label'=>'', 'min' => '1'));?>	
</div>

<label class="control-label col-md-2">Discounted Price</label>
<div class="col-md-4">
<?php echo $this->Form->input('discounted_price', array('class'=>'form-control col-md-3','label'=>'', 'min' => '0'));?>	
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Tagline</label>
<div class="col-md-4">

<?php echo $this->Form->input('tagline', array('class'=>'form-control col-md-3','label'=>''));?>	
</div>

<label class="control-label col-md-2">Tags</label>
<div class="col-md-4">

<?php echo $this->Form->input('tags', array('class'=>'form-control col-md-3','label'=>''));?>	
</div>
</div>

<div class="form-group">


<label class="control-label col-md-2">Demo Url</label>
<div class="col-md-10">

<?php echo $this->Form->input('url', array('class'=>'form-control col-md-3','label'=>''));?>	
</div>

</div>
 

<div class="form-group">
 <label class="control-label col-md-2">Demo username </label>
<div class="col-sm-4">  			 
<?php echo $this->Form->input('demo_username', array('class'=>'form-control col-md-3','label'=>''));?>	
	</div>
	<label class="control-label col-md-2">Demo password </label>
<div class="col-sm-4"> 	
<?php echo $this->Form->input('user_password', array('class'=>'form-control col-md-3','label'=>''));?>	
	</div>
</div>

<div class="form-group">
 <label class="control-label col-md-2">Framework</label>
<div class="col-sm-4">  			 
<?php echo $this->Form->input('framework', array('class'=>'form-control col-md-3','label'=>''));?>	
	</div>
	<label class="control-label col-md-2">High Resolution </label>
<div class="col-sm-4"> 	
<?php echo $this->Form->input('high_resolution', array('class'=>'form-control col-md-3','label'=>''));?>	
	</div>
</div>
<div class="form-group">
 <label class="control-label col-md-2">Software Version</label>
<div class="col-sm-4">  			 
<?php echo $this->Form->input('software_version', array('class'=>'form-control col-md-3','label'=>''));?>	
	</div>
	<label class="control-label col-md-2">Youtube</label>
<div class="col-sm-4"> 	
<?php echo $this->Form->input('youtube', array('class'=>'form-control col-md-3','label'=>''));?>	
	</div>
</div>	
<div class="form-group">
 <label class="control-label col-md-2">Files Included</label>
<div class="col-sm-4">  			 
<?php echo $this->Form->input('files_included', array('class'=>'form-control col-md-3','label'=>''));?>	
	</div>
	<label class="control-label col-md-2">Browsers</label>
<div class="col-sm-4"> 	
<?php echo $this->Form->input('browsers', array('class'=>'form-control col-md-3','label'=>''));?>	
	</div>
</div>
<?php
				 
				$thumbImageurl = $this->Html->url('/images/products/'.$this->data['Product']['image']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($this->data['Product']['image'] != '')?$thumbImageurl:$Imageurl;
				
				 				
				$thumbbackImageurl = $this->Html->url('/images/products/'.$this->data['Product']['full_image']);
				$Imagebackurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imagebackurl = ($this->data['Product']['full_image'] != '')?$thumbbackImageurl:$Imagebackurl;
								
				?>

<div class="form-group">
 
<label class="control-label col-md-2">Image</label>
<div class="col-md-4">
<div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 250px;"> <img src="<?php echo $Imageurl;?>" class="img-responsive"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Product][image]" id="ServiceThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
</div>   



<label class="control-label col-md-2">Full Image</label>
<div class="col-md-4">
<div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 250px;"> <img src="<?php echo $Imagebackurl;?>" class="img-responsive"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Product][full_image]" id="Serviceback_imageThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
</div>  

</div>




			<div class="form-group">
			<label class="control-label col-md-2">Status</label>
			<div class="col-md-4">
			<label class="radio-inline">
			<input type="radio" name="data[Product][active]" value="1" <?php if($this->data['Product']['active'] == 1) { echo 'checked'; } ?>>
			<span>Active</span></label>
			<label class="radio-inline">
			<input type="radio" name="data[Product][active]" value="0" <?php if($this->data['Product']['active'] == 0) { echo 'checked'; } ?>>
			<span>Inactive</span></label>
			<label class="radio">
			</div>
			
			
			
		
					
			</div>
 
			  	 
			   <div class="form-group">
                
				  <label class="control-label col-md-2">Description</label>
                <div class="col-md-8">
				 
					 <?php echo $this->Form->input('description', array('class'=>'form-control ckeditor col-md-3','label'=>''));?>	
                </div>
              </div>
			  
			  <div class="form-group">
                
				  <label class="control-label col-md-2">Short Description</label>
                <div class="col-md-8">
				 
					 <?php echo $this->Form->input('short_description', array('class'=>'form-control ckeditor col-md-3','label'=>''));?>	
                </div>
              </div>
			  
			  <div class="form-group">
            <label class="control-label col-md-2">Meta Title</label>
            <div class="col-md-8"> <?php echo $this->Form->input('meta_title', array('class'=>'form-control col-md-3','label'=>'','onkeyup'=>'countChar(this)'));?> <div id="charNum">Enter Characters to show your seo strength</div></div>
            

          </div>
		  
		  <div class="form-group">
            <label class="control-label col-md-2">Meta Description</label>
            <div class="col-md-8"> <?php echo $this->Form->input('meta_desc', array('class'=>'form-control col-md-3','label'=>'','onkeyup'=>'countMetas(this)'));?> <div id="charMetas">Enter Characters to show your seo strength</div></div>
            
          </div>
		  
          <div class="form-group">
            <label class="control-label col-md-2">Meta Keyword</label>
            <div class="col-md-8"> <?php echo $this->Form->input('meta_keyword', array('class'=>'form-control col-md-3','label'=>''));?> </div>
            
          </div>
			  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-5">
                  <button class="btn btn-primary" type="submit">Submit</button>
 				   <?php 
		   echo $this->Html->link("Cancel",
		   array( 'controller' => 'products', 'action' => 'index', 'admin' => true),
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
  
     <script>
      function countChar(val) {
        var len = val.value.length;
  var color;
  $('#charNum').text(0 + len+'\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0'+'•••');

 
  if(len>71){
      
    color='red';
  }
  else if(len>51)
  { 
      color='green';
        }
        else{
            color='orange';
        }
  $('#charNum').css({
    'color': color
  });
      };
      
    </script>
     <script>
      function countMetas(val) {
        var len = val.value.length;
  var color;
  $('#charMetas').text(0 + len+'\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0'+'•••');

 
  if(len>160){
      
    color='red';
  }
  else if(len>50)
  { 
      color='green';
        }
        else{
            color='orange';
        }
  $('#charMetas').css({
    'color': color
  });
      };
      
    </script>
    
   
 
	  
	     
	     