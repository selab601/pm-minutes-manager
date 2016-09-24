<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <h3><?= h($minute->name) ?></h3>
                    <table class="table table-striped">
                        <tr>
                            <th scope="row"><?= __('Project') ?></th>
                            <td><?= $minute->has('project') ? $this->Html->link($minute->project->name, ['controller' => 'Projects', 'action' => 'view', $minute->project->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($minute->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Holded Place') ?></th>
                            <td><?= h($minute->holded_place) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($minute->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Revision') ?></th>
                            <td><?= $this->Number->format($minute->revision) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Holded At') ?></th>
                            <td><?= h($minute->holded_at) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created At') ?></th>
                            <td><?= h($minute->created_at) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Updated At') ?></th>
                            <td><?= h($minute->updated_at) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Examined At') ?></th>
                            <td><?= h($minute->examined_at) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Approved At') ?></th>
                            <td><?= h($minute->approved_at) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Examined') ?></th>
                            <td><?= $minute->is_examined ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Approved') ?></th>
                            <td><?= $minute->is_approved ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Deleted') ?></th>
                            <td><?= $minute->is_deleted ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>参加者</h4>
                    <?php if (!empty($minute->participations)): ?>
                        <table class="table table-striped" cellpadding="0" cellspacing="0">
                            <tr>
                                <th scope="col"><?= __('Id') ?></th>
                                <th scope="col"><?= __('Projects User Id') ?></th>
                                <th scope="col"><?= __('Minute Id') ?></th>
                                <th scope="col"><?= __('Is Participated') ?></th>
                            </tr>
                            <?php foreach ($minute->participations as $participations): ?>
                                <tr>
                                    <td><?= h($participations->id) ?></td>
                                    <td><?= h($participations->projects_user_id) ?></td>
                                    <td><?= h($participations->minute_id) ?></td>
                                    <td><?= h($participations->is_participated) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

            <div class="related">
                <h4><?= __('Related Items') ?></h4>
                <?php if (!empty($minute->items)): ?>
                    <table class="table table-striped" cellpadding="0" cellspacing="0">
                        <tr>
                            <th scope="col"><?= __('Id') ?></th>
                            <th scope="col"><?= __('Minute Id') ?></th>
                            <th scope="col"><?= __('Primary No') ?></th>
                            <th scope="col"><?= __('Item Category Id') ?></th>
                            <th scope="col"><?= __('Order In Minute') ?></th>
                            <th scope="col"><?= __('Contents') ?></th>
                            <th scope="col"><?= __('Revision') ?></th>
                            <th scope="col"><?= __('Overed At') ?></th>
                            <th scope="col"><?= __('Created At') ?></th>
                            <th scope="col"><?= __('Updated At') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($minute->items as $items): ?>
                            <tr>
                                <td><?= h($items->id) ?></td>
                                <td><?= h($items->minute_id) ?></td>
                                <td><?= h($items->primary_no) ?></td>
                                <td><?= h($items->item_category_id) ?></td>
                                <td><?= h($items->order_in_minute) ?></td>
                                <td><?= h($items->contents) ?></td>
                                <td><?= h($items->revision) ?></td>
                                <td><?= h($items->overed_at) ?></td>
                                <td><?= h($items->created_at) ?></td>
                                <td><?= h($items->updated_at) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
