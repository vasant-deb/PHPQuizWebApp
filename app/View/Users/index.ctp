<h1>Users List</h1>
<table>
    <tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <!-- looping through $users array,display user details -->
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td><?php echo $user['User']['firstname']; ?></td>
        <td><?php echo $user['User']['lastname']; ?></td>
        <td><?php echo $user['User']['email']; ?></td>
        <td><?php echo $this->Html->link('Edit',array('action'=>'edit',$user['User']['id'])); ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>