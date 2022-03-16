<h1>Login</h1>
<?php
    echo $this->Form->create($t_user);
    //echo $this->Form->create(NULL,array('url'=>'chat/add'));
    // Hard code the user for now.
    echo $this->Form->control('id', ['type' => 'hidden']);
    echo $this->Form->control('email');
    echo $this->Form->control('password');
    //echo $this->Form->control('name');
    //echo $this->Form->control('create_at',['value'=>getdate()]);
    echo $this->Form->button(__('Login'));
    echo $this->Form->end();
?>
<p>don't have an account!</p>
<a href="<?= $this->Url->build('/user/regist') ?>">Register</a>