

<head>
    <style>
        div.ex1 {
            background-color: white;
            width: 100%;
            height: 500px;
            overflow-y: scroll;
            border-radius: 12px;
            padding: 20px;
        }

        div.ex2 {
            background-color: white;
            height: 50%;
            border-radius: 12px;
            padding: 2px;
            margin-top: 10px;
            padding: 20px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        h1 {
            color: #606c76;
            font-size: 2.0rem;
            font-weight: 700;
        }

        .logout {
            padding-left: 1000px;
            margin: 20px;
        }

        .btn-edit-name {
            padding-left: 930px;
        }

        .emojidiv {
            display: flex;
            overflow-x: scroll;
        }
        .emoji_btn {
            min-width: 16.6%;
            min-height: 90px;
            background-color: #f5f7fa;
            border: none;
        }

        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }

        .custom-file-input::before {
            content: 'Select files';
            color: white;
            display: inline-block;
            background: #d33c43;
            border: 1px solid #999;
            border-radius: 3px;
            padding: 5px 8px;
            outline: none;
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 10pt;
        }

        .custom-file-input:hover::before {
            border-color: black;
        }

        .custom-file-input:active::before {
            background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
        }

        .btn-send {
            margin-left: 950px;
        }

        .dropbtn {
            background-color: #f5f7fa;
            color: white;
            font-size: 16px;
            border: none;

        }

        .dropdown {
            position: relative;
            display: inline-block;
            margin-left: 1000px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #f5f7fa;
        }

        .dropdown-icon {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<?php
// session
$session = $this->getRequest()->getSession();
$t_feed->user_id = $session->read('user_id');
$user_id = $session->read('user_id');
$t_feed->name = $session->read('name');
?>
<!--dropdown menu-->
<div class="dropdown">
    <button class="dropbtn"><img class="dropdown-icon" src="https://www.pngkey.com/png/detail/207-2079719_rounded-triangle-png-dropdown-arrow-icon-png.png" alt=""></button>
    <div class="dropdown-content">
        <a class='btn-edit-name' href="<?= $this->Url->build('/user/editname') ?>">Edit Account Name</a>
        <a class='btn-edit-password' href="<?= $this->Url->build('/user/editpw') ?>">Change Password</a>
        <a class='logout' href="<?= $this->Url->build('/user/login') ?>">Logout</a>
    </div>
</div>
<div class="ex1">
    <table>
        <tr>
            <th>Name</th>
            <th>message</th>
            <th>Emoji</th>
            <th>Media</th>
            <th>Create_at</th>
            <th>Update_at</th>
            <th>Action</th>
        </tr>
        <?php foreach ($t_feed as $t_feed) : ?>
            <tr>
                <td id="name">
                    <?= $t_feed->name ?>
                </td>
                <td>
                    <?= $this->Html->link($t_feed->message, ['action' => 'view', $t_feed->id]) ?>
                </td>
                <td>
                    <div style="width: 100px;height: 100px;">
                        <!-- display emoji-->
                        <img src="<?php echo "img/stamps/" . $t_feed->stamp_id . ".png"; ?>" alt="">
                    </div>
                </td>
                <td id="media">
                    <?php
                    // html can support video format types : mp4,webm,ogg
                    $media = $t_feed->imagefilename;
                    if (strpos($media, '.mp4') !== false || strpos($media, '.webm') !== false || strpos($media, '.ogg') !== false) {
                        echo '<video width="320" height="240" controls>';
                        echo "<source src='/video/$media' type='video/mp4'>";
                        echo "<source src='/video/$media' type='video/webm'>";
                        echo "<source src='/video/$media' type='video/ogg'>";
                        echo "</video>";
                    } elseif (strpos($media, '.mp3') !== false || strpos($media, '.wav') !== false) {
                        echo '<audio width="320" height="240" controls>';
                        echo "<source src='/audio/$media' type='audio/mpeg'>";
                        echo "<source src='/audio/$media' type='audio/wav'>";
                        echo "</audio>";
                    } else {
                        echo "<div style='width: 100px;'>";
                        echo $this->Html->image($media);
                        echo "</div>";
                    }
                    ?>
                </td>
                <td id="create">
                    <?= $t_feed->create_at ?>
                </td>
                <td id="update">
                    <?= $t_feed->update_at ?>
                </td>
                <td>
                    <?php if ($session->read('user_id') == $t_feed->user_id) {
                        echo $this->Html->link('Edit', ['action' => 'edit', $t_feed->id]);
                        echo "<br>";
                        echo $this->Form->postLink(
                            'Delete',
                            ['action' => 'delete', $t_feed->id],
                            ['confirm' => 'Are you sure?']
                        );
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div class="ex2">
    <!-- Form chat box -->
    <?php
    echo $this->Form->create(NULL, array('url' => 'chat/add', 'type' => 'file'));
    $session = $this->getRequest()->getSession();
    $t_feed->user_id = $session->read('user_id');
    $t_feed->name = $session->read('name');
    echo $this->Form->control('id', ['type' => 'hidden']);
    echo $this->Form->control('user_id', ['value' => $user_id, 'type' => 'hidden']);
    echo $this->Form->control('message', ['rows' => '5', 'placeholder' => 'Enter your message here']);
    echo $this->Form->control('Media', ['type' => 'file', 'title' => 'Choose a image', 'class' => 'custom-file-input', 'onchange' => 'readURL(this)']);
    echo '<img id="preview-image" hidden="true" src="#">';
    echo '<video id="preview-video"  height="0" controls>';
    echo "<source src='#' type='video/mp4'>";
    echo "<source src='#' type='video/webm'>";
    echo "<source src='#' type='video/ogg'>";
    echo "</video>";
    echo '<audio id="preview-audio" hidden="true"  controls>';
    echo "<source src='#' type='audio/mpeg'>";
    echo "<source src='#' type='audio/wav'>";
    echo "</audio>";
    echo "<h1>Emoji</h1>";
    echo "<div class='emojidiv'>";
    $link = "img/stamps/";
    $emoji = glob($link . "*.png");
    // get stamp id
    foreach ($emoji as $emoji) {
        $subemoji = substr($emoji, 11);
        $rev_str = strrev($subemoji);
        $sub_rev_str = substr($rev_str, 4);
        $rev_sub_rev_str = strrev($sub_rev_str);
        $id_stamp = (int)$rev_sub_rev_str;
        echo '<button class="emoji_btn" name="stamp_id" value=' . $id_stamp . '><img src="' . $emoji . '" /></button>';
    }
    echo "</div>";
    echo "<br>";
    echo $this->Form->button(__('Send'), ['class' => 'btn-send']);
    echo $this->Form->end();

    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
<script>
    // preview file before upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                if (e.target.result.includes('video')) {
                    $('#preview-video').attr('src', e.target.result).removeAttr('hidden').width(150).height(200);
                    $('#preview-image').attr('src', e.target.result).attr("hidden", true);
                    $('#preview-audio').attr('src', e.target.result).attr("hidden", true);
                } else if (e.target.result.includes('audio')) {
                    $('#preview-audio').attr('src', e.target.result).width(200).height(200).removeAttr('hidden');
                    $('#preview-video').attr('src', e.target.result).attr("hidden", true);
                    $('#preview-image').attr('src', e.target.result).attr("hidden", true);
                } else {
                    $('#preview-image').attr('src', e.target.result).width(150).height(200).removeAttr('hidden');
                    $('#preview-video').attr('src', e.target.result).attr("hidden", true);
                    $('#preview-audio').attr('src', e.target.result).attr("hidden", true);
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>