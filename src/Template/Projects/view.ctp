<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Project'), ['action' => 'edit', $project->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Project'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Minutes'), ['controller' => 'Minutes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Minute'), ['controller' => 'Minutes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="projects view large-9 medium-8 columns content">
    <h3><?= h($project->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($project->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Name') ?></th>
            <td><?= h($project->customer_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($project->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Budget') ?></th>
            <td><?= $this->Number->format($project->budget) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Started At') ?></th>
            <td><?= h($project->started_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finished At') ?></th>
            <td><?= h($project->finished_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($project->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($project->updated_at) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Minutes') ?></h4>
        <?php if (!empty($project->minutes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Holded Place') ?></th>
                <th scope="col"><?= __('Holded At') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col"><?= __('Revision') ?></th>
                <th scope="col"><?= __('Is Examined') ?></th>
                <th scope="col"><?= __('Is Approved') ?></th>
                <th scope="col"><?= __('Examined At') ?></th>
                <th scope="col"><?= __('Approved At') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($project->minutes as $minutes): ?>
            <tr>
                <td><?= h($minutes->id) ?></td>
                <td><?= h($minutes->project_id) ?></td>
                <td><?= h($minutes->name) ?></td>
                <td><?= h($minutes->holded_place) ?></td>
                <td><?= h($minutes->holded_at) ?></td>
                <td><?= h($minutes->created_at) ?></td>
                <td><?= h($minutes->updated_at) ?></td>
                <td><?= h($minutes->revision) ?></td>
                <td><?= h($minutes->is_examined) ?></td>
                <td><?= h($minutes->is_approved) ?></td>
                <td><?= h($minutes->examined_at) ?></td>
                <td><?= h($minutes->approved_at) ?></td>
                <td><?= h($minutes->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Minutes', 'action' => 'view', $minutes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Minutes', 'action' => 'edit', $minutes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Minutes', 'action' => 'delete', $minutes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $minutes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($project->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Mail') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($project->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->user_id) ?></td>
                <td><?= h($users->last_name) ?></td>
                <td><?= h($users->first_name) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->mail) ?></td>
                <td><?= h($users->created_at) ?></td>
                <td><?= h($users->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
