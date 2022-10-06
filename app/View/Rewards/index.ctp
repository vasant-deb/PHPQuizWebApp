<style>
.container {
  padding: 1.5em;
  max-width: 1400px;
  margin: auto;
}
.grid {
  display: inline-block;
  width: 100%;
}

.column {
  width: 25%;
  float: left;
}

.card-container {
  padding: 0 1.5em 3em 1.5em;
}

body .card {
  background-color: var(--cardColor);

  text-align: center;
  padding: 0 0 1em 0;
  border-radius: 0.3em;

}

.card>h1 {
  font-size: 4em;
}

.card>.data-type {
  letter-spacing: 4px;
  margin-left: 8px;
}

.text-sucess {
  color: green;
}

.text-danger {
  color: red;
}

.card>.data-today {
  margin: 2em 0 1em 0;
}

.border {
  background-color: #4267B2;
  height: 0.4em;
  border-top-left-radius: 0.3em;
  border-top-right-radius: 0.3em;
  margin-bottom: 1em;
}

#b-card-facebook>.border {
  background-color: #4F86F7;
}

#b-card-facebook>p>i {
  color: #4267B2;
}

#b-card-twitter>.border {
  background-color: #50BFE6;
}

#b-card-twitter>p>i {
  color: #1ba2f4;
}

#b-card-instagram>.border {
  background-color: #FD5B78;
}

#b-card-instagram>p>i {
  background: linear-gradient(to right, #fac06c, #db4e93);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}

#b-card-pinterest>.border {
  background-color: #ED0A3F;
}

#b-card-pinterest>p>i {
  color: #da4e5b;
}

.social-icon {
  font-size: 2em;
}

.social-username {
  letter-spacing: 0.5px;
  padding: 1em 0;
}

.social-username>i {
  vertical-align: middle;
  letter-spacing: 7px;
}

@media (max-width: 1100px) {
  .column {
    width: 50%;
  }
}

@media (max-width: 600px) {
  .column {
    width: 100%;
  }
}

.light-blue {
  color: #8a81bd;
}

#first-header {
  padding: 1.5em 0 3em 1.5em;
}

#hook {
  padding: 0 0 1em 1.5em;
}

.small-card {
  text-align: left;
  position: relative;
  height: 120px;

}

.small-text {
  top: 1.5em;
  left: 1.5em;
  position: absolute;
}

.small-logo {
  top: 1em;
  right: 1.5em;
  position: absolute;
}

.small-number {
  bottom: 0.05em;
  left: 0.3em;
  position: absolute;
}

.small-percent {
  bottom: 0.8em;
  right: 1.5em;
  position: absolute;
}

</style>
<div class="container-fluid">
               <div class="row">
<div class="grid">
<div class="column">
<div class="card-container">
<div class="card" id="b-card-facebook">
<div class="border"></div>

<h1>0</h1>
<p class="light-blue data-type">Total Vouchers</p>

</div>
</div>
</div>
<div class="column">
<div class="card-container">
<div class="card" id="b-card-twitter">
<div class="border"></div>

<h1><?php echo $quizeswon;?></h1>
<p class="light-blue data-type">Win Count</p>

</div>
</div>
</div>
<div class="column">
<div class="card-container">
<div class="card" id="b-card-instagram">
<div class="border"></div>

<h1><?php echo $quizesattempted;?></h1>
<p class="light-blue data-type">Quiz Attempted</p>

</div>
</div>
</div>
<div class="column">
<div class="card-container">
<div class="card" id="b-card-pinterest">
<div class="border"></div>

<h1><?php echo $selfrewardscountcheck['Reward']['points']?></h1>
<p class="light-blue data-type">Total Referal Points</p>

</div>
</div>
</div>
</div>
</div>



<div class="row">
    <p style="color:white;background-color:#ED0A3F;padding:5px;">Refer and earn 100 points, your referal code is : <b style="font-weight:700"><?php echo $selfrewardscountcheck['Reward']['code'];?></b></p>
  </div>
    <?php if($selfrewardscountcheck['Reward']['check_redeemed']==0) { ?>
    <div class="row">
    <form id="onpageReferForm" action="rewards/refer" method="post">
        <input type="text" placeholder="Refer Code" name="code" class="form-control"><br>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
     </div>
 <?php } ?>   
   



</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
         $(function() {
	$("#onpageReferForm").on('submit', function(event) {
	
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