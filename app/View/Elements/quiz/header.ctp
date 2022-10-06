<?php ?>
<?php header( "Cache-Control: no-cache, no-store, must-revalidate"); header( "Pragma: no-cache"); header( "Expires: 0"); ?>
<!-- HEADER -->
   <body id="page-top">
      <nav class="navbar navbar-expand navbar-light bg-white static-top style-nav sticky-top">
       
         <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
         <i class="fas fa-bars"></i>
         </button> &nbsp;&nbsp;
         <a class="navbar-brand mr-1" href="javascript:void(0);"><img class="img-fluid" alt="Engage Geeks" title="Engage Geeks" src="images/<?php echo $sitelogo;?>"></a>
         <!-- Navbar Search -->
         
         <!-- Navbar -->
         <ul class="navbar-nav ml-auto ml-md-0 style-right-navbar" style="position: absolute;right: 0;float: right;">
           <?php if($customer_data) { ?>
            <li class="nav-item dropdown no-arrow style-right-navbar-user">
               <a class="nav-link dropdown-toggle user-dropdown-link" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 <?php if($customer_data['User']['image']) { ?>            
			<img alt="<?php echo $customer_data['User']['first_name']." ".$customer_data['User']['last_name']; ?>" src="images/profiles/<?php echo $customer_data['User']['image'];?>">
 <?php } else { ?>
<img alt="<?php echo $customer_data['User']['first_name']." ".$customer_data['User']['last_name']; ?>" src="<?php if(!empty($customer_data['image'])){echo "images/profiles/".$customer_data['image'];} else{ echo "images/user.png";}?>">

 <?php } ?>
			  <?php echo $customer_data['User']['first_name']." ".$customer_data['User']['last_name']; ?> 

               </a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="customer/myaccount"><i class="fas fa-fw fa-user-circle"></i> &nbsp; My Account</a>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-fw fa-sign-out-alt"></i> &nbsp; Logout</a>
               </div>
            </li>
		   <?php }else { ?>
		   <li class="nav-item active">
               <a class="nav-link" href="customer/login">
              <button class="btn btn-danger border-none" type="button">Login</button>
               </a>
            </li>
		     <a class="nav-link" href="customer/register">
              <button class="btn btn-danger border-none" type="button">Register</button>
               </a>
            </li>
		   <?php } ?>
         </ul>
      </nav>
      <div id="wrapper">
         <!-- Sidebar -->
         <ul class="sidebar navbar-nav">
            <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/") {echo 'active';} ?>">
               <a class="nav-link" href="<?php echo $this->webroot; ?>">
               <i class="fas fa-fw fa-home"></i>
               <span>Leaderboard</span>
               </a>
            </li>
			
            <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/quiz.html") {echo 'active';} ?>">
               <a class="nav-link" href="quiz.html">
               <i class="fas fa-fw fa-question"></i>
               <span>New Quizes</span>
               </a>
            </li>
		     <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/quiz-results.html") {echo 'active';} ?>">
               <a class="nav-link" href="quiz-results.html">
               <i class="fas fa-fw fa-list"></i>
               <span>Results</span>
               </a>
            </li>
            <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/customer/myaccount") {echo 'active';} ?>">
               <a class="nav-link" href="customer/myaccount">
               <i class="fas fa-fw fa-user-alt"></i>
               <span>Profile</span>
               </a>
            </li>
            <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/career.html") {echo 'active';} ?>">
               <a class="nav-link" href="career.html">
               <i class="fas fa-fw fa-graduation-cap"></i>
               <span>Careers</span>
               </a>
            </li>
            <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/faq.html") {echo 'active';} ?>">
               <a class="nav-link" href="faq.html">
               <i class="fas fa-fw fa-cloud-upload-alt"></i>
               <span>FAQ</span>
               </a>
            </li>
          
            <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/tournament-rules.html") {echo 'active';} ?>">
               <a class="nav-link" href="tournament-rules.html">
               <i class="fas fa-fw fa-history"></i>
               <span>Tournament Rules</span>
               </a>
            </li>
			 <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/reward.html") {echo 'active';} ?>">
               <a class="nav-link" href="reward.html">
               <i class="fas fa-fw fa-money"></i>
               <span>Rewards</span>
               </a>
            </li>
			 <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/tutorials.html") {echo 'active';} ?>">
               <a class="nav-link" href="tutorials.html">
               <i class="fas fa-fw fa-laptop-code"></i>
               <span>Tutorials</span>
               </a>
            </li>
			 <li class="nav-item <?php if($pageurl=="https://www.engagegeeks.com/contact-us.html") {echo 'active';} ?>">
               <a class="nav-link" href="contact-us.html">
               <i class="fas fa-fw fa-envelope"></i>
               <span>Contact Us</span>
               </a>
            </li>
         </ul>
         <div id="content-wrapper">
		 <?php if($customer_data['User']['country_id']==1) { ?>
		 <div class="not-bar">
		 <p><marquee> Refer and earn 100 points, your referal code is <?=$referalcodenoti['Reward']['code'];?></marquee></p>
		 </div>
	<?php } ?>