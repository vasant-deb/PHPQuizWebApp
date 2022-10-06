<?php ?>
 
  <script src="https://www.google.com/recaptcha/api.js?render=6Lfrd7gZAAAAACRRjL533o2Hm8kV6UsGF5h0Eq1b"></script>
 <div class="container-fluid pb-0">
             <div class="row no-gutters">
               <div class="col-md-5 bg-white full-height">
                  <div class="login-main-left">
                     <div class="text-center login-main-left-header">
                        
                        <h5 class="mt-3 mb-3">Welcome to Online Quiz</h5>
                       
                     </div>
                     <form action="customer/register" id="UserCustomerRegisterForm" autocomplete="off" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div> <input type="hidden" name="mode" value="register">
                        <div class="form-group">
                           <label>First Name</label>
                           <input type="text" class="form-control" name="data[User][first_name]">
                        </div>
						<div class="form-group">
                           <label>Last Name</label>
                           <input type="text" class="form-control" name="data[User][last_name]">
                        </div>
						<div class="form-group">
                           <label>Email</label>
                           <input type="email" class="form-control" name="data[User][email]">
                        </div>
                        <div class="form-group">
                           <label>Password</label>
                           <input type="password" class="form-control" name="data[User][password]" id="UserPassword">
                        </div>
                        <div class="form-group">
                           <label>Confirm Password</label>
                           <input type="password" class="form-control" name="data[User][confirmpassword]" id="UserConfirmpassword">
                        </div>
                        <div class="mt-4">
                           <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Sign Up</button>
                        </div>
                     </form>
                     <div class="text-center">
                        <p class="light-gray">Already have an Account? <a href="customer/login">Sign In</a></p>
                     </div>
                  </div>
               </div>
               <div class="col-md-7">
                  <div class="login-main-right bg-white mt-5 mb-5">
                     <div class="owl-carousel owl-carousel-login">
                        <div class="item">
                           <div class="carousel-login-card text-center">
                              <img src="img/login.png" class="img-fluid" alt="LOGO">
                              <h5 class="mt-5 mb-3">Verify Your Email Address</h5>
                              <p class="mb-4">you will receive an email with otp<br> make sure to verify your account using that otp</p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="carousel-login-card text-center">
                              <img src="img/login.png" class="img-fluid" alt="LOGO">
                              <h5 class="mt-5 mb-3">Unlimited Quizzes</h5>
                              <p class="mb-4">If you want to participate in quiz you need to register first</p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="carousel-login-card text-center">
                              <img src="img/login.png" class="img-fluid" alt="LOGO">
                              <h5 class="mt-5 mb-3">Test Your Skills</h5>
                              <p class="mb-4">these quizzes are meant to test your skills and strengths for yourself <br>"not to judge you".</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
 </div>
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
   var password = document.getElementById("UserPassword");
    var confirmpassword = document.getElementById("UserConfirmpassword");
   
   function validatePassword(){
     if(password.value != confirmpassword.value) {
       confirmpassword.setCustomValidity("Passwords Don't Match");
     } else {
       confirmpassword.setCustomValidity('');
     }
   }
   
   password.onchange = validatePassword;
   confirmpassword.onkeyup = validatePassword;
</script>