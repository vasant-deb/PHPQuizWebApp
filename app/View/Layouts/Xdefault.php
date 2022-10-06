<?php

Configure::write('debug', 0);  
$thumbImageurl = 'upload_images/'.$company['Company']['company_logo'];

$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
$Imageurl = ($company['Company']['company_logo'] != '')?$thumbImageurl:$Imageurl;
  
?>
<?php  echo $this->element('sunrise/head'); ?> 
<div class="wrapper">	
		<?php  echo $this->element('sunrise/header'); ?>
		<?php  echo $this->Session->flash(); ?> 
		<?php  echo $this->fetch('content'); ?>
		<?php  echo $this->element('sunrise/footer'); ?>
 