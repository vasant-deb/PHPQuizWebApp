<section class="middle-section-inner cross-bg">
<div class="container">
<div class="inner">
<div class="row-fluid ">
<div class="span3 hidden-phone">
 
<?php  echo $this->element('brilltechcatalog/categories/leftmenu', array('country' => ucfirst($country), 'category_id' => $category['Category']['id'])); ?>


<?php  echo $this->element('brilltechcatalog/categories/categories_list', array('sub_categories' => $sub_categories)); ?>

</div>

<div class="span9 pull-right">

<div class="breadcrum">
<a href="<?php echo $this->webroot;?>" title="Home">Home</a> 
 <?php 
 if($category['Category']['parent_id'] > 0) {
 ?>
 &gt; <a href="<?php echo $country;?>/<?php echo $category['ParentCategory']['slug'];?>.htm" title="<?php echo $category['ParentCategory']['name'];?>"><?php echo $category['ParentCategory']['name'];?></a> 
 <?php } ?>
&gt; <?php echo $category['Category']['name']; ?>
</div>
 

<div class="product-box"> 
 <h1><?php echo $category['Category']['name']; ?> In <?php echo ucfirst($country); ?></h1>

<p><font color="black">
<?php 

//echo html_entity_decode($category['Category']['description']); 
?>
<?php 
	$aa  = @$mainsubdomain['Catalog']['description'];
	$cc  = str_replace('countryname', $country, $aa );
	$ccc = str_replace('catname', $category['Category']['name'], $cc );
	 
	echo html_entity_decode($ccc);

?>
</font>

</p>


<?php  		
						
if(count($sub_categories) > 0) {
?>
<p class="detail">For more details please click on the links given below</p>
<?php 						
foreach ($sub_categories as $sub_category): 
$sthumbImageurl = 'img/upload_images/category_images/'.$sub_category['Category']['image'];
$sImageurl = "http://www.placehold.it/250x250/EFEFEF/AAAAAA&amp;text=no+image";

$sImageurl = ($sub_category['Category']['image'] != '')?$sthumbImageurl:$sImageurl;
?>
<div class="sub-category-box"><h2>
<a href="<?php echo $country;?>/<?php echo $sub_category['Category']['slug']; ?>.htm" title="<?php echo $sub_category['Category']['name']; ?>">
<?php echo $sub_category['Category']['name']; ?> In <?php echo ucfirst($country); ?>
</a>
</h2>
<div class="line"></div>
<div class="content-area">
<div class="row-fluid">
<div class="span2"> <a href="<?php echo $country;?>/<?php echo $sub_category['Category']['slug']; ?>.htm" title="<?php echo $sub_category['Category']['name']; ?>">
<img src="<?php echo $sImageurl;?>" title="<?php echo $sub_category['Category']['name']; ?>" alt="<?php echo $sub_category['Category']['name']; ?>"></a></div>
<div class="span10 des">
<?php 
 
	$scc  = $subdomain['Catalog']['description'];
	$scc  = str_replace('countryname', $country, $scc );
	$scc = str_replace('catname', $sub_category['Category']['name'], $scc );
	 
	echo html_entity_decode($scc);
 ?>
<a href="<?php echo $country;?>/<?php echo $sub_category['Category']['slug']; ?>.htm" title="<?php echo $sub_category['Category']['name']; ?>">more...</a> </div></div>

<ul class="sub-links">
</ul>
</div>
</div>

<?php 
endforeach;
}
?>	
</div>
</div>
</div>
</div>
</div>
</section>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<!--
<script>
 $('*:contains("Extension")').each(function(){
	 
     if($(this).children().length < 1) 		  
          $(this).css("border","solid 2px blue");
	      $(this).css("color","orange");	
       $(this).closest('div').html('');
		  
	  });  
</script>
-->
      <!-- <pre> <?php echo $this->element('sql_dump'); ?> </pre> -->
