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
<section class="spacing py-5" style="background:#F5F7F8;color:black;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center" style="background:white;border:1px solid #d6d6d6;margin-right:10px;">
                
                    <div class="card-body" >
                        
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
    <option value="17696.46">3 months</option>4999
 <option value="31552.92">6 months</option>4499
 <option value="60873.84">12 months</option>4299
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
            case '17696.46':
                inputCost="<td>Subtotal : 4999 * 3 months </td><td><i class='fa fa-inr'></i> "+4999*3+"</td>";
                inputTax="<td>Taxes & Fees :</td> <td><i class='fa fa-inr'></i>2699.46</td>";
                inputTotal="<td>Total :</td> <td><i class='fa fa-inr'></i>17696.46</td>";
                break
        case '31552.92':
               inputCost="<td>Subtotal : 4499 * 6 months</td> <td><i class='fa fa-inr'></i> "+4499*6+"</td>";
                inputTax="<td>Taxes & Fees : </td><td><i class='fa fa-inr'></i>4858.92</td>";
                inputTotal="<td>Total : </td><td><i class='fa fa-inr'></i>31552.92</td>";
                break
        case '60873.84':
               inputCost="<td>Subtotal : 4299 * 12 months </td><td><i class='fa fa-inr'></i> "+4299*12+"</td>";
                inputTax="<td>Taxes & Fees : </td><td><i class='fa fa-inr'></i>9285.84</td>";
                inputTotal="<td>Total : </td><td><i class='fa fa-inr'></i>60873.84</td>";
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
      <tr class="totals-value" id="result"><td>Subtotal :&nbsp;</td><td><i class="fa fa-inr"></i>&nbsp;51588.00</td></tr>
      <tr class="totals-value" id="tax"><td>Taxes & Fees :&nbsp;</td><td><i class="fa fa-inr"></i>&nbsp;9285.84</td></tr>
   
      <tr class="totals-value" id="total"><td>Total :&nbsp;</td><td><i class="fa fa-inr"></i>&nbsp;60873.84</td></tr>
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

				
<input type="hidden" name="data[Order][order_type]" value="Rocket Plan">
<input type="hidden" name="data[Order][first_name]" class="form-control mystyle" value="<?php echo $customer_data['User']['username']; ?>"  required>
<input type="hidden" name="data[Order][email]" value="<?php echo $customer_data['User']['email']; ?>" class="form-control mystyle" required>
<input type="hidden" name="data[Order][phone]" value="<?php echo $customer_data['User']['phone']; ?>" class="form-control mystyle" required>
</p>

                    </div>
                
            <div class="col-md-7 border" style="background:white;border:1px solid #d6d6d6;">
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

 