<span class="mr-20"><a href="/"></a></span><?php ?>
<div class="wrapper">
  <!-- Start of header area -->
  <header>
    <div class="header-top gray-bg">
      <div class="container">
        <div class="row">
          <div class="col-sm-5 hidden-xs">
            <div class="header-top-left">
			 <ul class="header-top-style text-capitalize mr-25">
			  <li><a href="customer/myaccount"><i class="fa fa-user"></i> Welcome :   <?php if($customer_data) { echo $customer_data['User']['first_name']. " ".$customer_data['User']['last_name']; } else { echo "mwoman"; } ?> !</a></li>
                
              </ul>
              <ul class="header-top-style text-capitalize mr-25">
			 <li><a href="customer/myaccount"><span class="mr-10">My Account</span><i class="fa fa-angle-down"></i></a>
                  <ul class="ul-style my-account box-shadow white-bg">
                    <li><a href="customer/login">Login</a></li>
                    <li><a href="customer/myaccount">My Account</a></li>
                    
                    <li><a href="shop/cart">My Cart</a></li>
                    <li><a href="shop/cart">Checkout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-3 col-xs-6">
            <div class="header-top-middle">
              <ul class="header-top-style">
			   <?php if($this->Session->read('User.id')) { ?>
                
                 <li><a href="customer/logout"> LogOut</a></li>
                </li>
			   <?php } else { ?>
			   <li> <a href="customer/login"> <span>Login or Register</span> </a>
			   <?php } ?>
              </ul>
            </div>
          </div>
          <div class="col-sm-4 col-xs-6">
            <div class="header-top-right"> <!--<span class="mr-20"><a href="<?php echo $this->webroot;?>"><img alt="" src="/images/<?php echo $sitelogo; ?>"></a></span> <span>-->
			  <form action="products/search" id="UserSearchForm" method="get" accept-charset="utf-8">
			  
              <input type="text" class="pl-10" id="s" name="search" placeholder="Search...">
			   <i class="fa fa-search" aria-hidden="true"></i>
			  </form>
              </span> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-bottom">
      <div class="container">
        <div class="row header-middle-content">
          <div class="col-md-4 col-sm-4 hidden-xs">
            <div class="service-inner mt-10"> <span class="service-img b-img"> <img alt="" src="unknown/images/service.png"> </span> <span class="service-content ml-15"><strong>24*7 Support</strong><br>
              <a href="tel:<?php echo $company_phone2; ?>" class="cart-size-value"><?php echo $company_phone2; ?></a></span> </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="header-logo text-center"> <a href="<?php echo $this->webroot;?>"><img alt="" src="images/<?php echo $sitelogo; ?>"></a> </div>
          </div>
          <div class="col-md-offset-0 col-md-4 col-sm-offset-0 col-sm-4 col-xs-offset-3 col-xs-6">
		  <?php  echo $this->element('unknown/homecart'); ?>
           
          </div>
          <nav class="primary-menu">
            <ul class="header-top-style text-uppercase">
              <li> <a href="<?php echo $this->webroot; ?>" title="Home">home</a></li>
              <li><a href="about-us.html" title="About Us">about</a></li>
			  <li class="mega-container"> <a href="womans.html" class="menu-tag" title="Woman">woman</a>
                <div class="megamenu-area ul-style box-shadow white-bg">
  <?php foreach ($categories as $category_data): ?>	
                  <div class="mega-inner ptb-40">
                    <h6 class="mega-title text-uppercase"><strong><?php echo h($category_data['Category']['name']); ?></strong></h6>
                    <ul class="text-capitalize forge-list">
					<?php foreach ($category_data['children'] as $cproduct): ?>
                      <li><a href="category/<?php echo h($category_data['Category']['slug']); ?>/<?php echo h($cproduct['Category']['slug']); ?>.html"><?php echo $cproduct['Category']['name'];?></a>
							<ul class="list2">
							 <?php foreach ($cproduct['ChildCategory'] as $product): ?>
								  <li><a href="<?php echo h($cproduct['Category']['slug']); ?>/category/<?php echo $product['slug']; ?>.html"><?php echo $product['name'];?></a></li>
								<?php endforeach; ?>
							</ul>
					  
					  </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                 <?php endforeach; ?>
                 
                </div>
              </li>
             <!-- <li> <a href="#" title="Blog">Blog</a></li> -->
			 <li><a href="fanbook.html" title="Fanbook">Fanbook</a></li>
              <li><a href="contact-us.html" title="Contact Us">Contact Us</a></li>
			    <!--<li><a href="sitemap.html" title="Sitemap">Sitemap</a></li>-->
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <!-- Mobile Menu Start -->
    <div class="mobile-menu-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="mobile-menu">
              <nav id="dropdown">
                <ul>
                  <li><a href="<?php echo $this->webroot; ?>">Home</a></li>
                  <li><a href="about-us.html">about</a></li>
				 
                
 
                  <li><a href="womans.html">woman</a>
				   
                    <ul>
					<?php foreach ($categories as $category): ?>	
                      <li><a href="<?php echo h($category['Category']['slug']); ?>.html"><?php echo h($category['Category']['name']); ?></a>
                        <ul>
						<?php foreach ($category['children'] as $categorys): ?>
                          <li><a href="<?php echo $categorys['Category']['slug'];?>/products/<?php echo h($categorys['Category']['slug']); ?>.html"><?php echo h($categorys['Category']['name']); ?></a></li>
                     
                      <?php endforeach; ?>
                        </ul>
                      </li>
                      <?php endforeach; ?>
                    </ul>
					
                  </li> 
                 
               <li><a href="#" title="Fanbook">Fanbook</a></li>
                  <li><a href="contact-us.html">Contact Us</a></li>
				   <!--<li><a href="sitemap.html" title="Sitemap">Sitemap</a></li>-->
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Mobile Menu End -->
  </header>