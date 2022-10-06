<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Products</h1>
  </div>
 
  <!-- DataTables Example -->
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Manage Products
          <?php 
		   echo $this->Html->link("<i class=\"icon-plus\"></i>New Product",
		   array( 'action' => 'add', 'admin' => true),
		    array('escape' => FALSE,'class' => 'btn btn-sm btn-primary-outline pull-right')); 
			?>
        </div>
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
              <th>ID</th>
              <th>Product Name</th>
			  <th>Image</th>
              <th>Category</th>             
              <th>Date Added</th>
               <th class="actions">Actions</th>
              </thead>
            <tbody>
			 	<?php foreach ($products as $product): ?>
              <tr>
				<td><?php echo h($product['Product']['id']); ?></td>
				<td><?php echo h($product['Product']['name']); ?></td>
				<td><?php echo $this->Html->Image('/images/products/' . $product['Product']['image'], array('width' => 150, 'height' => 100, 'alt' => $product['Product']['image'], 'class' => 'img-responsive')); ?></td>			
				<td><?php echo $product['Category']['name']; ?></td>
 				 
 				<td><?php echo h($product['Product']['created']); ?></td>
                 <td class="actions">
				<div class="action-buttons"> 
			 
			<!--<a href="<?php echo $this->webroot;?>product/<?php echo $product['Product']['slug'];?>" target="_blank" class="table-actions"><i class="icon-eye-open"></i></a>
			
			<a href="<?php echo $this->webroot;?>admin/productmods/index/<?php echo $product['Product']['id'];?>" class="table-actions"><i class="icon-th-large"></i></a>-->
			
			<a href="<?php echo $this->webroot;?>admin/productphotos/index/<?php echo $product['Product']['id'];?>" class="table-actions"><i class="icon-camera"></i></a>

				 
				   <?php 
		   echo $this->Html->link("<i class=\"icon-pencil\"></i>",
		   array( 'action' => 'edit', $product['Product']['id']),
		    array('escape' => FALSE,'class' => 'table-actions')); 
			?>
			 

<?php echo $this->Form->postLink("<i class=\"icon-trash\"></i>", 
array('action' => 'delete', $product['Product']['id']), 
array('escape' => FALSE,'class' => 'table-actions'), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>

			</div>
				 </td>
              
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- end DataTables Example -->
</div>
   

<?php //echo $this->Tree->generate($categoriestree, array('element' => 'categories/tree_item', 'class' => 'categorytree', 'id' => 'categorytree')); ?>
<script>
$('#flashMessage').addClass('alert alert-success');
</script>
 
