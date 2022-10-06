<div class="banner">
  <div class="inner-banner">
    <div class="note"><?php echo $news['News']['name']; ?></div>
    <div class="site-map"> You are here: <a href="<?php echo $this->webroot;?>">Home</a> &gt; <a href="news-events" rel="tag">News & Events</a> &gt; <?php echo $news['News']['name']; ?> </div>
    <div class="clear"></div>
  </div>
</div>
				
				<?php
				$thumbImageurl = $this->Html->url('/img/upload_images/'.$news['News']['image']);
				$Imageurl = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
				
				$Imageurl = ($news['News']['image'] != '')?$thumbImageurl:$Imageurl;
				?>
<div class="wrapper dark">
  <div class="column9 port-single">
    <p><img class="alignnone size-large wp-image-27" alt="<?php echo $news['News']['name']; ?>" src="<?php echo $Imageurl;?>"></p>
    <p>&nbsp;</p>
    <p><?php echo $news['News']['description']; ?></p>
  </div>
  <div id="sidebar" class="column3 side-blog"> </div>
  <div class="clear"></div>
</div>
 