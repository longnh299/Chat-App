<!-- File: templates/Articles/add.php -->

<h1>Add Chat</h1>
<?php
    //echo $this->Form->create($t_feed);
    echo $this->Form->create(NULL,array('url'=>'chat/add'));
    // Hard code the user for now.
    echo $this->Form->control('id', ['type' => 'hidden']);
    echo $this->Form->control('name');
    echo $this->Form->control('message', ['rows' => '5']);
    //echo $this->Form->control('create_at',['value'=>getdate()]);
    echo $this->Form->button(__('Post'));
    echo $this->Form->end();
?>