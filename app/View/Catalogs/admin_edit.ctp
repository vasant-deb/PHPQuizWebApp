<div class="container-fluid main-content">
    <div class="page-title">
      <h1> Update Catalog </h1>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading"> <i class="icon-reorder"></i>Catalog Details </div>
          <div class="widget-content padded">
             
			<?php
			 echo $this->Form->create('Catalog',array('enctype'=>'multipart/form-data','class' => 'form-horizontal'));
			 echo $this->Form->input('id');
		    ?>
 

<div class="form-group">
<label class="control-label col-md-2">Catalog Name</label>
<div class="col-md-4">

<?php echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>	
</div>
 
</div> 								

			   <div class="form-group">                
				  <label class="control-label col-md-2">
				
				  </label>
                <div class="col-md-8">				 
				<?php echo $this->Form->input('description', array('class'=>'form-control ckeditor col-md-3','label'=>'Description &nbsp;&nbsp; [Product Name - catname]  &nbsp;&nbsp; [Country Name - countryname ]'));?>	
                </div>
              </div>
			  
			    <div class="form-group">
                <label class="control-label col-md-2">Meta Title</label>
                   <div class="col-md-8">			   
				<?php echo $this->Form->input('meta_title', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div>
			  
			  
			    <div class="form-group">
			       <label class="control-label col-md-2">Meta Description</label>
                   <div class="col-md-8">
				  	<?php echo $this->Form->input('meta_desc', array('class'=>'form-control col-md-3','label'=>''));?>
                </div>
              </div>
			  
			     <div class="form-group">
                <label class="control-label col-md-2">Meta Keyword</label>
                    <div class="col-md-8">		 
				<?php echo $this->Form->input('meta_keyword', array('class'=>'form-control col-md-3','label'=>''));?>	
                </div>
              </div>
			  
			  
			  
                  <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-5">
                  <button class="btn btn-primary" type="submit">Submit</button>
 				   <?php 
		   echo $this->Html->link("Cancel",
		   array( 'controller' => 'catalogs', 'action' => 'index', 'admin' => true),
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
<script type="text/javascript">     
        $(document).on('change', '.ddStatus', function(e) {
            var element = $(this); 
            currentParentCategory = $(this).val(); 		 
            $.ajax({    
					url: '<?php echo Router::url(array('controller'=>'catalogs', 'action'=>'dropdown_subcategories'))?>',
					async: false,
					type: "POST", 
					data: "parent_category_id="+currentParentCategory, 
					dataType: "html",
					success: function(data) {
					$('#subcategorieslist').html(data);
					}
				})
            });            
  </script>   