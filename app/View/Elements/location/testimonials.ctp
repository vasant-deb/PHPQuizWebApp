<?php ?>
<section id="testim" class="testim" style="background:url(images/testimonial-background.jpg);background-size:cover;">
<!--         <div class="testim-cover"> -->
            <div class="wrap">

                <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
                <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>
                <ul id="testim-dots" class="dots">
				<?php $active=""; ?>
				 <?php foreach($testimonials as $testimonial): ?>
				 <?php if($testimonial['Testimonial']['id']==1) { $active="active";} else { $active="" ;} ?>
                    <li class="dot <?php echo $active; ?>"></li>
                      <?php endforeach; ?>
                </ul>
                <div id="testim-content" class="cont">
                    <?php $active=""; ?>
				 <?php foreach($testimonials as $testimonial): ?>
				 <?php if($testimonial['Testimonial']['id']==1) { $active="active";} else { $active="" ;} ?>
                    <div class="<?php echo $active; ?>">
                        <div class="img"><img src="images/testimonials/<?php echo $testimonial['Testimonial']['image'];?>" alt=""></div>
                        <h2><?php echo $testimonial['Testimonial']['name'];?></h2>
                        <p><?php echo $testimonial['Testimonial']['short_description'];?></p>                   
                    </div>
  <?php endforeach; ?>
                   
                </div>

            </div>
<!--         </div> -->
    </section>
