

<?php $this->Html->addCrumb('Search'); ?>
<div class="breadcrumbs-area breadcrumbs-bg ptb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumbs-inner">
                            <h5 class="breadcrumbs-disc m-0">Best Products for you</h5>
                            <h2 class="breadcrumbs-title text-black m-0"> <span class="text-defualt">Search</h2>
                            <ul class="top-page">
                                <li><a href="<?php echo $this->webroot; ?>">Home</a></li>
                                <li>&gt;</li>
                                <li>Search</li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<div class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-9">
                    
                     <!-- Start Product List -->
            <div class="product-list-tab modify-tnm">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
						
						<!--<form>
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Text input">
	<i class="fa fa-search" aria-hidden="true"></i>
  </div> 
    <button type="submit" class="btn btn-default">Submit</button>
</form>-->

<?php 
				
				foreach ($products as $product):  
		       
			    $frontImageurl = $this->Html->url('/images/products/'. $product['Product']['image']);
		        $backImageurl  = $this->Html->url('/images/products/'. $product['Product']['image']);
				
				?> 
                                    <div class="product-inner cp-style-2 mt-30 col-3">
                                        <a href="<?php echo $product['Product']['slug'];?>.html">
                                            <div class="product-img b-img">
											 
                                                <img alt="" src="<?php echo $frontImageurl;?>">
				
                                            </div>
                                        </a>
                                     <!--   <span class="product-tag text-uppercase theme-bg"><?php echo $product_item['Category']['style']; ?></span>-->
                                        
                                        <div class="product-text pt-10">
                                           
                                            <div class="clear"></div>
                                            <h6 class="product-name m-0">
                                                <a title="" href="<?php echo $product['Product']['slug'];?>.html"><?php echo $product['Product']['name'];?></a>
                                            </h6>
                                        </div>
                                    </div>
									 <?php endforeach; ?>
<br>
						</div>
                    </div>
                </div>
            </div>
            <!-- End Product List -->
                </div>
              
            </div>
        </div>
    </div>
</div>