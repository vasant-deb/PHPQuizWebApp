<div class="pages view">
<h2><?php echo __('Page'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($page['Page']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($page['PageType']['name'], array('controller' => 'page_types', 'action' => 'view', $page['PageType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($page['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $page['Status']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article Date'); ?></dt>
		<dd>
			<?php echo h($page['Page']['article_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($page['Page']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Thumb'); ?></dt>
		<dd>
			<?php echo h($page['Page']['thumb']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Description'); ?></dt>
		<dd>
			<?php echo h($page['Page']['short_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($page['Page']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remark'); ?></dt>
		<dd>
			<?php echo h($page['Page']['remark']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Priority'); ?></dt>
		<dd>
			<?php echo h($page['Page']['priority']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create Time'); ?></dt>
		<dd>
			<?php echo h($page['Page']['create_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update Time'); ?></dt>
		<dd>
			<?php echo h($page['Page']['update_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Page'), array('action' => 'edit', $page['Page']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Page'), array('action' => 'delete', $page['Page']['id']), array(), __('Are you sure you want to delete # %s?', $page['Page']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Page Types'), array('controller' => 'page_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Type'), array('controller' => 'page_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
	</ul>
</div>
