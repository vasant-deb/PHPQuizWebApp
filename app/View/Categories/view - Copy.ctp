<?php ?>
<!-- Start page content -->
  <section id="page-content" class="page-wrapper pt-10">
    <!-- Start Shop Left Side Bar -->
    <div class="shop-left-side-area section-padding">
      <div class="container-fluid">
        <div class="row rp-style-2">
          
          <div class="col-xs-12 col-lg-2 cp-style-2">
            <div class="aside-list">
              <aside class="single-aside mb-40">
                <h5 class="widget-title text-uppercase text-black pb-15"><strong>CATEGORY</strong></h5>
				<form>
				<?php foreach ($categories as $category_data): ?>
		 
<?php $i=0;
foreach ($category_data['ChildCategory'] as $category_item):
$i++;
 ?>	
				<div class="form-check">
					<label>
						<input type="checkbox" class="category_item" value="<?php echo $category_item['id']; ?>" id="exampleCheck<?php echo $category_item['id']; ?>"  > <span class="label-text" for="<?php echo $category_item['id']; ?>"><?php echo $category_item['name']; ?></span>
					</label>
				</div>
				<?php endforeach; ?>
				<?php endforeach; ?>
				
			</form>
               
				
              <aside class="single-aside mb-40">
                <h5 class="widget-title text-uppercase text-black pb-15"><strong>MATERIALS</strong></h5>
               <form>
			
		 
<?php 
foreach ($materials as $material):

 ?>	
				<div class="form-check">
					<label>
						<input type="checkbox" name="check" class="material" value="<?php echo $material['Material']['id']; ?>" id="exampleCheck<?php echo $material['Material']['id']; ?>"> <span class="label-text"><?php echo $material['Material']['name']; ?></span>
					</label>
				</div>
				<?php endforeach; ?>
				
				
				
			</form>
              </aside>
              <aside class="single-aside mb-40">
                <h5 class="widget-title text-uppercase text-black pb-15"><strong>FILTER BY PRICE</strong></h5>
                <div class="price-filter mt-10">
                  <div class="price-slider-amount mb-10">
				  
					<div id="rangeBox">    
					<div id="sliderBox">
					<input type="range" id="slider0to50" step="5" min="500" max="995" value="500">
					<input type="range" id="slider51to100" step="5" min="500" max="1200" value="1000">
					</div>
					<div id="inputRange">
					<input type="number" step="5" min="500" max="995" placeholder="Min" id="min" value="500">
					<input type="number" step="5" min="500" max="1200" placeholder="Max" id="max" value="1200">
					</div>
					</div>
					

				  <?php /*
                    <div id="productslider-range"></div>
                    <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
					*/ ?>
                  </div>
                </div>
              </aside>
              <aside class="single-aside mb-40">
                <h5 class="widget-title text-uppercase text-black pb-15 mb-30"><strong>FILTER BY SIZE</strong></h5>
                <form>
				
<?php $i=0;
foreach ($product_sizes as $size):
$i++;
 ?>	
				<div class="form-check">
					<label>
						<input type="checkbox" name="check" class="size" value="<?php echo $size['Size']['id']; ?>" id="exampleCheck<?php echo $size['Size']['id']; ?>" > <span class="label-text"><?php echo $size['Size']['name']; ?></span>
					</label>
				</div>
				<?php endforeach; ?>
				
				
			</form>
              </aside>
              <aside class="single-aside mb-40 pb-20">
                <h5 class="widget-title text-uppercase text-black pb-15 mb-30"><strong>FILTER BY COLOR</strong></h5>
                <form>
				
		 
