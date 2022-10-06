<div class="settings view">
<h2><?php echo __('Setting'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sitelogo'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['sitelogo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Contact'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['email_contact']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address1'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address2'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['address2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address3'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['address3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Number'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['contact_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook Url'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['facebook_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twitter Url'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['twitter_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Googleplus Url'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['googleplus_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instagram Url'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['instagram_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Linkedin Url'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['linkedin_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Title'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['meta_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Desc'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['meta_desc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Keyword'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['meta_keyword']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Google Analytics'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['google_analytics']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Custom1'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['custom1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Custom2'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['custom2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Custom3'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['custom3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Custom5'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['custom5']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Custom6'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['custom6']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Setting'), array('action' => 'edit', $setting['Setting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Setting'), array('action' => 'delete', $setting['Setting']['id']), array(), __('Are you sure you want to delete # %s?', $setting['Setting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setting'), array('action' => 'add')); ?> </li>
	</ul>
</div>
