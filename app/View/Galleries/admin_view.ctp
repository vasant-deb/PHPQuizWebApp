<div class="galleries view">
<h2><?php echo __('Gallery'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($gallery['Company']['name'], array('controller' => 'companies', 'action' => 'view', $gallery['Company']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Showon Home'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['showon_home']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Showon Catalog'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['showon_catalog']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Url'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['page_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Url Target'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['page_url_target']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Title'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['meta_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Desc'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['meta_desc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Keyword'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['meta_keyword']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gallery'), array('action' => 'edit', $gallery['Gallery']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Gallery'), array('action' => 'delete', $gallery['Gallery']['id']), array(), __('Are you sure you want to delete # %s?', $gallery['Gallery']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Galleries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
