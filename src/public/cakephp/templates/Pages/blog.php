
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat app</title>
    <style>
        .name1 {
            width: 50%;
        }
        .d1 {
            border: solid 2px red;
            padding: 100px;
            border-radius: 25px;
        }
        .intro {
            text-align: center;
        }
        .d2 {
            padding-left: 400px;
        }
    </style>
</head>
<body>
    <div class='d1'>
        <p class='intro'>Welcome to WhatsApp red</p>
        <!-- <a href="<?= $this->Url->build('/user/login') ?>">Login</a> <br>
        <a href="<?= $this->Url->build('/user/regist') ?>">Register</a> -->
        <div class="d2">
            <button type="button" class="btn btn-outline-danger"><a href="<?= $this->Url->build('/user/login') ?>">Login</a></button> <br>
            <button type="button" class="btn btn-outline-danger"><a href="<?= $this->Url->build('/user/regist') ?>">Register</a></button>
        </div>
    </div>
   
</body>
</html>