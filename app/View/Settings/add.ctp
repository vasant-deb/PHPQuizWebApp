<div class="settings form">
<?php echo $this->Form->create('Setting'); ?>
	<fieldset>
		<legend><?php echo __('Add Setting'); ?></legend>
	<?php
		echo $this->Form->input('key');
		echo $this->Form->input('value');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('input_type');
		echo $this->Form->input('editable');
		echo $this->Form->input('weight');
		echo $this->Form->input('params');
		echo $this->Form->input('created_by');
		echo $this->Form->input('updated_by');
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
