
<div class="container-fluid main-content">
  <div class="page-title">
    <h1><?php echo __('Settings'); ?></h1>
  </div>
<div class="settings index">
 	
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
	
 	<thead>
	<tr>
			<th>id<?php //echo $this->Paginator->sort('id'); ?></th>
			<th>name<?php //echo $this->Paginator->sort('name'); ?></th>
			<th>sitelogo<?php //echo $this->Paginator->sort('sitelogo'); ?></th>
			<th>email<?php //echo $this->Paginator->sort('email'); ?></th>
			<th>email_contact<?php //echo $this->Paginator->sort('email_contact'); ?></th>
			<th>address1<?php //echo $this->Paginator->sort('address1'); ?></th>
			<th>address2<?php //echo $this->Paginator->sort('address2'); ?></th>
			<th>address3<?php //echo $this->Paginator->sort('address3'); ?></th>
			<th>contact_number<?php //echo $this->Paginator->sort('contact_number'); ?></th>
			<th>facebook_url<?php //echo $this->Paginator->sort('facebook_url'); ?></th>
			<th>twitter_url<?php //echo $this->Paginator->sort('twitter_url'); ?></th>
			<th>googleplus_url<?php //echo $this->Paginator->sort('googleplus_url'); ?></th>
			<th>instagram_url<?php //echo $this->Paginator->sort('instagram_url'); ?></th>
			<th>linkedin_url<?php //echo $this->Paginator->sort('linkedin_url'); ?></th>
			<th>meta_title<?php //echo $this->Paginator->sort('meta_title'); ?></th>
			<th>meta_desc<?php //echo $this->Paginator->sort('meta_desc'); ?></th>
			<th>meta_keyword<?php //echo $this->Paginator->sort('meta_keyword'); ?></th>
			<th>google_analytics<?php //echo $this->Paginator->sort('google_analytics'); ?></th>
			<th>custom1<?php //echo $this->Paginator->sort('custom1'); ?></th>
			<th>custom2<?php //echo $this->Paginator->sort('custom2'); ?></th>
			<th>custom3<?php //echo $this->Paginator->sort('custom3'); ?></th>
			<th>custom5<?php //echo $this->Paginator->sort('custom5'); ?></th>
			<th>custom6<?php //echo $this->Paginator->sort('custom6'); ?></th>
			<th>created<?php //echo $this->Paginator->sort('created'); ?></th>
			<th>modified<?php //echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($settings as $setting): ?>
	<tr>
		<td><?php echo h($setting['Setting']['id']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['name']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['sitelogo']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['email']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['email_contact']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['address1']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['address2']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['address3']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['contact_number']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['facebook_url']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['twitter_url']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['googleplus_url']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['instagram_url']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['linkedin_url']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['meta_title']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['meta_desc']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['meta_keyword']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['google_analytics']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['custom1']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['custom2']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['custom3']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['custom5']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['custom6']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['created']); ?>&nbsp;</td>
		<td><?php echo h($setting['Setting']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $setting['Setting']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $setting['Setting']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $setting['Setting']['id']), array(), __('Are you sure you want to delete # %s?', $setting['Setting']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Setting'), array('action' => 'add')); ?></li>
	</ul>
</div>
</div>