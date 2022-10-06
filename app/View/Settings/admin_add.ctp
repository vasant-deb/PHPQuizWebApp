<div class="settings form">
<?php echo $this->Form->create('Setting'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Setting'); ?></legend>
	<?php
		echo $this->Form->input('name', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('sitelogo', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('email', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('email_contact', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('address1', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('address2', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('address3', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('contact_number', array('class'=>'form-control col-md-3','label'=>''));?>w
	<?php	echo $this->Form->input('facebook_url', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('twitter_url', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('contact_number2', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('googleplus_url', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('instagram_url', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('linkedin_url', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('meta_title', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('meta_desc', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('meta_keyword', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('google_analytics', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('custom1', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('custom2', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('custom3', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('custom5', array('class'=>'form-control col-md-3','label'=>''));?>
	<?php	echo $this->Form->input('custom6', array('class'=>'form-control col-md-3','label'=>''));?>
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Settings'), array('action' => 'index')); ?></li>
	</ul>
</div>
