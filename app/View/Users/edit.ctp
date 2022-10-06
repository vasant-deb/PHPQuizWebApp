<h1>
<?php
$action = ($this->action == 'add') ? 'Add User' : 'Edit User';
  echo $action;
?>
</h1>
<div class="users form">
      <p class="msg"></p>
      <?php
          echo $this->Html->script('users_edit');
          echo $this->Form->create('User',array('novalidate'=>true));
          echo $this->Form->input('name');
           echo $this->Form->input('username');
          echo $this->Form->input('id', array('type' => 'hidden'));
       ?>
    <?php echo $this->Html->image('loading.gif', array('alt' => 'Loading...')); ?>
</div>
   <?php 
     $options = array
     (
         'label' => 'Save',
         'value' => 'Save',
         'id' => 'save'
     );
     echo $this->Form->end($options);?>
</div><script src="assets/lib/jquery/dist/jquery.min.js"></script>
