<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Website Home Page Images Settings
      <?php //echo $title_for_layout?>
    </h1>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Website Details </div>
        <div class="widget-content padded clearfix"> 
		<?php echo $this->Form->create('Setting', array('enctype'=>'multipart/form-data', "class" => "form-horizontal" )); ?>
		<?php echo $this->Form->input('id');?>

          <div class="form-group">
             
            <label for="site_name" class="col-sm-2 control-label">Site Image 1</label>
            <div class="col-sm-4">
               	<?php
				
				$thumbImageurl = $this->Html->url('/img/upload_images/'.$this->data['Setting']['custom1']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($this->data['Setting']['custom1'] != '')?$thumbImageurl:$Imageurl;
				?>
                   <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $Imageurl;?>"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Setting][custom1]" id="SettingThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
 				
            </div>
          </div>
          
<div class="form-group">
             
            <label for="site_name" class="col-sm-2 control-label">Site Image 2</label>
            <div class="col-sm-4">
               	<?php
				
				$thumbImageurl = $this->Html->url('/img/upload_images/'.$this->data['Setting']['custom2']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($this->data['Setting']['custom2'] != '')?$thumbImageurl:$Imageurl;
				?>
                   <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $Imageurl;?>"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Setting][custom2]" id="SettingThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
 				
            </div>
          </div>
          

<div class="form-group">
             
            <label for="site_name" class="col-sm-2 control-label">Site Image 3</label>
            <div class="col-sm-4">
               	<?php
				
				$thumbImageurl = $this->Html->url('/img/upload_images/'.$this->data['Setting']['custom3']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($this->data['Setting']['custom3'] != '')?$thumbImageurl:$Imageurl;
				?>
                   <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $Imageurl;?>"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
 					  <input type="file" name="data[Setting][custom3]" id="SettingThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
 				
            </div>
          </div>
          
		  
		  <div class="form-group text-left">
            <div class="col-sm-offset-2 col-sm-7">
              <button class="btn btn-success" type="submit"><span class="fa fa-refresh"></span>&nbsp;Save Settings</button>
            </div>
          </div>
          <?php echo $this->Form->end(); ?> </div>
      </div>
    </div>
  </div>
</div>
<script>
$('#flashMessage').addClass('alert alert-success');
</script>
