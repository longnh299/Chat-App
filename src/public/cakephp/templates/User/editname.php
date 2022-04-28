<h1>Edit Account Name</h1>
<?php
echo $this->Form->create($t_user);
echo $this->Form->control('id', ['type' => 'hidden']);
echo $this->Form->control('name', ['placeholder' => 'enter your name']);
echo $this->Form->control('password', ['placeholder' => 'enter your password']);
echo $this->Form->control('retype password', ['placeholder' => 'retype your password']);
echo $this->Form->button(__('Save'));
echo $this->Form->end();
?>