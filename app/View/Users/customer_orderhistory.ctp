<?php ?>
<div class="breadcrumbs-area breadcrumbs-bg ptb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumbs-inner">
                            
                   <!-- <h2 class="breadcrumbs-title text-black m-0"> <span class="text-defualt">O</span>RDER <span class="text-defualt"> H</span>ISTRY</h2>-->
                            <ul class="top-page">
                                <li><a href="<?php echo $this->webroot;?>">Home</a></li>
                                <li>&gt;</li>
                                <li>Order Histry</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="checkout-page">
   <div class="container">
      <div class="row ">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="checkout_details_area checkout-1 mt-50 clearfix">
               <div class="row">
                  <div class="col-md-9">
                    
                     <hr>
                     <div class="billing-details">  
					<table class="table table-responsive">
					<thead>
					<tr>
					<th>Order ID</th>
					<th>Date</th>
				
					<th>Price</th>
					<th>Status</th>
					<th></th>
					</tr>
					</thead>
					<tbody>
					<?php 
					foreach ($order_data as $order_details):
					$order_status = $order_details['Order']['status'];
					$order_status_txt = array( '0' => 'Pending','2' => 'Shipped', '1' => 'Completed', '3' => 'Cancelled');
					$txt_status = @$order_status_txt[$order_status];

					$order_date       =  date("d-m-Y  h:i:s A",strtotime($order_details['Order']['created']));
					$customer_name    = $order_details['Order']['first_name'].' '.$order_details['Order']['last_name'];
				
					$order_total      = '<span class="fa fa-inr"></span>'.$order_details['Order']['total'];
					$order_id         = $order_details['Order']['id'];
					 
					?>
					<tr>
					<td>#<?php echo $order_id;?></td>
					<td><?php echo $order_date;?></td>
				
					<td class="price"><span><?php echo $order_total;?></span></td>
					<td><?php echo $txt_status;?></td>
					<td>
					<a href="customer/orderdetails/<?php echo $order_id;?>">Details</a>
					</td>
					</tr>
					 							
					<?php endforeach; ?>        
					</tbody>
					</table>
                     </div>
                  </div>
                  <div class="col-md-3">
                  <?php echo $this->element('unknown/myaccount_menu'); ?>				  
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>