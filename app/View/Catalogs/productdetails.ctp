<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>

  <script>
  
$(function() {
		$('.pop').on('click', function() {
			$('.imagepreview').attr('src', $(this).find('img').attr('src'));
			$('#imagemodal').modal('show');   
		});		
});
</script>
<?php				 
$thumbImageurl = $this->Html->url('/images/products/'.$product['Product']['image']);

$galleries = $product['Gallery'];

$directory_name = str_replace('/','',$directory_name);

$directory_url  = "$directory_name-category.html";


$directory_name = ucwords($directory_name);
 
?>
<div class="col-md-12 no-padding">
    <div class="banner_inner_con"> </div>
    <div class="services-breadcrumb">
      <div class="inner_breadcrumb">
        <ul class="short">
          <li><a href="<?php echo $this->webroot;?>">Home</a><span>|</span></li>
		  <li><a href="<?php echo $this->webroot;?><?php echo $directory_url;?>"><?php echo $directory_name;?></a><span>|</span></li>
          <li><?php echo h($product['Product']['name']); ?> in <?php echo $directory_name;?></li>
        </ul>
      </div>
    </div>
    <div class="container">
      <div class="inner-cont">
        <h1 class="heading1"><?php echo h($product['Product']['name']); ?> in <?php echo $directory_name;?></h1>
      </div>
      <div class="col-md-8">
        <!-- text -->
        <div class="product-text">
          <div class="col-md-12 no-padding">
            <div class="col-md-9">
              
            <?php 
	 	  
	$description  = @$catalog['Catalog']['description'];
	$description  = str_replace('countryname', $catalog['Catalog']['name'], $description );
	  $description = str_replace('catname', $product['Product']['name'], $description );
	 
	 echo html_entity_decode($description);
	    
		  ?>
            </div>
            <div class="col-md-3 img-div"> <a href="javascript:void(<?php echo h($product['Product']['name']); ?>);" class="pop">
			  <?php 
	  if($product['Product']['image'] != '') {
	  ?>	  
	  <img src="<?php echo $thumbImageurl;?>" class="img-responsive">
	  <?php } ?>
			 
			</a> </div>
          </div>
        </div>
       
	     <?php 
		  if(count($galleries) > 0) { 
		  foreach ($galleries as $gallery):
		  $thumbImageurl = "";
		  $gthumbImageurl = $this->Html->url('/images/galleries/'.$gallery['image']);

		  ?>	
		  
	  <?php 
	  if($gallery['image'] != '') {
	  ?>	
        <div class="col-md-4 box">
		<a href="javascript:void(<?php echo h($product['Product']['name']); ?>);" class="pop">
		<img src="<?php echo $gthumbImageurl;?>" class="img-responsive">
        </a>   
        </div>
        <?php } endforeach; } ?>
		 
     
      </div>
                   <?php  echo $this->element('marketplace/enquiry'); ?> 

    </div>
  </div>
  <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <img src="" class="imagepreview" style="width: 100%;" > </div>
      </div>
    </div>
  </div>
  	