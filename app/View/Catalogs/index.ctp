<?php
function convertToMenu($arr, $elmkey,$directory_name) {
        echo "<ul class='submenu'>";
        foreach ($arr as $val) {
                if (!empty($val['children'])) {
                        echo "<li>" ;
						?>
						<a href="<?php echo $directory_name;?>/<?php echo h($val[$elmkey]['slug']); ?>.html">
						<?php echo $val[$elmkey]['name']. " $directory_name";
                        convertToMenu($val['children'], $elmkey,$directory_name);
						 echo "</a>";
                        echo "</li>";
                } else {
                        echo "<li>" ;
						?>
						<a href="<?php echo $directory_name;?>/<?php echo h($val[$elmkey]['slug']); ?>.html">
						<?php 
						echo $val[$elmkey]['name'] . " $directory_name"; 
						 echo "</a>";
						 echo "</li>";
                }
        }
        echo "</ul>";
    }
 
 ?>

<div class="col-md-12 no-padding">
  	<div class="banner_inner_con">
	</div>
    <div class="services-breadcrumb">
		<div class="inner_breadcrumb">
			<ul class="short">
				<li><a href="<?php echo $this->webroot;?>">Home</a><span>|</span></li>
				<li><?php echo $catalog['Catalog']['name'];?></li>
			</ul>
		</div>
	</div>
    <div class="container">
      <div class="inner-cont">
        <h1 class="heading1"><?php echo $catalog['Catalog']['name'];?></h1>
      </div>
      <div class="col-md-8 detail">
        <div class="col-sm-12 sitemap">   

			<?php  convertToMenu($listmyproducts, 'Product',$directory_name); ?>
		      
        </div>
      </div>
            <?php  echo $this->element('sunrise/enquiry'); ?> 
    </div>
  </div>