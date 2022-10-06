<?php ?>
<style>
.alert {
  background: white;
  width: 100%;
  display: -webkit-box;
  display: flex;
  padding: 1rem;
  -webkit-box-align: center;
          align-items: center;
  border-radius: .8rem;
  border: 2px solid;
  margin-bottom: 1rem;
  position: relative;
  box-shadow: 0px 5px 12px rgba(0, 0, 0, 0.04), 0px 12px 25px rgba(0, 0, 0, 0.07);
  -webkit-animation: transitionIn 200ms ease forwards;
          animation: transitionIn 200ms ease forwards;
  -webkit-transition: all 200ms ease;
  transition: all 200ms ease;
}
.alert__message {
  color: #677b7a;
}
.alert__close {
  width: 1.3rem;
  height: 1.3rem;
  line-height: 1.3rem;
  color: #677b7a;
  text-align: center;
  position: absolute;
  top: .5rem;
  right: .5rem;
  cursor: pointer;
  border-radius: .4rem;
}
.alert__close:hover, .alert__close:focus {
  background: rgba(103, 123, 122, 0.2);
}
.alert__close_1 {
  width: 1.3rem;
  height: 1.3rem;
  line-height: 1.3rem;
  color: #677b7a;
  text-align: center;
  position: absolute;
  top: .5rem;
  right: .5rem;
  cursor: pointer;
  border-radius: .4rem;
}
.alert__close_1:hover, .alert__close_1:focus {
  background: rgba(103, 123, 122, 0.2);
}
.alert__icon {
  margin-right: 1rem;
  width: 36px;
  height: 36px;
  -webkit-animation: fade 500ms linear forwards;
          animation: fade 500ms linear forwards;
}
.alert__icon-path {
  stroke-dasharray: 1000;
  stroke-dashoffset: 1000;
  stroke-width: 4px;
  -webkit-animation: dash 1s ease forwards;
          animation: dash 1s ease forwards;
}
.alert__icon-path--type {
  -webkit-animation-delay: 300ms;
          animation-delay: 300ms;
  -webkit-animation-duration: 5s;
          animation-duration: 5s;
}
.alert--success {
  color: #39D7B3;
  border-color: #39D7B3;
}
.alert--warning {
  color: #FFBA4B;
  border-color: #FFBA4B;
}
.alert--danger {
  color: #FF4555;
  border-color: #FF4555;
}

@-webkit-keyframes dash {
  from {
    stroke-dashoffset: 1000;
  }
  to {
    stroke-dashoffset: 0;
  }
}

@keyframes dash {
  from {
    stroke-dashoffset: 1000;
  }
  to {
    stroke-dashoffset: 0;
  }
}
.actions {
  position: fixed;
  bottom: 0;
  right: 0;
  left: 0;
  z-index: 100;
  width: 100%;
  display: -webkit-box;
  display: flex;
  -webkit-box-pack: space-evenly;
          justify-content: space-evenly;
  flex-wrap: wrap;
}
.actions__title {
  width: 100%;
  text-align: center;
  padding-bottom: .5rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .1em;
  font-size: 85%;
}
.actions .button {
  display: block;
  width: 25%;
}

.button {
  font-family: inherit;
  background: transparent;
  color: white;
  background: #677b7a;
  border: 0;
  padding: 1rem;
  cursor: pointer;
  margin: 0;
}
.button:hover {
  opacity: .8;
}
.button--success {
  background: #39D7B3;
}
.button--success:focus, .button--success:active {
  box-shadow: 0px 0px 0px 3px rgba(57, 215, 179, 0.4);
}
.button--danger {
  background: #FF4555;
}
.button--danger:focus, .button--danger:active {
  box-shadow: 0px 0px 0px 3px rgba(255, 69, 85, 0.4);
}
.button--warning {
  background: #FFBA4B;
}
.button--warning:focus, .button--warning:active {
  box-shadow: 0px 0px 0px 3px rgba(255, 186, 75, 0.4);
}
.button:focus, .button:active {
  outline: 0;
}

