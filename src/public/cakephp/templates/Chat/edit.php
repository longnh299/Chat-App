<!-- File: templates/Chat/edit.php -->

<h1>Edit Chat</h1>
<?php
    echo $this->Form->create($t_feed);
    echo $this->Form->control('id', ['type' => 'hidden']);
    echo $this->Form->control('name');
    echo $this->Form->control('message', ['rows' => '3']);
    echo $this->Form->button(__('Save Chat'));
    echo $this->Form->end();
?>