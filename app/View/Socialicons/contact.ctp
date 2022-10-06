<div class="clearfix"></div>

<section class="middle-section-inner cross-bg">
<div class="container">
<div class="inner">
<div class="row-fluid ">

<div class="span12 pull-right">

<div class="breadcrum">
<a href="<?php echo $this->webroot;?>" title="Home">Home</a> ><?php echo $page['Page']['name']; ?>
</div>
<div class="product-box">
<h1><?php echo $page['Page']['name']; ?></h1>
<div class="contact-box">
<div class="row-fluid">
<div class="span6 address-box bg2" id="contact-form"><h2>Enquire Now</h2>
    						
<div class="form-group">
<div class="row">
<div col-md-12" id="successmsg"></div>
</div>
</div>

<form method="POST"  action="enquiries/add"  role="form">
<input type="hidden" name="enquiry_for" value="Enquiry For Contact Us">	
 						
<div class="form-group">
<div class="row-fluid">
<label CLASS="span3">NAME *</label>
<div class="span9"><input type="text" name="name" class="form-control" placeholder="Enter Name"required="required">
</div>
</div>

</div>
<div class="form-group">
<div class="row-fluid">
<label CLASS="span3">EMAIL *</label>
<div class="span9"><input class="form-control " type="email" name="email" required placeholder="Enter Email Id.." >
</div>
</div>

</div>
<div class="form-group">
<div class="row-fluid">
<label CLASS="span3">Mobile *</label>
<div class="span9"><input placeholder="Your Phone Number" tabindex="3" name="mobile" required="required" type="tel">
</div>
</div>

</div>
<div class="form-group">
<div class="row-fluid">
<label class="span3">Country *</label>
<div class="span9">
	<select name="country" required class="form-control"> 
	<option value="">Select Country</option>   
	<?php foreach ($countries as $item): ?>
	<option value="<?php echo $item['Country']['name'];?>"><?php echo $item['Country']['name'];?></option> 
	<?php endforeach; ?>
	</select>
</div>
</div>
</div>
 
<div class="form-group">
<div class="row-fluid">
<label CLASS="span3">Message *</label>
<div class="span9"><textarea placeholder="Enter your msg here" name="message" class="form-control"> </textarea></div>
</div>

</div>
<div class="form-group">
<div class="row-fluid"><div class="span4 pull-right"><input type="submit" class=" btn-orange" name="submit"/></div></div>
</div>
</form>
</div>
<div class="span6">

<div class="address-box">

<h2>Address & Directions</h2>
 
<?php echo $page['Page']['description']; ?>

</div>

</div>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</section>

<div class="clearfix mb40"></div>
						
<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>
 
<script>
$(function() { 

	$("#contact-form form").on('submit', function(event) {
		
	 
		var $form = $(this);
		
		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function() {
 			$('#successmsg').html('Thank you for your enquiry with us, <br> Our representative will get in touch with you soon.');
			$('#successmsg').addClass(' alert alert-success');
			
			$("#contact-form").find('input[type=text],textarea,select').filter(':visible').val('');
			
			}
		});
		event.preventDefault();
		 
	});
});
</script>
 
 