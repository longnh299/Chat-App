<style>
    .regis-div {
        width: 50%;
        border: solid 2px red;
        padding: 30px;
        border-radius: 10px;
        background-color: white;
        margin: auto;
    }

    h1 {
        text-align: center;
    }

    .login-btn {
        text-align: right;
    }
</style>
<div class="regis-div">
    <h1>Register</h1>
    <?php
    echo $this->Form->create($t_user);
    echo $this->Form->control('id', ['type' => 'hidden']);
    echo $this->Form->control('email', ['placeholder' => 'enter your email']);
    echo $this->Form->control('password', ['placeholder' => 'enter your password']);
    echo $this->Form->control('name', ['placeholder' => 'enter your name']);
    echo $this->Form->button(__('Resgister'));
    echo $this->Form->end();
    ?>
    <div class="login-btn">
        <p>already have an account!</p>
        <a href="<?= $this->Url->build('/user/login') ?>">Login</a>
    </div>
</div>