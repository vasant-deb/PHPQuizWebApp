<?php ?>

<div class="container-fluid pb-0">
               
   <?php if($customer_data) { ?>
 <div class="row">
                  <div class="col-xl-3 col-sm-6 mb-3">
                     <div class="card text-white bg-primary o-hidden h-100 border-none">
                        <div class="card-body">
                           <div class="card-body-icon">
                              <i class="fas fa-fw fa-users"></i>
                           </div>
                           <div class="mr-5"><b><?php echo $quizesattempted;?></b> Quizes (Attempted)</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="/quiz-results.html">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                        </span>
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 mb-3">
                     <div class="card text-white bg-warning o-hidden h-100 border-none">
                        <div class="card-body">
                           <div class="card-body-icon">
                              <i class="fas fa-fw fa-video"></i>
                           </div>
                           <div class="mr-5"><b>N.A.</b> Tutorials</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="/tutorials.html">
                        <span class="float-left">Coming Soon</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                        </span>
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 mb-3">
                     <div class="card text-white bg-success o-hidden h-100 border-none">
                        <div class="card-body">
                           <div class="card-body-icon">
                              <i class="fas fa-fw fa-list-alt"></i>
                           </div>
                           <div class="mr-5"><b><?php echo $quizeswon;?></b> Quizes Won</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="/quiz-results.html">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                        </span>
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 mb-3">
                     <div class="card text-white bg-danger o-hidden h-100 border-none">
                        <div class="card-body">
                           <div class="card-body-icon">
                              <i class="fas fa-fw fa-cloud-upload-alt"></i>
                           </div>
                           <div class="mr-5"><b><?php echo $quizescount;?></b> New Quizes</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="/quiz.html">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                        </span>
                        </a>
                     </div>
                  </div>
               </div>
			   <hr>
<?php } ?>
			   
			   <?php if(!empty($newreports)) {?>
			   <div class="top-category section-padding mb-4">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title">
                          
                           <h6>Top Rankers</h6>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="owl-carousel owl-carousel-category owl-loaded owl-drag">
                      
                           
                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-2929px, 0px, 0px); transition: all 1s ease 0s; width: 4317px;">
                 <?php $i=1; foreach($newreports as $report): ?>            
			<div class="owl-item" style="width: 154.175px;"><div class="item">
                              <div class="category-item">
                                 <a href="#">
                                     <?php if(!empty($report['UserJoin']['image'])) {?>
                                    <img class="img-fluid" src="images/profiles/<?php echo $report ['UserJoin']['image'];?>" title="<?php echo $report ['UserJoin']['first_name'];?>" alt="<?php echo $report ['UserJoin']['first_name'];?>">
                                   <?php }else { ?>
                                      <img class="img-fluid" src="images/user.png" title="<?php echo $report ['UserJoin']['first_name'];?>" alt="<?php echo $report ['UserJoin']['first_name'];?>">  
                                  <?php }  ?>
                                    <h6><?php echo $report ['UserJoin']['first_name']." ".$report ['UserJoin']['last_name'];?> <br> <?php echo $report ['Report']['quiz_title'];?> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></h6>
                                   
                                 </a>
                              </div>
                           </div></div>
				<?php $i++; endforeach;?>
						
						  </div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="fa fa-chevron-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="fa fa-chevron-right"></i></button></div><div class="owl-dots"><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot active"><span></span></button></div></div>
                     </div>
                  </div>
               </div>
			   
			   <hr>
<?php } ?>

