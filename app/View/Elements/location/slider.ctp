<?php ?>
<style>
@media screen and (min-width: 768px){
	.carousel{
	    margin-top: 70px;
	}
	.carousel_caption ul {
    padding: 0;
    margin: 14px 0 0;
    overflow: hidden;
  list-style: none;
}
.carousel_caption ul li {
width: 100%;
    float: left;
    position: relative;
    font-size: 21px;
    line-height: 42px;
    padding-left: 20px;
    color: #1e1e1e;
}
	}
	@media screen and (max-width: 768px){
	.header-default.header-transparent {
	    position: relative;
	    top: 0px;
	}
	.carousel-item a {
	    margin-bottom:50px;
    background: #673AB7;
    font-size: 14px;
    color: #FFF;
    padding: 13px 32px;
    display: inline-block;
}
	.carousel_caption ul {
    padding: 0;
    margin: 10px 0 0;
    overflow: hidden;
  list-style: none;
}
	}
.carousel_caption h1 {
font-family: 'Fredericka the Great', cursive !important;
font-size: 36px;
}
.carousel_caption h2 {
    font-family: 'Muli', sans-serif !important;
    font-size: 21px;
}

.carousel_caption ul li:before {
    padding-right:5px;
  content: '✓';
}
</style>

<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
   <ol class="carousel-indicators">
     <?php 
$i=0;
foreach($banners as $banner){

$name= $banner['Banner']['name'];
$url= $banner['Banner']['page_url'];
$description= $banner['Banner']['description'];

if ($i == 0) {
    $status="active";
} else {
   $status="";
}

$i++;

?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i;?>" class="<?=$status;?>"></li>
<?php } ?>
   </ol>
   <div class="carousel-inner">
   <?php 
$i=0;
foreach($banners as $banner){

$name= $banner['Banner']['name'];
$url= $banner['Banner']['page_url'];
$description= $banner['Banner']['description'];
$style= $banner['Banner']['style'];



if ($i == 0) {
    $status="active";
} else {
   $status="";
}

$i++;

?>
      <div class="carousel-item <?=$status;?>" style="<?=$style;?>">
         <div class="mask flex-center">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-md-7 col-12 order-md-1 order-2">
                     <div class="carousel_caption">
                        <h1><?=$name;?></h1>
                       <?=$description;?>
                        
                        <a href="<?=$url;?>">View Now</a>
                     </div>
                  </div>
                  <div class="col-md-5 col-12 order-md-2 order-1"><img src="images/banners/<?=$banner['Banner']['image'];?>" class="mx-auto" alt="<?=$name;?>"></div>
               </div>
            </div>
         </div>
      </div>
	 
<?php } ?>
 
   </div>
   <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
   <span class="sr-only">Previous</span>
   </a>
   <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
   <span class="carousel-control-next-icon" aria-hidden="true"></span>
   <span class="sr-only">Next</span>
   </a>
</div>