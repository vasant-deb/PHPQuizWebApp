<?php ?>
<style>
.overlay {
    position: fixed;
    z-index: 9999;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    transition: opacity 500ms;
    visibility: hidden;
    opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>
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
                              <a href="quiz.html#popup<?=$i;?>"><img class="img-fluid" src="quizadmin/images/<?php echo $quiz['Quizes']['image']; ?>" alt="<?php echo $quiz['Quizes']['title']; ?>"></a>
                              <div class="channels-card-image-btn">	<a href="quiz.html#popup<?=$i;?>" class="btn btn-outline-success btn-sm">Start Now</a></div>
                           </div>
                           <div class="channels-card-body">
                              <div class="channels-title">
                                 <a href="quiz.html#popup<?=$i;?>"><?php echo $quiz['Quizes']['title']; ?> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle"></i></span></a>
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
		<a class="close" href="quiz.html#">&times;</a>
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
               
                <hr class="mt-0">
               
               <div class="video-block section-padding">
                  <div class="row">
                 
                    
                     
                     <div class="col-xl-12 col-sm-12 mb-3">
					 
                        <div class="channels-card">
						 
          <table id="example" class="table  table-bordered table-striped display responsive nowrap" width="100%" cellspacing="0">
		<thead>
            <tr>
			 <th>Quiz Id</th>
                <th>Quiz Name</th>
				<th>Expire On</th>
				<th>Questions</th>
				<th>Time</th>
				<th>Price</th>
				<th>Fees</th>
            </tr>
        </thead>
        <tbody>
		 
		
	<?php $j=1;	foreach($quizes as $quiz):
	
	$status="";

	if(in_array($quiz['Quizes']['id'],$order_product_id))
	{
	    
	    $status="paid";
	}
	
	?>
            <tr>
			    <td><?php echo $quiz['Quizes']['id']; ?></td>
                <td><?php echo $quiz['Quizes']['title']; ?></td>
                <td>31-08-2020</td>
				<td>25</td>
				<td>00:15:00</td>
				<td>Rs <?php echo $quiz['Quizes']['price']; ?></td>
				<?php if($quiz['Quizes']['fees']=="0.00" || $status=="paid"){ ?>
				
				<td><a href="quiz.html#popup<?=$j;?>"  class="btn btn-outline-success btn-sm">Start Now</a></td>
				
				<div id="popup<?=$j;?>" class="overlay">
	<div class="popup">
		<h2>Important Instructions</h2>
		<a class="close" href="quiz.html#">&times;</a>
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
						
					<br>
					<input type="hidden" name="data[Order][email]" value="<?php echo $customer_data['User']['email']; ?>" class="form-control mystyle" required>
				
				<td><button type="submit"  class="btn btn-outline-success btn-sm">Enroll For Rs <?php echo $quiz['Quizes']['fees']; ?></button></td>
				</form>
				<?php } ?>
            </tr>
            
			<?php $j++; endforeach;?>
			  </tbody>
        
    </table>
                        </div>
                     </div>
                     
					 
                  </div>
               </div>
            </div>