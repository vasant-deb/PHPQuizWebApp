<table width="100%">
  <tbody>
    <tr>
      <td>
      <h2>CREDIT APPLICATION</h2> 
      </td>
    </tr>
  </tbody>
</table>
<table border="1" width="100%" cellpadding="5" cellspacing="5" style="text-align:left;border-collapse:collapse!important;border:solid 1px #ccc;font-family:Arial,Helvetica,sans-serif;font-size:14px">
  <tbody>
  <?php //Router::url('/', true); ?>
   <tr>
      <td width="43%"><table  border="0">          
          <tbody><tr>
            <td><img src="<?php echo $this->webroot;?>images/fmfformlogo.png"></td>
          </tr>
        </tbody></table></td>
      <td align="right"><table border="0">
          <tbody><tr>
            <td>7611 Pine Valley Dr., Unit 8 </td>
          </tr>
          <tr>
            <td>Woodbridge,ON L4L 0A2</td>
          </tr>
          <tr>
            <td>Toll Free : 1.844.620.2503</td>
          </tr>
          <tr>
            <td>Phone : 416.775.9507</td>
          </tr>
          <tr>
            <td>info@fmfglasshardware.com</td>
          </tr>
          <tr>
            <td>www.fmfglasshardware.com</td>
          </tr>
        </tbody></table></td>
    </tr>
  
    <tr>
      <td colspan="2" align="right"><table width="20%" style="font-family:Arial,Helvetica,sans-serif">
          <tbody><tr>
            <td> Date of Application </td>
            <td><?php echo h($enquiry['Creditenquiry']['date_of_application']); ?> </td>
          </tr>
        </tbody></table></td>
    </tr>
    <tr>
      <td>Business Name </td>
      <td bgcolor="#FFFFFF"><?php echo h($enquiry['Creditenquiry']['business_name']); ?></td>
    </tr>
    <tr>
      <td>Complete Address </td>
      <td bgcolor="#FFFFFF"><?php echo h($enquiry['Creditenquiry']['address1']); ?></td>
    </tr>
    <tr>
      <td></td>
      <td bgcolor="#FFFFFF"><?php echo h($enquiry['Creditenquiry']['address2']); ?></td>
    </tr>
    <tr>
      <td> Telephone Number </td>
      <td bgcolor="#FFFFFF"><?php echo h($enquiry['Creditenquiry']['telephone_number']); ?> </td>
    </tr>
    <tr>
      <td> Email </td>
      <td bgcolor="#FFFFFF"><?php echo h($enquiry['Creditenquiry']['email']); ?></td>
    </tr>
    <tr>
      <td> How Long Has Business Been in Operation? </td>
      <td bgcolor="#FFFFFF"><?php echo h($enquiry['Creditenquiry']['business_since']); ?></td>
    </tr>
    <tr>
      <td> Will Company Accept Back Orders?</td>
      <td bgcolor="#FFFFFF"><?php echo h($enquiry['Creditenquiry']['accept_back_orders']); ?></td>
    </tr>
    <tr>
      <td colspan="2" align="left"> Name of Owner (or Officers if corporated)</td>
    </tr>
    <tr>
      <td bordercolor="#000000"><table>
          <tbody><tr>
            <td><?php echo h($enquiry['Creditenquiry']['name_of_owner1']); ?></td>
          </tr>
          <tr>
            <td><?php echo h($enquiry['Creditenquiry']['name_of_owner2']); ?></td>
          </tr>
          <tr>
            <td><?php echo h($enquiry['Creditenquiry']['name_of_owner3']); ?></td>
          </tr>
        </tbody></table></td>
      <td><table width="202">
          <tbody><tr>
            <td bgcolor="#FFFFFF"> 
			<?php if($enquiry['Creditenquiry']['organization_type'] == 'Sole Proprietorship') { ?>
			<img src="<?php echo $this->webroot;?>images/checkbox.png" border="1" />
			<?php } else { ?>
			 <img src="<?php echo $this->webroot;?>images/checkbox-1.png" border="1" /> 
			 <?php } ?> 
			 Sole Proprietorship
			</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"> 
			<?php if($enquiry['Creditenquiry']['organization_type'] == 'Partnership') { ?>
			<img src="<?php echo $this->webroot;?>images/checkbox.png" border="1" />
			<?php } else { ?>
			 <img src="<?php echo $this->webroot;?>images/checkbox-1.png" border="1" /> 
			 <?php } ?> 
			Partnership 
			</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"> 
			<?php if($enquiry['Creditenquiry']['organization_type'] == 'Corporation') { ?>
			<img src="<?php echo $this->webroot;?>images/checkbox.png" border="1" />
			<?php } else { ?>
			 <img src="<?php echo $this->webroot;?>images/checkbox-1.png" border="1" /> 
			 <?php } ?> 
			 Corporation
			</td>
          </tr>
        </tbody></table></td>
    </tr>
    <tr>
      <td> Bank Name</td>
      <td><?php echo h($enquiry['Creditenquiry']['bank_name']); ?></td>
    </tr>
    <tr>
      <td>Bank Address</td>
      <td><?php echo h($enquiry['Creditenquiry']['bank_address']); ?></td>
    </tr>
    <tr>
      <td>Bank Phone No.</td>
      <td><?php echo h($enquiry['Creditenquiry']['bank_phone_no']); ?></td>
    </tr>
    <tr>
      <td>Bank Account No.</td>
      <td><?php echo h($enquiry['Creditenquiry']['bank_account_no']); ?></td>
    </tr>
    <tr>
      <td colspan="2">Name and Account Numbers of Current Suppliers</td>
    </tr>
    <tr>
      <td><table width="445">
          <tbody><tr>
            <td width="217">1.Name of Supplier</td>
            <td width="304"><?php echo h($enquiry['Creditenquiry']['name_of_supplier1']); ?></td>
          </tr>
          <tr>
            <td>Account #</td>
            <td><?php echo h($enquiry['Creditenquiry']['supplier_account1']); ?></td>
          </tr>
          <tr>
            <td>Telephone #</td>
            <td><?php echo h($enquiry['Creditenquiry']['supplier_telephone1']); ?></td>
          </tr>
        </tbody></table></td>
      <td><table>
          <tbody><tr>
            <td width="185">2.Name of Supplier</td>
            <td width="214"><?php echo h($enquiry['Creditenquiry']['name_of_supplier2']); ?></td>
          </tr>
          <tr>
            <td>Account #</td>
            <td><?php echo h($enquiry['Creditenquiry']['supplier_account2']); ?></td>
          </tr>
          <tr>
            <td>Telephone #</td>
            <td><?php echo h($enquiry['Creditenquiry']['supplier_telephone2']); ?></td>
          </tr>
        </tbody></table></td>
    </tr>
    <tr>
      <td height="101" colspan="2" bgcolor="#CCCCCC">The undersigned expressly agrees to make payment in full to FMF Glass Hardware for all purchases in accordance with the terms of the sale.
        <br>
        It is agreed that My/Our account may become Credit Card (without being notified) if I/We fail to pay within the stated terms. Should the undersigned default in any such payment, the undersigned agrees to pay a late service charge on any amounts in default at the maximum permitted by law. This agreement shall become effective when accepted by an authorized FMF Glass Hardware representative. The undersigned hereby authorizes the above mentioned banks and business references to release the information requested by FMF Hardware. </td>
    </tr>
    <tr>
      <td>Form Completed By </td>
      <td><?php echo h($enquiry['Creditenquiry']['form_completed_by_name']); ?></td>
    </tr>
    <tr>
      <td>Title</td>
      <td><?php echo h($enquiry['Creditenquiry']['form_completed_by_title']); ?></td>
    </tr>
    <tr>
      <td>Telephone </td>
      <td><?php echo h($enquiry['Creditenquiry']['form_completed_by_telephone']); ?></td>
    </tr>
    <tr>
      <td>Email </td>
      <td><?php echo h($enquiry['Creditenquiry']['form_completed_by_email']); ?></td>
    </tr>
  </tbody>
</table>