<?php 
foreach ($product_colors as $color_item):

 ?>	
				<div class="form-check">
					<label>
						<input type="checkbox" name="check" class="color_item" value="<?php echo $color_item['Color']['id']; ?>" id="exampleCheck<?php echo $color_item['Color']['id']; ?>" > <span class="label-text"><?php echo $color_item['Color']['name']; ?></span>
					</label>
				</div>
				<?php endforeach; ?>
				
				
			</form>
              </aside>
            </div>
          </div>
		  <div class="col-xs-12 col-lg-10 cp-style-2">
            <!-- Start Shop Pagination Area -->
            <div class="shop-view-area">
              <div class="row">
                <div class="col-md-2 col-lg-3">
                  <div class="shop-tab-pill">
                    <ul>
                      <li class="active"><a href="#home" data-toggle="pill"><i aria-hidden="true" class="fa fa-th"></i></a></li>
                      <li><a href="#menu1" data-toggle="pill"><i aria-hidden="true" class="fa fa-list"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 hidden-xs">
                  <div class="shop-tab-pill">
                    <div class="show-label">
                      <label>Sort by : </label>
                      <select>
                        <option value="position" selected="selected">Position</option>
                        <option value="Name">Name</option>
                        <option value="Price">Price</option>
                      </select>
                    </div>
                    
                  </div>
                </div>
               
              </div>
            </div>
            
            <div class="product-list-tab modify-tnm">
              <div class="product-list tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="home">
                  <div class="shop-left-side-area rp-style-2" id="productdata">
				  <div id="materialdata">
				    <div id="sizedata">
					 <div id="colorsdata">
                    
                   
					<?php if($categories_products > 0) { ?>	
								<?php 
								foreach ($categories_products as $product_item):

								$frontImageurl = $this->Html->url('/images/products/'.$product_item['Product']['image']);
								 
								$ddthumbImageurl = "images/no-image.jpg";
								
								$product = $product_item;
								
								?>
                    <div class="product-inner cp-style-2 mt-30"> <a href="<?php echo $product['Product']['slug']; ?>.html">
                      <div class="product-img b-img">  <?php 
				if($product['Product']['image'] != '') {
				?>
				<img alt="" src="<?php echo $frontImageurl; ?>"> 
				<?php } else { ?>
				<img alt="" src="<?php echo $ddthumbImageurl; ?>">
				<?php } ?></div>
                      </a> <span class="product-tag text-uppercase black-bg">new</span>
                      <ul class="quick-veiw text-center">
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
						
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                      </ul>
                      <div class="product-text pt-10">
                        <ul class="pull-left list-inline ratings">
                          <li><i class="rated fa fa-star"></i></li>
                          <li><i class="rated fa fa-star"></i></li>
                          <li><i class="rated fa fa-star"></i></li>
                          <li><i class="rated fa fa-star"></i></li>
                          <li><i class="rated fa fa-star"></i></li>
                        </ul>
                        <ul class="pricing list-inline pull-right">
                          <li class="text-right c-price text-defualt"><i class="fa fa-inr"></i> <?php echo $product['Product']['discounted_price']; ?></li>
                          <li class="text-right p-price"><i class="fa fa-inr"></i> <?php echo $product['Product']['price']; ?></li>
                        </ul>
                        <div class="clear"></div>
                        <h6 class="product-name m-0"> <a title="Celletria ostma" href="<?php echo $product['Product']['slug']; ?>.html"><?php echo $product['Product']['name']; ?></a> </h6>
                      </div>
                    </div>
					<?php endforeach; } ?>
                    
                    
                    
                    
                   
                    
                    
                     
                   </div>
                   </div>
                  </div>
                </div>
				</div>
                <div role="tabpanel" class="tab-pane fade modify2" id="menu1">
                  <div class="product-container-list rp-style-2">
				  <?php if($categories_products > 0) { ?>	
								<?php 
								foreach ($categories_products as $product_item):

								$frontImageurl = $this->Html->url('/images/products/'.$product_item['Product']['image']);
								 
								$ddthumbImageurl = "images/no-image.jpg";
								
								$product = $product_item;
								
								?>
                    <div class="cp-style-2 mt-30">
                      <div class="product-inner-list clearfix">
                        <div class="product-img-list"> <a href="<?php echo $product['Product']['slug']; ?>.html">
                          <div class="product-img b-img">  <?php 
				if($product['Product']['image'] != '') {
				?>
				<img alt="" src="<?php echo $frontImageurl; ?>"> 
				<?php } else { ?>
				<img alt="" src="<?php echo $ddthumbImageurl; ?>">
				<?php } ?></div>
                          </a> <span class="product-tag text-uppercase black-bg">new</span> </div>
                        <div class="product-text product-text-list gray-ash-bg">
                          <h5 class="product-name-list"> <a title="Montria jastma" href="<?php echo $product['Product']['slug']; ?>.html"><strong><?php echo $product['Product']['name']; ?></strong></a> </h5>
                          <ul class="pull-left list-inline ratings rating-list pb-20">
                            <li><i class="rated fa fa-star"></i></li>
                            <li><i class="rated fa fa-star"></i></li>
                            <li><i class="rated fa fa-star"></i></li>
                            <li><i class="rated fa fa-star"></i></li>
                            <li><i class="rated fa fa-star"></i></li>
                            <li class="reviews text-theme"><span>10</span>Review(s)</li>
                          </ul>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                          <ul class="pricing pricing-list">
                            <li class="text-right p-price text-center"><i class="fa fa-inr"></i> <?php echo $product['Product']['price']; ?></li>
                            <li class="text-right c-price text-defualt text-center"><i class="fa fa-inr"></i> <?php echo $product['Product']['discounted_price']; ?></li>
                          </ul>
                          <div class="clear"></div>
                          <ul class="quick-veiw-list">
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a href="#"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#"><i class="fa fa-refresh"></i></a></li>
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
				  <?php endforeach; } ?>
                   
                                      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End page content -->
   
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

 

