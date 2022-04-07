<!-- File: templates/Chat/edit.php -->
<style>
.edit-div {
    width: 80%;
     border: solid 2px red;
     padding: 30px;
     border-radius: 10px;
     background-color: white;
     margin: auto;
}
.emojidiv {
     display: flex; 
    overflow-x: scroll;
}
/* .emojidiv {
    min-width: 16.6%;
    min-height: 90px;
    background-color: #f5f7fa;
    border: none; 
} */
.emoji_btn{
    min-width: 16.6%;
    min-height: 90px;
    background-color: #f5f7fa;
    border: none; 
}
h1 {
    /* padding-left: 450px; */
    color:#606c76;
    font-size: 2.0rem;
    font-weight: 700;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
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
.editchat-text {
    text-align: center;
}
.btn-send {
    margin-left: 650px;
}
.btn-back {
    border:2px solid red;
    padding: 100px;
    margin: 100px;
}
</style>
<div class="edit-div">
<h1 class="editchat-text">Edit Chat</h1>
<?php
    $session = $this->getRequest()->getSession();
    $t_feed->user_id = $session->read('user_id');
    $t_feed->name = $session->read('name');
    echo $this->Form->create($t_feed,array('type'=>'file'));
    echo $this->Form->control('id', ['type' => 'hidden']);
    // echo $this->Form->control('name',['value'=>$session->read('name'),'disabled'=>'disabled']);
    echo $this->Form->control('message', ['rows' => '3']);
    echo "<h1>Current Media</h1>";
    $media = $t_feed->imagefilename;
    if (strpos($media,'.mp4') !== false) {
            echo '<video width="320" height="240" controls>';
            echo "<source src='/video/$media' type='video/mp4'>";
            echo "</video>";
    } 
    elseif (strpos($media,'.webm') !== false) {
        echo '<video width="320" height="240" controls>';
        echo "<source src='/video/$media' type='video/webm'>";
        echo "</video>";
    }
    elseif (strpos($media,'.ogg') !== false) {
        echo '<video width="320" height="240" controls>';
        echo "<source src='/video/$media' type='video/ogg'>";
        echo "</video>";
    } 
    elseif (strpos($media,'.mp3') !== false) {
        echo '<audio width="320" height="240" controls>';
        echo "<source src='/audio/$media' type='audio/mpeg'>";
        echo "</audio>";
    } 
    elseif (strpos($media,'.wav') !== false) {
        echo '<audio width="320" height="240" controls>';
        echo "<source src='/audio/$media' type='audio/wav'>";
        echo "</audio>";
    } else {
            echo "<div style='width: 100px;'>";
            echo $this->Html->image($media);
            echo "</div>";
    }
    echo "<br>";
    echo "<h1>Current Emoji</h1>";
    echo '<div style="width:100px;height: 100px;">';
    $emojii = $t_feed->stamp_id.".png";
    echo "<img src='/img/stamps/$emojii'>";
    echo "</div>";
    echo $this->Form->control('Media',['type'=>'file','title'=>'Choose a image','class'=>'custom-file-input','onchange'=>'readURL(this)']);
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
    $emoji = glob($link."*.png");
    foreach($emoji as $emoji) {
        $subemoji = substr($emoji,11);
        $rev_str = strrev($subemoji);
        $sub_rev_str = substr($rev_str,4);
        $rev_sub_rev_str = strrev($sub_rev_str);
        $id_stamp = (int)$rev_sub_rev_str;
        //echo $id_stamp;
        echo '<button class="emoji_btn" name="stamp_id" value='.$id_stamp.'><img src="/'.$emoji.'" /></button>';
    }
    echo "</div>";
    echo "<br>";
    //echo "<div class="">";
    echo $this->Form->button(__('Save Chat'),['class'=>'btn-send']);
    echo $this->Html->link('Back', ['class'=>'btn-back','action' => 'index']) ;
    //echo "</div>";
    echo $this->Form->end();
?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if(e.target.result.includes('video')){
                    $('#preview-video').attr('src', e.target.result).removeAttr('hidden').width(150).height(200);
                    $('#preview-image').attr('src', e.target.result).attr("hidden",true);
                    $('#preview-audio').attr('src', e.target.result).attr("hidden",true);
                }
                else if(e.target.result.includes('audio')){
                    $('#preview-audio').attr('src', e.target.result).width(200).height(200).removeAttr('hidden');
                    $('#preview-video').attr('src', e.target.result).attr("hidden",true);
                    $('#preview-image').attr('src', e.target.result).attr("hidden",true);
                }
                else {
                    $('#preview-image').attr('src', e.target.result).width(150).height(200).removeAttr('hidden');
                    $('#preview-video').attr('src', e.target.result).attr("hidden",true);
                    $('#preview-audio').attr('src', e.target.result).attr("hidden",true);
                }
            // console.log(e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
