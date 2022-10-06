<?php ?>

	 <!-- Blog Section -->
<div class="blgpst-mncntnr">
		<div class="bgnm-wrapr bgnm-wrapr-blgpst">
			<div class="bgnm-txt bgnm-txt-blog"><div></div></div>
		</div>
		<div class="htwo-prime1 blgpst-hdrttl">Our Content House</div>
		<div class="blgpst-mnwrapr">
		<!--main container-->
		<div class="container">
		<div class="row">
			<?php foreach($blogs as $blog): ?>
		<div class="col-md-4 col-lg-4 col-sm-12">
						<a href="blogs/<?php echo $blog['Blog']['slug']; ?>.html" ><!--column-->
				<div class="blgpst-thumb-bx">
					<div class="blgpst-img"><img class="blgpst-img0" src="images/blogs/<?php echo $blog['Blog']['image'] ; ?>" alt="<?php echo $blog['Blog']['name']; ?>" title="<?php echo $blog['Blog']['name']; ?>" ></div>
				</div>
				<div class="blgpst-content"><!--bottom box-->
					<div class="blgpst-ttl"><?php echo $blog['Blog']['name']; ?></div>
					<div class="blgpst-dsc"><?php echo substr($blog['Blog']['short_description'],0,150); ?>....</div>
					<div class="blgpst-btn"><span class="btn-blu1-clr">Read More</span></div>
				</div>
			</a>
			</div>
			<?php endforeach;?>
			<div class="clearfix"></div>
			</div>
			</div>
					</div>
	</div>
	     <!-- End Blog section -->
	


	