@-webkit-keyframes fade {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes fade {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.main-btn-rect,
.main-btn-circle{
	position: relative;
	margin: 0;
	font-family: 'Roboto', sans-serif;
	color: #FFFFF0;
	background-color: rgb(252, 79, 79);
	text-transform: uppercase;
	font-size: 25px;
	letter-spacing: 1px;	
	outline: none;
	cursor: pointer;
	z-index: 100;
}

.main-btn-rect:before, 
.main-btn-rect:after{
  position: absolute;
  content: '';
  top:0;
  width: 0%;
  height: 100%;
  background-color: rgba(255, 255, 240, 0.2);
  -webkit-transition: width 0.3s;
  -o-transition: width 0.3s;
  transition: width 0.3s;
}
.main-btn-rect:before {
  left: 0;
}
.main-btn-rect:after {
  right: 0;
}
.main-btn-rect:hover:before, 
.main-btn-rect:hover:after{
  width: 50%;
}
.main-btn-circle{
	height: 40px;
	width: 40px;
	-webkit-border-radius: 50%;
	border-radius: 100%;
	line-height: 40px;
  -webkit-transition: box-shadow 0.3s;
  -o-transition: box-shadow 0.3s;
  transition: box-shadow 0.3s;
}
.main-btn-circle:hover{   
  -webkit-box-shadow: inset 2px 1px 0px 20px rgba(255, 255, 240, 0.2);
  -moz-box-shadow: inset 2px 1px 0px 20px rgba(255, 255, 240, 0.2);
  box-shadow: inset 2px 1px 0px 20px rgba(255, 255, 240, 0.2);
}
.popup{
  position: fixed;
	top: 100%;
  width: 100%;
  height: 100%;
  z-index: 10001;
}
.popup.active{
  top:0;
  background-color: rgba(3, 3, 3, 0.98); 
  transition: background-color .6s ,opacity .6s;
}
.popup .main-btn-rect{
  padding: 10px 100px;
}
.popup .popup-content{
  position: absolute;
  top: 50%;
  left: 50%;
  max-height: 568px;
  min-width: 320px;
  margin-top: 150px;
  padding: 25px;
  background-color: #FFFFF0;
  color: #070000;
  -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  -ms-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -o-transform: translateX(-50%) translateY(-50%);
  transition: margin .6s;
  -webkit-transition: margin .6s;
  -moz-transition: margin .6s;
  -o-transition: margin .6s;
}
.popup.active .popup-content{
  margin-top: 0px;
}
.popup-content h6{
  display: table;
  font-size: 16px;
  text-align: center;
  margin: 10px auto;
  font-family: 'Roboto',sans-serif;
  text-transform: uppercase;
  font-weight: 100;  
}
.form-group{
	position: relative;
	width: 90%;
	margin: 0px auto;
}
form#send input, form#send textarea{
	position: relative;
	margin-bottom: 32px;
	width: 100%;
	height: 29px;
	font-family: 'RobotoLight', sans-serif;
	text-indent: 20px;
  background-color: transparent;
	outline: 0;
	border: none;
	border-bottom: 1px solid #070000;
	-webkit-transition: border 0.6s;
	-o-transition: border 0.6s;
	transition: border 0.6s;
}
form#send input:focus,
form#send textarea:focus{
	border-bottom: 1px solid rgb(63, 173, 168); 
}
form#send label{
	position: absolute;
	top: 0;
	line-height: 28px;
	-webkit-transition: color .5s;
	-o-transition: color .5s;
	transition: color .5s;
}
form#send input:focus + label,
form#send textarea:focus + label{
  color: rgb(63, 173, 168);
}
form#send .txt{
	line-height: 22px;
	left: 2px;
}
form#send .main-btn-rect {
	position: relative;
	display: block;
	padding: 12px 80px;
	margin: 0px auto;
	font-size: 14px;
}
form#send .main-btn-rect i {
	margin-right: 5px;
}
.popup .fade-out{
  position: absolute;
  top: -20px;
  right: -20px;
  text-align: center;
  font-size: 15px;
}
.share-wrap{
	position: absolute;
  display: inline-table;
	top: 67%;
	left: 50%;
	transform: translate(-50%, -50%);
  padding: 15px;
  text-align: center;
}
.share-btn{
  color: #FFFFF0;
  padding: 7px 25px;
  text-decoration: none;
  cursor: pointer;
  font-weight: 100;
  font-size: 14px;
  font-family:'Lobster', sans-serif;
  background-color: rgba(63, 173, 168, .8);
  text-transform: uppercase;
  border-radius: 5px;
  transition: background-color .5s;
  -webkit-transition: background-color .5s;
  -moz-transition: background-color .5s;
  -o-transition: background-color .5s;
}
.share-btn:hover{
  color: #FFFFF0;
  text-decoration: none;
  background-color: rgba(63, 173, 168, 1.0);
}

