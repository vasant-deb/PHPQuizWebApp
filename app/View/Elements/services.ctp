<section class="service sec-padd2">
    <div class="container">
        
        <div class="section-title">
            <h2>Our Services</h2>
        </div>
        
        <div class="service_carousel">
            <!--Featured Service -->
            
			<?php
 foreach ($products as $product):
 
 ?>
			
			<article class="single-column">
                <div class="item">
                    <figure class="img-box">
                        <img src="images/service/1.jpg" alt="">
                        <figcaption class="default-overlay-outer">
                            <div class="inner">
                                <div class="content-layer">
                                    <a href="services/<?php echo $product['Category']['slug'];?>" class="thm-btn thm-tran-bg">read more</a>                                </div>
                            </div>
                        </figcaption>
                    </figure>
                    <div class="content center">
                         
                        <a href="services/<?php echo $product['Category']['slug'];?>/<?php echo $product['Category']['slug'];?>"><h4><?php echo $product['Category']['name'];?></h4></a>
                        <div class="text">
                            <p>The process of improving some of <br>our an enterprise's success. Business <br>growth can be a achieved.</p>
                        </div>
                    </div>
                </div>
            </article>
			<?php
 endforeach;
?>
            <!--Featured Service -->
             
        </div>
            
    </div>
</section>
