<?php /*
<!-- Banner Section Begins -->
  <section id="breadcrume">
    <div class="container">
      <div class="row">
        <h2><?php echo $category['Category']['name'];?></h2>
      </div>
      <!--row-->
    </div>
    <!--continer-->
  </section>
  <!-- Banner Section Ends -->
  
 <!-- About Section Begins -->
  <section id="about" class="about-block pad-top-50 pad-bottom-100">
    <div class="container pr">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="services-contet"> <img src="ganesh/images/brown-peda.jpg" alt="image" class="img-responsive" />
            <h3> <?php echo $category['Category']['name'];?> </h3>
            <p> <?php echo $category['Category']['description'];?> </p>
          </div>
          <!--services-contet-->
        </div>
        <div class="col-lg-4">
          <div class="inquiry-bg">
            <h3> Enquiry Now </h3>
            <form>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Name">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Phone">
              </div>
              <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Message"></textarea>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
          <!--inquiry-bg-->
        </div>
        <!--col-lg-4-->
      </div>
    </div>
    <div class="container">
      <div id="owl-special-menu" class="spcl-menu">
	  
	    <?php if(count($category['Product']) > 0) { ?>
		 <?php foreach ($category['Product'] as $cproduct): ?>	
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="item wow animated fadeInUp" data-wow-delay="0.5s">
            <figure> <img src="ganesh/images/special-menu-1.jpg" alt="image" /> </figure>
            <div class="spcl-text">
              <h4><a href="<?php echo h($category['Category']['slug']); ?>/<?php echo $cproduct['slug'];?>.html"><?php echo $cproduct['name'];?> </a> </h4>              
            </div>
          </div>
        </div>
		   <?php endforeach; ?>
		 <?php } ?>
     
      </div>
    </div>
  </section>
  <!-- About Section Ends -->
*/ ?>

  <!--start-single-heading-banner-->
  <div class="single-banner-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
          <div class="single-ban-top-content"> </div>
        </div>
      </div>
    </div>
  </div>
  <!--end-single-heading-banner-->
  <!--start-single-heading-->
  <div class="signle-heading">
    <div class="container">
      <div class="row">
        <!--start-shop-head -->
        <div class="col-lg-12">
          <div class="shop-head-menu">
            <ul>
              <li><i class="fa fa-home"></i><a class="shop-home" href="<?php echo $this->webroot;?>"><span>Home</span></a><span><i class="fa fa-angle-right"></i></span></li>
              <li class="shop-pro">PRODUCTS</li>
            </ul>
          </div>
        </div>
        <!--end-shop-head-->
      </div>
    </div>
  </div>
  <!--end-single-heading-->
  <!--start-shop-product-area-->
  <div class="shop-product-area">
    <div class="container">
      <div class="row">
		  <?php echo $this->element('fmf/categories/leftmenu'); ?>	


<?php
/*		  
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
          <!-- Shop-Product-View-start -->
          <div class="shop-product-view">
            <!-- Shop Product Tab Area -->
            <div class="product-tab-area">
              <!-- Tab Bar -->      
			 		 <?php echo $this->element('fmf/categories/search_bar'); ?>
              <!-- End-Tab-Bar -->
              <!-- Tab-Content -->
              
                <div class="tab-content">
  <div id="shop-product" class="tab-pane active">
    <div class="row">
				    <?php if($categories_products > 0) { ?>	
					<?php foreach ($categories_products as $color_item): ?>
               
     
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="single-product shop-mar-bottom">
          <div class="product-img-wrap"> <a class="product-img" href="single-product.html">
            <div id="f1_container">
              <div id="f1_card" class="shadow">
                <div class="front face"> <img src="images/main-products/clamps/Front/GBF-821-50x50.png"> </div>
                <div class="back face center"> <img src="images/main-products/clamps/Back/GBF-821-50x50.png"> </div>
              </div>
              </a>
              <div class="add-to-cart"> <a href="#" title="add to cart">
                <div><i class="fa fa-shopping-cart"></i><span>Add to cart</span></div>
                </a> </div>
            </div>
            <div class="product-info text-center">
              <div class="product-content"> <a href="#">
                <h3 class="pro-name">Sample Product</h3>
                </a>
                <div class="pro-price"> <span class="price-text">Price:</span> <span class="normal-price">$200.00</span></div>
              </div>
            </div>
         
      
      
    </div>
  </div>
</div>

				<?php endforeach; ?>
				<?php } ?>                  
           </div>
      </div>
    </div>
  </div>
</div>
   </div>
  </div>
</div>