.resp-sharing-button__link,
.resp-sharing-button__icon {
  display: inline-block
}
.resp-sharing-button__link {
  text-decoration: none;
  color: #fff;
  margin: 2px;
}
.resp-sharing-button {
  border-radius: 5px;
  transition: 25ms ease-out;
  padding: 6px 9px;
  transition: background-color .5s;
  -webkit-transition: background-color .5s;
  -moz-transition: background-color .5s;
  -o-transition: background-color .5s;
}
.resp-sharing-button__icon svg {
  width: 1em;
  height: 1em;
  margin-right: 0.4em;
  vertical-align: top
}
.resp-sharing-button--small svg {
  margin: 0;
  vertical-align: middle
}
.resp-sharing-button__icon,
.resp-sharing-button__icon--solid,
.resp-sharing-button__icon--solidcircle {
  fill: #fff;
  stroke: none
}
.resp-sharing-button--facebook {
  background-color: #3b5998;
  border-color: #3b5998;
}
.resp-sharing-button--facebook:hover,
.resp-sharing-button--facebook:active {
  background-color: #2d4373;
  border-color: #2d4373;
}
.resp-sharing-button--twitter {
  background-color: #55acee;
  border-color: #55acee;
}
.resp-sharing-button--twitter:hover,
.resp-sharing-button--twitter:active {
  background-color: #2795e9;
  border-color: #2795e9;
}
.resp-sharing-button--linkedin {
  background-color: #0077b5;
  border-color: #0077b5;
}
.resp-sharing-button--linkedin:hover,
.resp-sharing-button--linkedin:active {
  background-color: #046293;
  border-color: #046293;
}
@media only screen and (max-width: 768px){
 
  form#send .main-btn-rect {padding: 7px 60px; font-size: 14px;}
  #emailverify{padding: 7px 60px; font-size: 14px;}
}
@media only screen and (max-width:450px) {
  .alert {
    display: block;
}
.alert__message {
    width: 100%;
    display: inline-block;
}
 .button-verify{padding: 7px 60px; font-size: 14px;
     width:100%;
     display:block;
 } 
 .alert__icon {
    margin: 0px auto;
    display: block;
    width: 36px;
    height: 36px;
    -webkit-animation: fade 500ms linear forwards;
    animation: fade 500ms linear forwards;
}
}
</style>
<div class="container-fluid upload-details">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="main-title">
                        <h6>Settings</h6>
                        


