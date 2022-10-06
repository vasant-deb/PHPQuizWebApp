<?php ?>
   
    <!-- ABOUT PROMO START HERE -->
   <style>
@media screen and (min-width: 460px){
.breadcaump-area {
    margin-top: 70px;
}
}
@media screen and (max-width: 460px){
.header-default.header-transparent {
    position: relative;
    top: 0px;
}
}
.hot-page2-alp-con {
    box-shadow: none !important;
    background: #f2f1f100 !important;
}
	.showcase-section ul li {
	    padding: 10px 0;
	}
	
	.about-section{
		text-align:justify;
	}
	.spacing {
		margin-top:80px;
	}
	.padding {
		padding-top:50px;
	}
	.heading-inner{
		  color: #4a90e2;
		font-size:22px;
		font-weight:400
		font-family: "Poppins", sans-serif;
	   text-align:center;
	    letter-spacing: 0em;
	    line-height: 1.23;;
	}
	.btn.accordion-button:hover {
	    color: #000;
	}
	.btn-link.accordion-button:hover {
	    text-decoration: none;
	}
	a.full-block-link:hover {
	    color: white;
	}
	a.full-block-link{
		font-weight:600;
	}
	.full-block {
	    background: orange;
	    color: white;
		text-align:justify;
	    padding: 18px;
	    line-height: 40px;
	    font-size: 18px;
	   
	}
</style>
<div class="breadcaump-area pt--200 pt_lg--300 pt_md--250 pt_sm--200 pb--100 bg_image--8 breadcaump-title-bar breadcaump-title-white" style="padding-top: 40px;padding-bottom: 0px;background:linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url(https://img.allw.mn/content/za/ug/udz1xrbj56e03080bcc86909547827_500x281.gif);background-size:cover;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcaump-inner text-center">
					<h2 class="heading">Kuch Chahiye Kya?</h2>
					<div class="breadcrumb-insite">
						<ul class="core-breadcaump">
							<li><a href="<?php echo $this->webroot; ?>">Home</a>
							</li>
							<li><a href="products">Our Products</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
   


 <link rel="stylesheet" href="home/css/style.css">
<link rel="stylesheet" href="home/css/materialize.css">
    <link rel="stylesheet" href="home/css/bootstrap.css">


	<!-- /SIDEBAR NAV -->
<!-- SECTION -->
   <section class="hot-page2-alp hot-page2-pa-sp-top" style="background: linear-gradient(45deg, #db2acf, #f2c043);"
>
        <div class="container">
           
            <div class="row">
                <div class="hot-page2-alp-con">
                   
                    <div class="col-md-12 hot-page2-alp-con-right">
                        <div class="hot-page2-alp-con-right-1">
                            <!--LISTINGS-->
                            <div class="row">
                                <!--LISTINGS START-->
                                	<?php foreach($product as $products):
 $frontImageurl1 = $this->Html->url('/images/products/'.$products['Product']['image']);

                 $ddthumbImageurl = "images/no-image.jpg";
				?>
                                <div class="hot-page2-alp-r-list">
                                    <div class="col-md-3 hot-page2-alp-r-list-re-sp">
                                        <a href="<?php echo $products['Product']['slug']; ?>.html">
                                            <div class="hotel-list-score">4.5</div>
                                            <div class="hot-page2-hli-1"> <img src="<?=$frontImageurl1;?>" alt=""> </div>
                                             </a>
                                             <a href="<?php echo $products['Product']['url'];?>"><div class="hom-hot-av-tic hom-hot-av-tic-list">Live Preview</div></a>
                                       
                                    </div>
                                    <div class="col-md-6">
                                        <div class="hot-page2-alp-ri-p2">
                                            <a href="<?php echo $products['Product']['slug']; ?>.html">
                                                <h3><?php echo $products['Product']['name']; ?></h3>
                                            </a>
                                            <ul>
                                                <li>Files Included : <font style="font-weight:400;"><?php echo $products['Product']['files_included']; ?></font></li>
                                              <li><font style="font-weight:600;color:#343c42">Browser Support :</font> <?php echo $products['Product']['browsers']; ?></li>   
                                                <li><font style="font-weight:600;color:#343c42">Category :</font> <?php echo $products['Category']['name']; ?></li>
                                            </ul>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="hot-page2-alp-ri-p3">
                                            <div class="hot-page2-alp-r-hot-page-rat">25%Off</div> <span class="hot-list-p3-1"><font style="font-weight:600;color:#343c42">Framework : </font><?php echo $products['Product']['framework']; ?></span> <span class="hot-list-p3-2"><i class="fa fa-inr"></i> <?php echo $products['Product']['discounted_price']; ?></span><span class="hot-list-p3-4">
												<a href="<?php echo $products['Product']['slug']; ?>.html" class="hot-page2-alp-quot-btn">Buy Now</a>
											</span> </div>
                                    </div>
                                </div>
                                <!--END LISTINGS-->
                                <?php endforeach; ?>
                               
                                <!--END LISTINGS-->
                            </div>
                        </div>
                    </div>
                    <!--END RIGHT LISTINGS-->
                </div>
            </div>
        </div>
    </section>

			
	
	

 

