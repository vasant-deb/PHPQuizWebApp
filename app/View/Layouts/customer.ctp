<?php
Configure::write('debug', 0);  
echo $this->element('samatra/head'); 
echo $this->element('samatra/header');

//echo $this->Session->flash(); 
echo $this->fetch('content'); 
echo $this->element('samatra/footer'); 
?>


<?php // echo $this->element('sql_dump'); ?>
