<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Minutes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Participations'), ['controller' => 'Participations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participation'), ['controller' => 'Participations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="minutes form large-9 medium-8 columns content">
    <?= $this->Form->create($minute) ?>
    <fieldset>
        <legend><?= __('Add Minute') ?></legend>
        <?php
            echo $this->Form->input('project_id', ['options' => $projects]);
            echo $this->Form->input('name');
            echo $this->Form->input('holded_place');
            echo $this->Form->input('holded_at', ['empty' => true]);
            echo $this->Form->input('created_at', ['empty' => true]);
            echo $this->Form->input('updated_at');
            echo $this->Form->input('revision');
            echo $this->Form->input('is_examined');
            echo $this->Form->input('is_approved');
            echo $this->Form->input('examined_at', ['empty' => true]);
            echo $this->Form->input('approved_at', ['empty' => true]);
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
