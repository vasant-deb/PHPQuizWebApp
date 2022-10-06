<?php
$company_id = $service['Service']['company_id'];
$service_id = $service['Service']['id'];
$service_type = $service['Service']['servicetype'];
$service_name = $service['Service']['name'];
$service_desc = $service['Service']['description'];
?>

<div class="bg-image page-title">
  <div class="container-fluid"> <a href="#">
    <h1><?php echo $service_name;?></h1>
    </a>
    <div class="pull-right">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active"><?php echo $service_name;?></li>
      </ol>
    </div>
  </div>
</div>
<div class="content_margin-lg" id="content">
  <div class="main-content" role="main">
    <div class="container-fluid block-content">
      <div class="row main-grid">
        <div class="col-sm-3">
          <div class="sidebar-container">
            <ul class="styled">
              <?php
								if($service_type == 1) {
								if(count($services) > 0) {
								?>
              <li><a href="#"> services</a></li>
              <?php
								
								
								foreach ($services as $service): 
								
								if($service['Service']['id'] == $service_id) {
								$active_class = "active"; }
								else { $active_class = ""; }
								?>
              <li  class="<?php echo $active_class;?>"><a href="services/view/<?php echo $service['Service']['id'];?>"><?php echo $service['Service']['name']; ?></a></li>
              <?php 
								endforeach;
								}
								}
								?>
              <?php
								if($service_type == 2) {
								if(count($products) > 0) {
								?>
              <li><a href="#"> products</a></li>
              <?php
								foreach ($products as $product): 
								if($product['Service']['id'] == $service_id) {
								$active_class = "active"; }
								else { $active_class = ""; }
								
								?>
              <li  class="<?php echo $active_class;?>"><a href="services/view/<?php echo $product['Service']['id'];?>"><?php echo $product['Service']['name']; ?></a></li>
              <?php 
								endforeach;
								}
								}
								?>
            </ul>
          </div>
        </div>
        <div class="col-sm-9 main-content"> <img class="img-responsive" src="safeguard/media/blog/900x400/1.jpg" alt="Img">
          <h1><?php echo $service_name;?></h1>
          <div class="post-content">
            <p><?php echo $service_desc;?></p>
          </div>
          <form id="contactForm" class="reply-form form-inline">
            <div class="new-comment">
              <h4>GET A FREE QUOTE</h4>
              <div class="row form-elem">
                <div id="success"></div>
                <input type="hidden" name="enquiry_for" id="enquiry_for" value = "Enquiry For <?php //echo $company_name;?>">
                <input type="hidden" name="company_name"  id="company_name" value = "<?php //echo $company_name;?>">
                <input type="hidden" name="company_id" id="company_id" value = "<?php echo $company_id;?>">
                <input type="hidden" name="service_id" id="service_id" value = "<?php echo $service_id;?>">
                <div class="col-sm-6  form-elem">
                  <div class="default-inp form-elem"> <i class="fa fa-user"></i>
                    <input type="text" name="user-name" id="user-name" placeholder="Full Name" required="required">
                  </div>
                  <div class="default-inp form-elem"> <i class="fa fa-envelope"></i>
                    <input type="text" name="user-email" id="user-email" placeholder="Email Address" required="required">
                  </div>
                  <div class="default-inp form-elem"> <i class="fa fa-phone"></i>
                    <input type="text" name="user-phone" id="user-phone" placeholder="Phone No." required="required">
                  </div>
                  <div class="default-inp form-elem"> <i class="fa fa-pencil"></i>
                    <input type="text" name="user-subject" id="user-subject" placeholder="Subject" required="required">
                  </div>
                </div>
                <div class="col-sm-6  form-elem">
                  <div class="form-elem default-inp">
                    <textarea id="user-message" placeholder="Message"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-elem">
                <button type="submit" class=" btn btn-success btn-default">Send Enquiry</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>