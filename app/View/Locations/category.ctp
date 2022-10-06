<div class="page-title parallax parallax1">
    <div class="section-overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="page-title-heading">
            <h1 class="title"><?php echo $category['Category']['name']; ?></h1>
          </div>
          <!-- /.page-title-captions -->
          <div class="breadcrumbs">
            <ul>
			<li class="home"><i class="fa fa-home"></i><a href="<?php echo $this->webroot;?>">Home</a></li>
			<?php 
			if($category['Category']['parent_id'] > 0) {
			?>
			<li><a href="<?php echo $country;?>/<?php echo $category['ParentCategory']['slug'];?>.htm" title="<?php echo $category['ParentCategory']['name'];?>"><?php echo $category['ParentCategory']['name'];?></a></li>     
			<?php } ?>
			<li><a href="<?php echo $country;?>/<?php echo $category['Category']['slug'];?>.htm"><?php echo $category['Category']['name']; ?></a></li>   
            </ul>
          </div>
          <!-- /.breadcrumbs -->
        </div>
        <!-- /.col-md-12 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </div>
<?php
$thumbImageurl = 'images/categories/'.$category['Category']['image'];
$Imageurl = "http://www.placehold.it/250x250/EFEFEF/AAAAAA&amp;text=no+image";

$Imageurl = ($category['Category']['image'] != '')?$thumbImageurl:$Imageurl;
?> 
  <div class="section-maps-form style2 parallax parallax4">
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <div class="item item-details">
            <h2 class="title-item"><?php echo $category['Category']['name']; ?></h2>
            <div class="featured-item image-size"> 
			<img src="<?php echo $Imageurl;?>" alt="<?php echo $category['Category']['name']; ?>">
			<br> <br> 
			</div>
            <!-- /.feature-post -->
            <div class="content-item">
	<?php 
	$aa  = @$mainsubdomain['Catalog']['description'];
	$cc  = str_replace('countryname', $country, $aa );
	$ccc = str_replace('catname', $category['Category']['name'], $cc );
	 
	echo html_entity_decode($ccc);

	?>


              <!-- Products details stated  -->
              <section class="flat-row section-iconbox padding0">
                <div class="container">
                  <div class="row">
				  
				  		
			
			<?php  		
						
if(count($sub_categories) > 0) {
						
foreach ($sub_categories as $sub_category): 
$sthumbImageurl = 'images/categories/'.$sub_category['Category']['image'];
$sImageurl = "http://www.placehold.it/250x250/EFEFEF/AAAAAA&amp;text=no+image";

$sImageurl = ($sub_category['Category']['image'] != '')?$sthumbImageurl:$sImageurl;
 
 
	$scc  = @$subdomain['Catalog']['description'];
	$scc  = str_replace('countryname', $country, $scc );
	$scc = str_replace('catname', $sub_category['Category']['name'], $scc );
	 
	$sub_category_content = strip_tags($scc);
?>
                    <div class="col-lg-4">
                      <div class="iconbox style3">
                        <div class="box-header"> </div>
                        <div class="box-content"> 
							<img src="<?php echo $sImageurl;?>" alt="<?php echo $sub_category['Category']['name']; ?>">
                              <h5 class="box-title"><?php echo $sub_category['Category']['name']; ?></h5>  
                            <p><?php echo substr($sub_category_content,0,145); ?></p> 
                          <div class="btn-click"> <a href="<?php echo $country;?>/<?php echo $sub_category['Category']['slug']; ?>.htm" class="flat-button">Read more</a> </div>
                        </div>
                      </div>
                    </div>
					
				<?php 
endforeach;
}				
?>             
      	 
                  </div>
                </div>
              </section>
              <!-- product details ended   -->
            </div>
            <!-- /.content-item -->
          </div>
        </div>
        <div class="col-lg-3" id="contact-form">
          <!--  form  -->
		  
		  <?php  echo $this->element('catalog/categories_enquiry', array('country' => ucfirst($country), 'category_id' => $category['Category']['id'])); ?>

       
          <!--  form  -->
        
				  
				    <?php  echo $this->element('catalog/categories_list', array('sub_categories' => $sub_categories)); ?>
  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>