<div class="container-fluid pb-0">
                  <div class="video-block section-padding">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title">
                        
                           <h6>Tutorials</h6>
                        </div>
                     </div>
                     
                     <?php foreach($blogs as $blog): ?>
                     <div class="col-xl-4 col-sm-6 mb-3">
                        <div class="channels-card">
                           <div class="channels-card-image">
                              <a href="tutorials/<?php echo $blog['Blog']['slug']; ?>"><img class="img-fluid" src="images/blogs/<?php echo $blog['Blog']['image'] ; ?>" title="<?php echo $blog['Blog']['name']; ?>" alt="<?php echo $blog['Blog']['name']; ?>"></a>
                              
                           </div>
                           <div class="channels-card-body">
                              <div class="channels-title">
                                 <a href="tutorials/<?php echo $blog['Blog']['slug']; ?>"><?php echo $blog['Blog']['name']; ?></a>
                                 
                                 <p style="text-align:left;"><?php echo substr($blog['Blog']['short_description'],0,150); ?>....</p>
                              </div>
                              <a href="tutorials/<?php echo $blog['Blog']['slug']; ?>">
                              <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Read More</button></div></a>
                           </div>
                        </div>
                     </div>
                     <?php endforeach;?>
                     
                     </div>
                  </div>   
                  
                  
                  
                  
                  <div class="video-block section-padding">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title">
                          
                           <h6>Tutorial Categories</h6>
                        </div>
                     </div>
                       <?php foreach($categories as $category):?>
                     <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="video-card">
                           <div class="video-card-image">
                              
                              <a href="/category/<?php echo $category['Category']['slug'];?>.html"><img class="img-fluid" src="images/categories/<?php echo $category['Category']['image'];?>" alt=""></a>
                              <div class="time">1</div>
                           </div>
                           <div class="video-card-body">
                              <div class="video-title">
                                 <a href="/category/<?php echo $category['Category']['slug'];?>.html"><?php echo $category['Category']['name'];?></a>
                              </div>
                              
                           </div>
                        </div>
                     </div>
       <?php endforeach;?>
            
                  </div>
               </div>
                  
            </div>