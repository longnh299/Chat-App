<style>
    .login-btn {
        background-color: black;
    }

    .login-input {
        width: 500px;
    }

    .login-div {
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

    .reg-btn {
        text-align: right;
    }
</style>
<div class="login-div">
    <h1>Login</h1>
    <?php
    echo $this->Form->create($t_user);
    echo $this->Form->control('id', ['type' => 'hidden']);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('email', ['class' => 'login-input', 'placeholder' => 'enter your email']);
    echo $this->Form->control('password', ['class' => 'pass-input', 'placeholder' => 'enter your password']);
    echo $this->Form->button(__('Login', ['class' => 'login-btn']));
    echo $this->Form->end();
    ?>
    <div class="reg-btn">
        <p>don't have an account!</p>
        <a href="<?= $this->Url->build('/user/regist') ?>">Register</a>
    </div>
</div>