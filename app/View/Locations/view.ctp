<?php
Configure::write('debug', 0);  
echo $this->element('location/slider');
echo $this->element('location/about');
echo $this->element('location/whyus');

//echo $this->element('unknown/services');
//echo $this->element('unknown/poplularservices');
echo $this->element('location/offer');

echo $this->element('location/testimonials');
echo $this->element('location/homeblog');

?>
