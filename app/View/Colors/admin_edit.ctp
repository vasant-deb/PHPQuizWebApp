<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Update Color </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Color Details </div>
          <div class="widget-content padded">
             
			<?php
			echo $this->Form->create('Color',array('enctype'=>'multipart/form-data','class' => 'form-horizontal'));
			 echo $this->Form->input('id');
		    ?>		    			
			  	<div class="form-group">
                <label class="control-label col-md-2">Color Title</label>
                <div class="col-md-4">				 
					 <?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>                
              </div>			  	 
<?php				 
				$thumbImageurl = $this->Html->url('/images/colors/'.$this->data['Color']['image']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($this->data['Color']['image'] != '')?$thumbImageurl:$Imageurl;
				 	
?>		
<div class="form-group">
 
<label class="control-label col-md-2">Image</label>
<div class="col-md-4">
<div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 250px;"> <img src="<?php echo $Imageurl;?>" class="img-responsive"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Color][image]" id="ServiceThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
</div>   
</div>  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-5">
                  <button class="btn btn-primary" type="submit">Submit</button>
 				   <?php 
		   echo $this->Html->link("Cancel",
		   array( 'controller' => 'colors', 'action' => 'index', 'admin' => true),
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
  
  