<?php
/*
<section class="middle-section-inner cross-bg">
<div class="container">

<div class="inner">
<div class="row-fluid ">

  <div class="span12 pull-right">
  <div class="breadcrum">
	<a href="<?php echo $this->webroot;?>">Home</a>   
	&gt; <a href="<?php echo $slug;?>" title="<?php echo $country;?>"><?php echo ucwords($country);?></a>   
	&gt; Market Area
  </div>
<div class="product-box">
<h1>Market Area We Serve</h1>

<ul class="market-list">
	<?php foreach ($locations as $location): ?>
	<li><a href="<?php echo $this->webroot;?><?php echo h($location['Location']['slug']); ?>/market-area.htm"><?php echo h($location['Location']['name']); ?></a></li>
	<?php endforeach; ?>  
	</ul>
</div>
</div>
</div>
</div>
</div>
</section>

   <div class="page-title parallax parallax1" style="background-position: 50% -135px;">
      <div class="section-overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="page-title-heading">
              <h1 class="title">Market Area We Serve</h1>
            </div>
            <!-- /.page-title-captions -->
            <div class="breadcrumbs">
              <ul>
                <li class="home"><i class="fa fa-home"></i><a href="<?php echo $this->webroot;?>">Home</a></li>
				  <li class="home"><i class="fa fa-home"></i><a href="<?php echo $slug;?>" title="<?php echo $country;?>"><?php echo ucwords($country);?></a></li>
                <li>Market Area We Serve</li>
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
    <section class="flat-row page-contact market-area">
      <div class="container">
        <div class="wrap-formcontact style2">
          <div class="row">
		  
		  	<?php 
			if(count($locations) > 0) {
			foreach ($locations as $location):
			?>

            <div class="col-lg-3">
              <div class="iconbox style3">
                <div class="box-header"> </div>
                <div class="box-content"> 
				<a href="<?php echo $this->webroot;?><?php echo h($location['Location']['slug']); ?>/market-area.htm">
				<img src="images/locations/<?php  echo $location['Location']['image'];?>">
                  <h5 class="box-title"><?php echo h($location['Location']['name']); ?></h5>
				  </a>
                </div>
              </div>
            </div>
			
				<?php 
				endforeach;
				}  ?>
            
            
          </div>
        </div>
        
          </div>
        </div>
      </div>
    </section>
*/ ?>
<div class="col-md-12 no-padding">
  	<div class="banner_inner_con">
	</div>
    <div class="services-breadcrumb">
		<div class="inner_breadcrumb">

			<ul class="short">
				<li><a href="index.html">Home</a><span>|</span></li>
				<li>Our Presence</li>
			</ul>
		</div>
	</div>
    <div class="container">
    	<div class="inner-cont">
        		<h1 class="heading1">Our Presence</h1>
        </div>
    	<div class="col-md-8 detail  market-area">
       <div class="wrap-formcontact style2">
          <div class="row">
		  
		  
		  	<?php 
			if(count($locations) > 0) {
			foreach ($locations as $location):
			?>
		  
            <div class="col-lg-3">
              <div class="iconbox style3">
                <div class="box-header"> </div>
                <div class="box-content"> 
				<a href="<?php echo $this->webroot;?><?php echo h($location['Location']['slug']); ?>/" target="_self">
				<?php if($location['Location']['image']) { ?>
				<img src="images/locations/<?php  echo $location['Location']['image'];?>">
				 <h5 class="box-title"><?php echo h($location['Location']['name']); ?></h5>
				<?php } else { ?>
				
				 <h5 class="box-title"><i class="fa fa-flag fa-2x"></i> <?php echo h($location['Location']['name']); ?></h5>
				<?php } ?>
                 
				  </a>
                </div>
              </div>
            </div>
			
			<?php 
				endforeach;
				}  ?>
				 
            
          </div>
        </div>
        </div>
        </div>
       
    </div>
</div> 
	
            
         	