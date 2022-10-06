   <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
          <!-- Left-Sidebar-start-->
          <div class="left-sidebar-title">
            <h2>Product</h2>
          </div>
          <!-- Shop-Layout-start -->
          <div class="left-sidebar">
            <div class="shop-layout">
              <div class="layout-title">
                <h2>Category</h2>
              </div>
              <div class="layout-list">
                <ul>				 
                    <?php foreach ($categories as $category_data): ?>					 
					<span class="side-main">
					<a href="<?php echo $this->webroot;?><?php echo $directory_name;?><?php echo h($category_data['Category']['slug']); ?>">
					<?php echo h($category_data['Category']['name']); ?>  
					</a>	
					</span>					  
					<?php if(count($category_data['ChildCategory']) > 0) { ?>					     
					<?php foreach ($category_data['ChildCategory'] as $cproduct): ?>	
					<li><a href="<?php echo h($category_data['Category']['slug']); ?>/products/<?php echo $cproduct['slug'];?>"><?php echo $cproduct['name'];?></a></li>
					<?php endforeach; ?>						 
					<?php } ?>					 
					<?php endforeach; ?>
                </ul>
              </div>              
              
			 
			  <?php if($product_colors > 0) { ?>	
              <div class="shop-layout">
              <div class="layout-title">
                <h2>Colors</h2>
              </div>
              <div class="layout-list">
                <ul>
				<?php foreach ($product_colors as $color_item): ?>
                  <li><a href="#"><?php echo h($color_item['Color']['name']); ?></a></li>
                <?php endforeach; ?>
              </ul>
              </div>
            </div>
			<?php } ?>      
			<?php if($product_sizes > 0) { ?>				
            <div class="shop-layout">
              <div class="layout-title">
                <h2>Sizes</h2>
              </div>
              <div class="layout-list">
                <ul>
				<?php foreach ($product_sizes as $size_name): ?>
                   <li><a href="#"><?php echo h($size_name['Size']['name']); ?></a></li>
                <?php endforeach; ?>
              </ul>
              </div>
            </div>
            </div>
			<?php } ?>      
            <!-- Shop-Layout-end -->
            <!-- Price-Filter-start -->
            <div class="price-filter-area shop-layout">
              <div class="price-filter">
                <div class="layout-title">
                  <h2>Price</h2>
                </div>
              							 <p> 
                                          <label class="range-text">Range:</label>
                                          <input type="text" style="border:0; color:#f6931f; font-weight:bold;" readonly="" id="amount">
                                        </p>
                <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                  <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                  <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></span>
                  <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
                </div>
                <button class="btn btn-default">show</button>
              </div>
            </div>
            <!-- Price-Filter-end -->
          <div class="shop-banner-area">
                                <div class="left-sidebar-title">
                                    <h2 class="compare-title contact">Compare Products</h2>
                                </div>
                                <div class="layout-list compare">
                                    <ul>
                                        <li><a href="#">occaecati cupiditate</a><span class="compare-icon"><i class="fa fa-trash"></i></span></li>
                                        <li><a href="#">consequences</a><span class="compare-icon"><i class="fa fa-trash"></i></span></li>
                                        <li><a href="#">pleasure rationally</a><span class="compare-icon"><i class="fa fa-trash"></i></span></li>
                                    </ul>
                                    <div class="compare-action">
                                        <div class="clear-button">
                                            <a href="#">clear all</a>
                                        </div>
                                        <div class="product-cart compare">
                                            <button class="button">compare</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
          </div>
          <!-- End-Left-Sidebar -->
         
         
         
          <!-- Shop-Layout-Banner-start -->
          <!-- Shop-Layout-Banner-end -->
        </div>
		