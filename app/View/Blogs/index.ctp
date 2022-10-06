<?php ?>
<section class="page-title o-hidden text-center grey-bg bg-contain animatedBackground" data-bg-img="images/pattern/05.png" style="background-image: url(&quot;images/pattern/05.png&quot;);">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1 class="title">Our Content</h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $this->webroot; ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Our Content</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div class="page-title-pattern"><img class="img-fluid" alt="blog background pattern" src="images/bg/06.png" alt=""></div>
</section>
   <section>
  <div class="container">
    <div class="row">
        <?php foreach($blogs as $blog): ?>
      <div class="col-lg-4 col-md-6">
        <div class="post">
          <div class="post-image">
            <img class="img-fluid h-100 w-100" src="images/blogs/<?php echo $blog['Blog']['image'] ; ?>" title="<?php echo $blog['Blog']['name']; ?>" alt="<?php echo $blog['Blog']['name']; ?>">
          </div>
          <div class="post-desc">
            <div class="post-date"><?php 
$ab=$blog['Blog']['created'];
$date = strtotime($ab);
echo date('M jS o', $date); ?></span>
            </div>
            <div class="post-title">
              <h5><a href="blogs/<?php echo $blog['Blog']['slug']; ?>.html"><?php echo $blog['Blog']['name']; ?></a></h5>
              <p><?php echo substr($blog['Blog']['short_description'],0,150); ?>....</p>
            </div>
            <div class="post-author">
                                        <div class="">
                                            <a href="blogs/<?php echo $blog['Blog']['slug']; ?>.html" title="Read More" class="btn btn-theme">Read More</a>
                                        </div> 
                                    </div>
          </div>
        </div>
      </div>
      <?php endforeach ;?>
    </div>
  </div>
</section>
          