<div class="wrapper" id="notification">
    <?php if($isverified['User']['country_id']==1){?>
  <div class="alert alert--success">
    <svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle class="alert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor"></circle>
      <path class="alert__icon-path alert__icon-path--type" d="M15 33.5L25 43.5L48.5 20" stroke="currentColor"></path>
    </svg>
    <div class="alert__message">Verified Account</div>
    <div class="alert__close_1">&times;</div>
  </div>
<?php } else { ?>
  <div class="alert alert--danger">
    <svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle class="alert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor"></circle>
      <path class="alert__icon-path alert__icon-path--type" d="M32 19V38" stroke="currentColor"></path>
      <path class="alert__icon-path alert__icon-path--type" d="M32 41L32 45" stroke="currentColor"></path>
    </svg>
    <div class="alert__message">Email Verification Required (<?php echo $customer_data['User']['email'];?>) | Check your inbox for OTP &nbsp;&nbsp;</div>
    <button type="button" class="btn btn-outline-danger button-verify" id="emailverify" data-popup="popup-reg">Verify Now</button>
    <div class="alert__close">&times;</div>
  </div>
<?php } ?>
</div>
                     </div>
                  </div>
               </div>
               
               
               
               
              <?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data','class' => 'form-horizontal'));
		

          ?>
		  <input type="hidden" name="_method" value="PUT"/><input type="hidden" name="data[User][id]" value="<?php echo $customer_data['User']['id'];?>" id="BannerId"/>		  
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="control-label">First Name <span class="required">*</span></label>
                           <input class="form-control border-form-control" name="data[User][first_name]" value="<?php echo $customer_data['User']['first_name'];?>" type="text">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="control-label">Last Name <span class="required">*</span></label>
                           <input class="form-control border-form-control" name="data[User][last_name]" value="<?php echo $customer_data['User']['last_name'];?>" type="text">
                        </div>
                     </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                           <label class="control-label">Username <span class="required">*</span></label>
                           <input class="form-control border-form-control" name="data[User][username]" disabled="" value="<?php echo $customer_data['User']['username'];?>" type="text">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="control-label">Phone <span class="required">*</span></label>
                           <input class="form-control border-form-control" name="data[User][phone]" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.charCode == 43 || event.charCode == 45 || event.charCode == 0" minlength="10" maxlength="10" value="<?php echo $customer_data['User']['phone'];?>" required="" type="number">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="control-label">Email Address <span class="required">*</span></label>
                           <input class="form-control border-form-control " name="data[User][email]" value="<?php echo $customer_data['User']['email'];?>" disabled="" type="email">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="control-label">Country <?php echo "(Selected ".$customer_data['User']['country'].")";?><span class="required">*</span></label>
                           <select class="custom-select countries order-alpha form-control" name="data[User][country]" id="countryId">
                              <option value="">Select Country</option>
                   
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="control-label">State <?php echo "(Selected ".$customer_data['User']['state'].")";?><span class="required">*</span></label>
                            <select class="custom-select states order-alpha form-control" name="data[User][state]" id="stateId">
                              <option value="">Select State</option>
           
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="control-label">City <?php echo "(Selected ".$customer_data['User']['city'].")";?><span class="required">*</span></label>
                           <select class="custom-select cities order-alpha form-control" name="data[User][city]" id="cityId">
                              <option value="">Select City</option>
           
                           </select>
						   
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     
                     
                  
				  <?php
				
				$thumbImageurl = $this->Html->url('/images/profiles/'.$customer_data['User']['image']);
				$Imageurl = "https://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($customer_data['User']['image'] != '')?$thumbImageurl:$Imageurl;
				?>
                 
                     <div class="col-sm-6">
                        <div class="form-group">
                           <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo $Imageurl;?>" style="width: 150px; height: 150px;"> </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                    <div> <span class="btn btn-default btn-file">
 					  <input type="file" name="data[User][image]" id="BlogThumb">
                      </span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a> </div>
                  </div>
						</div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-danger border-none"> Cancel </button>
                        <button type="submit" class="btn btn-success border-none"> Save Changes </button>
                     </div>
                  </div>
               </form>
            </div>

 <div id="popup-reg" class="popup">
  <div class="popup-content">
    <div class="event-header">
      <h6>Input Verification Code</h6>
    </div>
      <form id="onpageVerifyForm" method="post" action="users/verify" class="send-form">
        <div class="form-group">
             <input type="hidden" id="vid" name="vid" value="<?php echo $customer_data['User']['id'];?>">
          <input type="number" placeholder="XXXX" id="vcode" name="vcode" required="required">
          <label for="name">
           
          </label>
        </div>
        <input type="submit" class="main-btn-rect" id="verifynow" name="verifybutton" value="Verify">
         
      </form>
    <span class="fade-out main-btn-circle">╳</span>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
         $(function() {
	$("#onpageVerifyForm").on('submit', function(event) {
	
		var $form = $(this);		
		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function(data) {
 		alert(data);
  			
			}
		});
		event.preventDefault();		 
	});
});
        </script>
