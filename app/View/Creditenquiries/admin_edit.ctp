<div class="enquiries form">
<?php echo $this->Form->create('Enquiry'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Enquiry'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('enquiry_for');
		echo $this->Form->input('requirements');
		echo $this->Form->input('company_name');
		echo $this->Form->input('website_url');
		echo $this->Form->input('country');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('alternate_number');
		echo $this->Form->input('skype');
		echo $this->Form->input('gtalk');
		echo $this->Form->input('currency');
		echo $this->Form->input('budget');
		echo $this->Form->input('create_time');
		echo $this->Form->input('update_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Enquiry.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Enquiry.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Enquiries'), array('action' => 'index')); ?></li>
	</ul>
</div>
