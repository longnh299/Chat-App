<!-- File: templates/Chat/view.php -->

<h1><?= h($t_feed->name) ?></h1>
<p><?= h($t_feed->message) ?></p>
<p><small>Created: <?= $t_feed->create_at ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $t_feed->id]) ?></p>