<script>
$(document).ready(function(){
  $('#emailverify').click(function(){ 
    var popupBlock = $('#'+$(this).data('popup'));
    popupBlock.addClass('active')
      .find('.fade-out').click(function(){
        popupBlock.css('opacity','0').find('.popup-content').css('margin-top','350px');        
        setTimeout(function(){
          $('.popup').removeClass('active');
          popupBlock.css('opacity','').find('.popup-content').css('margin-top','');
        }, 600);
      });
 });
 
});
</script>
<script>
console.clear();

const wrapper = document.querySelector(".wrapper");

const closeAlertItem = () => {
  const alertClose = document.querySelectorAll(".alert__close_1");
  alertClose.forEach(item => {
    item.addEventListener("click", function () {
      item.parentNode.style.transform = "translateX(3rem)";
      item.parentNode.style.opacity = "0";
      setTimeout(() => {
        item.parentNode.remove();
        emptyState();
      }, 100);
    });
  });
};

const emptyState = () => {
  if (wrapper.children.length > 0) {
    if (document.querySelector(".empty-state")) {
      document.querySelector(".empty-state").remove();
    }
  } else {
    const emptyItem = document.createElement("div");
    emptyItem.classList = "empty-state";
    emptyItem.style.textAlign = "center";
    emptyItem.style.fontSize = "2rem";
    emptyItem.innerHTML = "";
    wrapper.appendChild(emptyItem);
  }
};

const createAlert = type => {
  const newAlert = document.createElement("div");
  newAlert.classList = `alert alert--${type}`;
  if (type == "success") {
    newAlert.innerHTML = `
			<svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle class="alert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor"></circle>
				<path class="alert__icon-path alert__icon-path--type" d="M15 33.5L25 43.5L48.5 20" stroke="currentColor"></path>
			</svg>
			<div class="alert__message">This is a ${type} notificiation</div>
		<div class="alert__close">&times;</div>`;
  } else if (type == "danger") {
    newAlert.innerHTML = `
			<svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle class="aalert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor" stroke-width="5"></circle>
				<path class="alert__icon-path alert__icon-path--type" d="M20 44L44 20" stroke="currentColor"></path>
				<path class="alert__icon-path alert__icon-path--type" d="M44 44L20 20" stroke="currentColor"></path>
			</svg>
			<div class="alert__message">This is a ${type} notificiation</div>
			<div class="alert__close">&times;</div>
		`;
  } else if (type == "warning") {
    newAlert.innerHTML = `
			<svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle class="alert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor"></circle>
				<path class="alert__icon-path alert__icon-path--type" d="M32 19V38" stroke="currentColor"></path>
				<path class="alert__icon-path alert__icon-path--type" d="M32 41L32 45" stroke="currentColor"></path>
			</svg>
			<div class="alert__message">This is a ${type} notificiation</div>
			<div class="alert__close">&times;</div>
		`;
  } else {
    newAlert.innerHTML = `
			<svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle class="alert__icon-path" cx="32" cy="32" r="30.5" fill="currentColor" style="opacity: .2;"></circle>
      <circle class="alert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor"></circle>
    </svg>
			<div class="alert__message">This is a ${type} notificiation</div>
			<div class="alert__close">&times;</div>
		`;
  }
  wrapper.appendChild(newAlert);
  newAlert.style.transform = "translateX(-3rem)";
  newAlert.style.opacity = "0";
  setTimeout(() => {
    newAlert.style.transform = "translateX(0)";
    newAlert.style.opacity = "1";
  }, 100);
  closeAlertItem();
  emptyState();
};

closeAlertItem();
</script>
