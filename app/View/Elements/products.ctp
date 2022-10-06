    
    <!-- Top Selling Week -->
    <section class="padding-top-60 padding-bottom-30">
      <div class="container"> 
        
        <!-- heading -->
        <div class="heading">
          <h2>
		  <?php 
		  if ($this->here == $this->webroot) {
			?>
		  Latest Product
		  <?php } else { ?>
		   
		  <?php } ?>
		   </h2>
          <hr>
        </div>
        
        <!-- Items -->
        <div class="item-col-4"> 
          
<?php
 foreach ($products as $product):
  ?>
           
           <!-- Product -->
          <div class="product">
            <article> 
			
 			<?php echo $this->Html->image('/images/small/' . $product['Product']['image'], array('url' => array('controller' => 'products', 'action' => 'view', 'slug' => $product['Product']['slug']), 'alt' => $product['Product']['name'], 'width' => 150, 'height' => 150, 'class' => 'img-responsive')); ?>
											
			
			<span class="new-tag">New</span> 
              
              <!-- Content --> 
              <!-- <span class="tag">Accessories</span> -->
			  <?php echo $this->Html->link($product['Product']['name'], array('controller' => 'products', 'action' => 'view', 'slug' => $product['Product']['slug']), array('class' => 'tittle' )); ?>
              <!-- Reviews 
              <p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span></p>
			  -->
			  <p></p>
			  
              <div class="price">
			  <i class="fa fa-rupee"></i> <?php echo $product['Product']['discounted_price']; ?>
			 			<span>  <i class="fa fa-rupee"></i> <?php echo $product['Product']['price']; ?> </span>
 
			  </div>
              <a href="product/<?php echo $product['Product']['slug'];?>" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
          </div>
            <?php
			
 
endforeach;
?>
        </div>
      </div>
    </section> 