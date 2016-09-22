<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Minutes'), ['controller' => 'Minutes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Minute'), ['controller' => 'Minutes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="projects form large-9 medium-8 columns content">
    <?= $this->Form->create($project) ?>
    <fieldset>
        <legend><?= __('Add Project') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('budget');
            echo $this->Form->input('customer_name');
            echo $this->Form->input('started_at', ['empty' => true]);
            echo $this->Form->input('finished_at', ['empty' => true]);
            echo $this->Form->input('created_at', ['empty' => true]);
            echo $this->Form->input('updated_at');
            echo $this->Form->input('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
