<div class="settings form">
<?php echo $this->Form->create('Setting'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('sitelogo');
		echo $this->Form->input('email');
		echo $this->Form->input('email_contact');
		echo $this->Form->input('address1');
		echo $this->Form->input('address2');
		echo $this->Form->input('address3');
		echo $this->Form->input('contact_number');
		echo $this->Form->input('contact_number2');
		echo $this->Form->input('facebook_url');
		echo $this->Form->input('twitter_url');
		echo $this->Form->input('googleplus_url');
		echo $this->Form->input('instagram_url');
		echo $this->Form->input('linkedin_url');
		echo $this->Form->input('meta_title');
		echo $this->Form->input('meta_desc');
		echo $this->Form->input('meta_keyword');
		echo $this->Form->input('google_analytics');
		echo $this->Form->input('custom1');
		echo $this->Form->input('custom2');
		echo $this->Form->input('custom3');
		echo $this->Form->input('custom5');
		echo $this->Form->input('custom6');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Setting.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Setting.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Settings'), array('action' => 'index')); ?></li>
	</ul>
</div>
