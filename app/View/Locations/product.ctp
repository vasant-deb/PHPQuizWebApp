<div class="col-md-12 no-padding">
    <div class="banner_inner_con"> </div>
    <div class="services-breadcrumb">
      <div class="inner_breadcrumb">
        <ul class="short">
          <li><a href="<?php echo $country;?>/">Home</a><span>|</span></li>
          <li><?php echo $product_page['Sitepage']['name']; ?></li>
        </ul>
      </div>
    </div>
    <div class="container">
      <div class="inner-cont">
        <h1 class="heading1"><?php echo $product_page['Sitepage']['name']; ?></h1>
      </div>
      <div class="col-md-8">
        <div class="col-md-12">
          <p> 
		  <?php 
	/*	  
	$description  = @$catalog['Catalog']['description'];
	$description  = str_replace('countryname', $country, $description );
	  $description = str_replace('catname', $product['Product']['name'], $description );
	 
	 echo html_entity_decode($description);
	*/	   
		  ?>
		  <?php echo $product_page['Sitepage']['description']; ?>
		  </p>
          
		  <?php 
		  if(count($products) > 0) { 
		  foreach ($products as $product):
		  $thumbImageurl = "";
		  $thumbImageurl = $this->Html->url('/images/products/'.$product['Product']['image']);

		  ?>	
		  
        <div class="col-md-4 box">
		  <?php 
	  if($product['Product']['image'] != '') {
	  ?>	  
	  <img src="<?php echo $thumbImageurl;?>" class="img-responsive">
	  <?php } ?>
            <div class="detail">
              <div class="content">
                <h2><?php echo h($product['Product']['name']); ?></h2>
                <a href="<?php echo $country;?>/products/<?php echo h($product['Product']['slug']); ?>.html">View more</a> </div>
            </div>
          </div>
		  
          <?php endforeach; } ?>
           
        </div>
      </div>
			<?php  echo $this->element('sunrise/enquiry'); ?> 
    </div>
  </div>