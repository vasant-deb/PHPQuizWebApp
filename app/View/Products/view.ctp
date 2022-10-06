<?php ?>

    <link rel="stylesheet" href="portfolio/style.css">
  
    <link rel="stylesheet" href="portfolio/css/bootstrap.min.css">

    <link rel="stylesheet" href="portfolio/css/jquery.simpleTicker.css">

   
    <link rel="stylesheet" href="portfolio/css/owl.carousel.min.css">

    <link rel="stylesheet" href="portfolio/css/responsive.css">
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
}.button.mid {
    width: 160px;
    height: 42px;
    line-height: 42px;
    font-size: 0.875em;
}
.button.primary {
    background-color: #00d7b3;
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
	
.price.large span {
    font-size: 0.47368em;
}
.price span {
    font-size: 0.6em;
    position: relative;
    top: -2px;
}
.sidebar-item .price.large {
    margin-bottom: 8px;
    text-align: center;
}
.price.large {
    font-size: 3em;
}

.sidebar-item .button {
    width: 100%;
}
.button.mid {
    width: 160px;
    height: 42px;
    line-height: 42px;
    font-size: 0.875em;
}
.button.primary {
    background-color: #00d7b3;
}
.price {
    font-size: 1.25em;
    position: relative;
}
.text-header, .category, .price {
    color: #2b373a;
    font-weight: 700;
    line-height: 1em;
}
.sidebar-item .button {
    width: 100%;
}
.sidebar-item input, .sidebar-item .select-block {
    margin-bottom: 14px;
}
.button.mid {
    width: 160px;
    height: 42px;
    line-height: 42px;
    font-size: 0.875em;
}
.button.dark {
    background-color: #2b373a;
    position: relative;
}
.button {
    display: block;
    width: 120px;
    height: 30px;
    border-radius: 4px;
    color: #fff;
    font-family: "Titillium Web", sans-serif;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 30px;
    text-align: center;
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
	main{
	    padding:0px 0px 0px 0px !important;
	}
</style>
<script>
function calc() 
{
  var price = document.getElementById("ticket_price").innerHTML;
  var noTickets = document.getElementById("num").value;
  var total = parseFloat(price) * noTickets
  if (!isNaN(total))
    document.getElementById("total").innerHTML = total
}
</script>
  <div class="breadcaump-area pt--200 pt_lg--300 pt_md--250 pt_sm--200 pb--100 bg_image--8 breadcaump-title-bar breadcaump-title-white" style="padding-top: 40px;padding-bottom: 0px;background:linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url(https://img.allw.mn/content/za/ug/udz1xrbj56e03080bcc86909547827_500x281.gif);background-size:cover;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcaump-inner text-center">
					<h2 class="heading"><?php echo $product['Product']['name']; ?></h2>
					<div class="breadcrumb-insite">
						<ul class="core-breadcaump">
							<li><a href="<?php echo $this->webroot; ?>">Home</a>
							</li>
					<li><a href="<?php echo $this->webroot; ?>/products">Products</a></li>
					<li><a href="<?php echo $product['Product']['slug']; ?>.html"><?php echo $product['Product']['name']; ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <main class="product-details" style="margin-top:10px;">
       <script src="js/addtocart.js"></script>
        <div class="container">
            <div class="row">
                <?php 
                         $msg = $this->Session->flash(); 
                         echo $msg; 
                         ?> 
                <div class="col-md-8 col-sm-12">
                    <!-- SINGLE PRODUCT START -->
                    <div class="single-product">
                        <div class="s-product-thumb">
                            <img src="images/products/<?php echo $product['Product']['full_image']; ?>" alt="">
                            <h3 class="product-title"><?php echo $product['Product']['name']; ?></h3>
                        </div>
                        <div class="demo-social">
                            <div class="p-demo-btn">
                                <a href="<?php echo $product['Product']['url']; ?>" class="custom-btn">Live Demo <i class="fa fa-eye"></i></a>
                            </div>
                            <div class="p-demo-social">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a>
                                    </li>
                                    <li class="blue"><a href="#"><i class="fa fa-heart-o"></i> 250 </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- S-product Tab Start -->
                        <div class="s-product-tab">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#i-details" aria-controls="i-details" role="tab" data-toggle="tab">Item Details</a>
                                </li>
                                <li role="presentation"><a href="#coupons" aria-controls="coupons" role="tab" data-toggle="tab">View Feedbacks</a>
                                </li>
                                <li role="presentation"><a href="#support" aria-controls="support" role="tab" data-toggle="tab">Support</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="i-details">
                                    <div class="item-detail-tab">
                                        <p><?php echo $product['Product']['description']; ?></p>
                                       <p><?php echo $product['Product']['short_description']; ?></p>
                                       	<iframe src="<?php echo $product['Product']['youtube']; ?>" class="video"></iframe>
                                    </div>
                                    
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="coupons">
                                    <!-- PRODUCTS COMMENT -->
                                    <div class="comment-area">
                                        <ol class="comment-wrap">
                                            <li>
                                                <div class="single-comment">
                                                    <div class="comment-thumb">
                                                        <img src="portfolio/images/blog/comment.jpg" alt="">
                                                    </div>
                                                    <div class="comment-txt">
                                                        <h4 class="name">Denise Lopez <a href="#">04 April 2017</a></h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur.</p>
                                                        <a href="#" class="comment-btn"><i class="fa fa-reply" aria-hidden="true"></i>reply</a>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                           
                                            <li>
                                                <div class="single-comment">
                                                    <div class="comment-thumb">
                                                        <img src="portfolio/images/blog/comment.jpg" alt="">
                                                    </div>
                                                    <div class="comment-txt">
                                                        <h4 class="name">Denise Lopez <a href="#">04 April 2017</a></h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur.</p>
                                                        <a href="#" class="comment-btn"><i class="fa fa-reply" aria-hidden="true"></i>reply</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                    <!-- PRODUCTS COMMENT -->
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="support">
                                    <div class="item-support">
                                        <h3>Need Support?</h3>
                                        <p>24*7 HELP?</p>
                                        <a href="contact.html" class="custom-btn">support</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PRODUCT TAB END -->
                    </div>
                    <!-- SINGLE PRODUCT END -->
                </div>
                <div class="col-md-4 col-sm-12">
                    <aside class="product-sidebar">
                        <div class="section">
			<!-- SIDEBAR -->
			<div class="sidebar right">
			
			<div class="sidebar right">
				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item">
				
					<p class="price large"><span><i class="fa fa-inr"></i></span><?php 
				
$sum=$product['Product']['discounted_price'];
if($total_discounted_price>0){
$final=0;
$y=$total_discounted_price;
$final= $sum-$y;
echo $final;}
else{
echo $sum;}

?></p>
					
 <?php  echo $this->Form->create('Promo'); ?>
					<?php  echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
					<!-- CHECKBOX -->
					<input type="hidden" name="data[Promo][discounted_price]" value="<?php echo $total_discounted_price;?>">
					
				<?php if($total_discounted_price==0){?>	<input type="text" name="data[Promo][coupon_code]" placeholder="Enter your promo code" class="form-control mystyle" required>
				
					 <?php echo $this->Form->button('Redeem Now', array( 'id' => 'redeem', 'id' => $product['Product']['id'],'class'=>'btn-affiliate'));?>
				<?php }?></form>
					
					<hr class="line-separator">
<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

?>
<form action="orders/buynow" method="post" name="order">				
<input type="hidden" name="data[Order][order_id]" value="<?php echo  "ORDS" . rand(10000,99999999)?>">		
<input type="hidden" name="data[Order][user_id]" value="<?php echo $customer_data['User']['id']; ?>" />		
<input type="hidden" name="data[Order][product_id]"  value="<?php echo  $product['Product']['id'];?>">			<!-- CHECKBOX			
					<!-- CHECKBOX -->
					<input type="hidden" name="data[Order][subtotal]" value="<?php 
				
$sum=$product['Product']['discounted_price'];
if($total_discounted_price>0){
$final=0;
$y=$total_discounted_price;
$final= $sum-$y;
echo $final;}
else{
echo $sum;}

?>">

<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="data[Order][ORDER_ID]" autocomplete="off" value="<?php echo  "ORDS" . rand(10000,99999999)?>">
<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="data[Order][CUST_ID]" autocomplete="off" value="<?php echo $customer_data['User']['id']; ?>">
<input type="hidden" type="text" name="data[Order][total]" value="<?php echo  $product['Product']['discounted_price'];?>">		
<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="data[Order][INDUSTRY_TYPE_ID]" autocomplete="off" value="Retail"></td>
<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="data[Order][CHANNEL_ID]" autocomplete="off" value="WEB">
<input type="hidden" title="TXN_AMOUNT" tabindex="10"	type="text" name="data[Order][TXN_AMOUNT]" value="<?php 
				
$sum=$product['Product']['discounted_price'];
if($total_discounted_price>0){
$final=0;
$y=$total_discounted_price;
$final= $sum-$y;
echo $final;}
else{
echo $sum;}

?>">



	<input type="hidden" name="data[Order][status]" value="1" class="form-control mystyle">
					<input type="text" name="data[Order][first_name]" placeholder="Enter your name" class="form-control mystyle" required>
					<input type="email" name="data[Order][email]" placeholder="Enter your email" class="form-control mystyle" required>
					<input type="number" name="data[Order][phone]" placeholder="Enter your phone number" class="form-control mystyle" required>
					 <?php echo $this->Form->button('Buy Now', array('class'=>'btn-affiliate'));?>
             </form>
					<!-- /CHECKBOX -->
					






					
			 <?php  echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'add'))); ?>
			<?php  echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
					
			 
			 <input type="hidden" name="data[Product][product_size]" value="S">
			 <input type="hidden" name="data[Product][quantity]" value="1">
			 <input type="hidden" name="data[Product][color]" value="White">
			
         
              
           
			<?php echo $this->Form->end(); ?>


					
					<div class="clearfix"></div>
				</div>
			
			</div>
			<!-- /SIDEBAR -->
                        
                        <div class="product-widget" style="margin-top:10px">
                            <div class="sells-number">
                                <h3><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span>25</span> sells</h3>
                            </div>
                        </div>
                        <div class="product-widget">
                            <div class="pay-method">
                                <img src="portfolio/images/p-method.png" alt="">
                            </div>
                        </div>

                        <div class="product-widget">
                            <h3 class="prodect-info-heading">item information</h3>
                            <div class="prodect-information">
                                <ul>
                                    <li>
                                        <span class="info-name">item released</span>
                                        <label>:</label>
                                        <span class="info-value"> 21 June 19</span>
                                    </li>
                                    <li>
                                        <span class="info-name">Category</span>
                                        <label>:</label>
                                        <span class="info-value"><?php echo $product['Category']['name']; ?></span>
                                    </li>
                                    <li>
                                        <span class="info-name">Layout</span>
                                        <label>:</label>
                                        <span class="info-value">Responsive</span>
                                    </li>
                                    <li>
                                        <span class="info-name">Compatible browsers</span>
                                        <label>:</label>
                                        <span class="info-value"><?php echo $product['Product']['browsers']; ?></span>
                                    </li>

                                    <li>
                                        <span class="info-name">Files Included :</span>
                                        <label>:</label>
                                        <span class="info-value"><?php echo $product['Product']['files_included']; ?></span>
                                    </li>
                                    <li>
                                        <span class="info-name">Framework</span>
                                        <label>:</label>
                                        <span class="info-value"><?php echo $product['Product']['framework']; ?></span>
                                    </li>
                                  
                                  
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
    <!-- PRODUCT DETAILS AREA END HERE -->

   
    <script src="portfolio/js/jquery.min.js"></script>
    <script src="portfolio/js/bootstrap.min.js"></script>
    <script src="portfolio/js/jquery.meanmenu.js"></script>
    <script src="portfolio/js/isotope.pkgd.min.js"></script>
    <script src="portfolio/js/jquery.stellar.min.js"></script>
    <script src="portfolio/js/jquery.simpleTicker.js"></script>
    <script src="portfolio/js/jquery.syotimer.min.js"></script>
    <script src="portfolio/js/owl.carousel.min.js"></script>
    <script src="portfolio/js/main.js"></script>

