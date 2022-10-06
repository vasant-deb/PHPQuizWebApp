<!-- Page title -->
    <div class="page-title parallax parallax1">
        <div class="section-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="page-title-heading">
                        <h1 class="title"><?php echo $blog['Blog']['name'];?></h1>
                    </div><!-- /.page-title-captions -->  
                    <div class="breadcrumbs">
                        <ul>
                            <li class="home"><i class="fa fa-home"></i><a href="<?php echo $this->webroot;?>">Home</a></li>
                            <li><a href="blog.htm">Blogs</a></li>   
							<li><?php echo $blog['Blog']['name'];?></li> 							
                        </ul>                   
                    </div><!-- /.breadcrumbs --> 
                </div><!-- /.col-md-12 -->  
            </div><!-- /.row -->  
        </div><!-- /.container -->                      
    </div><!-- /.page-title --> 

    <!-- Blog posts -->
    <section class="flat-row blog-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget widget-nav-menu">
                            <ul class="widget-menu">
<?php  		
						
if(count($blogs) > 0) {
						
foreach ($blogs as $article): 
 

?>
<li class="<?php if($article['Blog']['id'] == $blog['Blog']['id']) { echo "active"; } ?>"><a href="blog/<?php echo $article['Blog']['slug'];?>.htm"><?php echo $article['Blog']['name'];?></a></li>
<?php 
endforeach;
}				
?>
     
                            </ul>
                        </div>

                      
  
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="post-wrap post-list">

<?php  		
 
$sthumbImageurl = 'images/blogs/'.$blog['Blog']['image'];
$bImageurl = "http://www.placehold.it/337x252/EFEFEF/AAAAAA&amp;text=no+image"; //"images/no-image.jpg";

$bImageurl = ($blog['Blog']['image'] != '')?$sthumbImageurl:$bImageurl;

$created   = date('d F Y',strtotime($blog['Blog']['created']));

?>
                        <article class="entry border-shadow clearfix effect-animation"  data-animation="fadeInUp" data-animation-delay="0.2s" data-animation-offset="75%">
                            <div class="entry-border clearfix">
                                <div class="featured-post">
                                     <a href="blog/<?php echo $blog['Blog']['slug'];?>.htm"> 
									  <img src="<?php echo $bImageurl;?>" class="img-responsive" alt="<?php echo $blog['Blog']['name'];?>">
									 </a>
                                </div>
                                <div class="content-post">
                                    <span class="category">Category : <?php echo $blog['Category']['name'];?></span>
                                    <h2 class="title-post">
									<a href="blog/<?php echo $blog['Blog']['slug'];?>.htm"><?php echo $blog['Blog']['name'];?></a>
									</h2>
                                    <p><?php echo $blog['Blog']['description'];?></p>
                                     </div>
									
                               
                            </div>
                        </article>
					 
                    
                    </div> 
					<!--
                    <div class="blog-pagination clearfix">
                        <ul class="flat-pagination  float-left clearfix">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li class="next"><a href="#">Next<i class="fa fa-angle-double-right"></i></a></li>                               
                        </ul> 
                        <div class="count-page float-right">
                            <span>Page 1 of 60 results</span>
                        </div>
                    </div> 
					-->
                </div>
            </div>           
        </div>   
    </section>   
         