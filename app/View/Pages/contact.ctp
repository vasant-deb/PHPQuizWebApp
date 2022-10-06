<?php ?>

<style>
ul.social-accounts {
    list-style: none;
}
ul.social-accounts a{
    color: #000;
}
.social-links {
     list-style: none;
    
    overflow: hidden;
}
.social-links .social-link {
    float: left;
}
.social-links .social-link a {
    display: block;
    position: relative;
}
.social-footer {
    margin-right: 10px;
    width: 60px;
    height: auto;
}
</style>
 <script src="https://www.google.com/recaptcha/api.js?render=6Lfrd7gZAAAAACRRjL533o2Hm8kV6UsGF5h0Eq1b"></script>
<div class="container-fluid upload-details">
                    
         <div class="row">
             
            <div class="col-lg-4">
               <div class="contact-list">
                 
                
                  <div class="media">
                     <div class="item-icon">
                        <i class="flaticon-mail"></i>
                     </div>
                     <div class="media-body">
                        <div class="title">
                           <h5 class="heading heading-h3 text-color-3">Email At :</h5>
                        </div>
                        <ul class="social-accounts">
                           <li><i class="fa fa-envelope"></i> <?php echo $company_email; ?></li>
                           <li><i class="fa fa-envelope"></i> <?php echo $company_email2; ?></li>
                        </ul>
                     </div>
                  </div>
				  
				  <div class="media">
                     <div class="item-icon">
                        <i class="flaticon-mail"></i>
                     </div>
                     <div class="media-body">
                        <div class="title">
                           <h5 class="heading heading-h3 text-color-3">Follow Us :</h5>
                        </div>
                       
                        <ul class="social-links">
				  
				
                        <li class="social-link">
                            <a href="<?php echo $facebook_url; ?>" target="_blank"><img class="social-footer" src="images/social/fb-logo.png"></a>
                        </li>
                        <li class="social-link">
                           <a href="<?php echo $instagram_url; ?>" target="_blank"><img class="social-footer" src="images/social/instagram-logo.png"></a>
						 </li>
						 <li class="social-link">
                           <a href="<?php echo $googleplus_url; ?>" target="_blank"><img class="social-footer" src="images/social/youtube-logo.png"></a>
						 </li>
						  <li class="social-link">
                           <a href="<?php echo $linkedin_url; ?>" target="_blank"><img class="social-footer" src="images/social/lk-logo.png"></a>
						 </li>
                        
						
                    </ul>
                     </div>
                  </div>
               </div>
            </div>
        
            <div class="col-lg-8">
               <div class="contact-form-box-layout1">
                  <div class="title">
                     <h3 class="heading heading-h3 text-color-2">Talk To Us Anytime</h3>
                  </div>
                  <form id="contact-form" method="post" class="contact-form-box" action="enquiries/add">
                     <p id="successmsg"></p>
                     <input type="hidden" name="enquiry_for" value="Enquiry For Contact Us">
                     <input type="hidden" name="page_url" value="<?php echo $this->Html->url( null, true ); ?>">	
                     <div class="row gutters-15">
                        <div class="col-lg-6 col-12 form-group">
                           <label>Name *</label>
                           <input type="text" placeholder="Full Name" class="form-control" name="name" data-error="Name field is required" required>
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                           <label>E-Mail *</label>
                           <input type="email" placeholder="Email Address" class="form-control" name="email" data-error="email field is required" required>
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-6 col-12 form-group">
                           <label>Phone *</label>
                           <input type="text" class="form-control" name="phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.charCode == 43 || event.charCode == 45 || event.charCode == 0" minlength="10" maxlength="15" placeholder="Phone" required>
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-6 col-12 form-group">
                           <label>Subject *</label>
                           <input type="text" name="address" class="form-control" placeholder="Subject">
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-12 form-group">
                           <label>Type Your Comment *</label>
                           <textarea placeholder="" class="textarea form-control" name="message" id="form-message" rows="5" cols="20" 
                              data-error="Message field is required" required></textarea>
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-12 form-group">
                           <input type="submit" style="background:#ff7810;color:white;"  class="brook-btn bk-btn-dark btn-sd-size btn-rounded space-between btn btn-primary mystyle" name="submit" value="Send enquiry">
                        </div>
                     </div>
                     <div class="form-response"></div>
                  </form>
               </div>
            </div>
             
         </div>
      </div>
   
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script> 
 <script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6Lfrd7gZAAAAACRRjL533o2Hm8kV6UsGF5h0Eq1b', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
          });
        });
      }
  </script>
<script>
   $(function() {
   	$("#contact-form").on('submit', function(event) {
   		debugger;
   		var $form = $(this);		
   		$.ajax({
   			type: $form.attr('method'),
   			url: $form.attr('action'),
   			data: $form.serialize(),
   			success: function() {
    			$('#successmsg').html('Thank you for your enquiry with us, <br> Our representative will get in touch with you soon.');
   		 	$('#successmsg').addClass(' alert alert-success');
   						 			 
   			 $("#successmsg").show();
   			 setTimeout(function() { $("#successmsg").hide(); }, 15000);
   					 
     			
   			}
   		});
   		event.preventDefault();		 
   	});
   });
</script>