<style>
#rangeBox{ /* carry complete  range box*/
    width:300px;
    height:100px;
    
    }
    #sliderBox{
    position:relative;
    top:0%;
    width:300px;  /*2x width*/
    }
    #slider0to50{
    width:150px;/*1x width*/
    position:absolute;
    left:0%;
    }
    #slider51to100{
    width:150px;/*1x width*/
    position:absolute;
    left:50%;
    }
    #inputRange{
    position:relative;
    top:50%;
    }
    #inputRange::after{
    content:"";
    clear:both;
    display:block
    }
    #inputRange #min{
     width:40%;
    float:left;
     }   
    #inputRange #max{
     width:40%;
    float:right;
    }
</style>


<script>
 var sliderLeft=document.getElementById("slider0to50");
 var sliderRight=document.getElementById("slider51to100");
 var inputMin=document.getElementById("min");
 var inputMax=document.getElementById("max");

///value updation from input to slider
//function input update to slider
function sliderLeftInput(){//input udate slider left
    sliderLeft.value=inputMin.value;
}
function sliderRightInput(){//input update slider right
    sliderRight.value=(inputMax.value);//chnage in input max updated in slider right
}

//calling function on change of inputs to update in slider
inputMin.addEventListener("change",sliderLeftInput);
inputMax.addEventListener("change",sliderRightInput);
	
///value updation from slider to input
//functions to update from slider to inputs 
function inputMinSliderLeft(){//slider update inputs
    inputMin.value=sliderLeft.value;
}
function inputMaxSliderRight(){//slider update inputs
    inputMax.value=sliderRight.value;
}
sliderLeft.addEventListener("change",inputMinSliderLeft);
sliderRight.addEventListener("change",inputMaxSliderRight);
 
function pricefilter() {	
	
var minprice_value = inputMin.value;
var maxprice_value = inputMax.value;
		 			
			alert(minprice_value);
			alert(maxprice_value);
	}


sliderLeft.addEventListener("change",pricefilter);
sliderRight.addEventListener("change",pricefilter);

sliderLeft.addEventListener("change",pricefilter);
sliderRight.addEventListener("change",pricefilter);


</script>	
   
   
<script src="unknown/js/vendor/jquery-1.12.4.min.js"></script>
<script src="unknown/js/plugins.js"></script>


<script type="text/javascript">

		function Xpricefilter(minprice,maxprice) {
			 			
						alert(minprice);
						alert(maxprice);
						
						/*						
						var checkedVals = $('.category_item:checkbox:checked').map(function() {
						return this.value;
						
						}).get();
						
						category_ids = checkedVals.join(",");
												  								 							
                           $.ajax({   

                                url: "categories/productdata",  

                                async: false,

                                type: "POST",  

                               data: "category_ids="+category_ids+"minprice="+minprice+"maxprice="+maxprice,                          
							
                                dataType: "html",  
                               
                                success: function(data) { 
								
								console.log(data);
								 								   
                                    $('#productdata').html(data);

                                }
                            })
							
							*/
               
		}
		
                    $(".category_item").change(function() {	
 						
						var checkedVals = $('.category_item:checkbox:checked').map(function() {
						return this.value;
						
						}).get();
						
						category_ids = checkedVals.join(",");
 								 							
                           $.ajax({   

                                url: "categories/productdata",  

                                async: false,

                                type: "POST",  

                               data: "category_ids="+category_ids,                           
							
                                dataType: "html",  
                               
                                success: function(data) { 
								 								   
                                    $('#productdata').html(data);

                                }

                            })

                });	
				
				
                    $(".material").change(function() {	
 						
						var checkedVals = $('.material:checkbox:checked').map(function() {
						return this.value;
						
						}).get();
						
						material_ids = checkedVals.join(",");
 								 							
                           $.ajax({   

                                url: "categories/materialdata",  

                                async: false,

                                type: "POST",  

                               data: "material_ids="+material_ids,                           
							
                                dataType: "html",  
                               
                                success: function(data) { 
								 	//alert(data);							   
                                    $('#materialdata').html(data);

                                }

                            })

                });	
				
				$(".size").change(function() {	
 						
						var checkedVals = $('.size:checkbox:checked').map(function() {
						return this.value;
						
						}).get();
						
						sizes = checkedVals.join(",");
 								 							
                           $.ajax({   

                                url: "categories/sizedata",  

                                async: false,

                                type: "POST",  

                               data: "sizes="+sizes,                           
							
                                dataType: "html",  
                               
                                success: function(data) { 
								 	//alert(data);							   
                                    $('#sizedata').html(data);

                                }

                            })

                });	
	 
	 $(".color_item").change(function() {	
 						
						var checkedVals = $('.color_item:checkbox:checked').map(function() {
						return this.value;
						
						}).get();
						
						colors = checkedVals.join(",");
 								 							
                           $.ajax({   

                                url: "categories/colorsdata",  

                                async: false,

                                type: "POST",  

                               data: "colors="+colors,                           
							
                                dataType: "html",  
                               
                                success: function(data) { 
								 	//alert(data);							   
                                    $('#colorsdata').html(data);

                                }

                            })

                });	
	 
</script>