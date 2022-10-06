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
<select id="drinks1Type" name="data[Order][subtotal]" onchange="calculate()">
  <option value="0">--- Choose Subscription ---</option>
  <option disabled="disabled"></option>
  <optgroup label="Choose Subscription">
    <option value="3536.46">3 months</option>999
 <option value="6364.92">6 months</option>899
 <option value="9897.84">12 months</option>699
  </optgroup>

</select>
<br>
<script>
function calculate() {
        "use strict"
      
        var myBox2 = document.getElementById('drinks1Type').value;
        var result = document.getElementById('result'); 
        var tax = document.getElementById('tax'); 
        var total = document.getElementById('total'); 
        var inputCost=0;
        var inputTax=0;
         var inputTotal=0;
  
        switch (myBox2) {
            case '3536.46':
                inputCost="<td>Subtotal : 999 * 3 months </td><td><i class='fa fa-inr'></i> "+999*3+"</td>";
                inputTax="<td>Taxes & Fees :</td> <td><i class='fa fa-inr'></i>539.46</td>";
                inputTotal="<td>Total :</td> <td><i class='fa fa-inr'></i>3536.46</td>";
                break
        case '6364.92':
               inputCost="<td>Subtotal : 899 * 6 months</td> <td><i class='fa fa-inr'></i> "+899*6+"</td>";
                inputTax="<td>Taxes & Fees : </td><td><i class='fa fa-inr'></i>970.92</td>";
                inputTotal="<td>Total : </td><td><i class='fa fa-inr'></i>6364.92</td>";
                break
        case '9897.84':
               inputCost="<td>Subtotal : 699 * 12 months </td><td><i class='fa fa-inr'></i> "+699*12+"</td>";
                inputTax="<td>Taxes & Fees : </td><td><i class='fa fa-inr'></i>1509.84</td>";
                inputTotal="<td>Total : </td><td><i class='fa fa-inr'></i>9897.84</td>";
                break
            //default:
            //  alert ("You haven't coded this yet");
        }

        result.value = inputCost;
document.getElementById("result").innerHTML=inputCost; 
document.getElementById("tax").innerHTML=inputTax; 
document.getElementById("total").innerHTML=inputTotal; 
    
}
</script><br>
<table>
      <tr class="totals-value" id="result"><td>Subtotal :&nbsp;</td><td><i class="fa fa-inr"></i>&nbsp;8388.00</td></tr>
      <tr class="totals-value" id="tax"><td>Taxes & Fees :&nbsp;</td><td><i class="fa fa-inr"></i>&nbsp;1509.84</td></tr>
   
      <tr class="totals-value" id="total"><td>Total :&nbsp;</td><td><i class="fa fa-inr"></i>&nbsp;9897.84</td></tr>
      </table>
<br>
<input type="hidden" name="data[Order][order_id]" value="<?php echo  "ORDS" . rand(10000,99999999)?>">		
<input type="hidden" name="data[Order][user_id]" value="<?php echo $customer_data['User']['id']; ?>" />		
<input type="hidden" name="data[Order][product_id]"  value="2">			<!-- CHECKBOX			
					<!-- CHECKBOX -->
					
					

<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="data[Order][ORDER_ID]" autocomplete="off" value="<?php echo  "ORDS" . rand(10000,99999999)?>">
<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="data[Order][CUST_ID]" autocomplete="off" value="<?php echo $customer_data['User']['id']; ?>">
		
<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="data[Order][INDUSTRY_TYPE_ID]" autocomplete="off" value="Retail"></td>
<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="data[Order][CHANNEL_ID]" autocomplete="off" value="WEB">

<input type="hidden" name="data[Order][first_name]" class="form-control mystyle" value="<?php echo $customer_data['User']['username']; ?>"  required>
						<input type="hidden" name="data[Order][order_type]" value="Airplane Plan">
					<br>
					<input type="hidden" name="data[Order][email]" value="<?php echo $customer_data['User']['email']; ?>" class="form-control mystyle" required>
					<br>
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

 