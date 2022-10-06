<?php
 
 $order_data = $order;
 
 ?>
 <?php $invoice_number = $order['Order']['id']; //$number = sprintf('1%02d', $order['Order']['id']); ?>

 
 <!-- Content -->

<div class="panel panel-default">
<div class="panel-body">    
 
 
	<div class="row">
      <div class="container">

	<div class="col col-sm-6">
	
	<p>
	<b>Invoice ID : <?php echo '#AsteriskServe/'.date('Y');?>/<?php echo $invoice_number;?></b> 
	</p>
<p>	
	<b>Order Date : <?php echo date('m/d/Y', strtotime($order_data['Order']['created']));?></b>  
   </p> <p>
	<b>Order Type : <?php echo strtoupper($order_data['Order']['order_type']);?></b><br />
	</p></div>
	<div class="col col-sm-6">
 
	   <?php 
		   echo $this->Html->link("Back to Order History",
		   array( 'controller' => '/', 'action' => 'index', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-danger  pull-right')); 
			?>
			
			 <?php 
		   echo $this->Html->link("Print Invoice",
		   array( 'controller' => 'orders', 'action' => 'invoice', $order_data['Order']['id'],'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-success  pull-right', 'target' => '_self' )); 
			?>
</div> 
  </div>      

</div>
</div>

    <!-- Ship Process -->
    <div class="ship-process padding-top-30 padding-bottom-30">
      <div class="container">
            
      </div>
    </div>
    
    <!-- Payout Method -->
    <section class="padding-bottom-60">
      <div class="container"> 
        <!-- Payout Method -->
        <div class="pay-method check-out"> 
          
          <!-- Shopping Cart -->
          <div class="heading">
            <h2>Order Details</h2>
            <hr>
          </div>
          
<div class="row">
    <div class="col col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Customer Info</h3>
            </div>
            <div class="panel-body">
                <?php echo $order_data['Order']['first_name'];?> <?php echo $order_data['Order']['last_name'];?><br />
                Email: <?php echo $order_data['Order']['email'];?><br />
                Phone: <?php echo $order_data['Order']['phone'];?><br>
				&nbsp;
            </div>
        </div>
    </div>
    
   
</div>


<hr>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
    <div class="col col-sm-1">#</div>
    <div class="col col-sm-6">ITEM</div>
    <div class="col col-sm-2">UNIT PRICE</div>
    
</div>

 <hr>
<br />
 
<?php $i = 0; foreach ($order_item as $item): $i++; ?>
<div class="row">
    <div class="col col-sm-1"><?php echo $i;?></div>
    <div class="col col-sm-6 pull-left">
	  <div class="col col-sm-4 table-bordered">
<?php echo $this->Html->image('/images/products/' . $item['Product']['image'], ['class' => 'img-responsive']); ?>
			</div>
  <div class="col col-sm-8">			
    <b><?php echo $item['Product']['name']; ?></b>
	
	 
	
			
</div>			
     </div>
     <div class="col col-sm-2"><i class="icon icon-inr"></i> <?php echo $item['Product']['discounted_price']; ?></div>
  
   
</div>
 
<?php endforeach; ?>

<hr>
 

<div class="row">
	<div class="col col-sm-6"></div> 
 	<div class="col col-sm-2"></div>	
 	<div class="col col-sm-2"  align="left" style="text-align: right;">Order Total:</div>	
	<div class="col col-sm-2" style="text-align: right;"><strong><i class="icon icon-inr"></i> <?php echo $order_data['Order']['subtotal']; ?></strong></div>
</div>
 
 
 <br>
 <hr>
 
 
 
      </div>
 
 
      </div>
 
      </div>
    </section>
      
 