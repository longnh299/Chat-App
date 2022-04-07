<!-- File: templates/Chat/add.php -->

<h1>Add Chat</h1>
<?php
echo $this->Form->create(NULL, array('url' => 'chat/add'));
$session = $this->getRequest()->getSession();
$t_feed->user_id = $session->read('user_id');
$user_id = $session->read('user_id');
echo $this->Form->control('id', ['type' => 'hidden']);
echo $this->Form->control('user_id', ['value' => $user_id, 'type' => 'hidden']);
echo $this->Form->control('name');
echo $this->Form->control('message', ['rows' => '5']);
echo $this->Form->button(__('Post'));
echo $this->Form->end();
?>