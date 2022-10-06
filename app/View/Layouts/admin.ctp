<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Control Panel</title>
      
    <meta charset="UTF-8">
    <base href="<?php echo $this->webroot;?>">

<?php //echo $this->Html->css('/css/style.css'); ?>
<?php //echo $this->Html->css('/css/responsive.css'); ?>
<?php //echo $this->App->js(); ?>

<?php //echo $this->fetch('css'); ?>
<?php //echo $this->fetch('script'); ?>
<?php echo $this->element('head'); ?>
 <?php //echo $this->Html->script(array('bootstrap.min.js', 'admin.js')); ?>
 
</head>

<body class="page-header-fixed bg-1">
<div class="modal-shiftfix">

<?php Configure::write('debug', 0); ?>

<?php echo $this->element('header'); ?>

 <div class="page-title">
<?php echo $this->Session->flash(); ?>
 
 </div>
<?php echo $this->fetch('content'); ?>
 
<?php //echo $this->element('home'); ?>
 
<?php echo $this->element('footer'); ?>
 
 
	 <?php echo $this->Html->script(array('ckeditor/ckeditor.js')); ?>

	</script>
 <script>
 CKEDITOR.config.allowedContent = true;
   // CKEDITOR.replace( 'ckeditor' );
</script>
 </div>

</body>
</html>

 