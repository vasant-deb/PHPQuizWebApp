<?php ?>
<?php ?>
<section class="page-title o-hidden text-center grey-bg bg-contain animatedBackground" data-bg-img="images/pattern/05.png" style="background-image: url(&quot;images/pattern/05.png&quot;);">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1 class="title"><?php echo $blog['Blog']['name']; ?></h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $this->webroot; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="blog.html">Blogs</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $blog['Blog']['name']; ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div class="page-title-pattern"><img class="img-fluid" src="images/bg/06.png" alt=""></div>
</section>


<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="left-side">
          <div class="post">
            <div class="post-image">
              <img class="img-fluid" src="images/blogs/<?php echo $blog['Blog']['image']; ?>" title="<?php echo $blog['Blog']['name']; ?>" alt="<?php echo $blog['Blog']['name']; ?>">
            </div>
            <div class="post-desc">
             
              <div class="post-title">
                <h2 class="breadcrumb-item active"><?php echo $blog['Blog']['name']; ?></h2>
              </div>
              <p class="lead"><?php echo $blog['Blog']['short_description']; ?></p>
              <p class="lead"><?php echo $blog['Blog']['description']; ?></p>
            </div>
          </div>
          
       
         
        </div>
      </div>
      <div class="col-lg-4 col-md-12 sidebar md-mt-5">
        
        <div class="widget grey-bg px-4 py-4">
          <h5 class="widget-title">Categories</h5>
          <ul class="widget-categories list-unstyled">
            <li> <a href="#">Design Tutorials <span>(5)</span></a>
            </li>
            <li> <a href="#">Branding <span>(8)</span></a>
            </li>
            <li> <a href="#">Arts and Entertainment <span>(4)</span></a>
            </li>
            <li> <a href="#">Blog Post <span>(6)</span></a>
            </li>
            <li> <a href="#">Seo Analysis <span>(3)</span></a>
            </li>
            <li> <a href="#">Online Marketing <span>(15)</span></a>
            </li>
            <li> <a href="#">Email Marketing <span>(12)</span></a>
            </li>
          </ul>
        </div>
        
       
        <div class="widget">
          <h5 class="widget-title">Recent Post</h5>
          <div class="recent-post">
            <ul class="list-unstyled">
              <li class="mb-3">
                <div class="recent-post-thumb">
                  <img class="img-fluid" src="http://themeht.com/loptus/html/images/blog/blog-thumb/01.jpg" alt="">
                </div>
                <div class="recent-post-desc"> <a href="blog-details.html">The Powerfull look for best in 2018</a> 
                  <div class="post-date">23 <span>November 2018</span>
                  </div>
                </div>
              </li>
              <li class="mb-3">
                <div class="recent-post-thumb">
                  <img class="img-fluid" src="http://themeht.com/loptus/html/images/blog/blog-thumb/02.jpg" alt="">
                </div>
                <div class="recent-post-desc"> <a href="blog-details.html">Loptus It's Awesome, We need your help</a> 
                  <div class="post-date">23 <span>November 2018</span>
                  </div>
                </div>
              </li>
              <li>
                <div class="recent-post-thumb">
                  <img class="img-fluid" src="http://themeht.com/loptus/html/images/blog/blog-thumb/03.jpg" alt="">
                </div>
                <div class="recent-post-desc"> <a href="blog-details.html">We Become Best sale marketer in a year!</a> 
                  <div class="post-date">23 <span>November 2018</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

