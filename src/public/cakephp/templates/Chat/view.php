<style>
    .view-div {
        width: 80%;
        border: 2px solid red;
        border-radius: 10px;
        padding: 30px;
        margin: auto;
        background-color: white;
    }

    .btn-back {
        color: white;
    }
</style>
<div class="view-div">
    <h1>Chat details</h1>
    <p>Sender: <?= h($t_feed->name) ?></p>
    <p>Emoji: </p>
    <img src="<?php echo "/img/stamps/" . $t_feed->stamp_id . ".png"; ?>" alt="">
    <p>Message: <?= h($t_feed->message) ?></p>
    <p>Media: </p>
    <?php
    $media = $t_feed->imagefilename;
    if (strpos($media, '.mp4') !== false) {
        echo '<video width="320" height="240" controls>';
        echo "<source src='/video/$media' type='video/mp4'>";
        echo "</video>";
    } elseif (strpos($media, '.webm') !== false) {
        echo '<video width="320" height="240" controls>';
        echo "<source src='/video/$media' type='video/webm'>";
        echo "</video>";
    } elseif (strpos($media, '.ogg') !== false) {
        echo '<video width="320" height="240" controls>';
        echo "<source src='/video/$media' type='video/ogg'>";
        echo "</video>";
    } elseif (strpos($media, '.mp3') !== false) {
        echo '<audio width="320" height="240" controls>';
        echo "<source src='/audio/$media' type='audio/mpeg'>";
        echo "</audio>";
    } elseif (strpos($media, '.wav') !== false) {
        echo '<audio width="320" height="240" controls>';
        echo "<source src='/audio/$media' type='audio/wav'>";
        echo "</audio>";
    } else {
        echo "<div style='width: 100px;'>";
        echo $this->Html->image($media);
        echo "</div>";
    }
    ?>
    <p>Create_at: <?= $t_feed->create_at ?></p>
    <p>Update_at: <?= $t_feed->update_at ?></p>
    <button class="btn-back"><?= $this->Html->link('Back', ['action' => 'index']) ?></button>
</div>