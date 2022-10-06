
<!doctype html>
<html lang="en">
   <head>
      <title><?php echo $quiz['Quizes']['title'];?></title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
      <link rel="manifest" href="favicons/site.webmanifest">
 
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
	  <base href="<?php echo $this->webroot; ?>">
      <!-- Custom fonts for this template-->
      <link href="quiz/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <!-- custom css -->
      <link href="quiz/css/style.css?q=1585312803" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="quiz/css/sb-admin-2.min.css" rel="stylesheet">
      <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
      <script src="quiz/js/shuffle.js"></script>
      <script src="quiz/js/jquery.min.js"></script>
      <script src="quiz/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="quiz/js/jquery.easing.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="quiz/js/sb-admin-2.min.js"></script>
      <link href="https://fonts.googleapis.com/css2?family=Bitter&family=Fredericka+the+Great&display=swap" rel="stylesheet">
      <!-- Page level plugins -->
      <script src="quiz/js/Chart.min.js"></script>
      <link href="quiz/css/sort.css" rel="stylesheet">
      <script src="quiz/js/basic.js?q=1585312803"></script>
      <script>
         var base_url="/";
      </script>
      <script type="text/javascript"> 
         function preventBack() { 
             window.history.forward();  
         } 
           
         setTimeout("preventBack()", 0); 
           
         window.onunload = function () { null }; 
        
      </script> 
      <link href="quiz/css/quiz-start.css" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.css" rel="stylesheet">
      <script src="https://use.fontawesome.com/704a25b569.js"></script>
      <script type="text/javascript">
         function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };
         
         $(document).ready(function(){
              $(document).on("keydown", disableF5);
         });
      </script>
      <link href="quiz/css/home.css" rel="stylesheet">
      <!-- Hotjar Tracking Code for https://www.engagegeeks.com/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1920365,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
   </head>
   <body id="page-top">
      <div class="loading"></div>
      <!-- Template javascript -->
      <div class=" " >
         <div class="heading-mystyle" style="background: #ffffff;padding:4px;color: #0c0000;">
            <div class="save_answer_signal" id="save_answer_signal2"></div>
            <div class="save_answer_signal" id="save_answer_signal1"></div>
            <div style="float:right;width:80px; margin-right:10px;" >
               Time left: 
               <span id='timer' >
                  <script type="text/javascript">window.onload = CreateTimer("timer", 900);</script>
               </span>
            </div>
            <div style="float:left; " >
               <img src="images/<?php echo $sitelogo;?>" width="150px;" height="60px">
            </div>
           
            <div style="clear:both;"></div>
         </div>
         <div style="clear:both;"></div>
         <div class="row allsection"  style="margin-top:0px;">
            <div class="col-md-9">
               <!-- Category button -->
               <form method="post" action="reports/add" id="quiz_form" >
                  <input type="hidden" name="rid" value="21">
                  <input type="hidden" name="noq" value="25">
                  <input type="hidden" name="user_ip" value="<?php echo $user_ip; ?>">
				  <input type="hidden" id="utime" name="time" value="">
				   <input type="hidden" id="response" name="response" value="<?php echo htmlspecialchars(serialize($randArr));?>">
                  <input type="hidden" name="individual_time"  id="individual_time" value="0,8,232,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0">
                 <input type="hidden" id="quiz_id" name="quiz_id" value="<?php echo $quiz['Quizes']['id'];?>">
				  <input type="hidden" id="quiz_title" name="quiz_title" value="<?php echo $quiz['Quizes']['title'];?>">
                  <input type="hidden" id="userid" name="user_id" value="<?php echo $customer_data['User']['id'];?>">
				  <input type="hidden" id="fullname" name="fullname" value="<?php echo $customer_data['User']['first_name']." ".$customer_data['User']['last_name'];?>">
				
             <?php    $j=1; $i=0; foreach($randArr as $elem)  {

			 ?>
                  <div id="q<?=$i;?>" class="question_div">
                     <div class="question_container" >
                        Question (<?php  echo $j; ?>) : <?php echo($json_array[$elem]['question'] );?>     
						<br>
                        <center>
                           <?php if($json_array[$elem]['qimage']){ ?>
                             <img src='<?php  echo($json_array[$elem]['qimage']); ?>' class='img-responsive' width='200px' height='200px'/>
						   <?php } ?>
                        </center>
                     </div>
                     <div class="option_container" id="shuffle<?=$j;?>">
                        <input type="hidden"  name="question_type[]"  id="q_type<?=$i;?>" value="1">	
                                              
			 <?php if($json_array[$elem]['option1']){ ?> 
                          <div class='op'>
                           
                       
                        <table class="responsive">
                           <tr>
						   
                              <td class="list">
                                
                                   
      <input type='checkbox'  name='answerRes[<?=$i;?>][]'  id='answer_value<?=$i;?>-0' value='c1'/>
                                  
                           <?php  echo($json_array[$elem]['option1']); ?>    
                              		 
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="answer_value<?=$i;?>-0">
                                   
                                 </label>
                              </td>
                           </tr>
                        </table>
                        
                         
                          </div>
                          
						  <?php } ?>
                                                                        
                           <?php if($json_array[$elem]['option2']){ ?>
                          <div class='op'>
                         
                       
                        <table class="responsive">
                           <tr>
                              <td class="list">
                                 
            <input type='checkbox'  name='answerRes[<?=$i;?>][]'  id='answer_value<?=$i;?>-1' value='c2'/>
                              <?php  echo($json_array[$elem]['option2']); ?>          
                                 
                                 	
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="answer_value<?=$i;?>-1">
                                      
                                 </label>
                              </td>
                           </tr>
                        </table>
                      
                         
                         </div>
						   <?php } ?> 
                        <?php if($json_array[$elem]['option3']){ ?>
                         <div class='op'>
                           
                       
                        <table class="responsive">
                           <tr>
                              <td class="list">
                            
                                    
          <input type='checkbox'  name='answerRes[<?=$i;?>][]'  id='answer_value<?=$i;?>-2' value='c3'/>
                                    
                               
                                 <?php  echo($json_array[$elem]['option3']); ?>    
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="answer_value<?=$i;?>-2">
                                    
                                 </label>
                              </td>
                           </tr>
                        </table>
                       </div>
                              <?php } ?> 
                        <?php if(!empty($json_array[$elem]['option4'])){ ?>
                        
                         
                           <div class='op'>
                           
                        
                        <table class="responsive">
                           <tr>
                              <td class="list">
                                 
          <input type='checkbox'  name='answerRes[<?=$i;?>][]'  id='answer_value<?=$i;?>-3' value='c4'/>
                                   
                                
                                <?php  echo($json_array[$elem]['option4']); ?>    	
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="answer_value<?=$i;?>-3">
                               
                                       
                                
                                   
                                 </label>
                              </td>
                           </tr>
                        </table>
                       </div>
					      <?php } ?> 
                        
                                             </div>
                  </div>
                 <?php $j++; $i++;} ?>
      
				  <div id="BlockUIConfirm" class="BlockUIConfirm">
         <div class="blockui-mask"></div>
         <div class="RowDialogBody">
            <div class="confirm-header row-dialog-hdr-success">
               Confirm Acceptance
            </div>
            <div class="confirm-body">
               Confirm that you wish to submit this quiz
            </div>
            <div class="confirm-btn-panel pull-right">
               <div class="btn-holder pull-right">
                  <button type="submit" class="row-dialog-btn btn btn-success submitpopup" id="confirmsubmit"/>Yes, Accept</button>
                  <input type="button" class="row-dialog-btn btn btn-naked" value="No, Cancel" onclick="$('#BlockUIConfirm').hide();" />
               </div>
            </div>
         </div>
      </div>
				
                                             
                                 </form>
								 </div>
                  
            <div class="col-md-3 question-list">
               <b> Questions</b>
               <div style="overflow-y:auto;">
			       <?php    $j=1; $i=0; foreach($randArr as $elem)  {

			 ?>
                  <div class="qbtn" onClick="javascript:show_question('<?=$i;?>');" id="qbtn<?=$i;?>"><?php  echo $j; ?></div>
				  
				   <?php $j++; $i++;} ?>
              
                  <div style="clear:both;"></div>
                  <hr>
                  <div class="row" style="overflow-y:100%;">
                     <div class="col-sm-3 col-xs-3 col-md-12">
                        <div class="qbtn" style="background:#449d44;"  >&nbsp;</div>
                        Answered 
                     </div>
                     <div class="col-sm-3 col-xs-3 col-md-12">
                        <div class="qbtn" style="background:#c9302c;"  >&nbsp;</div>
                        UnAnswered 
                     </div>
                     <div class="col-sm-3 col-xs-3 col-md-12">
                        <div class="qbtn" style="background:#ec971f;"  >&nbsp;</div>
                        Review-Later 
                     </div>
                     <div class="col-sm-3 col-xs-3 col-md-12">
                        <div class="qbtn" style="background:#212121;"  >&nbsp;</div>
                        Not-visited 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="footer_buttons">
         <button class="btn btn-warning" onClick="javascript:review_later();" style="margin-top:2px;font-size:12px;">Review Later</button>
         <button class="btn btn-success" id="backbtn" style="visibility:hidden;margin-top:2px;font-size:12px;" onClick="javascript:show_back_question();">Back</button>
         <button class="btn btn-success" id="nextbtn" onClick="javascript:show_next_question();" style="margin-top:2px;font-size:12px;">Save & Next</button>
         <button class="btn btn-danger"  id="submit" name="submit" style="margin-top:2px;font-size:12px;">Submit Quiz</button>
      </div>
    
      <script>
         $(document).ready(function() {
           setTimeout(function() {
               alert("Time Over");
			    var time = $("span#timer").text();
			 $("input#utime").val(time);
             $("button#confirmsubmit").trigger('click');
           }, 908000);
         });
      </script>
      
      <script>
         $(function() {
            $('button#submit').on('click', function (event) {
				debugger;
           $("#BlockUIConfirm").show();   
		     var time = $("span#timer").text();
			 $("input#utime").val(time);
    
             });
         });		 
      </script>
      <script>
         var ctime=0;
         var ind_time=new Array();
         ind_time[0]=0;
         	ind_time[1]=0;
         	ind_time[2]=0;
         	ind_time[3]=0;
         	ind_time[4]=0;
         	ind_time[5]=0;
         	ind_time[6]=0;
         	ind_time[7]=0;
         	ind_time[8]=0;
         	ind_time[9]=0;
         	ind_time[10]=0;
         	ind_time[11]=0;
         	ind_time[12]=0;
         	ind_time[13]=0;
         	ind_time[14]=0;
         	ind_time[15]=0;
         	ind_time[16]=0;
         	ind_time[17]=0;
         	ind_time[18]=0;
         	ind_time[19]=0;
         	ind_time[20]=0;
         	ind_time[21]=0;
         	ind_time[22]=0;
         	ind_time[23]=0;
         	ind_time[24]=0;
         	noq="25";
         show_question('0');
         function increasectime(){
         ctime+=1;
         }
         setInterval(increasectime,1000);
         setInterval(setIndividual_time,30000);
      </script>
      <div id="warning_div" style="padding:10px; position:fixed;z-index:100;display:none;width:100%;border-radius:5px;height:200px; border:1px solid #dddddd;left:4px;top:70px;background:#ffffff;">
         <center><b> Do you really want to submit this quiz?</b> <br><br>
            <span id="processing"></span>
            <a href="javascript:cancelmove();"  class="btn btn-danger"  style="cursor:pointer;">Cancel</a> &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="javascript:submit_quiz();" class="btn btn-info"  style="cursor:pointer;">Submit Quiz</a>
         </center>
      </div>
      <!-- duplicate question check -->
      <div id="duplicate_question" style="display:none;position:fixed;z-index:1000;width:100%;bottom:0px;height:220px;overflow-y:auto;background:#212121;color:#ffffff;padding:8px;">
         <a href="javascript:canceldupli();" style="float:right;"><i class="fa fa-times"></i></a>
         <div id="duplicate_question2">
         </div>
      </div>
    
       
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
      <!-- dupllicate question check ends -->
   </body>
</html>