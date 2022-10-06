<?php clearCache(); ?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>
.spacing{
    margin-top:70px;
}
.form-control {
	
margin: 0em 0 !important;

}
</style>
<section class="spacing py-5" id="testimonial" style="background:url(images/cyan-background.jpg) no-repeat center center;background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 py-5 bg-primary text-white text-center" style="background: linear-gradient(45deg, #db2acf, #f2c043);">
                <div class=" ">
                    <div class="card-body">
                        
                        <h2 class="py-3">Registration</h2>
                     <?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

?>
<form action="/orders/buynow" id="UserCustomerRegisterForm" method="post" accept-charset="utf-8">


<br>
<input type="hidden" name="data[Order][order_id]" value="<?php echo  "ORDS" . rand(10000,99999999)?>">		
<input type="hidden" name="data[Order][user_id]" value="<?php echo $customer_data['User']['id']; ?>" />		
<input type="hidden" name="data[Order][product_id]"  value="2">			<!-- CHECKBOX			
					<!-- CHECKBOX -->
					
					

<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="data[Order][ORDER_ID]" autocomplete="off" value="<?php echo  "ORDS" . rand(10000,99999999)?>">
<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="data[Order][CUST_ID]" autocomplete="off" value="<?php echo $customer_data['User']['id']; ?>">
		
<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="data[Order][INDUSTRY_TYPE_ID]" autocomplete="off" value="Retail"></td>
<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="data[Order][CHANNEL_ID]" autocomplete="off" value="WEB">

<input type="hidden" name="data[Order][subtotal]" value="0">				
<input type="hidden" name="data[Order][order_type]" value="Free Plan">
<input type="hidden" name="data[Order][first_name]" class="form-control mystyle" value="<?php echo $customer_data['User']['username']; ?>"  required>
<input type="hidden" name="data[Order][email]" value="<?php echo $customer_data['User']['email']; ?>" class="form-control mystyle" required>
<input type="hidden" name="data[Order][phone]" value="<?php echo $customer_data['User']['phone']; ?>" class="form-control mystyle" required>
</p>

                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border" style="background: aliceblue;">
                <h4 class="pb-4">Please fill with your bussiness details</h4>
                
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <input id="Company Name" name="data[Order][company_name]" placeholder="Company Name" class="form-control mystyle" type="text">
                        </div>
                        <div class="form-group col-md-6">
                         Already have Domain ?
						
						 <div class="radio">
  <label><input type="radio" name="data[Order][company_domain_status]"  value="yes" checked>Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
  <label><input type="radio" name="data[Order][company_domain_status]"  value="No" >No</label>
</div>

                        </div>
                      </div>
                       <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="inputEmail4" name="data[Order][company_email]" placeholder="Email" class="form-control mystyle" required="required" type="email" style="height: calc(2.25rem + 15px);font-size: 16px;">
                        </div>
                        <div class="form-group col-md-6">
                               <input id="inputEmail4" name="data[Order][company_email2]" placeholder="Email 2" class="form-control mystyle" type="email" style="height: calc(2.25rem + 15px);font-size: 16px;">
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                             <input id="Mobile No." name="data[Order][company_phone]" placeholder="Mobile No." class="form-control mystyle" required="required" type="text">
                        </div>
                        <div class="form-group col-md-6">
                             <input id="Mobile No." name="data[Order][company_phone2]" placeholder="Mobile No 2." class="form-control mystyle" type="text">
                        </div>
                        
                    </div>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea id="Full Name" name="data[Order][company_address]" class="form-control mystyle" required="required">Bussiness Address</textarea>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <textarea id="Full Name" name="data[Order][company_description]" class="form-control mystyle" required="required">Bussiness Description</textarea>
                        </div>
                         <div class="form-group col-md-12">
                            <input id="Reference" name="data[Order][company_domain]" placeholder="Domain Name You Want?" class="form-control mystyle" type="text">
                        </div>
                        <div class="form-group col-md-12">
                            <input id="Reference" name="data[Order][company_reference]" placeholder="Reference Website Link" class="form-control mystyle" type="text">
                        </div>
                    </div>
                   
                   
                    
                    <div class="form-row">
                        <button type="submit"  class="btn btn-danger mystyle">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

 