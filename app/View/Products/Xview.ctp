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
 
?>
<div class="col-md-12 no-padding">
    <div class="banner_inner_con"> </div>
    <div class="services-breadcrumb">
      <div class="inner_breadcrumb">
        <ul class="short">
          <li><a href="<?php echo $this->webroot;?>">Home</a><span>|</span></li>
		  <li><a href="products.html">Our Products</a><span>|</span></li>
          <li><?php echo h($product['Product']['name']); ?></li>
        </ul>
      </div>
    </div>
    <div class="container">
      <div class="inner-cont">
        <h1 class="heading1"><?php echo h($product['Product']['name']); ?></h1>
      </div>
      <div class="col-md-8">
        <!-- text -->
        <div class="product-text">
          <div class="col-md-12 no-padding">
            <div class="col-md-12">
			 <div class="img-div img-responsive">

 <a href="javascript:void(<?php echo h($product['Product']['name']); ?>);" class="pop">
			  <?php 
	  if($product['Product']['image'] != '') {
	  ?>	  
	  <img src="<?php echo $thumbImageurl;?>" class="img-responsive">
	  

	  <?php } ?>
			 
			</a> 

			 </div>
              <!--<h2><?php //echo h($product['Product']['name']); ?></h2>-->
            <?php echo  $product['Product']['description']; ?>
            </div>
           <a href="javascript:void(<?php echo h($product['Product']['name']); ?>);" class="pop">
			  <?php 
			  /*
	  if($product['Product']['image'] != '') { 
	  ?>	  
	  <img src="<?php echo $thumbImageurl;?>" class="img-responsive">
	  <?php } */
	  ?>
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
		 
	 
     
	      <div class="col-md-12">
         
          
		  <?php 
		  if(count($child_products) > 0) { 
		  ?>
		   <p>Sub Products</p>
		  <?php 
		  foreach ($child_products as $ChildProduct):
		  $thumbImageurl = "";
		  $thumbImageurl = $this->Html->url('/images/products/'.$ChildProduct['Product']['image']);

		  ?>	
		  
        <div class="col-md-4 box">
		  <?php 
	  if($ChildProduct['Product']['image'] != '') {
	  ?>	  
	  <img src="<?php echo $thumbImageurl;?>" class="img-responsive">
	  	  <div class="caption"><?php echo $product['Product']['name'];?></div>

	  <?php } ?>
            <div class="detail">
              <div class="content">
                <h2><?php echo h($ChildProduct['Product']['name']); ?></h2>
                <a href="<?php echo h($ChildProduct['Product']['slug']); ?>.html">View more</a> </div>
            </div>
          </div>
		  
          <?php endforeach; } ?>
           
        </div>
      </div>
                   <?php  echo $this->element('sunrise/enquiry'); ?> 

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
  
  <style>
  
  .img-div {
   float: right;
   width: 42%;
}


.caption {
position: absolute;
bottom: 0px;
background: rgba(0,0,0,0.5);
width: 83%;
left: 0px;
right: 0px;
text-align: center;
margin: auto;
padding: 8px;
color: #fff;
}

</style>
  	