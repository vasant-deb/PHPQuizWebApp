<?php ?>


<div class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                    
                     <!-- Start Product List -->
            <div class="product-list-tab modify-tnm">
                <div class="container">
                    <div class="rp-style-2">
                        <div class="product-list tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                <div class="product-container-list rp-style-2">
 
									<?php foreach($category as $categorys): 
									 $frontImageurl = $this->Html->url('/images/categories/'.$categorys['Category']['image']);

                 $ddthumbImageurl = "images/no-image.jpg";
									?>
                                    <div class="product-inner cp-style-2 mt-30 col-3">
                                        <a href="category/<?php echo $categorys['Category']['slug']; ?>.html">
                                            <div class="product-img b-img">
											 <?php 
				if($categorys['Category']['image'] != '') {
				?>
                                                <img alt="" src="<?php echo $frontImageurl; ?>">
				<?php } else { ?>
				 <img alt="" src="<?php echo $ddthumbImageurl; ?>">
				<?php } ?>
                                            </div>
                                        </a>
                                      
                                       
                                        <div class="product-text pt-10">
                                            
                                           
                                            <div class="clear"></div>
                                            <h6 class="product-name m-0">
                                                <a title="<?php echo $categorys['Category']['name']; ?>" href="category/<?php echo $categorys['Category']['slug']; ?>.html"><?php echo $categorys['Category']['name']; ?></a>
                                            </h6>
                                        </div>
                                    </div>
									<?php endforeach; ?>
     
                                </div>
                            </div>
                       
                        </div>                        
                    </div>
                </div>
            </div>
            <!-- End Product List -->
                
				<!--<?php echo  $this->element('unknown/inquiry'); ?>-->
              
            </div>
        </div>
    </div>
</div>