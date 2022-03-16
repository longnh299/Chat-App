<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a>
                 <img style=" max-width :50px;" src="https://i.pinimg.com/originals/84/7a/34/847a34f8bc72a7f5223ec0f3aa227796.png" alt="Mario Rossi">
            </a>
            <a href="<?= $this->Url->build('/chat') ?>">WhatsApp red</a>
        </div>
         <div class="top-nav-links">
         <!-- <a href="<?= $this->Url->build('/user/login') ?>">Login</a> 
         <a href="<?= $this->Url->build('/user/regist') ?>">Register</a> -->
            <!-- <a>
                 <img style="border-radius: 50%; max-width :50px" src="https://randomuser.me/api/portraits/men/46.jpg" alt="Mario Rossi">
            </a>
            <a target="_blank" rel="noopener" href="">Logout</a> -->
            <?php
                $session = $this->request->getSession();
                $email="";
                $name="";
                $email=$session->read('email');
                $name=$session->read('name');
                if($email =="" && $name==""){

                }
                else {
                    echo "
                    <span class='hi'>
                    <span class='hello'> Hello ".$name."</span> 
                      ";
                }
            ?>
        </div> 
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