<?php if(!empty($newreports)){?>
               <div class="video-block section-padding">
                  <div class="row">
                 
                    
                     
                     <div class="col-xl-12 col-sm-12 mb-3">
					 
                        <div class="channels-card">
						  <div class="main-title">
                        <h5 class="card-title">General Aptitute</h5>
                          
                        </div>
          <table id="example" class="table  display responsive nowrap table-striped" width="100%" cellspacing="0">
		<thead>
            <tr>
                 <th>Position</th>
                <th>Name</th>
                <th>Username</th>
               
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($newreports as $report): ?>
            <tr>
                <td><?=$i;?></td>
                <td><?php echo $report ['UserJoin']['first_name']." ".$report ['UserJoin']['last_name'];?></td>
                
                <td><?php echo $report ['UserJoin']['username'];?></td>
              
            </tr>
           <?php $i++; endforeach; ?>
			  </tbody>
        
    </table>
   
                        </div>
                     </div>
                     
					   
					          <!--     <div class="col-xl-12 col-sm-12 mb-3">
					 
                        <div class="channels-card">
						  <div class="main-title">
                        <h5 class="card-title">Bootstrap</h5>
                          
                        </div>
                           <table id="example1" class="table  display responsive nowrap" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Email</th>
                <th>Score</th>
				<th>Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>1</td>
                <td>tigerzz@gmail.com</td>
                <td>100</td>
				<td>00:12:01</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>2</td>
                <td>gareet@gmail.com</td>
                <td>100</td>
				<td>00:13:56</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>3</td>
                <td>ashton@gmail.com</td>
                <td>99</td>
				<td>00:11:56</td>
            </tr>
			  </tbody>
       
    </table>
                        </div>
                     </div> -->
					 
                  </div>
               </div>
			
	   
		   <hr class="mt-0">
		   <?php } ?>
		   
		   
		   
		                       <div class="video-block section-padding">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title">
                        
                           <h6>Quizes</h6>
                        </div>
                     </div>
                    
                     	<?php	$i=1; foreach($quizes as $quiz):
	
	$status="";

	if(in_array($quiz['Quizes']['id'],$order_product_id))
	{
	    
	    $status="paid";
	}
	
	?><?php if($quiz['Quizes']['fees']=="0.00" || $status=="paid"){ ?>
	              <div class="col-xl-4 col-sm-6 mb-3">
                        <div class="channels-card">
                           <div class="channels-card-image">
                              <a href="#popup<?=$i;?>"><img class="img-fluid" src="quizadmin/images/<?php echo $quiz['Quizes']['image']; ?>" alt="<?php echo $quiz['Quizes']['title']; ?>"></a>
                              <div class="channels-card-image-btn">	<a href="#popup<?=$i;?>" class="btn btn-outline-success btn-sm">Start Now</a></div>
                           </div>
                           <div class="channels-card-body">
                              <div class="channels-title">
                                 <a href="#popup<?=$i;?>"><?php echo $quiz['Quizes']['title']; ?> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle"></i></span></a>
                              </div>
                              <div class="channels-view">
                                 31-08-2020
                              </div>
                           </div>
                        </div>
                     </div>
<div id="popup<?=$i;?>" class="overlay">
	<div class="popup">
		<h2>Important Instructions</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
                                          <p>1. This test is based on MCQ pattern</p>
                                          <p>2. There can be more than one correct answers</p>
                                          <p>3. Time duration : 15 minutes</p>
                                          <p>4. Questions : 25</p>
                                          <p>5. Marking Scheme : +4 for every right answer & no negative marks for every wrong answer.</p>
                                          <p>6. This quiz can be attemptted only once.</p>
                                          <p>7. Once you complete the test, result and certificate will be available immediately.</p>
                                          <a href="quiz/<?php echo $quiz['Quizes']['slug']; ?>"  class="btn btn-outline-success btn-sm">Proceed Now</a>
		</div>
	</div>
</div>

				<?php } else { ?>
			
<div class="col-xl-4 col-sm-6 mb-3">
<div class="channels-card">
<form action="orders/buynow" id="UserCustomerRegisterForm" method="post" accept-charset="utf-8">
<input name="data[Order][subtotal]" value="<?php echo $quiz['Quizes']['fees']; ?>" type="hidden">
<input type="hidden" name="data[Order][order_id]" value="<?php echo  "ORDS" . rand(10000,99999999)?>">		
<input type="hidden" name="data[Order][user_id]" value="<?php echo $customer_data['User']['id']; ?>" />	
<input type="hidden" name="data[Order][email]" value="<?php echo $customer_data['User']['email']; ?>" />
<input type="hidden" name="data[Order][product_id]"  value="<?php echo $quiz['Quizes']['id']; ?>">	
<input type="hidden" name="data[Order][title]"  value="<?php echo $quiz['Quizes']['title']; ?>">	
<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="data[Order][ORDER_ID]" autocomplete="off" value="<?php echo  "ORDS" . rand(10000,99999999)?>">
<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="data[Order][CUST_ID]" autocomplete="off" value="<?php echo $customer_data['User']['id']; ?>">
		
<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="data[Order][INDUSTRY_TYPE_ID]" autocomplete="off" value="Retail"></td>
<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="data[Order][CHANNEL_ID]" autocomplete="off" value="WEB">

<input type="hidden" name="data[Order][first_name]" class="form-control mystyle" value="<?php echo $customer_data['User']['first_name']; ?>"  required>
						
					
					<input type="hidden" name="data[Order][email]" value="<?php echo $customer_data['User']['email']; ?>" class="form-control mystyle" required>
                           <div class="channels-card-image">
                              <a href="javascript:void(0);"><img class="img-fluid" src="quizadmin/images/<?php echo $quiz['Quizes']['image']; ?>" alt=""></a>
                              <div class="channels-card-image-btn">	<button type="submit"  class="btn btn-outline-success btn-sm">Enroll For Rs <?php echo $quiz['Quizes']['fees']; ?></button></div>
                           </div>
                           <div class="channels-card-body">
                              <div class="channels-title">
                                 <a href="javascript:void(0);"><?php echo $quiz['Quizes']['title']; ?> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle"></i></span></a>
                              </div>
                              <div class="channels-view">
                                 31-08-2020
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                     
                     <?php } ?>
                     	<?php $i++; endforeach;?>
                     <div class="col-xl-4 col-sm-6 mb-3">
                        <div class="channels-card">
                           <div class="channels-card-image">
                              <a href="javascript:void(0);"><img class="img-fluid" src="https://i1.wp.com/webstrot.com/wp-content/uploads/bootstrap4.jpeg" alt=""></a>
                              <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Coming Soon</button></div>
                           </div>
                           <div class="channels-card-body">
                              <div class="channels-title">
                                 <a href="javascript:void(0);">Bootstrap Hero Quiz <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle"></i></span></a>
                              </div>
                              <div class="channels-view">
                                  30-08-2020
                              </div>
                           </div>
                        </div>
                     </div>
					     <div class="col-xl-4 col-sm-6 mb-3">
                        <div class="channels-card">
                           <div class="channels-card-image">
                              <a href="javascript:void(0);"><img class="img-fluid" src="quizadmin/images/marvel.jpg" alt=""></a>
                              <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Coming Soon</button></div>
                           </div>
                           <div class="channels-card-body">
                              <div class="channels-title">
                                 <a href="javascript:void(0);">Marvel Quiz <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle"></i></span></a>
                              </div>
                              <div class="channels-view">
                                   2-10-2020
                              </div>
                           </div>
                        </div>
                     </div>
                    
					 
					 
                  </div>
               </div>
               <hr>
		   
		   
		   
               <div class="video-block section-padding">
                  <div class="row">
                    
                    
                 <div class="col-xl-6 col-sm-6 mb-3">
 <div class="stylecontainer">
    <div class="iphone">
      <div class="stylecontent">
        <div class="transactions"><span class="t-desc">Recent Prices Won</span>
         

          <div class="transaction">
            <div class="t-icon-container"><img src="images/paytm_icon.png" class="t-icon"></div>
            <div class="t-details">
              <div class="t-title">Gitika Arora </div>
              <div class="t-time">03.45 AM
              </div>
            </div>
            <div class="t-amount">+&nbsp;5000&#8377;
            </div>
          </div>
           <div class="transaction">
            <div class="t-icon-container"><img src="images/amazon-icon.png" class="t-icon"></div>
            <div class="t-details">
              <div class="t-title">Vasant Sharma</div>
              <div class="t-time">03.45 AM
              </div>
            </div>
            <div class="t-amount">+&nbsp;3000&#8377;
            </div>
          </div>
           <div class="transaction">
            <div class="t-icon-container"><img src="images/paytm_icon.png" class="t-icon"></div>
            <div class="t-details">
              <div class="t-title">Shivam Sharma </div>
              <div class="t-time">03.45 AM
              </div>
            </div>
            <div class="t-amount">+&nbsp;2000&#8377;
            </div>
          </div>
           <div class="transaction">
            <div class="t-icon-container"><img src="images/paytm_icon.png" class="t-icon"></div>
            <div class="t-details">
              <div class="t-title">Akhil Upadhyay </div>
              <div class="t-time">03.45 AM
              </div>
            </div>
            <div class="t-amount">+&nbsp;1000&#8377;
            </div>
          </div>
            <div class="transaction">
            <div class="t-icon-container"><img src="images/amazon-icon.png" class="t-icon"></div>
            <div class="t-details">
              <div class="t-title">Akash Verma </div>
              <div class="t-time">03.45 AM
              </div>
            </div>
            <div class="t-amount">+&nbsp;1000&#8377;
            </div>
          </div>
      
        </div>
      </div>

    </div>
  </div>

                     </div>
           
					    <div class="col-xl-6 col-sm-6 mb-3">
						<div class="channels-card">
						<h5 class="card-title">Quiz Stats</h5>
                        	<div id="root"><div class="donut-chart"><svg width="300px" height="300px" viewBox="0 0 100 100"><circle cx="50" cy="50" r="30" fill="transparent" stroke-width="20" stroke="#05103b" stroke-dasharray="188.49555921538757" stroke-dashoffset="130.93966327175778" transform="rotate(-90 50 50)"><animateTransform attributeName="transform" attributeType="XML" type="rotate" from="-90 50 50" to="-90 50 50" dur="1s"></animateTransform><title>New Delhi: 80</title></circle><circle cx="50" cy="50" r="30" fill="transparent" stroke-width="20" stroke="#2facff" stroke-dasharray="188.49555921538757" stroke-dashoffset="159.71761124357266" transform="rotate(19.9237 50 50)"><animateTransform attributeName="transform" attributeType="XML" type="rotate" from="-90 50 50" to="19.92366412213741 50 50" dur="1s"></animateTransform><title>Bengaluru: 40</title></circle><circle cx="50" cy="50" r="30" fill="transparent" stroke-width="20" stroke="#ffcf04" stroke-dasharray="188.49555921538757" stroke-dashoffset="159.71761124357266" transform="rotate(74.8855 50 50)"><animateTransform attributeName="transform" attributeType="XML" type="rotate" from="-90 50 50" to="74.88549618320613 50 50" dur="1s"></animateTransform><title>Noida: 40</title></circle><circle cx="50" cy="50" r="30" fill="transparent" stroke-width="20" stroke="#ff8900" stroke-dasharray="188.49555921538757" stroke-dashoffset="159.71761124357266" transform="rotate(129.847 50 50)"><animateTransform attributeName="transform" attributeType="XML" type="rotate" from="-90 50 50" to="129.84732824427482 50 50" dur="1s"></animateTransform><title>Gurgaon: 40</title></circle><circle cx="50" cy="50" r="30" fill="transparent" stroke-width="20" stroke="#800000" stroke-dasharray="188.49555921538757" stroke-dashoffset="172.66768783088938" transform="rotate(184.809 50 50)"><animateTransform attributeName="transform" attributeType="XML" type="rotate" from="-90 50 50" to="184.80916030534354 50 50" dur="1s"></animateTransform><title>Malappuram: 22</title></circle><circle cx="50" cy="50" r="30" fill="transparent" stroke-width="20" stroke="#ff3838" stroke-dasharray="188.49555921538757" stroke-dashoffset="159.71761124357266" transform="rotate(215.038 50 50)"><animateTransform attributeName="transform" attributeType="XML" type="rotate" from="-90 50 50" to="215.03816793893134 50 50" dur="1s"></animateTransform><title>Mumbai: 40</title></circle></svg><ul class="items-names"><li class="item-name" style="background: linear-gradient(90deg, rgb(5, 16, 59) 0px, rgb(5, 16, 59) 20px, transparent 20px, transparent 100%);">New Delhi</li><li class="item-name" style="background: linear-gradient(90deg, rgb(47, 172, 255) 0px, rgb(47, 172, 255) 20px, transparent 20px, transparent 100%);">Bengaluru</li><li class="item-name" style="background: linear-gradient(90deg, rgb(255, 207, 4) 0px, rgb(255, 207, 4) 20px, transparent 20px, transparent 100%);">Noida</li><li class="item-name" style="background: linear-gradient(90deg, rgb(255, 137, 0) 0px, rgb(255, 137, 0) 20px, transparent 20px, transparent 100%);">Gurgaon</li><li class="item-name" style="background: linear-gradient(90deg, rgb(128, 0, 0) 0px, rgb(128, 0, 0) 20px, transparent 20px, transparent 100%);">Malappuram</li><li class="item-name" style="background: linear-gradient(90deg, rgb(255, 56, 56) 0px, rgb(255, 56, 56) 20px, transparent 20px, transparent 100%);">Mumbai</li></ul></div></div>
		</div>
                     </div>
					 
					 
                  </div>
               </div>
            </div>