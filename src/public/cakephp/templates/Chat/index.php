<!-- File: templates/Articles/index.php  (delete links added) -->
<style>
div.ex1 {
  background-color: white;
  width: 100%;
  height: 500px; 
  overflow-y: scroll;
  border: 2px solid red;
  border-radius: 12px;
  padding: 20px;
}
div.ex2 {
  border: 2px solid red;
  border-radius: 12px;
  padding: 2px;
  margin-top: 10px;
  padding: 20px;
}
h1 {
    padding-left: 450px;
}
.logout {
    padding-left: 1000px;
    margin: 20px;
}
</style>
<a class='logout' href="<?= $this->Url->build('/user/login') ?>">Logout</a> 
<div class="ex1">
<table>
    <tr>
        <th>Name</th>
        <th>message</th>
        <th>Create_at</th>
        <th>Update_at</th>
        <th>Action</th>
    </tr>

<!-- Here's where we iterate through our $articles query object, printing out article info -->

<?php foreach ($t_feed as $t_feed): ?>
    <tr>
        <td>
            <?= $this->Html->link($t_feed->name, ['action' => 'view', $t_feed->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($t_feed->message, ['action' => 'view', $t_feed->id]) ?>
        </td>
        <td>
            <?= $t_feed->create_at?> 
        </td> 
        <td>
            <?= $t_feed->update_at?> 
        </td> 
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $t_feed->id]) ?>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $t_feed->id],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>
</div>
<div class="ex2">
<h1>Chat Box</h1>

    <?php
    //echo $this->Form->create($t_feed);
    echo $this->Form->create(NULL,array('url'=>'chat/add'));
    // Hard code the user for now.
    echo $this->Form->control('id', ['type' => 'hidden']);
    echo $this->Form->control('name');
    echo $this->Form->control('message', ['rows' => '5']);
    //echo $this->Form->control('create_at',['value'=>getdate()]);
     echo $this->Form->button(__('Send'));
    echo $this->Form->end();
?>
</div>