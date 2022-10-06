   
<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Edit Blog</h1>
    </div>
		
	
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Blog Details </div>
          <div class="widget-content padded">
             <?php echo $this->Form->create('Blog',array('enctype'=>'multipart/form-data','class' => 'form-horizontal'));
		echo $this->Form->input('id');

          ?>
		  
		 

				     <div class="form-group">
              
			  <label class="control-label col-md-2">Select Category</label>
                <div class="col-md-4">
				 
					 <?php echo $this->Form->input('category_id', array('class'=>'form-control col-md-3','label'=>'','empty' => true));?>	
                </div>
              
			   </div>
 
              <div class="form-group">
                <label class="control-label col-md-2">Name</label>
                <div class="col-md-7">
						<?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	 				  	
                </div>
              </div>
			  
			     
 				 
 		 
				<?php
				
				$thumbImageurl = $this->Html->url('/images/blogs/'.$this->data['Blog']['image']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($this->data['Blog']['image'] != '')?$thumbImageurl:$Imageurl;
				?>

<div class="form-group">
                <label class="control-label col-md-2">Image</label>
                <div class="col-md-4">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $Imageurl;?>"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Blog][image]" id="BlogThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
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
 				   
				<?php echo $this->Form->input('meta_title', array('class'=>'form-control col-md-3','label'=>'','onkeyup'=>'countChar(this)'));?>	
<div id="charNum">Enter Characters to show your seo strength</div>
                </div>
              </div>
			  
			     <div class="form-group">
                <label class="control-label col-md-2">Meta Keyword</label>
                <div class="col-md-7">
 				 
				<?php echo $this->Form->input('meta_keyword', array('class'=>'form-control col-md-3','label'=>''));?>	

                </div>
              </div>
			  
			    <div class="form-group">
			       <label class="control-label col-md-2">Meta Description</label>
                <div class="col-md-7">
 				  
				  
				  				<?php echo $this->Form->input('meta_desc', array('class'=>'form-control col-md-3','label'=>'','onkeyup'=>'countMetas(this)'));?>	
 <div id="charMetas">Enter Characters to show your seo strength</div>
                </div>
              </div>
			  
			  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-7">
                  <button class="btn btn-primary" type="submit">Submit</button>
                  <?php 
		   echo $this->Html->link("Cancel",
		   array( 'controller' => 'blogs', 'action' => 'index', 'admin' => true),
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
    
   
 
	  
	     
	     