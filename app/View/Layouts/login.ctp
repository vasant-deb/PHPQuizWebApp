<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Control Panel</title>
      
    <meta charset="UTF-8">
    <base href="<?php echo $this->webroot;?>">
 
<?php echo $this->element('head'); ?>
 

</head>
 
<body class="page-header-fixed bg-1">
<div class="modal-shiftfix">

<?php Configure::write('debug', 0); ?>

  <div class="login2">
 

<?php echo $this->fetch('content'); ?>
</div>
 <style>
body  {
    
    background: url(images/cyan-background.jpg) no-repeat center center;
    background-size: cover;
 }
 
 div.login2 .login-container {
  
 width:35%;
    background-color: white;
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 40px;
     padding: 20px;
    margin-bottom: 15px;
   margin-top: 50px;
}
</style>
  
<?php //echo $this->element('home'); ?>
 
<?php echo $this->element('footer'); ?>
 
 
	 <?php echo $this->Html->script(array('ckeditor/ckeditor.js')); ?>

	</script>
 <script>
   // CKEDITOR.replace( 'ckeditor' );
</script>
 </div>

</body>
</html>

 